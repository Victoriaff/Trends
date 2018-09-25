<?php

vc_map( array(
	'name'        => esc_html__( 'Heading', 'trends' ),
	'base'        => 'heading',
	'category'    => esc_html__( 'Theme Elements', 'trends' ),
	'description' => esc_html__( 'Add a heading', 'trends' ),
	'params'      => array(
		
		/**
		 *  Header attributes tab
		 **/
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading Title', 'trends' ),
			'description' => esc_html__( 'Write the heading title content.', 'trends' ),
			'param_name'  => 'title',
			'value'       => '',
			'holder'      => 'h2',
			'group'       => esc_html__( 'Header Attributes', 'trends' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Heading Size', 'trends' ),
			'param_name'  => 'heading',
			'save_always' => true,
			'value'       => array(
				'H1' => 'h1',
				'H2' => 'h2',
				'H3' => 'h3',
				'H4' => 'h4',
				'H5' => 'h5',
				'H6' => 'h6',
			),
			'group'       => esc_html__( 'Header Attributes', 'trends' ),
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'CSS classes', 'trends' ),
			'param_name' => 'classes',
			'value'      => '',
			'group'      => esc_html__( 'Header Attributes', 'trends' ),
		),
		array(
			'type'        => 'el_id',
			'heading'     => esc_html__( 'Element ID', 'trends' ),
			'param_name'  => 'el_id',
			'settings'    => array(
				'auto_generate' => true,
			),
			'group'       => esc_html__( 'Header Attributes', 'trends' ),
			'description' => esc_html__( 'Unique identifier of this element', 'trends' ),
		),
		
		
		/**
		 *  Styling tab
		 **/
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Header text color', 'trends' ),
			'param_name' => 'header_color',
			'value'      => '',
			'group'      => esc_html__( 'Styling', 'trends' ),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Text Align', 'trends' ),
			'param_name' => 'text_align',
			'value'      => array(
				esc_html__( '- Default -', 'trends' ) => '',
				esc_html__( 'Left', 'trends' )        => 'left',
				esc_html__( 'Center', 'trends' )      => 'center',
				esc_html__( 'Right', 'trends' )       => 'right',
			),
			'group'      => esc_html__( 'Styling', 'trends' ),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Text Transform', 'trends' ),
			'param_name' => 'text_transform',
			'value'      => array(
				esc_html__( '- Default -', 'trends' ) => '',
				esc_html__( 'None', 'trends' )        => 'none',
				esc_html__( 'Uppercase', 'trends' )   => 'uppercase',
			),
			'group'      => esc_html__( 'Styling', 'trends' ),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Font Style', 'trends' ),
			'param_name' => 'font_style',
			'value'      => array(
				esc_html__( '- Default -', 'trends' ) => '',
				esc_html__( 'Normal', 'trends' )      => 'normal',
				esc_html__( 'Italic', 'trends' )      => 'italic',
			),
			'group'      => esc_html__( 'Styling', 'trends' ),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Font Weight', 'trends' ),
			'param_name' => 'font_weight',
			'value'      => array(
				esc_html__( '- Default -', 'trends' ) => '',
				esc_html__( 'Light', 'trends' )       => 'lighter',
				esc_html__( 'Normal', 'trends' )      => 'normal',
				esc_html__( 'Bold', 'trends' )        => 'bold',
				esc_html__( 'Bolder', 'trends' )      => 'bolder',
				'100'                                                  => '100',
				'200'                                                  => '200',
				'300'                                                  => '300',
				'400'                                                  => '400',
				'500'                                                  => '500',
				'600'                                                  => '600',
				'700'                                                  => '700',
				'800'                                                  => '800',
				'900'                                                  => '900',
			),
			'group'      => esc_html__( 'Styling', 'trends' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Letter spacing', 'trends' ),
			'description' => esc_html__( 'In pixels, for example: 10', 'trends' ),
			'param_name'  => 'letter_spacing',
			'value'       => '',
			'group'       => esc_html__( 'Styling', 'trends' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Font size', 'trends' ),
			'description' => esc_html__( 'In pixels, for example: 18', 'trends' ),
			'param_name'  => 'font_size',
			'value'       => '',
			'group'       => esc_html__( 'Styling', 'trends' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Line height', 'trends' ),
			'description' => esc_html__( 'In pixels, for example: 24', 'trends' ),
			'param_name'  => 'line_height',
			'value'       => '',
			'group'       => esc_html__( 'Styling', 'trends' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Font size (small screens)', 'trends' ),
			'description' => esc_html__( 'In pixels, for example: 18', 'trends' ),
			'param_name'  => 'font_size_mobile',
			'value'       => '',
			'group'       => esc_html__( 'Styling', 'trends' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Line height (small screens)', 'trends' ),
			'description' => esc_html__( 'In pixels, for example: 24', 'trends' ),
			'param_name'  => 'line_height_mobile',
			'value'       => '',
			'group'       => esc_html__( 'Styling', 'trends' ),
		),
		array(
			'type'       => 'css_editor',
			'heading'    => esc_html__( 'Css', 'trends' ),
			'param_name' => 'css',
			'group'      => esc_html__( 'Design options', 'trends' ),
		),
	
	)
) );
