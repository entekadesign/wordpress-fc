=== mobble ===
Contributors: toggle,scottsweb
Donate link: http://www.toggle.uk.com
Tags: mobile, conditional, css, media, queries, functions
Requires at least: 3.0
Tested up to: 3.2.1
Stable tag: trunk

Helper plugin that provides conditional functions for detecting a variety of mobile devices & tablets. Perfect accompaniment to CSS Media Queries.

== Description ==

mobble provides mobile related conditional functions for your site. e.g. [is_iphone(), is_mobile() and is_tablet()](http://wordpress.org/extend/plugins/mobble/faq/ "More examples").

CSS media queries are great for creating responsive web designs but they do not always provide enough control.
There are times when not all of the content, JavaScript or CSS on a page is relevant for a particular device.

Lets say you're in the countryside with a limited data connection and you're trying to find an address for your 
next meeting. We should not force you to download unnecessary content and load heavy JavaScript libraries 
that waste your time and your data allowance. 

With the mobble functions you can make these kind of tweaks to your theme. mobble can also add device information 
to the body class of your theme allowing you to easily target your CSS for different gadgets.

[a toggle plugin](http://www.toggle.uk.com/ "toggle web design Farnham")

== Installation ==

To install this plugin:

1. Upload the `mobble` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. You can now use `<?php is_mobile(); is_tablet(); // etc ?>` functions in your template
1. If you want you can also disable the device specific body classes in the WordPress Admin->Settings->mobble setting section

== Frequently Asked Questions ==

= What functions are available? =

The most useful ones are:

`<?php 
is_handheld(); // any handheld device (phone, tablet, Nintendo)
is_mobile(); // any type of mobile phone (iPhone, Android, Nokia etc)
is_tablet(); // any tablet device (currently iPad, Galaxy Tab)
is_ios(); // any Apple device (iPhone, iPad, iPod)
?>`

You can also use:

`<?php 
is_iphone();
is_ipad();
is_ipod();
is_android();
is_blackberry();
is_opera_mobile();
is_palm();
is_symbian();
is_windows_mobile();
is_lg();
is_motorola();
is_nokia();
is_samsung();
is_samsung_galaxy_tab();
is_sony_ericsson();
is_nintendo();
?>`

= Do you have any examples? =

Yup. This first example disables the sidebar for mobile/phone devices:

`<?php 
if (!is_mobile()) {
	get_sidebar();
}
?>`

This second example loads a specific stylesheet for Apple devices (iPhone, iPod and iPad):

`<?php 
if (is_ios()) {
	wp_enqueue_style('ios', get_template_directory_uri() . '/ios.css');
}
?>`

== Screenshots ==

1. Code example - loading different navigations for mobile and desktop.
2. mobble settings screen for enabling/disabling the body class.

== Changelog ==

= 1.1 =
* Correction to the PHP.
* New body class of .desktop for anything not handheld
* Tested on 3.2+

= 1.0 =
* Initial release.
