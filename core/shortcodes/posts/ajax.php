<?php

namespace trends\shortcodes\posts;

add_action( 'wp_ajax_shortcode_load_posts', __NAMESPACE__ . '\\load_posts' );
add_action( 'wp_ajax_nopriv_shortcode_load_posts', __NAMESPACE__ . '\\load_posts' );

function load_posts() {
	
	// get shortcode atts and give them to loop item template
	$shortcode_atts = json_decode( stripslashes( $_POST['shortcode_atts'] ), true );
	// make sure that they secure
	$shortcode_atts = \trends\helper\utils::sanitize_array_text_params( $shortcode_atts );
	
	// get query vars from shortcode
	$query_vars = json_decode( stripslashes( $_POST['query_vars'] ), true );
	// increase current page number for AJAX pagination
	$query_vars['paged'] = absint( $_POST['paged'] ) + 1;
	// make sure that all settings are secure
	$query_vars = \trends\helper\utils::sanitize_array_text_params( $query_vars );
	
	// query for posts
	$query = Trends()->model->post->get_posts( $query_vars );
	
	// display posts
	while ( $query->have_posts() ): $query->the_post();
		
		Trends()->view->load( '/view/loop_item', array(
			'atts' => $shortcode_atts
		), false, dirname( __FILE__ ) );
	
	endwhile;
	
	exit;
}