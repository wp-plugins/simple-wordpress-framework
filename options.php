<?php 

/*
	Creates/Updates all options that will be used in swpframework. below are two types
	of options, the first checks if the option has been defined.  If it does not exist it
	will be added with the the specified default values, otherwise it will not be updated.
	these options can be changed in the Administrative Pannel under the options section for the plugin.
	The second type of option, represents the options which are constants throught the program.
	They can only be changed by hardcoding the values in this file.  It is primarily used
	to keep track of the current Version of the plugin, or to specify other constants that cannot
	change through user input.
	
	Below, 'swpframework_version' stores the value which represents the current Version/release of swpframework.
	This value is extreemly important!  It manages any upgrades made to the plugin.  It is the only
	option in swpframework that needs to be updated every it is changed. MYPLUGIN_VERSION was defined
	in swpframework.php as a constant with the php DEFINE function.

*/


# Load JavaScript and CSS files
add_action( 'init', 'swpframework_options_load_js' ); 

function swpframework_options_load_js()
{
	if ( strpos($_SERVER['REQUEST_URI'], 'swpframework-options' ) !== false ) { # load js for options page

		## -- Fabrastic Color Picker - Start  ##	
		## ------------------------------------------------------------------------------------------
		## Fabrastic is a circular color selector.  It uses two JavaScript routines that are located in the
		## 'swpframework/widgets' directory: 1) rgbcolor.js and 2) farbtastic.  It also uses HTML code which I
		## provided below under <!--  
		## Website/Reference: ( http://acko.net/blog/farbtastic-color-picker-released )

		wp_enqueue_script( 'swpframework_farbtastic', plugins_url('widgets/swpframework_farbtastic.js', __FILE__), array( 'jquery', 'farbtastic', 'rgbcolor' ) ); // this is very important
		wp_enqueue_script( 'rgbcolor', plugins_url('widgets/rgbcolor.js', __FILE__)   );

		## Do not remove the 'ssp_insert_colorpicker' action or function unless you don't want to use farbastic.

	    add_action('admin_footer', 'ssp_insert_colorpicker');
		function ssp_insert_colorpicker()
		{
			echo "\n";
			echo '<div id="ssp_farbtastic" style="display:none"> </div>'."\n";
			echo "\n";
		}	
		## -- Fabrastic Color Picker - End  ##

	}

}


add_action('admin_head', 'swpframework_load_options_css');

function swpframework_load_options_css()
{
	if ( strpos($_SERVER['REQUEST_URI'], 'swpframework-options' ) !== false ) { # load css for options page
		echo '<link rel="stylesheet" href="'.plugins_url('css/options.css', __FILE__).'" type="text/css" media="screen" />'."\n";
		echo '<link rel="stylesheet" href="'.admin_url().'/css/farbtastic.css" type="text/css" media="screen" />'."\n";
	}
}


function swpframework_default_options()
{
	$option = get_option( 'swpframework_purge_data' );
	if( empty($option)) { update_option( 'swpframework_purge_data', MYPLUGIN_PURGE_DATA ); }  // Flags wether or not the database should be deleted when application is deactivated.  Default value: MYPLUGIN_DELETE_DATA which is defined in swpframework.php

	$option = get_option( 'swpframework_sample_1' );
	if( empty($option)) { update_option( 'swpframework_sample_1', 'Sample #1' ); }

	$option = get_option( 'swpframework_sample_2' );
	if( empty($option)) { update_option( 'swpframework_sample_2', 'Sample #2' ); }


	update_option( 'swpframework_version', MYPLUGIN_VERSION);
}



function swpframework_remove_options()
{
	// Removes all WordPress Options

	delete_option( 'swpframework_version' );
	delete_option( 'swpframework_purge_data' );
	delete_option( 'swpframework_option_sample_1' );
	delete_option( 'swpframework_option_sample_2' );
	delete_option( 'swpframework_option_sample_3' );
}


function swpframework_options_page() {

	if ($_POST) { swpframework_options_post(); }  	// if page modifications have been posted, update the options.

	swpframework_options_html(); 					// display the options page.

}

function swpframework_options_post() {

	if( $_POST[ 'action' ] == 'update' ) {

		update_option( 'swpframework_option_sample_1', $_POST[ 'swpframework_option_sample_1' ] );
		update_option( 'swpframework_option_sample_2', $_POST[ 'swpframework_option_sample_2' ] );
		update_option( 'swpframework_option_sample_3', $_POST[ 'swpframework_option_sample_3' ] );

		?>
		<div class="updated"><p><strong><?php _e('Options saved.', 'mt_trans_domain' ); ?></strong></p></div>
		<?php 

	}

}

function swpframework_options_html() {   ?>
	
	<div class="wrap">
	<div id="swpframework-tango-icon32-disk" class="icon32"></div> 
	<div id="swpframework-tango-icon32-quote" class="icon32"></div> 
	<div id="swpframework-tango-icon32-home" class="icon32"></div> 
	<div id="swpframework-tango-icon32-world" class="icon32"></div> 
	<div id="swpframework-tango-icon32-paper" class="icon32"></div> 
	<div id="swpframework-tango-icon32-media" class="icon32"></div>
	<div id="swpframework-tango-icon32-puzzle" class="icon32"></div> 
	<div id="swpframework-tango-icon32-tools" class="icon32"></div> 
	<div id="swpframework-tango-icon32-settings" class="icon32"></div> 
	<div id="swpframework-tango-icon32-notepad" class="icon32"></div> 
	<div id="swpframework-tango-icon32-user" class="icon32"></div> 
<BR>
<BR>
<BR>	
	<div id="swpframework-icon32-a" class="icon32"></div>
	<div id="swpframework-icon32-b" class="icon32"></div>
	<div id="swpframework-icon32-c" class="icon32"></div>
	<div id="swpframework-icon32-d" class="icon32"></div>
	<div id="swpframework-icon32-e" class="icon32"></div>
	<div id="swpframework-icon32-f" class="icon32"></div>
	<div id="swpframework-icon32-g" class="icon32"></div>
	<div id="swpframework-icon32-h" class="icon32"></div>
	<div id="swpframework-icon32-i" class="icon32"></div>
	<div id="swpframework-icon32-j" class="icon32"></div>
	<div id="swpframework-icon32-k" class="icon32"></div>
	<div id="swpframework-icon32-l" class="icon32"></div>
	<div id="swpframework-icon32-m" class="icon32"></div>
	
	<h2>SWP Framework Setup & Configuration</h2>
	
	<form method="post" id="swpframework_form" action="">
	
	<?php wp_nonce_field('update-options'); ?>
	
	
	<p>This is the SWP Framework Setup and Configuration page.&nbsp;&nbsp;When you have completed your enteries, click on the Update button to save your changes them.</p>
	
	
		<!-- Default Settings: -->
		<table class="form-table ssp_form-table">

			<tr valign="top">
				<th scope="row" class="ssp_form-h2"><h2>Default Settings:</h2></th>
				<td class="ssp_form-update"><p class="submit ssp_submit"><input type="submit" name="Submit" value="Update &raquo;" /></p></td>
			</tr>
	
			<tr valign="top">
				<th scope="row"><label for="swpframework_option_sample1">Sample #1 - Text:</label></th>
				<td>
					<input type="text" name="swpframework_option_sample1" value="<?php echo get_option('swpframework_option_sample1'); ?>"/>
					&nbsp;&nbsp; Description for Sample #1.
				</td>
			</tr>
	
			<tr valign="top">
				<th scope="row"><label for="swpframework_option_sample2">Sample #2 - Checkbox:</label></th>
				<td>
					<input name="swpframework_option_sample2" type="checkbox"<?php if ($swpframework_option_sample2) echo ' checked="checked"'; ?> id="swpframework_option_sample2" value="1" />
					&nbsp;&nbsp;Description for Sample #2.
				</td>
			</tr>
		
			<tr valign="top">
				<th scope="row"><label for="swpframework_option_sample3">Sample #3 - Checkbox Inactive:</label></th>
				<td><input type="checkbox" checked="checked" id="swpframework_option_sample3" value="1" disabled="disabled" />
				&nbsp;&nbsp;Sample #3 checkbox has been disabled.  Use <strong>[disabled="disabled"]</strong> inside the HTML <code>&#8249;input&#8250;</code> tag.</td>
			</tr>			

			
			<?php $swpframework_sample4_list = array('Item 1', 'Item 2', 'Item 3', 'Item 4'); ?>
			
			<tr valign="top">
				<th scope="row"><label for="swpframework_option_sample4">Sample #4 - Select list:</label></th>
				<td>
					<select name="swpframework_option_sample4" id="swpframework_option_sample4" /><?php foreach ($swpframework_sample4_list as $option) : ?><option<?php if (!strcmp($swpframework_option_sample4, $option)) echo ' selected="selected"';?> value="<?php echo $option;?>"><?php echo $option;?></option><?php endforeach;?></select>
					&nbsp;&nbsp;Sample #4 has a routine that automatically chooses the selected item in the list.
				</td>
			</tr>
			
			<tr valign="top">
				<th scope="row"><label>Sample #5 - Radio Buttons:</label></th>
				<td>
					<div>
						<input id="swpframework_option_sample5" type="radio"<?php echo ((empty($swpframework_option_sample5))||($swpframework_option_sample5 == 'Apple')) ? ' checked="checked"' : '' ?> name="swpframework_option_sample5" value="apple" /> <label for="swpframework_option_sample5">Apple</label> (Description of apple.)
					</div>
					<div>
						<input id="swpframework_option_sample5" type="radio"<?php echo ($swpframework_option_sample5 == 'Banana') ? ' checked="checked"' : '' ?> name="swpframework_option_sample5" value="banana" /> <label for="swpframework_option_sample5">Banana</label> (Description of apple.)
					</div>
					<div>
						<input id="swpframework_option_sample5" type="radio"<?php echo ($swpframework_option_sample5 == 'Orange') ? ' checked="checked"' : '' ?> name="swpframework_option_sample5" value="orange" /> <label for="swpframework_option_sample5">Orange</label> (Description of apple.)
					</div>
					<div>
						<input id="swpframework_option_sample5" type="radio"<?php echo ($swpframework_option_sample5 == 'custom') ? ' checked="checked"' : '' ?> name="swpframework_option_sample5" value="custom" /> <label for="swpframework_option_sample5">Choose your own fruit:</label> (Describe details below)
						<BR><textarea style="margin-left:20px;" rows="4" cols="40" name="swpframework_option_sample5_text"><?php echo get_option('swpframework_option_sample5_text'); ?></textarea>
					</div>
				</td>
			</tr>
			
	       <!-- Start: Fabrastic Color Picker -->
			<tr valign="top">
				<th scope="row"><label for="swpframework_sample_color">Sample #6 - Color Selection:</label></th>
				<td>
					<input name="swpframework_sample_color" type="text" id="swpframework_sample_color" value="#<?php echo preg_replace('/^0x/', '', $swpframework_sample_color);?>" size="8" maxlength="8" />&nbsp;&nbsp;<input readonly="true" class="ssp_colorpicker" style="background:#<?php echo preg_replace('/^0x/', '', $swpframework_sample_color);?>" />&nbsp;&nbsp;(Click on the square to change the color.)
				</td>
			</tr>
			<!-- End: Fabrastic Color Picker -->
		</table>

	
		<!-- Start: Purge Data -->
		<table class="form-table ssp_form-table ssp_form-table-highlight">
	
			<tr valign="top">
				<th scope="row" class="ssp_form-h2"><h2>Deactivation:</h2></th>
				<td class="ssp_form-update"><p class="submit ssp_submit"><input type="submit" name="Submit" value="Update &raquo;" /></p></td>
			</tr>
			<tr valign="top" class="ssp_highlight-option">
				<th scope="row"><label for="swpframework_purge_data">Delete All Data Upon Deactivation:</label></th>
				<td class="td_deactivate">
					<input name="swpframework_purge_data" type="checkbox"<?php if (get_option( 'swpframework_purge_data' )) echo ' checked="checked"'; ?> id="swpframework_purge_data" value="1" />&nbsp;&nbsp;<?php _e("All data and options created by SWP Framework will be purged when the plugin is deactivated if selected"); ?>
				</td>
			</tr>
	
		</table>
		<!-- End: Purge Data -->


	<input type="hidden" name="action" value="update" />
	
	<p class="submit">
		<input type="submit" class="button-primary" value="<?php _e('Update'); ?>" />
	</p>
	
	</form>
	</div>
	
<?php } ?>