<?php
/**
 * Used for your site wide breadcrumbs
 * Support for Yoast SEO Breadcrumbs
 *
 * @package     Fabulous
 * @subpackage  Functions
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2014, Symple Workz LLC
 * @link        http://www.wpexplorer.com
 * @since       1.1.0
 * @version     1.0.0
 */

/**
 * Grid Classes
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'wpex_grid_class' ) ) {
	function wpex_grid_class( $col ) {
		return 'span_1_of_'. $col;
	}
}

/**
 * Current Entry Grid Class
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'wpex_entry_grid_class' ) ) {
	function wpex_entry_grid_class() {
		$columns = get_theme_mod( 'wpex_entry_columns', '3' );
		return $columns;
	}
}

/**
 * Check if current user has social profiles defined
 * Returns true upon the first meta found
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'wpex_author_has_social' ) ) {
	function wpex_author_has_social() {
		global $post;
		$post_author = $post->post_author;
		if ( get_the_author_meta( 'wpex_twitter', $post_author ) ) {
			return true;
		} elseif ( get_the_author_meta( 'wpex_facebook', $post_author ) ) {
			return true;
		} elseif ( get_the_author_meta( 'wpex_googleplus', $post_author ) ) {
			return true;
		} elseif ( get_the_author_meta( 'wpex_linkedin', $post_author ) ) {
			return true;
		} elseif ( get_the_author_meta( 'wpex_pinterest', $post_author ) ) {
			return true;
		} elseif ( get_the_author_meta( 'wpex_instagram', $post_author ) ) {
			return true;
		} else {
			return false;
		}
	}
}