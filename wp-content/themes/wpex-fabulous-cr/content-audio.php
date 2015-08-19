<?php
/**
 * The default template for displaying audio post format content.
 *
 * @package     Fabulous
 * @subpackage  Template Parts
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2014, Symple Workz LLC
 * @link        http://www.wpexplorer.com
 * @since       1.0.0
 */

/*-----------------------------------------------------------------------------------*/
/*  - Posts
/*-----------------------------------------------------------------------------------*/
global $wpex_query;
if ( is_singular() && ! $wpex_query ) {

	// Display post featured image
	// See functions/post-featured-image.php
	wpex_post_featured_image();

	// Display post audio
	// See functions/commons.php
	wpex_post_audio();

}

/*-----------------------------------------------------------------------------------*/
/*  - Entries
/*-----------------------------------------------------------------------------------*/
else { ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php
		// Display post thumbnail
		if ( has_post_thumbnail() && get_theme_mod( 'wpex_blog_entry_thumb', true ) ) { ?>
			<div class="loop-entry-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>">
					<img src="<?php echo wpex_get_featured_img_url(); ?>" alt="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" />
				</a>
			</div><!-- .post-entry-thumbnail -->
		<?php } ?>
		<?php
		// Display post audio
		// See functions/commons.php
		wpex_post_audio(); ?>
		<div class="loop-entry-content clr">
			<header>
				<h2 class="loop-entry-title entry-title">
					<?php if ( ! get_theme_mod( 'wpex_entry_embeds', true ) || 'on' == get_post_meta( get_the_ID(), 'wpex_disable_entry_embed', true ) ) { ?>
						<span class="fa fa-music music-title-icon"></span>
					<?php } ?>
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>
				</h2>
			</header>
			<div class="loop-entry-excerpt entry clr">
                <?php
                // Get excerpt display option
                $wpex_excerpt_display = get_theme_mod( 'wpex_excerpt_display', 'custom_excerpt' );
                // Display the content
                if ( 'the_content' == $wpex_excerpt_display ) {
                    the_content();
                }
                // Display the WordPress generated excerpt
                elseif ( 'the_excerpt' == $wpex_excerpt_display ) {
                    the_excerpt();
                // Display custom Excerpt
                } else {
                    wpex_excerpt( get_theme_mod( 'wpex_excerpt_length', '30' ), get_theme_mod( 'wpex_blog_readmore', true ) );
                } ?>
            </div><!-- .loop-entry-excerpt -->
		</div><!-- .loop-entry-content -->
		<?php
		// Display post meta details
		wpex_post_meta() ;?>
	</article><!-- .loop-entry -->

<?php } ?>