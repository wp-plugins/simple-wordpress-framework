<?php 
/**
 * Manages Wordpress Options
 * 
 * These functions are used to control wordpress options in MyPlugin 
 * they handle all aspects of adding, removing, and updating options.
 */

/**
 * $myplugin_options_all is a global variable used to track of all options used 
 * in this plugin.  It is initialized as an empty array every time the 
 * MyPlugin plugin is called.
 */
global $myplugin_options_all; $myplugin_options_all = array();


/**
 * Merges $options with $myplugin_options_all.  Any duplicate 'key' elements 
 * found in $myplugin_options_all will be replaced with the 'value' found in 
 * $options element.
 *
 * @param array $options - 'key' ==> 'value'
 */
function myplugin_merge_all_options( $options = array() ) {

	global $myplugin_options_all;

	if (!empty($options)) $myplugin_options_all = array_merge( $myplugin_options_all, $options );

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
function myplugin_get_options( $options, $excluded = array() ) {

	$option_results = array();

	foreach ($options as $option => $default_value) {
		if (in_array( $option, array($excluded) ) ) continue;  // ignore getting options listed in this array.
		$option_results[$option] = get_option( $option );
	}

	return $option_results;
}


/**
 * Activate/Create/Update all $options to the wordpress options datafile with
 * the wordpress add_option function.  $options must be defined as a 
 * 'key' ==> 'value' element pair.  The 'key' will be the name of the option 
 * and the 'value' will be a string containing the value assigned to that option.
 *
 * @param array $options - 'key' ==> 'value'
 */
function myplugin_activate_options( $options ) {

	foreach ($options as $option => $default_value) {
		add_option( $option, $default_value );
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
function myplugin_update_options( $options, $excluded = array() ) {

	foreach ($options as $option => $default_value) {
		if (in_array( $option, array($excluded) ) ) continue;  // ignore getting options listed in this array.
		update_option( $option, $default_value );
	}
}


/**
 * Dactivate/Delete all $options from the wordpress options datafile with the 
 * wordpress delete_option function.  $options must be defined as a 'key' ==> 'value' 
 * element pair.  The 'key' will be the name of the option and the 'value' 
 * will be a string containing the value assigned to that option.
 *
 * @param array $options - 'key' ==> 'value'
 */
function myplugin_deactivate_options( $options )
{
	foreach ($options as $option => $default_value) {
		delete_option( $option );
	}

	delete_option( MYPLUGIN_NAME );

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
function myplugin_get_option_list( $options, $excluded = array(), $dispaly = true, $delimiter = ','  ) {

	$option_list = array();

	foreach ($options as $option => $default_value) {
		if (in_array( $option, $excluded) ) continue;  // ignore getting options listed in this array.
		$option_list[] = $option;
	}

	if ($dispaly)
	echo implode($delimiter, $option_list);
	else
	return $option_list;

}


/**
 * $myplugin_dbtables_all is a global variable used to track of all databases 
 * tables used in this plugin.
 */
global $myplugin_dbtables_all; 		$myplugin_dbtables_all = array();


/**
 * $myplugin_dbtables_data_all is a global variable used to track of all databases 
 * table data which will be instered upon activation of the plugin.
 */
global $myplugin_dbtables_data_all; $myplugin_dbtables_data_all = array();


/**
 * Merges $table with $myplugin_dbtables_all.  Any duplicate 'key' elements 
 * found in $myplugin_dbtables_all will be replaced with the 'value' found in 
 * $table element.
 *
 * @param array $options - 'key' ==> 'value'
 */
function myplugin_merge_all_dbtables( $table = array() ) {

	global $myplugin_dbtables_all;

	if (!empty($table)) $myplugin_dbtables_all = array_merge( $myplugin_dbtables_all, $table );
}


/**
 * Merges $table_data with $myplugin_dbtables_data_all.  Any duplicate 'key' elements 
 * found in $myplugin_dbtables_data_all will be replaced with the 'value' found in 
 * $table_data element.
 *
 * @param array $options - 'key' ==> 'value'
 */
function myplugin_merge_all_dbtables_data( $table_data = array() ) {

	global $myplugin_dbtables_data_all;

	if (!empty($table_data)) $myplugin_dbtables_data_all = array_merge( $myplugin_dbtables_data_all, $table_data );
}


/**
 * Dactivate/Delete all $tables from the wordpress database.  $tables must be 
 * defined as a 'key' ==> 'value' element pair.  The 'key' will be the name of the 
 * option and the 'value' will be a string containing the value assigned to 
 * that option.
 *
 * @param array $options - 'key' ==> 'value'
 */
function myplugin_deactivate_dbtables( $tables )
{
	global $wpdb;
	
	foreach ($tables as $table_name => $sql) {

		if ($wpdb->get_var("SHOW TABLES LIKE '".$table_name."'") == $table_name) {

			$wpdb->query( "DROP TABLE ".$table_name."" );
		}
	}
}


/**
 * Activate/Create/Update all MyPlugin $tables into the wordpress database.
 * $tables must be defined as a 'key' ==> 'value' element pair.  The 'key' is the
 * name of the database file, and the 'value' will be a string containing the SQL code.
 * 
 * You can add as many databases as you want.  Creating or updating the Table will 
 * require the use of the dbDelta function. The dbDelta function examines the current
 * table structure, compares it to the desired table structure, and either adds or 
 * modifies the table as necessary.  Note that the dbDelta function is rather picky.
 *   - You have to put each field on its own line in your SQL statement.
 *   - You have to have two spaces between the words PRIMARY KEY and the definition of your primary key.
 *   - You must use the key word KEY rather than its synonym INDEX and you must include at least one KEY.
 *
 * @param array $tables - 'key' ==> 'value'
 */
function myplugin_activate_dbtables( $tables, $datas ) {

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php');  # this runs the WordPress database table upgrade codex.

	foreach ($tables as $table_name => $sql) {

		$new_installation = $wpdb->get_var("show tables like '$table_name'") != $table_name; #detects if this is a new installation or simply an update.
		dbDelta($sql);

		if ($new_installation)
		{
			$wpdb->query( $datas[$table_name] );
		}
	}
}


function myplugin_merge_dbtable( $table_name, $sql = array(), $data = array() ) {

	if (!empty($table_name) and (!empty($sql))) {

		$dbtable[$table_name]  = $sql;
		myplugin_merge_all_dbtables( $dbtable );

		$dbtable_data[$table_name] = $data;
		myplugin_merge_all_dbtables_data( $dbtable_data );
	}
}



/**
 * Returns the current MyPlugin version number
 *
 * @return string
 */
function myplugin_installed_version() {

	return get_option( MYPLUGIN_NAME );  // returns the version number of this plugin that the current stored data is registered to.
}


/**
 * Dactivation of MyPlugin
 * 
 * These routines handle deactivation of MyPlugin.  Deletes/Removes 
 * database Tables and Options. If the application current version is 
 * different than the previous version data will not be removed.  Instead 
 * the application will assume that an upgrade is in progress.
 * 
 */
function myplugin_deactivate()
{
	global $wpdb, $myplugin_options_all, $myplugin_dbtables_all;

	myplugin_deactivate_dbtables( $myplugin_dbtables_all );
	myplugin_deactivate_options( $myplugin_options_all );
}


/**
 * Activation of MyPlugin
 * 
 * Handles activation of plugin.  Creates/Updates database Tables, and will
 * allow the plugin to create tables, and insert default data into the tables.
 *
 * Options will be added only if they don't exist.
 *  
 */
function myplugin_activate() {

	global $myplugin_options_all, $myplugin_dbtables_all, $myplugin_dbtables_data_all;

	if ( myplugin_installed_version() != MYPLUGIN_VERSION ) {

		myplugin_activate_dbtables( $myplugin_dbtables_all, $myplugin_dbtables_data_all );
		myplugin_activate_options( $myplugin_options_all );
	}

	add_option( MYPLUGIN_NAME, MYPLUGIN_VERSION );
}


/**
 * Checks if this plugin is an update from a previous version. This routine 
 * is used in 'mypluginramework.php' and is executed every time wordpress calls
 * the 'plugins_loaded' action.
 */
add_action('plugins_loaded', 'myplugin_check_for_updates' );

function myplugin_check_for_updates() {

	myplugin_activate();

	update_option( MYPLUGIN_NAME, MYPLUGIN_VERSION );
}


function myplugin_display_select_option_list( $name, $list, $default = '', $display = 1 )
{
	global $wpdb;

	if ( (!empty($list)) & (!empty($name)) ) {

		$line = '';
		$select = '<select name="'.$name.'">';

		foreach ( $list as $option ) {

			$selected = '';
			if ( $default == $option['value'] ) $selected = ' selected ';
			$line = '<option value="'.$option['value'].'"'.$selected.'>'.$option['name'].'</option>';
			$select .= $line;
		}
		$select .= '</select>';

		if ($display) echo($select);
		else return $select;
	}
}



function myplugin_display_CategoryOptions ( $main_category, $selected_cat_id = -1 ) {

	global $wpdb;

	$sql = "  SELECT c.cat_name, c.cat_id, c.category_parent
			  FROM " . $wpdb->prefix . "ss_categories c
			  WHERE c.category_parent = $main_category
			  ORDER BY cat_name";

	$categories = $wpdb->get_results($sql);
	$option_list = '';

	if ( !empty($categories) ) {
		foreach ( $categories as $category ) {
			if ($category->cat_id == $selected_cat_id) { $checked = "selected"; } else { $checked = ''; }


			if ($category->category_parent==0) {
				$checkBox = "<option value=\"$category->cat_id\" $checked><b>" . strtoupper( $category->cat_name  ) . "</b></option>";
			} else {
				$checkBox = "<option value=\"$category->cat_id\" $checked><b>&nbsp;&nbsp;$category->cat_name</option>";
			}

			$option_list .= $checkBox;
		}
	}

	return $option_list;
}


/**
 * Displays the default 32px header icon 'swpf-icon-header.png' located in the framework /images/ directory.
 *
 */
function myplugin_header_icon() {

	$icon_url = plugins_url('images/swpf-icon-header.png',  __FILE__ ); ?>
  	
	<div id="icon-myplugin" class="icon32"><img src="<?php echo $icon_url; ?>"></div><?php

}


function myplugin_get_page_name() {
	
	return isset($_REQUEST['page']) ? stripslashes($_REQUEST['page']) : '';
	
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