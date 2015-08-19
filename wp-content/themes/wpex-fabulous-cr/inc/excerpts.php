<?php
/**
 * This file is used for all excerpt related functions
 *
 * @package		Fabulous
 * @subpackage	Functions
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2014, Symple Workz LLC
 * @link		http://www.wpexplorer.com
 * @since		1.0.0
 */

/**
 * Custom excerpts based on wp_trim_words
 *
 * @link	http://codex.wordpress.org/Function_Reference/wp_trim_words
 * @since	1.0.0
 */
if ( ! function_exists( 'wpex_excerpt' ) ) {
	function wpex_excerpt( $length=30, $readmore=false ) {
		global $post, $wpex_excerpt_length;
		$post_id		= $post->ID;
		$more			= '&hellip;';
		$more			= apply_filters( 'wpex_excerpt_more', $more );
		$readmore_link	= '<span class="wpex-readmore"><a href="'. get_permalink( $post_id ) .'" title="'. __( 'Read more', 'wpex' ) .'" rel="bookmark">'. __( 'Read more', 'wpex' ) .'</a></span>';
		$readmore_link	= apply_filters( 'wpex_readmore_link', $readmore_link );
		$length			= $wpex_excerpt_length ? $wpex_excerpt_length : $length;
		if ( has_excerpt( $post_id ) ) {
			$output = $post->post_excerpt . $readmore_link;
		} else {
			if ( ! is_single() && strpos( $post->post_content, '<!--more-->' )  ) {
				echo the_content( __( 'Read more', 'wpex' ) );
				return;
			} else {
				$output = wp_trim_words( strip_shortcodes( get_the_content( $post_id ) ), $length, $more );
			}
			if ( $readmore ) {
				$output .= apply_filters( 'wpex_readmore_link', $readmore_link );
			}
		}
		echo $output;
	}
}

/**
 * Change default excerpt read more style
 *
 * @link	http://codex.wordpress.org/Plugin_API/Filter_Reference/excerpt_more
 * @since	1.0.0
 */
if ( ! function_exists( 'wpex_excerpt_more' ) ) {
	function wpex_excerpt_more( $more ) {
		global $post;
		return '&hellip;';
	}
	add_filter( 'excerpt_more', 'wpex_excerpt_more' );
}

/**
 * Change default more link
 *
 * @link	http://codex.wordpress.org/Customizing_the_Read_More
 * @since	1.0.0
 */
if ( ! function_exists( 'wpex_modify_read_more_link' ) ) {
	function wpex_modify_read_more_link() {
		global $post;
		return '&hellip; <span class="wpex-readmore"><a href="'. get_permalink( $post->ID ) .'" title="'. __( 'Read more', 'wpex' ) .'" rel="bookmark">'. __( 'Read more', 'wpex' ) .'</a></span>';
	}
}
add_filter( 'the_content_more_link', 'wpex_modify_read_more_link' );
