<?php
/**
 * @package Twenty_Twenty_Four_Zaprite
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '0.0.7' );
}

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
	$parenthandle = 'parent-style'; // This is 'twentytwentyfour-style' for the Twenty Twenty Four theme.
	$theme        = wp_get_theme();
	wp_enqueue_style( $parenthandle,
		get_template_directory_uri() . '/style.css',
		array(),  // If the parent theme code has a dependency, copy it to here.
		$theme->parent()->get( 'Version' )
	);
	wp_enqueue_style( 'child-style',
		get_stylesheet_uri(),
		array( $parenthandle ),
		$theme->get( 'Version' ) // This only works if you have Version defined in the style header.
	);
	wp_enqueue_style( 'woo-styles', 
		get_stylesheet_directory_uri() . '/css/woocommerce.css', 
		array(), 
		_S_VERSION 
	);

}

add_filter('woocommerce_checkout_fields','zaprite_remove_checkout_fields');
function zaprite_remove_checkout_fields($fields){
    unset($fields['billing']['billing_first_name']);
    unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_phone']);
    unset($fields['billing']['billing_company']);
    return $fields;
}