<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php wp_title() ?></title>
	
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" type="image/x-icon">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="stylesheet" href="https://use.typekit.net/kif0skq.css">

	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<script type="text/javascript">
	document.createElement('header');
	document.createElement('nav');
	document.createElement('aside');
	document.createElement('article');
	document.createElement('section');
	document.createElement('footer');
	</script>
	<![endif]-->

	<?php wp_head(); ?>
</head>
<body>
<?php
$nav_main = wp_get_nav_menu_items('Main');
$state_archive = query_posts(array(
	'post_type' => 'page',
	'meta_key' => '_wp_page_template',
	'meta_value' => 'page-archive.php'
));

$state_archive_url = get_page_link($state_archive[0]->ID);
$site = get_site_url();
?>
<header id="site-header">
	<div class="container">
		<button class="skip" tabindex="0">Skip to main content</button>

		<a class="logo" href="<?php echo $site; ?>" title="<?php bloginfo('name'); ?>"></a>

		<button class="btn navbar-toggle" type="button" data-toggle="collapse" data-target="#primary-nav">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>

		<nav id="primary-nav" class="navbar-collapse collapse">     
			<ul>
				<?php
				foreach ($nav_main as $item) {
					echo '<li><a href="'.$item->url.'">'.$item->title.'</a></li>';
				}
				?>
				<li class="highlighted"><a href="<?php echo $state_archive_url; ?>">File A Claim</a></li>
				<li class="login"><a href="<?php echo wp_login_url(); ?> ">Login</a></li>
			</ul>
		</nav>
	</div>
</header>
