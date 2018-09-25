<?php

namespace trends\controller;

/**
 * Charts controller
 **/
class charts {

	public $charts;

	public $filters = array(
		'category'  => array('title' => 'Category'),
		'created'   => array('title' => 'Created'),
		'sales'     => array('title' => 'Total sales'),
		'sales_gap' => array('title' => 'Sales gap'),
		'author'    => array('title' => 'Author'),
		'price'     => array('title' => 'Price'),
		'rating'    => array('title' => 'Rating'),

	);

	/**
	 * Constructor
	 **/
	function __construct() {
		//$this->show();
	}

	function add_chart( $config ) {
		$this->charts[] = $config;
	}


	function show() {
		?>
		<canvas id="chartjs" class="chartjs" width="650" height="225" style="display: block; width: 650px; height: 325px;"></canvas>
		<?php
	}


}
