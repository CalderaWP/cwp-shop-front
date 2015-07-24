<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6 legacy-ie"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 legacy-ie"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8 legacy-ie"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php wp_title( '|', true, 'right' ); ?></title>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
	
<?php do_action( 'shopfront_body_start' ); ?>

<?php do_action( 'shopfront_site_before' ); ?>

<div id="site" class="hfeed">

<?php do_action( 'shopfront_site_start' ); ?>

	<?php do_action( 'shopfront_header_before' ); ?>

	<header id="masthead" role="banner" class="front-header">

		<?php do_action( 'shopfront_header_start' ); ?>

		<div class="wrapper">

			<?php do_action( 'shopfront_header_wrapper_start' ); ?>

			<?php
			    echo shopfront_do_nav();
				$tagline = get_bloginfo( 'description' );

				$output = '
				<hgroup>
					<h1 id="site-title" class="site-title-front">
						<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) .'" rel="home">'. get_bloginfo( 'name' ) . '</a>
					</h1>
					<h2 id="site-description">' . get_bloginfo( 'description' ) .'</h2>
				</hgroup>
				';

				echo  $output;
				?>

				<?php do_action( 'shopfront_header_site_title_end' ); ?>



		</div>


	</header>

	<?php do_action( 'shopfront_header_after' ); ?>


<?php do_action( 'shopfront_container_before' ); ?>

	<div id="container" class="front-container">
	<?php do_action( 'shopfront_container_start' ); ?>

		<div class="wrapper" class="front-wrapper">
		<?php do_action( 'shopfront_container_wrapper_start' ); ?>

		<?php do_action( 'shopfront_content_before' ); ?>

			<div id="content" class="front-content">

			<?php do_action( 'shopfront_content_start' ); ?>
