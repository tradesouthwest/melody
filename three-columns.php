<?php
/**
 * Template Name: Three Columns
 *
 * This is the template you can select fro the page editor to display content three columns wide.
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Melody
 * @since 1.0
 */

get_header(); ?>

    <section aria-labelledby="posts" class="content second-child padded">
                
        <?php get_template_part( 'parts/post-content' ); ?>

    </section>

    <section class="melody-sidebar third-child padded">
        <div class="inner-sidebar">
        
        <?php get_sidebar(); ?>   
        
        </div>
    </section>

</div><!-- Ends parent grid/from header -->

<?php get_footer(); ?>