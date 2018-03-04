<footer id="site-footer">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-sm-6 col-md-8">
						<span class="logo" title="American Liberty Insurance"></span>
						<p>Follow us!</p>
						<div class="social">
							<?php
							$nav_social = wp_get_nav_menu_items('Social');
							foreach ($nav_social as $item) {
								echo '<a href="'.$item->url.'" title="'.$item->title.'"></a>';
							}
							?>
						</div>
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="links">
							<?php
							$nav_footer = wp_get_nav_menu_items('Footer');
							foreach ($nav_footer as $item) {
								echo '<a href="'.$item->url.'">'.$item->title.'</a>';
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-5 col-md-offset-1">
				<div class="row">
					<div class="col-sm-6 col-md-5">
						<p><strong>File a Claim:</strong></p>
						<div class="links">
							<?php
							$state_args = array(
								'post_type' => 'state',
								'posts_per_page' => -1,
							);
							$states = get_posts($state_args);
							foreach ($states as $state) {
								$permalink = get_permalink($state->ID);
								echo '<a href="'.$permalink.'">'.$state->post_title.'</a>';
							}
							?>
						</div>
					</div>
					<div class="col-sm-6 col-md-7">
						<address>
							<strong><?php bloginfo('name'); ?></strong><br>
							<?php echo get_theme_mod('address_1'); ?><br>
							<?php echo get_theme_mod('address_2'); ?><br>
							<?php echo get_theme_mod('address_3'); ?><br>
							<?php echo get_theme_mod('phone'); ?>
						</address>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="copyright">
		<div class="container">
			Copyright &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>, LLC
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>