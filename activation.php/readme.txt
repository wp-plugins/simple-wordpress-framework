=== Simple WordPress Framework ===
Contributors: leonardomartinez
Donate link: http://www.swpframework.com/donation
Tags: framework, API
Requires at least: 1.7.6
Tested up to: 1.8.4
Stable tag: Beta 0.9.2.0 

A simple framework that helps programmers build Plugins quickly using the standards, functions, and classes that exist in the WordPress API Manual.

== Description ==

[Simple WordPress Framework](http://www.swpframework.com/) is a Plugin to help you create new Plugins.  Even though this is first version (Beta) of [Simple WordPress Framework](http://www.swpframework.com/), it is fully functional.  It was designed using the standards and requirements specified in the [WordPress Plugin API Manual](http://codex.wordpress.org/Plugin_API) and follows the correct programming structure, functions and procedures that are required to build a Plugin in WordPress.  In every PHP file you will find notes and urls referring to WordPress API articles that are relevant to each topic.

**What does this Plugin do?**

1. Helps new Plugin developers follow WordPress development standards.
1. Provide documentation, and URL references to WordPress API in the code.
1. Decreases the amount of time it takes to setup a new Plugin.

**What Plugin features are supported?**

* Activation - Adding options, and new database tables.
* Deactivation - Removing options and database tables created during activation.
* Menus: New - Create a new menu with submenus, separate from the admin menus.
* Options Page - A customized options page with additional CSS styles and samples of different `<input>` values (textarea, text, radio, checkbox, etc.) 
* Database Files - Manages the creation, updates, and removal of database files during activation, and deactivation.
* Use of AJAX/jQuery/JavaScript Components:<BR>[farbtastic](http://acko.net/dev/farbtastic) - Color Picker which allows you to select a color in a palate.<BR>[Facebox](http://famspam.com/facebox) - Facebook-style lightbox which can display images, divs, or entire remote pages.
* [500+ Icons](http://www.swpframework.com/icon-gallery/) - (16 x 16) and (32 x 32) icons can be [viewed](http://www.swpframework.com/icon-gallery/) from the plugin's website. All icons are currently included in the <code>/wp-content/plugins/swpframework/icons/</code> directory.


**Upcoming Features**

1. Menus: Administrative - Add submenus to existing administration menus (release date: 02/01/2010).
1. Updates - Handles automatic updates of new releases (release date: 02/01/2010).
1. List, View and Edit Database a Table - Allows you to add, remove, edit, view data from a new database file (release date: 02/01/2010).
1. Multiple Language Support - Samples in English, Spanish, and French (release date: 03/01/2010).
1. Plugin Icon Selection - User will be allowed to select the main icon used throughout the plugin from a collection of 500+ icons. (release date: 02/01/2010).
	
The [changelog](http://wordpress.org/extend/plugins/simple-wordpress-framework/changelog/) is a good place to start if you want to know what has changed since you last downloaded the Plugin.   If you would like to download previous versions, you may do so by clicking on [other versions](http://wordpress.org/extend/plugins/simple-wordpress-framework/download/). 

If you are interested in helping improve the code, develop more features, or want to contribute to the documentation, please feel free to [contact](http://www.swpframework.com/contact/) me.  


== Installation ==

After intalling and activating Simple WordPress Framework, you can immediately create a sample plugin by clicking on the **Create Sample Plugin** button located on the [Simple WordPress Framework](http://www.swpframework.com/) home page.  This new plugin will be called, <code>myPlugin</code>. Once you are ready to create a real plugin, you can either click on the **Create New Plugin** button, or simply modify the sample plugin, <code>myPlugin</code> and change any of the options to customized your plugin.

But we recommend that you customize it bas described below, before you begin using it in a live setting.

1. Download the Plugin from this website. 
1. Upload the `simple-wordpress-framework` folder to the `/wp-content/plugins/` directory
1. Activate the Plugin through the 'Plugins' menu in WordPress

NOTE: Icons: We have a full selection of [500+ Icons](http://www.swpframework.com/icon-gallery/) in both color and greyscale 16 and 32 pixel that can be [downloaded](http://www.swpframework.com/icon-gallery/) from the [swpframework.com](http://www.swpframework.com/icon-gallery/) website. 


Make sure you change your new plugin's *VERSION NUMBER* every time you make changes to the Plugin.  The framework keeps track of version updates and uses the information to make all necessary changes to option and the database files.


== Frequently Asked Questions ==

= Can I help you develop this framework/Plugin? =

Yes, at this point, we are open to anyone with experience who can provide us with assistance in making this Plugin better.  Just [send](http://www.swpframework.com/contact) me a message.

= How to ask a question? =

Click [here](http://www.swpframework.com/contact) and ask me a question.

= Why is the FAQ empty? =

This plugin was recently released in October 2009.  Please [send](http://www.swpframework.com/contact) any questions you have and I may post them on the FAQ.


== Screenshots ==

There are currently no screenshots.
1. Administration Welcome Page
2. Administration Setup & Configuration
3. Framework Plugin: Welcome Page, Sublevel Page #1, Sublevel Page #2
4. Framework Plugin: Options Page

== Changelog ==

= Beta 0.9.2 - 04/25/2010 =
* New: Simplified setup/installation Process.  You no longer are required to manually rename files and find/replace text throught the plugin.
* New: Setup Options Menu: provides all the options, and input values required to setup and create a new plugin.
* New: Home Page allows you to: Create a demo/sample plugin
* New: Home Page allows you to: Create a new plugin
* New: Home Page allows you to: Modify a previouly created plugin.
* New: Home Page Plugin List - This list provides you with the option to modify existing framework plugins located in the <code>/wp-content/plugins/</code> Directory. It will scan the contents of this directory and list all SWPF plugins.  The list will display: Plugin Name, Creation Date, Modified Date, and SWPF Version. SWPF Version is the version of SWPF that the framework plugin was created on.  If the plugin was created with an older version of SWPF it will not allow you to make changes.  Please read [upgrade notice](http://wordpress.org/extend/plugins/simple-wordpress-framework/upgradenotice/).   
* New: Facebox - Facebook-style lightbox which can display images, divs, or entire remote pages (http://famspam.com/facebox).
* Update: Database Files - Manages the creation, updates, and removal of database files during activation, and deactivation.
* Removed: The 500+ Icons are no longer available inside the WordPress Pulgin.  It was removed because uncompressing the framework took too long.  You can download them from our plugin website:  [Icon Gallery](http://www.swpframework.com/icon-gallery/)

= Beta 0.9.1 - 10/18/2009 =
* The previous release had serveral issues.  This release is now stable, and the only thing that really needs work is the documentation.  I will continue working on documenting all aspects discussed in this file throughout the week, and will have a fully documented version of the Plugin by November 15, 2009.

= Beta 0.9.0 - 10/10/2009 =
* First Release, it is in Beta, and should be available as version 1.0.0 on March 1st, 2010.  Please do not rate this Plugin, since it's just in the beginning stages of its release.  I would appreciate as much help as possible, even if it's an e-mail telling me about a spelling mistake, grammatical error, description change or even a change in the code.  This is a simple program, and it was intentionally design without PHP Class structures for both beginner and advanced programmers who simply want to create something quickly.


== Upgrade Notice == 
Updates are not backward compatible.  Each plugin version is unique, and will not support previous releases.  If you wish to make changes to a plugin previously created, do so with the Framework Version that it was created on.  You can download previous releases of [Simple WordPress Framework](http://www.swpframework.com/) by going to our webiste <code>swpframework.com</code> and choosing <code>Downloads</code>.  This Framework is currently under development, and has been designed to assit you in the initial stages of creating your plubin.  We also discourage anyone from using this plugin to modify plugins that have significant modifications.  

