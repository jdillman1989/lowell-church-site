<?php
// Template Name: State Archive
get_header();
global $post;
?>
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

<?php get_footer(); ?>