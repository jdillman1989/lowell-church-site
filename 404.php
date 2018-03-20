<?php 
get_header();
$home = get_option('page_on_front');
$hero_image = get_the_post_thumbnail_url($home);
?>

<section id="hero">
	<div class="text">
		<div>
			<h1>404</h1>
			<p>Page Not Found</p>
		</div>
	</div>
	<div class="img" style="background-image: url(<?php echo $hero_image; ?>)"></div>
</section>

<?php get_footer(); ?>