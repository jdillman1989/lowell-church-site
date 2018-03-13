<?php get_header(); ?>

<main id="main" class="container">
  <div class="col-lg-10 col-lg-offset-1">
    <h1 class="h1"><?php the_title(); ?></h1>
  	<div class="row">
		  <div class="col-sm-7">
				<?php
					if ( have_posts() ) :
						while ( have_posts() ) : the_post();
							the_content();
						endwhile;
					endif;
				?>
		  </div>

		  <div class="col-sm-5 col-md-4 col-md-offset-1 centered">
		    <div class="contact-info-small">
		      <p class="contact-number">1-800-289-4502</p>
		      <p class="contact-title">Injured Workers Hotline</p>
		      <p class="contact-footnote">Available <abbr title="24 hours a day, 7 days a week">24/7</abbr></p>
		    </div>
		  </div>
		</div>
	</div>
</main><!-- END #main.container -->
<?php get_footer(); ?>
