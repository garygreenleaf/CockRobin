<?php
/**
 * Outputs the site logo
 *
 * @package     Fabulous
 * @subpackage  Template Parts
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2014, Symple Workz LLC
 * @link        http://www.wpexplorer.com
 * @since       1.0.0
 */

// Vars

//$logo_img			= get_theme_mod( 'wpex_logo', get_template_directory_uri(). '/images/logo.png' );
$logo_img			= get_template_directory_uri(). '/images/logo.png';
$blog_name			= get_bloginfo( 'name' );
$blog_description	= get_bloginfo( 'description' );
$home_url			= home_url();
$fb_logo      = get_template_directory_uri(). '/images/findus.png';

?>

<div id="logo" class="span_1_of_2 col col-1">
	<?php if ( $logo_img ) { ?>
		<a href="<?php echo $home_url; ?>" title="<?php echo $blog_name; ?>" rel="home"><img src="<?php echo $logo_img; ?>" alt="<?php echo $blog_name; ?>" /></a>
		<?php if ( $blog_description && get_theme_mod( 'wpex_logo_subheading', '1' ) ) { ?>
			<div class="blog-description"><?php echo $blog_description; ?></div>
		<?php } ?>
	<?php } else { ?>
		<div class="site-text-logo clr">
			<a href="<?php echo $home_url; ?>" title="<?php echo esc_attr($blog_name); ?>" rel="home"><?php echo $blog_name; ?></a>
			<?php if ( $blog_description && get_theme_mod( 'wpex_logo_subheading', '1' ) ) { ?>
				<div class="blog-description"><?php echo $blog_description; ?></div>
			<?php } ?>
		</div>
	<?php } ?>
</div>
<!-- #logo -->
<div class="span_1_of_2 col col-2">
  <a href="http://www.facebook.com/cockrobinanglais" target="_blank"><img class="fb_logo" src="<?php echo $fb_logo;?>"></a>
</div>
<!--
<div id="search-box" class="span_1_of_2 col col-2">
    <form method="get" id="searchform" class="span_2_of_3 col first col-2" action="<?php get_bloginfo('url'); ?>/">
        <div class="form-inner">
          <input type="text" size="18" value="<?php echo esc_html($s, 1); ?>" placeholder="Search" name="s" id="s" />
            <input type="submit" id="searchsubmit" value="Search" class="btn" />
        </div>
    </form>
</div>
-->
