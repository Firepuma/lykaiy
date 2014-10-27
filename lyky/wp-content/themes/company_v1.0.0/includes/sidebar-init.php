<?php

function junkie_widgets_init() {
	
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'junkie' ),
		'id'            => 'sidebar',
		'description'   => __( 'Appears in the sidebar section of the site.', 'junkie' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer (column1)', 'junkie' ),
		'id'            => 'footer-col-1',
		'description'   => __( 'Appears in the footer section of the site.', 'junkie' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer (column2)', 'junkie' ),
		'id'            => 'footer-col-2',
		'description'   => __( 'Appears in the footer section of the site.', 'junkie' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer (column3)', 'junkie' ),
		'id'            => 'footer-col-3',
		'description'   => __( 'Appears in the footer section of the site.', 'junkie' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer (column4)', 'junkie' ),
		'id'            => 'footer-col-4',
		'description'   => __( 'Appears in the footer section of the site.', 'junkie' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Home Slider', 'junkie' ),
		'id'            => 'home-slider',
		'description'   => __( 'For the LayerSlider WP Widget only.', 'junkie' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );	
					
}
add_action( 'widgets_init', 'junkie_widgets_init' );
	
?>