<?php
// Template Name: About
get_header();
global $post;
$image = get_the_post_thumbnail_url($post->ID);
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
			<div class="col-sm-8 pull-right">
				<?php echo apply_filters('the_content', $post->post_content); ?>
			</div>
			<aside class="col-sm-4">
				<img src="<?php echo $image; ?>">
			</aside>
		</div>
	</div>
</main>

<?php get_footer(); ?>
