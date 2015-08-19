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
		global $post;
		$attachments = wpex_get_gallery_ids();
		if ( !$attachments ) return; ?>
		<div class="flexslider-wrap post-gallery clr">
			<div class="flexslider">
				<ul class="slides clr wpex-gallery-lightbox">
					<?php
					// Loop through each image in each gallery
					foreach( $attachments as $attachment ) {
						$attachment_data = wpex_get_attachment( $attachment ); ?>
						<?php if ( wpex_get_featured_img_url($attachment) ) { ?>
							<li>
								<?php if ( wpex_gallery_is_lightbox_enabled() ) { ?>
									<a href="<?php echo wpex_get_featured_img_url( $attachment, true ); ?>" title="<?php echo $attachment_data['alt']; ?>">
								<?php } ?>
								<img src="<?php echo wpex_get_featured_img_url($attachment); ?>" alt="<?php echo $attachment_data['alt']; ?>" />
								<?php if ( wpex_gallery_is_lightbox_enabled() ) echo '</a>'; ?>
								<?php if ( is_singular() && '' != $attachment_data['caption'] ) { ?>
									<div class="post-gallery-caption"><?php echo $attachment_data['caption']; ?></div>
								<?php } ?>
							</li>
						<?php } ?>
					<?php } ?>
				</ul>
			</div>
		</div>
	<?php
	} // End function
} // End if


// Create slider based on first gallery in post
// Not used in this theme but maybe in the future?
/*
if ( ! function_exists( 'wpex_post_gallery' ) ) {
	function wpex_post_gallery() {
		if( !has_shortcode( $post->post_content, 'gallery' ) ) return;
		// Retrieve the first gallery in the post
		$gallery = get_post_gallery( get_the_ID(), false );
		$gallery_ids = $gallery['ids'];
		$gallery_ids = explode( ',', $gallery_ids );
		$img_width = get_post_meta( get_the_ID(), 'wpex_gallery_img_width', true );
		$img_width = $img_width ? $img_width : '480'; 
		$img_height = get_post_meta( get_the_ID(), 'wpex_gallery_img_height', true );
		$img_height = $img_height ? $img_height : '340'; ?>

		<div class="flexslider-wrap post-gallery">
			<div class="flexslider">
				<ul class="slides clr">
					<?php
					// Loop through each image in each gallery
					foreach( $gallery_ids as $gallery_id ) {
						$image = wp_get_attachment_url( $gallery_id );
						$image = aq_resize( $image, $img_width, $img_height, true );
						echo '<li><img src="<?php $image ?>" alt="" /></li>';
					} ?>
				</ul>
			</div>
		</div>

	<?php
	} // End function
} // End if
*/