<?php
/**
 * General theme options
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */



add_action( 'customize_register', 'wpex_customizer_header' );

function wpex_customizer_header($wp_customize) {

	// Theme Settings Section
	$wp_customize->add_section( 'wpex_header' , array(
		'title'		=> __( 'Header', 'wpex' ),
		'priority'	=> 200,
	) );

	//Logo
	$wp_customize->add_setting( 'wpex_logo', array(
		'type'		=> 'theme_mod',
		'default'	=> get_template_directory_uri(). '/images/logo.png',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpex_logo', array(
		'label'		=> __('Image Logo','wpex'),
		'section'	=> 'wpex_header',
		'settings'	=> 'wpex_logo',
		'priority'	=> '1',
	) ) );

	// Subheading
	$wp_customize->add_setting( 'wpex_logo_subheading', array(
		'type'		=> 'theme_mod',
		'default'	=> '1',
	) );
	$wp_customize->add_control( 'wpex_logo_subheading', array(
		'label'		=> __('Display Description Below Logo','wpex'),
		'section'	=> 'wpex_header',
		'settings'	=> 'wpex_logo_subheading',
		'type'		=> 'checkbox',
		'priority'	=> '2',
	) );

	// Fixed Nav
	$wp_customize->add_setting( 'wpex_fixed_nav', array(
		'type'		=> 'theme_mod',
		'default'	=> '1',
	) );
	$wp_customize->add_control( 'wpex_fixed_nav', array(
		'label'		=> __('Fixed Navigation On Scroll','wpex'),
		'section'	=> 'wpex_header',
		'settings'	=> 'wpex_fixed_nav',
		'type'		=> 'checkbox',
		'priority'	=> '3',
	) );

	// Mobile Menu Open Text
	$wp_customize->add_setting( 'wpex_mobile_menu_open_text', array(
		'type'		=> 'theme_mod',
		'default'	=> __( 'Click here to navigate', 'wpex' ),
	) );
	$wp_customize->add_control( 'wpex_mobile_menu_open_text', array(
		'label'		=> __('Mobile Menu: Open Text','wpex'),
		'section'	=> 'wpex_header',
		'settings'	=> 'wpex_mobile_menu_open_text',
		'type'		=> 'text',
		'priority'	=> '4',
	) );

	// Mobile Menu Open Text
	$wp_customize->add_setting( 'wpex_mobile_menu_close_text', array(
		'type'		=> 'theme_mod',
		'default'	=> __( 'Close navigation', 'wpex' ),
	) );
	$wp_customize->add_control( 'wpex_mobile_menu_close_text', array(
		'label'		=> __('Mobile Menu: Close Text','wpex'),
		'section'	=> 'wpex_header',
		'settings'	=> 'wpex_mobile_menu_close_text',
		'type'		=> 'text',
		'priority'	=> '5',
	) );
	
}