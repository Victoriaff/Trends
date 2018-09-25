<?php

vc_map( array(
	'name'        => esc_html__( 'Map', 'trends' ),
	'base'        => 'g_map',
	'category'    => esc_html__( 'Theme Elements', 'trends' ),
	'description' => esc_html__( 'Add Google Map', 'trends' ),
	'params'      => array(
		
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Google API Key', 'trends' ),
			'description' => esc_html__( 'Insert here your Google API Key to avoid request limitations and JavaScript errors.', 'trends' ),
			'param_name'  => 'api_key',
			'value'       => '',
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Address', 'trends' ),
			'param_name' => 'address',
			'value'      => '',
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Map Height', 'trends' ),
			'param_name' => 'height',
			'value'      => '650',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Map zoom', 'trends' ),
			'param_name'  => 'zoom',
			'save_always' => true,
			'value'       => array(
				'16' => '16',
				'15' => '15',
				'14' => '14',
				'13' => '13',
				'12' => '12',
				'11' => '11',
				'10' => '10',
				'9'  => '9',
				'8'  => '8',
				'7'  => '7',
				'6'  => '6',
				'5'  => '5',
				'4'  => '4',
				'3'  => '3',
				'2'  => '2',
				'1'  => '1',
			),
		),
		
		array(
			'type'       => 'attach_image',
			'heading'    => esc_html__( 'Pin Icon', 'trends' ),
			'param_name' => 'pin_icon',
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Pin offset X', 'trends' ),
			'param_name' => 'pin_offset_x',
			'value'      => 0,
			'default'    => 0,
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Pin offset Y', 'trends' ),
			'param_name' => 'pin_offset_y',
			'value'      => 0,
			'default'    => 0,
		),
		array(
			'type'        => 'el_id',
			'heading'     => esc_html__( 'Element ID', 'trends' ),
			'param_name'  => 'el_id',
			'settings'    => array(
				'auto_generate' => true,
			),
			'description' => esc_html__( 'Unique identifier of this element', 'trends' ),
		),
		
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Hue', 'trends' ),
			'param_name' => 'hue',
			'value'      => '#e5e5e5',
			'group'      => esc_html__( 'Styling', 'trends' ),
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Saturation', 'trends' ),
			'param_name' => 'saturation',
			'value'      => '-100',
			'group'      => esc_html__( 'Styling', 'trends' ),
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Lightness', 'trends' ),
			'param_name' => 'lightness',
			'value'      => '50',
			'group'      => esc_html__( 'Styling', 'trends' ),
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Gamma', 'trends' ),
			'param_name' => 'gamma',
			'value'      => '1',
			'group'      => esc_html__( 'Styling', 'trends' ),
		),
	
	)
) );
