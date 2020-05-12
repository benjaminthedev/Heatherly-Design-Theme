<?php
/**
 * _s Theme Customizer
 *
 * @package _s
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function _s_customize_theme($wp_customize) {

	$wp_customize->add_section(
		'woocommerce_single',
		array(
			'title'    => __( 'Single Product', 'woocommerce' ),
			'priority' => 10,
			'panel'    => 'woocommerce',
		)
	);

	$wp_customize->add_setting("add_to_cart_text", array(
		"default" 	=> "",
		"transport" => "refresh",
	));

	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"add_to_cart_text",
		array(
			"label" 	=> __("Add to Cart Text", "customizer_add_to_cart_text_label"),
			"section" 	=> "woocommerce_single",
			"settings" 	=> "add_to_cart_text",
			"type" 		=> "text",
		)
	));

	$wp_customize->add_section(
		// ID
		'theme_options',
		// Arguments array
		array(
			'title' 		=> __( 'Custom Code', '_s' ),
			'description' 	=> __( 'Add / Update Custom Code', '_s' ),
			'priority' 		=> 30,
		)
	);

	$wp_customize->add_setting("header_scripts", array(
		"default" 	=> "",
		"transport" => "refresh",
	));

	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"header_scripts",
		array(
			"label" 	=> __("Header Scripts", "customizer_header_scripts_label"),
			"section" 	=> "theme_options",
			"settings" 	=> "header_scripts",
			"type" 		=> "textarea",
		)
	));

	$wp_customize->add_setting("footer_scripts", array(
		"default" 	=> "",
		"transport" => "refresh",
	));

	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"footer_scripts",
		array(
			"label" 	=> __("Footer Scripts", "customizer_footer_scripts_label"),
			"section" 	=> "theme_options",
			"settings" 	=> "footer_scripts",
			"type" 		=> "textarea",
		)
	));

	$wp_customize->add_setting("bottom_of_posts_scripts", array(
		"default" 	=> "",
		"transport" => "refresh",
	));

	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"bottom_of_posts_scripts",
		array(
			"label" 	=> __("Bottom of Posts Scripts", "customizer_bottom_of_posts_scripts_label"),
			"section" 	=> "theme_options",
			"settings" 	=> "bottom_of_posts_scripts",
			"type" 		=> "textarea",
		)
	));
}

add_action( 'customize_register', '_s_customize_theme' );

/**
 * Header and Footer scripts
 */
if(get_theme_mod('header_scripts')):
	
	function insert_header_scripts() {
		if ( !is_admin() && !is_feed() && !is_robots() && !is_trackback() ) {
			$text = get_theme_mod( 'header_scripts', '' );
			$text = convert_smilies( $text );
			$text = do_shortcode( $text );

			if ( $text != '' ) {
				echo $text, "\n";
			}
		}
	}
	add_action( 'wp_head', 'insert_header_scripts' );
endif;

if(get_theme_mod('footer_scripts')):
	
	function insert_footer_scripts() {
		if ( !is_admin() && !is_feed() && !is_robots() && !is_trackback() ) {
			$text = get_theme_mod( 'footer_scripts', '' );
			$text = convert_smilies( $text );
			$text = do_shortcode( $text );

			if ( $text != '' ) {
				echo $text, "\n";
			}
		}
	}
	add_action( 'wp_footer', 'insert_footer_scripts' );
endif;

if(get_theme_mod('bottom_of_posts_scripts')):
	
	function insert_bottom_of_posts_scripts() {
		if ( !is_admin() && !is_feed() && !is_robots() && !is_trackback() && is_single() ) {
			$text = get_theme_mod( 'bottom_of_posts_scripts', '' );
			$text = convert_smilies( $text );
			$text = do_shortcode( $text );

			if ( $text != '' ) {
				echo $text, "\n";
			}
		}
	}
	add_action( 'wp_footer', 'insert_bottom_of_posts_scripts' );
endif;