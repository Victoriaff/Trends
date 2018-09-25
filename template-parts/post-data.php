<div class="post-data">
	<span class="date">
		<?php the_time( 'F d, Y' ); ?>
	</span> <span class="separator">|</span>
	<span class="author">
		<?php esc_html_e( 'By', 'trends' ); ?><?php the_author_link(); ?>
	</span>
	<?php if ( is_single() ): ?>
		<span class="separator">|</span> <span class="comments">
			<?php comments_number( '0', '1', '%' ); ?>
		</span>
	<?php endif; ?>
	<div class="clearfix"></div>
</div>
