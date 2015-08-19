<?php
/**
 * Template Name: Blog
 *
 * @package     Fabulous
 * @subpackage  Template
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2014, Symple Workz LLC
 * @link        http://www.wpexplorer.com
 * @since       1.0.0
 */

global $post;
$wpex_entry_columns = get_post_meta( $post->ID, 'wpex_entry_columns', true );
$wpex_excerpt_length = get_post_meta( $post->ID, 'wpex_excerpt_length', true );

get_header(); ?>

	<div id="primary" class="content-area clr">
<!--         <div id="content" class="site-content left-content clr" role="main">-->
		<div id="content" class="site-content  clr" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
				global $post,$paged;
				$paged = get_query_var('paged') ? get_query_var('paged') : 1;
				$posts_per_page = get_post_meta( get_the_ID(), 'wpex_posts_per_page', true );
				$posts_per_page = $posts_per_page ? $posts_per_page : '12';
				$wp_query = new WP_Query(
					array(
						'post_type'			=> 'post',
						'posts_per_page'	=> $posts_per_page,
						'paged'				=> $paged
					)
				);
				if ( $wp_query->have_posts() ) { ?>
					<div id="blog-wrap" class="clr <?php if ( '1' != wpex_entry_grid_class() ) echo 'masonry-grid'; ?>">
						<?php
						// Begin loop
						foreach( $wp_query->posts as $post ) : setup_postdata( $post );
							get_template_part( 'content', get_post_format() );
						endforeach; ?>
					</div><!-- #blog-wrap -->
					<?php wpex_get_pagination(); ?>
				<?php } wp_reset_postdata(); wp_reset_query(); ?>
			<?php endwhile; ?>
		</div><!-- #content -->
		<?php //get_sidebar(); ?>
	</div><!-- #primary -->

<?php get_footer(); ?>