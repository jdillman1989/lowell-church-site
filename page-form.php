<?php
// Template Name: Form
get_header();
global $post;
?>

<section id="heading" class="alt">
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
				<?php echo apply_filters('the_content', $post->post_content); ?>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>
