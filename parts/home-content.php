 <?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> 
            itemscope itemtype="https://schema.org/Article">
        <div class="melody-home-post-wrap"> 

            <div class="excerpt-post-heading">
                <a class="excerptwrap-link"
                    href ="<?php echo esc_url( get_permalink() ); ?>" 
                    title="<?php the_title_attribute( 'before=Permalink to: &after=' ); ?>">
                    <?php 
                    if( has_post_thumbnail() ) { 
                        the_post_thumbnail('melody-excerpt'); 
                    } else { 
                        do_action( 'melody_excerpt_blank' );
                    } ?>
                </a>
            </div>

            <div class="melody-excerpt-wrap">
                <header class="post-excerpt-heading">
                    <h2 class="melody-post-heading"><?php the_title( sprintf( '<span class="post-title"><a href="%s" rel="bookmark">', 
                        esc_attr( esc_url( get_permalink() ) ) 
                        ), '</a></span>' 
                    ); ?></h2>
                    <div class="melody-excerpt-meta">
                        <small>
                        <?php do_action( 'melody_blog_date' ); ?>
                    </small>
                </div>
                </header>
                    <div class="inner-article-content">

                        <?php 
                        /* Load excerpt */
                        do_action( 'inner_article_excerpt' ); 
                        ?>
                        
                    </div> 
                        
            </div>

        </div>
    </article>
  
    <?php endwhile; ?>
    <nav class="pagination-nav">
            <p><span class="nav-previous alignleft">
            <?php previous_posts_link( '<span class="prevpst-nav"> < </span>' ); ?>
            </span>
            <span class="algn-cntr">
                <?php do_action( 'flexline_check_pagination' ); ?>
            </span>
            <span class="nav-next alignright">
                <?php next_posts_link( '<span class="nextpst-nav"> > </span>' ); ?>
            </span></p>
        </nav>
    <?php else : ?>
            
        <div class="post-content">
		        
            <?php echo esc_url( home_url('/') ); ?>
            
        </div>

    <?php endif; ?>         