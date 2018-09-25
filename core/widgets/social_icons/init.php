<?php

// Init the widget
add_action( 'widgets_init', function () {
	register_widget( \trends\widgets\social_icons\widget::class );
} );
