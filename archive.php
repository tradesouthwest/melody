<?php
/**
*
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Melody
 * @since 1.0
 */

get_header(); ?>
    <section aria-labelledby="posts" class="content second-child padded">
    <header class="melody-search-header">
        <h3><?php esc_html_e( 'Found', 'melody' ); ?></h3>
    </header>
                
        <?php get_template_part( 'parts/home-content'); ?>

    </section>

</div><!-- Ends parent grid/from header -->

<?php get_footer(); ?>