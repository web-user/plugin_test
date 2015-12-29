<?php
/*
Plugin Name: Plugin Pure Theme
Plugin URI:  
Description: Plugin Work Pure Theme 
Author: Sergey
Version: 1.0 
License:
*/

add_action( 'wp_enqueue_scripts', 'wp_add_styles_script' );
add_action( 'admin_menu', 'rs_admin_menu' );

function wp_add_styles_script() {
	wp_enqueue_script( 'jquery' );
	wp_register_script( 'jquery-bxslider', plugins_url( 'js/jquery.bxslider.min.js', __FILE__ ), array('jquery') );
	wp_register_script( 'custom', plugins_url( 'js/custom.js', __FILE__ ), array('jquery') );

	wp_register_style( 'style-css', plugins_url( 'css/style.css', __FILE__ ) );
	wp_enqueue_style('jquery-bxslider', plugins_url( 'css/jquery.bxslider.css', __FILE__ ) );

	wp_enqueue_script( 'jquery-bxslider' );
	wp_enqueue_script( 'custom' );
	wp_enqueue_style( 'style-css' );

}

function rs_admin_menu() {
	add_menu_page( 'Pure Theme', 'Pure Theme', 'manage_options','rs_options_plagin', 'rs_option_page','dashicons-admin-generic', '8.2' );
	add_submenu_page( 'rs_options_plagin', __( 'Contact Form', 'rs' ), __( 'Contact Form', 'rs' ), 'manage_options', 'rs_general_options', 'rs_option_page' );
	remove_submenu_page('rs_options_plagin','rs_options_plagin');

}

/*Page Contact Form*/
function rs_option_page(){
	$options = get_option( 'rs_plagin_options' );
?>

<div class="wrap">
	<h2>Contact Form</h2>

</div>

<?php
}


/*register slideshows post type*/
function nacin_register_slideshows_post_type() {
		register_post_type( 'slideshow', array(
				'labels' => array(
						'name'          => 'Home Page Slider',
						'singular_name' => 'Pages Slider',
						'add_new'       => __( 'Add New Page Slider', 'rs' ),
						'add_new_item'  => __( 'Add Page Slider', 'rs' ),
						'edit_item'     => __( 'Edit Page Slider', 'rs' ),
						'not_found'     => __( 'No Page Slider found.', 'rs' ),
				),
				'public'       => true,
				'show_ui'      => true,
				'show_in_menu' => 'rs_options_plagin',
				'supports'     => array( 'title' ,'thumbnail', 'editor' ),
		) );
}
add_action( 'init', 'nacin_register_slideshows_post_type' );

// Add a filter to change the message when you publish a change type recording Slideshows
add_filter('post_updated_messages', 'slideshow_updated_messages');
function slideshow_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['slideshow'] = array(
	0 => '', // Not used. Messages are used to index 1.
	1 => sprintf( 'Page Slider Update. Add hook new page or posts <span style="color: red;font-weight: 600;">[test_checkout_list_options]</span> ', esc_url( get_permalink($post_ID) ) ),
	6 => sprintf( 'Record Page Slider published. Add hook new page or posts <span style="color: red;font-weight: 600;">[test_checkout_list_options]</span> ', esc_url( get_permalink($post_ID) ) ),
	3 => sprintf( 'Record Page Slider is planned for: <strong>%1$s</strong>. Add hook new page or posts <span style="color: red;font-weight: 600;">[test_checkout_list_options]</span>',
	  // How to format dates in PHP can be found here: http://php.net/date
	  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),

  );

  return $messages;
}


$sh_cod_options = 'test_checkout_list_options';
add_shortcode( $sh_cod_options, 'rs_option_page_new' );

/*function slider page show*/
function rs_option_page_new(){

	 $slider = new WP_Query(array('post_type' => 'slideshow', 'order' => 'ASC'));

	if ( $slider->have_posts() ) : ?>

		<ul class="bxslider">
			<?php while ( $slider->have_posts() ) : $slider->the_post(); ?>
				<li>
					<div class="slide-content">
						<?php the_content(); ?>
					</div>
					<?php
						$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
						$url = $thumb['0'];
					?>
					<img src="<?php echo $url; ?>">
				</li>
			<?php endwhile; ?>
		</ul>
	<?php else: ?>
		<div><h2>This plase slider</h2></div>
	<?php endif; 

}

/*register section post type*/
function nacin_register_section_post_type() {
		register_post_type( 'section', array(
				'labels' => array(
						'name'          => 'Home Page Content Sections',
						'singular_name' => 'Page Content Sections',
						'add_new'       => __( 'Add New Page Content Section', 'rs' ),
						'add_new_item'  => __( 'Add Page Content Section', 'rs' ),
						'edit_item'     => __( 'Edit Page Content Sections', 'rs' ),
						'not_found'     => __( 'No Page Content Section found.', 'rs' ),
				),
				'public'       => true,
				'show_ui'      => true,
				'show_in_menu' => 'rs_options_plagin',
				'supports'     => array( 'title' ,'thumbnail', 'editor' ),
		) );
}
add_action( 'init', 'nacin_register_section_post_type' );

// Add a filter to change the message when you publish a change type recording Section
add_filter('post_updated_messages', 'section_updated_messages');
function section_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['section'] = array(
	0 => '', // Not used. Messages are used to index 1.
	1 => sprintf( 'Section Update. Add hook new page or posts <span style="color: red;font-weight: 600;">[test_checkout_list_section]</span> ', esc_url( get_permalink($post_ID) ) ),
	6 => sprintf( 'Record Section published. Add hook new page or posts <span style="color: red;font-weight: 600;">[test_checkout_list_section]</span> ', esc_url( get_permalink($post_ID) ) ),
	3 => sprintf( 'Record Section is planned for: <strong>%1$s</strong>. Add hook new page or posts <span style="color: red;font-weight: 600;">[test_checkout_list_section]</span>',
	  // How to format dates in PHP can be found here: http://php.net/date
	  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),

  );

  return $messages;
}


$sh_cod_section = 'test_checkout_list_section';
add_shortcode( $sh_cod_section, 'rs_section_page_new' );

function rs_section_page_new(){

	 $section = new WP_Query(array('post_type' => 'section', 'order' => 'ASC'));

	if ( $section->have_posts() ) : ?>
		<article >
			<?php while ( $section->have_posts() ) : $section->the_post(); ?>
				<h2><?php the_title(); ?></h2>
					<div class="slcontent">
						<?php the_content(); ?>
					</div>
					<?php the_post_thumbnail(); ?>
			<?php endwhile; ?>
		</article>
	<?php else: ?>
	<?php endif; 

}