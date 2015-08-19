<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
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
			<header class="archive-header clr">
				<div class="archive-header-content <?php echo $header_content_class; ?>">
					<h1 class="archive-header-title"><?php
						if ( is_day() ) :
							printf( __( 'Daily Archives: %s', 'wpex' ), get_the_date() );
						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', 'wpex' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'wpex' ) ) );
						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', 'wpex' ), get_the_date( _x( 'Y', 'yearly archives date format', 'wpex' ) ) );
						else :
							echo single_term_title();
						endif;
					?></h1>
					<?php if ( term_description() ) { ?>
						<div class="archive-description clr">
							<?php echo term_description(); ?>
						</div><!-- #archive-description -->
					<?php } ?>
				</div>
			</header><!-- .archive-header -->
			<?php if ( have_posts() ) : ?>
				<div id="blog-wrap" class="clr <?php if ( '1' != wpex_entry_grid_class() ) echo 'masonry-grid'; ?>">
					<?php
					// Begin loop
                    $n_posts_user_allowed = 0;
					while ( have_posts() ) : the_post();
              get_template_part( 'content', get_post_format() );
					endwhile;

          ?>
				</div><!-- #blog-wrap -->
				<?php wpex_get_pagination(); ?>
			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>
		</div><!-- #content -->
		<?php get_sidebar(); ?>
	</div><!-- #primary -->

<?php get_footer(); ?>
