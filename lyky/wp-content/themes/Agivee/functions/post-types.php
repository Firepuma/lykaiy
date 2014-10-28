<?php
/* Register Custom Post Type for Portfolio */
add_action('init', 'portfolio_post_type_init');
function portfolio_post_type_init() {
  $labels = array(
    'name' => __('Portfolio', 'post type general name','agivee'),
    'singular_name' => __('portfolio', 'post type singular name','agivee'),
    'add_new' => __('Add New', 'portfolio','agivee'),
    'add_new_item' => __('Add New portfolio','agivee'),
    'edit_item' => __('Edit portfolio','agivee'),
    'new_item' => __('New portfolio','agivee'),
    'view_item' => __('View portfolio','agivee'),
    'search_items' => __('Search portfolio','agivee'),
    'not_found' =>  __('No portfolio found','agivee'),
    'not_found_in_trash' => __('No portfolio found in Trash','agivee'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'show_in_nav_menus' => false,
    'menu_position' => 1000,
    'rewrite' => array(
      'slug' => 'portfolio_item',
      'with_front' => FALSE,
    ),         
    'taxonomies' => array('portfolio_category', 'post_tag'),
    'supports' => array(
      'title',
      'editor',
      'author',
      'thumbnail',
      'excerpt',
      'comments',
      'thumbnail',
      'trackbacks',
      'custom-fields',
      'revisions',
      'page-attributes'
    )
  );

  register_post_type('portfolio',$args);

	register_taxonomy_for_object_type('post_tag', 'portfolio');

	register_taxonomy("portfolio_category", 
				    	array("portfolio"), 
				    	array( "hierarchical" => true, 
				    			"label" => __("Portfolio Categories",'agivee'), 
				    			"singular_label" => __("Portfolio Categories",'agivee'), 
				    			"rewrite" => true,
                  "public" => true,
                  "show_ui" => true,                   
                  "show_in_nav_menus" => true,
				    			"query_var" => true
				    		));  
  
}


/* Register Custom Post Type for Slideshow */
add_action('init', 'slideshow_post_type_init');
function slideshow_post_type_init() {
  $labels = array(
    'name' => __('Slideshow', 'post type general name','agivee'),
    'singular_name' => __('slideshow', 'post type singular name','agivee'),
    'add_new' => __('Add New', 'slideshow','agivee'),
    'add_new_item' => __('Add New slideshow','agivee'),
    'edit_item' => __('Edit slideshow','agivee'),
    'new_item' => __('New slideshow','agivee'),
    'view_item' => __('View slideshow','agivee'),
    'search_items' => __('Search slideshow','agivee'),
    'not_found' =>  __('No slideshow found','agivee'),
    'not_found_in_trash' => __('No slideshow found in Trash','agivee'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'rewrite' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'show_in_nav_menus' => false,
    'menu_position' => 1000,
    'supports' => array(
      'title',
      'editor',
      'author',
      'thumbnail',
      'excerpt',
      'comments',
      'thumbnail',
      'trackbacks',
      'custom-fields',
      'revisions'       
    )
  );
  register_post_type('slideshow',$args);
}
?>