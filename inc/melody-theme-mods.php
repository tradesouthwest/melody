<?php 
/**
 * Page options settings and helpers
 * @since 1.0
 * @package melody
 */
if ( ! defined( 'ABSPATH' ) ) exit;
// A1
add_action( 'admin_menu',         'melody_theme_options_help_page' );
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

/** @id A1
 * Add theme menu
 *
 * @since 1.0.1
 * @uses add_theme_page()
 * $page_title, $menu_title, $capability, $menu_slug, $function
 */
function melody_theme_options_help_page() {

    add_theme_page(
        __( 'Theme Information', 'melody' ),
        __( 'Melody Help', 'melody' ),
        'edit_theme_options',
        'melody-theme-help',
        'melody_siteinfo_admin_render'
    );
}

/**
 * Information about website
 * @since 1.0.1
 * @return HTML string
 */

 function melody_siteinfo_admin_render(){
    if ( !is_admin() ) return;
    ?>
    <div class="wrap">
        <div id="icon-themes" class="icon32"></div>
        <h2>Melody Theme Help</h2>
        <?php settings_errors(); ?>
        <?php
            if( isset( $_GET[ 'tab' ] ) ) {
                $active_tab = $_GET[ 'tab' ];
            } 
    $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'display_options';
        ?>
    <h2 class="nav-tab-wrapper">
    <a href="?page=melody-theme-help&tab=display_options" class="nav-tab">Environment</a>
    <a href="?page=melody-theme-help&tab=theme_options" class="nav-tab">Help</a>
    </h2>
    <?php 
    if( $active_tab == 'display_options' ) { ?>
    
    <section>
    <h2><?php _e( 'Basic Information', 'melody'); ?></h2>

    <div id="melody-short" style="background:#aafafa;height:3em">
        <?php echo melody_short_basic_debug_info(); ?>
    </div>
    <hr id="melody-hr"><br>

    </section>
    <?php } else { ?>

    <section>
        
        <?php include( 'melody-theme-notes.php'); ?>
        
    </section>
        
    <?php } ?>
    
    </div>
    <?php 
}
function melody_short_basic_debug_info( $html = true ) {
    global $wp_version, $wpdb;

    $data = array(
        'WordPress Version'     => $wp_version,
        'PHP Version'           => phpversion(),
        'MySQL Version'         => $wpdb->db_version(),
        'WP_DEBUG'              => ( WP_DEBUG === true ) ?  
                                   'Enabled' : 'Disabled',
    );
    if ( $html ) {
        $html = '<ol>';
        foreach ( $data as $what_v => $v ) {
$html .= '<li style="display: inline;"><strong>' . $what_v . '</strong>: ' . $v . ' </li>';
        }
        $html .= '</ol>';
    }
    return $html;
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
        $landtitl= get_theme_mod( 'melody_landing_title', 'inline-block' );
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
    }
    .melody-landing-wrapper .post-title{
        display: '. esc_attr( $landtitl ) .';
        text-align: ' . esc_attr( $aline ) . ';}';
    endif;
    echo '</style>';
}