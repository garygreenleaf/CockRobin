<?php
/**
 * The default template for displaying post content.
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */



/*-----------------------------------------------------------------------------------*/
/*  - Posts
/*-----------------------------------------------------------------------------------*/
global $wpex_query;

if ( is_singular() && !$wpex_query ) { ?>

	<article class="quote-post-entry clr">
		<?php
		// See functions/quote-content.php
		wpex_quote_content(); ?>
	</article><!-- .loop-entry -->

<?php }

/*-----------------------------------------------------------------------------------*/
/*  - Entries
/*-----------------------------------------------------------------------------------*/
else { ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>">
			<?php
			// See functions/quote-content.php
			wpex_quote_content(); ?>
		</a><!-- .loop-entry-content -->
	</article><!-- .loop-entry -->

<?php } ?>