<?php 
/**
 * Page options settings and helpers
 * @since 1.0
 * @package melody
 */

/**
 * Text sanitizer for numeric values
 * @since 1.0
 * @see https://themefoundation.com/wordpress-theme-customizer/
 * @return string $input
 */
function melody_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
} 

/**
 * Text sanitizer for outputs
 * @since 1.0
 * 
 * @return string $input
 */
function melody_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Send custum CSS to wp_head
 * @since 1.0
 * 
 */
function melody_theme_customizer_css() {
    echo '<style id="melody-theme-mods">';
    if ( get_theme_mods() ) : 
        $pgwidth = get_theme_mod( 'melody_page_width', '1440' );
        $aline   = get_theme_mod( 'melody_content_align', 'justify' );
        $cbk     = get_theme_mod( 'melody-content-bkgrnd', '#fafafa' );
        $sbk     = get_theme_mod( 'melody-sides-bkgrnd', '#fafafa' );
        $sndbk   = get_theme_mod( 'melody-second-background', '#fafafa' );
       
    echo ':root{ 
        --lite: ' . esc_attr( $sndbk ) . ';
        --beige: ' . esc_attr( $sbk ) . ';
        --smoke:  ' . esc_attr( $cbk ) . ';
        --dark: #2d2d2d;
    }
    .wrapper{ max-width: ' . absint( $pgwidth ) . 'px;} 
    .second-child{
        background: var(--smoke)
    }
    .first-child{
       background: var(--beige)
    }
    .third-child{
        background: var(--beige);
    }
    .footer-base,
    .inner-wide-header{
        background: var(--lite);
    }
    .inner-article-content{
        text-align: ' . esc_attr( $aline ) . ';
    }';
    endif;
    echo '</style>';
}