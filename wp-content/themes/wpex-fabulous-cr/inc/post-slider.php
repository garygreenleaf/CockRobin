<?php
/**
 * Outputs the post gallery
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */


if ( ! function_exists( 'wpex_post_gallery' ) ) {

	function wpex_post_gallery() {

		 if ( get_post_gallery() ) :
			$gallery = get_post_gallery( get_the_ID(), false );
			
			/* Loop through all the image and output them one by one */
			foreach( $gallery['src'] AS $src ) { ?>
				
				<img src="<?php echo $src; ?>" class="my-custom-class" alt="Gallery image" />
				
				<?php
			}
		endif;

	} // End function

} // End if