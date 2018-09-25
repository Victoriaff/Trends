<?php

namespace trends\model;

class layout {
	
	/*
	* Get default composer layout
	*/
	function get_default_layout( $layout_type = 'header' ) {
		$args                 = array(
			'post_type'      => 'composerlayout',
			'posts_per_page' => 1,
			'post_status'    => 'publish',
			'meta_query'     => array(
				'relation' => 'AND',
				array(
					'key'   => '_layouttype',
					'value' => $layout_type,
				),
				array(
					'key'   => '_appointment',
					'value' => 'default',
				),
			
			)
		);
		$default_layout_query = new \WP_Query( $args );
		wp_reset_query();
		
		return $default_layout_query;
		
	}
	
	/*
	* Get all composer layouts
	*/
	function get_layouts( $layout_type = 'header' ) {
		
		$args    = array(
			'post_type'      => 'composerlayout',
			'posts_per_page' => - 1,
			'post_status'    => 'publish',
			'meta_query'     => array(
				'composerlayout_layouttype' => array(
					'key'   => '_layouttype',
					'value' => $layout_type,
				),
			),
			'order'          => 'ASC',
		);
		$layouts = new \WP_Query( $args );
		wp_reset_query();
		
		return $layouts;
		
	}
}