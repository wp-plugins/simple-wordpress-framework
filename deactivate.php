<?php
/*

This file handles deactivation of swpframework.  Deletes/Removes database Tables and Options.
If the application notices that the current version is different than the previous version
data will not be removed.  Instead the application will assume that an upgrade is in progress.

*/

function swpframework_deactivate()
{
	global $wpdb;

	## If the Version Numbers are different, this means that user deactivated and then re-activated swpframework
	## to preform an upgrade. Data Tables and Options should not be removed.

	if ((get_option( 'swpframework_version' ) == MYPLUGIN_VERSION ) && ((get_option( 'swpframework_purgeUponDeactivation' ))))
	{

		$table_name = $wpdb->prefix . 'swpframework';  # assigns name to database table.

		if ($wpdb->get_var("SHOW TABLES LIKE '".$table_name."'") == $table_name) {

			$wpdb->query( "DROP TABLE ".$table_name."" );

		}

		swpframework_deactivate_options();

	}

}


?>