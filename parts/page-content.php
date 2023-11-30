 <?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> 
            itemscope itemtype="https://schema.org/Article">
     
        <header class="article-heading">
         
            <h2><?php the_title(); ?></h2>
         
        </header>
            <div class="inner-article-content">

                <?php
                the_content();
                ?>

                <nav>
                <?php 
                    wp_link_pages(	array(
                        'before' => '<div class="page-link"><span>' . __( 'Pages:', 'lunar' ) . '</span>',
                        'after'  => '</div>', 
                    ) ); ?> 
                </nav>
            </div>
            <footer class="melody-comments">
                <?php 
                // If comments are open or we have at least one comment, load up the comment template.
			  /*  if ( comments_open() || get_comments_number() ) {
				    comments_template();
			    } */ 
                ?>
            </footer>

    </article>
    <?php endwhile; ?>
    <?php else : ?>
            
        <div class="post-content">
		        
            <?php echo esc_url( home_url('/') ); ?>
            
        </div>

    <?php endif; ?>         