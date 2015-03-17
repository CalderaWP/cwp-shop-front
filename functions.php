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
	//re-enqueue parent theme style
	wp_deregister_style( 'style' );
	wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );

	wp_enqueue_script( 'cwp_sf_child', get_stylesheet_directory_uri() . "/assets/js/cwp_theme_front_child_theme{$postfix}.js", array(), CWP_SF_CHILD_VERSION, true );
		
	wp_enqueue_style( 'cwp_sf_child', get_stylesheet_directory_uri() . "/assets/css/cwp_theme_front_child_theme{$postfix}.css", array(), CWP_SF_CHILD_VERSION );
 }
 add_action( 'wp_enqueue_scripts', 'cwp_sf_child_scripts_styles', 21 );
 
 /**
  * Add humans.txt to the <head> element.
  */
 function cwp_sf_child_header_meta() {
	$humans = '<link type="text/plain" rel="author" href="' . get_stylesheet_directory_uri() . '/humans.txt" />';
	
	echo apply_filters( 'cwp_sf_child_humans', $humans );
 }
 add_action( 'wp_head', 'cwp_sf_child_header_meta' );

/**
 * EVERYTHING BELOW THIS LINE HAS NO PLACE IN A THEME
 */

include( dirname( __FILE__ ) . '/includes/CWP_Social.php' );

 /**
 * Bio shortcode
 */
add_shortcode( 'cwp_bio', 'cwp_bio_shortcode' );
function cwp_bio_shortcode( $atts, $content = '' ) {
   $atts = shortcode_atts( array(
       'who' => 'david',
   ), $atts, 'cwp_bio' );


   return cwp_bio_box( $atts[ 'who' ], $content );
}

/**
 * Show a bio, with gravatar and social links.
 *
 * @param string $who Whose bio david|josh
 * @param string $bio The actual bio content.
 *
 * @return string|void
 */
function cwp_bio_box( $who, $bio ) {
   $data = CWP_Social::our_data( $who );

   if ( is_array( $data ) ) {
      $name = $data['name'];


      $social_html = CWP_Social::social_html( $data[ 'social' ], $name );

      $out[] = '<div class="about-box">';
      $out[] = sprintf( '<div class="about-left">%1s %2s</div>',
          '<div class="gravatar-box">' . get_avatar( $data['gravatar'] ) . '</div>',
          '<div class="social">' . $social_html . '</div>'
      );
      $out[] = '<div class="about-right"><div class="bio">'.$bio.'</div></div>';
      $out[] = '</div>';
      $out[] = '<div class="clear"></div>';

      $out = implode( '', $out );

      $out = str_replace( 'Pods Framework', '<a href="http://Pods.io" title="Pods -- WordPress Custom Content Types and Fields" target="_blank">Pods Framework</a>', $out );


      return $out;

   }


}

/**
 * Add analytics
 */
add_action( 'wp_head', function(){
	?>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-59323601-1', 'auto');
		ga('send', 'pageview');

	</script>
<?php
});

/**
 * Licensing FAQ Link
 */
 add_filter( 'edd_purchase_download_form', function( $html ) {
	 $url = get_permalink( 1577 );
	 $html .= sprintf( '<div class="license-term-link"><a href="%1s" title="Licensing Terms" target="_blank">Licensing FAQ</a> </div>', esc_url( $url ) );
	 return $html;

 });

/**
 * Remove EDD's microdata on post title in the "After Download" Pods Template
 */
add_filter( 'pods_templates_pre_template',
	function( $code, $template ) {
		if ( isset( $template[ 'name'] ) && 'After Download' == $template[ 'name'] ) {
			remove_filter( 'the_title', 'edd_microdata_title', 10, 2 );
		}

		return $code;

	}, 10, 2
);


/**
 * Disable comments on all post types besides post and hide comment form.
 */
add_action( 'init', function() {
	$post_types = get_post_types( array( 'public' => true ) );
	foreach( $post_types as $post_type ) {
		if ($post_type == 'post' ) {
			continue;
		}

		if ( post_type_supports( $post_type, 'comments' ) ) {
			remove_post_type_support( $post_type, 'comments' );
		}

	}

	add_filter( 'comments_open', function( $open, $post )  {
		if ( 'post' != get_post_type( $post ) ) {
			$open = false;
		}

		return $open;

	},50, 2 );

	add_filter( 'comments_template', function( $template ) {
		global $post;
		if ( 'post' != get_post_type( $post ) ) {
			$template = trailingslashit( get_stylesheet_directory_uri() ) . 'nothing.php';
		}

		return $template;

	}, 50 );
});

/**
 * Add Clarity Discount To Purchase History
 *
 * @todo finish the plugin for this
 */
add_action( 'edd_purchase_history_row_end', function( $post, $purchase_data ) {
	$discounts = array( 578 =>
		array(
			'label' => 'Clarity Launch Discount: 10% off of FacetWP',
			'code' => 'CLARITY',
			'link' => '<a href="https://facetwp.com/?ref=61" title="But FacetWP">Use Your Discount At FacetWP.com</a>',
		)
	);
	if ( isset( $purchase_data[ 'downloads'] ) && is_array( $purchase_data[ 'downloads'] ) ) {

		$downloads = wp_list_pluck( $purchase_data[ 'downloads' ], 'id' );
		foreach( $downloads as $download ) {
			if ( array_key_exists( (int) $download, $discounts ) ) {
				$deal = $discounts[ (int) $download ];
				if ( is_array( $deal ) ) {
					printf( '<tr class="edd_purchase_row"><td>%1s</td><td><pre style="display: inline;  margin-right: 5px;">%2s</pre></td><td>%3s</td></tr>',
						$deal[ 'label' ],
						$deal[ 'code' ],
						$deal[ 'link' ]
					);
					break;
				}
			}

		}

	}
}, 10, 2 );

