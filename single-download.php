<?php
/**
 * Single download pages
 */
	
get_header(); ?>

<?php do_action( 'shopfront_single_download_start' ); ?>
<?php
/**		
 * Secondary Sidebar
*/
if ( !is_page_template( 'page-templates/fullwidth.php' ) )
	get_sidebar( 'download' );
?>
<section id="primary" class="primary-right">

	<?php do_action( 'shopfront_single_download_primary_start' ); ?>	

	<?php do_action( 'shopfront_single_download_content_before' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php
			$content = apply_filters( 'the_content', get_the_content() );
			echo substr( $content, 0, strpos( $content, '<span id="more-' . get_the_id() . '"></span>') );
		?>

		<?php do_action( 'shopfront_single_download_content_after' ); ?>

		<?php comments_template( '', true );  ?>

	<?php endwhile; // end of the loop. ?>

	<?php do_action( 'shopfront_single_download_primary_end' ); ?>

</section>

<?php while ( have_posts() ) : the_post(); ?>
	
	<?php get_template_part( 'content', 'download' ); ?>

	<?php do_action( 'shopfront_single_download_content_after' ); ?>

	<?php comments_template( '', true );  ?>

<?php endwhile; // end of the loop. ?>

<?php do_action( 'shopfront_single_download_end' ); ?>



<?php get_footer(); ?>