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
		a) farbtastic -  Is a Color Picker which allows you to select a color in a palate. (http://acko.net/blog/farbtastic-color-picker-released)
		b) 500+ Icons - 16 x 16 and 32 x 32 that can be used in your Plugin.  214 Tango Theme Icons (16 x 16) and (32 x 32) from 
		   FreeDesktop.org ( http://tango.freedesktop.org/Tango_Icon_Library ). There are plenty of icons available on the web, 
		   all you have to do is search for them.  The best resolution comes from icons that are "*.ico" files.  This is because 
		   Icons from .ico files have been designed with 16, 22, 32, 64, etc so they will always display properly. If you use 
		   Photoshop you'll need an .ico converter, Telegraphics offers a free add-on: http://www.telegraphics.com.au/sw/
	6.	Data Entry/List Page - Allows you to Add, Remove, Edit, View data from the database file.  Also offers customized CSS settings
		to improve the appearance of the layout.

	** Upcoming Features **
	1. Menus: Administrative - Add submenus to existing administration menus.  (release date: 11/01/2009).
	2. Updates - Handles automatic updates of new releases (release date: 11/01/2009).
	3. List, View and Edit Database a Table - Allows you to add, remove, edit, view data from a new database file.  (Release date: 11/01/2009).


   =============
   INSTURCTIONS: 
   =============
	Even though this Plugin works without making changes, you need to customize it before you can begin.  Follow the steps below
	before you begin adding your own code.
	
	1.	Change the Standard Plugin Information Header at the beginning of the `swpframework.php` file, 
		between lines 3 through 8.  A detailed explanation on how to do this can be found in this 
		article: http://codex.wordpress.org/Writing_a_Plugin#File_Headers 
	2.	Choose a <TITLE> for your Plugin, the current <TITLE> for this Plugin is 'SWP Framework'.  You can 
		give it any name you want, 'Customer List', 'Time-Slips', 'The Weather Forecaster', etc. 
	3.	Choose a <FILE/FUNCTION> name for this Plugin, the current name is 'swpframework'.  Make sure you
		use lower case letters, keep it as short as possible, and remove all special characters and spaces 
		from it.  Following the <TITLE> examples above, you could use, 'customerlist', 'timeslips', 'weatherforcaster'.
	4.	Use your PHP editor and perform the following tasks to all the files within you Plugin directory.  
		- Perform a 'Find and Replace' with 'Match Case' checked, and replace 
		  all instances of 'SWP Framework' with the new <TITLE> of your 
		  Plugin.  This <TITLE> is used throughout the Plugin for error messages, 
		  alerts, and notes.
		- Perform a 'Find and Replace' with 'Match Case' checked, and replace all 
		  instances of 'swpframework' with the new NAME of your Plugin.
	5. 	Rename the file names below with your new <FILE/FUNCTION> name.
		- 'swpframework.php' --> <FILE/FUNCTION>.php
		- 'swpframework_farbtastic.js' -> <FILE/FUNCTION>_farbtastic.js
	6.	Icons: the '/swpframework/images' directory contains four 'icon' folders that occupy about 13MB of space.  
		We recommend that you move all the icons used in your Plugin from these folders to the '/swpframework/images' 
		directory. Then remove the 'icon.html' file, and all the 'icon' folders that are in the 'images' directory.  
		They have been placed there for your reference, and SWP Framework does not use them.  
	7. 	Upload the 'swpframework' folder to the '/wp-content/plugins/' directory
	8. 	Rename the 'swpframework' of this Plugin from 'swpframework' with your new <FILE/FUNCTION> name.
	9. 	Activate the Plugin through the 'Plugins' menu in WordPress
   10. 	When you have completed your Plugin you should:
		a) Remove all the comments I have provided, except for the one that gives me credit for creating this API/Framework.
		b) DO NOT REMOVE: GNU General Public License.
		c) DON'T BE GREEDY - share you Plugin with others through the WordPress Plugin library. ( http://wordpress.org/extend/plugins/about/ )


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
define( 'MYPLUGIN_VERSION', "1.1");						#  Plugin Database Version: Change this value every time you make changes to your Plugin. 
define( 'MYPLUGIN_PURGE_DATA', '1' );				#  When Plugin is deactivated, if 'true', all Tables, and Options will be removed.

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


register_activation_hook(__FILE__,'swpframework_activate');  // WordPress Hook that executes the installation

register_deactivation_hook( __FILE__, 'swpframework_deactivate' ); // WordPress Hook that handles deactivation of the Plugin.

add_action('plugins_loaded', 'swpframework_activate' );   // check for updates from previous versions.

?>