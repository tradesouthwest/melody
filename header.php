<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "main" tag.
 *
 * @package melody
 * @since   1.0
 */

?><!DOCTYPE html>
<html>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>

    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <a class="skip-link screen-reader-text" aria-label="first content" href="#sitecontent">
        <?php esc_html_e( 'Skip to content', 'melody' ); ?>
    </a>

<div class="wrapper"><!-- ends in footer -->
    
    <header class="wide-container">
        <div class="inner-wide-header">


            <div class="melody-search-top hsection">

            <?php 
            if ( is_active_sidebar( 'sidebar-header' ) ) { 
                dynamic_sidebar( 'sidebar-header' ); 
            } else {  
                the_widget( 'WP_Widget_Search' ); 
            } ?>

            </div>

            <div class="hgroup hsection">
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" 
                    rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <span class="site-description">
                    <?php echo esc_html( get_bloginfo( 'description', 'display' ) ); ?>
                </span>
            </div>

            <div class="logo-top hsection">
                <?php if( has_custom_logo() ) : ?>
                	
                <figure class="site-logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="bookmark">
                    <?php 
                    echo wp_kses_post( force_balance_tags( melody_theme_custom_logo() ) ); 
                    ?></a>
                </figure>

                <?php endif; ?>
            </div>

        </div>
    </header>

    <div class="parent"><!-- Ends in page templates -->

        
        <div class="nav-container first-child">
            <button
                id="openMobi" 
                class="navbar-toggle button outline" 
                onclick="handleClick()"
                aria-expanded="false"
                aria-controls="mobile-menu">
            <svg
                width="24"
                height="24"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path
                fill-rule="evenodd"
                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                clip-rule="evenodd">
                </path>
            </svg>
            </button>
                <div id="togmenu" class="page-nav-wrapper" style="display: flex;">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location'  => 'primary-menu',
                            'depth'          => 3,
                            'container'     => 'nav',
                            'menu_class'   => 'page-nav',
                            'add_a_class' => 'primary-anchor',
                            'fallback_cb' => 'wp_page_menu',
                        )
                    ); ?>
                </div>
                <div class="melody-nav-widget padded">
                    <?php 
                    if ( is_active_sidebar( 'sidebar-sidenav' ) ) { ?>
                    
                        <?php dynamic_sidebar( 'sidebar-sidenav' ); ?>
                    
                    <?php 
                    } else { the_widget( 'WP_Widget_Meta' ); } ?>    
                </div>
                
        </div>
