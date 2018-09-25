<?php
/**
 * @string $id shortcode ID
 * @array $atts shortcode attributes
 * @mixed $content
 **/

$atts = $data['atts'];

$css = '';

extract( shortcode_atts( array(
	'css' => ''
), $atts ) );

$css_class = $this->get_css_class( $css, $data );

if ( isset( $atts['button_style'] ) && $atts['button_style'] <> '' ) {
	if ( isset( $atts['outline'] ) && filter_var( $atts['outline'], FILTER_VALIDATE_BOOLEAN ) ) {
		$css_class .= ' btn-outline-' . $atts['button_style'];
	} else {
		$css_class .= ' btn-' . $atts['button_style'];
	}
} else {
	$css_class .= ' btn-primary';
}

if ( isset( $atts['button_size'] ) && $atts['button_size'] <> '' ) {
	$css_class .= ' ' . $atts['button_size'];
}

?>
<?php if ( $atts['button_align'] <> '' ): ?>
	<div class="align-<?php echo esc_attr( $atts['button_align'] ); ?>">
<?php endif; ?>
	<a href="<?php echo esc_attr( $atts['link'] ); ?>" id="<?php echo esc_attr( $id ); ?>"
	   class="btn <?php echo esc_attr( $css_class ); ?>">
		
		<?php if ( $is_styled ): ?>
		<span class="inside"><span class="text">
	<?php endif; ?>
				
				<?php echo wp_kses_post( $atts['title'] ); ?>
				
				<?php if ( $atts['icon'] <> '' ): ?>
					<i class="<?php echo esc_attr( $atts['icon'] ); ?>"></i>
				<?php endif; ?>
				
				<?php if ( $is_styled ): ?>
		</span></span>
	<?php endif; ?>
	
	</a>
<?php if ( $atts['button_align'] <> '' ): ?>
	</div>
<?php endif;
