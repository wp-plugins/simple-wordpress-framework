<?php


add_action('admin_head', 'myplugin_load_css');

function myplugin_load_css()
{

	## -- Facebox --
	if (  in_array( $_GET['page'], array( 'myplugin-submenu-options', 'myplugin-submenu-setup', 'myplugin-submenu-setup' ) ) !== false ) { # load js for options page
		echo '<link rel="stylesheet" href="'.plugins_url('widgets/facebox/facebox.css', MYPLUGIN_FILE_PATH).'" type="text/css" media="screen" />';
	}

	## -- Fabrastic Color Picker --
	if (  in_array( $_GET['page'], array( 'myplugin-submenu-options' ) )) { # load css for options page
		echo '<link rel="stylesheet" href="'.admin_url().'/css/farbtastic.css" type="text/css" media="screen" />'."\n";
	}

	## -- Options Page --
	if (  in_array( $_GET['page'], array( 'myplugin-submenu-options', 'myplugin-submenu-setup' ) )) { # load css for options page
		echo '<link rel="stylesheet" href="'.plugins_url('css/options.css', __FILE__).'" type="text/css" media="screen" />'."\n";
	}

}


add_action( 'init', 'myplugin_load_js' ); # Loads JavaScript and CSS files

function myplugin_load_js()
{
		
	/*  FACEBOX: A facebook lightbox style pop-up window.
	 *  http://famspam.com/facebox
	*/
	
	## -- Start: Facebox  ##
	if (  in_array( $_GET['page'], array( 'myplugin-submenu-options', 'myplugin-submenu-setup', 'myplugin-submenu-setup' ) ) ) { # load js for options page
		wp_enqueue_script( 'facebox', plugins_url('widgets/facebox/facebox.js', MYPLUGIN_FILE_PATH), array( 'jquery' ) );
		wp_localize_script('jquery','SlidePress', array(
		'sspurl' => plugins_url('', __FILE__) . '/'
		));
	}
	## -- End: Facebox  ##


	/*  FABRASTIC: Farbtastic is a jQuery plug-in that can add one or more color picker widgets into a page through JavaScript
	 *  Website: http://acko.net/dev/farbtastic
	*/
	
	## -- Start: Fabrastic Color Picker --	
	if (  in_array( $_GET['page'],  array( 'myplugin-submenu-options' ))) { # load js for options page

		## ------------------------------------------------------------------------------------------
		## Fabrastic is a circular color selector.  It uses two JavaScript routines that are located in the
		## 'swpframework/widgets' directory: 1) rgbcolor.js and 2) farbtastic.  It also uses HTML code which I
		## provided below under <!--
		## Website/Reference: ( http://acko.net/blog/farbtastic-color-picker-released )

		wp_enqueue_script( 'myplugin_farbtastic', plugins_url('widgets/myplugin.farbtastic.js', __FILE__), array( 'jquery', 'farbtastic', 'rgbcolor' ) ); // this is very important
		wp_enqueue_script( 'rgbcolor', plugins_url('widgets/rgbcolor.js', __FILE__)   );

		## Do not remove the 'myplugin_insert_colorpicker' action or function unless you don't want to use farbastic.

		add_action('admin_footer', 'myplugin_insert_colorpicker');
		function myplugin_insert_colorpicker()
		{
			echo "\n";
			echo '<div id="myplugin_farbtastic" style="display:none"> </div>'."\n";
			echo "\n";
		}
	}
	## -- End: Fabrastic Color Picker --

	
	/*	jQuery FORM VALIDATION: 
	 *  Website:  http://docs.jquery.com/Plugins/Validation#Validate_forms_like_you.27ve_never_been_validating_before.21
	 *  Website:  http://docs.jquery.com/Plugins/Validation
	*/
	
	## -- Start: jQueryValidation  ##
	## -- NOTE: Help is needed in setting up the jQueryValidation tool, if you know how to do it please send us an e-mail with explaining how it can be done.
	
	if (  in_array( $_GET['page'], array( 'myplugin-submenu-options', 'myplugin-submenu-setup') ) ) { # load js for options page
		//wp_enqueue_script( 'jquery_validate', plugins_url('widgets/jquery-validate/jquery.validate.js', MYPLUGIN_FILE_PATH), array( 'jquery' ) );
		//wp_enqueue_script( 'myplugin_jquery_validation', plugins_url('widgets/jquery-validate/myplugin.validate.js', MYPLUGIN_FILE_PATH), array( 'jquery' ) );
	}
	## -- End:  jQueryValidation   ##

}
?>