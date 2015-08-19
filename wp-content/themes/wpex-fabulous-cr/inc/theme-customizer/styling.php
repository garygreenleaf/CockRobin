<?php
/**
 * This class adds styling (color) options to the WordPress
 * Theme Customizer and outputs the needed CSS to the header
 * 
 * @package		Fabulous
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2014, Symple Workz LLC
 * @link		http://www.wpexplorer.com
 * @since		1.0.0
 */

if ( ! class_exists( 'WPEX_Theme_Customizer_Styling' ) ) {
	class WPEX_Theme_Customizer_Styling {

		/**
		* This hooks into 'customize_register' (available as of WP 3.4) and allows
		* you to add new sections and controls to the Theme Customize screen.
		*
		* @see		add_action('register',$func)
		* @param	\WP_Customize_Manager $wp_customize
		* @since	1.0.0
		*/
		public static function register ( $wp_customize ) {

				// Theme Design Section
				$wp_customize->add_section( 'wpex_styling' , array(
					'title'		=> __( 'Styling', 'wpex' ),
					'priority'	=> 202,
				) );

				// Color Skin
				$wp_customize->add_setting( 'wpex_theme_skin', array(
					'type'		=> 'theme_mod',
					'default'	=> 'dark',
				) );

				$wp_customize->add_control( 'wpex_theme_skin', array(
					'label'		=> __( 'Theme Skin','wpex'),
					'section'	=> 'wpex_styling',
					'settings'	=> 'wpex_theme_skin',
					'priority'	=> '1',
					'type'		=> 'select',
					'choices'	=> array (
						'dark'	=> __( 'Dark', 'wpex' ),
						'light'	=> __( 'Light', 'wpex' )
					)
				) );

				// Get Color Options
				$color_options = self::wpex_color_options();

				// Loop through color options and add a theme customizer setting for it
				$count='2';
				foreach( $color_options as $option ) {
					$count++;
					$default = isset($option['default']) ? $option['default'] : '';
					$type = isset($option['type']) ? $option['type'] : '';
					$wp_customize->add_setting( 'wpex_'. $option['id'] .'', array(
						'type'		=> 'theme_mod',
						'default'	=> $default,
						'transport'	=> 'refresh',
					) );
					if ( 'text' == $type ) {
						$wp_customize->add_control( 'wpex_'. $option['id'] .'', array(
							'label'		=> $option['label'],
							'section'	=> 'wpex_styling',
							'settings'	=> 'wpex_'. $option['id'] .'',
							'priority'	=> $count,
							'type'		=> 'text',
						) );
					} else {
						$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpex_'. $option['id'] .'', array(
							'label'		=> $option['label'],
							'section'	=> 'wpex_styling',
							'settings'	=> 'wpex_'. $option['id'] .'',
							'priority'	=> $count,
						) ) );
					}
				} // End foreach

		} // End register


		/**
		* This will output the custom styling settings to the live theme's WP head.
		* Used by hook: 'wp_head'
		* 
		* @see add_action('wp_head',$func)
		* @since Fabulous 1.0
		*/
		public static function header_output() {
			$color_options = self::wpex_color_options();
			$css ='';
			foreach( $color_options as $option ) {
				$theme_mod = get_theme_mod('wpex_'. $option['id'] .'');
				if ( '' != $theme_mod ) {
					$css .= $option['element'] .'{ '. $option['style'] .':'. $theme_mod.' !important; }';
				}
			}
			$css =  preg_replace( '/\s+/', ' ', $css );
			if ( ! empty( $css ) ) {
				$css = "<!-- Theme Customizer Styling Options -->\n<style type=\"text/css\">\n" . $css . "\n</style>";
				echo $css;
			}
		} // End header_output function


		/**
		* Array of styling options
		* 
		* @since Fabulous 1.0
		*/
		public static function wpex_color_options() {

			$array = array();

			$array[] = array(
				'label'		=> __( 'Header Background', 'wpex' ),
				'id'		=> 'header_bg_color',
				'element'	=> '#header-wrap',
				'style'		=> 'background-color',
			);

			$array[] = array(
				'label'		=> __( 'Header Top Padding', 'wpex' ),
				'id'		=> 'header_top_pad',
				'element'	=> '#header',
				'style'		=> 'padding-top',
				'type'		=> 'text',
				'default'	=> '30px',
			);

			$array[] = array(
				'label'		=> __( 'Header Bottom Padding', 'wpex' ),
				'id'		=> 'header_bottom_pad',
				'element'	=> '#header',
				'style'		=> 'padding-bottom',
				'type'		=> 'text',
				'default'	=> '30px',
			);

			$array[] = array(
				'label'		=>	__( 'Logo Text Color', 'wpex' ),
				'id'		=>	'logo_color',
				'element'	=> '#logo a',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Logo Subheading Text Color', 'wpex' ),
				'id'		=>	'subheading_color',
				'element'	=> '.blog-description',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Menu Background', 'wpex' ),
				'id'		=>	'nav_bg',
				'element'	=> '#site-navigation-wrap',
				'style'		=> 'background',
			);

			$array[] = array(
				'label'		=>	__( 'Menu Top Border Color', 'wpex' ),
				'id'		=>	'nav_top_border',
				'element'	=> '#site-navigation-wrap',
				'style'		=> 'border-top-color',
			);

			$array[] = array(
				'label'		=>	__( 'Menu Top Inner Border Color', 'wpex' ),
				'id'		=>	'nav_top_inner_border',
				'element'	=> '#site-navigation-inner',
				'style'		=> 'border-top-color',
			);

			$array[] = array(
				'label'		=>	__( 'Menu Bottom Border Color', 'wpex' ),
				'id'		=>	'nav_bottom_border',
				'element'	=> '#site-navigation-inner',
				'style'		=> 'border-bottom-color',
			);

			$array[] = array(
				'label'		=>	__( 'Menu Link Color', 'wpex' ),
				'id'		=>	'nav_link_color',
				'element'	=> '#site-navigation .dropdown-menu > li > a',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Menu Link Hover Color', 'wpex' ),
				'id'		=>	'nav_link_hover_color',
				'element'	=> '#site-navigation .dropdown-menu > li > a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Menu Link Text Shadow CSS (enter none to disable)', 'wpex' ),
				'id'		=>	'nav_link_text_shadow',
				'element'	=> '#site-navigation .dropdown-menu > li > a',
				'style'		=> 'text-shadow',
				'type'		=> 'text',
				'default'	=> '',
			);

			$array[] = array(
				'label'		=>	__( 'Menu Link Hover Background', 'wpex' ),
				'id'		=>	'nav_link_hover_bg',
				'element'	=> '#site-navigation .dropdown-menu > li > a:hover',
				'style'		=> 'background',
			);

			$array[] = array(
				'label'		=>	__( 'Active Menu Link Color', 'wpex' ),
				'id'		=>	'nav_link_active_color',
				'element'	=> '#site-navigation .dropdown-menu > .current-menu-item > a, .dropdown-menu > .current-menu-item > a:hover,.dropdown-menu > .current-menu-ancestor > a, .dropdown-menu > .current-menu-ancestor > a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Active Menu Link Background', 'wpex' ),
				'id'		=>	'nav_link_active_bg',
				'element'	=> '#site-navigation .dropdown-menu > .current-menu-item > a, .dropdown-menu > .current-menu-item > a:hover,.dropdown-menu > .current-menu-ancestor > a, .dropdown-menu > .current-menu-ancestor > a:hover',
				'style'		=> 'background',
			);

			$array[] = array(
				'label'		=>	__( 'Active Menu Link Box Shadow CSS (enter none to disable)', 'wpex' ),
				'id'		=>	'nav_link_active_boxshadow',
				'element'	=> '#site-navigation .dropdown-menu > li > a',
				'style'		=> 'box-shadow',
				'type'		=> 'text',
				'default'	=> '',
			);

			$array[] = array(
				'label'		=>	__( 'Sub-Menu Background', 'wpex' ),
				'id'		=>	'nav_drop_bg',
				'element'	=> '#site-navigation-wrap .dropdown-menu ul',
				'style'		=> 'background',
			);

			$array[] = array(
				'label'		=>	__( 'Sub-Menu Border', 'wpex' ),
				'id'		=>	'nav_drop_border',
				'element'	=> '#site-navigation .dropdown-menu ul',
				'style'		=> 'border-color',
			);

			$array[] = array(
				'label'		=>	__( 'Sub-Menu Link Bottom Border', 'wpex' ),
				'id'		=>	'nav_drop_link_border',
				'element'	=> '#site-navigation .dropdown-menu ul li',
				'style'		=> 'border-color',
			);

			$array[] = array(
				'label'		=>	__( 'Sub-Menu Link Color', 'wpex' ),
				'id'		=>	'nav_drop_link_color',
				'element'	=> '#site-navigation .dropdown-menu ul > li > a',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Sub-Menu Link Hover Color', 'wpex' ),
				'id'		=>	'nav_drop_link_hover_color',
				'element'	=> '#site-navigation .dropdown-menu ul > li > a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Sub-Menu Link Hover Background', 'wpex' ),
				'id'		=>	'nav_drop_link_hover_bg',
				'element'	=> '#site-navigation .dropdown-menu ul > li > a:hover',
				'style'		=> 'background',
			);

			$array[] = array(
				'label'		=>	__( 'Mobile Menu Background', 'wpex' ),
				'id'		=>	'mobile_nav_bg',
				'element'	=> '.wpex-mobile-nav',
				'style'		=> 'background',
			);

			$array[] = array(
				'label'		=>	__( 'Mobile Menu Link Color', 'wpex' ),
				'id'		=>	'mobile_nav_link_color',
				'element'	=> '.wpex-mobile-nav-ul li a',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Mobile Menu Link Hover Color', 'wpex' ),
				'id'		=>	'mobile_nav_link_hover_color',
				'element'	=> '.wpex-mobile-nav-ul li a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Mobile Menu Borders', 'wpex' ),
				'id'		=>	'mobile_nav_borders',
				'element'	=> '.wpex-mobile-nav-ul li a',
				'style'		=> 'border-color',
			);

			$array[] = array(
				'label'		=>	__( 'Footer Widgets Background', 'wpex' ),
				'id'		=>	'footer_widgets_bg',
				'element'	=> '#footer-wrap',
				'style'		=> 'background',
			);

			$array[] = array(
				'label'		=>	__( 'Footer Widgets Text', 'wpex' ),
				'id'		=>	'footer_widgets_color',
				'element'	=> '#footer-wrap, #footer-wrap p',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Footer Widgets Heading', 'wpex' ),
				'id'		=>	'footer_widgets_headings',
				'element'	=> '#footer-wrap h2, #footer-wrap h3, #footer-wrap h4, #footer-wrap h5,  #footer-wrap h6, #footer-widgets .widget-title',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Footer Widgets Links', 'wpex' ),
				'id'		=>	'footer_widgets_links_color',
				'element'	=> '#footer-wrap a, #footer-widgets .widget_nav_menu ul > li li a:before',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Footer Widgets Links Hover', 'wpex' ),
				'id'		=>	'footer_widgets_links_hover_color',
				'element'	=> '#footer-wrap a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Footer Widgets Borders', 'wpex' ),
				'id'		=>	'footer_widgets_borders',
				'element'	=> '#footer-widgets .widget_nav_menu ul > li, #footer-widgets .widget_nav_menu ul > li a, .footer-widget > ul > li:first-child, .footer-widget > ul > li',
				'style'		=> 'border-color',
			);

			$array[] = array(
				'label'		=>	__( 'Readmore Color', 'wpex' ),
				'id'		=>	'readmore_color',
				'element'	=> '.loop-entry .wpex-readmore a',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Readmore Background', 'wpex' ),
				'id'		=>	'readmore_bg_color',
				'element'	=> '.loop-entry .wpex-readmore a',
				'style'		=> 'background-color',
			);

			$array[] = array(
				'label'		=>	__( 'Readmore Hover Color', 'wpex' ),
				'id'		=>	'readmore_hover_color',
				'element'	=> '.loop-entry .wpex-readmore a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Readmore Hover Background', 'wpex' ),
				'id'		=>	'readmore_hover_bg_color',
				'element'	=> '.loop-entry .wpex-readmore a:hover',
				'style'		=> 'background-color',
			);

			$array[] = array(
				'label'		=>	__( 'Entry Title Hover Color', 'wpex' ),
				'id'		=>	'entry_title_hover_color',
				'element'	=> '.loop-entry-title a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Entry Overlay Background', 'wpex' ),
				'id'		=>	'entry_overlay_bg',
				'element'	=> '.loop-entry-thumbnail a:before',
				'style'		=> 'background-color',
			);

			$array[] = array(
				'label'		=>	__( 'Gallery Entry Slider Arrow Hover Background', 'wpex' ),
				'id'		=>	'gallery_slider_arrow_bg',
				'element'	=> '.loop-entry .flex-direction-nav li a:hover',
				'style'		=> 'background-color',
			);

			$array[] = array(
				'label'		=>	__( 'Quote Entry Background', 'wpex' ),
				'id'		=>	'quote_bg',
				'element'	=> '.loop-entry.format-quote a, .quote-post-entry',
				'style'		=> 'background-color',
			);


			$array[] = array(
				'label'		=>	__( 'Quote Entry Hover Background', 'wpex' ),
				'id'		=>	'quote_bg_hover',
				'element'	=> '.loop-entry.format-quote a:hover',
				'style'		=> 'background-color',
			);

			$array[] = array(
				'label'		=>	__( 'Quote Entry Color', 'wpex' ),
				'id'		=>	'quote_color',
				'element'	=> '.loop-entry.format-quote a, .quote-post-entry',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Quote Entry Hover Color', 'wpex' ),
				'id'		=>	'quote_color_hover',
				'element'	=> '.loop-entry.format-quote a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Post Link Color', 'wpex' ),
				'id'		=>	'post_link_color',
				'element'	=> '.single .entry a, p.logged-in-as a, .comment-navigation a',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Post Link Hover Color', 'wpex' ),
				'id'		=>	'post_link_hover_color',
				'element'	=> '.single .entry a:hover, p.logged-in-as a:hover, .comment-navigation a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Sidebar Link Color', 'wpex' ),
				'id'		=>	'sidebar_link_color',
				'element'	=> '.sidebar-container a',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Sidebar Link Hover Color', 'wpex' ),
				'id'		=>	'sidebar_link_hover_color',
				'element'	=> '.sidebar-container a:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Back To Top Arrow Color', 'wpex' ),
				'id'		=>	'scrolltop_color',
				'element'	=> '.site-scroll-top',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Back To Top Arrow Background', 'wpex' ),
				'id'		=>	'scrolltop_bg',
				'element'	=> '.site-scroll-top',
				'style'		=> 'background-color',
			);

			$array[] = array(
				'label'		=>	__( 'Theme Button Color', 'wpex' ),
				'id'		=>	'theme_button_color',
				'element'	=> 'input[type="button"], input[type="submit"], .page-numbers a:hover, .page-numbers.current, .page-links span, .page-links a:hover span',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Theme Button Background', 'wpex' ),
				'id'		=>	'theme_button_bg',
				'element'	=> 'input[type="button"], input[type="submit"], .page-numbers a:hover, .page-numbers.current, .page-links span, .page-links a:hover span',
				'style'		=> 'background',
			);

			$array[] = array(
				'label'		=>	__( 'Theme Button Hover Color', 'wpex' ),
				'id'		=>	'theme_button_hover_color',
				'element'	=> 'input[type="button"]:hover, input[type="submit"]:hover',
				'style'		=> 'color',
			);

			$array[] = array(
				'label'		=>	__( 'Theme Button Hover Background', 'wpex' ),
				'id'		=>	'theme_button_hover_bg',
				'element'	=> 'input[type="button"]:hover, input[type="submit"]:hover',
				'style'		=> 'background-color',
			);

			// Apply filters for child theming magic
			$array = apply_filters( 'wpex_color_options_array', $array );

			// Return array
			return $array;
		}

	} // End Theme_Customizer_Styling Class
}

// Setup the Theme Customizer settings and controls
add_action( 'customize_register' , array( 'WPEX_Theme_Customizer_Styling' , 'register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'WPEX_Theme_Customizer_Styling' , 'header_output' ) );

/**
* Remove Inner shadow for buttons if their colors
* have been altered via the customizer
* 
* @since Fabulous 1.0
*/
if ( ! function_exists('wpex_remove_button_shadow') ) {
	function wpex_remove_button_shadow() {
		$css='';
		if ( '' != get_theme_mod( 'wpex_theme_button_bg' ) ) {
			$css = 'input[type="button"], input[type="submit"], .page-numbers a:hover, .page-numbers.current, .page-links span, .page-links a:hover span { box-shadow: 0 1px 2px rgba(0,0,0,0.07); }';
		}
		if ( $css ) {
			$css =  preg_replace( '/\s+/', ' ', $css );
			$css = "<!-- Remove Button Box Shadow -->\n<style type=\"text/css\">\n" . $css . "\n</style>";
			echo $css;
		} else {
			return;
		}

	}
}

// Output custom CSS to live site
add_action( 'wp_head' , 'wpex_remove_button_shadow' );