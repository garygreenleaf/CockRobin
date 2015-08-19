<?php
/**
 * Outputs content for quote format
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */


if ( ! function_exists( 'wpex_quote_content' ) ) {
	function wpex_quote_content() {
		global $post;
		if ( is_rtl() ) {
			$quote_left = '<span class="quote-entry-icon fa fa-quote-right"></span>';
			$quote_right = '<span class="quote-entry-icon fa fa-quote-left"></span>';
		} else {
			$quote_left = '<span class="quote-entry-icon fa fa-quote-left"></span>';
			$quote_right = '<span class="quote-entry-icon fa fa-quote-right"></span>';
		}
		$content = get_the_content( $post->ID );
		$content = $quote_left . $content . $quote_right;
		echo apply_filters('the_content', $content); ?>
		<div class="quote-entry-source"><?php the_title(); ?></div>
	<?php }
}