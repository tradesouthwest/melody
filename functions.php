<?php
/**
 * Melody functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package melody
 * @since 1.0.1
 */
if ( !defined ( 'MELODY_THEME_VER' ) ) { define ( 'MELODY_THEME_VER', time() ); }
// FAST LOADER References ( find @#id in DocBlocks )
// ------------------------- Actions ---------------------------
// ID#
// A1
add_action( 'after_setup_theme',     'melody_theme_setup' );
// A2
add_action( 'after_setup_theme',     'melody_theme_content_width', 0 );
// A3
add_action( 'widgets_init',          'melody_theme_widgets_init' );
// A4
add_action( 'wp_enqueue_scripts',    'melody_theme_enqueue_styles' );
// A5
add_action( 'wp_head',               'melody_theme_customizer_css');
// A6 
add_action( 'melody_excerpt_blank',  'melody_excerpt_blank_logo' );
// A7
add_action( 'melody_blog_date',      'melody_blog_date_and_comment_count' );
// A8
add_action( 'inner_article_excerpt', 'melody_inner_article_excerpt' );


// ------------------------- Filters ---------------------------
// ID#
// F1
add_filter('nav_menu_link_attributes', 'melody_add_class_on_a_tag', 1, 3);

/** #A1
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own melody_setup() function to override in a child theme.
 *
 * @since Melody 1.0
 */

/**
 * Proper ob_end_flush() for all levels
 *
 * This replaces the WordPress `wp_ob_end_flush_all()` function
 * with a replacement that doesn't cause PHP notices.
 */
if (defined('WP_DEBUG') && true === WP_DEBUG) :
    remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
    add_action( 'shutdown', function() {
    	while ( @ob_end_flush() );
    } );
endif;

/**
 * Add backwards compatibility support for wp_body_open function.
 */
if ( ! function_exists( 'wp_body_open' ) ) {
    
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/** #A1
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own melody_theme_setup() function to override in a child theme.
 *
 * @since Melody 1.0
 */
if ( ! function_exists( 'melody_theme_setup' ) ) :

	function melody_theme_setup()
	{
		/*
		* Make theme available for translation.
		* Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentysixteen
		* If you're building a theme based on melody, use a find and replace
		* to change 'melody' to the name of your theme in all the template files
		*/
		load_theme_textdomain( 'melody', get_template_directory_uri() . '/languages' );

        /*
		 * Let ClassicPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails', array( 'post', 'page') );
		// register new phone-landscape featured image size. @width, @height, and @crop
		add_image_size( 'melody-featured', 320, 300, false);  
		add_image_size( 'melody-excerpt', 150, 150, true);   
		add_post_type_support( 'page', 'excerpt' );
		add_theme_support( 'custom-background', 
			array( 
		   'default-color'      => '#fcfcfc',
		   'default-image'       => '',
		   'wp-head-callback'     => '_custom_background_cb',
		   'admin-head-callback'   => '',
		   'admin-preview-callback' => ''
		) );
		add_theme_support( 'custom-logo' );

        // This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary-menu' => __( 'Primary Main Menu', 'melody' ),
			)
		);
	}
endif;

/** #A2
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Melody 1.0
 */
function melody_theme_content_width()
{
	$GLOBALS['content_width'] = apply_filters( 'melody_content_width', 640 );
}

/**
 * Get an attachment ID given a URL.
 * 
 * @param string $url
 *
 * @return int Attachment ID on success, 0 on failure
 */
function melody_get_attachment_id( $atturl ) {

	global $wpdb;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
        return $attachment[0]; 
}

/** #F1
 * Add class name to anchor links
 * 
 * @param string $classes WP argument key
 * @since 1.0.1
 * @return additional arguments to wp_nav_menu
 */
function melody_add_class_on_a_tag($classes, $item, $args)
{
    if (isset($args->add_a_class)) {
        $classes['class'] = $args->add_a_class;
    }
		return $classes;
}

/** #A3
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Melody 1.0
 */
function melody_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar Right', 'melody' ),
			'id'            => 'sidebar-primary',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'fastbreak' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Sidebar Left', 'melody' ),
			'id'            => 'sidebar-sidenav',
			'description'   => __( 'Add widgets here to show below navigation.', 'melody' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Header Widget', 'melody' ),
			'id'            => 'sidebar-header',
			'description'   => __( 'Add widgets to show in header. Search bar is default.', 'melody' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => __( 'Landing Page', 'melody' ),
			'id'            => 'sidebar-landing',
			'description'   => __( 'Add widgets to show in bottom of landing page.', 'melody' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
} 

/**
 * Add files and theme registry for widgets
 */
require get_template_directory() . '/inc/class-melody-twowide-widget.php';
require get_template_directory() . '/inc/class-melody-threewide-widget.php';

/**
 * Adding files here to apply to the following functions below 
 *
 * @since 1.0.0
 */
require get_template_directory() . '/inc/melody-customizer.php';
require get_template_directory() . '/inc/melody-theme-mods.php';

/** #A4
 * Enqueues scripts and styles.
 *
 * @since Melody 1.0
 * @return function enqueue to head or footer
 */
function melody_theme_enqueue_styles()
{
	wp_enqueue_style( 
        'melody', get_stylesheet_uri(), array(), MELODY_THEME_VER
    );

	wp_enqueue_script(
		'melody-theme',
		get_template_directory_uri() . '/rels/melody-frontend.js',
		array(),
		MELODY_THEME_VER,
		true
	); 

	//$styles = do_action('melody_theme_customizer');
	wp_register_style( 'melody-theme-mods', false );
	wp_enqueue_style( 'melody-theme-mods',
		get_template_directory_uri() .'/inc/melody-entry-set.css',
		array(),
		MELODY_THEME_VER,
		false
	);
	if ( function_exists( 'melody_theme_customizer_css' ) ) {
		wp_add_inline_style( 'melody-theme-mods', 
							do_action( 'melody_theme_customizer' ) );
	} else {
		remove_action( 'melody_theme_customizer' );
	}

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script(
			'comment-reply'
		);
    }
}
/** #A6
 * Render logo to empty thumbnail container
 * 
 * @param string $logo_id id of logo
 * @param string $logo    src of logo
 * @since 1.0.1 
 * @return HTML
 */
function melody_excerpt_blank_logo(){
	$output = ''; 

	if ( function_exists( 'the_custom_logo' ) ) {
		$logo_id = get_theme_mod( 'custom_logo' );
		$logo    = wp_get_attachment_image_src( $logo_id , 'thumbnail' );
		if ( has_custom_logo() ) {
			$output = '<img src="'. esc_url( $logo[0] ) .'" 
			alt="'. esc_attr( esc_url( get_permalink() ) ) .'" />'; 
		} else {
			$output = '';
		}
	}
	ob_start();
	?>
	<figure class="home-excerpt-thumb">
	<?php echo wp_kses_post( force_balance_tags( $output ) ); ?>
	</figure>
	<?php 
	
		echo ob_get_clean();
}
/** #A7
 * Action to output date and comment count to blog excerpt
 * 
 * @param function get_the_date()
 * @since 1.0.1
 * @return HTML
 */
function melody_blog_date_and_comment_count(){
	ob_start();
	?>
	<em><span class="bfi-date">
	<?php 
	echo esc_html( get_the_date() ); 
	?></span><span class="mldy-sep"></span>
	<em class="melody-excerpt-commcount">
	<?php 
    if ( comments_open() || get_comments_number() ) {
        printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 
        'comments title', 'melody' ), number_format_i18n( get_comments_number() ) );
    } ?>
	</em>
	
	<?php 
		$out = ob_get_clean();
		echo wp_kses_post( force_balance_tags( $out ) );
}

/** #A8
 * Action to output excerpt to blog page.
 * 
 * @param string $enumb   Theme_mod sets length of excerpt
 * @param string $excerpt Excerpt
 * @since 1.0.1
 * @return HTML
 */
function melody_inner_article_excerpt(){

 	$enumb = get_theme_mod( 'melody_excerpt_length', 50 );
 	$excerpt = wp_trim_words( get_the_content(), 
			absint( $enumb ), '' );

 	echo $excerpt . ' ' . '<a href="'.get_the_permalink().'">' 
 		. esc_html__('Read link', 'melody' ) . '</a>';
}

/**
 * Support for logo upload, output. 
 *
 * @param string $custom_logo_id id of logo
 * @param string $logo           src of logo
 * 
 * @since 1.0.1 
 * @return HTML
 */
function melody_theme_custom_logo() {
    $output = '';

    if ( function_exists( 'the_custom_logo' ) ) {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $logo           = wp_get_attachment_image_src( $custom_logo_id , 'full' );

        if ( has_custom_logo() ) {
            $output = '<div class="header-logo"><img src="'. esc_url( $logo[0] ) .'" 
            alt="'. get_bloginfo( 'name' ) .'"></div>'; 
        } else { 
            $output = ''; 
        }
    }
        // Output sanitized in header to assure all html displays.
        return $output; //phpcs ignore:EscapeOutput
} 
