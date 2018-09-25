<?php

namespace trends\controller;

/**
 * Filters controller
 **/
class filters {

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

	}

	function filter_data( $filter, $data ) {
		global $wpdb;

		$return = array();

		switch($filter) {

			case 'category':
				$result = $wpdb->get_results(
					$wpdb->prepare(
						"SELECT DISTINCT category FROM wp_trend_products WHERE type = %s ORDER BY author",
						array(Trends()->data->type)
					),
					ARRAY_N );
				foreach ( $result as $item ) {
					$return[] = $item[0];
				}
				break;

			case 'created':
				$result = $wpdb->get_results(
					$wpdb->prepare(
						"SELECT DISTINCT concat(month(created_date),'.',year(created_date)) as _date FROM wp_trend_products WHERE type = %s ORDER BY created_date DESC",
						array(Trends()->data->type)
					),
					ARRAY_N
				);
				foreach ( $result as $item ) {
					$return[] = preg_replace( '/^([1-9]{1}\.)/', '0\\1', $item[0] );
				}
				break;

			case 'sales_gap':
				$result = $wpdb->get_results(
					$wpdb->prepare("
							SELECT DISTINCT ps.record_date 
							FROM wp_trend_product_sales ps
								INNER JOIN wp_trend_products p ON p.envato_id = ps.envato_id and p.type = %s   
							ORDER BY ps.record_date DESC
						",
						array(Trends()->data->type)
					),
					ARRAY_N
				);
				foreach ( $result as $item ) {
					$return[] = preg_replace( '/^([0-9]{4})\-([0-9]{2})\-([0-9]{2})/', '\\3.\\2.\\1', $item[0] );
				}
				break;

			case 'author':
				$result = $wpdb->get_results(
					$wpdb->prepare(
						"SELECT DISTINCT author FROM wp_trend_products WHERE type = %s ORDER BY author",
						array(Trends()->data->type)
					),
				ARRAY_N );
				foreach ( $result as $item ) {
					$return[] = $item[0];
				}
				break;
		}

		return $return;
	}

	function show_filter( $filter, $filter_data ) {

		switch($filter) {
			case 'category':
				echo '<select id="fcat" class="form-control"><option value=""></option>';
				foreach($filter_data as $value) {
					$selected=  isset(Trends()->data->query_args['fcat']) && $value == Trends()->data->query_args['fcat'] ? ' selected':'';
					echo '<option '.$selected.'>'.$value.'</option>';
				}
				echo '</select>';
				break;

			case 'created':
				echo '<select id="fcfrom" class="form-control"><option value=""></option>';
				foreach($filter_data as $value) {
					$selected=  isset(Trends()->data->query_args['fcfrom']) && $value == Trends()->data->query_args['fcfrom'] ? ' selected':'';
					echo '<option '.$selected.'>'.$value.'</option>';
				}
				echo '</select> ... ';

				echo '<select id="fcto" class="form-control"><option value=""></option>';
				foreach($filter_data as $value) {
					$selected=  isset(Trends()->data->query_args['fcto']) && $value == Trends()->data->query_args['fcto'] ? ' selected':'';
					echo '<option '.$selected.'>'.$value.'</option>';
				}
				echo '</select>';
				break;

			case 'sales':
				echo '<input type="text" id="fsfrom" class="form-control" value="'.esc_attr(Trends()->data->query_args['fsfrom']).'">';
				echo ' ... ';
				echo '<input type="text" id="fsto" class="form-control" value="'.esc_attr(Trends()->data->query_args['fsto']).'">';
				break;

			case 'sales_gap':
				echo '<select id="fsgfrom" class="form-control"><option value=""></option>';
				foreach($filter_data as $value) {
					$selected=  isset(Trends()->data->query_args['fsgfrom']) && $value == Trends()->data->query_args['fsgfrom'] ? ' selected':'';
					echo '<option '.$selected.'>'.$value.'</option>';
				}
				echo '</select> ... ';

				echo '<select id="fsgto" class="form-control"><option value=""></option>';
				foreach($filter_data as $value) {
					$selected=  isset(Trends()->data->query_args['fsgto']) && $value == Trends()->data->query_args['fsgto'] ? ' selected':'';
					echo '<option '.$selected.'>'.$value.'</option>';
				}
				echo '</select>';
				break;

			case 'author':
				echo '<select id="fauthor" class="form-control"><option value=""></option>';
				foreach($filter_data as $value) {
					$selected=  isset(Trends()->data->query_args['fauthor']) && $value == Trends()->data->query_args['fauthor'] ? ' selected':'';
					echo '<option '.$selected.'>'.$value.'</option>';
				}
				echo '</select>';
				break;

			case 'price':
				echo '<span class="prepend">$</span><input type="text" id="fpfrom" class="form-control" value="'.esc_attr(Trends()->data->query_args['fpfrom']).'">';
				echo ' ... ';
				echo '<span class="prepend">$</span><input type="text" id="fpto" class="form-control" value="'.esc_attr(Trends()->data->query_args['fpto']).'">';
				break;

			case 'rating':
				echo '<input type="text" id="frfrom" class="form-control" value="'.esc_attr(Trends()->data->query_args['frfrom']).'">';
				echo ' ... ';
				echo '<input type="text" id="frto" class="form-control" value="'.esc_attr(Trends()->data->query_args['frto']).'">';
				break;
		}

	}


}
