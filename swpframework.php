<?php
/*
Plugin Name: Simple WordPress Framework
Plugin URI: http://www.swpframework.com
Description: A brief description of the Plugin.
Version: Beta 0.9.1
Author: Leonardo Martinez
Author URI: http://www.leonardomartinez.com
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


	==================
	NOTES FROM AUTHOR:
	==================
	This WordPress API/Framework was created by using many different references including WordPress CODEX, reliable Plugins, and 
	AJAX/jQuery/JavaScript widgets that are already part of the WordPress.  I did not find API/Frameworks that were easy to use and most 
	were incomplete. I was looking for something that would provide me with all the features required to build a good Plugin.  We will
	continue to work on improving and adding new features to this Framework, currently the Plugin includes the following:	

	** What Plugin features are supported? **
	1. 	Activation - Adding options, and new database tables.
	2. 	Deactivation - Removing options and database tables created during activation.
	3.	Menus: New - Create a new menu with submenus, separate from the admin menus.
	4. 	Options Page - A customized options page with additional CSS styles and samples of different <input> values (textarea, text, radio, checkbox, etc.) 
	5. 	Use of AJAX/jQuery/JavaScript Components:
		a) farbtastic - Color Picker which allows you to select a color in a palate (http://acko.net/dev/farbtastic).
		b) Facebox - Facebook-style lightbox which can display images, divs, or entire remote pages (http://famspam.com/facebox).
		b) 500+ Icons - 16 x 16 and 32 x 32 that can be used in your Plugin.  214 Tango Theme Icons (16 x 16) and (32 x 32) from 
		   FreeDesktop.org ( http://tango.freedesktop.org/Tango_Icon_Library ). There are plenty of icons available on the web, 
		   all you have to do is search for them.  The best resolution comes from icons that are "*.ico" files.  This is because 
		   Icons from .ico files have been designed with 16, 22, 32, 64, etc so they will always display properly. If you use 
		   Photoshop you'll need an .ico converter, Telegraphics offers a free add-on: http://www.telegraphics.com.au/sw/
	
		
	** Upcoming Features **
	1. Menus: Administrative - Add submenus to existing administration menus (release date: 02/01/2010).
	2. Updates - Handles automatic updates of new releases (release date: 02/01/2010).
	3. List, View and Edit Database a Table - Allows you to add, remove, edit, view data from a new database file (release date: 02/01/2010).
	4. Multiple Language Support - Samples in English, Spanish, and French (release date: 03/01/2010).
	5. Plugin Icon Selection - User will be allowed to select the main icon used throughout the plugin from a collection of 500+ icons. (release date: 02/01/2010).
	
    =============
   	INSTURCTIONS: 
   	=============
	1. Download the Plugin from this website. 
	2. Upload the `simple-wordpress-framework` folder to the `/wp-content/plugins/` directory
	3. Activate the Plugin through the 'Plugins' menu in WordPress
    4. When you have completed your Plugin you should:
		a) Remove all the comments I have provided, except for the one that gives me credit for creating this API/Framework.
		b) DO NOT REMOVE: GNU General Public License.
		c) DON'T BE GREEDY - share you Plugin with others through the WordPress Plugin library. ( http://wordpress.org/extend/plugins/about/ )

		NOTE: Icons: We have a full selection of color and greyscale 16 and 32 pixel 500+ Icons. They can be accessed directly though the plugin's website at 
		http://www.swpframework.com/icon-gallery . In the future we will provide a section in the framework that will allow you to select the icons that will
		be used in the plugin. 


	=======================================
	WordPress Default Constants & Functions
	=======================================
	I am listing a few extremely important functions, and constants that you need throughout your Plugin. These increase the 
	compatibility of your Plugin.  I have also included links to the WordPress CODEX and Video library for your reference.
	
	"How 'NOT' to Build a WordPress Plugin", by Will Norris( http://wordpress.tv/2009/09/20/will-norris-building-plugins-portland09/ )
	Important Constants and Functions ( http://wpengineer.com/wordpress-return-url/ )
	
	Assigning URL's:
	=======================================
	- plugins_url();   - site_url();
	- content_url();   - admin_url();
	- includes_url();
	- get_bloginfo('template_url');
	
	CSS & JavaScript
	=======================================
	- wp_enqueue_script();	// ( http://codex.wordpress.org/Function_Reference/wp_enqueue_script )
	- wp_enqueue_style();	// ( http://codex.wordpress.org/Function_Reference/wp_enqueue_style )
	                            WordPress Codex: 
	
	Directories, Folders and Paths
	=======================================
	ABSPATH, WP_PLUGIN_DIR, WP_CONTENT_DIR
	
	Actions and Filters visit
	=======================================
	http://codex.wordpress.org/Plugin_API
	http://codex.wordpress.org/Plugin_API/Action_Reference
	http://codex.wordpress.org/Plugin_API/Filter_Reference
	
	WordPress: Release Archive ( Previous Versions of WordPress )
	==============================================================
	The WordPress site has a list of all the WordPress releases.  I suggest you test your Plugin with older versions.
	this API was tested to work with Version 2.6 and up.  We have not tested it with older versions, because the it used
	functions and constants that did not exist before that. 
	
	WordPress: Release Archive - ( http://wordpress.org/download/release-archive/ )

*/


// Sets up Plugin configuration and routing based on names of Plugin folder and files.

# define Plugin constants
define( 'SWPF_VERSION', "Beta 0.9.2");			#  Plugin database version: change this value every time you make changes to your plugin. 
define( 'SWPF_PURGE_DATA', '1' );		#  When plugin is deactivated, if 'true', all tables, and options will be removed.

define( 'WP_ADMIN_PATH', ABSPATH . 'wp-admin/');  // If you have a better answer to this Constant, feel free to send me an e-mail.  

define( 'SWPF_FILE', basename(__FILE__) );
define( 'SWPF_FILE_PATH', __FILE__);
define( 'SWPF_NAME', basename(__FILE__, ".php") );
define( 'SWPF_PATH', str_replace( '\\', '/', trailingslashit(dirname(__FILE__)) ) );
define( 'SWPF_URL', plugins_url('', __FILE__) );  // NOTE: It is recommended that every time you reference a url, that you specify the plugins_url('xxx.xxx',__FILE__), WP_PLUGIN_URL, WP_CONTENT_URL, WP_ADMIN_URL view the video by Will Norris.

require_once( SWPF_PATH . 'load-css-and-js.php' );
require_once( SWPF_PATH . 'functions.php' );
require_once( SWPF_PATH . 'menus.php' );
require_once( SWPF_PATH . 'pages/welcome.php' );
require_once( SWPF_PATH . 'pages/setup.php' );

register_activation_hook(__FILE__,'swpf_activate');  // WordPress Hook that executes the installation
register_deactivation_hook( __FILE__, 'swpf_deactivate' ); // WordPress Hook that handles deactivation of the Plugin.

?>