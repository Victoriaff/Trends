<?php

$options = array(
	array(
		'social_options_tab' => array(
			'title' => esc_html__( 'Social', 'trends' ),
			'type' => 'tab',
			'options' => array(

				'social_profiles-settings-box' => array(
					'title'   => esc_html__( 'Social Profiles', 'trends' ),
					'type'    => 'box',
					'attr'    => array(
						'class' => 'prevent-auto-close'
					),
					'options' => array(
						
						\trends\helper\utils::get_social_cfg_usyon()
					
					)
				),

			)
		)
	)
);