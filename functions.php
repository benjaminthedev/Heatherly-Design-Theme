<?php
	
	/* Styles
	=============================================================== */
	
	function nm_child_theme_styles() {
		 // Enqueue child theme styles
		 wp_enqueue_style( 'nm-child-theme', get_stylesheet_directory_uri() . '/style.css' );
	}
	add_action( 'wp_enqueue_scripts', 'nm_child_theme_styles', 1000 ); // Note: Use priority "1000" to include the stylesheet after the parent theme stylesheets

	/* Thumbnails
	=============================================================== */

	add_image_size( 'square-thumb', 760, 760, true ); // Hard Crop Mode

	/* Shortcodes
	=============================================================== */
	require_once( get_stylesheet_directory() . '/inc/shortcodes.php');

	/* Woocommerce Customization
	=============================================================== */
	require_once( get_stylesheet_directory() . '/inc/woocommerce.php');

	/**
 * _savoy functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _savoy
 */

if ( ! function_exists( '_savoy_child_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function _savoy_child_setup() {
		/**
		 * Gutenberg
		 */
		add_theme_support( 'align-wide' );

		add_theme_support( 
			'editor-color-palette', array(
				array('name' => 'Light', 'color' => '#f5f5f1'),
				array('name' => 'Grey', 'color' => '#bfbfbf'),
				array('name' => 'Beige', 'color' => '#d8c1b9'),
				array('name' => 'White', 'color' => '#fff'),
				array('name' => 'Charcoal', 'color' => '#525053')
			)
		);
		
		add_theme_support( 'editor-styles');
		add_editor_style( 'style-editor.css' );

	}
endif;
add_action( 'after_setup_theme', '_savoy_child_setup' );

/**
 * Enqueue Gutenberg editor styles
 */
// function _savoy_child_editor_styles() {
// 	wp_enqueue_style( 'savoy-child-blocks-style', get_stylesheet_directory_uri() . '/editor.css');
// }
// add_action( 'enqueue_block_editor_assets', '_savoy_child_editor_styles' );

/**
 * Enqueue custom scripts
 */
function _savoy_child_scripts() {
	wp_enqueue_script( '_savoy-client', get_stylesheet_directory_uri().'/client.js', false, false, true);
}
add_action( 'wp_enqueue_scripts', '_savoy_child_scripts' );

/**
 * Customzer Options
 */
require_once( get_stylesheet_directory() . '/inc/customizer.php');

/*
* Disable TGM Plugin Activation Notices
*/
 
add_filter('get_user_metadata', function($val, $object_id, $meta_key, $single)
{
    if($meta_key === 'tgmpa_dismissed_notice_nm-framework-admin')
        return true;
    else
        return null;
 
}, 10, 4);

/**
 * Disable menu items
 */
function savoy_child_menu_page_removing() {
	remove_menu_page( 'atomic-blocks' );
}
add_action( 'admin_menu', 'savoy_child_menu_page_removing' );

add_filter( 'woocommerce_product_tabs', 'my_Measurements_tab' );

function my_Measurements_tab( $tabs ) {
   
    $tabs['Measurements'] = array(
        'title'     => __( 'Measurements', 'child-theme' ),
        'priority'  => 50,
        'callback'  => 'my_Measurements_tab_callback'
    );
        return $tabs;
}

function my_Measurements_tab_callback() {
	 /*$measurement_text= get_field('measurement_text');
     echo $measurement_text;*/
    $terms = wp_get_post_terms( get_the_ID(), 'product_cat');
    foreach($terms as $key=> $value){
    	echo get_term_meta($value->term_id,'measurement_text',true);
	}
    //echo get_term_meta($terms[0]->parent,'measurement_text',true);

}

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

add_filter( 'woocommerce_package_rates', 'calculate_shipping', 10, 2 );

function calculate_shipping( $rates, $package ) {
    $postal_code = $package[ 'destination' ][ 'postcode' ];
	$bedhead_count = 0;
	$in_zone = 1;
	$wingback_product_exist = false;
	$bed_class_exists = false;
	
	//Remove the local pickup shipping method
	unset($rates['local_pickup:4']);
	
	foreach( $package['contents'] as $item ){
		//Count bedheads product
		if( $item['data']->get_shipping_class_id() == 515 ) {
			$bedhead_count += $item['quantity'];
		}

		//Check if Wingback Bedhead product is on cart
		if(!$wingback_product_exist) {
			if ( has_term( 'wingback', 'product_cat', $item['data']->get_id() ) ) {
				$wingback_product_exist = true;
			}
		}
		
		//Check if Bed product is on cart
		if( $item['data']->get_shipping_class_id() == 518 ) {
			$bed_class_exists = true;	
		}

	}
	
	if( $bed_class_exists ) {
		unset($rates['flat_rate:2']);
		
		if(($postal_code >= 1100 && $postal_code <= 1299) || ($postal_code >= 2000 && $postal_code <= 2234)) { //If Sydney
			unset($rates['free_shipping:1']);
			unset($rates['flat_rate:10']);
		} else if(($postal_code >= 3000 && $postal_code <= 3207) || ($postal_code >= 8000 && $postal_code <= 8399)) { //If Melbourne
			unset($rates['free_shipping:1']);
			unset($rates['flat_rate:9']);
		} else {
			unset($rates['flat_rate:9']);
			unset($rates['flat_rate:10']);
		}
		
	} else {
		
		//Unset Sydney and Melbourne Gas Lift Bed flat rates
		unset($rates['flat_rate:9']);
		unset($rates['flat_rate:10']);
		
		//If the postal code is under the Sydney, Melbourne Metro area
		if(($postal_code >= 1100 && $postal_code <= 1299) || ($postal_code >= 2000 && $postal_code <= 2234) || ($postal_code >= 3000 && $postal_code <= 3207) || ($postal_code >= 8000 && $postal_code <= 8399)) {
			$in_zone = 1; //Set to true
		} else {
			$in_zone = 0; //If it is not, set to false
		}

		//If the customer shipping address is not under Metro area
		if(!$in_zone) {
			//If we found a bedhead or wingback product, disable the flat rate
			if($bedhead_count > 0 || $wingback_product_exist) {
				unset($rates['flat_rate:2']);
			} else { // If we dont find a bedhead product, we disable the 'We will contact you' shipping method
				unset($rates['free_shipping:1']);
			}
		} else { // If the customer shipping address is under Metro area
			if($bedhead_count > 1 || $wingback_product_exist) { // If the cart have bedhead or wingback product, we disable the Flat Rate shipping method
				unset($rates['flat_rate:2']);
			} else {
				unset($rates['free_shipping:1']);
			}
		}
		
	}

	return $rates;
}

// Remove Empty Tabs
// add_filter( 'woocommerce_product_tabs', 'yikes_woo_remove_empty_tabs', 20, 1 );

// function yikes_woo_remove_empty_tabs( $tabs ) {

// 	if ( ! empty( $tabs ) ) {
// 		foreach ( $tabs as $title => $tab ) {
// 			if ( empty( $tab['Measurements'] ) ) {
// 				unset( $tabs[ $title ] );
// 			}
// 		}
// 	}
// 	return $tabs;
// }