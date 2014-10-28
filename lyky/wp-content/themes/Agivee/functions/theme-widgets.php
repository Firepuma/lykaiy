<?php
/* Widgets Functions  */

/* Widgetable Functions  */
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'ID' => 'homepagebox',
   'name'=>'Homepage Box 1',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h2>',
      'after_title' => '</h2>'
  ));
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'ID' => 'homepagebox',
   'name'=>'Homepage Box 2',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h2>',
      'after_title' => '</h2>'
  ));
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'ID' => 'homepagebox',
   'name'=>'Homepage Box 3',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h2>',
      'after_title' => '</h2>'
  ));  
if ( function_exists('register_sidebar') )  
  register_sidebar(array(
    'name'=>'General Sidebar',
    'before_widget' => '<div class="maincontent"><div id="%1$s" class="widgets %2$s">',
    'after_widget' => '</div></div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>'
  ));
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name'=>'About Page',
    'before_widget' => '<div class="maincontent"><div id="%1$s" class="widgets %2$s">',
    'after_widget' => '</div></div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>'
  )); 
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name'=>'Services Page',
    'before_widget' => '<div class="maincontent"><div id="%1$s" class="widgets %2$s">',
    'after_widget' => '</div></div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>'
  )); 
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name'=>'Blog Sidebar',
    'before_widget' => '<div class="maincontent"><div id="%1$s" class="widgets %2$s">',
    'after_widget' => '</div></div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>'
  ));
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name'=>'Single Post',
    'before_widget' => '<div class="maincontent"><div id="%1$s" class="widgets %2$s">',
    'after_widget' => '</div></div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>'
  )); 
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name'=>'Category Sidebar',
    'before_widget' => '<div class="maincontent"><div id="%1$s" class="widgets %2$s">',
    'after_widget' => '</div></div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>'
  )); 
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'ID' => 'bottom',
   'name'=>'Bottom1',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h3>',
      'after_title' => '</h3>'
  ));
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'ID' => 'bottom',
   'name'=>'Bottom2',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h3>',
      'after_title' => '</h3>'
  ));
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'ID' => 'bottom',
   'name'=>'Bottom3',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h3>',
      'after_title' => '</h3>'
  ));    


/* More About Us Widget */

class SidePage_Widget extends WP_Widget {
  function SidePage_Widget() {
    $widgets_opt = array('description'=>'Display pages in sidebar');
    parent::WP_Widget(false,$name= "Agivee - Side Page",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $pageid = esc_attr($instance['pageid']);
    $pagetitle = esc_attr($instance['pagetitle']);
    $opt_childpage = esc_attr($instance['opt_childpage']);
    $pageexcerpt = (esc_attr($instance['pageexcerpt'])) ? esc_attr($instance['pageexcerpt']) : 20;
    
		$pages = get_pages();
		$listpages = array();
		foreach ($pages as $pagelist ) {
		   $listpages[$pagelist->ID] = $pagelist->post_title;
		}
  ?>  
	 <p><small>Please select the page.</small></p>
		<select  name="<?php echo $this->get_field_name('pageid'); ?>">  id="<?php echo $this->get_field_id('pageid'); ?>" >
			<?php foreach ($listpages as $opt => $val) { ?>
		<option value="<?php echo $opt ;?>" <?php if ( $pageid  == $opt) { echo ' selected="selected" '; }?>><?php echo $val; ?></option>
		<?php } ?>
		</select>
		</label></p>
  <p>
		<input class="checkbox" type="checkbox" <?php if ($opt_childpage == "on") echo "checked";?> id="<?php echo $this->get_field_id('opt_childpage'); ?>" name="<?php echo $this->get_field_name('opt_childpage'); ?>" />
		<label for="<?php echo $this->get_field_id('opt_childpage'); ?>"><small>Incude sub pages?</small></label><br />
    </p>
    <p><label for="pageexcerpt">Number of words for excerpt :
  		<input id="<?php echo $this->get_field_id('pageexcerpt'); ?>" name="<?php echo $this->get_field_name('pageexcerpt'); ?>" type="text" class="widefat" value="<?php echo $pageexcerpt;?>" /></label></p>  
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $pageid = apply_filters('pageid',$instance['pageid']);
    $abouttitle = apply_filters('pagetitle',$instance['pagetitle']);
    $opt_childpage = apply_filters('opt_childpage',$instance['opt_childpage']);
    $pageexcerpt = apply_filters('pageexcerpt',$instance['pageexcerpt']);
    echo $before_widget;
    echo $before_title.$abouttitle.$after_title;
    
    if ($opt_childpage == "on") {

      $aboutpage = new WP_Query('post_type=page&page_id='.$pageid);
      while ($aboutpage->have_posts()) : $aboutpage->the_post(); ?>
        <h2><?php the_title();?></h2>       
        <p><?php excerpt($pageexcerpt);?></p>
      <?php
      endwhile;
      
      $aboutpagelist = new WP_Query('post_type=page&post_parent='.$pageid);
    	while ($aboutpagelist->have_posts()) : $aboutpagelist->the_post();        
      $image_thumbnail = get_post_meta($post->ID,"_image_thumbnail",true);
      
      if ($ID == 'homepagebox') { ?>
        <p>
        <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
          <img src="<?php echo get_template_directory_uri();?>/timthumb.php?src=<?php echo thumb_url();?>&amp;h=80&amp;w=280&amp;zc=1" class="imgcenter" alt="" />
        <?php } ?>
          <strong><a href="<?php the_permalink();?>"><?php the_title();?></a></strong><br />
					 <?php echo excerpt(12);?></p>
      <?php } else { ?>
       <ul class="content-list">
        <li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
       </ul> 
      <?php } ?>
      <?php
      endwhile;
    } else {      
    $aboutpage = new WP_Query('post_type=page&page_id='.$pageid);
    while ($aboutpage->have_posts()) : $aboutpage->the_post(); ?>       
      <p><?php echo excerpt($pageexcerpt);?></p>
    <?php
    endwhile;
    }
    
    echo $after_widget;
    wp_reset_query();
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("SidePage_Widget");'));

/* Latest News Widget */

class LatestNews_Widget extends WP_Widget {
  
  function LatestNews_Widget() {
    $widgets_opt = array('description'=>'Latest News Agivee Theme Widget');
    parent::WP_Widget(false,$name= "Agivee - Latest News",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $catid = esc_attr($instance['catid']);
    $newstitle = esc_attr($instance['newstitle']);
    $numnews = esc_attr($instance['numnews']);
    
    $categories_list = get_categories('hide_empty=0');
    
    $categories = array();
    foreach ($categories_list as $catlist) {
    	$categories[$catlist->cat_ID] = $catlist->cat_name;
    }

  ?>
    <p><label for="newstitle">Title:
  		<input id="<?php echo $this->get_field_id('newstitle'); ?>" name="<?php echo $this->get_field_name('newstitle'); ?>" type="text" class="widefat" value="<?php echo $newstitle;?>" /></label></p>  
	 <p><small>Please select category for <b>News</b>.</small></p>
		<select  name="<?php echo $this->get_field_name('catid'); ?>">  id="<?php echo $this->get_field_id('catid'); ?>" >
			<?php foreach ($categories as $opt => $val) { ?>
		<option value="<?php echo $opt ;?>" <?php if ( $catid  == $opt) { echo ' selected="selected" '; }?>><?php echo $val; ?></option>
		<?php } ?>
		</select>
		</label></p>	
    <p><label for="numnews">Number to display:
  		<input id="<?php echo $this->get_field_id('numnews'); ?>" name="<?php echo $this->get_field_name('numnews'); ?>" type="text" class="widefat" value="<?php echo $numnews;?>" /></label></p>
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $catid = apply_filters('catid',$instance['catid']);
    $newstitle = apply_filters('newstitle',$instance['newstitle']);
    $numnews = apply_filters('numnews',$instance['numnews']);    
    
    if ($newstitle == "") $newstitle = __("Latest News",'agivee');
    if ($numnews == "") $numnews = 3;
    
    echo $before_widget;
    echo $before_title.$newstitle.$after_title;
    $latestnews = new WP_Query('cat='.$catid.'&showposts='.$numnews);
    ?>
    <ul id="news-list">
    <?php
    while ( $latestnews->have_posts() ) : $latestnews->the_post();    
    ?>
   	<li>
      <strong><a href="<?php the_permalink();?>"><?php the_title();?></a></strong><br />
      <?php echo excerpt(12);?>
      </li>
   <?php
   endwhile;
   wp_reset_query();
   ?>
   </ul>
   <?php    
   echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("LatestNews_Widget");'));


/* Testimonial Widget */
class Testimonial_Widget extends WP_Widget {
  function Testimonial_Widget() {
    $widgets_opt = array('description'=>'Testimonial Agivee Theme Widget');
    parent::WP_Widget(false,$name= "Agivee - Testimonial",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $catid = esc_attr($instance['catid']);
    $testititle = esc_attr($instance['testititle']);
    $numtesti = esc_attr($instance['numtesti']);
    
    $categories_list = get_categories('hide_empty=0');
    
    $categories = array();
    foreach ($categories_list as $catlist) {
    	$categories[$catlist->cat_ID] = $catlist->cat_name;
    }

  ?>
    <p><label for="testititle">Title:
  		<input id="<?php echo $this->get_field_id('testititle'); ?>" name="<?php echo $this->get_field_name('testititle'); ?>" type="text" class="widefat" value="<?php echo $testititle;?>" /></label></p>  
	 <p><small>Please select category for <b>Testimonial</b>.</small></p>
		<select  name="<?php echo $this->get_field_name('catid'); ?>">  id="<?php echo $this->get_field_id('catid'); ?>" >
			<?php foreach ($categories as $opt => $val) { ?>
		<option value="<?php echo $opt ;?>" <?php if ( $catid  == $opt) { echo ' selected="selected" '; }?>><?php echo $val; ?></option>
		<?php } ?>
		</select>
		</label></p>	
    <p><label for="numtesti">Number to display:
  		<input id="<?php echo $this->get_field_id('numtesti'); ?>" name="<?php echo $this->get_field_name('numtesti'); ?>" type="text" class="widefat" value="<?php echo $numtesti;?>" /></label></p>
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $catid = apply_filters('catid',$instance['catid']);
    $testititle = apply_filters('testititle',$instance['testititle']);
    $numtesti = apply_filters('numtesti',$instance['numtesti']);    
    
    if ($testititle == "") $testititle == __('Testimonial','agivee');
    if ($numtesti == "") $numtesti = 1;
    
    echo $before_widget;
    echo $before_title.$testititle.$after_title;
    $testis = new WP_Query('cat='.$catid.'&showposts='.$numtesti);
 
    while ( $testis->have_posts() ) : $testis->the_post();    
    ?>
     <blockquote>
     <p><?php echo excerpt(20);?></p>
     </blockquote>
     <strong><?php the_title();?></strong>
     <br/><br/>                        
   <?php
   endwhile;
   wp_reset_query();    
   echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("Testimonial_Widget");'));


/* Post to Homepage Box or Sidebar Box Widget */

class SidePost_Widget extends WP_Widget {
  
  function SidePost_Widget() {
    $widgets_opt = array('class'=>'box','description'=>'Agivee Theme Widget for displaying post in sidebar');
    parent::WP_Widget(false,$name= "Agivee - Side Post",$widgets_opt);  
  }
  
  function form($instance) {
    global $post;
    
    $postid = esc_attr($instance['postid']);
    $check_opt = $instance['check_opt'];
    
		$centitaposts = get_posts('numberposts=-1')
		?>  
	<p><small>Please select post display.</small></p>
			<select  name="<?php echo $this->get_field_name('postid'); ?>">  id="<?php echo $this->get_field_id('postid'); ?>" >
				<?php foreach ($centitaposts as $post) { ?>
			<option value="<?php echo $post->ID;?>" <?php if ( $postid  ==  $post->ID) { echo ' selected="selected" '; }?>><?php echo  the_title(); ?></option>
			<?php } ?>
			</select>
	</label></p>
  <p>
		<input class="checkbox" type="checkbox" <?php if ($check_opt == "on") echo "checked";?> id="<?php echo $this->get_field_id('check_opt'); ?>" name="<?php echo $this->get_field_name('check_opt'); ?>" />
		<label for="<?php echo $this->get_field_id('check_opt'); ?>"><small>Show Image Thumbnail?</small></label><br />
    </p>	
	<?php
  }
  
  function update($new_instance, $old_instance) {				
      return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $postid = apply_filters('postid', $instance['postid']);
    $check_opt = apply_filters('check_opt', $instance['check_opt']);
  
      echo $before_widget;
      $posttitle = "<a href='".get_permalink($postid)."'>".get_the_title($postid)."</a>";
      echo $before_title.$posttitle.$after_title;        
      query_posts('p='.$postid);
      while (have_posts()) : the_post();
      $image_thumbnail = get_post_meta($post->ID,"_image_thumbnail",true);       
      ?>
      <?php if ($check_opt == "on") { ?>
      <div class="icon">
      <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
          <img src="<?php echo get_template_directory_uri();?>/timthumb.php?src=<?php echo thumb_url();?>&amp;h=120&amp;w=280&amp;zc=1" class="imgcenter" alt="" />
        <?php } ?>
      </div>
      <?php }?>
      <p><?php echo excerpt(20);?></p>
      <?php  
      endwhile;
    echo $after_widget;
    wp_reset_query();
  }
}

add_action('widgets_init', create_function('', 'return register_widget("SidePost_Widget");'));

/* Featured Project widget */
class LatestProject_Widget extends WP_Widget {
  function LatestProject_Widget() {
    $widgets_opt = array('description'=>'Latest Projects Agivee Theme Widget');
    parent::WP_Widget(false,$name= "Agivee - Latest Projects",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $featuredcat = esc_attr($instance['featuredcat']);
    $featuredtitle = esc_attr($instance['featuredtitle']);
    $featurednum = esc_attr($instance['featurednum']);
    
    $categories_list = get_categories('hide_empty=0');
    
    $categories = array();
    foreach ($categories_list as $catlist) {
    	$categories[$catlist->cat_ID] = $catlist->cat_name;
    }

  ?>
    <p><label for="featuredtitle">Title:
  		<input id="<?php echo $this->get_field_id('featuredtitle'); ?>" name="<?php echo $this->get_field_name('featuredtitle'); ?>" type="text" class="widefat" value="<?php echo $featuredtitle;?>" /></label></p>  
	  <p><label for="numtesti">Number to display:
  		<input id="<?php echo $this->get_field_id('featurednum'); ?>" name="<?php echo $this->get_field_name('featurednum'); ?>" type="text" class="widefat" value="<?php echo $featurednum;?>" /></label></p>
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $featuredcat = apply_filters('featuredcat',$instance['featuredcat']);
    $featuredtitle = apply_filters('featuredtitle',$instance['featuredtitle']);
    $featurednum = apply_filters('featurednum',$instance['featurednum']);    
    
    if ($featuredtitle == "") $featuredtitle = __('Latest Projects','agivee');
    if ($featurednum == "") $featurednum = 3;
    
    echo $before_widget;
    $titlefeatured = $before_title.$featuredtitle.$after_title;
    agivee_latestproject($featurednum,$titlefeatured);
    echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("LatestProject_Widget");'));


/* Social Link widget */
class SocialLink_Widget extends WP_Widget {
  function SocialLink_Widget() {
    $widgets_opt = array('description'=>'Social Links Profile Widget');
    parent::WP_Widget(false,$name= "Agivee - Social Links ",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $socialtitle = esc_attr($instance['socialtitle']);
  ?>
    <p><label for="socialtitle">Title:
  		<input id="<?php echo $this->get_field_id('socialtitle'); ?>" name="<?php echo $this->get_field_name('socialtitle'); ?>" type="text" class="widefat" value="<?php echo $socialtitle;?>" /></label></p>  
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $socialtitle = apply_filters('socialtitle',$instance['socialtitle']);
    
    if ($socialtitle == "") $socialtitle = __('Get Connected','agivee');
    
    echo $before_widget;
    $titlesocial = $before_title.$socialtitle.$after_title;
    ?>
    <?php
      $feedburner_id = get_option('agivee_feedburner_id');
      $twitter_id = get_option('agivee_twitter_id');
      $flickr_url= get_option('agivee_flickr_url');
      $facebook_url = get_option('agivee_facebook_url');
    ?>                
    <h3><?php echo $titlesocial;?></h3>
    <ul id="social">
			<?php if ($facebook_url !="") { ?>
        <li id="fb-icon"><a href="<?php echo $facebook_url;?>"><span></span><?php echo __('Let\'s Get Personal','agivee');?></a></li>
      <?php } ?>
      <?php if ($twitter_id !="") { ?>
			 <li id="twit-icon"><a href="http://twitter.com/<?php echo $twitter_id;?>"><span></span><?php echo __('Tweet with Us','agivee');?></a></li>
      <?php } ?>
      <?php if ($flickr_url !="") { ?>
			 <li id="flic-icon"><a href="<?php echo $flickr_url;?>"><span></span><?php echo __('Check us Out','agivee');?></a></li>
      <?php } ?>
      <?php if ($feedburner_id !="") { ?>
			 <li id="rss-icon"><a href="<?php bloginfo('rss2_url'); ?>"><span></span><?php echo __('Subscribe to Our Feed','agivee');?></a></li>
      <?php } ?>
		</ul>
    <?php
    echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("SocialLink_Widget");'));
    
/* Twitter widget */
class Twitter_Widget extends WP_Widget {
  function Twitter_Widget() {
    $widgets_opt = array('description'=>'Agivee Twitter Widget');
    parent::WP_Widget(false,$name= "Agivee - Twitter Widget",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $twittertitle = esc_attr($instance['twittertitle']);
    $twitterid = esc_attr($instance['twitterid']);
    $twitternum = esc_attr($instance['twitternum']);
  ?>
    <p><label for="twittertitle">Title:
  		<input id="<?php echo $this->get_field_id('twittertitle'); ?>" name="<?php echo $this->get_field_name('twittertitle'); ?>" type="text" class="widefat" value="<?php echo $twittertitle;?>" /></label></p>
    <p><label for="twitterid">Twitter ID:
		<input id="<?php echo $this->get_field_id('twitterid'); ?>" name="<?php echo $this->get_field_name('twitterid'); ?>" type="text" class="widefat" value="<?php echo $twitterid;?>" /></label></p>
    <p><label for="twitternum">Number to display:
		<input id="<?php echo $this->get_field_id('twitternum'); ?>" name="<?php echo $this->get_field_name('twitternum'); ?>" type="text" class="widefat" value="<?php echo $twitternum;?>" /></label></p>        
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $twittertitle = apply_filters('twittertitle',$instance['twittertitle']);
    $twitterid = apply_filters('twitterid',$instance['twitterid']);
    $twitternum = apply_filters('twitternum',$instance['twitternum']);
    
    if ($twittertitle == "") $twittertitle = __('Twitter Update!','agivee');
    if ($twitternum == "") $twitternum = 1;
    
    echo $before_widget;
    //$titletwitter = $before_title.$twittertitle.$after_title;
    get_template_part('twitter','twitter widget');
    echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("Twitter_Widget");'));

/* Address widget */
class Address_Widget extends WP_Widget {
  function Address_Widget() {
    $widgets_opt = array('description'=>'Agivee Company Address Widget');
    parent::WP_Widget(false,$name= "Agivee - Address Widget ",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $addresstitle = esc_attr($instance['addresstitle']);
  ?>
    <p><label for="addresstitle">Title:
  		<input id="<?php echo $this->get_field_id('addresstitle'); ?>" name="<?php echo $this->get_field_name('addresstitle'); ?>" type="text" class="widefat" value="<?php echo $addresstitle;?>" /></label></p>  
    <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $addresstitle = apply_filters('addresstitle',$instance['addresstitle']);
    
    if ($addresstitle == "") $addresstitle = __('Our Address','agivee');
    
    echo $before_widget;
    echo $before_title.$addresstitle.$after_title;

    $info_address = get_option('agivee_info_address');
    $info_phone = get_option('agivee_info_phone');
    $info_email = get_option('agivee_info_email');
    $info_fax = get_option('agivee_info_fax');
    
    ?>
    
  <p><?php if ($info_address) echo stripslashes($info_address); else echo "18th Place, M1234 Heavenway Road, HW 5468, USA";?><br />
  <?php if ($info_phone !="") echo "Phone : $info_phone";?>,<br />
  <?php if ($info_email !="") echo "Email: $info_email";?><br />
  <?php $footer_text = get_option('agivee_footer_text');?>
  </p>
  <?php
    echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("Address_Widget");'));

/* Brochure Widget */

class Brochure_Widget extends WP_Widget {
  function Brochure_Widget() {
    $widgets_opt = array('description'=>'Display your brochure and download link');
    parent::WP_Widget(false,$name= "Agivee- Brochure",$widgets_opt);
  }
  
  function form($instance) {
    global $post;
    
    $brochure_title = esc_attr($instance['brochure_title']);
    $brochure_url = esc_attr($instance['brochure_url']);
    $brochure_desc = esc_attr($instance['brochure_desc']);
    $brochure_download_url = esc_attr($instance['brochure_download_url']);

  ?>
    <p><label for="brochure_title">Title:
  		<input id="<?php echo $this->get_field_id('brochure_title'); ?>" name="<?php echo $this->get_field_name('brochure_title'); ?>" type="text" class="widefat" value="<?php echo $brochure_title;?>" /></label></p>
      <p><label for="brochure_url">Brochure image url:
		<input id="<?php echo $this->get_field_id('brochure_url'); ?>" name="<?php echo $this->get_field_name('brochure_url'); ?>" type="text" class="widefat" value="<?php echo $brochure_url;?>" /></label></p>
    <p><label for="brochure_download_url">Brochure Download Url:
  		<input id="<?php echo $this->get_field_id('brochure_download_url'); ?>" name="<?php echo $this->get_field_name('brochure_download_url'); ?>" class="widefat" value="<?php echo $brochure_download_url;?>"/></label></p>
    <p><label for="brochure_desc"><?php echo __('Description','agivee');?>:</label>
		<textarea id="<?php echo $this->get_field_id('brochure_desc'); ?>" name="<?php echo $this->get_field_name('brochure_desc'); ?>" class="widefat" rows="6" cols="20" ><?php echo $brochure_desc;?></textarea></p>  
	  <?php    
  } 
  
  function update($new_instance, $old_instance) {
    return $new_instance;
  }
  
  function widget( $args, $instance ) {
    global $post;
    
    extract($args);
    
    $brochure_title = apply_filters('brochure_title',$instance['brochure_title']);
    $brochure_url = apply_filters('brochure_url',$instance['brochure_url']);
    $brochure_desc = apply_filters('brochure_desc',$instance['brochure_desc']);
    $brochure_download_url = apply_filters('brochure_download_url',$instance['brochure_download_url']);    
    
    echo $before_widget;
    echo $before_title.$brochure_title.$after_title;
    ?>
    <a href="<?php echo $brochure_download_url;?>"><img src="<?php echo $brochure_url ? $brochure_url : get_template_directory_uri().'/images/brochure.gif';?>" alt="" class="aligncenter"/></a>
    <p><?php echo $brochure_desc;?></p>
    <div class="clear"></div>    
  <?php 
   echo $after_widget;
  } 
}

add_action('widgets_init', create_function('', 'return register_widget("Brochure_Widget");'));