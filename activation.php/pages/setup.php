<?php 

/*
Setup & Configuration
========================
This setup page is used to automate the process of customizing your new Plugin.
It will do the following:

1. Change the Standard Plugin Information Header (http://codex.wordpress.org/Writing_a_Plugin#File_Headers).
2. Choose a 'title' for your Plugin, the current title for this Plugin is `SWP Framework`.
3. Choose a 'file/function' name for this Plugin, the current name is `swpframework`.
4. Use your PHP editor and perform the following tasks to all the files within you Plugin directory.<ul><li>
5. Replaces all instances of `SWP Framework` with the new `title` of your Plugin.  This `title` is used throughout the Plugin for error messages, alerts, and notes.
4. Replaces all instances of `swpframework` with the new name of your Plugin.</li>
5. Renames the folloing file names below with your new `file/function` name.
-  swpframework.php` --> `file/function`.php</li>
-  swpframework.farbtastic.js --> `file/function`.farbtastic.js

*/


/*
Read Creating Option Pages - WordPress Codex: http://codex.wordpress.org/Creating_Options_Pages

Wordpress handles the management of options automatically.  We have made this so it will be easy for you
to add options to your plugin.  The code has been created to handle multiple option pages, so feel free
to create additional option pages using this sample.
*/


/**
 * swpf_setup_page_options()
 * 
 * Defines all the options used that are used in the <form> on this page.
 * 
 * Note: There are procedures that run inside the swpf_options_html <form> that do the following:
 *       1) Automatically extract the values for each element in the array so they can be used as variables. 
 *       2) Automatically creates the hidden <input> 'option_page' and 'action'. Sets their values 
 * 			so Wordpress can handle saving the values in the option page automatically.
 * 			
 * 
 * swpf_setup_page_options_excluded()
 * 
 * Excludes all the options used above that will not be displayed in the form on this page.
 * Note: If you are not using one or more of the options listed above, you must specify them in this array
 *       otherwise their values will be reset to blank or zero.  If you don't want to create an exception, 
 *       then you must create an invisible <input> and add the current value to it inside the form. 
 */

swpf_setup_page_options();

function swpf_setup_page_options() {

	include(SWPF_PATH . '/MyPlugin/swpf.php');

	swpf_merge_all_options( $options );

	return $options;
}


swpf_setup_page_options_excluded();

function swpf_setup_page_options_excluded() {

	$options_excluded = array();

	return $options_excluded;

}


function swpf_setup_page_submenu() {

	swpf_setup_page_html(); 	// display the options page.
}


/**
 *  Copy the sample MyPlugin file to the plugin directory.
 */
function swpf_setup_copy_myplugin_dir( $source, $destination ) {

	if ($source !== $destination ) {
		smartCopy( $source, $destination );
	}
}


/**
 *  Clean up all SWPFramwork files
 */
function swpf_setup_cleanup( $options ) {

	$messages = array();

	$options_previous = $options;
	$options_new = swpf_get_options( $options );

	$plugin_directory_new = WP_PLUGIN_DIR . '/' . $options_new['swpf_setup_plugin_directory_name'];
	$plugin_directory_previous = WP_PLUGIN_DIR . '/' . $options_previous['swpf_setup_plugin_directory_name'];

	$plugin_name = $options_new['swpf_setup_plugin_name'];

	if ((is_dir( $plugin_directory_previous ))) {
		/**
		 *  Existing Plugin: Rename the existing plugin located in the
		 *  $source directory to the new $plugin_directory_new directory name.
		 */
		swpf_setup_rename_files ( $plugin_directory_previous, $plugin_directory_new ); // renames the previous directory to the new directory name.

		$messages['plugin-updated'] = '<div id="message" class="updated fade"><p style="line-height:130%;"><strong>' . sprintf( _c( 'Update Sucessful: ' ) ) . '</strong>' . "'$plugin_name' " . sprintf( _c( 'Information, Files, Headers, Names, and Locations have been modified.' ) ) . '</p></div>';

	} else {
		/**
		 * Create New Plugin using the the 'MyPlugin' Template located inside
		 * the swpframework directory.
		 * the swpframework directory.
		 */

		if (is_dir( $plugin_directory_new )) { # $plugin_directory_new is a directory then we cannot create this new plugin because it conflicts with an existing plugin.
			$messages['plugin-exists'] = '<div id="message" class="error"><p style="line-height:130%;">' . sprintf( _c( '<B>This plugin already exists.</B><BR>Before you can create a new plugin, you must change the <i>Plugin Directory Name</i> or <code>Delete</code> the conflicting plugin from the <a href="plugins.php">Manage Plugins</a> list.' ) ) . '</p></div>';
			return $messages;
			exit;
		}

		$source = SWPF_PATH . 'MyPlugin'; // default template plugin directory

		swpf_setup_copy_myplugin_dir( $source, $plugin_directory_new ); // copies the complete directory to destination

		$messages['plugin-created'] = '<div id="message" class="updated fade"><p style="line-height:130%;"><strong>' . sprintf( _c( 'New Plugin Created:' ) ) . '</strong>' . sprintf( _c( '  A new plugin called, '))."<code>$plugin_name</code>".sprintf( _c( ' was created and added to your WordPress plugin directory.' ) ) . '</p></div>';

		$options_new['swpf_setup_version'] 	= SWPF_VERSION;
		$options_new['swpf_setup_plugin_date_created'] 	= date("m-d-Y");
	}

	$options_new['swpf_setup_plugin_date_modified'] = date("m-d-Y");

	/**
	 * 	Apply new chagnes/modifications to the $plugin_directory_new plugin directory.
	 */
	foreach ( $options_new as $key => $value ) {

		$value_previous = $options_previous[$key];

		if ( $value_previous !== $value ) {

			swpf_setup_cleanup_files ($key, $value_previous, $value, $plugin_directory_new);
		}
	}

	return $messages;
}


function swpf_setup_cleanup_files ( $fieldname, $search, $replace, $directory ) {

	switch ( $fieldname ) {
		case 'swpf_setup_plugin_file_name':

			$search = str_ireplace('.php', '', $search );
			$replace = str_ireplace('.php', '', $replace );

			swpf_setup_rename_files ( $directory.'/'.$search.".php", $directory.'/'.$replace.".php" );
			swpf_setup_searchandreplace ( $search.".php", $replace.".php", $directory );

			swpf_setup_rename_files ( $directory . "/widgets/$search".".farbtastic.js", $directory . "/widgets/$replace".".farbtastic.js" );
			swpf_setup_searchandreplace ( "$search.farbtastic.js", "$replace.farbtastic".".js", $directory );

			swpf_setup_rename_files ( $directory . "/widgets/jquery-validate/$search".".validate.js", $directory . "/widgets/jquery-validate/$replace.validate.js" );
			swpf_setup_searchandreplace ( $search.".validate.js", $replace.".validate.js", $directory );
			break;

		case 'swpf_setup_plugin_function_prefix':
			swpf_setup_searchandreplace ( $search.'_', $replace .'_', $directory ); // replaces: "swpf_" with the replace value "xxxxx_"
			swpf_setup_searchandreplace ( "'$search'", "'$replace'", $directory );  // replaces: "'swpf'" with "'xxxx'"
			swpf_setup_searchandreplace ( $search.'-', $replace .'-', $directory ); // replaces: "swpf-" with the replace value "xxxxx-"
			swpf_setup_searchandreplace ( strtoupper($search).'_', strtoupper($replace) .'_', $directory ); // replaces: "swpf-" with the replace value "xxxxx-"
			break;
		case 'swpf_setup_plugin_version':
			$search = "Version: $search";
			$replace = "Version: $replace";
			swpf_setup_searchandreplace ( $search, $replace, $directory );
			break;
		case 'swpf_setup_readme_contributors':
			$search = "Contributors: $search";
			$replace = "Contributors: $replace";
			swpf_setup_searchandreplace ( $search, $replace, $directory );
			break;
		case 'swpf_setup_readme_donatelink':
			$search = "Donate link: $search";
			$replace = "Donate link: $replace";
			swpf_setup_searchandreplace ( $search, $replace, $directory );
			break;
		case 'swpf_setup_readme_tags':
			$search = "Tags: $search";
			$replace = "Tags: $replace";
			break;
		case 'swpf_setup_readme_requiresatleast':
			$search = "Requires at least: $search";
			$replace = "Requires at least: $replace";
			swpf_setup_searchandreplace ( $search, $replace, $directory );
			break;
		case 'swpf_setup_readme_testedupto':
			$search = "Tested up to: $search";
			$replace = "Tested up to: $replace";
			swpf_setup_searchandreplace ( $search, $replace, $directory );
			break;
		case 'swpf_setup_readme_stabletag':
			$search = "Stable tag: $search";
			$replace = "Stable tag: $replace";
			swpf_setup_searchandreplace ( $search, $replace, $directory );
			break;
		case 'swpf_setup_plugin_date_created':
			$search = "'swpf_setup_plugin_date_created' => '$search'";
			$replace = "'swpf_setup_plugin_date_created' => '$replace'";
			swpf_setup_searchandreplace_file ( $search, $replace, $directory.'/swpf.php' );
			break;
		case 'swpf_setup_plugin_date_modified':
			$search = "'swpf_setup_plugin_date_modified' => '$search'";
			$replace = "'swpf_setup_plugin_date_modified' => '$replace' ";
			swpf_setup_searchandreplace_file ( $search, $replace, $directory.'/swpf.php' );
			break;
		case 'swpf_setup_version':
			$search = "'swpf_setup_version' => '$search'";
			$replace = "'swpf_setup_version' => '$replace'";
			swpf_setup_searchandreplace_file ( $search, $replace, $directory.'/swpf.php' );
			break;
		case 'swpf_setup_plugin_directory_name_previous':
			$search = "'swpf_setup_plugin_directory_name_previous' => '$search'";
			$replace = "'swpf_setup_plugin_directory_name_previous' => '$replace'";
			swpf_setup_searchandreplace_file ( $search, $replace, $directory.'/swpf.php' );
			break;

		case 'swpf_setup_plugin_name':
		case 'swpf_setup_plugin_uri':
		case 'swpf_setup_plugin_description':
		case 'swpf_setup_plugin_author':
		case 'swpf_setup_plugin_author_uri':
		case 'swpf_setup_plugin_directory_name':
		default:
			swpf_setup_searchandreplace ( $search, $replace, $directory );
	}
}


function swpf_setup_rename_files ( $oldname, $newname )
{
	@rename( $oldname, $newname );
}

function swpf_setup_searchandreplace_file ( $search, $replace, $file, $case = 1 ) {

	$obj = new TextSearch();
	$obj->setExtensions(array('html','txt', 'php', 'js', 'css')); //setting extensions to search files within
	$obj->setSearchKey($search, $case );
	$obj->setReplacementKey($replace);  		//setting replacement text if you want to replace matches with that
	$obj->searchFileData($file); 		//search file data
	$obj->writeLogToFile("setup-errors.txt");	//writting result to log file
}


function swpf_setup_searchandreplace ( $search, $replace, $directory, $case = 1 ) {

	$obj = new TextSearch();
	$obj->setExtensions(array('html','txt', 'php', 'js', 'css')); //setting extensions to search files within
	$obj->setSearchKey($search, $case );
	$obj->setReplacementKey($replace);  		//setting replacement text if you want to replace matches with that
	$obj->startSearching( $directory );		//starting search
	$obj->writeLogToFile("setup-errors.txt");	//writting result to log file
}


/**
 *
 * Displays the HTML code for this page
 *
 */
function swpf_setup_page_html() {

	$messages = array();

	$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
	$updated = isset($_REQUEST['updated']) ? $_REQUEST['updated'] : '';
	$plugin = isset($_REQUEST['plugin']) ? $_REQUEST['plugin'] : get_option('swpf_setup_plugin_directory_name_previous');

	switch ($action) {

		case ('new'): // Create New Plugin Button was selected, load it's options into the options page.
			$options = swpf_setup_page_options();
			swpf_update_options( $options );
			$_SERVER['REQUEST_URI'] = remove_query_arg(array('action'), $_SERVER['REQUEST_URI']);
			break;

		case ('modify'): // A Previous Plugin was selected, load it's options into the options page.
		if (empty($updated)) {
			$file = $plugin;
			$swpf_file = WP_PLUGIN_DIR.'/'.$file.'/swpf.php';
	
			if (is_file( $swpf_file )) {
				require( $swpf_file );
				swpf_update_options( $options );
			} else {
				$messages['plugin-missing'] = '<div id="message" class="error"><p style="line-height:130%;">' . sprintf( _c( '<b>Attention:</b> SWPFramework cannot modify this plugin.  The plugin you have requested does not exit.  It is possible that the plugin was removed, modified, or deleted.' ) ) . '</p></div>';
			}
		}
			break;
	}

	
	if ($updated) {

		$file = $plugin;
		$swpf_file = WP_PLUGIN_DIR.'/'.$file.'/swpf.php';

		if (is_file( $swpf_file )) {
			include( $swpf_file );
		} else {
			include( SWPF_PATH . '/MyPlugin/swpf.php');
		}

		require_once( SWPF_PATH . 'widgets/textsearch.class.php');
		$messages = swpf_setup_cleanup( $options );

	}
			
	foreach( $messages as $message ) {
		echo $message;
	}

?>
  	<div class="wrap">
  		
	<?php swpf_header_icon(); ?><h2>SWP Framework Setup & Configuration</h2>

	<?php
	if (($messages['plugin-missing']) or ( $messages['plugin-updated']) or ( $messages['plugin-created'])) {
		include_once('include-welcome.php');
	} else {
		 if (empty($action) and empty($updated) ) { include_once('include-welcome.php'); } else { ?>
		 
		 
	<form method="post" id="commentform" action="options.php" enctype="multipart/form-data" name="post">

		<?php wp_nonce_field('update-options'); ?>
		
		<p>
			Complete the fields below to customize your new plugin. Once you have entered all the information, click on the Create New Plugin button. 
		    If you would like to know more about the fields below, click on the exclamation <a class="help-label" href="#sample-popup" rel="facebox"><img style="padding:0px;" class="help-label" alt="click for more info" src="<?php echo plugins_url('images/information.png', SWPF_FILE_PATH); ?>"></a> 
		    and a pop-up will display details of what each does.
		</p>
		<div id="sample-popup" style="display:none;">
		    <h3>Sample Popup</h3>
			<p>You clicked on the exclamation mark.  Click on any of the exclamation marks below to read more about each field.</p>
		</div>

		<!-- File Headers: Standard Plugin Information Header -->
		<h2>File Headers: Standard Plugin Information</h2>

		<p>
			At the top of your main Plugin File Name, <code><?php echo get_option('swpf_setup_plugin_file_name'); ?></code> you will find the <a href="http://codex.wordpress.org/Writing_a_Plugin#File_Headers" target="_new" ><b>Standard Plugin Information Header</b></a>. This header lets WordPress 
			recognize that your Plugin exists.  The information below specifies the settings for your plugin header and other areas as well.
		</p>
		<p>
			Take your time in choosing your plugin name. You can use either a long name or a short one.  Once you have decided on the name
			you will need to decide on a file name.  This is the name given to the primary php file used by your WordPress' plugin manager. 
			Make sure you use the UNIX standard file naming conentions.
		</p>
		<!-- End: File Headers: Standard Plugin Information Header -->		
		
		<table class="form-table">
		
			<td><br class="clear" /></td>				
								
			<!-- Start: Plugin Name -->
			<tr valign="top">
				<th scope="row">
					<label for="swpf_setup_plugin_name">
						<a class="help-label" href="#pluginname" rel="facebox">Plugin Name:</a>		
					</label>
					<div id="pluginname" style="display:none;">
					    <h3><span class="mw-headline">Plugin Name </span></h3>
						<p>The first task in creating a WordPress Plugin is to think about what the Plugin will do, and make a (hopefully unique) name for your Plugin.</p>
						<p>Check out <a href="http://wordpress.org/extend/plugins/" target="_new" title="Plugin Repository">Plugins</a> and the other repositories it refers to, to verify that your name is unique; you might also do a Google search on your proposed name. Most Plugin developers choose to use names that somewhat describe what the Plugin does; for instance, a weather-related Plugin would probably have the word "weather" in the name. The name can be multiple words.</p>
					</div>
				</th>
				<td>
					<a href="#pluginname" rel="facebox"><img class="help-img-input" alt="click for more info" src="<?php echo plugins_url('images/information.png', SWPF_FILE_PATH); ?>"></a>
					<input tabindex="1" size="75%" name="swpf_setup_plugin_name" class="required" value="<?php echo get_option('swpf_setup_plugin_name'); ?>"/>
				</td>
			
			</tr>
			<!-- End: Plugin Name -->
			
			<!-- Start: Plugin File Name -->
			<tr valign="top">
				<th scope="row">
					<label for="swpf_setup_plugin_file_name">
						<a class="help-label" href="#plugin_file_name" rel="facebox">Plugin File Name:</a>
					</label>
					<div id="plugin_file_name" style="display:none;">
					    <h3>Plugin File Name</h3>
						<p><b>NOTE:</b> This value is case sensitive and must be different than the <b>Plugin Diretory Name</b> and the <b>Function & Variable Prefix</b>.  You can use upper and lower case letters to distinguish them from one another.</p>
						<p>The next step is to create a PHP file with a name derived from your chosen Plugin name. For instance, if your Plugin will be called "Fabulous Functionality", you might call your PHP file <tt>fabfunc.php</tt>. Again, try to choose a unique name. People who install your Plugin will be putting this PHP file into the WordPress Plugin directory in their installation, <tt>wp-content/plugins/</tt>, so no two Plugins they are using can have the same PHP file name.</p>
						<p>In the rest of the documentation, "the Plugin PHP file" refers to the main Plugin PHP file, whether in <tt>wp-content/plugins/</tt> or a sub-directory.</p>
					</div>
				</th>
				<td >
					<a href="#plugin_file_name" rel="facebox"><img class="help-img-input" alt="click for more info" src="<?php echo plugins_url('images/information.png', SWPF_FILE_PATH); ?>"></a>
					<input tabindex="2" type="text"  name="swpf_setup_plugin_file_name" value="<?php echo get_option('swpf_setup_plugin_file_name'); ?>"/>
				</td>
			</tr>
			<!-- End: Plugin File Name -->	
						
			<!-- Start: Plugin URI -->
			<tr valign="top">
				<th scope="row">
					<label for="swpf_setup_plugin_uri">
						<a class="help-label" href="#pluginuri" rel="facebox">Plugin URI:</a>
					</label>
					<div id="pluginuri" style="display:none;">
					    <h4>Plugin URI</h4>
					    <p>The  name of the URL where you plugin is hosted.&nbsp;&nbsp;If you don't have a website, provide the <i>wordpress.org</i> URL given to your new plugin.</p>
					    <p>If you don't have a <i>wordpress.org</i> URL, this would be a good time to get one.&nbsp;&nbsp;You'll first have to <a href="http://wordpress.org/extend/plugins/register.php"><b>Register</b></a> and then you will receive an e-mail with instructions on how to submit your Plugin to the <a href="http://wordpress.org/extend/plugins/">WordPress Plugin Directory.</a></p>
					    <p>More information can be found in the WordPress API Manual at <a href="http://codex.wordpress.org/Plugin_Submission_and_Promotion"><b>Plugin Submission and Promotion</b></a>.</p> 
					</div>
				</th>
				<td>
					<a href="#pluginuri" rel="facebox"><img class="help-img-input" alt="click for more info" src="<?php echo plugins_url('images/information.png', SWPF_FILE_PATH); ?>"></a>
					<input tabindex="3" type="text"  name="swpf_setup_plugin_uri" size="75%" value="<?php echo get_option('swpf_setup_plugin_uri'); ?>"/>
				</td>
			</tr>
			<!-- End: Plugin URI -->
			
			<!-- Start: Plugin Description -->
			<tr valign="top">
				<th scope="row">
					<label for="swpf_setup_plugin_description">
						<a class="help-label" href="#plugin_description" rel="facebox">Description <i>(short)</i>:</a>
					</label>
					<div id="plugin_description" style="display:none;">
					    <h4>Plugin Description</h4>
					    <p>A brief description that appears when you are managing the plugin under the admin plugin menu. See the image below:</p>
					</div>
				</th>
				<td>
					<a href="#plugin_description" rel="facebox"><img class="help-img-input" alt="click for more info" src="<?php echo plugins_url('images/information.png', SWPF_FILE_PATH); ?>"></a>
					<textarea rows="4" cols="64%" name="swpf_setup_plugin_description"><?php echo get_option('swpf_setup_plugin_description'); ?></textarea>
				</td>
			</tr>
			<!-- End: Plugin Description -->
			
			<!-- Start: Plugin Version -->
			<tr valign="top">
				<th scope="row">
					<label for="swpf_setup_plugin_version">
						<a class="help-label" href="#plugin_version" rel="facebox">Version:</a>
					</label>
					<div id="plugin_version" style="display:none;">
					    <h4>Plugin Version</h4>
					    <p>The Plugin's Version Number, e.g.: 1.0 or Beta 0.0.5</p>
					    <p>Your plugin will keep track of it's version numbers, if a change is detected, it will automatically update your options and database tables.</p>
					</div>
				</th>
				<td>
					<a href="#plugin_version" rel="facebox"><img class="help-img-input" alt="click for more info" src="<?php echo plugins_url('images/information.png', SWPF_FILE_PATH); ?>"></a>
					<input tabindex="4" type="text"  name="swpf_setup_plugin_version" value="<?php echo get_option('swpf_setup_plugin_version'); ?>"/>
				</td>
			</tr>
			<!-- End: Plugin Version -->
			
			<!-- Start: Plugin Author -->
			<tr valign="top">
				<th scope="row">
					<label for="swpf_setup_plugin_author">
						<a class="help-label" href="#plugin_author" rel="facebox">Author:</a>
					</label>
					<div id="plugin_author" style="display:none;">
					    <h4>Plugin Author</h4>
					    <p>The name of the Author or developer for this plugin.</p>
					</div>
				</th>
				<td>
					<a href="#plugin_author" rel="facebox"><img class="help-img-input" alt="click for more info" src="<?php echo plugins_url('images/information.png', SWPF_FILE_PATH); ?>"></a>
					<input tabindex="5" type="text" size="50%" name="swpf_setup_plugin_author" value="<?php echo get_option('swpf_setup_plugin_author'); ?>"/>
				</td>
			</tr>
			<!-- End: Plugin Author -->
			
			<!-- Start: Plugin Author URI -->    
			<tr valign="top">
				<th scope="row">
					<label for="swpf_setup_plugin_author_uri">
						<a class="help-label" href="#plugin_author_uri" rel="facebox">Author URI:</a>
					</label>
					<div id="plugin_author_uri" style="display:none;">
					    <h4>Plugin Author URI</h4>
					    <p>The URL for the Author mentioned above.  If you don't have one leave it blank.</p>
					</div>
				</th>
				<td>
					<a href="#plugin_author_uri" rel="facebox"><img class="help-img-input" alt="click for more info" src="<?php echo plugins_url('images/information.png', SWPF_FILE_PATH); ?>"></a>
					<input tabindex="6" type="text"  name="swpf_setup_plugin_author_uri" size="75%" value="<?php echo get_option('swpf_setup_plugin_author_uri'); ?>"/>
				</td>
			 </tr>
			 <!-- End: Plugin Author URI -->
			 
			 <td><br class="clear" /></td>

		</table>
			 
		<h2>File Headers: readme.txt</h2>

		<p>
			The <code>readme.txt</code> file allows the WordPress plugin directory to read If you plan to <a href="http://wordpress.org/extend/plugins/about/">publish</a> 
			or <a href="http://wordpress.org/extend/plugins/about/">host</a> your plugin at WordPress' <a href="http://wordpress.org/extend/plugins/">Plugin Directory</a>, 
			you need to create a <code>readme.txt</code> file that adheres to the <a href="http://wordpress.org/extend/plugins/about/readme.txt">WordPress/bbPress plugin readme file standard</a>.  
			Make sure that you check your <code>readme.txt</code> file with the <a href="http://wordpress.org/extend/plugins/about/validator/">readme validator</a> before it is published.  			
		</p>

			
		<table class="form-table">
			
			<!-- Start: readme.txt Contributors -->
			<tr valign="top">
				<th scope="row">
					<label for="swpf_setup_readme_contributors">
						<a class="help-label" href="#contributors" rel="facebox">Contributors:</a>
					</label>
					<div id="contributors" style="display:none;">
					    <h3><span class="mw-headline">Contributors</span></h3>
						<p>
							Enter the WordPress usernames for all the contributors of this plugin.  If you have not registered as a 
							Plugin developer, you may register at: <a href="http://wordpress.org/extend/plugins/register.php">WordPress Plugins Registration</a>
						do so </p>
					</div>
				</th>
				<td>
					<a href="#contributors" rel="facebox"><img class="help-img-input" alt="click for more info" src="<?php echo plugins_url('images/information.png', SWPF_FILE_PATH); ?>"></a>
					<input tabindex="7" type="text" size="75%" name="swpf_setup_readme_contributors" value="<?php echo get_option('swpf_setup_readme_contributors'); ?>"/>
				</td>
			
			</tr>
			<!-- End: readme.txt Contributors -->
			
			<!-- Start: readme.txt Donation Link -->    
			<tr valign="top">
				<th scope="row">
					<label for="swpf_setup_readme_donatelink">
						<a class="help-label" href="#donatelink" rel="facebox">Donate Link URI:</a>
					</label>
					<div id="donatelink" style="display:none;">
					    <h4>Donate Link URI</h4>
					    <p>If you would like to add a donation page to your plugin, enter the url here.</p>
					</div>
				</th>
				<td>
					<a href="#donatelink" rel="facebox"><img class="help-img-input" alt="click for more info" src="<?php echo plugins_url('images/information.png', SWPF_FILE_PATH); ?>"></a>
					<input tabindex="8" type="text"  name="swpf_setup_readme_donatelink" size="75%" value="<?php echo get_option('swpf_setup_readme_donatelink'); ?>"/>
				</td>
			 </tr>
			 <!-- End: readme.txt Donation Link -->
			
			<!-- Start: readme.txt Tags -->    
			<tr valign="top">
				<th scope="row">
					<label for="swpf_setup_readme_tags">
						<a class="help-label" href="#tags" rel="facebox">Tags:</a>
					</label>
					<div id="tags" style="display:none;">
					    <h4>Tags</h4>
					    <p>If you would like to add a donation page to your plugin, enter the url here.</p>
					</div>
				</th>
				<td>
					<a href="#tags" rel="facebox"><img class="help-img-input" alt="click for more info" src="<?php echo plugins_url('images/information.png', SWPF_FILE_PATH); ?>"></a>
					<input tabindex="9" type="text"  name="swpf_setup_readme_tags" size="75%" value="<?php echo get_option('swpf_setup_readme_tags'); ?>"/>
				</td>
			 </tr>
			 <!-- End: readme.txt Tags -->
			 
			<!-- Start: readme.txt Requires at Least -->    
			<tr valign="top">
				<th scope="row">
					<label for="swpf_setup_readme_requiresatleast">
						<a class="help-label" href="#requiresatleast" rel="facebox">Requires at Least:</a>
					</label>
					<div id="requiresatleast" style="display:none;">
					    <h4>Requires at Least</h4>
					    <p>Enter the the minimum version of WordPress that will work with your plugin.</p>
					</div>
				</th>
				<td>
					<a href="#requiresatleast" rel="facebox"><img class="help-img-input" alt="click for more info" src="<?php echo plugins_url('images/information.png', SWPF_FILE_PATH); ?>"></a>
					<input tabindex="10" type="text"  name="swpf_setup_readme_requiresatleast" value="<?php echo get_option('swpf_setup_readme_requiresatleast'); ?>"/>&nbsp;WordPress Version
				</td>
			 </tr>
			 <!-- End: readme.txt Requires at Least -->

			<!-- Start: readme.txt Stable Tag -->    
			<tr valign="top">
				<th scope="row">
					<label for="swpf_setup_readme_stabletag">
						<a class="help-label" href="#stable-tag" rel="facebox">Stable Tag:</a>
					</label>
					<div id="stable-tag" style="display:none;">
					    <h4>Requires at Least</h4>
					    <p>Enter the the most stable version of WordPress that will work with your plugin.</p>
					</div>
				</th>
				<td>
					<a href="#stable-tag" rel="facebox"><img class="help-img-input" alt="click for more info" src="<?php echo plugins_url('images/information.png', SWPF_FILE_PATH); ?>"></a>
					<input tabindex="12" type="text"  name="swpf_setup_readme_stabletag" value="<?php echo get_option('swpf_setup_readme_stabletag'); ?>"/>&nbsp;WordPress Version
				</td>
			 </tr>
			 <!-- End: readme.txt Stable Tag -->

			<!-- Start: readme.txt Tested Up To -->    
			<tr valign="top">
				<th scope="row">
					<label for="swpf_setup_readme_testedupto">
						<a class="help-label" href="#tested-up-to" rel="facebox">Tested Up To:</a>
					</label>
					<div id="tested-up-to" style="display:none;">
					    <h4>Requires at Least</h4>
					    <p>Enter the the maximum version of WordPress that will work with your plugin.</p>
					</div>
				</th>
				<td>
					<a href="#tested-up-to" rel="facebox"><img class="help-img-input" alt="click for more info" src="<?php echo plugins_url('images/information.png', SWPF_FILE_PATH); ?>"></a>
					<input tabindex="11" type="text"  name="swpf_setup_readme_testedupto" value="<?php echo get_option('swpf_setup_readme_testedupto'); ?>"/>&nbsp;WordPress Version
				</td>
			 </tr>
			 <!-- End: readme.txt Tested Up To -->
			 
 
			<td><br class="clear" /></td>

		</table>
		
		<h2>Names, Files, and Locations</h2>
		
		<table class="form-table">
					


			
			<!-- Start: Plugin Function Prefix -->     
			<tr valign="top">
				<th scope="row">
					<label for="swpf_setup_plugin_function_prefix">
						<a class="help-label" href="#plugin_function_prefix" rel="facebox">Function & Variable Prefix:</a>
					</label>
					<div id="plugin_function_prefix" style="display:none;">
					    <h3>Function, Variable & Identifier Prefix</h3>
						<p><b>NOTE:</b> This value is case sensitive and must be different than the <b>Plugin Name</b> and the <b>Plugin Directory Name</b>.  You can use upper and lower case letters to distinguish them from one another.<BR><BR>The prefix assigned to every Function, Variable and Identifier.&nbsp;&nbsp;In order to avoid confusing your variables with wordpress variables or identifiers, we have added prefixes to them.</p>
					</div>
				</th>
				<td>
						<a href="#plugin_function_prefix" rel="facebox"><img class="help-img-input" alt="click for more info" src="<?php echo plugins_url('images/information.png', SWPF_FILE_PATH); ?>"></a>
						<input tabindex="13" type="text"  name="swpf_setup_plugin_function_prefix" value="<?php echo get_option('swpf_setup_plugin_function_prefix'); ?>"/>
				</td>
			</tr>
			<!-- End: Plugin Function Prefix -->
			
			
			<!-- Start: Plugin Directory Name -->     
			<tr valign="top">
				<th scope="row">
					<label for="swpf_setup_plugin_directory_name">
						<a class="help-label" href="#plugin_directory_name" rel="facebox">Plugin Directory Name:</a>
					</label>
					<div id="plugin_directory_name" style="display:none;">
					    <h3>Plugin Directory Name</h3>
						<p><b>NOTE:</b> This value is case sensitive and must be different than the <b>Plugin Name</b> and the <b>Function & Variable Prefix</b>.  You can use upper and lower case letters to distinguish them from one another.<BR><BR>The current name assigned to diretory where the plugin resides.</p>
					</div>
				</th>
				<td>
						<a href="#plugin_directory_name" rel="facebox"><img class="help-img-input" alt="click for more info" src="<?php echo plugins_url('images/information.png', SWPF_FILE_PATH); ?>"></a>
						<input tabindex="14" type="text" size="50%" name="swpf_setup_plugin_directory_name" value="<?php echo get_option('swpf_setup_plugin_directory_name'); ?>"/>
				</td>
			</tr>
			<!-- End: Plugin Function Prefix -->
			
			<td><br class="clear" /></td>
						 
		</table>
		
		<input type="hidden" name="swpf_setup_plugin_directory_name_previous" value="<?php echo get_option('swpf_setup_plugin_directory_name'); ?>"/>
		<input type="hidden" name="swpf_setup_version" value="<?php echo get_option('swpf_setup_version'); ?>"/>
		<input type="hidden" name="swpf_setup_plugin_date_created" value="<?php echo get_option('swpf_setup_plugin_date_created'); ?>"/>
		<input type="hidden" name="swpf_setup_plugin_date_modified" value="<?php echo get_option('swpf_setup_plugin_date_modified'); ?>"/>
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="<?php swpf_get_option_list( $options ); ?>" />
		
		<?php if ($action == 'modify' || $updated ) { $update_button_text = "Update Plugin"; } else { $update_button_text = "Create New Plugin"; } ?>
			
		<p class="submit">
			<a href="javascript:swpf_checkSetupSubmit();" class="button-primary"><span style="margin:2px;"><?php _e($update_button_text); ?></span></a>
		</p>
		
		</form>
		
		<?php } ?>
	</div>
	
<?php } }?>