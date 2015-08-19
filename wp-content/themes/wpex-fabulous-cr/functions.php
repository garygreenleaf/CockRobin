<?php
/**
 * Theme functions and definitions.
 *
 * Sets up the theme and provides some helper functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package     Fabulous
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2014, Symple Workz LLC
 * @link        http://www.wpexplorer.com
 * @since       1.0.0
 */

/*-----------------------------------------------------------------------------------*/
/*  - Theme Setup
/*-----------------------------------------------------------------------------------*/
if ( ! isset( $content_width ) ) {
    $content_width = 650;
}

/**
 * Main Theme Class => One class to rule it all!
 *
 * @since Fabulouse 1.0.0
 */
class WPEX_Theme_Setup {

    /**
     * Start things up
     */
    function __construct() {

        // Vars
        $this->template_dir     = get_template_directory();
        $this->template_dir_uri = get_template_directory_uri();
        $this->classes_dir      = $this->template_dir . '/inc/classes/';
        $this->classes_dir_uri  = $this->template_dir_uri . '/inc/classes/';
        $this->css_dir_uri      = $this->template_dir_uri .'/css/';
        $this->js_dir_uri       = $this->template_dir_uri .'/js/';
        $this->retina_enabled   = get_theme_mod( 'wpex_retina' );

        // Actions & Filters
        add_action( 'init', array( $this, 'init_classes' ) );
        add_action( 'after_setup_theme', array( $this, 'setup' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
        add_filter( 'body_class', array( $this, 'body_classes' ) );
        add_filter( 'post_class', array( $this, 'post_class' ) );
        // add_filter( 'user_contactmethods', array( $this, 'user_fields' ) );
        add_filter( 'mce_buttons_2', array( $this, 'mce_font_size_select' ) );
        add_filter( 'tiny_mce_before_init', array( $this, 'fontsize_formats' ) );

    }

    /**
     * Initialize the metabox class.
     *
     * @since 1.1.0
     */
    function init_classes() {

        // Customizer Manager
        if ( ! class_exists( 'WPEX_Customizer_Manager' ) ) {
            require_once ( $this->classes_dir .'customizer-manager.php' );
        }

        // Gallery metabox
        if ( ! class_exists( 'WPEX_Gallery_Metabox' ) ) {
             require_once ( $this->classes_dir .'gallery-metabox/gallery-metabox.php' );
        }

        // Aqua resizer
        if ( ! class_exists( 'WPEX_Image_Resize' ) ) {
            require_once ( $this->classes_dir .'image-resize.php' );
        }


    }

    /**
     * Loads required scripts
     *
     * @link    http://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts
     * @since   1.1.0
     */
    function scripts() {

        /** CSS **/
        wp_enqueue_style( 'style', get_stylesheet_uri() );
        wp_enqueue_style( 'font-awesome', $this->template_dir_uri .'/css/font-awesome.min.css' );

        // Remove font awesome from symple shortcodes
        wp_dequeue_style( 'symple_shortcodes_font_awesome' );

        if ( get_theme_mod( 'wpex_g_font', '1' ) ) {
            wp_enqueue_style( 'wpex-google-font-source-sans-pro', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic&subset=latin,vietnamese,latin-ext' );
            wp_enqueue_style( 'wpex-google-nunito', 'http://fonts.googleapis.com/css?family=Nunito:400,300,700' );
        }

        if ( function_exists( 'wpcf7_enqueue_styles') ) {
            wp_dequeue_style( 'contact-form-7' );
        }

        // Load media css for embeds
        if ( 'infinite-scroll' == get_theme_mod( 'wpex_pagination', 'infinite-scroll' ) && get_theme_mod( 'wpex_blog_entry_thumb', '1' ) ) {
            wp_enqueue_style( 'mediaelement' );
        }

        /** jQuery **/

        // RTL for masonry
        if ( is_rtl() ) {
            $isOriginLeft = false;
        } else {
            $isOriginLeft = true;
        }

        // Load media css for embeds
        if ( 'infinite-scroll' == get_theme_mod( 'wpex_pagination', 'infinite-scroll' ) && get_theme_mod( 'wpex_blog_entry_thumb', '1' ) ) {
            wp_enqueue_script( 'wp-mediaelement' );
        }

        // Threaded commments
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

        // Retina Support
        if ( get_theme_mod( 'wpex_retina' ) ) {
            wp_enqueue_script( 'wpex-retina', $this->js_dir_uri .'retina.js', array( 'jquery' ), false, true );
        }

        // Main js plugins
        wp_enqueue_script( 'wpex-plugins', $this->js_dir_uri .'plugins.js', array( 'jquery' ), '1.7.5', true );

        // Init
        wp_enqueue_script( 'wpex-global', $this->js_dir_uri .'global.js', array( 'jquery', 'wpex-plugins' ), false, true );
        wp_localize_script( 'wpex-global', 'wpexLocalize', array(
            'mobileMenuOpen'    => get_theme_mod( 'wpex_mobile_menu_open_text', __( 'Click here to navigate', 'wpex' ) ),
            'mobileMenuClosed'  => get_theme_mod( 'wpex_mobile_menu_close_text', __( 'Close navigation', 'wpex' ) ),
            'isOriginLeft'      => $isOriginLeft,
        ) );

    }

    /**
     * Load twitter js for use with infinite scroll
     *
     * @since 1.1.0
     */
    public function load_twitter_widget_js() {
        if ( 'infinite-scroll' == get_theme_mod( 'wpex_pagination', 'infinite-scroll' ) ) {
            echo '<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>';
        }
    }

    /**
     * Defines the URL for the gallery metabox class
     *
     * @since 1.1.0
     */
    function gallery_metabox_uri() {
        return $this->classes_dir_uri .'gallery-metabox/';
    }

    /**
     * Functions called during each page load, after the theme is initialized
     * Perform basic setup, registration, and init actions for the theme
     *
     * @link    http://codex.wordpress.org/Plugin_API/Action_Reference/after_setup_theme
     * @since   1.1.0
     */
    public function setup() {

        // Register navigation menus
        register_nav_menus (
            array(
                'main_menu' => __( 'Main', 'wpex' ),
            )
        );

        // Localization support
        load_theme_textdomain( 'wpex', get_template_directory() .'/languages' );

        // Enable some useful post formats for the blog
        // add_theme_support( 'post-formats', array( 'video', 'audio', 'quote', 'gallery', 'status' ) );

        // Add theme support
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'custom-background' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'title-tag' );

        // Set default thumbnail size
        set_post_thumbnail_size( 150, 150 );

        // Remove theme check nags
        if ( 'nag' == 'annoying' ) {
            add_theme_support( 'custom-header', $args );
            the_post_thumbnail();
        }

    }

    /**
     * Recommend plugins
     *
     * @link http://tgmpluginactivation.com/
     * @since   1.1.0
     */
    public function recommend_plugins() {

        // List of plugins to recommend
        $plugins = array(

            array(
                'name'              => 'Symple Shortcodes',
                'slug'              => 'symple-shortcodes',
                'source'            => 'http://www.wpexplorer.com/symple-shortcodes-download',
                'required'          => false,
                'force_activation'  => false,
            ),

            array(
                'name'              => 'Contact Form 7',
                'slug'              => 'contact-form-7',
                'required'          => false,
                'force_activation'  => false,
            )

        );

        // Text domain
        $theme_text_domain = 'wpex';

        // Configuration array
        $config = array(
            'domain'            => $theme_text_domain,
            'default_path'      => '',
            'parent_menu_slug'  => 'themes.php',
            'parent_url_slug'   => 'themes.php',
            'menu'              => 'install-required-plugins',
            'has_notices'       => true,
            'is_automatic'      => false,
            'message'           => '',
            'strings'           => array(
                'page_title'                                => __( 'Install Required Plugins', $theme_text_domain ),
                'menu_title'                                => __( 'Install Plugins', $theme_text_domain ),
                'installing'                                => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
                'oops'                                      => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
                'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),
                'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),
                'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),
                'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
                'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),
                'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
                'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ),
                'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
                'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
                'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
                'return'                                    => __( 'Return to Required Plugins Installer', $theme_text_domain ),
                'plugin_activated'                          => __( 'Plugin activated successfully.', $theme_text_domain ),
                'complete'                                  => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ),
                'nag_type'                                  => 'updated'
            )
        );

        //if ( function_exists( 'tgmpa' ) ) {
           // tgmpa( $plugins, $config );
        //}

    }


    /**
     * Body Classes
     *
     * @link    http://codex.wordpress.org/Function_Reference/body_class
     * @since   1.1.0
     */
    public function body_classes( $classes ) {

        // Get global post
        global $post;
        if ( $post ) {
            $post_id = $post->ID;
        }

        // WPExplorer class
        $classes[] = 'wpex-theme';

        // Skin
        $classes[] = get_theme_mod( 'wpex_theme_skin', 'dark' ) .'-skin';

        // Mobile
        if ( wp_is_mobile() ) {
            $classes[] = 'is-mobile';
        }

        //Layout Classes
        if ( is_singular() ) {
            if ( $post_layout = get_post_meta( $post_id, 'wpex_post_layout', true ) ) {
                $classes[] = $post_layout;
            }
        } else {
            $classes[] = get_theme_mod( 'wpex_archives_layout' );
        }

        // Grid Classes
        $classes[] = 'entry-columns-'. wpex_entry_grid_class();

        // Sidebar
        if ( wpex_sidebar_display() ) {
            $classes[] = 'no-sidebar';
        } else {
            $classes[] = 'no-sidebar';
        }

        // Breadcrumbs
        if ( get_theme_mod( 'wpex_breadcrumbs', true ) ) {
            if ( is_singular() && 'on' != get_post_meta( $post_id, 'wpex_disable_breadcrumbs', true ) ) {
                $classes[] = 'breadcrumbs-enabled';
            } else {
                $classes[] = 'breadcrumbs-enabled';
            }
        }

        // Optimize Images
        if ( get_theme_mod( 'wpex_image_optimize') ) {
            $classes[] = 'image-rendering';
        }

        return $classes;
    }

    /**
     * Post Classes
     *
     * @link    http://codex.wordpress.org/Function_Reference/post_class
     * @since   1.1.0
     */
    public function post_class( $classes ) {

        // Post Data
        global $post, $wpex_count, $wpex_entry_columns;
        $post_id    = $post->ID;
        $post_type  = get_post_type($post_id);
        if ( $wpex_entry_columns ) {
            $grid_class = wpex_grid_class( $wpex_entry_columns );
        } else {
            $grid_class = wpex_grid_class( wpex_entry_grid_class() );
        }

        // Custom class for non standard post types
        if ( 'post' != $post_type && ! is_singular() ) {
            $classes[] = $post_type .'-entry';
        }

        // All other posts
        if ( ! is_singular() ) {
            $classes[] = $grid_class;
            $classes[] = 'masonry-entry';
            $classes[] = 'col-'. $wpex_count;
            $classes[] = 'loop-entry col clr';
        }

        // Search
        if ( is_search() ) {
            $classes[] = $grid_class;
            $classes[] = 'masonry-entry';
            $classes[] = 'col-'. $wpex_count;
            $classes[] = 'loop-entry col clr';
        }

        // Return classes
        return $classes;

    }

    /**
     * Add new user fields
     *
     * Commenting this function as we are not showing the author information
     */

    /*
    function user_fields( $contactmethods ) {

        // Add Twitter
        if ( ! isset( $contactmethods['wpex_twitter'] ) ) {
            $contactmethods['wpex_twitter'] = 'Fabulous - Twitter';
        }
        // Add Facebook
        if ( ! isset( $contactmethods['wpex_facebook'] ) ) {
            $contactmethods['wpex_facebook'] = 'Fabulous - Facebook';
        }
        // Add GoglePlus
        if ( ! isset( $contactmethods['wpex_googleplus'] ) ) {
            $contactmethods['wpex_googleplus'] = 'Fabulous - Google+';
        }
        // Add LinkedIn
        if ( ! isset( $contactmethods['wpex_linkedin'] ) ) {
            $contactmethods['wpex_linkedin'] = 'Fabulous - LinkedIn';
        }
        // Add Pinterest
        if ( ! isset( $contactmethods['wpex_pinterest'] ) ) {
            $contactmethods['wpex_pinterest'] = 'Fabulous - Pinterest';
        }
        // Add Pinterest
        if ( ! isset( $contactmethods['wpex_instagram'] ) ) {
            $contactmethods['wpex_instagram'] = 'Fabulous - Instagram';
        }

        // Return contact methods
        return $contactmethods;

    }
    */

    /**
     * Add Font size select to tinymce
     *
     * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/mce_buttons,_mce_buttons_2,_mce_buttons_3,_mce_buttons_4
     */
    public function mce_font_size_select( $buttons ) {
        array_unshift( $buttons, 'fontsizeselect' );
        return $buttons;
    }

    /**
     * Customize default font size selections for the tinymce
     *
     * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/mce_buttons,_mce_buttons_2,_mce_buttons_3,_mce_buttons_4
     */
    public function fontsize_formats( $initArray ) {
        $initArray['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 18px 21px 24px 28px 32px 36px";
        return $initArray;
    }

}
$wpex_theme_setup = new WPEX_Theme_Setup;

/*-----------------------------------------------------------------------------------*/
/*  - Customizer Settings
/*-----------------------------------------------------------------------------------*/
require_once ( get_template_directory() .'/inc/theme-customizer/header.php' );
require_once ( get_template_directory() .'/inc/theme-customizer/general.php' );
require_once ( get_template_directory() .'/inc/theme-customizer/styling.php' );
require_once ( get_template_directory() .'/inc/theme-customizer/image-sizes.php' );


/*-----------------------------------------------------------------------------------*/
/*  - Register custom widgets
/*-----------------------------------------------------------------------------------*/

// Define widget areas & custom widgets
require_once( get_template_directory() .'/inc/widgets/widget-areas.php' );


/*-----------------------------------------------------------------------------------*/
/*  - Other functions
/*-----------------------------------------------------------------------------------*/

// Core theme functions
require_once( get_template_directory() .'/inc/core-functions.php' );


if( !is_admin() ){

    // Returns featured image url
    require_once( get_template_directory() .'/inc/featured-image.php' );

    // Show or hide sidebar accordingly
    require_once( get_template_directory() .'/inc/sidebar-display.php' );

    // Comments output
    require_once( get_template_directory() .'/inc/comments-callback.php' );

    // Pagination output
    require_once( get_template_directory() .'/inc/pagination.php' );

    // Custom excerpts
    require_once( get_template_directory() .'/inc/excerpts.php' );

    // Outputs post meta (date, cat, comment count)
    require_once( get_template_directory() .'/inc/post-meta.php' );

    // Outputs the post format video
    require_once( get_template_directory() .'/inc/post-video.php' );

    // Outputs the post format audio
    require_once( get_template_directory() .'/inc/post-audio.php' );

    // Outputs post slider
    require_once( get_template_directory() .'/inc/post-gallery.php' );

    // Adds a mobile search to the sidr container
    require_once( get_template_directory() .'/inc/mobile-search.php' );

    // Page featured images
    require_once( get_template_directory() .'/inc/page-featured-image.php' );

    // Post featured images
    require_once( get_template_directory() .'/inc/post-featured-image.php' );

    // Breadcrumbs
    require_once( get_template_directory() .'/inc/breadcrumbs.php' );

    // Outputs content for quote format
    require_once( get_template_directory() .'/inc/quote-content.php' );

}
