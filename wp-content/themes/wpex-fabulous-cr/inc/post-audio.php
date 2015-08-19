<?php
/**
 * Outputs the post audio
 * Based on the wpex_post_audio custom field
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */


if ( ! function_exists( 'wpex_post_audio' ) ) {
	function wpex_post_audio() {
		global $post;
		if ( !is_singular() && !get_theme_mod( 'wpex_entry_embeds', '1' ) ) return;
		if ( !is_singular() && 'on' == get_post_meta( $post->ID, 'wpex_disable_entry_embed', true ) ) return;
		$audio_url = get_post_meta( $post->ID, 'wpex_post_audio', true );
		if ( $audio_url == '' ) return;
		echo '<div class="post-audio wpex-audio-embed clr">'. apply_filters( 'the_content', $audio_url ) .'</div>';
	}
}

if ( ! function_exists( 'wpex_responsive_audio' ) ) {
	function wpex_responsive_audio( $html ){
		return str_replace( '<audio', '<audio width="100%"', $html );
	}
}
add_filter( 'wp_audio_shortcode', 'wpex_responsive_audio' );