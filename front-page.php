<?php
get_header();
global $post;
$meta = get_post_meta($post->ID);
$hero_image = get_the_post_thumbnail_url($post->ID);
?>

<section id="hero">
	<div class="text">
		<div>
			<h1><?php echo $meta['hero_title'][0]; ?></h1>
			<?php echo apply_filters('the_content', $meta['hero_content'][0]); ?>
			<a class="text-btn tan" href="<?php echo $meta['hero_link'][0]; ?>"><?php echo $meta['hero_label'][0]; ?></a>
		</div>
	</div>
	<div class="img" style="background-image: url(<?php echo $hero_image; ?>)"></div>
</section>

<main id="site-main" class="map">
	<div class="text-center">
		<?php echo apply_filters('the_content', $post->post_content); ?>
		<div class="state-grid">
			<?php
			$state_args = array(
				'post_type' => 'state',
				'posts_per_page' => -1,
			);
			$states = get_posts($state_args);
			foreach ($states as $state) {
				$permalink = get_permalink($state->ID);
			?>

			<a class="state burnt <?php echo $state->post_name; ?>" href="<?php echo $permalink; ?>">
				<figure>
					<figcaption><?php echo $state->post_title; ?></figcaption>
				</figure>
			</a>

			<?php
			}
			?>
		</div>
	</div>
</main>

<section id="cta-banner">
	<div class="content">
		<?php echo apply_filters('the_content', $meta['cta_content'][0]); ?>
		<a class="text-btn tan" href="<?php echo $meta['cta_link'][0]; ?>"><?php echo $meta['cta_label'][0]; ?></a>
	</div>
</section>

<?php get_footer(); ?>