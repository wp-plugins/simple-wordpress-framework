=== Simple WordPress Framework ===
Contributors: Leonardo Martinez
Donate link: http://www.swpframework.com/donation
Tags: framework, API
Requires at least: 1.7.6
Tested up to: 1.8.4
Stable tag: 0.9.0

A simple framework that helps programmers builds Plugins quickly using the standards, functions, and classes that exist in the WordPress API Manual.

== Description ==

[Simple WordPress Framework](http://www.swpframework.com/) is a Plugin to help you create new Plugins.  It was designed by using the standards and requirements specified in the [WordPress Plugin API Manual](http://codex.wordpress.org/Plugin_API).  It has the correct programming structure, functions and procedures that are required to build a plugin in WordPress.  In every PHP file you will find notes and urls referring to the WordPress API articles that are relevant.

1. Helps new plugin developers follow WordPress development standards.
1. Provide documentation, and URL references to WordPress API in the code.
1. Decreases the amount of time it takes to setup a new plugin.

**This framework has the following plugin features:**

1. Activation - Adding options, and new database tables.
1. Deactivation - Removing options and database tables created during activation.
1. Menus: New - Create a new menu with submenus, separate from the admin menus.
1. Options Page - A customized options page with additional CSS styles and samples of different `<input>` values (textarea, text, radio, checkbox, etc.) 
1. Use of AJAX/JavaScript Components:
   <ul>
     <li>farbtastic -  Color Picker which allows you to select a color in a palate.</li>
   </ul>
1. 500+ Icons 16 x 16 and 32 x 32 that can be used in your plugin.

**Upcoming features:**

1. Menus: Administrative - Add submenus to existing administration menus.  (release date: 11/01/2009).
1. Updates - Handles automatic updates of new releases (release date: 11/01/2009).
1. List, View and Edit Database a Table - Allows you to add, remove, edit, view data from a new database file.  (release date: 11/01/2009).

This is the first version of Simple WordPress Framework. It is fully functional and can be used to develop your plugins.  Simply download the file, follow the installation instructions, and you will have a fully functional plugin.

The [changelog](http://svn.wp-plugins.org/swpframework/trunk/changelog.txt) is a good place to start if you want to know what has changed since you last downloaded the plugin.


If you are interested in helping improve the code, develop more features, or want to contribute to the documentation, please feel free to [contact](http://www.swpframework.com/contact/) me.  



== Installation ==

This plugin works without you having to make any changes. But we recommend that you customize it as described below, before you begin using it in a live setting.

1. Change the [Standard Plugin Information Header](http://codex.wordpress.org/Writing_a_Plugin#File_Headers) at the beginning of the `swpframework.php` file, between lines 3 through 8.  Read the [WordPress API](http://codex.wordpress.org/Writing_a_Plugin#File_Headers) article, it provides a detailed explanation on how to do this. 
1. Choose a **`title`** for your plugin, the current title for this plugin is `'SWP Framework'`.  You can give it any name you want, `'Customer List'`, `'Time-Slips'`, `'The Weather Forecaster'`, etc. 
1. Choose a **`file/function name`** for this plugin, the current name is `swpframework`.  Make sure you use lower case letters, keep it as short as possible, and remove all special characters and spaces from it.  Following the **`title`** examples above, you could use, `'customerlist'`, `'timeslips'`, `'weatherforcaster'`.
1. Use your PHP editor and perform the following tasks to all the files within you plugin directory.  <ul><li>Perform a 'Find and Replace' with 'Match Case' checked, and replace all instances of '`SWP Framework`' with the new **`title`** of your plugin.  This title is used throughout the plugin for error messages, alerts, and notes.</li><li>Perform a 'Find and Replace' with 'Match Case' checked, and replace all instances of '`swpframework`' with the new **name** of your plugin.</li></ul>
1. Rename '`swpframework.php`' to your new **`file/function name.php`**.
1. Rename the following file names inside the plugin directory from '`swpframework_`' to **`file/function name_`**.<BR><ul><li>`swpframework_farbtastic.js`</li></ul>
1. Icons: the '`/swpframework/images`' directory contains four '`icon`' folders that have about 13MB of icons.  We recommend that you move all the icons used in your plugin from these folders to the '`/swpframework/images`' directory. Then remove the `icon.html` file, and all the `icon` folders that are in the `images` directory.  They have been placed there for your reference, and SWP Framework does not use them.  
1. Rename the directory of this plugin from '`swpframework`' to your new **`file/function name`**.
1. Upload the '`swpframework`' folder to the '`/wp-content/plugins/`' directory
1. Activate the plugin through the 'Plugins' menu in WordPress

Make sure you change the *VERSION NUMBER* every time you make changes to the plugin.

== Frequently Asked Questions ==

= Can I help you develop this framework/plugin? =

Yes, at this point, we are open to anyone with experience who can provide us with assistance in making this plugin better.  Just [send](http://www.swpframework.com/contact) me a message.

= How to ask a question? =

Click [here](http://www.swpframework.com/contact) and ask me a question.

= Why is the FAQ empty? =

We just released the website, and I haven't received any questions.  Please [send](http://www.swpframework.com/contact) me all the questions you want and I may post them on the FAQ.


== Screenshots ==

There are currently no screenshots.



== Changelog ==

= 0.9.0 =
* First Release, it is in Beta, and should be available as version 1.0.0 on November 1st, 2009.


== A brief Markdown Example ==

**Ordered list:**

1. Helps new plugin developers follow WordPress development standards.
1. Provide documentation, and url references to WordPress API in the code.
1. Decrease the amount of time it takes to setup a new plugin.

**Features**

1. Activation - Adding options, and new database tables.
1. Deactivation - Removing options and database tables created during activation.
1. Menus: New - Create a new menu with submenus, separate from the admin menus.
1. Options Page - A customized options page with additional CSS styles and samples of different `<input>` values (textarea, text, radio, checkbox, etc.) 
1. Use of AJAX/JavaScript Components:
   <ul>
     <li>farbtastic -  Color Picker which allows you to select a color in a palate.</li>
   </ul>
1. 500+ Icons 16 x 16 and 32 x 32 that can be used in your plugin.

**Upcoming features:**

1. Menus: Administrative - Add submenus to existing administration menus.  (release date: 11/01/2009).
1. Updates - Handles automatic updates of new releases (release date: 11/01/2009).
1. List, View and Edit Database a Table - Allows you to add, remove, edit, view data from a new database file.  (Release date: 11/01/2009).
