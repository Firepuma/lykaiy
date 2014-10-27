<?php
//订阅
add_theme_support( 'automatic-feed-links' );

//头部导航

if ( function_exists('register_nav_menus') ) {
register_nav_menus(array(
'primary' => '导航菜单'
));
}
//缩略图
add_theme_support( 'post-thumbnails' ); //激活文章和页面的缩略图功能


//底部导航
register_nav_menus(
array(
'footer-menu' => __( '底部自定义菜单' )
)
);


//注册工具栏
if (function_exists('register_sidebar')){
    register_sidebar(array(
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h1>',
		'after_title'   => '</h1>'
	));
	}
	
/* 访问计数 */
function record_visitors()
{
	if (is_singular())
	{
	  global $post;
	  $post_ID = $post->ID;
	  if($post_ID)
	  {
		  $post_views = (int)get_post_meta($post_ID, 'views', true);
		  if(!update_post_meta($post_ID, 'views', ($post_views+1)))
		  {
			add_post_meta($post_ID, 'views', 1, true);
		  }
	  }
	}
}
add_action('wp_head', 'record_visitors');
 
function post_views($before = '(点击 ', $after = ' 次)', $echo = 1)
{
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID, 'views', true);
  if ($echo) echo $before, number_format($views), $after;
  else return $views;
}
//获取文章
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count.'';
}
 
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

//分页工具
function pagenavi( $p = 2 ) {
if ( is_singular() ) return;
global $wp_query, $paged;
$max_page = $wp_query->max_num_pages;
if ( $max_page == 1 ) return;
if ( empty( $paged ) ) $paged = 1;
echo '<span class="page-numbers">' . $paged . ' / ' . $max_page . ' </span> ';
if ( $paged > 1 ) p_link( $paged - 1, '上一页', '上一页' );
if ( $paged > $p + 1 ) p_link( 1, '最前页' );
if ( $paged > $p + 2 ) echo '<span class="page-numbers">...</span>';
for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {
if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current'>{$i}</span> " : p_link( $i );
}
if ( $paged < $max_page - $p - 1 ) echo '<span class="page-numbers">...</span>';
if ( $paged < $max_page - $p ) p_link( $max_page, '最末页' );
if ( $paged < $max_page ) p_link( $paged + 1,'下一页', '下一页' );
}
function p_link( $i, $title = '', $linktype = '' ) {
if ( $title == '' ) $title = "第 {$i} 页";
if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }
echo "<a class='page-numbers' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$linktext}</a> ";
}
  
//自定义域

function new_meta_boxes() {
    global $post, $new_meta_boxes;

    foreach($new_meta_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);

        if($meta_box_value == "")
            $meta_box_value = $meta_box['std'];

        echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

        // 自定义字段标题
        echo'<h4>'.$meta_box['title'].'</h4>';

        // 自定义字段输入框
        echo '<textarea cols="60" rows="3" name="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea><br />';
    }
}

function create_meta_box() {
    global $theme_name;

    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', '自定义模块', 'new_meta_boxes', 'post', 'normal', 'high' );
    }
}

function save_postdata( $post_id ) {
    global $post, $new_meta_boxes;
if($new_meta_boxes) {
    foreach($new_meta_boxes as $meta_box) {
        if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {
            return $post_id;
        }

        if ( 'page' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ))
                return $post_id;
        } 
        else {
            if ( !current_user_can( 'edit_post', $post_id ))
                return $post_id;
        }

        $data = $_POST[$meta_box['name'].'_value'];

        if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
            add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
            update_post_meta($post_id, $meta_box['name'].'_value', $data);
        elseif($data == "")
            delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
    }
}}

add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');

//评论
function cleanr_theme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li id="comment-<?php comment_ID() ?>" <?php comment_class(); ?>>
			<a href="<?php comment_author_url() ?>" class="avatar" target="_blank">
				<?php echo get_avatar($comment,$size='43',$default='<path_to_url>' ); ?>
			</a>
			<div>
				<h2>
					<?php printf(__('%s'), get_comment_author_link()) ?>
					<span class="c_time">
						<?php echo get_comment_date();?>
					</span>
				</h2>
				
			<?php if ($comment->comment_approved == '0') : ?>
         			<p><?php _e('评论等待审核中！') ?></p>
					 <br />
      		<?php endif; ?>
				<?php comment_text() ?>
				<p>
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</p>
			</div>
		</li>
<?php } ?>

