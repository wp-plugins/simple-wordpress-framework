<?php 

/*
	Read Creating Option Pages - WordPress Codex: http://codex.wordpress.org/Creating_Options_Pages
		
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

# define all the options you will use and their default values.

global $ssp_options_array;

$ssp_options_array = array (

	'swpframework_version' => MYPLUGIN_VERSION,
	'swpframework_purgeUponDeactivation' => 1,  // Flags wether or not the database should be deleted when application is deactivated.  Default value: MYPLUGIN_DELETE_DATA which is defined in swpframework.php
	'swpframework_option_sample_1' => 'Sample Text #1',
	'swpframework_option_sample_2' => 1,
	'swpframework_option_sample_3' => 1,
	'swpframework_option_sample_4' => 'Item 2',
	'swpframework_option_sample_5' => 'orange',
	'swpframework_option_sample_5_text' => '',
	'swpframework_option_sample_6' => '#000000',
	'swpframework_option_sample_7' => '#000000'
	
);	


function swpframework_options_html() {   
	
  	$ssp_options = ssp_get_options();
	extract( $ssp_options );

  	?>

  	<div class="wrap">
  	
  	<?php $icon_url = plugins_url('images/plugin-menu-icon32.png', __FILE__); ?>
  	
	<div id="icon-swpframework" class="icon32"><img src="<?php echo $icon_url; ?>"></div><h2>SWP Framework Setup & Configuration</h2>
	
	<form method="post" id="ssp_form" action="options.php">

	<?php settings_fields('swpframework'); ?>
	
	
	<p>This is the SWP Framework Setup and Configuration page.&nbsp;&nbsp;When you have completed your enteries, click on the Update button to save your changes them.</p>
	
	
		<!-- Default Settings: -->
		<table class="form-table ssp_form-table">

			<tr valign="top">
				<th scope="row" class="ssp_form-h2"><h2>Default Settings:</h2></th>
				<td class="ssp_form-update"><p class="submit ssp_submit"><input type="submit" name="Submit" value="Update &raquo;" /></p></td>
			</tr>
	
			<tr valign="top">
				<th scope="row"><label for="swpframework_option_sample_1">Sample #1 - Text:</label></th>
				<td>
					<input type="text"  name="swpframework_option_sample_1" value="<?php echo get_option('swpframework_option_sample_1'); ?>"/>
					&nbsp;&nbsp; Description for Sample #1.
				</td>
			</tr>
	
			<tr valign="top">
				<th scope="row"><label for="swpframework_option_sample_2">Sample #2 - Checkbox:</label></th>
				<td>
					<input type="checkbox" name="swpframework_option_sample_2" id="swpframework_option_sample_2" value="1" <?php echo (!strcmp($swpframework_option_sample_2, 'On' ) || !strcmp($swpframework_option_sample_2, '1' )) ? ' checked="checked"' : ''; ?> />
					&nbsp;&nbsp;Description for Sample #2.
				</td>
			</tr>
		
			<tr valign="top">
				<th scope="row"><label for="swpframework_option_sample_3">Sample #3 - Checkbox Inactive:</label></th>
				<td>
					<input type="checkbox" <?php /*name="swpframework_option_sample_3" */?> id="swpframework_option_sample_3" value="1" disabled="disabled" <?php echo (!strcmp($swpframework_option_sample_3, 'On' ) || !strcmp($swpframework_option_sample_3, '1' )) ? ' checked="checked"' : ''; ?> />
					&nbsp;&nbsp;Sample #3 checkbox has been disabled.  Use <strong>[disabled="disabled"]</strong> inside the HTML <code>&#8249;input&#8250;</code> tag.
				</td>
			</tr>			
			
			<?php $swpframework_option_sample_4_list = array('Item 1', 'Item 2', 'Item 3', 'Item 4'); ?>
			<tr valign="top">
				<th scope="row"><label for="swpframework_option_sample_4">Sample #4 - Select list:</label></th>
				<td>
					<select name="swpframework_option_sample_4" id="swpframework_option_sample_4" />
						<?php foreach ( $swpframework_option_sample_4_list as $option ) : ?> 
							<option <?php if (!strcmp( get_option('swpframework_option_sample_4' ), $option)) echo ' selected="selected"';?> value="<?php echo $option;?>"><?php echo $option;?></option>
						<?php endforeach;?>
					</select>
					&nbsp;&nbsp;Sample #4 has a routine that automatically chooses the selected item in the list.
				</td>
			</tr>
			
			<tr valign="top">
				<th scope="row"><label>Sample #5 - Radio Buttons:</label></th>
				<td>
					<div>
						<input id="swpframework_option_sample_5" type="radio"<?php echo ((empty($swpframework_option_sample_5))||($swpframework_option_sample_5 == 'apple')) ? ' checked="checked"' : '' ?> name="swpframework_option_sample_5" value="apple" /> <label for="swpframework_option_sample_5">Apple</label> (Description of apple.)
					</div>
					<div>
						<input id="swpframework_option_sample_5" type="radio"<?php echo ($swpframework_option_sample_5 == 'banana') ? ' checked="checked"' : '' ?> name="swpframework_option_sample_5" value="banana" /> <label for="swpframework_option_sample_5">Banana</label> (Description of banana.)
					</div>
					<div>
						<input id="swpframework_option_sample_5" type="radio"<?php echo ($swpframework_option_sample_5 == 'orange') ? ' checked="checked"' : '' ?> name="swpframework_option_sample_5" value="orange" /> <label for="swpframework_option_sample_5">Orange</label> (Description of orange.)
					</div>
					<div>
						<input id="swpframework_option_sample_5" type="radio"<?php echo ($swpframework_option_sample_5 == 'custom') ? ' checked="checked"' : '' ?> name="swpframework_option_sample_5" value="custom" /> <label for="swpframework_option_sample_5">Choose your own fruit:</label> (Describe details below)
						<BR><textarea style="padding-left:20px;" rows="4" cols="40" name="swpframework_option_sample_5_text"><?php echo get_option('swpframework_option_sample_5_text'); ?></textarea>
					</div>
				</td>
			</tr>
					
	       <!-- Start: Fabrastic Color Picker -->     
	       <tr valign="top">
				<th scope="row"><label for="swpframework_option_sample_6">Sample #6 - Color Selection:</label></th>
				<td>
					<input class="ssp_colorpicker_text" type="text" name="swpframework_option_sample_6" id="swpframework_option_sample_6" value="<?php echo preg_replace('/^0x/', '', $swpframework_option_sample_6);?>" size="8" maxlength="8" />&nbsp;&nbsp;
					<input class="ssp_colorpicker" readonly="true"  name="swpframework_option_sample_6_color" style="background:<?php echo preg_replace('/^0x/', '', $swpframework_option_sample_6);?>" />&nbsp;&nbsp;(Click on the square to change the color.)
				</td>
			</tr>
			<!-- End: Fabrastic Color Picker -->

			
	       <!-- Start: Fabrastic Color Picker -->     
	       <tr valign="top">
				<th scope="row"><label for="swpframework_option_sample_7">Sample #7 - Color Selection:</label></th>
				<td>
					<input class="ssp_colorpicker_text" type="text" name="swpframework_option_sample_7" id="swpframework_option_sample_7" value="<?php echo preg_replace('/^0x/', '', $swpframework_option_sample_7);?>" size="8" maxlength="8" />&nbsp;&nbsp;
					<input class="ssp_colorpicker" readonly="true"  name="swpframework_option_sample_7_color" style="background:<?php echo preg_replace('/^0x/', '', $swpframework_option_sample_7);?>" />&nbsp;&nbsp;(Click on the square to change the color.)
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
				<th scope="row"><label for="swpframework_purgeUponDeactivation">Delete All Data Upon Deactivation:</label></th>
				<td class="td_deactivate">
					<input type="checkbox" name="swpframework_purgeUponDeactivation" id="swpframework_purgeUponDeactivation" value="1" <?php echo (!strcmp($swpframework_purgeUponDeactivation, 'On' ) || !strcmp($swpframework_purgeUponDeactivation, '1' )) ? ' checked="checked"' : ''; ?> />&nbsp;&nbsp;<?php _e("All data and options created by SWP Framework will be purged when the plugin is deactivated if selected"); ?>
				</td>
			</tr>			
		</table>
		<!-- End: Purge Data -->

	<input type='hidden' name='swpframework_version' value='<?php echo $swpframework_version; ?>' />
	<input type='hidden' name='swpframework_option_sample_3' value='<?php echo $swpframework_option_sample_3; ?>' />
	
	<p class="submit">
		<input type="submit" class="button-primary" value="<?php _e('Update'); ?>" />
	</p>
	
	</form>
	</div>
	
<?php } ?>