<?php
/**
 * Displays post featured image
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */


if ( ! function_exists( 'wpex_post_featured_image' ) ) {
	function wpex_post_featured_image() {
		global $post;
		if ( ! has_post_thumbnail( $post->ID ) ) return;
		if ( ! get_theme_mod( 'wpex_blog_post_thumb', '1' ) ) return;
		if ( 'on' == get_post_meta( $post->ID, 'wpex_disable_featured_image', true ) ) return; ?>
		<div class="post-thumbnail">
			<img src="<?php echo wpex_get_featured_img_url(); ?>" alt="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" />
		</div><!-- .post-thumbnail -->
	<?php
	} // End function
} // End if