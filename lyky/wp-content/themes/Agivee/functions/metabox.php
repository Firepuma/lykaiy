<?php

/* Add Meta Box for Portfolio */
function agivee_portfolio_meta_boxes() {
  $meta_boxes = array(
    "portfolio_link" => array(
      "name" => "_portfolio_link",
      "title" => "Preview link",
      "description" => "please enter image url here.<br/>Images : <br />http://wp-demo.indonez.com/agivee/wp-content/uploads/2010/07/image.jpg<br/>",
      "type" => "text"
    ),
    "portfolio_url" => array(
      "name" => "_portfolio_url",
      "title" => "Custom URL",
      "description" => "Add link / custom URL for your portfolio items, eg. link to external url.",
      "type" => "text"
    )          
  );
  
  return apply_filters( 'agivee_portfolio_meta_boxes', $meta_boxes );
}


function agivee_slideshow_meta_boxes() {

  $meta_boxes = array(
    "slideshow_url" => array(
      "name" => "_slideshow_url",
      "title" => __("Custom Slideshow Url",'agivee'),
      "description" => "Custonm url for slideshow.",
      "type" => "text"
    ),
    "slideshow_url_text" => array(
      "name" => "_slideshow_url_text",
      "title" => __("Slideshow Text Button",'agivee'),
      "description" => __("Custom text for slideshow button.",'agivee'),
      "type" => "text"
    ) 
  );

	return apply_filters( 'agivee_slideshow_meta_boxes', $meta_boxes );
}

function imediapixel_page_meta_boxes() {

  $meta_boxes = array(
    "page_short_desc" => array(
      "name" => "_page_short_desc",
      "title" => __("Short Description",'agivee'),
      "description" => __("Add short description for your page.",'agivee'),
      "type" => "textarea"
    ),
  );

	return apply_filters( 'imediapixel_slideshow_meta_boxes', $meta_boxes );
}

function  portfolio_meta_boxes() {
  global $post;
  $meta_boxes = agivee_portfolio_meta_boxes();
  ?>

  <table class="form-table">
	<?php foreach ( $meta_boxes as $meta ) :

		$value = get_post_meta( $post->ID, $meta['name'], true );

		if ( $meta['type'] == 'text' )
			get_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );

	endforeach; ?>
  </table>
  <?php
}

function slideshow_meta_boxes() {
	global $post;
	$meta_boxes = agivee_slideshow_meta_boxes(); ?>

	<table class="form-table">
	<?php foreach ( $meta_boxes as $meta ) :

		$value = stripslashes( get_post_meta( $post->ID, $meta['name'], true ) );

		if ( $meta['type'] == 'text' )
			get_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );

	endforeach; ?>
	</table>
<?php
}

function page_meta_boxes() {
	global $post;
	$meta_boxes = imediapixel_page_meta_boxes(); ?>

	<table class="form-table">
	<?php foreach ( $meta_boxes as $meta ) :

		$value = stripslashes( get_post_meta( $post->ID, $meta['name'], true ) );

		if ( $meta['type'] == 'text' )
			get_meta_text_input( $meta, $value );
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );

	endforeach; ?>
	</table>
<?php
}

function get_meta_text_input( $args = array(), $value = false ) {

	extract( $args ); ?>

	<tr>
		<th style="width:10%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo esc_html( $value, 1 ); ?>" size="30" tabindex="30" style="width: 97%;" /><br /><small><?php echo $args['description']; ?></small>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php
}

function get_meta_select( $args = array(), $value = false ) {

	extract( $args ); ?>

	<tr>
		<th style="width:10%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<select name="<?php echo $name; ?>" id="<?php echo $name; ?>">
			<?php foreach ( $options as $option ) : ?>
				<option <?php if ( htmlentities( $value, ENT_QUOTES ) == $option ) echo ' selected="selected"'; ?>>
					<?php echo $option; ?>
				</option>
			<?php endforeach; ?>
			</select><br /><small><?php echo $args['description']; ?></small>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php
}


function get_meta_textarea( $args = array(), $value = false ) {

	extract( $args ); ?>

	<tr>
		<th style="width:10%;">
			<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
		</th>
		<td>
			<textarea name="<?php echo $name; ?>" id="<?php echo $name; ?>" cols="60" rows="4" tabindex="30" style="width: 97%;"><?php echo esc_html( $value, 1 ); ?></textarea><br /><small><?php echo $args['description']; ?></small>
			<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</td>
	</tr>
	<?php
}

function agivee_create_meta_box() {
	global $theme_name;
  
  add_meta_box( 'page-meta-boxes', __('Page options','agivee'), 'page_meta_boxes', 'page', 'normal', 'high' );
	add_meta_box( 'slideshow-meta-boxes', __('Slideshow options','agivee'), 'slideshow_meta_boxes', 'slideshow', 'normal', 'high' );
	add_meta_box( 'portfolio-meta-boxes', __('Portfolio options','agivee'), 'portfolio_meta_boxes', 'portfolio', 'normal', 'high' );
}

function agivee_save_meta_data( $post_id ) {
	global $post;
  
  if (isset($_POST['post_type'])) {
    if ( 'slideshow' == $_POST['post_type'] )
      $meta_boxes = array_merge( agivee_slideshow_meta_boxes() );  
    else if ( 'page' == $_POST['post_type'] )
      $meta_boxes = array_merge( imediapixel_page_meta_boxes() );
    else
      $meta_boxes = array_merge( agivee_portfolio_meta_boxes() );
  
  	foreach ( $meta_boxes as $meta_box ) :
  
  		if ( !wp_verify_nonce( $_POST[$meta_box['name'] . '_noncename'], plugin_basename( __FILE__ ) ) )
  			return $post_id;
      
      if ( 'slideshow' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) )
  			return $post_id;
      
      elseif ( 'page' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
      
  		elseif ( 'portfolio' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) )
  			return $post_id;
        
  		$data = stripslashes( $_POST[$meta_box['name']] );
  
  		if ( get_post_meta( $post_id, $meta_box['name'] ) == '' )
  			add_post_meta( $post_id, $meta_box['name'], $data, true );
  
  		elseif ( $data != get_post_meta( $post_id, $meta_box['name'], true ) )
  			update_post_meta( $post_id, $meta_box['name'], $data );
  
  		elseif ( $data == '' )
  			delete_post_meta( $post_id, $meta_box['name'], get_post_meta( $post_id, $meta_box['name'], true ) );
  
  	endforeach;
   }
}



/* Add a new meta box to the admin menu. */
	add_action( 'admin_menu', 'agivee_create_meta_box' );

/* Saves the meta box data. */
	add_action( 'save_post', 'agivee_save_meta_data' );

?>