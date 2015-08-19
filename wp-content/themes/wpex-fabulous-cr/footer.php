<?php
/**
 * The template for displaying the footer.
 *
 * @package     Fabulous
 * @subpackage  Template
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2014, Symple Workz LLC
 * @link        http://www.wpexplorer.com
 * @since       1.0.0
 */

$wpex_footer_box_class = wpex_grid_class( get_theme_mod( 'wpex_footer_columns', '6' ) ); ?>

		</div><!--.site-main -->
	</div><!-- .site-main-wrap -->
</div><!-- #wrap -->

<footer id="footer-wrap" class="site-footer clr">
	<div id="footer" class="container clr">
		<div id="footer-widgets" class="clr">
			<div class="footer-box <?php echo $wpex_footer_box_class; ?> col col-1">
				<?php dynamic_sidebar( 'footer' ); ?>
			</div><!-- .footer-box -->
		</div><!-- #footer-widgets -->
    <p><?php print '&copy;&nbsp;' . date('Y') . ' Cock Robin. Tous droits réservés' ?></p>

	</div><!-- #footer -->
</footer><!-- #footer-wrap -->

<?php
// Scroll to top link
if ( get_theme_mod( 'wpex_scroll_top', true ) ) : ?>
	<a href="#" class="site-scroll-top" title="<?php esc_attr_e( 'Top', 'wpex' ); ?>"><span class="fa fa-arrow-up"></span></a>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
