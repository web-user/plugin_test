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
	add_menu_page( 'Pure Theme', 'Pure Theme', 'manage_options','rs_options_plagin', 'rs_option_page','dashicons-admin-generic', '67.4' );
	add_submenu_page( 'rs_options_plagin', __( 'Home Page Slider', 'rs' ), __( 'Home Page Slider', 'rs' ), 'manage_options', 'rs_general_options', 'rs_option_submenu_general' );
	add_submenu_page( 'rs_options_plagin', __( 'Newew', 'rs' ), __( 'Newew', 'rs' ), 'manage_options', 'rs_general_options_new', 'rs_option_submenu_general_new' );
	remove_submenu_page('rs_options_plagin','rs_options_plagin');

}



/*Page*/
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

/*Page submenu general*/
function rs_option_submenu_general(){
	?>

	<div class="wrap">
		<h2>Options plugin general</h2>

	</div>

	<?php


}