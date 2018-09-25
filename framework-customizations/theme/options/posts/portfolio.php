<?php

$options = array(
	'details' => array(
		'title'   => esc_html__( 'Portfolio Details', 'trends' ),
		'type'    => 'box',
		'options' => array(
			
			'images' => array(
				'label'       => esc_html__( 'Gallery Images', 'trends' ),
				'type'        => 'multi-upload',
				'images_only' => true,
			),
		
		
		)
	),
);