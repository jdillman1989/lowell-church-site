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

	<style>
		/* Form Layouts */
		.gform_wrapper .gform_body ul.gform_fields{
			display: flex;
			flex-wrap: wrap;
			justify-content: space-between;
		}

		.gform_wrapper .gform_body ul.gform_fields li.gfield{
			display: block;
			width: 100%;
		}

		.gform_wrapper .gform_body ul.gform_fields li.gfield input::-webkit-input-placeholder{
			color: #000;
		}

		.gform_wrapper .gform_body ul.gform_fields li.gfield input::-moz-placeholder{
			color: #000;
		}

		.gform_wrapper .gform_body ul.gform_fields li.gfield input:-ms-input-placeholder{
			color: #000;
		}

		.gform_wrapper .gform_body ul.gform_fields li.gfield.form-field-half{
			width: 49%;
		}
	
		.submit-right .gform_footer{
			text-align: right;
		}
	
		.gform_wrapper .gform_body h3{
			margin-bottom: 0px;
		}

		.gform_wrapper .gform_page_footer{
			position: relative;
			border-top: 1px solid #4c5360;
			padding: 50px 0 0;
		}
		
		.gform_wrapper div.gform_page .gform_page_footer input.button{
			position: absolute;
			bottom: 0;
			margin-top: 20px;
			padding: 5px 25px;
			background-color: #4c5360;
			border: none;
			-moz-transition: all .5s;
			-webkit-transition: all .5s;
			transition: all .5s;
			font-size: 16px;
			text-decoration: none;
			color: #fff;
			text-align: center;
			min-width: 140px;
			margin: 0;
		}

		.gform_wrapper div.gform_page .gform_page_footer input.button:hover{
			background-color: #d03a2b;
		}

		.gform_wrapper div.gform_page .gform_page_footer input.gform_next_button, .gform_wrapper .gform_page_footer input[type='submit']{
			right: 0;
		}

		.gform_wrapper div.gform_page .gform_page_footer input.gform_previous_button{
			left: 0;
		}

		/* Select styles */
		.gform_wrapper .gform_body ul.gform_fields li.gfield .ginput_container_select .gfield_select{
			width: 130%;
			height: 32px;
			padding-right: 5px;
			padding-left: 5px;
			background: 0 0;
			border: none;
			-moz-appearance: none;
			-webkit-appearance: none;
			appearance: none;
			font-size: 16px;
			color: #322c28;
		}

		.gform_wrapper .gform_body ul.gform_fields li.gfield .ginput_container_select:after{
			content: '';
			position: absolute;
			top: 13px;
			right: 13px;
			border-width: 5px;
			border-style: solid;
			border-color: transparent;
			border-top-color: #f0decb;
			z-index: -1;
		}

		.gform_wrapper .gform_body ul.gform_fields li.gfield .ginput_container_select{
			position: relative;
			width: 100%;
			border: 1px solid #f0decb;
			overflow: hidden;
			z-index: 1;
		}

		
		/* Date Styles */
		.gform_wrapper .gform_body ul.gform_fields li.gfield .ginput_container_date input.datepicker{
			width: 100%;
		}


		/* Radio Styles */
		.gform_wrapper .gform_body ul.gform_fields li.gfield.form-field-half .ginput_container_radio ul.gfield_radio{
			display: flex;
			flex-wrap: wrap;
			align-items: flex-start;
			justify-content: flex-start;
		}

		.gform_wrapper .gform_body ul.gform_fields li.gfield.form-field-half .ginput_container_radio ul.gfield_radio li{
			display: inline-block;
			width: auto;
			margin-right: 30px;
		}

		.gform_wrapper .gform_body ul.gform_fields li.gfield.form-radio-inline ul.gfield_radio{
			display: flex;
			flex-wrap: wrap;
			align-items: flex-start;
			justify-content: flex-start;
		}

		.gform_wrapper .gform_body ul.gform_fields li.gfield.form-radio-inline ul.gfield_radio li{
			display: inline-block;
			width: auto;
			margin-right: 30px;
		}

		/* Form Nav */
		.gform_wrapper form .gf_page_steps {
			border-bottom: none;
			list-style: none;
			display: table;
			table-layout: fixed;
			width: 100%;
			padding: 0;
			margin: 0;
		}

		.gform_wrapper form .gf_page_steps .gf_step {
			display: table-cell;
			border-bottom: 8px solid #f0decb;
			-moz-transition: border .5s;
			-webkit-transition: border .5s;
			transition: border .5s;
			text-align: center;
		}

		.gform_wrapper form .gf_page_steps .gf_step.gf_step_active {
			border-color: #d03a2b;
		}

		.gform_wrapper form .gf_page_steps .gf_step.gf_step_active .gf_step_label {
			opacity: 1;
		}

		.gform_wrapper form .gf_page_steps .gf_step .gf_step_number {
			display: none;
		}

		.gform_wrapper form .gf_page_steps .gf_step .gf_step_label {
			display: block;
			padding-top: 10px;
			padding-bottom: 10px;
			transition: opacity .5s;
			font-size: 18px;
			text-decoration: none;
			color: #4c5360;
			opacity: .25;
		}
	</style>
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
