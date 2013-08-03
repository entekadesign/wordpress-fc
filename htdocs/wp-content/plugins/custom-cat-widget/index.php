<?php
/*
Plugin Name: Custom Category Widget
Plugin URI: http://fatcatchdesign.com
Description: Widget for displaying custom categories as a list.
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

// include() or require() any necessary files here...
include_once('includes/custom-cat-widget.php');
// Tie into WordPress Hooks and any functions that should run on load.
add_action('widgets_init', 'Custom_Cat_Widget::register_custom_cat_widget');
/* EOF */