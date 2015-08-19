<?php
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments
 * template simply create your own wpex_comment(), and that function
 * will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */

if ( ! function_exists( 'wpex_comment' ) ) {
	function wpex_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
			// Display trackbacks differently than normal comments. ?>
		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<div class="pingback-entry"><span class="pingback-heading"><?php _e( 'Pingback:', 'wpex' ); ?></span> <?php comment_author_link(); ?></div>
		<?php
				break;
			default :
			// Proceed with normal comments.
		?>
		<li id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" <?php comment_class('clr'); ?>>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 45 ); ?>
				</div><!-- .comment-author -->
				<div class="comment-details clr">
					<header class="comment-meta">
						<cite class="fn"><?php comment_author_link(); ?></cite>
						<span class="comment-date">
						<?php printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							sprintf( _x( '%1$s', '1: date', 'wpex' ), get_comment_date() )
						); ?> <?php _e( 'at', 'wpex' ); ?> <?php comment_time(); ?>
						</span><!-- .comment-date -->
					</header><!-- .comment-meta -->
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'wpex' ); ?></p>
					<?php endif; ?>
					<div class="comment-content entry clr">
						<?php comment_text(); ?>
					</div><!-- .comment-content -->
					<div class="reply comment-reply-link">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply to this message', 'wpex' ) . '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div><!-- .reply -->
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" title="<?php esc_attr_e( 'Comment Permalink', 'wpex' ); ?>" class="comment-permalink"></a>
				</div><!-- .comment-details -->
			</article><!-- #comment-## -->
		<?php
			break;
		endswitch; // End comment_type check.
	}
}