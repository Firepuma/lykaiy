<?php


add_action('init', 'add_button'); 

function add_button() {  
	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  {  
		add_filter('mce_external_plugins', 'add_plugin');  
		add_filter('mce_buttons_3', 'register_columns'); 
		add_filter('mce_buttons_3', 'register_elements');
    add_filter('mce_buttons_3', 'register_liststyle');
    add_filter('mce_buttons_3', 'register_messagebox');
	}  
}  

//FIRST ROW OF BUTTONS 
function register_columns($buttons) {   	
    array_push($buttons, "columns");  	
    return $buttons;  
} 

//SECOND ROW OF BUTTONS 
function register_elements($buttons) {   	
    array_push($buttons,"elements");  	
    return $buttons;  
}

//SECOND ROW OF BUTTONS 
function register_liststyle($buttons) {   	
    array_push($buttons,"list");  	
    return $buttons;  
}

function register_messagebox($buttons) {   	
    array_push($buttons,"messagebox");  	
    return $buttons;  
}

function add_plugin($plugin_array) {  
    $plugin_array['shortcodes'] = get_template_directory_uri().'/admin/tinymce/shortcodes.js';  
    return $plugin_array;  
}  

?>