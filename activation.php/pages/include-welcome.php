<?php 

/**
   * Recursively traverses files of a specified path 
   * @param  path to execute
   * @return  none
   */   
function swpf_plugin_search($path) {

	$swpf_plugins = array();

	$dir = opendir ($path);

	while ($file = readdir ($dir))
	{
		if (($file == ".") or ($file == ".."))
		{
			continue;
		}

		if (filetype ("$path/$file") == "dir")
		{
			$swpf_file = "$path/$file/swpf.php";

			if (is_file($swpf_file)) {
				require($swpf_file);
				if ($options) $swpf_plugins[] = $options;
			}
		}

	} //End of while

	closedir($dir);

	return $swpf_plugins;

}  //end swpf_plugin_search


/**
 * {@internal Missing Short Description}}
 *
 * @since unknown
 *
 * @param unknown_type $user_object
 * @param unknown_type $style
 * @param unknown_type $role
 * @return unknown
 */
function swpf_plugin_row( $columns ) {

	$plugin_directory = $columns['swpf_setup_plugin_directory_name'];
	$plugin_version = $columns['swpf_setup_version'];
	$actions = array();

	$r = "<tr id='user-$plugin_directory'>";

	foreach ( $columns as $column_name => $column_display_name ) {

		$class = "class=\"$column_name column-$column_name\"";
		$style = '';

		$attributes = "$class$style";

		if ($plugin_version == SWPF_VERSION ) {
			$edit_link = "admin.php?page=swpf-submenu-setup&action=modify&plugin=$plugin_directory";
		} else {
			$edit_link = "javascript:alert('You cannot modify this plugin. It was created using a different Version of Simple WordPress Framework');";
		}

		switch ($column_name) {
			case 'swpf_setup_plugin_name':
				$r .= "<td $attributes ><a href=\"$edit_link\">$column_display_name</a></td>";
				break;
			case 'swpf_setup_plugin_date_created':
				$r .= "<td $attributes ><a href=\"$edit_link\">$column_display_name</a></td>";
				break;
			case 'swpf_setup_plugin_date_modified':
				$r .= "<td $attributes ><a href=\"$edit_link\">$column_display_name</a></td>";
				break;
			case 'swpf_setup_version':
				$r .= "<td $attributes ><a href=\"$edit_link\">$column_display_name</a></td>";
				break;
		}
	}
	$r .= '</tr>';

	return $r;

}



/**
 * {@internal Missing Short Description}}
 *
 * @since unknown
 *
 * @param unknown_type $page
 * @return unknown
 */
function swpf_plugin_get_column_headers() {

	$column_headers = array(
	'swpf_setup_plugin_name' => __('Plugin Name'),
	'swpf_setup_plugin_date_created' => __('Date Created'),
	'swpf_setup_plugin_date_modified' => __('Date Modified'),
	'swpf_setup_version' => __('SWPF Version'),
	);

	return $column_headers;
}


/**
 * {@internal Missing Short Description}}
 *
 * @since unknown
 *
 * @param unknown_type $type
 * @param unknown_type $id
 */
function swpf_plugin_print_column_headers() {
	$columns = swpf_plugin_get_column_headers( );
	$styles = array();
	//	$styles['tag']['posts'] = 'width: 90px;';
	//	$styles['link-category']['links'] = 'width: 90px;';
	//	$styles['category']['posts'] = 'width: 90px;';
	//	$styles['link']['visible'] = 'text-align: center;';

	foreach ( $columns as $column_key => $column_display_name ) {
		$class = ' class="manage-column';

		$class .= " column-$column_key";

		$class .= '"';

		$style = '';

?>
	<th scope="col" <?php echo $id ? "id=\"$column_key\"" : ""; echo $class; echo $style; ?>><?php echo $column_display_name; ?></th>
<?php }
}


$swpf_plugin_search = swpf_plugin_search( WP_PLUGIN_DIR );

if (!empty($swpf_plugin_search)) { ?>
		
	<table class="form-table swpf_form-table">
		<tr valign="top">
			<th scope="row" class="swpf_form-h2" colspan="2"><h2>Modify existing plugin:</h2></th>
		</tr>

		<tr valign="top">
			<td colspan="2">
				<p>Modify a previously configured SWPF plugin. Choose from the list below to change the setup options you defined for the any of the plugins listed below. </p>
			</td>
		</tr>	
	</table>
	
	<br class="clear" />
	
	<table class="widefat fixed" cellspacing="0" style="margin:0px 0px 0px 10px;">
		<thead>
			<tr class="thead">
			<?php swpf_plugin_print_column_headers() ?>
			</tr>
		</thead>
		
		<tfoot>
			<tr class="thead">
				<?php swpf_plugin_print_column_headers() ?>
			</tr>
		</tfoot>
		
		<tbody id="users" class="list:user user-list">
			<?php
			$style = '';
			foreach ( $swpf_plugin_search as $columns ) {
				$style = ( ' class="alternate"' == $style ) ? '' : ' class="alternate"';
				echo "\n\t" . swpf_plugin_row( $columns );
			}
			?>
		</tbody>
		
	</table>	
	<table class="form-table swpf_form-table">
		<tr><td><br class="clear" /></td></tr>
	</table>
<?php } // (!empty($swpf_plugin_search)) ?>


			
<table class="form-table swpf_form-table">
	<tr valign="top">
		<th scope="row" class="swpf_form-h2" colspan="2"><h2>Create a custom plugin:</h2></th>
	</tr>

	<tr valign="top">
		<td colspan="2">
			<p>If you are serious about creating a plugin, you can proceed to the <a href="#">Setup Menu</a> and answer a serries of questions that will provide you with a customized plugin.</p>
			<a class="button-primary" href="admin.php?page=swpf-submenu-setup&action=new"/><?php _e('Configure New Plugin'); ?></a>
		</td>
	</tr>	
	<tr><td><br class="clear" /></td></tr>
</table>
