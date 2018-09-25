<?php

vc_map( array(
	'name'        => esc_html__( 'Posts', 'trends' ),
	'base'        => 'posts',
	'category'    => esc_html__( 'Theme Elements', 'trends' ),
	'description' => esc_html__( 'Any post type with pagination', 'trends' ),
	'params'      => array(
		
		/**
		 *  Query tab
		 **/
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Post type', 'trends' ),
			'param_name' => 'post_type',
			'value'      => array(
				esc_html__( 'Blog post', 'trends' )            => 'post',
				esc_html__( 'Portfolio', 'trends' )            => 'portfolio',
				esc_html__( 'Testimonials', 'trends' )         => 'testimonials',
				esc_html__( 'Team Members', 'trends' )         => 'team_members',
				esc_html__( 'WooCommerce Products', 'trends' ) => 'product',
			),
			'group'      => esc_html__( 'General', 'trends' ),
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Posts per page', 'trends' ),
			'param_name' => 'posts_per_page',
			'value'      => '9',
			'group'      => esc_html__( 'General', 'trends' ),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Posts ordering method', 'trends' ),
			'param_name' => 'orderby',
			'value'      => array(
				esc_html__( 'Date', 'trends' )          => 'date',
				esc_html__( 'ID', 'trends' )            => 'ID',
				esc_html__( 'Modified date', 'trends' ) => 'modified',
				esc_html__( 'Title', 'trends' )         => 'title',
				esc_html__( 'Random', 'trends' )        => 'rand',
				esc_html__( 'Menu', 'trends' )          => 'menu',
			),
			'group'      => esc_html__( 'General', 'trends' ),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Posts sorting method', 'trends' ),
			'param_name' => 'order',
			'value'      => array(
				esc_html__( 'Descending', 'trends' ) => 'DESC',
				esc_html__( 'Ascending', 'trends' )  => 'ASC',
			),
			'group'      => esc_html__( 'General', 'trends' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Query from category', 'trends' ),
			'param_name'  => 'tax_query_type',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'All', 'trends' )    => '',
				esc_html__( 'Only', 'trends' )   => 'only',
				esc_html__( 'Except', 'trends' ) => 'except',
			),
			'group'       => esc_html__( 'General', 'trends' ),
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Taxonomy slug', 'trends' ),
			'param_name' => 'taxonomy_slug',
			'value'      => 'category',
			'dependency' => array(
				'element' => 'tax_query_type',
				'value'   => array( 'only', 'except' ),
			),
			'group'      => esc_html__( 'General', 'trends' ),
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Categories', 'trends' ),
			'description' => esc_html__( 'Type here category slugs to include or exclude, based on previous parameter. Explode multiple categories slugs by comma', 'trends' ),
			'param_name'  => 'taxonomy_terms',
			'admin_label' => true,
			'value'       => '',
			'dependency'  => array(
				'element' => 'tax_query_type',
				'value'   => array( 'only', 'except' ),
			),
			'group'       => esc_html__( 'General', 'trends' ),
		),
		array(
			'type'        => 'el_id',
			'heading'     => esc_html__( 'Element ID', 'trends' ),
			'param_name'  => 'el_id',
			'settings'    => array(
				'auto_generate' => true,
			),
			'group'       => esc_html__( 'General', 'trends' ),
			'description' => esc_html__( 'Unique identifier of this element', 'trends' ),
		),
		
		/**
		 *  Pagination tab
		 **/
		array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Display pagination', 'trends' ),
			'param_name' => 'pagination',
			'value'      => array( esc_html__( 'Yes', 'trends' ) => 'yes' ),
			'group'      => esc_html__( 'Pagination', 'trends' ),
			'std'        => 'yes'
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Pagination button text', 'trends' ),
			'param_name' => 'ajax_load_more_button_text',
			'dependency' => array(
				'element'   => 'pagination',
				'not_empty' => true,
			),
			'value'      => esc_html__( 'Load more', 'trends' ),
			'group'      => esc_html__( 'Pagination', 'trends' ),
		),
		
		/**
		 *  Appearance tab
		 **/
		array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Display thumbnail', 'trends' ),
			'param_name' => 'display_thumb',
			'value'      => array( esc_html__( 'Yes', 'trends' ) => 'yes' ),
			'group'      => esc_html__( 'Appearance', 'trends' ),
			'std'        => 'yes'
		),
		array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Display post title', 'trends' ),
			'param_name' => 'display_title',
			'value'      => array( esc_html__( 'Yes', 'trends' ) => 'yes' ),
			'group'      => esc_html__( 'Appearance', 'trends' ),
			'std'        => 'yes'
		),
		array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Display post excerpt', 'trends' ),
			'param_name' => 'display_excerpt',
			'value'      => array( esc_html__( 'Yes', 'trends' ) => 'yes' ),
			'group'      => esc_html__( 'Appearance', 'trends' ),
			'std'        => 'yes'
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Excerpt lenght', 'trends' ),
			'description' => esc_html__( 'how many words should we display?', 'trends' ),
			'param_name'  => 'excerpt_length',
			'value'       => '13',
			'dependency'  => array(
				'element'   => 'display_excerpt',
				'not_empty' => true,
			),
			'group'       => esc_html__( 'Appearance', 'trends' ),
		),
		
		/**
		 *  Style tab
		 **/
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Thumbnails dimensions', 'trends' ),
			'param_name' => 'thumbs_dimensions',
			'value'      => array(
				esc_html__( 'Original size (full)', 'trends' ) => '',
				esc_html__( 'Crop thumbnails', 'trends' )      => 'crop',
			),
			'group'      => esc_html__( 'Style', 'trends' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Thumbnail width', 'trends' ),
			'description' => esc_html__( 'value in pixels, e.g.: 320', 'trends' ),
			'param_name'  => 'thumb_width',
			'value'       => '320',
			'dependency'  => array(
				'element' => 'thumbs_dimensions',
				'value'   => array( 'crop' ),
			),
			'group'       => esc_html__( 'Style', 'trends' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Thumbnail height', 'trends' ),
			'description' => esc_html__( 'value in pixels, e.g.: 320', 'trends' ),
			'param_name'  => 'thumb_height',
			'value'       => '180',
			'dependency'  => array(
				'element' => 'thumbs_dimensions',
				'value'   => array( 'crop' ),
			),
			'group'       => esc_html__( 'Style', 'trends' ),
		),
	
	),
) );
