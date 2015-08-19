<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments and the comment
 * form. The actual display of comments is handled by a callback to
 * wpex_comment() which is located at functions/comments-callback.php
 *
 * @package     Fabulous
 * @subpackage  Templates
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2014, Symple Workz LLC
 * @link        http://www.wpexplorer.com
 * @since       1.0.0
 */


// Bail if password protected and user hasn't entered password
if ( post_password_required() ) {
	return;
}

// Comments are closed and empty, do nothing
if ( ! comments_open() && get_comment_pages_count() == 0 ) {
	return;
} ?>

<div id="comments" class="comments-area clr">
	<?php if ( have_comments() ) { ?>
		<div class="comments-title">
			<span class="fa fa-comments"></span>
			<?php
			$comments_number = number_format_i18n( get_comments_number() );
			if ( '1' == $comments_number ) {
				_e( 'There is 1 comment for this article', 'wpex' );
			} else {
				echo sprintf( __( 'There are %s comments for this article', 'wpex' ), $comments_number );
			} ?>
		</div>
	<?php } ?>
	<div class="comments-inner clr">
		<?php if ( have_comments() ) { ?>
			<ol class="commentlist">
				<?php wp_list_comments( array(
					'callback'	=> 'wpex_comment',
				) ); ?>
			</ol><!-- .commentlist -->
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
				<nav class="comment-navigation clr" role="navigation">
						<?php if ( is_rtl() ) { ?>
							<div class="nav-next span_1_of_2 col col-1">
								<?php next_comments_link( __( 'Newer Comments &larr;', 'wpex' ) ); ?>
							</div>
							<div class="nav-previous span_1_of_2 col">
								<?php previous_comments_link( __( '&rarr; Older Comments', 'wpex' ) ); ?>
							</div>
						<?php } else { ?>
							<div class="nav-previous span_1_of_2 col col-1">
								<?php previous_comments_link( __( '&larr; Older Comments', 'wpex' ) ); ?>
							</div>
							<div class="nav-next span_1_of_2 col">
								<?php next_comments_link( __( 'Newer Comments &rarr;', 'wpex' ) ); ?>
							</div>
						<?php } ?>
				</nav>
			<?php } ?>
		<?php } // have_comments() ?>
		<?php
		// The comment form
		comment_form( array(
			'cancel_reply_link'	=> '<i class="fa fa-times"></i>'. __('Cancel comment reply','wpex'),
		) ); ?>
	</div><!-- .comments-inner -->
</div><!-- #comments -->