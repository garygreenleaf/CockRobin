<?php
/**
 * Used to output post meta info
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */

if ( ! function_exists( 'wpex_post_meta' ) ) {
	function wpex_post_meta() {
        global $post;
		/** Singular Posts **/
		if ( is_singular( 'post' ) && !post_password_required() ) { ?>
		
			<div class="post-meta clr">
				<?php if ( '1' == get_theme_mod( 'wpex_post_author', true ) ) { ?>
					<!--<div class="post-meta-author">
						<span class="strong"><?php _e( 'Author', 'wpex' ); ?>:</span> <span class="vcard"><?php the_author_posts_link(); ?></span></a>
					</div>-->
				<?php } ?>
				<?php if ( '1' == get_theme_mod( 'wpex_post_date', true ) ) { ?>
					<div class="post-meta-date updated">
						<span class="strong"><?php _e( 'Published', 'wpex' ); ?>:</span> <?php echo get_the_date(); ?>
					</div>
				<?php } ?>
				<?php if ( '1' == get_theme_mod( 'wpex_post_category', true ) ) { ?>
					<div class="post-meta-category">
						<span class="strong"><?php _e( 'Categories', 'wpex' ); ?>:</span> <?php the_category( ', ' ); ?>
					</div>
				<?php } ?>
				<?php if ( '1' == get_theme_mod( 'wpex_post_tags', true ) ) { ?>
					<?php the_tags( '<div class="post-meta-tags"><span class="strong">'. __( 'Tags', 'wpex' ).':</span> ', ', ', '</div>' ); ?> 
				<?php } ?>
			</div><!-- .post-meta -->

		<?php }
		/** Post Entries **/
		if ( ! is_singular( 'post' ) && ! is_singular( 'research_post' ) ) {
				if ( !get_theme_mod( 'wpex_blog_meta', true ) ) return; ?>

			<div class="loop-entry-meta clr">
				<div class="loop-entry-meta-date updated">
					<span class="strong"><?php _e( 'Published', 'wpex' ); ?>:</span> <?php echo get_the_date(); ?>
				</div>
				<div class="loop-entry-meta-category">

                    <?php
                    if( $post->post_type == 'research_post' ){
                        $terms = get_the_term_list(  $post->ID, 'research_category', '<span class="strong">Categories: </span>', ', ', '' );
                        echo $terms;
                    }elseif ( has_category() && !has_category('uncategorised') ){
                        echo '<span class="strong">'. __( 'Categories', 'wpex' ).':</span>';
                        the_category( ', ' );
                    }
                    ?>
				</div>
			</div><!-- .loop-entry-meta -->

		<?php } ?>
		
		<?php
		
	}
}