<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div id="main-wrapper">
	
	<header id="header">
		<div class="container">
			<div class="row align-items-center">
				
				<div class="col-lg-3 header-menu">
					<?php
						$type = !isset($_REQUEST['type']) || !in_array($_REQUEST['type'], array('plugin','theme')) ? 'plugin' : $_REQUEST['type'];
					?>
					
					<a class="btn <?php echo $type == 'plugin' ? 'btn-primary':'btn-outline-primary'; ?>" href="<?php echo esc_url( add_query_arg( 'type', 'plugin' ) ); ?>">Plugins</a>
					<a class="btn <?php echo $type == 'theme' ? 'btn-primary':'btn-outline-primary'; ?>" href="<?php echo esc_url( add_query_arg( 'type', 'theme' ) ); ?>">Themes</a>
				</div>
				
			</div>
		</div>
	</header>
