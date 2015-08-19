<?php
/**
 * General theme options
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
 */



add_action( 'customize_register', 'wpex_customizer_general' );

function wpex_customizer_general($wp_customize) {

    // Theme Settings Section
    $wp_customize->add_section( 'wpex_general' , array(
        'title'     => __( 'General', 'wpex' ),
        'priority'  => 201,
    ) );

    // G Fonts
    $wp_customize->add_setting( 'wpex_g_font', array(
        'type'      => 'theme_mod',
        'default'   => '1',
    ) );
    $wp_customize->add_control( 'wpex_g_font', array(
        'label'     => __('Enable Google Font', 'wpex' ),
        'section'   => 'wpex_general',
        'settings'  => 'wpex_g_font',
        'type'      => 'checkbox',
        'priority'  => '3',
    ) );

    // Image Optimize
    $wp_customize->add_setting( 'wpex_image_optimize', array(
        'type'      => 'theme_mod',
        'default'   => '',
    ) );
    $wp_customize->add_control( 'wpex_image_optimize', array(
        'label'     => __('CSS Optimize Browser Image Quality', 'wpex' ),
        'section'   => 'wpex_general',
        'settings'  => 'wpex_image_optimize',
        'type'      => 'checkbox',
        'priority'  => '5',
    ) );

    // Blog readmore
    $wp_customize->add_setting( 'wpex_blog_readmore', array(
        'type'      => 'theme_mod',
        'default'   => '1',
    ) );
    $wp_customize->add_control( 'wpex_blog_readmore', array(
        'label'     => __('Entry Read More Link', 'wpex' ),
        'section'   => 'wpex_general',
        'settings'  => 'wpex_blog_readmore',
        'type'      => 'checkbox',
        'priority'  => '5',
    ) );

    // Entry Meta
    $wp_customize->add_setting( 'wpex_blog_meta', array(
        'type'      => 'theme_mod',
        'default'   => '1',
    ) );
    $wp_customize->add_control( 'wpex_blog_meta', array(
        'label'     => __('Entry Meta', 'wpex' ),
        'section'   => 'wpex_general',
        'settings'  => 'wpex_blog_meta',
        'type'      => 'checkbox',
        'priority'  => '6',
    ) );

    // Entry Embeds
    $wp_customize->add_setting( 'wpex_entry_embeds', array(
        'type'      => 'theme_mod',
        'default'   => '1',
    ) );
    $wp_customize->add_control( 'wpex_entry_embeds', array(
        'label'     => __('Entry Video/Audio Embeds', 'wpex' ),
        'section'   => 'wpex_general',
        'settings'  => 'wpex_entry_embeds',
        'type'      => 'checkbox',
        'priority'  => '7',
    ) );


    // Entry Lightbox
    $wp_customize->add_setting( 'wpex_entry_img_lightbox', array(
        'type'      => 'theme_mod',
        'default'   => '',
    ) );
    $wp_customize->add_control( 'wpex_entry_img_lightbox', array(
        'label'     => __('Entry Featured Image Lightbox', 'wpex' ),
        'section'   => 'wpex_general',
        'settings'  => 'wpex_entry_img_lightbox',
        'type'      => 'checkbox',
        'priority'  => '7',
    ) );

    // Post Thumb
    $wp_customize->add_setting( 'wpex_blog_post_thumb', array(
        'type'      => 'theme_mod',
        'default'   => '1',
    ) );
    $wp_customize->add_control( 'wpex_blog_post_thumb', array(
        'label'     => __('Featured Image on Posts', 'wpex' ),
        'section'   => 'wpex_general',
        'settings'  => 'wpex_blog_post_thumb',
        'type'      => 'checkbox',
        'priority'  => '8',
    ) );

    // Page Comments
    $wp_customize->add_setting( 'wpex_page_comments', array(
        'type'      => 'theme_mod',
        'default'   => '',
    ) );
    $wp_customize->add_control( 'wpex_page_comments', array(
        'label'     => __('Comments on Pages', 'wpex' ),
        'section'   => 'wpex_general',
        'settings'  => 'wpex_page_comments',
        'type'      => 'checkbox',
        'priority'  => '9',
    ) );

    // Breadcrumbs
    $wp_customize->add_setting( 'wpex_breadcrumbs', array(
        'type'      => 'theme_mod',
        'default'   => '1',
    ) );
    $wp_customize->add_control( 'wpex_breadcrumbs', array(
        'label'     => __('Post Breadcrumbs', 'wpex' ),
        'section'   => 'wpex_general',
        'settings'  => 'wpex_breadcrumbs',
        'type'      => 'checkbox',
        'priority'  => '10',
    ) );

    // Post Author
    $wp_customize->add_setting( 'wpex_post_author', array(
        'type'      => 'theme_mod',
        'default'   => '1',
    ) );
    $wp_customize->add_control( 'wpex_post_author', array(
        'label'     => __('Post Author Link', 'wpex' ),
        'section'   => 'wpex_general',
        'settings'  => 'wpex_post_author',
        'type'      => 'checkbox',
        'priority'  => '11',
    ) );

    // Next Prev
    $wp_customize->add_setting( 'wpex_next_prev', array(
        'type'      => 'theme_mod',
        'default'   => '1',
    ) );
    $wp_customize->add_control( 'wpex_next_prev', array(
        'label'     => __('Next & Previous Post Links', 'wpex' ),
        'section'   => 'wpex_general',
        'settings'  => 'wpex_next_prev',
        'type'      => 'checkbox',
        'priority'  => '12',
    ) );

    // Custom WP Gallery
    $wp_customize->add_setting( 'wpex_custom_wp_gallery_output', array(
        'type'      => 'theme_mod',
        'default'   => '',
    ) );
    $wp_customize->add_control( 'wpex_custom_wp_gallery_output', array(
        'label'     => __('Custom WP Gallery Output', 'wpex' ),
        'section'   => 'wpex_general',
        'settings'  => 'wpex_custom_wp_gallery_output',
        'type'      => 'checkbox',
        'priority'  => '12',
    ) );

    // Entries Display
    $wp_customize->add_setting( 'wpex_excerpt_display', array(
        'type'      => 'theme_mod',
        'default'   => 'custom_excerpt',
    ) );
    $wp_customize->add_control( 'wpex_excerpt_display', array(
        'label'     => __( 'Entry Display', 'wpex' ),
        'section'   => 'wpex_general',
        'settings'  => 'wpex_excerpt_display',
        'priority'  => '13',
        'type'      => 'select',
        'choices'   => array(
            'custom_excerpt' => __( 'Custom Excerpt', 'wpex' ),
            'the_excerpt'    => __( 'WordPress Excerpt', 'wpex' ),
            'the_content'    => __( 'The Content', 'wpex' ),
        )
    ) );

    // Excerpt Length
    $wp_customize->add_setting( 'wpex_excerpt_length', array(
        'type'      => 'theme_mod',
        'default'   => '30',
    ) );
    $wp_customize->add_control( 'wpex_excerpt_length', array(
        'label'         => __( 'Entry Excerpt Length', 'wpex' ),
        'section'       => 'wpex_general',
        'settings'      => 'wpex_excerpt_length',
        'priority'      => '13',
    ) );

    // Entry Columns
    $wp_customize->add_setting( 'wpex_entry_columns', array(
        'type'      => 'theme_mod',
        'default'   => '3',
    ) );
    $wp_customize->add_control( 'wpex_entry_columns', array(
        'label'     => __( 'Entry Columns', 'wpex' ),
        'section'   => 'wpex_general',
        'settings'  => 'wpex_entry_columns',
        'priority'  => '13',
        'type'      => 'select',
        'choices'   => array (
            '4'     => '4',
            '3'     => '3',
            '2'     => '2',
            '1'     => '1',
        )
    ) );

    // Archives Layout
    $wp_customize->add_setting( 'wpex_archives_layout', array(
        'type'      => 'theme_mod',
        'default'   => 'fullwidth',
    ) );

    $wp_customize->add_control( 'wpex_archives_layout', array(
        'label'     => __( 'Archive Style', 'wpex' ),
        'section'   => 'wpex_general',
        'settings'  => 'wpex_archives_layout',
        'priority'  => '14',
        'type'      => 'select',
        'choices'   => array (
            'fullwidth'     => __( 'Fullwidth', 'wpex' ),
            'left-sidebar'  => __( 'Left Sidebar', 'wpex' ),
            'right-sidebar' => __( 'Right Sidebar', 'wpex' ),
        )
    ) );

    // Pagination
    $wp_customize->add_setting( 'wpex_pagination', array(
        'type'      => 'theme_mod',
        'default'   => 'infinite-scroll',
    ) );
    $wp_customize->add_control( 'wpex_pagination', array(
        'label'     => __( 'Pagination Style', 'wpex' ),
        'section'   => 'wpex_general',
        'settings'  => 'wpex_pagination',
        'priority'  => '15',
        'type'      => 'select',
        'choices'   => array (
            'infinite-scroll'   => __( 'Infinite Scroll', 'wpex' ),
            'standard'          => __( 'Standard', 'wpex' )
        )
    ) );

    // Footer Columns
    $wp_customize->add_setting( 'wpex_footer_columns', array(
        'type'      => 'theme_mod',
        'default'   => '4',
    ) );
    $wp_customize->add_control( 'wpex_footer_columns', array(
        'label'     => __( 'Footer Columns', 'wpex' ),
        'section'   => 'wpex_general',
        'settings'  => 'wpex_footer_columns',
        'priority'  => '16',
        'type'      => 'select',
        'choices'   => array (
            '4'     => '4',
            '3'     => '3',
            '2'     => '2',
            '1'     => '1',
        )
    ) );
    
}