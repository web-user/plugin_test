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
	add_menu_page( 'Pure Theme', 'Pure Theme', 'manage_options','rs_options_plagin', 'rs_option_page','dashicons-admin-generic', '8.2' );
	add_submenu_page( 'rs_options_plagin', __( 'Home Page Slider', 'rs' ), __( 'Home Page Slider', 'rs' ), 'manage_options', 'rs_general_options', 'rs_option_page' );
	add_submenu_page( 'rs_options_plagin', __( 'Newew', 'rs' ), __( 'Newew', 'rs' ), 'manage_options', 'rs_general_options_new', 'rs_option_submenu_general' );
	remove_submenu_page('rs_options_plagin','rs_options_plagin');

}



/*Page*/
function rs_option_page(){
	$options = get_option( 'rs_plagin_options' );

?>

<div class="wrap">
	<h2>Options plugin</h2>
	<p>Settings Plugin &amp; Settings API</p>
	<p>Add hook new page or posts [test_checkout_list_options]</p>

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

function nacin_register_slideshows_post_type() {
        register_post_type( 'slideshow', array(
                'labels' => array(
                        'name' => 'Slideshows',
                        'singular_name' => 'Slideshow',
                        'add_new'       => __( 'Add New', 'Slideshows', 'rs' ),
                        'add_new_item'       => __( 'Add Slideshows', 'rs' ),
                        'edit_item'     => __( 'Edit Slideshows', 'your-plugin-textdomain' ),
                ),
                'public' => true,
                'show_ui' => true,
                'show_in_menu' => 'rs_options_plagin',
                'supports' => array( 'title' ,'thumbnail', 'editor' ),
        ) );
}
add_action( 'init', 'nacin_register_slideshows_post_type' );

// Добавляем фильтр, который изменит сообщение при публикации при изменении типа записи Book
add_filter('post_updated_messages', 'slideshow_updated_messages');
function slideshow_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['slideshow'] = array(
	0 => '', // Не используется. Сообщения используются с индекса 1.
	1 => sprintf( 'Slideshow Update. Add hook new page or posts <span style="color: red;font-weight: 600;">[test_checkout_list_options]</span> ', esc_url( get_permalink($post_ID) ) ),
	3 => sprintf( 'Record Slideshow published. Add hook new page or posts <span style="color: red;font-weight: 600;">[test_checkout_list_options]</span> ', esc_url( get_permalink($post_ID) ) ),
	4 => 'Запись Book сохранена.',
	6 => sprintf( 'Record Slideshow is planned for: <strong>%1$s</strong>. Add hook new page or posts <span style="color: red;font-weight: 600;">[test_checkout_list_options]</span>',
	  // Как форматировать даты в PHP можно посмотреть тут: http://php.net/date
	  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),

  );

  return $messages;
}


$sh_cod_options = 'test_checkout_list_options';

add_shortcode( $sh_cod_options, 'rs_option_page_new' );

function rs_option_page_new(){

	 $slider = new WP_Query(array('post_type' => 'slideshow', 'order' => 'ASC'));

	if ( $slider->have_posts() ) : ?>
			<div class="slider margin-top">
				<div class="flexslider">
					<ul class="slides">

						<?php while ( $slider->have_posts() ) : $slider->the_post(); ?>
							<li>
								<div class="slide-content">
									<?php the_content(); ?>
								</div>
								<?php the_post_thumbnail(); ?>
							</li>
						<?php endwhile; ?>
					</ul>
				</div>
			</div>
	<?php else: ?>
		<div><h2>This plase slider</h2></div>
	<?php endif; 

}




function nacin_register_section_post_type() {
        register_post_type( 'section', array(
                'labels' => array(
                        'name' => 'Section',
                        'singular_name' => 'Section',
                        'add_new'       => __( 'Add New', 'Section', 'rs' ),
                        'add_new_item'       => __( 'Add Section', 'rs' ),
                        'edit_item'     => __( 'Edit Slideshows', 'your-plugin-textdomain' ),
                ),
                'public' => true,
                'show_ui' => true,
                'show_in_menu' => 'rs_options_plagin',
                'supports' => array( 'title' ,'thumbnail', 'editor' ),
        ) );
}
add_action( 'init', 'nacin_register_section_post_type' );

// Добавляем фильтр, который изменит сообщение при публикации при изменении типа записи Book
add_filter('post_updated_messages', 'section_updated_messages');
function section_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['section'] = array(
	0 => '', // Не используется. Сообщения используются с индекса 1.
	1 => sprintf( 'Section Update. Add hook new page or posts <span style="color: red;font-weight: 600;">[test_checkout_list_options]</span> ', esc_url( get_permalink($post_ID) ) ),
	3 => sprintf( 'Record Section published. Add hook new page or posts <span style="color: red;font-weight: 600;">[test_checkout_list_options]</span> ', esc_url( get_permalink($post_ID) ) ),
	4 => 'Запись Book сохранена.',
	6 => sprintf( 'Record Section is planned for: <strong>%1$s</strong>. Add hook new page or posts <span style="color: red;font-weight: 600;">[test_checkout_list_options]</span>',
	  // Как форматировать даты в PHP можно посмотреть тут: http://php.net/date
	  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),

  );

  return $messages;
}


$sh_cod_section = 'test_checkout_list_options';

add_shortcode( $sh_cod_section, 'rs_section_page_new' );

function rs_section_page_new(){

	 $slider = new WP_Query(array('post_type' => 'section', 'order' => 'ASC'));

	if ( $slider->have_posts() ) : ?>
			<div class="slider margin-top">
				<div class="flexslider">
					<ul class="slides">

						<?php while ( $slider->have_posts() ) : $slider->the_post(); ?>
							<li>
								<div class="slide-content">
									<?php the_content(); ?>
								</div>
								<?php the_post_thumbnail(); ?>
							</li>
						<?php endwhile; ?>
					</ul>
				</div>
			</div>
	<?php else: ?>
		<div><h2>This plase slider</h2></div>
	<?php endif; 

}