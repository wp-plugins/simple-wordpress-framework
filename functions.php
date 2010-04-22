<?php 
/**
 * Manages Wordpress Options
 * 
 * These functions are used to control wordpress options in SWPFramework 
 * they handle all aspects of adding, removing, and updating options.
 */

/**
 * $swpf_options_all is a global variable used to track of all options used 
 * in this plugin.  It is initialized as an empty array every time the 
 * SWPFramework plugin is called.
 */
global $swpf_options_all; $swpf_options_all = array();


/**
 * Merges $options with $swpf_options_all.  Any duplicate 'key' elements 
 * found in $swpf_options_all will be replaced with the 'value' found in 
 * $options element.
 *
 * @param array $options - 'key' ==> 'value'
 */
function swpf_merge_all_options( $options = array() ) {

	global $swpf_options_all;

	if (!empty($options)) $swpf_options_all = array_merge( $swpf_options_all, $options );
}

/**
 * Obtains values returned from wordpress get_option function for each 
 * $option 'key' element and places them into an array element as a 
 * 'key' => 'value' pair.  If $excluded is used, the array will be returned 
 * without the $excluded 'key' elements.
 * 
 * @param array $options	- array with 'key' => 'value' pairs.
 * @param array $excluded	- array with 'key' => 'value' pairs.
 * @return array
 */
function swpf_get_options( $options, $excluded = array() ) {

	$option_results = array();

	foreach ($options as $key => $value) {
		if (in_array( $key, $excluded ) ) continue;  // ignore getting options listed in this array.
		$option_results[$key] = get_option( $key );
	}

	return $option_results;
}


/**
 * Activate/Create/Add all $options to the wordpress options datafile with
 * the wordpress add_option function.  $options must be defined as a 
 * 'key' ==> 'value' element pair.  The 'key' will be the name of the option 
 * and the 'value' will be a string containing the value assigned to that option.
 *
 * @param array $options  - 'key' ==> 'value'
 * @param array $excluded - 'key' ==> 'value'
 */
function swpf_activate_options( $options, $excluded = array() ) {

	foreach ($options as $key => $value) {
		if (in_array( $key, $excluded) ) continue;  // ignore getting options listed in this array.
		add_option( $key, $value );
	}
}


/**
 * Update all $options to the wordpress options datafile with
 * the wordpress add_option function.  $options must be defined as a 
 * 'key' ==> 'value' element pair.  The 'key' will be the name of the option 
 * and the 'value' will be a string containing the value assigned to that option.
 *
 * @param array $options - 'key' ==> 'value'
 */
function swpf_update_options( $options ) {

	foreach ($options as $key => $value) {
		update_option( $key, $value );
	}
}


/**
 * Deletes all $options from the wordpress options datafile with the wordpress 
 * delete_option function.  $options must be defined as a 'key' ==> 'value' 
 * element pair.  The 'key' will be the name of the option and the 'value' 
 * will be a string containing the value assigned to that option.
 *
 * @param array $options - 'key' ==> 'value'
 */
function swpf_deactivate_options( $options )
{
	foreach ($options as $key => $value) {
		delete_option( $key );
	}
}


/**
 * Creates a comma delimited string for every 'key' in $options. If $excluded is
 * used, the list will be returned without the $excluded 'key' elements.
 *
 * @param array $options   - array with 'key' => 'value' pairs.
 * @param array $excluded  - array with 'key' => 'value' pairs.
 * @param array $dispaly   - if display is true it will 'echo' the string, otherwise it will return a sring value.
 * @param array $delimiter - used to seperated the 'key' list. default delimiter is a comma.
 * @return text			   - if display is set to 'false' the list will be returned by the function.
 */
function swpf_get_option_list( $options, $excluded = array(), $dispaly = true, $delimiter = ','  ) {

	$option_list = array();

	foreach ($options as $key => $value) {
		if (in_array( $key, $excluded) ) continue;  // ignore getting options listed in this array.
		$option_list[] = $key;
	}

	if ($dispaly)
	echo implode($delimiter, $option_list);
	else
	return $option_list;
}


/**
 * Returns the current SWPFramework version number
 *
 * @return string
 */
function swpf_installed_version() {

	return get_option( SWPF_NAME );  // returns the version number of this plugin that the current stored data is registered to.
}


/**
 * Dactivation of SWPFramework
 * 
 * These routines handle deactivation of SWPFramework.  Deletes/Removes 
 * database Tables and Options. If the application current version is 
 * different than the previous version data will not be removed.  Instead 
 * the application will assume that an upgrade is in progress.
 * 
 */
function swpf_deactivate()
{
	global $wpdb, $swpf_options_all;

	swpf_deactivate_options( $swpf_options_all );
	
	delete_option( SWPF_NAME );
}


/**
 * Activation of SWPFramework
 * 
 * Handles activation of plugin.  Creates/Updates database Tables, and will
 * allow the plugin to create tables, and insert default data into the tables.
 *
 * Options will be added only if they don't exist.
 *  
 */
function swpf_activate() {

	global $swpf_options_all;

	if ( swpf_installed_version() != SWPF_VERSION ) {

		swpf_activate_options( $swpf_options_all );

		add_option( SWPF_NAME, SWPF_VERSION );	
	} 
}


/**
 * Checks if this plugin is an update from a previous version. This routine 
 * is used in 'swpframework.php' and is executed every time wordpress calls
 * the 'plugins_loaded' action.
 */
add_action('plugins_loaded', 'swpf_check_for_updates' ); 

function swpf_check_for_updates() {
	
	swpf_activate();
}


/**
 * Displays the default 32px header icon 'swpf-icon-header.png' located in the framework /images/ directory.
 *
 */
function swpf_header_icon() {

	$icon_url = plugins_url('images/swpf-icon-header.png',  __FILE__ ); ?>
  	
	<div id="icon-myplugin" class="icon32"><img src="<?php echo $icon_url; ?>"></div><?php

}


// Pre-2.6 compatibility
if ( ! defined( 'WP_CONTENT_URL' ) )
define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
if ( ! defined( 'WP_CONTENT_DIR' ) )
define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( ! defined( 'WP_PLUGIN_URL' ) )
define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
if ( ! defined( 'WP_PLUGIN_DIR' ) )
define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );



?>