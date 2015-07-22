<?php
/**
 * The template for displaying the front page
 */

get_header( 'front' ); ?>
	<section id="primary">
		<div class="wrapper">
			<?php do_action( 'shopfront_primary_wrapper_start' ); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

					<?php comments_template( '', true );  ?>

			<?php endwhile; // end of the loop. ?>

			<?php do_action( 'shopfront_primary_wrapper_end' ); ?>

		</div>
	</section>


<?php get_footer( 'front'); ?>
