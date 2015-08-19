<?php
/**
 * Image Resizing theme options
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */



add_action( 'customize_register', 'wpex_customizer_image_sizes' );

function wpex_customizer_image_sizes($wp_customize) {

	// Theme Settings Section
	$wp_customize->add_section( 'wpex_img_sizes' , array(
		'title'			=> __( 'Image Sizes', 'wpex' ),
		'priority'		=> 203,
		'description'	=> __( 'This theme uses a built-in image resizing function based on the WordPress wp_get_image_editor() function so you can quickly alter the image sizes on your site without having to regenerate the thumbnails. If you are more concerend with site speed then you will probably want to set your entry image sizes to a different crop then your posts and if your main priority is storage space you will probably want to set entry sizes the same as post sizes.<br /><br />Gallery entries must have a fixed height to prevent issues with the masonry layout.<br /><br />', 'wpex' ),
	) );

	$wp_customize->add_setting( 'wpex_retina', array(
		'type'		=> 'theme_mod',
		'default'	=> '',
	) );
	$wp_customize->add_control( 'wpex_retina', array(
		'label'			=> __( 'Enable Retina.js.', 'wpex' ),
		'settings'		=> 'wpex_retina',
		'section'		=> 'wpex_img_sizes',
		'priority'		=> '1',
		'type'			=> 'checkbox',
		'description'	=> __( 'This will create a second cropped version of every image that is 2x as big as the original.', 'wpex' ),
	) );


	$wp_customize->add_setting( 'wpex_entry_img_width', array(
		'type'		=> 'theme_mod',
		'default'	=> '670',
	) );
	$wp_customize->add_control( 'wpex_entry_img_width', array(
		'label'		=> __( 'Entry Image Width', 'wpex' ),
		'settings'	=> 'wpex_entry_img_width',
		'section'	=> 'wpex_img_sizes',
		'priority'	=> '2',
	) );


	$wp_customize->add_setting( 'wpex_entry_img_height', array(
		'type'		=> 'theme_mod',
		'default'	=> '9999',
	) );
	$wp_customize->add_control( 'wpex_entry_img_height', array(
		'label'		=> __( 'Entry Image Height', 'wpex' ),
		'settings'	=> 'wpex_entry_img_height',
		'section'	=> 'wpex_img_sizes',
		'priority'	=> '3',
	) );


	$wp_customize->add_setting( 'wpex_entry_gallery_img_height', array(
		'type'		=> 'theme_mod',
		'default'	=> '440',
	) );
	$wp_customize->add_control( 'wpex_entry_gallery_img_height', array(
		'label'		=> __( 'Gallery Entry Image Height', 'wpex' ),
		'settings'	=> 'wpex_entry_gallery_img_height',
		'section'	=> 'wpex_img_sizes',
		'priority'	=> '4',
	) );


	$wp_customize->add_setting( 'wpex_post_img_width', array(
		'type'		=> 'theme_mod',
		'default'	=> '670',
	) );
	$wp_customize->add_control( 'wpex_post_img_width', array(
		'label'		=> __( 'Post Image Width', 'wpex' ),
		'section'	=> 'wpex_img_sizes',
		'settings'	=> 'wpex_post_img_width',
		'priority'	=> '5',
	) );


	$wp_customize->add_setting( 'wpex_post_img_height', array(
		'type'		=> 'theme_mod',
		'default'	=> '9999',
	) );
	$wp_customize->add_control( 'wpex_post_img_height', array(
		'label'		=> __( 'Post Image Height', 'wpex' ),
		'section'	=> 'wpex_img_sizes',
		'settings'	=> 'wpex_post_img_height',
		'priority'	=> '6',
	) );


	$wp_customize->add_setting( 'wpex_full_post_img_width', array(
		'type'		=> 'theme_mod',
		'default'	=> '1020',
	) );
	$wp_customize->add_control( 'wpex_full_post_img_width', array(
		'label'		=> __( 'Full-Width Post Image Width', 'wpex' ),
		'section'	=> 'wpex_img_sizes',
		'settings'	=> 'wpex_full_post_img_width',
		'priority'	=> '7',
	) );


	$wp_customize->add_setting( 'wpex_full_post_img_height', array(
		'type'		=> 'theme_mod',
		'default'	=> '9999',
	) );
	$wp_customize->add_control( 'wpex_full_post_img_height', array(
		'label'		=> __( 'Full-Width Post Image Height', 'wpex' ),
		'section'	=> 'wpex_img_sizes',
		'settings'	=> 'wpex_full_post_img_height',
		'priority'	=> '8',
	) );

	$wp_customize->add_setting( 'wpex_gallery_image_width', array(
		'type'		=> 'theme_mod',
		'default'	=> '9999',
	) );
	$wp_customize->add_control( 'wpex_gallery_image_width', array(
		'label'		=> __( 'WP Gallery Image Width', 'wpex' ),
		'section'	=> 'wpex_img_sizes',
		'settings'	=> 'wpex_gallery_image_width',
		'priority'	=> '9',
	) );


	$wp_customize->add_setting( 'wpex_gallery_image_height', array(
		'type'		=> 'theme_mod',
		'default'	=> '9999',
	) );
	$wp_customize->add_control( 'wpex_gallery_image_height', array(
		'label'		=> __( 'WP Gallery Image Height', 'wpex' ),
		'section'	=> 'wpex_img_sizes',
		'settings'	=> 'wpex_gallery_image_height',
		'priority'	=> '10',
	) );
	
}