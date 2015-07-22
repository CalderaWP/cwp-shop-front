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



	<div id="container" class="front-container">


		<div class="wrapper" class="front-wrapper">


			<div id="content" class="front-content">


