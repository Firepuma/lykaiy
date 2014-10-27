<?php

/**
 * Create the Post meta boxes
 */
    
add_action('add_meta_boxes', 'junkie_metabox_posts');
function junkie_metabox_posts(){
	global $shortname;
	//die($shortname);
	/* Create a gallery metabox -----------------------------------------------------*/
    $meta_box = array(
		'id' => 'junkie-metabox-portfolio',
		'title' =>  __('Portfolio Settings', 'junkie'),
		'description' => __('Setup your portfolio page.', 'junkie'),
		'page' => 'portfolio',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
					'name' =>  __('Image Gallery', 'junkie'),
					'desc' => __('Click to upload images.', 'junkie'),
					'id' => 'tj_image_ids',
					'type' => 'images',
                    'std' => __('Upload Images', 'junkie')
				),
			array(
					'name' =>  __('Short Description', 'junkie'),
					'desc' => __('A short description of the project.', 'junkie'),
					'id' => 'tj_portfolio_short_desc',
					'type' => 'text',
                    'std' => __('A short description', 'junkie')
				),
			array(
					'name' =>  __('Client Name', 'junkie'),
					'desc' => __('The client name of the project.', 'junkie'),
					'id' => 'tj_portfolio_client',
					'type' => 'text',
                    'std' => __('Theme Junkie', 'junkie')
				),
			array(
					'name' =>  __('External Link', 'junkie'),
					'desc' => __('The link to the project.', 'junkie'),
					'id' => 'tj_portfolio_link',
					'type' => 'text',
                    'std' => __('http://www.theme-junkie.com/', 'junkie')
				),
			array(
					'name' =>  __('Video Embedded Code', 'junkie'),
					'desc' => __('Embed video into your portfolio page. Image Gallery will be hidden.', 'junkie'),
					"id" => "tj_video_embed_portfolio",
					'type' => 'textarea',
                    'std' => ''
				)																					
		)
	);
    junkie_add_meta_box( $meta_box );
}

	
	
?>