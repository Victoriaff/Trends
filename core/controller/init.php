<?php

namespace trends\controller;

/**
 * Theme init
 **/
class init {
	
	/**
	 * Constructor
	 **/
	function __construct() {
		
		// add theme support
		add_action( 'after_setup_theme', array( $this, 'add_theme_support' ) );
		
		// register sidebars
		add_action( 'widgets_init', array( $this, 'register_sidebars' ) );
		
	}
	
	/**
	 * Add theme support
	 **/
	function add_theme_support() {
		
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
	}
	
	/**
	 * Register theme sidebars
	 **/
	function register_sidebars() {
		
		register_sidebar( array(
			'name'          => esc_html__( 'Left Sidebar', 'trends' ),
			'id'            => 'sidebar-left',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '<div class="clearfix"></div></div></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( 'Right Sidebar', 'trends' ),
			'id'            => 'sidebar-right',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '<div class="clearfix"></div></div></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Sidebar', 'trends' ),
			'id'            => 'sidebar-shop',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '<div class="clearfix"></div></div></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Col 1 Sidebar', 'trends' ),
			'id'            => 'sidebar-footer-1',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '<div class="clearfix"></div></div></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Col 2 Sidebar', 'trends' ),
			'id'            => 'sidebar-footer-2',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '<div class="clearfix"></div></div></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Col 3 Sidebar', 'trends' ),
			'id'            => 'sidebar-footer-3',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '<div class="clearfix"></div></div></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Col 4 Sidebar', 'trends' ),
			'id'            => 'sidebar-footer-4',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '<div class="clearfix"></div></div></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		) );
		
	}
	
}
