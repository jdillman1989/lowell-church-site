<?php

add_theme_support( 'post-thumbnails' );

register_nav_menus(
  array(
    'primary'			     =>	'Primary Menu',
    'nav-footer'       => 'Nav Footer',
  )
);
function benchmarkadministrators_add_taxonomies() {
  register_taxonomy_for_object_type( 'post_tag', 'page' );
  register_taxonomy_for_object_type( 'category', 'page' );
}
add_action( 'init', 'benchmarkadministrators_add_taxonomies' );

function benchmarkadministrators_widgets_init() {
  register_sidebar( array(
      'name' 					=> __( 'Reinsurance Expertise', 'benchmarkadministrators' ),
      'id' 						=> 'home-expertise',
      'description' 	=> __( 'Home page expertise content.', 'benchmarkadministrators' ),
      'before_widget'	=> "",
      'after_widget'	=> "",
      'container'			=> false
    )
  );
}
add_action( 'widgets_init', 'benchmarkadministrators_widgets_init' );

function benchmarkadministrators_include_scripts() {
  //CSS & fonts
  wp_enqueue_style( 'bootstrapcss', get_template_directory_uri() . '/css/bootstrap.min.css',false,'1.1','all');
  wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css',false,'1.1','all');
  wp_enqueue_style( 'GoogleFont', 'https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,700,700i',false,'1.1','all');
  //scripts
	wp_deregister_script('jquery');
  wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery-3.2.1.min.js', array(), null, true);
  wp_enqueue_script('mainJS', get_bloginfo('template_directory') . '/js/main.js', array(), null, true);
  global $post;
  if($post->post_type == 'state') { //we need the google API
    // Prod
    // wp_enqueue_script('googleMap', 'http://maps.google.com/maps/api/js?key=AIzaSyCKTr_fy7ybCeso2cVq8RqnwdqimWevQBM&callback=initMap', array(), null, true);

    // Local
    wp_enqueue_script('googleMap', 'http://maps.google.com/maps/api/js?key=AIzaSyCoiA67LCu-560-AYtWNVgv-n4TMalTemc&callback=initMap', array(), null, true);
  }
  //wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', array(), null, true);
  wp_enqueue_script('bootstrapjs', get_bloginfo('template_directory') . '/js/bootstrap.min.js', array(), null, true);

}
add_action('wp_enqueue_scripts', 'benchmarkadministrators_include_scripts');

function benchmarkadministrators_special_nav_class ($classes, $item) {						//set custom class for current-menu-item
  if (in_array('current-menu-item', $classes) ){
    $classes[] = 'active ';
  }
  return $classes;
}
add_filter('nav_menu_css_class' , 'benchmarkadministrators_special_nav_class' , 10 , 2);	//add the filter

function benchmark_add_admin_scripts(){
  wp_register_script(
    'benchmark_admin_js', get_template_directory_uri() . '/js/admin.js', array('jquery'), false, true
  );
  wp_enqueue_script('benchmark_admin_js');
  wp_localize_script( 'benchmark_admin_js', 'ajax_obj', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}

add_action('admin_enqueue_scripts', 'benchmark_add_admin_scripts',1001);

function get_coordinates($address) {
    
    $address = urlencode($address);
    $url = 'http://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false';
    $ch = curl_init();
    $options = array(
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_URL            => $url,
        CURLOPT_HEADER         => false,
    );
        
    curl_setopt_array($ch, $options);
    $response = curl_exec($ch);
    curl_close($ch);
    if (!$response) {
        return false;
    }
    $response = json_decode($response);
    $lat  = $response->results[0]->geometry->location->lat;
    $long = $response->results[0]->geometry->location->lng;
    return array('lat' => $lat, 'long' => $long, 'response' => $response->status);
}

add_action( 'wp_ajax_get_coords', 'address_get_coords' );
add_action( 'wp_ajax_nopriv_get_coords', 'address_get_coords' );

function address_get_coords() {

  $coords = get_coordinates($_GET['address']);
  $response = json_encode($coords);
  echo $response;
  
  wp_die();
}

?>
