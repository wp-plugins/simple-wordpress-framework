<?php 
/*
Read Creating Option Pages - WordPress Codex: http://codex.wordpress.org/Creating_Options_Pages

Wordpress handles the management of options automatically.  We have made this so it will be easy for you
to add options to your plugin.  The code has been created to handle multiple option pages, so feel free
to create additional option pages using this sample.
*/


/**
 * $myplugin_options_current_page
 * 
 * Defines all the options used that are used in the <form> on this page.
 * 
 * Note: There are procedures that run inside the myplugin_options_html <form> that do the following:
 *       1) Automatically extract the values for each element in the array so they can be used as variables. 
 *       2) Automatically creates the hidden <input> 'option_page' and 'action'. Sets their values 
 * 			so Wordpress can handle saving the values in the option page automatically.
 * 			
 * 
 * $myplugin_options_current_page_excluded
 * 
 * Excludes all the options used above that will not be displayed in the form on this page.
 * Note: If you are not using one or more of the options listed above, you must specify them in this array
 *       otherwise their values will be reset to blank or zero.  If you don't want to create an exception, 
 *       then you must create an invisible <input> and add the current value to it inside the form. 
 */


myplugin_options_page_options();

function myplugin_options_page_options() {

	$options = array (

	'myplugin_option_purge_data' => MYPLUGIN_PURGE_DATA, #  When plugin is deactivated, if 'true', all tables, and options will be removed.
	'myplugin_option_sample_1' => 'Sample Text #1',
	'myplugin_option_sample_2' => 1,
	'myplugin_option_sample_3' => 1,
	'myplugin_option_sample_4' => 'Item 2',
	'myplugin_option_sample_5' => 'orange',
	'myplugin_option_sample_5_text' => '',
	'myplugin_option_sample_6' => '#000000',
	'myplugin_option_sample_7' => '#000000',
	'myplugin_option_facebox_sample1' => 'click the blue circle',
	'myplugin_option_facebox_sample2' => 'click the blue circle'
	);

	myplugin_merge_all_options( $options );
	
	return $options;
}


myplugin_options_page_options_excluded();

function myplugin_options_page_options_excluded() {

	$options = array();
	
	return $options;
}


function myplugin_options_page_submenu() {

	myplugin_options_page_html(); 	// display the options page.
}


/**
 *
 * Displays the HTML code for this page
 *
 */
function myplugin_options_page_html() {

	$options = myplugin_options_page_options();
	$options_excluded = myplugin_options_page_options_excluded();
	
	extract( swpf_get_options( $options, $options_excluded ) );
	
 	?>

  	<div class="wrap">
  	
	<?php myplugin_header_icon(); ?>
	<h2>My Plugin Options</h2>
	
	<form method="post" id="myplugin_form" action="options.php" enctype="multipart/form-data" name="post">

	<?php wp_nonce_field('update-options'); ?>
	
	<p>This is the SWP Framework Setup and Configuration page.&nbsp;&nbsp;When you have completed your enteries, click on the Update button to save your changes.</p>
	
	<!-- Default Settings: -->
	<table class="form-table myplugin_form-table">

		<tr valign="top">
			<th scope="row" class="myplugin_form-h2"><h2>Default Settings:</h2></th>
			<td class="myplugin_form-update"><p class="submit myplugin_submit"><input type="submit" name="Submit" value="Update &raquo;" /></p></td>
		</tr>

		<tr valign="top">
			<th scope="row"><label for="myplugin_option_sample_1">Sample #1 - Text:</label></th>
			<td>
				<input type="text" name="myplugin_option_sample_1" value="<?php echo $myplugin_option_sample_1; ?>"/>
				&nbsp;&nbsp; Description for Sample #1.
			</td>
		</tr>

		<tr valign="top">
			<th scope="row"><label for="myplugin_option_sample_2">Sample #2 - Checkbox:</label></th>
			<td>
				<input type="checkbox" name="myplugin_option_sample_2" id="myplugin_option_sample_2" value="1" <?php echo (!strcmp($myplugin_option_sample_2, 'On' ) || !strcmp($myplugin_option_sample_2, '1' )) ? ' checked="checked"' : ''; ?> />
				&nbsp;&nbsp;Description for Sample #2.
			</td>
		</tr>
	
		<tr valign="top">
			<th scope="row"><label for="myplugin_option_sample_3">Sample #3 - Checkbox Inactive:</label></th>
			<td>
				<input type="checkbox" <?php /*name="myplugin_option_sample_3" */?> id="myplugin_option_sample_3" value="1" disabled="disabled" <?php echo (!strcmp($myplugin_option_sample_3, 'On' ) || !strcmp($myplugin_option_sample_3, '1' )) ? ' checked="checked"' : ''; ?> />
				&nbsp;&nbsp;Sample #3 checkbox has been disabled.  Use <strong>[disabled="disabled"]</strong> inside the HTML <code>&#8249;input&#8250;</code> tag.
				<input type='hidden' name='myplugin_option_sample_3' value='<?php echo $myplugin_option_sample_3; ### Required, for a disabled input value. If this hidden field is not included the value will be reset to fales and show as inactive/not checked. ?>' />
			</td>
		</tr>			
		
		<?php $myplugin_option_sample_4_list = array('Item 1', 'Item 2', 'Item 3', 'Item 4'); ?>
		<tr valign="top">
			<th scope="row"><label for="myplugin_option_sample_4">Sample #4 - Select list:</label></th>
			<td>
				<select name="myplugin_option_sample_4" id="myplugin_option_sample_4" />
					<?php foreach ( $myplugin_option_sample_4_list as $option ) : ?> 
						<option <?php if (!strcmp( $myplugin_option_sample_4, $option)) echo ' selected="selected"';?> value="<?php echo $option;?>"><?php echo $option;?></option>
					<?php endforeach;?>
				</select>
				&nbsp;&nbsp;Sample #4 has a routine that automatically chooses the selected item in the list.
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row"><label>Sample #5 - Radio Buttons:</label></th>
			<td>
				<div>
					<input id="myplugin_option_sample_5" type="radio"<?php echo ((empty($myplugin_option_sample_5))||($myplugin_option_sample_5 == 'apple')) ? ' checked="checked"' : '' ?> name="myplugin_option_sample_5" value="apple" /> <label for="myplugin_option_sample_5">Apple</label> (Description of apple.)
				</div>
				<div>
					<input id="myplugin_option_sample_5" type="radio"<?php echo ($myplugin_option_sample_5 == 'banana') ? ' checked="checked"' : '' ?> name="myplugin_option_sample_5" value="banana" /> <label for="myplugin_option_sample_5">Banana</label> (Description of banana.)
				</div>
				<div>
					<input id="myplugin_option_sample_5" type="radio"<?php echo ($myplugin_option_sample_5 == 'orange') ? ' checked="checked"' : '' ?> name="myplugin_option_sample_5" value="orange" /> <label for="myplugin_option_sample_5">Orange</label> (Description of orange.)
				</div>
				<div>
					<input id="myplugin_option_sample_5" type="radio"<?php echo ($myplugin_option_sample_5 == 'custom') ? ' checked="checked"' : '' ?> name="myplugin_option_sample_5" value="custom" /> <label for="myplugin_option_sample_5">Choose your own fruit:</label> (Describe details below)
					<BR><textarea style="padding-left:20px;" rows="4" cols="40" name="myplugin_option_sample_5_text"><?php echo $myplugin_option_sample_5_text; ?></textarea>
				</div>
			</td>
		</tr>
				
       <!-- Start: Fabrastic Color Picker -->     
       <tr valign="top">
			<th scope="row"><label for="myplugin_option_sample_6">Sample #6 - Color Selection:</label></th>
			<td>
				<input class="myplugin_colorpicker_text" type="text" name="myplugin_option_sample_6" id="myplugin_option_sample_6" value="<?php echo preg_replace('/^0x/', '', $myplugin_option_sample_6);?>" size="8" maxlength="8" />&nbsp;&nbsp;
				<input class="myplugin_colorpicker" readonly="true"  name="myplugin_option_sample_6_color" style="background:<?php echo preg_replace('/^0x/', '', $myplugin_option_sample_6);?>" />&nbsp;&nbsp;(Click on the square to change the color.)
			</td>
		</tr>
		<!-- End: Fabrastic Color Picker -->
	
		<!-- Start: Fabrastic Color Picker -->     
       <tr valign="top">
			<th scope="row"><label for="myplugin_option_sample_7">Sample #7 - Color Selection:</label></th>
			<td>
				<input class="myplugin_colorpicker_text" type="text" name="myplugin_option_sample_7" id="myplugin_option_sample_7" value="<?php echo preg_replace('/^0x/', '', $myplugin_option_sample_7);?>" size="8" maxlength="8" />&nbsp;&nbsp;
				<input class="myplugin_colorpicker" readonly="true"  name="myplugin_option_sample_7_color" style="background:<?php echo preg_replace('/^0x/', '', $myplugin_option_sample_7);?>" />&nbsp;&nbsp;(Click on the square to change the color.)
			</td>
		</tr>
		<!-- End: Fabrastic Color Picker -->
		

		
       <!-- Start: Facebox Text Sample -->     
       <tr valign="top">
			<th scope="row">
				<label for="myplugin_option_facebox_sample1">
					<a class="help-label" href="#info" rel="facebox">Facebox Text Sample:<img class="help-label-img" src="<?php echo plugins_url('images/information.png', MYPLUGIN_FILE_PATH); ?>"></a>		
				</label>
				<div id="info" style="display:none;">
				    <h4>Facebox Text Sample</h4>
				    <p>This is great for adding comments to your plugin.&nbsp;&nbsp;You can provide a detailed explanation as to what this input field does. </p>
				    <p><a href="http://famspam.com/facebox" target="_blank">Facebox</a> is a great popup widget and you can do more with it.&nbsp;&nbsp;Please take the time to check out their <a href="http://famspam.com/facebox" target="_blank">webpage</a>.</p>
				</div>
				</div>
			</th>
			<td>
				<input type="text" name="myplugin_option_facebox_sample1" value="<?php echo $myplugin_option_facebox_sample1; ?>"/>
				&nbsp;&nbsp; Click on the circular 'i' to get a text popup.
			</td>
		</tr>
		<!-- End: Facebox Text Sample -->
		
		
       <!-- Start: Facebox Popup Sample -->     
       <tr valign="top">
			<th scope="row">
				<label for="myplugin_option_facebox_sample2">
					<a class="help-label" href="<?php echo plugins_url('widgets/facebox/stairs.jpg', MYPLUGIN_FILE_PATH); ?>" rel="facebox">Facebox Image Sample:<img class="help-label-img" src="<?php echo plugins_url('images/information.png', MYPLUGIN_FILE_PATH); ?>"></a>		
				</label>
			</th>
			<td>
				<input type="text" name="myplugin_option_facebox_sample2" value="<?php echo $myplugin_option_facebox_sample2; ?>"/>
				&nbsp;&nbsp; Click on the circular 'i' to get an image popup.
			</td>
		</tr>
		<!-- End: Facebox Popup Sample -->

	</table>


	<!-- Start: Purge Data -->
	<table class="form-table myplugin_form-table myplugin_form-table-highlight">
		<tr valign="top">
			<th scope="row" class="myplugin_form-h2"><h2>Deactivation:</h2></th>
			<td class="myplugin_form-update"><p class="submit myplugin_submit"><input type="submit" name="Submit" value="Update &raquo;" /></p></td>
		</tr>
		<tr valign="top" class="myplugin_highlight-option">
			<th scope="row"><label for="myplugin_option_purge_data">Delete All Data Upon Deactivation:</label></th>
			<td class="td_deactivate">
				<input type="checkbox" name="myplugin_option_purge_data" id="myplugin_option_purge_data" value="1" <?php echo (!strcmp($myplugin_option_purge_data, 'On' ) || !strcmp($myplugin_option_purge_data, '1' )) ? ' checked="checked"' : ''; ?> />&nbsp;&nbsp;<?php _e("All data and options created by SWP Framework will be purged when the plugin is deactivated if selected"); ?>
			</td>
		</tr>			
	</table>
	<!-- End: Purge Data -->
	
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="<?php swpf_get_option_list( $options, $options_excluded ); ?>" />
	
	<p class="submit">
		<input type="submit" class="button-primary" value="<?php _e('Update'); ?>" />
	</p>
	
	</form>
	</div>
	
<?php } ?>