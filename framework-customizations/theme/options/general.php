<?php

$options = array(
	array(
		'base_options_tab' => array(
			'title' => esc_html__( 'Base Settings', 'trends' ),
			'type' => 'tab',
			'options' => array(

				'img_lazy_load_box' => array(
					'title'   => esc_html__( 'Lazy Load', 'trends' ),
					'type'    => 'box',
					'attr'    => array(
						'class' => 'prevent-auto-close'
					),
					'options' => array(
						
						'img_lazy_load'	=> array(
							'type'  => 'switch',
							'label' => __('Lazy Load Images', 'trends'),
							'right-choice' => array(
								'value' => '1',
								'label' => __('Yes', 'trends')
							),
							'left-choice' => array(
								'value' => '0',
								'color' => '#ccc',
								'label' => __('No', 'trends')
							),
							'desc'  => __('Lazy Load Images on site', 'trends'),
						
						),

					)
				),

				'antispam_box' => array(
					'title'   => esc_html__( 'Antispam', 'trends' ),
					'type'    => 'box',
					'attr'    => array(
						'class' => 'prevent-auto-close'
					),
					'options' => array(

						'forms_antispam'	=> array(
							'type'  => 'switch',
							'label' => __('Antispam', 'trends'),
							'right-choice' => array(
								'value' => '1',
								'label' => __('Yes', 'trends')
							),
							'left-choice' => array(
								'value' => '0',
								'color' => '#ccc',
								'label' => __('No', 'trends')
							),
							'desc'  => __('Antispam for all Email Forms', 'trends'),

						),

					)
				),

			)
		)
	)
);