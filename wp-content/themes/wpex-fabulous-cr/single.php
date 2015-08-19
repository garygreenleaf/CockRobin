<?php
/**
 * The Template for displaying all single posts.
 *
 * @package     Fabulous
 * @subpackage  Templates
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2014, Symple Workz LLC
 * @link        http://www.wpexplorer.com
 * @since       1.0.0
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
    <div id="primary" class="content-area clr">
        <div id="content" class="site-content left-content clr" role="main">
            <?php if ( 'quote' != get_post_format() ) { ?>
                <article class="single-post-article clr">
                    <div class="single-inner">
                        <div class="single-post-media clr">
                            <?php
                            // Get post format media - image, video. audio, etc
                            get_template_part( 'content', get_post_format() ); ?>
                        </div><!-- .single-post-media -->
                        <header class="post-header clr">
                            <h1 class="post-header-title entry-title"><?php the_title(); ?></h1>
                        </header><!-- .page-header -->
                        <div class="entry clr">
                            <?php
                            // Post Content
                            the_content();
                            // Paginate posts when using <!--nextpage-->
                            wp_link_pages( array(
                                'before'        => '<div class="page-links clr">',
                                'after'         => '</div>',
                                'link_before'   => '<span>',
                                'link_after'    => '</span>'
                            ) ); ?>
                        </div><!-- .entry -->
                        <?php
                        // Display post meta
                        // See functions/commons.php
                        wpex_post_meta(); ?>
                    </div>
                </article>
            <?php } else { ?>
                <?php get_template_part( 'content', get_post_format() ); ?>
            <?php } ?>
            <?php //get_template_part( 'partials/post', 'author' ); ?>
            <?php comments_template(); ?>
            <?php get_template_part( 'partials/post', 'navigation' ); ?>
        </div><!-- #content -->
        <?php get_sidebar(); ?>
    </div><!-- #primary -->
<?php endwhile; ?>
<?php get_footer(); ?>
