<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Creativeforces
 * @since Creativeforces 1.0
 */

?>
<head>
	<link rel="stylesheet" type="text/css" href="/wp-content/themes/creativeforces/css/sidebar.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
</head>



<?php get_header(); ?>

<?php
if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) || is_active_sidebar( 'sidebar-1' )  ) : ?>
    <div id="secondary" class="secondary">

        <?php if ( has_nav_menu( 'primary' ) ) : ?>
            <nav id="site-navigation" class="main-navigation" role="navigation">
                <?php
                    // Primary navigation menu.
                    wp_nav_menu( array(
                        'menu_class'     => 'nav-menu',
                        'theme_location' => 'primary',
                    ) );
                ?>
            </nav><!-- .main-navigation -->
        <?php endif; ?>

        <?php if ( has_nav_menu( 'social' ) ) : ?>
            <nav id="social-navigation" class="social-navigation" role="navigation">
                <?php
                    // Social links navigation menu.
                    wp_nav_menu( array(
                        'theme_location' => 'social',
                        'depth'          => 1,
                        'link_before'    => '<span class="screen-reader-text">',
                        'link_after'     => '</span>',
                    ) );
                ?>
            </nav><!-- .social-navigation -->
        <?php endif; ?>

        <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
            <div id="widget-area" class="widget-area" role="complementary">
                <?php dynamic_sidebar( 'sidebar-1' ); ?>
            </div><!-- .widget-area -->
        <?php endif; ?>

    </div><!-- .secondary -->

<?php endif; ?>
<div class="clear">
<?php if ( is_active_sidebar( 'home_right_1' ) ) : ?>
    <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
        <div class="rss"><?php dynamic_sidebar( 'home_right_1' ); ?></div>
    </div><!-- #primary-sidebar -->
    </div>
<?php endif; ?>

<?php get_footer(); ?>





