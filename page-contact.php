<?php
// Template Name: Contact
get_header();
global $post;
$meta = get_post_meta($post->ID);
$content = get_the_content($post->ID);
$directions_image = wp_get_attachment_image_src($meta['directions_image'][0], 'full');
?>

<section id="heading">
	<div class="text">
		<div class="container">
			<h1><?php echo $post->post_title; ?></h1>
		</div>
	</div>
</section>

<main id="site-main">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="row">
					<div class="col-sm-7 col-sm-offset-1 pull-right">
						<?php echo apply_filters('the_content', $post->post_content); ?>
					</div>
					<aside class="col-sm-4">
						<h2>Our Office</h2>
						<address>
							<?php echo get_theme_mod('address_1'); ?><br>
							<?php echo get_theme_mod('address_2'); ?><br>
							<?php echo get_theme_mod('address_3'); ?>
						</address>
						<a href="<?php echo get_template_directory_uri(); ?>/images/american-liberty-map.pdf">
							<img src="<?php echo $directions_image[0]; ?>" alt="Map/directions">
						</a>
						<br>
						<a href="<?php echo get_template_directory_uri(); ?>/images/american-liberty-map.pdf"><?php echo $meta['directions_label'][0]; ?></a>
						<h2>Call Us</h2>
						<p>Phone: <?php echo get_theme_mod('phone'); ?></p>
					</aside>
				</div>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>
