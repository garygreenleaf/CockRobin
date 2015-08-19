<?php
/**
 * Define sidebars for use in this theme
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */

// Spotlights
register_sidebar( array(
  'name'      => __( 'Spotlights', 'wpex' ),
  'id'      => 'spotlights',
  'description' => __( 'Widgets in this area are used in the Spotlights.', 'wpex' ),
  'before_widget' => '<div class="spotlight-widget %2$s clr">',
  'after_widget'  => '</div>',
  'before_title'  => '<h2 class="widget-title">',
  'after_title' => '</h2>',
) );

// Footer
register_sidebar( array(
	'name'			=> __( 'Footer', 'wpex' ),
	'id'			=> 'footer',
	'description'	=> __( 'Widgets in this area are used in the footer.', 'wpex' ),
	'before_widget'	=> '<div class="footer-widget %2$s clr">',
	'after_widget'	=> '</div>',
	'before_title'	=> '<span class="widget-title">',
	'after_title'	=> '</span>',
) );

