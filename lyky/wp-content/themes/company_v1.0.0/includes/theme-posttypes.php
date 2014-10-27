<?php

//Add Mini Features Post Type

function tj_create_post_type_feature()
{
	$labels = array(
		'name' => __( 'Mini Features','junkie'),
		'singular_name' => __( 'features','junkie' ),
		'add_new' => __('Add New','junkie'),
		'add_new_item' => __('Add New Feature','junkie'),
		'edit_item' => __('Edit Feature','junkie'),
		'new_item' => __('New Feature','junkie'),
		'view_item' => __('View Feature','junkie'),
		'search_items' => __('Search Feature','junkie'),
		'not_found' =>  __('No feature found','junkie'),
		'not_found_in_trash' => __('No feature found in Trash','junkie'),
		'parent_item_colon' => ''
	  );

	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','','custom-fields','excerpt','')
	  );

	  register_post_type(__( 'feature', 'junkie' ),$args);
}

//Add Testimonial Post Type

function tj_create_post_type_testimonial()
{
	$labels = array(
		'name' => __( 'Testimonials','junkie'),
		'singular_name' => __( 'Testimonial','junkie' ),
		'add_new' => __('Add New','junkie'),
		'add_new_item' => __('Add New Testimonial','junkie'),
		'edit_item' => __('Edit Testimonial','junkie'),
		'new_item' => __('New Testimonial','junkie'),
		'view_item' => __('View Testimonial','junkie'),
		'search_items' => __('Search Testimonial','junkie'),
		'not_found' =>  __('No testimonial found','junkie'),
		'not_found_in_trash' => __('No testimonial found in Trash','junkie'),
		'parent_item_colon' => ''
	  );

	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','','custom-fields','excerpt','')
	  );

	  register_post_type(__( 'testimonial', 'junkie' ),$args);
}


//Add Portfolio Post Type

function tj_create_post_type_portfolio()
{
	$labels = array(
		'name' => __( 'Portfolio Items','junkie'),
		'singular_name' => __( 'Portfolio','junkie' ),
		'add_new' => __('Add New','junkie'),
		'add_new_item' => __('Add New Portfolio','junkie'),
		'edit_item' => __('Edit Portfolio','junkie'),
		'new_item' => __('New Portfolio','junkie'),
		'view_item' => __('View Portfolio','junkie'),
		'search_items' => __('Search Portfolio','junkie'),
		'not_found' =>  __('No portfolio found','junkie'),
		'not_found_in_trash' => __('No portfolio found in Trash','junkie'),
		'parent_item_colon' => ''
	  );
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','custom-fields','excerpt','comments')
	  ); 
	  
	  register_post_type(__( 'portfolio', 'junkie' ),$args);
}

function tj_build_taxonomies(){
    
	$args = array(
		"hierarchical" => true, 
		"label" => __( "Portfolio Types", 'junkie' ), 
		"singular_label" => __( "Portfolio Type", 'junkie' ), 
		"rewrite" => array('slug' => 'portfolio-type', 'hierarchical' => true), 
		"public" => true
	);
    
	register_taxonomy(__( "portfolio-type", 'junkie' ), array(__( "portfolio", 'junkie' )), $args); 
}


function tj_portfolio_edit_columns($columns){  

        $columns = array(  
            "cb" => "<input type=\"checkbox\" />",  
            "title" => __( 'Portfolio Item Title', 'junkie' ),
            "type" => __( 'Type', 'junkie' ),
            'date' => __( 'Date' )
        );  
  
        return $columns;  
}

function tj_portfolio_custom_columns($column){  
        global $post;  
        switch ($column)  
        {    
            case __( 'type', 'junkie' ):  
                echo get_the_term_list($post->ID, __( 'portfolio-type', 'junkie' ), '', ', ','');  
                break;
        }  
}

add_action( 'init', 'tj_create_post_type_portfolio' );
add_action( 'init', 'tj_create_post_type_feature' );
add_action( 'init', 'tj_create_post_type_testimonial' );


add_action( 'init', 'tj_build_taxonomies', 0 );

add_filter("manage_edit-portfolio_columns", "tj_portfolio_edit_columns");

add_action("manage_posts_custom_column",  "tj_portfolio_custom_columns");

?>