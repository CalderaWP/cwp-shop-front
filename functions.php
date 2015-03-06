<?php
/**
 * CWP Theme Front Child Theme functions and definitions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * @package CWP Theme Front Child Theme
 * @since 0.1.0
 */
 
 // Useful global constants
define( 'CWP_SF_CHILD_VERSION', '0.1.0' );
 
 /**
  * Set up theme defaults and register supported WordPress features.
  *
  * @uses load_theme_textdomain() For translation/localization support.
  *
  * @since 0.1.0
  */
 function cwp_sf_child_setup() {
	/**
	 * Makes CWP Theme Front Child Theme available for translation.
	 *
	 * Translations can be added to the /lang directory.
	 * If you're building a theme based on CWP Theme Front Child Theme, use a find and replace
	 * to change 'cwp_sf_child' to the name of your theme in all template files.
	 */
	load_theme_textdomain( 'cwp_sf_child', get_template_directory() . '/languages' );
 }
 add_action( 'after_setup_theme', 'cwp_sf_child_setup' );
 
 /**
  * Enqueue scripts and styles for front-end.
  *
  * @since 0.1.0
  */
 function cwp_sf_child_scripts_styles() {
	$postfix = ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_script( 'cwp_sf_child', get_template_directory_uri() . "/assets/js/cwp_theme_front_child_theme{$postfix}.js", array(), CWP_SF_CHILD_VERSION, true );
		
	wp_enqueue_style( 'cwp_sf_child', get_template_directory_uri() . "/assets/css/cwp_theme_front_child_theme{$postfix}.css", array(), CWP_SF_CHILD_VERSION );
 }
 add_action( 'wp_enqueue_scripts', 'cwp_sf_child_scripts_styles', 21 );
 
 /**
  * Add humans.txt to the <head> element.
  */
 function cwp_sf_child_header_meta() {
	$humans = '<link type="text/plain" rel="author" href="' . get_template_directory_uri() . '/humans.txt" />';
	
	echo apply_filters( 'cwp_sf_child_humans', $humans );
 }
 add_action( 'wp_head', 'cwp_sf_child_header_meta' );
