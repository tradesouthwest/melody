<?php
/**
 * Template Name: Landing Page
 *
 * This is the template you can select to use as a landing page.
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Melody
 * @since 1.0
 */

get_header(); ?>

    <section aria-labelledby="posts" class="melody-section-content second-child padded">
                
        <?php get_template_part( 'parts/landing-content'); ?>
    
        <div class="melody-landing-excerpt">
  
            <?php
            /* Add excerpt section */
            if( has_excerpt() ) the_excerpt(); 
            ?>

        </div>
            <div class="melody-landing-footing">
                
                <?php 
                /* Add widget section */
                if ( is_active_sidebar( 'sidebar-landing' ) ) { ?>
                    <?php 
                    dynamic_sidebar( 'sidebar-landing' ); ?>
                <?php 
                } ?>
            </div>
    </section>

</div><!-- Ends parent grid/from header -->

<?php get_footer(); ?>