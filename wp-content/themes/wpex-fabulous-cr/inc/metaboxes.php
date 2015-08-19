<?php
/**
 * Setup custom metaboxes and fields.
 *
 */

/*WALTER*/
//add_filter( 'cmb_meta_boxes', 'wpex_metaboxes' );

/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function wpex_metaboxes( array $meta_boxes ) {

	// Meta prefix
	$prefix = 'wpex_';

	// Posts
	$meta_boxes[] = array(
		'id'			=> 'wpex-post-meta',
		'title'			=> __( 'Post Settings', 'wpex' ),
		'pages'			=> array( 'post' ),
		'context'		=> 'normal',
		'priority'		=> 'high',
		'show_names'	=> true,
		'fields'		=> array(
			array(
				'name'		=> __( 'Layout', 'wpex' ),
				'desc'		=> '',
				'id'		=> $prefix . 'post_layout',
				'type'		=> 'select',
				'std'		=> 'right-sidebar',
				'options'	=> array(
					array(
						'name'	=> __( 'Default', 'wpex' ),
						'value'	=> '',
					),
					array(
						'name'	=> __( 'Right Sidebar', 'wpex' ),
						'value'	=> 'right-sidebar',
					),
					array(
						'name' 	=> __( 'Left Sidebar', 'wpex' ),
						'value'	=> 'left-sidebar',
					),
					array(
						'name'	=> __( 'FullWidth', 'wpex' ),
						'value'	=> 'fullwidth',
					),
				),
			),
			array(
				'name'	=> __( 'Video URL', 'wpex' ),
				'desc'	=> __( 'Enter in a video URL that is compatible with WordPress\'s built-in oEmbed function or self-hosted video function.', 'wpex' ),
				'id'	=> $prefix . 'post_video',
				'type'	=> 'file',
				'std'	=> '',
			),
			array(
				'name'	=> __( 'Audio URL', 'wpex' ),
				'desc'	=> __( 'Enter in an audio URL that is compatible with WordPress\'s built-in self-hosted video function.', 'wpex' ),
				'id'	=> $prefix . 'post_audio',
				'type'	=> 'file',
				'std'	=> '',
			),
			array(
				'name'	=> __( 'Disable Entry Embed', 'wpex' ),
				'desc'	=> __( 'Check this box to disable the video/audio embed on entries. See the theme customizer if you wish to do this for all video & audio entries.', 'wpex' ),
				'id'	=> $prefix . 'disable_entry_embed',
				'type'	=> 'checkbox',
				'std'	=> '',
			),
			array(
				'name'	=> __( 'Disable Breadcrumbs', 'wpex' ),
				'desc'	=> __( 'If breadcrumbs are enabled you can disable them on a per-post basis using this setting.', 'wpex' ),
				'id'	=> $prefix . 'disable_breadcrumbs',
				'type'	=> 'checkbox',
				'std'	=> '',
			),
			array(
				'name'	=> __( 'Disable Featured Image Display (On Post)', 'wpex' ),
				'desc'	=> __( 'Check this box to prevent the featured image from displaying on the post.', 'wpex' ),
				'id'	=> $prefix . 'disable_featured_image',
				'type'	=> 'checkbox',
				'std'	=> '',
			),
		),
	);

	// Pages
	$meta_boxes[] = array(
		'id'			=> 'wpex-post-meta',
		'title'			=> __( 'Page Settings', 'wpex' ),
		'pages'			=> array( 'page' ),
		'context'		=> 'normal',
		'priority'		=> 'high',
		'show_names'	=> true,
		'fields'		=> array(
			array(
				'name'		=> __( 'Layout', 'wpex' ),
				'desc'		=> '',
				'id'		=> $prefix . 'post_layout',
				'type'		=> 'select',
				'std'		=> 'right-sidebar',
				'options'	=> array(
					array(
						'name'	=> __( 'Default', 'wpex' ),
						'value'	=> '',
					),
					array(
						'name'	=> __( 'Right Sidebar', 'wpex' ),
						'value'	=> 'right-sidebar',
					),
					array(
						'name' 	=> __( 'Left Sidebar', 'wpex' ),
						'value'	=> 'left-sidebar',
					),
					array(
						'name'	=> __( 'FullWidth', 'wpex' ),
						'value'	=> 'fullwidth',
					),
				),
			),
			array(
				'name'	=> __( 'Disable Featured Image Display', 'wpex' ),
				'desc'	=> __( 'Check this box to prevent the featured image from displaying on the post.', 'wpex' ),
				'id'	=> $prefix . 'disable_featured_image',
				'type'	=> 'checkbox',
				'std'	=> '',
			),
		),
	);

	return $meta_boxes;
}