<?php

namespace trends\controller;

/**
 * Theme init
 **/
class post_types {
	
	/**
	 * Constructor
	 **/
	function __construct() {
		
		// Register Custom Post Types and Taxonomies
		add_action( 'init', array( $this, 'register_custom_post_types' ), 5 );
		
	}
	
	/**
	 * Register custom post types
	 **/
	function register_custom_post_types() {
		
		register_post_type( 'composerlayout', array(
				'label'               => esc_html__( 'Header / Footer', 'trends' ),
				'description'         => '',
				'public'              => true,
				'show_ui'             => true,
				'publicly_queryable'  => false,
				'exclude_from_search' => true,
				'show_in_nav_menus'   => false,
				'_builtin'            => false,
				'show_in_menu'        => true,
				'capability_type'     => 'post',
				'map_meta_cap'        => true,
				'hierarchical'        => false,
				'menu_position'       => null,
				'rewrite'             => false,
				'query_var'           => true,
				'supports'            => array( 'title', 'editor' ),
				'labels'              => array(
					'name'               => esc_html__( 'Header / Footer', 'trends' ),
					'singular_name'      => esc_html__( 'Header / Footer', 'trends' ),
					'menu_name'          => esc_html__( 'Header / Footer', 'trends' ),
					'add_new'            => esc_html__( 'Add New Header / Footer', 'trends' ),
					'add_new_item'       => esc_html__( 'Add New Header / Footer', 'trends' ),
					'edit'               => esc_html__( 'Edit', 'trends' ),
					'edit_item'          => esc_html__( 'Edit Header / Footer', 'trends' ),
					'new_item'           => esc_html__( 'New Header / Footer', 'trends' ),
					'view'               => esc_html__( 'View Header / Footer', 'trends' ),
					'view_item'          => esc_html__( 'View Header / Footer', 'trends' ),
					'search_items'       => esc_html__( 'Search Header / Footer', 'trends' ),
					'not_found'          => esc_html__( 'No Header / Footer Found', 'trends' ),
					'not_found_in_trash' => esc_html__( 'No Header / Footer Found in Trash', 'trends' ),
					'parent'             => esc_html__( 'Parent Header / Footer', 'trends' )
				)
			)
		);
		
		register_post_type( 'testimonials',
			array(
				'label'             => esc_html__( 'Testimonials', 'trends' ),
				'description'       => '',
				'public'            => false,
				'show_ui'           => true,
				'show_in_menu'      => true,
				'show_in_nav_menus' => true,
				'capability_type'   => 'post',
				'hierarchical'      => false,
				'supports'          => array( 'title', 'editor', 'custom-fields', 'thumbnail' ),
				'rewrite'           => false,
				'has_archive'       => false,
				'query_var'         => false,
				'menu_position'     => 5,
				'capabilities'      => array(
					'publish_posts'       => 'edit_pages',
					'edit_posts'          => 'edit_pages',
					'edit_others_posts'   => 'edit_pages',
					'delete_posts'        => 'edit_pages',
					'delete_others_posts' => 'edit_pages',
					'read_private_posts'  => 'edit_pages',
					'edit_post'           => 'edit_pages',
					'delete_post'         => 'edit_pages',
					'read_post'           => 'edit_pages',
				),
				'labels'            => array(
					'name'               => esc_html__( 'Testimonials', 'trends' ),
					'singular_name'      => esc_html__( 'Testimonial', 'trends' ),
					'menu_name'          => esc_html__( 'Testimonials', 'trends' ),
					'add_new'            => esc_html__( 'Add Testimonial', 'trends' ),
					'add_new_item'       => esc_html__( 'Add New Testimonial', 'trends' ),
					'all_items'          => esc_html__( 'All Testimonials', 'trends' ),
					'edit_item'          => esc_html__( 'Edit Testimonial', 'trends' ),
					'new_item'           => esc_html__( 'New Testimonial', 'trends' ),
					'view_item'          => esc_html__( 'View Testimonial', 'trends' ),
					'search_items'       => esc_html__( 'Search Testimonials', 'trends' ),
					'not_found'          => esc_html__( 'No Testimonials Found', 'trends' ),
					'not_found_in_trash' => esc_html__( 'No Testimonials Found in Trash', 'trends' ),
					'parent_item_colon'  => esc_html__( 'Parent Testimonial:', 'trends' )
				)
			)
		);
		
		register_taxonomy( 'testimonial_cat',
			'testimonial',
			array(
				'hierarchical'      => true,
				'show_ui'           => true,
				'query_var'         => false,
				'show_in_nav_menus' => false,
				'rewrite'           => false,
				'show_admin_column' => true,
				'labels'            => array(
					'name'          => _x( 'Testimonials Categories', 'taxonomy general name', 'trends' ),
					'singular_name' => _x( 'Testimonials Category', 'taxonomy singular name', 'trends' ),
					'search_items'  => esc_html__( 'Search in categories', 'trends' ),
					'all_items'     => esc_html__( 'All Categories', 'trends' ),
					'edit_item'     => esc_html__( 'Edit Category', 'trends' ),
					'update_item'   => esc_html__( 'Update Category', 'trends' ),
					'add_new_item'  => esc_html__( 'Add New Category', 'trends' ),
					'new_item_name' => esc_html__( 'New Category', 'trends' ),
					'menu_name'     => esc_html__( 'Categories', 'trends' )
				)
			)
		);
		
		register_post_type( 'team_members',
			array(
				'label'             => esc_html__( 'Team Members', 'trends' ),
				'description'       => '',
				'public'            => false,
				'show_ui'           => true,
				'show_in_menu'      => true,
				'show_in_nav_menus' => true,
				'capability_type'   => 'post',
				'hierarchical'      => false,
				'supports'          => array( 'title', 'editor', 'custom-fields', 'thumbnail' ),
				'rewrite'           => false,
				'has_archive'       => false,
				'query_var'         => false,
				'menu_position'     => 5,
				'capabilities'      => array(
					'publish_posts'       => 'edit_pages',
					'edit_posts'          => 'edit_pages',
					'edit_others_posts'   => 'edit_pages',
					'delete_posts'        => 'edit_pages',
					'delete_others_posts' => 'edit_pages',
					'read_private_posts'  => 'edit_pages',
					'edit_post'           => 'edit_pages',
					'delete_post'         => 'edit_pages',
					'read_post'           => 'edit_pages',
				),
				'labels'            => array(
					'name'               => esc_html__( 'Team Members', 'trends' ),
					'singular_name'      => esc_html__( 'Team Member', 'trends' ),
					'menu_name'          => esc_html__( 'Team Members', 'trends' ),
					'add_new'            => esc_html__( 'Add Team Member', 'trends' ),
					'add_new_item'       => esc_html__( 'Add New Team Member', 'trends' ),
					'all_items'          => esc_html__( 'All Team Members', 'trends' ),
					'edit_item'          => esc_html__( 'Edit Team Member', 'trends' ),
					'new_item'           => esc_html__( 'New Team Member', 'trends' ),
					'view_item'          => esc_html__( 'View Team Member', 'trends' ),
					'search_items'       => esc_html__( 'Search Team Members', 'trends' ),
					'not_found'          => esc_html__( 'No Team Members Found', 'trends' ),
					'not_found_in_trash' => esc_html__( 'No Team Members Found in Trash', 'trends' ),
					'parent_item_colon'  => esc_html__( 'Parent Team Member:', 'trends' )
				)
			)
		);
		
		register_taxonomy( 'team_members_cat',
			'team',
			array(
				'hierarchical'      => true,
				'show_ui'           => true,
				'query_var'         => false,
				'show_in_nav_menus' => false,
				'rewrite'           => false,
				'show_admin_column' => true,
				'labels'            => array(
					'name'          => _x( 'Team Members Categories', 'taxonomy general name', 'trends' ),
					'singular_name' => _x( 'Team Members Category', 'taxonomy singular name', 'trends' ),
					'search_items'  => esc_html__( 'Search in categories', 'trends' ),
					'all_items'     => esc_html__( 'All Categories', 'trends' ),
					'edit_item'     => esc_html__( 'Edit Category', 'trends' ),
					'update_item'   => esc_html__( 'Update Category', 'trends' ),
					'add_new_item'  => esc_html__( 'Add New Category', 'trends' ),
					'new_item_name' => esc_html__( 'New Category', 'trends' ),
					'menu_name'     => esc_html__( 'Categories', 'trends' )
				)
			)
		);
		
		register_post_type( 'portfolio',
			array(
				'label'             => esc_html__( 'Portfolio', 'trends' ),
				'description'       => '',
				'public'            => true,
				'show_ui'           => true,
				'show_in_menu'      => true,
				'show_in_nav_menus' => true,
				'capability_type'   => 'post',
				'hierarchical'      => false,
				'supports'          => array( 'title', 'editor', 'custom-fields', 'thumbnail' ),
				'rewrite'           => true,
				'has_archive'       => true,
				'query_var'         => true,
				'menu_position'     => 5,
				'capabilities'      => array(
					'publish_posts'       => 'edit_pages',
					'edit_posts'          => 'edit_pages',
					'edit_others_posts'   => 'edit_pages',
					'delete_posts'        => 'edit_pages',
					'delete_others_posts' => 'edit_pages',
					'read_private_posts'  => 'edit_pages',
					'edit_post'           => 'edit_pages',
					'delete_post'         => 'edit_pages',
					'read_post'           => 'edit_pages',
				),
				'labels'            => array(
					'name'               => esc_html__( 'Portfolio', 'trends' ),
					'singular_name'      => esc_html__( 'Post', 'trends' ),
					'menu_name'          => esc_html__( 'Portfolio', 'trends' ),
					'add_new'            => esc_html__( 'Add Post', 'trends' ),
					'add_new_item'       => esc_html__( 'Add New Post', 'trends' ),
					'all_items'          => esc_html__( 'All Posts', 'trends' ),
					'edit_item'          => esc_html__( 'Edit Post', 'trends' ),
					'new_item'           => esc_html__( 'New Post', 'trends' ),
					'view_item'          => esc_html__( 'View Post', 'trends' ),
					'search_items'       => esc_html__( 'Search Posts', 'trends' ),
					'not_found'          => esc_html__( 'No Posts Found', 'trends' ),
					'not_found_in_trash' => esc_html__( 'No Posts Found in Trash', 'trends' ),
					'parent_item_colon'  => esc_html__( 'Parent Post:', 'trends' )
				)
			)
		);
		
		register_taxonomy( 'portfolio_cat',
			'portfolio',
			array(
				'hierarchical'      => true,
				'show_ui'           => true,
				'query_var'         => true,
				'show_in_nav_menus' => true,
				'rewrite'           => true,
				'show_admin_column' => true,
				'labels'            => array(
					'name'          => _x( 'Categories', 'taxonomy general name', 'trends' ),
					'singular_name' => _x( 'Category', 'taxonomy singular name', 'trends' ),
					'search_items'  => esc_html__( 'Search in categories', 'trends' ),
					'all_items'     => esc_html__( 'All Categories', 'trends' ),
					'edit_item'     => esc_html__( 'Edit Category', 'trends' ),
					'update_item'   => esc_html__( 'Update Category', 'trends' ),
					'add_new_item'  => esc_html__( 'Add New Category', 'trends' ),
					'new_item_name' => esc_html__( 'New Category', 'trends' ),
					'menu_name'     => esc_html__( 'Categories', 'trends' )
				)
			)
		);
		
	}
	
	
}
