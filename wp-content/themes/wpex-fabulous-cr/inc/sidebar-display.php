<?php
/**
 * Show or hide sidebar accordingly
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */

if ( ! function_exists( 'wpex_sidebar_display' ) ) {
	function wpex_sidebar_display() {
		if ( is_singular() ) {
			global $post;
			$post_layout = get_post_meta( $post->ID, 'wpex_post_layout', true );
			if ( '' == $post_layout ) return true;
			if ( 'right-sidebar' == $post_layout || 'left-sidebar' == $post_layout ) {
				return true;
			} else {
				return false;
			}
		} else {
			if ( 'left-sidebar' == get_theme_mod( 'wpex_archives_layout' ) || 'right-sidebar' == get_theme_mod( 'wpex_archives_layout' ) ) {
				return true;
			} else {
				return false;
			}
		}
	} // End function
} // End if