<?php
/**
 * Footer file
 */   
?>
    <footer class="wide-container">

        <div class="footer-base">
            <div class="site-copyright-section">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" 
                rel="bookmark">
                <?php 
                printf( '<small>%s &copy; %s</small>',
                    bloginfo( 'name' ),
                    esc_html( gmdate( 'Y' ) ) 
                ); ?></a>
            </div>
            <div class="upto-section">
                <a class="back_to_top" 
                    title="<?php esc_attr_e('Top of page link', 'melody'); ?>">
                    <sup>^</sup>
                </a>
            </div>
        </div>
        
    </footer>

</div>
    <?php wp_footer(); ?>
</body>
</html> 