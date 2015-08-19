<?php
/**
 * Custom pagination functions
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */

/**
	Return correct pagination style
**/
if ( ! function_exists( 'wpex_get_pagination') ) {
	function wpex_get_pagination() {
		$style = get_theme_mod( 'wpex_pagination', 'infinite-scroll' );
		if ( is_singular( 'page' ) ) {
			global $post;
			if ( '' != get_post_meta( $post->ID, 'wpex_pagination_style', true ) ) {
				$style = get_post_meta( $post->ID, 'wpex_pagination_style', true );
			}
		}
		if ( 'infinite-scroll' == $style ) {
			wpex_infinite_scroll();
		}
		if ( 'standard' == $style ) {
			wpex_pagination();
		}
	}
}

/**
	Numbered pagination
**/
if ( ! function_exists( 'wpex_pagination') ) {
	function wpex_pagination() {
		global $wp_query,$wpex_query;
		if ( $wpex_query ) {
			$total = $wpex_query->max_num_pages;
		} else {
			$total = $wp_query->max_num_pages;
		}
		$big = 999999999; // need an unlikely integer
		if ( $total > 1 )  {
			if ( !$current_page = get_query_var( 'paged') )
			 $current_page = 1;
			if ( get_option( 'permalink_structure') ) {
			 $format = 'page/%#%/';
			} else {
			 $format = '&paged=%#%';
			}
			if ( is_rtl() ) {
				$prev_link = '<i class="fa fa-angle-right"></i>';
				$next_link = '<i class="fa fa-angle-left"></i>';
			} else {
				$prev_link = '<i class="fa fa-angle-left"></i>';
				$next_link = '<i class="fa fa-angle-right"></i>';
			}
			echo paginate_links(array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => $format,
				'current' => max( 1, get_query_var( 'paged') ),
				'total' => $total,
				'mid_size' => 2,
				'type' => 'list',
				'prev_text' => $prev_link,
				'next_text' => $next_link,
			 ));
		}
	}
}


/**
	Next/Previous page style pagination used for infinite scroll
**/
if ( !function_exists( 'wpex_infinite_scroll') ) {
	function wpex_infinite_scroll($pages = '', $range = 4) {
		$showitems = ($range * 2)+1; 
		global $paged;
		if ( empty($paged) ) $paged = 1;
		if ( $pages == '' ) {
			global $wp_query,$wpex_query;
			if ( $wpex_query ) {
				$pages = $wpex_query->max_num_pages;
			} else {
				$pages = $wp_query->max_num_pages;
			}
			if (!$pages) {
				$pages = 1;
			}
		}
		if ( 1 != $pages ) {
			echo '<div class="page-jump clr"><div class="newer-posts alignleft">';
			previous_posts_link( '&larr; ' . __( 'Newer Posts', 'wpex' ) );
			echo '</div><div class="older-posts alignright">';
			next_posts_link( __( 'Older Posts', 'wpex' ) .' &rarr;' );
			echo '</div></div>';
		}
		
	}
}