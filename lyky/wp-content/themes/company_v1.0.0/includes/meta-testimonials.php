<?php
$prefix = 'tj_';
$meta_box_testimonial = array(
	'id' => 'tj-meta-box-testimonial',
	'title' =>  __('Testimonial Author Information', 'junkie'),
	'page' => 'testimonial',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
	array(
			'name' =>  __('Author Name ', 'junkie'),
			'desc' => '',
			'id' => $prefix.'testimonial_author_name',
			'type' => 'text',
			'std' => 'John Smith'
		),
	array(
		'name' =>  __('Author Avatar ', 'junkie'),
		'desc' => '',
		'id' => $prefix.'testimonial_author_avatar',
		'type' => 'text',
		'std' => get_template_directory_uri().'/images/default-avatar.png'
	),	
	array(
		'name' => '',
		'desc' => '',
		'id' => $prefix.'author_avatar_button',
		'type' => 'button',
		'std' => 'Browse'
	),			
	array(
			'name' =>  __('Site Name ', 'junkie'),
			'desc' => '',
			'id' => $prefix.'testimonial_site_name',
			'type' => 'text',
			'std' => 'Theme Junkie'
		),		
	array(
			'name' =>  __('Site URL ', 'junkie'),
			'desc' => '',
			'id' => $prefix.'testimonial_site_url',
			'type' => 'text',
			'std' => 'http://www.theme-junkie.com'
		)		
	),


);
add_action('admin_menu', 'tj_add_box_testimonial');
/*-----------------------------------------------------------------------------------*/
/*	Add metabox to edit page
/*-----------------------------------------------------------------------------------*/

function tj_add_box_testimonial() {
	global $meta_box_testimonial;

	add_meta_box($meta_box_testimonial['id'], $meta_box_testimonial['title'], 'tj_show_box_testimonial', $meta_box_testimonial['page'], $meta_box_testimonial['context'], $meta_box_testimonial['priority']);

}
/*-----------------------------------------------------------------------------------*/
/*	Callback function to show fields in meta box
/*-----------------------------------------------------------------------------------*/
function tj_show_box_testimonial() {
	global $meta_box_testimonial, $post;

    echo '<p style="padding:10px 0 0 0;"></p>';
    // Use nonce for verification
    echo '<input type="hidden" name="tj_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<table class="form-table">';

    foreach ($meta_box_testimonial['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);
        switch ($field['type']) {


            //If Text
            case 'text':

            echo '<tr style="border-top:1px solid #eeeeee;">',
                '<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
                '<td>';
            echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'],'" size="30" style="width:75%; margin-right: 20px; float:left;" />';

            break;

            //If textarea
            case 'textarea':

            echo '<tr style="border-top:1px solid #eeeeee;">',
                '<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
                '<td>';
            echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : $field['std'], '</textarea>';

            break;

            //If Button
            case 'button':
                echo '<input style="float: left;" type="button" class="button" name="', $field['id'], '" id="', $field['id'], '"value="', $meta ? $meta : $field['std'], '" />';
                echo 	'</td>',
            '</tr>';

            break;
        }
    }

    echo '</table>';

}

add_action('save_post', 'tj_save_data_testimonial');
/*-----------------------------------------------------------------------------------*/
/*	Save data when post is edited
/*-----------------------------------------------------------------------------------*/

function tj_save_data_testimonial($post_id) {
	global $meta_box_testimonial;

	// verify nonce
	if (!wp_verify_nonce($_POST['tj_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	foreach ($meta_box_testimonial['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}
 
