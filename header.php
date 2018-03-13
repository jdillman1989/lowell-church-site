<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon">
    <?php wp_head(); ?>
  </head>
  <body>

<?php
  $slugger = $post->post_name;
  $slugger = ($post->post_type == 'state') ?$post->post_type:$slugger;  //if the post_type is state, use that, otherwise, use the slug
?>
<header class="site-header site-header-<?php echo $slugger; ?>">
  <nav class="site-navigation navbar">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">
          <?php bloginfo('name'); ?>
        </a>
      </div>

      <div class="collapse navbar-collapse" id="navbar-collapse">
        <a class="sr-only" href="#main">Skip Navigation</a>
        <?php
          $args = array(
            'theme_location'  => 'primary',
            'container'       => false,
            'items_wrap'      => '<ul class="nav nav-pills" id="%1$s" role="navigation">%3$s</ul>'
          );
          wp_nav_menu($args);
        ?>
      </div>
    </div><!-- class="container" -->
  </nav>
  <?php
  if(is_front_page()) { //if this is the home page ?>
    <div class="home-splash">
      <div class="container">
      	<div class="row">
          <div class="col-sm-7 col-sm-offset-5">
            <p class="h1">Friendly and proactive services for workers’ compensation claims</p>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  <?php
    echo get_query_var( 'cat' );

  if(true){ ?>

  <?php } ?>
  <div class="container">
  	<div class="row">
      <div class="col-lg-10 col-lg-offset-1">
        <h1 class="h1"><?php the_title(); ?></h1>
      </div>
    </div>
  </div>
</header>
