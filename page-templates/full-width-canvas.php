<?php 
/*
Template Name: Full Width - Canvas
*/

get_header(); ?>

<?php do_action( 'shopfront_primary_wrapper_start' ); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'content-canvas', 'page' ); ?>

	<?php comments_template( '', true );  ?>
	
<?php endwhile; // end of the loop. ?>

<?php do_action( 'shopfront_primary_wrapper_end' ); ?>

<?php get_footer(); ?>