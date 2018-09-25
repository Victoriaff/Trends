<?php

$options = array(
	array(
		'analytics_options_tab' => array(
			'title' => esc_html__( 'Analytics', 'trends' ),
			'type' => 'tab',
			'options' => array(

				'google' => array(
					'title'   => esc_html__( 'Google', 'trends' ),
					'type'    => 'box',
					'attr'    => array(
						'class' => 'prevent-auto-close'
					),
					'options' => array(

						'tag_manager_code' => array(
							'type'  => 'text',
							'label' => esc_html__( 'Tag Manager Code', 'trends' ),
							'attr'  => array( 'placeholder' => 'GTM-XXXXXXX'),
							'value' => ''
						),

					)
				),

			)
		)
	)
);