<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Fabulous
 * @subpackage  Templates
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2014, Symple Workz LLC
 * @link        http://www.wpexplorer.com
 * @since       1.0.0
 */

get_header(); ?>

    <div id="primary" class="content-area clr">

        <div id="content" class="site-content left-content clr" role="main">
            <?php if ( have_posts() ) : ?>
                <div id="blog-wrap" class="clr <?php if ( '1' != wpex_entry_grid_class() ) echo 'masonry-grid'; ?>">
                    <?php
                    while ( have_posts() ) : the_post();
                        get_template_part('content', get_post_format());
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
