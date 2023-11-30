 <?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> 
            itemscope itemtype="https://schema.org/Article">
     
        <header class="article-heading">
         
            <h2 class="post-title"><?php the_title(); ?></h2>

        </header>
            <div class="inner-article-content">
                <figure class="linked-attachment-container">
                <a class="imgwrap-link"
                href ="<?php echo esc_url( get_attachment_link( get_post_thumbnail_id() ) ); ?>" 
                title="<?php the_title_attribute( 'before=Permalink to: &after=' ); ?>">
                <?php 
                the_post_thumbnail( 'medium_size', array( 
                        'itemprop' => 'image', 
                        'class'  => 'melody-featured',
                        'alt'  => get_attachment_link( get_post_thumbnail_id() )
                    ) 
                ); ?></a>
                </figure>
                <div class="melody-inner-content">
                    <?php
                    the_content();
                    ?>
                </div>
                <nav class="page-link-footing">
                <?php
                wp_link_pages(
                    array(
                        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'classicsixteen' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                        'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'classicsixteen' ) . ' </span>%',
                        'separator'   => '<span class="screen-reader-text">, </span>',
                    )
                );
                ?>
                </nav>
                <span class="melody-footing-meta">
                <small><?php esc_html_e('By: ', 'melody'); ?> <em><?php the_author(); ?></em>
                | <?php esc_html_e('Categorized as: ', 'melody'); ?> <em><?php the_category( ' &bull; ' ); ?></em>
                | <?php esc_html_e('Keys: ', 'melody'); ?><em> <?php the_tags( ' ' ); ?></em>
                | <?php esc_html_e('Added on: ', 'melody'); ?> <em><?php the_date(); ?></em></small>
                </span>
            </div>
                <footer class="melody-comments">
                    <?php 
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    } ?>
                </footer>

    </article>
    <?php endwhile; ?>
    <?php else : ?>
            
        <div class="post-content">
		        
            <?php echo esc_url( home_url('/') ); ?>
            
        </div>

    <?php endif; ?>         