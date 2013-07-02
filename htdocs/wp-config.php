<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */


// Use these settings on the local server
if ( file_exists( dirname( __FILE__ ) . '/wp-config-local.php' ) )
{
	include( dirname( __FILE__ ) . '/wp-config-local.php' );
  
// Otherwise use the below settings (on live server)
} else
{

// ** MySQL settings - You can get this info from your web host ** //
	/** The name of the database for WordPress */
	define('DB_NAME', 'fc_wp_2013');

	/** MySQL database username */
	define('DB_USER', 'root');

	/** MySQL database password */
	define('DB_PASSWORD', 'lucreis1');

	/** MySQL hostname */
	define('DB_HOST', 'localhost');


// Overwrites the database to save keep edeting the DB
	//define('WP_HOME','http://dev.fatcatchdesign.com');
	//define('WP_SITEURL','http://dev.fatcatchdesign.com');


/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
	define('WP_DEBUG', false);

}


/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '*tr`<xNG$vDGEC]720xBu:qw%O/hk;H7(*W-c@x~w!|B=`!CfJK|W|i]yPokwSq8');
define('SECURE_AUTH_KEY',  'O&v=c0zE(:h$snKs*f.aF^hm?$IP,-.buGC_+rfYf<{R [7dBD{wSOV}o#ob1^2:');
define('LOGGED_IN_KEY',    'Kh<e?O:,WzC@7M1)KSJlnc6|+KGY|uiPvA6{G|$ QSfs5URTLguh(-;QjR3xJ(9Y');
define('NONCE_KEY',        'MGvvxf8*N?--vLOPx!|Z~4HQ.WMX}BaEshFe`5S`j tN}$%_CH*[BaK~F|:bAqbp');
define('AUTH_SALT',        ']4%-MfWgO~:`Q$d5$Qd3FOmPsMZl=(2+rQaX*8ba<s4U,+siXnq[n?+s/Gu)/y#?');
define('SECURE_AUTH_SALT', 'U}^!-bgVNa?W8`+[/eIe,H|y:+~Jipj-il,3qNi<j-_hof|W@JTuyWB7)];U-;oa');
define('LOGGED_IN_SALT',   'R0ki]/,<6J=+CRBkZPQ=vxx/m~``-k_4]!N=E=o#$yLnMO6?o,BsS+{b*z7h)-eE');
define('NONCE_SALT',       'P.l:h8AUp]*K.I0,kNaJ!U,bbt^!KeEgY)PJ&sk6J{=9}q*x;HC+$jUncL+$]$8|');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'fc_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
