<?php

namespace trends\controller;

/**
 * Stats
 **/
class stats {

	public $data;


	/**
	 * Constructor
	 **/
	function __construct() {
		


	}

	/**
	 * Overview page
	 *
	 * */
	function stats_overview() {

		$this->data = array(
			'sql' => array(
				'query' => 'SELECT {fields} FROM wp_trend_products p {where} {order} {limit}',
				'fields' => '*',
				'where' => 	array( "type = %s" ),
				'prepare' => array( Trends()->data->type )
			),
			'filters' => array(
				'category' => array(),
				'created' => array(),
				'sales' => array(),
				//'sales_gap' => array(),
				'author' => array(),
				'price' => array(),
				'rating' => array(),
			),
			'table' => array(
				'options' => array(
					'headers' => array(
						'name'          => array('title' => 'Name'),
						'sales'         => array('title' => 'Total sales', 'style' => 'text-align:right'),
						'price'         => array('title' => 'Price'),
						'created_date'  => array('title' => 'Created', 'noWrap' => true),
						'author'        => array('title' => 'Author', 'noWrap' => true),
						'rating'        => array('title' => 'Rating'),
					),
				)
			),
			'chart' => array(
				'options' => array(
					'headers' => array(
						'name'          => array('title' => 'Name'),
						'sales'         => array('title' => 'All sales'),
						'price'         => array('title' => 'Price'),
						'created_date'  => array('title' => 'Created'),
						'author'        => array('title' => 'Author'),
						'rating'        => array('title' => 'Rating'),
					)
				)
			)
		);

		$this->stats_show();
	}

	function stats_show() {
		$order = isset($_REQUEST['order']) ? $_REQUEST['order']:'name';
		$this->data['table']['options']['order'] = $order;

		$dir = isset($_REQUEST['dir']) ? $_REQUEST['dir']:'asc';
		$this->data['table']['options']['dir'] = $dir;

		$this->data['sql']['order'] = $this->data['table']['options']['order'].' '.$this->data['table']['options']['dir'];
		$this->data['sql']['limit'] = (Trends()->data->query_args['paging']-1)*Trends()->data->per_page.', '.Trends()->data->per_page;

		$this->show_filters();

		$this->sql_conditions();


		$this->show_result();
	}


	function sql_conditions() {

		foreach(Trends()->data->query_args as $param=>$value)
		{
			switch($param) {
				// Category
				case 'category':
						$this->data['sql']['where'][] = "category = %s";
						$this->data['sql']['prepare'][] = $value;
					break;

				// Created
				case 'fcfrom':
					$this->data['sql']['where'][] = "created_date >= %s";
					$this->data['sql']['prepare'][] = preg_replace('/([0-9]{2,})\.([0-9]{4,})/', '\\2-\\1-01', $value);
					break;
				case 'fcto':
					$this->data['sql']['where'][] = "created_date <= %s";
					$this->data['sql']['prepare'][] = preg_replace('/([0-9]{2,})\.([0-9]{4,})/', '\\2-\\1-01', $value);
					break;

				// Sales
				case 'fsfrom':
					$this->data['sql']['where'][] = "sales >= %d";
					$this->data['sql']['prepare'][] = $value;
					break;
				case 'fsto':
					$this->data['sql']['where'][] = "sales <= %d";
					$this->data['sql']['prepare'][] = $value;
					break;

				// Price
				case 'fpfrom':
					$this->data['sql']['where'][] = "price >= %6.2f";
					$this->data['sql']['prepare'][] = $value;
					break;
				case 'fpto':
					$this->data['sql']['where'][] = "price <= %6.2f";
					$this->data['sql']['prepare'][] = $value;
					break;

				// Author
				case 'fauthor':
					$this->data['sql']['where'][] = "author = %s";
					$this->data['sql']['prepare'][] = $value;
					break;

				// Rating
				case 'frfrom':
					$this->data['sql']['where'][] = "rating >= %6.2f";
					$this->data['sql']['prepare'][] = $value;
					break;
				case 'frto':
					$this->data['sql']['where'][] = "rating <= %6.2f";
					$this->data['sql']['prepare'][] = $value;
					break;

			}
		}

	}


	function show_filters() {
		?>
		<div class="row filters">
			<?php
			foreach($this->data['filters'] as $filter=>$data) {
				echo '<div class="col col-6">';
				echo '<div class="form-group">';
                    echo '<label for="f_'.$filter.'" class="">'. Trends()->controller->filters->filters[$filter]['title'].':</label>';

					$filter_data = Trends()->controller->filters->filter_data( $filter, $this->data );
					Trends()->controller->filters->show_filter( $filter, $filter_data );

				echo '</div>';
				echo '</div>';
			}
			?>
		</div>
		<button class="btn-filter btn btn-info">Filter</button>
		<button class="btn-clear btn btn-light">Clear</button>

		<?php
	}

	function show_result() {
		global $wpdb;

		// Get records count
		$this->data['sql']['count'] = $this->sql_count();

		//dump($this->data['sql']);

		if ($this->data['sql']['count']) {
			$where = ! empty( $this->data['sql']['where'] ) ? 'WHERE ' . implode( ' and ', $this->data['sql']['where'] ) : '';

			$search  = array(
				'/\{fields\}/',
				'/\{where\}/',
				'/\{order\}/',
				'/\{limit\}/',
			);
			$replace = array(
				$this->data['sql']['fields'],
				$where,
				' ORDER BY ' . $this->data['sql']['order'],
				' LIMIT ' . $this->data['sql']['limit']
			);
			$sql     = preg_replace( $search, $replace, $this->data['sql']['query'] );

			//dump( $sql );
			//dump( $wpdb->prepare( $sql, $this->data['sql']['prepare'] ) );

			$this->data['data'] = $wpdb->get_results( $wpdb->prepare( $sql, $this->data['sql']['prepare'] ), ARRAY_A );

			$this->show_tabs();
			$this->show_table();
			$this->show_charts();
		}
	}

	function show_tabs() {
		$html = '<div class="tabs">';
			$html .= '<div class="tab" data-tab="table">Table</div>';
			$html .= '<div class="tab active" data-tab="charts">Charts</div>';
		$html .= '</div>';
		echo $html;
	}

	function show_table() {

		$html = '<div class="tab-content hide" data-tab="table">';
			$html .= '<table class="table">';
			$html .= '<thead><tr>';
			$html .= '<th>#</th>';
			$html .= '<th>Url</th>';

			foreach($this->data['table']['options']['headers'] as $header_key=>$header)
			{
				if ($this->data['table']['options']['order']==$header_key) {
					$fa_class = 'fa-sort-'.$this->data['table']['options']['dir'];
					$dir = $this->data['table']['options']['dir'] == 'asc' ? 'desc':'asc';
				} else {
					$fa_class = 'fa-sort';
					$dir = 'asc';
				}
				$query_args = array(
					'page'  => Trends()->data->page,
					'order' => $header_key,
					'dir'   => $dir
				);
				$html .= '<th noWrap><a href="'.esc_url( add_query_arg( $query_args ) ).'">'.$header['title'].'</a> <i class="fa '.$fa_class.'"></i></th>';
			}
			$html .= '<tr><thead>';

			$html .= '<tbody>';
			foreach($this->data['data'] as $key=>$item) {
				$html .= '<tr>';
				$html .= '<td>'.sprintf("%'02s", $key + (Trends()->data->query_args['paging']-1)*Trends()->data->per_page + 1).'</td>';
				$html .= '<td><a href="'.$item['url'].'" target="_blank"><i class="fa fa-external-link"></i></a></td>';
				foreach($this->data['table']['options']['headers'] as $header_key=>$header) {
					if ($header_key=='price') $item[$header_key] = '$'.$item[$header_key];
					$html .= '<td '.(isset($header['noWrap']) ? 'noWrap':'').' '.(isset($header['style']) ? 'style="'.$header['style'].'"':'').'>'.$item[$header_key].'</td>';
				}
				$html .= '</tr>';
			}
			$html .= '</tbody>';

			$html .= '</table>';
			echo $html;

			// Paging
			$this->paging();

		echo '</div>';
	}

	function show_charts() {

		$html = '<div class="tab-content show" data-tab="charts">Charts';


		Trends()->controller->charts->add_chart( array(
			'id' => 'chart',

		));

		Trends()->controller->charts->show();

		$html .= '</div>';

		echo $html;
	}


	/**
	 * Records count
	 **/
	function sql_count() {
		global $wpdb;

		$where = !empty($this->data['sql']['where']) ? 'WHERE '.implode(' and ', $this->data['sql']['where']) : '';
		$search = array(
			'/\{fields\}/',
			'/\{where\}/',
			'/\{order\}/',
			'/\{limit\}/',
		);
		$replace = array(
			'count(*)',
			$where,
			'',
			''
		);
		$sql = preg_replace($search, $replace, $this->data['sql']['query']);
		//dump($wpdb->prepare( $sql, $this->data['sql']['prepare'] ));
		$result = $wpdb->get_results( $wpdb->prepare( $sql, $this->data['sql']['prepare'] ), ARRAY_N );

		return $result[0][0];
	}

	/**
	 * Paging
	 **/
	function paging() {

		$pages = ceil($this->data['sql']['count'] / Trends()->data->per_page);
		?>
		<div class="row paging">
			<div class="col-2 total">
				Total items: <strong><?php echo $this->data['sql']['count']; ?></strong>
			</div>
			<?php if ($pages > 1) { ?>
			<div class="col-10 pages">
				<?php
					$query_args = Trends()->data->query_args;


					$start = Trends()->data->query_args['paging'] - 10;
					if ($start < 1) $start = 1;

					$end = $start + 19;
					if ($end > $pages) $end = $pages;

					for($i=$start; $i<=$end; $i++) {
						if ( $i == Trends()->data->query_args['paging'] ) {
							echo '<span>' . $i . '</span>';
						} else {
							$query_args['paging'] = $i;
							echo '<a href="'.esc_url( add_query_arg( $query_args ) ).'">' . $i . '</a>';
						}
					}
					if ($pages > 20) {
						echo '<select>';
						for($i=1; $i<=$pages; $i++) {
							echo '<option>'.$i.'</option>';
						}
						echo '</select>';
					}
				?>
			</div>
			<?php } ?>
		</div>
		<?php

	}


}
