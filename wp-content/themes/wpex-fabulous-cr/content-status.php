<?php
/**
 * The default template for displaying post content.
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

}

/*-----------------------------------------------------------------------------------*/
/*  - Entries
/*-----------------------------------------------------------------------------------*/
else { ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php
		// Return meta option if one exists (fallback for GoodInc users)
		if( get_post_meta($post->ID, 'wpex_post_oembed', true) !== '') { ?>
			<?php echo apply_filters( 'the_content', get_post_meta( get_the_ID(), 'wpex_post_oembed', true ) ); ?>
		<?php } else {
			// Return content ?>
			<?php echo the_content(); ?>
		<?php } ?>
	</article><!-- .loop-entry -->

<?php } ?>