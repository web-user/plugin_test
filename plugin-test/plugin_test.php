<?php
/*
Plugin Name: Plugin Test
Plugin URI:  https://github.com/web-user/plugin_test
Description: Plugin Work Test 
Author: Sergey
Version: 1.0
Author 
License:
*/

add_action( 'admin_menu', 'rs_admin_menu' );


function rs_admin_menu() {
	add_menu_page( 'Options plugin (title)', 'Options plugin', 'manage_options','rs-options-plagin', 'rs_option_page','dashicons-admin-generic', '67.4' );
	add_submenu_page( 'rs-options-plagin', __( 'BackWPup Dashboard', 'backwpup' ), __( 'Dashboard', 'backwpup' ), 'backwpup', 'backwpup', array( 'BackWPup_Page_Backwpup', 'page' ) );
}


function rs_option_page(){
	$options = get_option( 'rs_plagin_options' );

?>

<div class="wrap">
	<h2>Options plugin</h2>
	<p>Settings Plugin &amp; Settings API</p>
	<p>Add hook new page or posts [test_new_hook]</p>
		<h2>Application for inventory</h2>

</div>

<?php


}