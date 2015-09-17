<?php
/**
 * The template for displaying the front page
 */

get_header( 'front' ); ?>
	<section id="primary">
		<div class="wrapper">
			<?php do_action( 'shopfront_primary_wrapper_start' ); ?>
				<div id="front-page-top">

				<h2>We make using WordPress easier</h2>
				<h3>Our plugins help you create an excellent user experience on your WordPress website from the inside out </h3>

				<p>Are you a developer? A business owner? Or the designated website admin?</p>
				<p class="extra-bottom-padding">Whichever you are, CalderaWP is here to help.</p>


				<p class="extra-bottom-padding">With our plugins you’ll:</p>

			</div>
			<div id="front-page-plugins">
				<div class="front-third front-third-first">
					<img class="aligncenter size-medium" src="https://calderawp.com/wp-content/uploads/2015/04/cf-banner-300x110.png" alt="Caldera Forms Banner" width="300" height="110" scale="0">
					<p>Create better, smarter, more attractive forms, easily. Instantly.</p>

					<p><a class="button" href="#">Caldera Forms</a></p>
				</div>
				<div class="front-third">
					<img class="aligncenter size-medium" src="https://calderawp.com/wp-content/uploads/edd/2015/06/easy-queries.png" alt="Easy Queries Banner" width="300" height="110" scale="0">
					<p>Build your WordPress database queries visually <em>without</em> getting your hands dirty in code
					</p>
					<p><a class="button href="#">Easy Queries</a></p>
				</div>
				<div class="front-third front-third-last">
					<img class="aligncenter size-medium" src="https://calderawp.com/wp-content/uploads/2015/03/url-builder-banner-300x110.png" alt="URL Builder Banner" width="300" height="110" scale="0">
					<p>Visually build your URL structures for pretty permalinks that are SEO-friendly.
					</p>

					<p><a class="button href="#">URL Builder</a></p>
				</div>
				<div class="clear"></div>

				<h3>And we’re only just getting started!</h3>
			</div>

			<div id="front-page-cf">
				<h2>Caldera Forms</h2>
				<img src="https://calderawp.com/wp-content/uploads/2015/07/caldera-forms-banner-alt-title.png" alt="Caldera Forms: A different kind of WordPress form builder">
				<h3>Caldera Forms makes form building so easy, it’s <em>fun</em>!</h3>
				<p>Create smart, detailed forms quickly and easily with our FREE Caldera Forms plugin. With an intuitive drag and drop interface, it's never been easier to create forms for your WordPress site that look awesome on <em>any</em> device.
				</p>
				<div class="front-half">
					<strong><a class="button" href="#">Find out more</a></strong>
				</div>
				<div class="front-half front-half-last">
					<strong><a class="button" href="#">Download now</a></strong>
				</div>
				<div class="clear"></div>

				<h5>Make Caldera Forms even more powerful with our <a href="#">premium extensions!</a></h5>
			</div>

			<div id="front-page-who-are-we">
				<h2>Who We Are</h2>
				<div class="front-half">
					<div><?php echo get_avatar( 'david@digilab.co.za'); ?></div>
					<strong><a href="#">David Cramer</a></strong>
					<p>Lead Developer</p>
				</div>
				<div class="front-half front-half-last">
					<div><?php echo get_avatar( 'Josh@JoshPress.net'); ?></div>
					<strong><a href="#">Josh Pollock</a></strong>
					<p>What Ever David Doesn't Do</p>
				</div>
				<div class="clear"></div>

				<p><a href="#">Get to know us here</a>
			</div>



			<?php do_action( 'shopfront_primary_wrapper_end' ); ?>

			</div>

	</section>


<?php get_footer( 'front'); ?>
