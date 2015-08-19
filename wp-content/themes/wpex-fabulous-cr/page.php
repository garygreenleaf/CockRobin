<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
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
        <div id="content" class="site-content left-content" role="main">
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" class="clr">
                    <?php if ( !is_front_page() ) { ?>
                        <?php
                        // Display featured image
                        wpex_page_featured_image(); ?>
                        <header class="page-header clr">
                            <h1 class="page-header-title"><?php the_title(); ?></h1>
                        </header><!-- #page-header -->
                    <?php } ?>
                    <div class="entry clr">
                        <?php the_content(); ?>
                        <?php wp_link_pages( array( 'before' => '<div class="page-links clr">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
                    </div><!-- .entry -->
                </article><!-- #post -->
                <div class="spotlights">
                    <?php dynamic_sidebar( 'spotlights' ); ?>
                </div>
                <?php
                if ( get_theme_mod( 'wpex_page_comments' ) ) {
                    comments_template();
                } ?>
            <?php endwhile; ?>
            <?php if ( is_user_logged_in() && current_user_can('edit_post', get_the_ID() ) ) { ?>
            <footer class="entry-footer">
                <?php edit_post_link( __( 'Edit this page', 'wpex' ) .' &#8594;', '<span class="edit-link clr">', '</span>' ); ?>
            </footer><!-- .entry-footer -->
            <?php } ?>
        </div><!-- #content -->
        <?php get_sidebar(); ?>
    </div><!-- #primary -->
<?php get_footer(); ?>
