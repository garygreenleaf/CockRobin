<?php
/**
 * Outputs the post video
 * Based on the wpex_post_video custom field
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */


if ( ! function_exists( 'wpex_post_video' ) ) {
	function wpex_post_video() {
		global $post;
		$video_url = get_post_meta( $post->ID, 'wpex_post_video', true );
		if ( $video_url == '' ) return;
		echo '<div class="post-video wpex-video-embed clr">'. apply_filters( 'the_content', $video_url ) .'</div>';
	}
}