<?php
/**
 * The template for displaying Author archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Fabulous
 * @subpackage  Template
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2014, Symple Workz LLC
 * @link        http://www.wpexplorer.com
 * @since       1.0.0
 */

get_header(); ?>

	<div id="primary" class="content-area clr">
		<div id="content" class="site-content left-content clr" role="main">
			<?php if ( have_posts() ) : the_post(); ?>
				<header class="archive-header clr">
					<h1 class="archive-header-title"><?php _e( 'Articles Written By', 'wpex' ); ?>: <?php echo get_the_author() ?></h1>
					<div class="archive-description clr">
						<?php
						$wpex_post_count = count_user_posts( get_query_var( 'author' ) );
						echo sprintf( __( 'This author has written %s articles', 'wpex' ), $wpex_post_count ); ?>
					</div><!-- #archive-description -->
				</header><!-- .archive-header -->
				<?php rewind_posts(); ?>
				<div id="blog-wrap" class="clr <?php if ( '1' != wpex_entry_grid_class() ) echo 'masonry-grid'; ?>">
					<?php
					// Begin loop
					while ( have_posts() ) : the_post();
						get_template_part( 'content', get_post_format() );
					endwhile; ?>
				</div><!-- #blog-wrap -->
				<?php wpex_get_pagination(); ?>
			<?php endif; ?>
		</div><!-- #content -->
		<?php get_sidebar(); ?>
	</div><!-- #primary -->

<?php get_footer(); ?>