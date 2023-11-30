<?php
/**
 * melody Customizer functionality
 *
 * @package melody
 * @subpackage inc/melody
 * @since 1.0
 * 
 * @see https://developer.wordpress.org/reference/classes/wp_customize_manager/add_setting/
 */

add_action( 'customize_register', 'melody_register_theme_customizer_setup' );

/**
 * Remove parts of the Options menu we don't use.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 * @since 1.0.2
*/

function melody_register_theme_customizer_setup($wp_customize)
{
	$transport = 'refresh'; //'postMessage'; 
    // Theme font choice section
    $wp_customize->add_section( 'colors', array(
        'title'       => __( 'Theme Colors', 'melody' ),
        'capability'  => 'edit_theme_options',
        'priority'    => 25
    ) );
	// Add layout section
    $wp_customize->add_section( 'melody_layout', array(
		'title' => __( 'Blog and Page Settings', 'melody' ),
		'priority' => 26
	  ));

    //----------------- Settings and Controls ------------------
		/* 
	 * ****************** Blog and Page Settings *******************
	 */
	// Add setting & control for 
	$wp_customize->add_setting( 
		'melody_page_width', array(
		'default'    => '1440',
		'capability' => 'edit_theme_options',
		'transport'  => $transport
	));
	$wp_customize->add_control( 'melody_page_width', array(
		'label'   => __( 'Theme Width', 'melody' ),
		'section'  => 'melody_layout',
		'settings'  => 'melody_page_width',
		'type'       => 'number',
        'input_attrs' => array(
            'min' => 300,
            'max' => 9999
        ),
		'description' => __( 'Set number of pixels for width of page. Mobile not effected.', 'melody')
	));
    $wp_customize->add_setting( 'melody_content_align', array(
		'default' => 'justify',
		'capability' => 'edit_theme_options',
		'transport' => 'refresh'
	));
	$wp_customize->add_control( 'melody_content_align', array(
		'label'       => __( 'Text Align Style for Content', 'melody' ),
		'section'     => 'melody_layout',
		'settings'    => 'melody_content_align',
		'description' => __( 'Choose the text alignment for central content.', 'melody'),
		'type'        => 'select',
    	'choices'     => array(
        	'justify' => 'Default/Justify',
        	'left'    => 'Left',
			'right'   => 'Right',
        	'justify' => 'Justify',
			'center'  => 'Center'
    		)
	));

	/* 
	 * ********************** Colors **********************
	 */
	// Sidebars background color
	$wp_customize->add_setting(
		'melody-sides-bkgrnd',
		array(
			'default'         => '#fafafa',
			'capability'       => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'melody-sides-bkgrnd',
			array(
				'label'  => __( 'Sidebars Color', 'melody' ),
				'section' => 'colors',
				'settings' => 'melody-sides-bkgrnd'
			)
		)
	);
	// Main Section color
	$wp_customize->add_setting(
		'melody-content-bkgrnd',
		array(
			'default'         => '#fafafa',
			'capability'       => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'melody-content-bkgrnd',
			array(
				'label'  => __( 'Main Section Background', 'melody' ),
				'section' => 'colors',
				'settings' => 'melody-content-bkgrnd'
			)
		)
	);
	// secondary background color
	$wp_customize->add_setting(
		'melody-second-background',
		array(
			'default'         => '#fafafa',
			'capability'       => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'melody-second-background',
			array(
				'label' => __( 'Header and Footer Background', 'melody' ),
				'section' => 'colors',
				'settings' => 'melody-second-background'
			)
		)
	);

} 