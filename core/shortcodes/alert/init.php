<?php

vc_map( array(
	'name'        => esc_html__( 'Alert', 'trends' ),
	'base'        => 'alert',
	'category'    => esc_html__( 'Theme Elements', 'trends' ),
	'description' => esc_html__( 'Add an alert', 'trends' ),
	'params'      => array(
		
		array(
			'type'       => 'textarea_html',
			'heading'    => esc_html__( 'Alert Content', 'trends' ),
			'param_name' => 'content',
			'holder'     => 'h2',
			'value'      => '',
		),
		array(
			'type'       => 'iconpicker',
			'heading'    => esc_html__( 'Icon', 'trends' ),
			'param_name' => 'icon',
			'settings'   => array(
				'emptyIcon' => true,
				'type'      => 'fontawesome',
			)
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'CSS classes', 'trends' ),
			'param_name' => 'classes',
			'value'      => '',
		),
		array(
			'type'       => 'el_id',
			'heading'    => esc_html__( 'Element ID', 'trends' ),
			'param_name' => 'el_id',
			'settings'   => array(
				'auto_generate' => true,
			),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Style', 'trends' ),
			'param_name' => 'style',
			'value'      => array(
				esc_html__( 'Primary', 'trends' )   => 'primary',
				esc_html__( 'Secondary', 'trends' ) => 'secondary',
				esc_html__( 'Success', 'trends' )   => 'success',
				esc_html__( 'Danger', 'trends' )    => 'danger',
				esc_html__( 'Warning', 'trends' )   => 'warning',
				esc_html__( 'Info', 'trends' )      => 'info',
				esc_html__( 'Light', 'trends' )     => 'light',
				esc_html__( 'Dark', 'trends' )      => 'dark',
			),
		),
	
	)
) );
