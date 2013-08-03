<?php
/*
Plugin Name: Twitter-FC
Plugin URI: http://fatcatchdesign.com
Description: Provides a shortcode to display recent tweets.
Version: 1.0
Author: Marco Tomaschett
Author URI: http://fatcatchdesign.com
License: GPL2
*/
/*  Copyright 2012  Marco Tomaschett  (email : marco@fatcatchdesign.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Note that the clever bits of this plugin are modified from Craig Buckler's Twitterstatus class (www.optimalworks.net)
// The ParseDates52 function modified from Timesince() by Viral Patel (viralpatel.net)
// Incorporates TwitterOAuth class by Abraham Williams (abrah.am). See http://github.com/abraham/twitteroauth

register_activation_hook(__FILE__,'twfc_install');

// register_deactivation_hook(__FILE__, 'twfc_deactivate');

register_uninstall_hook(__FILE__, 'twfc_uninstall');

add_shortcode('twitter-fc', 'twfc_shortcode');

// Support shortcode in text widget
add_filter('widget_text', 'do_shortcode');

add_action( 'admin_init', 'twfc_init');

add_filter( 'plugin_action_links', 'twfc_plugin_action_links', 10, 2 );

add_action('admin_menu', 'twfc_menu');

function twfc_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'limit' => '1',
		'noreplies' => true,
		'retweets' => false
	), $atts));
	
	$twfc_options = get_option('twfc_options');
	$last_command = (array_key_exists('command_atts', $twfc_options)) ? $twfc_options['command_atts'] : NULL;
	if ( $last_command != $atts ) {
		$twfc_options['command_atts'] = $atts;
	    update_option('twfc_options', $twfc_options);
		twfc_clear_cache();	
	}

	return retrieve_tweets($limit, $noreplies, $retweets);
}

function twfc_install() {
	$twfc_options = get_option('twfc_options');
	if (!is_array($twfc_options)) {
	$twfc_options=array(
		"screen_name" => 'fatcatchdesign',
		"consumer_key" => 'NpjaAuONbiAhLNxJL3RQ',
		"consumer_secret" => 'sLgeKw9MIy2vGEZhIxRM2GahOF6dUOuMGloT9TRdckA',
		"oauth_token" => 'Get this value from https://dev.twitter.com/apps',
		"oauth_secret" => 'Get this value from https://dev.twitter.com/apps',
		"widget_template" =>
			'<div class="twitterstatus">' .
			'<h2><a href="http://twitter.com/{screen_name}"><img src="{profile_image_url}" width="24" height="24" alt="{name}" />{name}</a></h2>' . 
			'<ul>{TWEETS}</ul>' . 
			'</div>',
		"tweet_template" =>
			'<li>{text} <em>{created_at}</em></li>',
		"no_content" =>
			'<div class="twitterstatus">' .
			'<h2>Tweets are temporarily unavailable.</h2>' . 
			'<ul><li>Please check in again soon.</li></ul>' . 
			'</div>',
		"command_atts" => NULL
	);

	update_option('twfc_options', $twfc_options);
	}
}

function twfc_uninstall() {
	delete_option( 'twfc_options' );
}

function twfc_init() {
	register_setting( 'twfc-settings-group', 'twfc_options', 'twfc_validate_options' );
}

function twfc_menu() {
	add_options_page(__('Twitter FC Settings Page','twfc-plugin'), __('Twitter FC Settings','twfc-plugin'), 'administrator', __FILE__, 'twfc_settings_page');
}

function twfc_settings_page() {
	$twfc_options = get_option('twfc_options');
	if (isset($_GET['settings-updated']) ) {
		twfc_clear_cache();
	}
	
?>
    <div class="wrap">
	<div class="icon32" id="icon-options-general"><br></div>
    <h2><?php _e('Twitter-FC Options', 'twfc-plugin') ?></h2>
    
    <form method="post" action="options.php">
        <?php settings_fields( 'twfc-settings-group' ); ?>
        <table class="form-table">
            <tr valign="top">
	            <th scope="row"><?php _e('Twitter Screen Name', 'twfc-plugin') ?></th>
	            <td>
					<input type="text" name="twfc_options[screen_name]" value="<?php echo $twfc_options['screen_name']; ?>" size="20" maxlength="20" />
				</td>
            </tr>

            <tr>
	            <th scope="row"><?php _e('Twitter Consumer Key', 'twfc-plugin') ?></th>
	            <td>
					<input type="text" name="twfc_options[consumer_key]" value="<?php echo $twfc_options['consumer_key']; ?>" size="50" maxlength="50" />
				</td>
            </tr>

            <tr>
	            <th scope="row"><?php _e('Twitter Consumer Secret', 'twfc-plugin') ?></th>
	            <td>
					<input type="text" name="twfc_options[consumer_secret]" value="<?php echo $twfc_options['consumer_secret']; ?>" size="50" maxlength="50" />
				</td>
            </tr>

            <tr>
	            <th scope="row"><?php _e('Twitter Oauth Token', 'twfc-plugin') ?></th>
	            <td>
					<input type="text" name="twfc_options[oauth_token]" value="<?php echo $twfc_options['oauth_token']; ?>" size="50" maxlength="50" />
				</td>
            </tr>

            <tr>
	            <th scope="row"><?php _e('Twitter Oauth Token Secret', 'twfc-plugin') ?></th>
	            <td>
					<input type="text" name="twfc_options[oauth_secret]" value="<?php echo $twfc_options['oauth_secret']; ?>" size="50" maxlength="50" />
				</td>
            </tr>

			<tr>
				<th scope="row"><?php _e('Widget Template', 'twfc-plugin') ?></th>
				<td>
					<textarea name="twfc_options[widget_template]" rows="7" cols="50" type='textarea'><?php echo $twfc_options['widget_template']; ?></textarea><br />
				</td>
			</tr>
			
			<tr>
				<th scope="row"><?php _e('Tweet Template', 'twfc-plugin') ?></th>
				<td>
					<textarea name="twfc_options[tweet_template]" rows="2" cols="50" type='textarea'><?php echo $twfc_options['tweet_template']; ?></textarea><br />
				</td>
			</tr>
			
			<tr>
				<th scope="row"><?php _e('No Content Message', 'twfc-plugin') ?></th>
				<td>
					<textarea name="twfc_options[no_content]" rows="7" cols="50" type='textarea'><?php echo $twfc_options['no_content']; ?></textarea><br />
				</td>
			</tr>			
					
        </table>

		<p><?php _e('To use shortcode, type "[twitter-fc limit=3 noreplies=true retweets=false]" in a WordPress text widget or elsewhere, where "limit" is the number of tweets to display, "noreplies" and "retweets" excludes or includes replies and retweets.', 'twfc-plugin') ?></p>
        
        <p class="submit">
        <input type="submit" class="button-primary" value="<?php _e('Save Changes', 'twfc-plugin') ?>" />
        </p>
    
    </form>
    </div>
<?php
}

function twfc_clear_cache() {
	$cache = dirname(__FILE__) . '/cache/';
	foreach (glob($cache . "fatcatchdesign*.txt") as $file) { // delete all cache files
		if(is_file($file)){
			@unlink($file);
		}
	}
}

// Display a Settings link on the main Plugins page
function twfc_plugin_action_links( $links, $file ) {
	if ( $file == plugin_basename( __FILE__ ) ) {
		$twfc_links = '<a href="'.get_admin_url().'options-general.php?page=twitter-fc/twitter-fc.php">'.__('Settings').'</a>';
		// make the 'Settings' link appear first
		array_unshift( $links, $twfc_links );
	}

	return $links;
}

function twfc_validate_options($input) {
	$twfc_options = get_option('twfc_options');
	$ary = array('screen_name', 'consumer_key', 'consumer_secret', 'oauth_token', 'oauth_secret', 'widget_template', 'tweet_template', 'no_content');
	foreach ($ary as $val) {
		if (empty($input[$val])) $input[$val] = $twfc_options[$val];
	}
	return $input;
}

function retrieve_tweets($retrieval_count = 1, $exclude_replies = true, $include_rts = false) {
	
	// HTML string returned from template
	$render = '';

	$twfc_options = get_option('twfc_options');
	
	$screen_name = $twfc_options['screen_name'];
	
	$widget_template = $twfc_options['widget_template'];

	$tweet_template = $twfc_options['tweet_template'];
	
	$cache = dirname(__FILE__) . '/cache/' . $screen_name . '-' . $retrieval_count . '-json.txt';

	$cache_age = (file_exists($cache) ? time() - filemtime($cache) : -1);

	$cache_age_max = 900; //15 minutes

	$error = '';

	if ($cache_age < 0 || $cache_age > $cache_age_max) {

	if (!class_exists('TwitterOAuth')) require_once(dirname(__FILE__) . '/twitteroauth/twitteroauth.php');			
		
		$connection = new TwitterOAuth($twfc_options['consumer_key'], $twfc_options['consumer_secret'], $twfc_options['oauth_token'], $twfc_options['oauth_secret']);
		
		$data = $connection->get('statuses/user_timeline', array('screen_name' => $screen_name, 'count' => $retrieval_count, 'exclude_replies' => $exclude_replies, 'include_rts' => $include_rts));
		
		$http_code = $connection->http_code;
		
		if($http_code != 200) {
			$error = 'Connection error. HTTP Code: ' . $http_code . '. ';
		}
		
		//echo var_dump($connection);

		if (isset($connection->error)) $error .= $connection->error; //Twitter sends an error
		
		if(!$error) {
			$widget = '';
			$status = '';
		
			// examine all tweets
			for ($t = 0, $tl = count($data); $t < $tl; $t++) {
				
				// parse widget template
				if ($t == 0) {
					$widget .= ParseStatus($data[$t], $widget_template);
				}
				
				// parse tweet
				$status .= ParseStatus($data[$t], $tweet_template);
			}
		
			// parse Twitter links
			$render = str_replace('{TWEETS}', $status, $widget);
			
			// update cache file
			file_put_contents($cache, $render);
		} else {
			if (current_user_can('manage_options')) {
				?>
				<div class="error"><p><?php _e('Error: ', 'twfc-plugin'); echo $error; ?></p></div>
				<?php
			}
		}
	}

	// fetch from cache
	if ($render == '' && $cache_age > 0) {
		$render = file_get_contents($cache);
	}
		
	if (empty($render)) $render = $twfc_options['no_content'];
	
	return ParseDates52($render);

}

function ParseStatus($data, $template) {

	// replace all {tags}
	preg_match_all('/{(.+)}/U', $template, $m);
	for ($i = 0, $il = count($m[0]); $i < $il; $i++) {
		
		$name = $m[1][$i];
	
		// Twitter value found?
		$d = false;
		// if (isset($data[$name])) {
		// 	$d = $data[$name];
		// }
		if (isset($data->$name)) {
			$d = $data->$name;
		}		
		// else if (isset($data['user'][$name])) {
		// 	$d = $data['user'][$name];
		// }
		else if (isset($data->user->$name)) {
			$d = $data->user->$name;
		}		
		
		// replace data
		if ($d) {
		
			switch ($name) {
				
				// parse status links
				case 'text':
					$d = ParseTwitterLinks($d);
					break;
					
				// tweet date
				case 'created_at':
					$d = "{DATE:$d}";
					break;
			
			}
		
			$template = str_replace($m[0][$i], $d, $template);

		}
	
	}
	
	return $template;
}


function ParseTwitterLinks($str) {

	// parse URL
	$str = preg_replace('/(https{0,1}:\/\/[\w\-\.\/#?&=]*)/', '<a href="$1">$1</a>', $str);

	// parse @id
	$str = preg_replace('/@(\w+)/', '@<a href="http://twitter.com/$1" class="at">$1</a>', $str);
	
	// parse #hashtag
	$str = preg_replace('/\s#(\w+)/', ' <a href="http://twitter.com/#!/search?q=%23$1" class="hashtag">#$1</a>', $str);

	return $str;
}

function ParseDates52($str) {
	preg_match_all('/{DATE:(.+)}/U', $str, $m);
	for ($in = 0, $il = count($m[0]); $in < $il; $in++) {
	
		$original = strtotime($m[1][$in]);	
		
	   // array of time period chunks
	    $chunks = array(
	    array(60 * 60 * 24 * 365 , 'year'),
	    array(60 * 60 * 24 * 30 , 'month'),
	    array(60 * 60 * 24 * 7, 'week'),
	    array(60 * 60 * 24 , 'day'),
	    array(60 * 60 , 'hour'),
	    array(60 , 'min'),
	    array(1 , 'sec'),
	    );

	    $today = time(); /* Current unix time  */
	    $since = $today - $original;
	
	    // $j saves performing the count function each time around the loop
	    for ($i = 0, $j = count($chunks); $i < $j; $i++) {

		    $seconds = $chunks[$i][0];
		    $name = $chunks[$i][1];

		    // finding the biggest chunk (if the chunk fits, break)
		    if (($count = floor($since / $seconds)) != 0) {
		        break;
		    }
	    }

	    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";

	    if ($i + 1 < $j) {
		    // now getting the second item
		    $seconds2 = $chunks[$i + 1][0];
		    $name2 = $chunks[$i + 1][1];

		    // add second item if its greater than 0
		    if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) {
		        $print .= ($count2 == 1) ? ', 1 '.$name2 : " $count2 {$name2}s";
		    }
	    }
		
		// $print = $print . ' ago';
		
		// replace date
		$str = str_replace($m[0][$in], $print, $str);
	
	}

	return $str;

}

function ParseDates($str) { // ONLY IN PHP >= 5.3

	// current datetime
	$now = new DateTime();

	preg_match_all('/{DATE:(.+)}/U', $str, $m);
	for ($i = 0, $il = count($m[0]); $i < $il; $i++) {
	
		$stime = new DateTime($m[1][$i]);
		
		$ival = $now->diff($stime);		
		
		$yr = $ival->y;
		$mh = $ival->m + ($ival->d > 15);
		if ($mh > 11) $yr = 1;
		$dy = $ival->d + ($ival->h > 15);
		$hr = $ival->h;
		$mn = $ival->i + ($ival->s > 29);
		
		if ($yr > 0) {
			if ($yr == 1) $date = 'last year';
			else $date = $yr . ' years ago';
		}
		else if ($mh > 0) {
			if ($mh == 1) $date = 'last month';
			else $date = $mh . ' months ago';
		}
		else if ($dy > 0) {
			if ($dy == 1) $date = 'yesterday';
			else if ($dy < 8) $date = $dy . ' days ago';
			else if ($dy < 15) $date = 'last week';
			else $date = round($dy / 7) . ' weeks ago';
		}
		else if ($hr > 0) {
			$hr += ($ival->i > 29);
			$date = $hr . ' hour' . ($hr == 1 ? '' : 's') . ' ago';
		}
		else {
			if ($mn < 3) $date = 'just now';
			else $date = $mn . ' minutes ago';
		}
		
		// replace date
		$str = str_replace($m[0][$i], $date, $str);
	
	}

	return $str;
}
 
?>