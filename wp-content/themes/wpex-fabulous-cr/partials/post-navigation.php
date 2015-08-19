<?php
/**
 * Used for next and previous post links
 *
 * @package     Fabulous
 * @subpackage  Template Parts
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2014, Symple Workz LLC
 * @link        http://www.wpexplorer.com
 * @since       1.1.0
 * @version		1.0.0
 */

// Return if disabled
if ( ! get_theme_mod( 'wpex_next_prev', true ) ) {
	return;
} ?>

<ul class="single-post-pagination clr">
	<?php if ( is_rtl() ) { ?>
		<?php previous_post_link(
			'<li class="post-next">%link</li>',
			'<span class="strong">'. __( 'Next Post:', 'wpex' ) .'</span> %title &#8592;'
		); ?>
		<?php next_post_link(
			'<li class="post-prev">%link</li>',
			'&#8594; <span class="strong">'. __( 'Previous Post:', 'wpex' ) .'</span> %title'
		); ?>
	<?php } else { ?>
		<?php previous_post_link(
			'<li class="post-next">%link</li>',
			'<span class="strong">'. __( 'Next Post:', 'wpex' ) .'</span> %title &#8594;'
		); ?>
		<?php next_post_link(
			'<li class="post-prev">%link</li>',
			'&#8592; <span class="strong">'. __( 'Previous Post:', 'wpex' ) .'</span> %title'
		); ?>
	<?php } ?>
</ul><!-- .post-post-pagination -->