<?php
/**
 * Page options array
 **/

$headers = Trends()->model->layout->get_default_layout( 'header' );
$footers = Trends()->model->layout->get_default_layout( 'footer' );

$choices_headers = $choices_footers = array(
	''       => esc_html__( 'Inherit', 'trends' ),
	'_none_' => esc_html__( 'None', 'trends' ),
);

foreach ( $headers->posts as $header ) {
	$choices_headers[ $header->ID ] = $header->post_title;
}

foreach ( $footers->posts as $footer ) {
	$choices_footers[ $footer->ID ] = $footer->post_title;
}

$options = array(
	'settings' => array(
		'title'   => esc_html__( 'Header & Footer options', 'trends' ),
		'type'    => 'box',
		'options' => array(
			
			'_this_header' => array(
				'label'      => esc_html__( 'Page Header', 'trends' ),
				'type'       => 'select',
				'value'      => '',
				'choices'    => $choices_headers,
				'fw-storage' => array(
					'type'      => 'post-meta',
					'post-meta' => '_this_header',
				),
			
			),
			'_this_footer' => array(
				'label'      => esc_html__( 'Page Footer', 'trends' ),
				'type'       => 'select',
				'value'      => '',
				'choices'    => $choices_footers,
				'fw-storage' => array(
					'type'      => 'post-meta',
					'post-meta' => '_this_footer',
				),
			
			)
		
		)
	),
);
