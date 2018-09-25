<?php

use trends\helper\front;
use trends\helper\media;

get_header(); ?>
	
<section id="content" class="container">
	<div class="row">
	
		<div class="col col-2 menu">
			
			<?php
			Trends()->data->type = !isset($_REQUEST['type']) || !in_array($_REQUEST['type'], array('plugin','theme')) ? 'plugin' : $_REQUEST['type'];
			
			$pages = array(
				'overview'  => 'Overview',
				'trends'    => 'Trends',
				'fresh'     => 'Fresh',
				'popular'   => 'Popular',
			);
			Trends()->data->page = !isset($_REQUEST['page']) ? 'overview':$_REQUEST['page'];
			
			foreach($pages as $key=>$value) {
				echo '<a class="btn '.($_REQUEST['page'] == $key ? 'btn-info':'btn-light').'" href="?type='.Trends()->data->type.'&page='.Trends()->data->page.'">'.$value.'</a>';
			}
			?>
		
		</div>

		<div class="col col-10 result">
		<?php

			if (!isset( $_REQUEST['paging'])) $_REQUEST['paging'] = 1;

			Trends()->data->query_args = $_REQUEST;
			//dump( Trends()->data->query_args );

			$stats = 'stats_'.Trends()->data->page;
			Trends()->controller->stats->$stats();

		?>

		</div>
		
	
	</div>
</section>

<?php get_footer();