<?php
/**
 * Returns a post featured image URl
 *
 * @package WordPress
 * @subpackage Fabulous WPExplorer Theme
 * @since Fabulous 1.0
*/


// Returns the site featured image
if ( ! function_exists( 'wpex_get_featured_img_url' ) ) {
    function wpex_get_featured_img_url( $id = '', $full_image = false ) {
            
        // Post Vars
        global $post, $wpex_query;
        $post_id        = $post->ID;
        $post_type      = get_post_type( $post_id );
        $attachment_id  = $id ? $id : get_post_thumbnail_id( $post_id );
        $attachment_url = wp_get_attachment_url( $attachment_id );
        
        // Resizing Vars
        $width  = 9999;
        $height = 9999;
        $crop   = false;
        
        // Return full image url if set to true
        if ( $full_image ) return $attachment_url;
        
        /** Pages **/
        if ( $post_type == 'page' && is_singular( 'page' ) ) {
            $width = '9999';
            $height = '9999';
        }

        /** Standard post **/
        if ( $post_type == 'post' ) {
            // Single Posts
            if ( is_singular() && !$wpex_query ) {
                if ( wpex_sidebar_display() ) {
                    $width = get_theme_mod( 'wpex_post_img_width', '670' );
                    $height = get_theme_mod( 'wpex_post_img_height', '9999' );
                } else {
                    $width = get_theme_mod( 'wpex_full_post_img_width', '1020' );
                    $height = get_theme_mod( 'wpex_full_post_img_height', '9999' );
                }
            } else {
                // Post Entries
                $width = get_theme_mod( 'wpex_entry_img_width', '670' );
                $height = get_theme_mod( 'wpex_entry_img_height', '9999' );
                if ( 'gallery' == get_post_format($post_id) ) {
                    $height = get_theme_mod( 'wpex_entry_gallery_img_height', '440' );
                }
                // Blog template
                global $wpex_entry_columns;
                if ( '1' == $wpex_entry_columns ) {
                    $width = '1020';
                }
            }
        }
    
        // Return Dimensions & crop
        $width  = intval( $width );
        $width  = $width ? $width : '9999';
        $height = intval( $height );
        $height = $height ? $height : '9999';
        $width  = apply_filters( 'wpex_featured_image_width', $width );
        $height = apply_filters( 'wpex_featured_image_height', $height );
        $crop   = ( $height == '9999' ) ? false : true;

        // Resize
        if ( function_exists( 'wpex_image_resize' ) ) {
            $cropped_image = wpex_image_resize( $attachment_url, $width, $height, $crop );
        } else {
            $cropped_image = $attachment_url;
        }

        // Return cropped image
        $cropped_image = apply_filters( 'wpex_get_featured_img_url', $cropped_image );
        return $cropped_image;
            
    }
}