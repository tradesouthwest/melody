<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package Melody
 * @since   Melody 1.0
 */
?>


	<div id="primary-default" class="sidebar widget-area" role="complementary">
    
    <?php 
    if ( is_active_sidebar( 'sidebar-primary' ) ) { ?>
    
        <?php dynamic_sidebar( 'sidebar-primary' ); ?>
    
    <?php 
    } else { the_widget( 'WP_Widget_Recent_Posts' ); } ?>    
    
    </div><!-- .sidebar .widget-area -->
