<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package solo
 * @since 1.0
 */

get_header(); ?>

    <section aria-labelledby="posts" class="content second-child padded">
                
        <?php get_template_part( 'parts/page-content'); ?>

    </section>

</div><!-- Ends parent grid/from header -->

<?php get_footer(); ?>