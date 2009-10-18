<?php
/*
Plugin Name: swpframework
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: The Plugin's Version Number, e.g.: 1.0
Author: Name Of The Plugin Author
Author URI: http://URI_Of_The_Plugin_Author
*/


/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
/*

	##
	## NOTES FROM AUTHOR:
	## ==================
	## This WordPress API/Framework was created by using many different references including WordPress CODEX, reliable plugins, and 
	## jQuery/JavaScript widgets that are already part of the WordPress.  I did not find API/Framworks that were easy to use and most 
	## were incompelte. I was looking for something that would provide me with all the features required to build a good plugin.  
	## This plugin includes the following:
	##
	## 1) Activation - Adding Options, Database Tables
	## 2) Deactivation - Removing Options, Database Tables
	## 3) Options Page - A customized options page with CSS to give it a pleasant appearance. With samples of different <input> values.
	## 3) Use of AJAX/JavaScript Components:
	##	  a) farbtastic -  JavaScript/jQuery Color Picker.  (http://acko.net/blog/farbtastic-color-picker-released)
	## 4) Data Entry/List Page - Allows you to Add, Remove, Edit, View data from the database file.  Also offers customized CSS settings
	##    to improve the appearance of the layout.
	## 5) 214 Tango Theme Icons (16 x 16) and (32 x 32) from FreeDesktop.org ( http://tango.freedesktop.org/Tango_Icon_Library )
	##    There are plenty of icons available on the web, all you have to do is search for them.  The best resolution comes from icons
	##    that are "*.ico" files.  This is because Icons from .ico files have been designed with 16, 22, 32, 64, etc so they will always 
	##    display properly. If you use Photoshop you'll need an .ico converter, Telegraphics offers a free add-on: http://www.telegraphics.com.au/sw/
	##    
	
	## INSTURCTIONS: 
	## ==================
	## Even though this plugin works without making changes, you need to customize it before you can begin.  Follow the steps below
	## before you begin adding your own code.
	## 1) Change the information at the top of this file: Plugin Name, Plugin URI, Description, Version, Author, Author URI between lines 3 through 8.       
	## 2) Rename the directory of this plugin, from 'swpframework' to the name of your plugin (use standard unix naming conventions).
	## 3) Rename all the files inside the directory of this plugin that start with the words 'swpframework_', to the name of this plugin. 
	##    (example: swpframework.php, swpframework_farbtastic.js --> newpluin.php, newplugin_farbtastic.js, etc.) - (use standard unix naming conventions)
	## 3) Change the VERSION NUMBER below when you make changes to the plugin.
	## 4) Replace the words 'swpframework' with the name of this file, do not use the ".php" values. (use standard unix naming conventions)
	## 5) Replace the words 'SWP Framework' with the actual name of your plugin, 'New Plugin', you can use spaces, it's used for error messages, or comments.
	## 6) When you have completed your plugin you should:
	##    a) Remove all the comments I have provided, except for the one that gives me credit for creating this API/Framework.
	##    b) DO NOT REMOVE: GNU General Public License.
	##    c) DON'T BE GREEDY - share you plugin with others. ( http://wordpress.org/extend/plugins/about/ )


	## Wordpress Default Constants & Functions
	## =======================================
	## I am listing a few extreemly important functions, and constants that you need throughout your plugin. These increase the 
	## compatability of your plugin.  I have also included links to the WordPress CODEX and Video library for your reference.
	##
	## "How 'NOT' to Build a WordPress Plugin", by Will Norris( http://wordpress.tv/2009/09/20/will-norris-building-plugins-portland09/ )
	## Important Constats and Functions ( http://wpengineer.com/wordpress-return-url/ )
	##
	## Assinging URL's:
	## =======================================
	## - plugins_url();   - site_url();
	## - content_url();   - admin_url();
	## - includes_url();
	##
	## CSS & JavaScript
	## =======================================
	## - wp_enqueue_script();	// ( http://codex.wordpress.org/Function_Reference/wp_enqueue_script )
	## - wp_enqueue_style();	// ( http://codex.wordpress.org/Function_Reference/wp_enqueue_style )
	##                               WordPress Codex: 
	##
	## Directories, Folders and Paths
	## =======================================
	## ABSPATH, WP_PLUGIN_DIR, WP_CONTENT_DIR
	##
	## Actions and Filters visit
	## =======================================
	## http://codex.wordpress.org/Plugin_API
 	## http://codex.wordpress.org/Plugin_API/Action_Reference
 	## http://codex.wordpress.org/Plugin_API/Filter_Reference
 	##
	## WordPress: Release Archive ( Previous Versions of WordPress )
	## ==============================================================
	## The wordpress site has a list of all the WordPress releases.  I suggest you test your plugin with older versions.
	## this API was tested to work with Version 2.6 and up.  We have not tested it with older versions, because the I used
	## functions and constants that did not exist before that. 
	## 
	## WordPress: Release Archive - ( http://wordpress.org/download/release-archive/ )

	
*/  


// Sets up plugin configuration and routing based on names of plugin folder and files.

# define plugin constants
define( 'MYPLUGIN_VERSION', "1.1");						#  Plugin Database Version: Change this value every time you make changes to your plugin. 
define( 'MYPLUGIN_PURGE_DATA', true );					#  When plugin is deactivated, if 'true', all Tables, and Options will be removed.

define( 'WP_ADMIN_PATH', ABSPATH . '/wp-admin/');  // If you have a better answer to this Constant, feel free to send me an e-mail.  

define( 'MYPLUGIN_FILE', basename(__FILE__) );
define( 'MYPLUGIN_NAME', basename(__FILE__, ".php") );
define( 'MYPLUGIN_PATH', str_replace( '\\', '/', trailingslashit(dirname(__FILE__)) ) );

require_once( MYPLUGIN_PATH . '/functions.php' );
require_once( MYPLUGIN_PATH . '/activation.php' );
require_once( MYPLUGIN_PATH . '/deactivate.php' );
require_once( MYPLUGIN_PATH . '/options.php' );
require_once( MYPLUGIN_PATH . '/menus.php' );

define( 'MYPLUGIN_URL', plugins_url('', __FILE__) );  // NOTE: It is recommended that every time you reference a url, that you specify the plugins_url('xxx.xxx',__FILE__), WP_PLUGIN_URL, WP_CONTENT_URL, WP_ADMIN_URL view the video by Will Norris.


register_activation_hook(__FILE__,'swpframework_activate');  // WordPress Hook that excutes the installation

register_deactivation_hook( __FILE__, 'swpframework_deactivate' ); // WordPress Hook that handles deactivation of the plugin.

// add_action('plugins_loaded', 'swpframework_activate' );   // check for updates from previous versions.
// add_action('admin_menu', 'swpframework_options_page');



?>