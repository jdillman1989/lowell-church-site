<?php

require_once('insurance/form-entries.php');

add_theme_support('post-thumbnails');
function aliberty_customize_register($wp_customize) {

	$wp_customize->add_section(
		'aliberty_globals_section' , array(
			'title' => 'Global Variables',
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'phone' , array(
			'default' => '(801) 226-8008',
			'transport' => 'refresh',
		)
	);

	$wp_customize->add_setting(
		'address_1' , array(
			'default' => '3601 North University Avenue',
			'transport' => 'refresh',
		)
	);

	$wp_customize->add_setting(
		'address_2' , array(
			'default' => 'Suite 100',
			'transport' => 'refresh',
		)
	);

	$wp_customize->add_setting(
		'address_3' , array(
			'default' => 'Provo, UT 84604',
			'transport' => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'phone',
			array(
				'label' => 'Phone',
				'section' => 'aliberty_globals_section',
				'settings' => 'phone',
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'address_1',
			array(
				'label' => 'Address Line 1',
				'section' => 'aliberty_globals_section',
				'settings' => 'address_1',
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'address_2',
			array(
				'label' => 'Address Line 2',
				'section' => 'aliberty_globals_section',
				'settings' => 'address_2',
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'address_3',
			array(
				'label' => 'Address Line 3',
				'section' => 'aliberty_globals_section',
				'settings' => 'address_3',
			)
		)
	);

}
add_action( 'customize_register', 'aliberty_customize_register' );

register_nav_menus(
	array(
		'main' => 'Main',
		'footer' => 'Footer',
		'social' => 'Social',
	)
);

function aliberty_include_scripts() {
	//CSS & fonts
	wp_enqueue_style( 'bootstrapCSS', get_template_directory_uri() . '/css/bootstrap.min.css',false,'1.1','all');
	wp_enqueue_style( 'GoogleFont1', 'https://fonts.googleapis.com/css?family=Lato:300,400,700',false,'1.1','all');
	wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css',false,'1.1','all');
	//scripts
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', array(), null, true);
	wp_enqueue_script('bootstrapJS', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array(), null, true);
	wp_enqueue_script('isotope', get_bloginfo('template_directory') . '/js/isotope.min.js', array(), null, true);
	wp_enqueue_script('isotopeF', get_bloginfo('template_directory') . '/js/isotope-functions.min.js', array(), null, true);
	wp_enqueue_script('mainJS', get_bloginfo('template_directory') . '/js/functions.min.js', array(), null, true);

}
add_action('wp_enqueue_scripts', 'aliberty_include_scripts');