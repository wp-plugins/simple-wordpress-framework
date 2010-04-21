<?php


add_action('admin_head', 'swpf_load_css');

function swpf_load_css()
{

	## -- Facebox --
	if (  in_array( $_GET['page'], array( 'swpframework', 'swpf-submenu-setup' ) ) !== false ) { # load js for options page
		echo '<link rel="stylesheet" href="'.plugins_url('widgets/facebox/facebox.css', SWPF_FILE_PATH).'" type="text/css" media="screen" />';
	}

	## -- Options CSS --
	if (  in_array( $_GET['page'], array( 'swpframework', 'swpf-submenu-setup' ) )) { # load css for options page
		echo '<link rel="stylesheet" href="'.plugins_url('css/options.css', __FILE__).'" type="text/css" media="screen" />'."\n";
	}

}


add_action( 'init', 'swpf_load_js' ); # Loads JavaScript and CSS files

function swpf_load_js()
{
		
	/*  FACEBOX: A facebook lightbox style pop-up window.
	 *  http://famspam.com/facebox
	*/
	
	## -- Start: Facebox  ##
	if (  in_array( $_GET['page'], array( 'swpframework', 'swpf-submenu-setup' ) ) ) { # load js for options page
		wp_enqueue_script( 'facebox', plugins_url('widgets/facebox/facebox.js', SWPF_FILE_PATH ), array( 'jquery' ) );
		wp_localize_script('jquery','SlidePress', array(
		'sspurl' => plugins_url('', __FILE__) . '/'
		));
	}
	## -- End: Facebox  ##

	## -- Start: Setup Page  ##
	if (  in_array( $_GET['page'], array( 'swpf-submenu-setup') ) ) { # load js for options page
		wp_enqueue_script( 'swpframework_setup', plugins_url('js/swpframework_setup.js', SWPF_FILE_PATH ), array( 'jquery' ) );
	}
	## -- End: Setup Page   ##

}
?>