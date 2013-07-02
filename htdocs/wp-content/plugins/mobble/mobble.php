<?php

/*
	mobble
	------
	
	Plugin Name: mobble
	Plugin URI: http://www.toggle.uk.com/journal/mobble
	Description: Conditional functions for detecting a variety of mobile devices and tablets. For example is_android(), is_ios(), is_iphone().
	Author: Scott Evans
	Version: 1.1
	Author URI: http://www.toggle.uk.com/

	Copyright (c) 2011 toggle labs ltd <http://www.toggle.uk.com>

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	THIS SOFTWARE AND DOCUMENTATION IS PROVIDED "AS IS," AND COPYRIGHT
	HOLDERS MAKE NO REPRESENTATIONS OR WARRANTIES, EXPRESS OR IMPLIED,
	INCLUDING BUT NOT LIMITED TO, WARRANTIES OF MERCHANTABILITY OR
	FITNESS FOR ANY PARTICULAR PURPOSE OR THAT THE USE OF THE SOFTWARE
	OR DOCUMENTATION WILL NOT INFRINGE ANY THIRD PARTY PATENTS,
	COPYRIGHTS, TRADEMARKS OR OTHER RIGHTS.COPYRIGHT HOLDERS WILL NOT
	BE LIABLE FOR ANY DIRECT, INDIRECT, SPECIAL OR CONSEQUENTIAL
	DAMAGES ARISING OUT OF ANY USE OF THE SOFTWARE OR DOCUMENTATION.

	You should have received a copy of the GNU General Public License
	along with this program. If not, see <http://gnu.org/licenses/>.

*/

$useragent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "";

/***************************************************************
* Function is_iphone
* Detect the iPhone
***************************************************************/

function is_iphone() {
	global $useragent;
	return(preg_match('/iphone/i',$useragent));
}

/***************************************************************
* Function is_ipad
* Detect the iPad
***************************************************************/

function is_ipad() {
	global $useragent;
	return(preg_match('/ipad/i',$useragent));
}

/***************************************************************
* Function is_ipod
* Detect the iPod, most likely the iPod touch
***************************************************************/

function is_ipod() {
	global $useragent;
	return(preg_match('/ipod/i',$useragent));
}

/***************************************************************
* Function is_android
* Detect an android device. They *SHOULD* all behave the same
***************************************************************/

function is_android() {
	global $useragent;
	return(preg_match('/android/i',$useragent));
}

/***************************************************************
* Function is_blackberry
* Detect a blackberry device 
***************************************************************/

function is_blackberry() {
	global $useragent;
	return(preg_match('/blackberry/i',$useragent));
}

/***************************************************************
* Function is_opera_mobile
* Detect both Opera Mini and hopfully Opera Mobile as well
***************************************************************/

function is_opera_mobile() {
	global $useragent;
	return(preg_match('/opera mini/i',$useragent));
}

/***************************************************************
* Function is_palm
* Detect a webOS device such as Pre and Pixi
***************************************************************/

function is_palm() {
	global $useragent;
	return(preg_match('/webOS/i', $useragent));
}

/***************************************************************
* Function is_symbian
* Detect a symbian device, most likely a nokia smartphone
***************************************************************/

function is_symbian() {
	global $useragent;
	return(preg_match('/Series60/i', $useragent) || preg_match('/Symbian/i', $useragent));
}

/***************************************************************
* Function is_windows_mobile
* Detect a windows smartphone
***************************************************************/

function is_windows_mobile() {
	global $useragent;
	return(preg_match('/WM5/i', $useragent) || preg_match('/WindowsMobile/i', $useragent));
}

/***************************************************************
* Function is_lg
* Detect an LG phone
***************************************************************/

function is_lg() {
	global $useragent;
	return(preg_match('/LG/i', $useragent));
}

/***************************************************************
* Function is_motorola
* Detect a Motorola phone
***************************************************************/

function is_motorola() {
	global $useragent;
	return(preg_match('/\ Droid/i', $useragent) || preg_match('/XT720/i', $useragent) || preg_match('/MOT-/i', $useragent) || preg_match('/MIB/i', $useragent));
}

/***************************************************************
* Function is_nokia
* Detect a Nokia phone
***************************************************************/

function is_nokia() {
	global $useragent;
	return(preg_match('/Series60/i', $useragent) || preg_match('/Symbian/i', $useragent) || preg_match('/Nokia/i', $useragent));
}

/***************************************************************
* Function is_samsung
* Detect a Samsung phone
***************************************************************/

function is_samsung() {
	global $useragent;
	return(preg_match('/Samsung/i', $useragent));
}

/***************************************************************
* Function is_samsung_galaxy_tab
* Detect the Galaxy tab
***************************************************************/

function is_samsung_galaxy_tab() {
	global $useragent;
	return(preg_match('/SPH-P100/i', $useragent));
}

/***************************************************************
* Function is_sony_ericsson
* Detect a Sony Ericsson
***************************************************************/

function is_sony_ericsson() {
	global $useragent;
	return(preg_match('/SonyEricsson/i', $useragent));
}

/***************************************************************
* Function is_nintendo
* Detect a Nintendo DS or DSi
***************************************************************/

function is_nintendo() {
	global $useragent;
	return(preg_match('/Nintendo DSi/i', $useragent) || preg_match('/Nintendo DS/i', $useragent));
}

/***************************************************************
* Function is_handheld
* Wrapper function for detecting ANY handheld device
***************************************************************/

function is_handheld() {
	return(is_iphone() || is_ipad() || is_ipod() || is_android() || is_blackberry() || is_opera_mobile() || is_palm() || is_symbian() || is_windows_mobile() || is_lg() || is_motorola() || is_nokia() || is_samsung() || is_samsung_galaxy_tab() || is_sony_ericsson() || is_nintendo());
}

/***************************************************************
* Function is_mobile
* Wrapper function for detecting ANY mobile phone device
***************************************************************/

function is_mobile() {
	if (is_tablet()) { return false; }  // this catches the problem where an Android device may also be a tablet device
	return(is_iphone() || is_ipod() || is_android() || is_blackberry() || is_opera_mobile() || is_palm() || is_symbian() || is_windows_mobile() || is_lg() || is_motorola() || is_nokia() || is_samsung() || is_sony_ericsson() || is_nintendo());
}

/***************************************************************
* Function is_ios
* Wrapper function for detecting ANY iOS/Apple device
***************************************************************/

function is_ios() {
	return(is_iphone() || is_ipad() || is_ipod());

}

/***************************************************************
* Function is_tablet
* Wrapper function for detecting tablet devices (needs work)
***************************************************************/

function is_tablet() {
	return(is_ipad() || is_samsung_galaxy_tab());
}

/***************************************************************
* Function mobble_defualts
* Setup defualt settings on theme activation
***************************************************************/

register_activation_hook(__FILE__, 'mobble_defaults');

function mobble_defaults() {
	
	$tmp = get_option('mobble_body_class');
	if(!$tmp) { update_option('mobble_body_class', 1); }
}

/***************************************************************
* Function mobble_clean
* Remove options from WordPress table on deactivation
***************************************************************/

register_deactivation_hook(__FILE__, 'mobble_clean');

function mobble_clean() {
	delete_option('mobble_body_class');
}

/***************************************************************
* Functions mobble_menu, mobble_settings, mobble_register_settings
* Create an administration settings page within WordPress
***************************************************************/

if (is_admin()) { 
	add_action('admin_menu', 'mobble_menu');
	add_action('admin_init', 'mobble_register_settings');
}

function mobble_menu() {
 	add_options_page('mobble', 'mobble', 'administrator', __FILE__, 'mobble_settings');
}

function mobble_settings() { 
	
	define('MOBBLE_IMAGES_URL',plugins_url('/',__FILE__));
?>

<!-- flattr js -->
<script type="text/javascript">
/* <![CDATA[ */
    (function() {
        var s = document.createElement('script'), t = document.getElementsByTagName('script')[0];
        s.type = 'text/javascript';
        s.async = true;
        s.src = 'http://api.flattr.com/js/0.6/load.js?mode=auto';
        t.parentNode.insertBefore(s, t);
    })();
/* ]]> */
</script>

<style type="text/css">
	.FlattrButton { position: relative; top: 3px !important; }
	.togglecredit { padding: 10px 10px 10px 10px; background: #f1f1f1; border-bottom: 1px solid #e3e3e3; overflow: hidden; -webkit-border-radius: 5px; -moz-border-radius: 5px; -khtml-border-radius: 5px; border-radius: 5px; }
	.togglecredit img { float: left;  padding: 8px 11px 8px 5px; margin: 5px 5px 0 0; border-right: 1px solid #aaaaaa; }
	.togglecredit p { float: left; padding: 5px 0; margin: 0 0 0 8px;}
</style>

<div class="wrap">
	
	<div class="icon32" id="icon-options-general"></div>
	
	<h2>mobble</h2>
	<ul class="subsubsub"> 
		<li><a href="?page=mobble/mobble.php" <?php if (!isset($_GET['action'])) { echo 'class="current"'; } ?>>Options</a> </li> 
		<!--<li><a href="?page=mobble/mobble.php&amp;action=help" <?php if ($_GET['action'] == "help") { echo 'class="current"'; } ?>>Help</a></li>--> 
	</ul> 
		
	<form method="post" action="options.php">
	    <?php settings_fields( 'mobble-settings-group' ); ?>
	    
	    <table class="form-table">
	        <tr valign="top">
	        <th scope="row">Mobify body class?</th>
	        <td><label for="users_can_register"><input name="mobble_body_class" type="checkbox" id="mobble_body_class" value="1" <?php echo checked( 1, get_option('mobble_body_class'), false ); ?> /> &nbsp;Add mobile information to your theme body class? e.g. &lt;body class="handheld andorid tablet"&gt;</label> </td>
	        </tr>
	    </table>
	    
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>
	</form>
	
	<div  class="togglecredit">
		<a href="http://www.toggle.uk.com" title="toggle - WordPress website development"><img src="<?php echo MOBBLE_IMAGES_URL; ?>toggle.png" alt="toggle"/></a>
		<p>Developed by <a href="http://www.toggle.uk.com" title="toggle - WordPress website development">toggle</a>. If you find this plugin useful we'd be flattered to be Flattr'd:<br/><a class="FlattrButton" style="display:none; " rev="flattr;button:compact;" href="http://www.toggle.uk.com/journal/mobble/"></a></p>
	</div>
</div>
<?php 
}

function mobble_register_settings() {
	register_setting( 'mobble-settings-group', 'mobble_body_class' );
}

/***************************************************************
* Function mobble_body_class
* Add mobilie info to the body class if activated in settings
***************************************************************/

if (!is_admin() && get_option('mobble_body_class')) {	
	add_filter('body_class','mobble_body_class');
}

function mobble_body_class($classes) 
{

	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome;

	// top level
	if (is_handheld()) { $classes[] = "handheld"; };
	if (is_mobile()) { $classes[] = "mobile"; };
	if (is_ios()) { $classes[] = "ios"; };
	if (is_tablet()) { $classes[] = "tablet"; };

	// specific 
	if (is_iphone()) { $classes[] = "iphone"; };
	if (is_ipad()) { $classes[] = "ipad"; };
	if (is_ipod()) { $classes[] = "ipod"; };
	if (is_android()) { $classes[] = "android"; };
	if (is_blackberry()) { $classes[] = "blackberry"; };
	if (is_opera_mobile()) { $classes[] = "opera-mobile";}
	if (is_palm()) { $classes[] = "palm";}
	if (is_symbian()) { $classes[] = "symbian";}
	if (is_windows_mobile()) { $classes[] = "windows-mobile"; }
	if (is_lg()) { $classes[] = "lg"; }
	if (is_motorola()) { $classes[] = "motorola"; }
	if (is_nokia()) { $classes[] = "nokia"; }
	if (is_samsung()) { $classes[] = "samsung"; }
	if (is_samsung_galaxy_tab()) { $classes[] = "samsung-galaxy-tab"; }
	if (is_sony_ericsson()) { $classes[] = "sony-ericsson"; }
	if (is_nintendo()) { $classes[] = "nintendo"; }
	
	// bonus
	if (!is_handheld()) { $classes[] = "desktop"; }
	if ($is_lynx) { $classes[] = "lynx"; }
	if ($is_gecko) { $classes[] = "gecko"; }
	if ($is_opera) { $classes[] = "opera"; }
	if ($is_NS4) { $classes[] = "ns4"; }
	if ($is_safari) { $classes[] = "safari"; }
	if ($is_chrome) { $classes[] = "chrome"; }
	if ($is_IE) { $classes[] = "ie"; }
	
	return $classes;
}

/* fin */
?>