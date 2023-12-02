<?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> 
            itemscope itemtype="https://schema.org/Article">
    <div class="melody-landing-wrapper"> 
        
        <header class="article-heading">
         
            <h2 class="post-title"><?php the_title(); ?></h2>

        </header>

            <div class="inner-article-content">
                <figure class="landing-attachment-container">
                    <?php
                    /* only display if added via editor */
                    if( has_post_thumbnail() ) { 
                            the_post_thumbnail('full'); 
                        } else { 
                            echo '';
                        } ?>
                    </a>
                </figure>
                    <div class="melody-inner-content">
                        <?php
                        the_content();
                        ?>
                    </div>
            </div>
          
    </div>
</article>
    
    <?php endwhile; ?>
        <?php else : ?>
            
        <div class="post-content">
		        
            <?php echo esc_url( home_url('/') ); ?>
            
        </div>

<?php endif; ?> 