<?php


add_action('admin_menu', 'swpf_menu');

function swpf_menu() {

	$icon_url = plugins_url('images/swpf-icon-menu.png', __FILE__);

	## add_menu_page (page_title, menu_title, user_level, file, [function], [icon_url]);  //  adds a new top-level menu:
	add_menu_page('', 'Framework', 'administrator', SWPF_NAME, 'swpf_submenu_welcome', $icon_url) ;


	## add_submenu_page (parent, page_title, menu_title, user_level, file, [function]);   // adds a new submenu to the custom top-level menu
	add_submenu_page(SWPF_NAME, 'Welcome to SWP Framework', 'Welcome', 'administrator', SWPF_NAME, 'swpf_submenu_welcome');
	add_submenu_page(SWPF_NAME, 'Setup & Configuration',  'Setup',      'administrator', 'swpf-submenu-setup', 'swpf_submenu_setup');

}


function swpf_submenu_welcome() {
	
	require_once( SWPF_PATH . 'pages/welcome.php' );
	swpf_welcome_page_submenu();

}

function swpf_submenu_setup() {
	
	require_once( SWPF_PATH . 'pages/setup.php' );
	swpf_setup_page_submenu();

}


?>