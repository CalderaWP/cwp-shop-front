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
 * Remove secondary menu on checkout
 */
if ( is_page( 'checkout' ) ) {
	remove_action( 'shopfront_header_wrapper_end', 'shopfront_do_secondary_nav', 15 );
}

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
 * Licensing FAQ Link -> if is not a free download.
 */
 add_filter( 'edd_purchase_download_form', function( $html ) {
	 global $post;
	 if ( is_object( $post ) && ! edd_is_free_download( $post->ID ) ) {
		 $url = get_permalink( 1577 );
		 $html .= sprintf( '<div class="license-term-link"><a href="%1s" title="Licensing Terms" target="_blank">Licensing FAQ</a> </div>', esc_url( $url ) );
	 }
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
 * Pricing experiments!
 */
add_filter( 'edd_get_variable_prices', function( $prices, $download_id ) {

	if ( ! is_admin() ) {
		foreach ( $prices as $i => $price ) {
			$this_price = absint( $price['amount'] );
			if ( 0 < $this_price ) {

				//make 15 site option more expensive
				//but not if is a bundle.
				if ( ! edd_is_bundled_product( $download_id ) && 3 == (int) $i ) {
					$this_price = ( $this_price * 1.2 );
				} else {

					//make all other options $1 less expensive.
					$this_price = (int) $this_price - 1;
				}

				$prices[ $i ]['amount'] = edd_sanitize_amount( $this_price );

			}

		}
	}

	return $prices;
}, 99, 2 );

/**
 * Move social discounts up anmd don't show on free plugins.
 */
add_filter( 'the_content', function( $content ) {

	if ( function_exists( 'edd_social_discounts' ) && is_singular( 'download' )  ) {
		global $post;
		if ( is_object( $post ) && ! edd_is_free_download( $post->ID ) ) {
			$content .= do_shortcode( '[edd_social_discount]');
		}

	}

	return $content;
}, 8 );

/**
 * Cast products Easy Pod order field as a decimal.
 *
 * Workaround for: https://bitbucket.org/calderadev/caldera-easy-pods/issue/20/order-should-cast-as-number-date
 */
add_filter( 'caldera_easy_pods_query_params', function( $params, $pod, $tags, $easy_pod_slug ) {
	if ( 'products' == $easy_pod_slug  ) {
		$params[ 'orderby' ] = 'CAST( order.meta_value AS DECIMAL ) ASC';
	}

	return $params;
}, 10, 4 );

add_filter( 'woothemes_testimonials_post_type_args', function( $args )  {
	$args[ 'public' ] = $args[ 'publicly_queryable' ] = $args[ 'has_archive' ] = false;
	$args [ 'menu_position' ] = 45;
	return $args;
});

/**
 *   Send purchase details to With TrackWP
 */
add_action( 'edd_complete_purchase', function( $payment_id ) {

	if ( class_exists( 'trackWP' ) ) {
		$user = edd_get_payment_meta_user_info( $payment_id );
		$user_id  = edd_get_payment_user_id( $payment_id );

		$traits = array(
			'userId'    => is_user_logged_in() ? $user_id : session_id(),
			'firstName' => $user[ 'first_name' ],
			'lastName'  => $user[ 'last_name' ],
			'email'     => $user[ 'email' ],
		);

		$downloads = edd_get_payment_meta_cart_details( $payment_id );
		$products  = array();

		foreach ( $downloads as $download ) {
			$products[] = array(
				'title' => get_the_title( $download[ 'id' ] ),
				'id' => $download[ 'id' ]
			);
		}

		$props = array(
			'orderID' => edd_get_payment_transaction_id( $payment_id ),
			'total'    => edd_get_payment_amount( $payment_id ),
			'time'     => strtotime( edd_get_payment_completed_date( $payment_id ) ),
			'products' => $products
		);

		trackWP::track_event( 'Completed Order', $props, $traits, $user_id );
	}

});

/**
 * Add support for Aesop features
 */
add_action( 'after_setup_theme', function() {
	add_theme_support("aesop-component-styles", array("parallax", "image", "quote", "gallery", "content", "video", "audio", "collection", "chapter", "document", "character", "map", "timeline" ) );

}, 50 );

/**
 * Drip code
 */
 add_action( 'wp_footer', function() {
	?>
<!-- Drip -->
<script type="text/javascript">
	var _dcq = _dcq || [];
	var _dcs = _dcs || {};
	_dcs.account = '4342573';

	(function() {
		var dc = document.createElement('script');
		dc.type = 'text/javascript'; dc.async = true;
		dc.src = '//tag.getdrip.com/4342573.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(dc, s);
	})();
</script><?php
 });
