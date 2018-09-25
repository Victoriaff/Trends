<?php

vc_map( array(
	'name'        => esc_html__( 'Button', 'trends' ),
	'base'        => 'button',
	'category'    => esc_html__( 'Theme Elements', 'trends' ),
	'description' => esc_html__( 'Add a button', 'trends' ),
	'params'      => array(
		
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Button title', 'trends' ),
			'param_name' => 'title',
			'holder'     => 'h2',
			'value'      => '',
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Button link', 'trends' ),
			'param_name' => 'link',
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
			'heading'    => esc_html__( 'Button Align', 'trends' ),
			'param_name' => 'button_align',
			'value'      => array(
				esc_html__( '- Default -', 'trends' ) => '',
				esc_html__( 'Left', 'trends' )        => 'left',
				esc_html__( 'Center', 'trends' )      => 'center',
				esc_html__( 'Right', 'trends' )       => 'right',
			),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Button Size', 'trends' ),
			'param_name' => 'button_size',
			'value'      => array(
				esc_html__( '- Default -', 'trends' ) => '',
				esc_html__( 'Small', 'trends' )       => 'btn-sm',
				esc_html__( 'Large', 'trends' )       => 'btn-lg',
			),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Button Style', 'trends' ),
			'param_name' => 'button_style',
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
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Outline', 'trends' ),
			'param_name' => 'outline',
			'value'      => array(
				esc_html__( 'No', 'trends' )  => '',
				esc_html__( 'Yes', 'trends' ) => 'yes',
			),
		),
		array(
			'type'       => 'css_editor',
			'heading'    => esc_html__( 'Css', 'trends' ),
			'param_name' => 'css',
			'group'      => esc_html__( 'Design options', 'trends' ),
		),
	
	
	)
) );
