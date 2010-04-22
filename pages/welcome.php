<?php 

swpf_welcome_page_options();

function swpf_welcome_page_options() {

	$options = array ();

	swpf_merge_all_options( $options );

	return $options;
}


swpf_welcome_page_options_excluded();

function swpf_welcome_page_options_excluded() {

	$options_excluded = array();

	return $options_excluded;

}


function swpf_welcome_page_submenu() {

	swpf_welcome_page_html(); 	// display the options page.

}

/**
 *
 * Displays the HTML code for this page
 *
 */


function swpf_welcome_page_html() {

	$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

	/**
	 *  Modify settings to begin process of copying MyPlugin to the Plugin Directory.
	 */
	if ($action == 'sample') {
		$options = swpf_setup_page_options();
		
		$messages = array();
		
		swpf_update_options( $options );
		
		require_once( SWPF_PATH . 'widgets/textsearch.class.php');
		$messages = swpf_setup_cleanup( $options );

		foreach( $messages as $message ) {
			echo $message;
		}
	}
	
  	?>

  	<div class="wrap">
  	
	<?php swpf_header_icon(); ?><h2>Welcome to Simple WordPress Framework (<?php echo 'Version '.SWPF_VERSION; ?>)</h2>
	
<p>Thank you for taking the time to try our plugin. Remember, this plugin creates a structure, shell, and framework to help you create other plugins quickly.  It also allows you to add, rename, and change different features for previously created plugins.</p>	
<p>After your plugin is created, it will be placed in the WordPress <code>/wp-content/plugins/</code> directory.  Make sure you <a href="plugins.php"><code>activate</code></a> the plugin once you are done.  You can do this by going to <a href="plugins.php">Manage Plugins</a> and clicking on the <a href="plugins.php"><code>activate</code></a> link that will be available under your plugin name.</p>

<!-- Default Settings: -->
<table class="form-table swpf_form-table">

	<tr valign="top">
		<th scope="row" class="swpf_form-h2" colspan="2"><h2>Quick Start (Sample):</h2></th>
	</tr>

	<tr valign="top">
<?php
		// has the default template plugin 'MyPlugin' in the WordPress Plugin directory, if so don't allow the user to create a new one.
		if (is_dir( WP_PLUGIN_DIR . '/MyPlugin')) { ?>
			<td colspan="2">
				<p><B>Your sample plugin, <code><i>myPlugin</i></code> is intalled.</B> &nbsp;If you haven't activated it, click on the <a href="plugins.php">Plugins Menu</a> and choose the <a href="plugins.php"><code>Activate</code></a> link for <i>myPlugin</i>. &nbsp;Once activated, the sample plugin will add a new menu at bottom of your WordPress administration dashbaord. &nbsp;Feel free to navigate the <i>myPlugin</i> menu, and click on anything you find interesting. &nbsp;When you are done, you can return to the <a href="plugins.php">Plugins Menu</a> , <a href="plugins.php"><code>Deactivate</code></a> the plugin and remove it by clicking on the <a href="plugins.php"><code>Delete</code></a> link.</p>
			</td>			
<?php	}  else { ?>
		<td colspan="2">
			<p>For a quick demo of the features provided in this framework, you can <a href="#">Create a Sample Plugin</a> called "myPlugin".</p>
			<a class="button-primary" href="admin.php?page=swpframework&action=sample"/><?php _e('Create Sample Plugin'); ?></a>
		</td>
<?php	} ?>	
	</tr>
	<tr><td><br class="clear" /></td></tr>
</table>	
	
<?php include_once('include-welcome.php'); ?>
			
	</div>	

<?php } ?>