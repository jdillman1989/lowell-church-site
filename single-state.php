<?php
get_header();
global $post;
$meta = get_post_meta($post->ID);
?>
<section id="heading" class="alt">
	<div class="text">
		<div class="container">
			<h1><?php echo $post->post_title; ?></h1>
		</div>
	</div>
</section>

<section id="message">
	<div class="alt-bg">
		<div class="container">
			<div class="content">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<?php echo apply_filters('the_content', $post->post_content); ?>
						<div class="text-center">
							<a class="text-btn wide" href="<?php echo $meta['state_form'][0]; ?>">Fill Form</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<main id="site-main">
	<div class="container">
		<h2>Medical Provider Network</h2>
		<div class="grid">

			<?php
			$provider_args = array(
				'post_type' => 'provider',
				'posts_per_page' => -1,
				'meta_query' => array(
					array(
						'key' => 'state',
						'value' => $post->ID,
						'compare' => '=',
					)
				)
			);
			$providers = get_posts($provider_args);
			foreach ($providers as $provider) {
				$provider_meta = get_post_meta($provider->ID);
			?>

			<div class="item network">
				<h3><?php echo $provider_meta['location'][0]; ?></h3>
				<div>
					<p><strong><?php echo $provider->post_title; ?></strong><br>
					<?php echo $provider_meta['address_line_1'][0]; ?><br>
					<?php echo $provider_meta['address_line_2'][0]; ?></p>
					<p><?php echo $provider_meta['phone_1'][0]; ?><br>
					<?php echo $provider_meta['phone_2'][0]; ?></p>
				</div>
			</div>

			<?php
			}
			?>
		</div>
	</div>
</main>
<?php get_footer(); ?>
