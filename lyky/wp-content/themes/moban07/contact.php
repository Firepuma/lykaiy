<?php  
/* 
Template Name:contact
*/  
?> 


<?php get_header(); ?>
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
<div class="ny1" style="background:url(<?php bloginfo('template_url'); ?>/images/nb1.jpg) center">
     <div class="ny1_1"></div>
</div>
<div class="ny2">
     <!----正文---->
     <div class="yb">
          <div class="f1">
               <h2><?php wp_title(""); ?></h2>
               <div class="f1_1">
                  <a>首页</a>
                  <a><?php
                  if($post->post_parent) {
                  $parent_title = get_the_title($post->post_parent);
                  echo $parent_title;
                  } else {
                  wp_title('');
                  }
                  ?></a>
				  <a style=" color:#0099FF;"><?php wp_title(''); ?></a>
               </div>
          </div>
          <div class="f2">
               <div class="t1">
                  <div style="width:613px;height:184px;" id="dituContent"></div>
                     <script type="text/javascript">
    //创建和初始化地图函数：
    function initMap(){
        createMap();//创建地图
        setMapEvent();//设置地图事件
        addMapControl();//向地图添加控件
        addMarker();//向地图中添加marker
    }
    
    //创建地图函数：
    function createMap(){
        var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
        <?php if (get_option('mytheme_ditu_zuob')!=""): ?>
                                  var point = new BMap.Point(<?php echo get_option('mytheme_ditu_zuob'); ?>,<?php echo get_option('mytheme_ditu_zuob3'); ?>);
                                 <?php else : ?>
                                  var point = new BMap.Point(116.403815,39.91508);
                               <?php endif; ?>
        map.centerAndZoom(point,16);//设定地图的中心点和坐标并将地图显示在地图容器中
        window.map = map;//将map变量存储在全局
    }
    
    //地图事件设置函数：
    function setMapEvent(){
        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
        map.enableScrollWheelZoom();//启用地图滚轮放大缩小
        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
        map.enableKeyboard();//启用键盘上下左右键移动地图
    }
    
    //地图控件添加函数：
    function addMapControl(){
        //向地图中添加缩放控件
	var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
	map.addControl(ctrl_nav);
        //向地图中添加缩略图控件
	var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:1});
	map.addControl(ctrl_ove);
        //向地图中添加比例尺控件
	var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
	map.addControl(ctrl_sca);
    }
    
    //标注点数组
	<?php if (get_option('mytheme_ditu_tit')!=""): ?>
	 var markerArr = [{title:"<?php echo get_option('mytheme_ditu_tit'); ?>",content:"<?php echo get_option('mytheme_ditu_cont'); ?>",point:"<?php echo get_option('mytheme_ditu_zuob'); ?>|<?php echo get_option('mytheme_ditu_zuob3'); ?>",isOpen:1,icon:{w:23,h:25,l:46,t:21,x:9,lb:12}}
	
	 <?php else : ?>
    var markerArr = [{title:"WEB主题公园",content:"长沙市劳动西路大华宾馆后华都小户型504",point:"116.403815|39.91508",isOpen:1,icon:{w:23,h:25,l:46,t:21,x:9,lb:12}}
	 <?php endif; ?>
		 ];
    //创建marker
    function addMarker(){
        for(var i=0;i<markerArr.length;i++){
            var json = markerArr[i];
            var p0 = json.point.split("|")[0];
            var p1 = json.point.split("|")[1];
            var point = new BMap.Point(p0,p1);
			var iconImg = createIcon(json.icon);
            var marker = new BMap.Marker(point,{icon:iconImg});
			var iw = createInfoWindow(i);
			var label = new BMap.Label(json.title,{"offset":new BMap.Size(json.icon.lb-json.icon.x+10,-20)});
			marker.setLabel(label);
            map.addOverlay(marker);
            label.setStyle({
                        borderColor:"#808080",
                        color:"#333",
                        cursor:"pointer"
            });
			
			(function(){
				var index = i;
				var _iw = createInfoWindow(i);
				var _marker = marker;
				_marker.addEventListener("click",function(){
				    this.openInfoWindow(_iw);
			    });
			    _iw.addEventListener("open",function(){
				    _marker.getLabel().hide();
			    })
			    _iw.addEventListener("close",function(){
				    _marker.getLabel().show();
			    })
				label.addEventListener("click",function(){
				    _marker.openInfoWindow(_iw);
			    })
				if(!!json.isOpen){
					label.hide();
					_marker.openInfoWindow(_iw);
				}
			})()
        }
    }
    //创建InfoWindow
    function createInfoWindow(i){
        var json = markerArr[i];
        var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>"+json.content+"</div>");
        return iw;
    }
    //创建一个Icon
    function createIcon(json){
        var icon = new BMap.Icon("http://app.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w,json.h),{imageOffset: new BMap.Size(-json.l,-json.t),infoWindowOffset:new BMap.Size(json.lb+5,1),offset:new BMap.Size(json.x,json.h)})
        return icon;
    }
    
    initMap();//创建和初始化地图
</script>
               </div>
               <div class="t2">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		            <?php the_content(); ?>
                    <?php endwhile; endif; ?>
               </div>
          </div>
          <div class="liuy"><?php comments_template(); ?></div>
     </div>
     <!----侧栏---->
     <div class="zb">
          <div class="d1">
               <div class="d1_1">FAST NAVIGATION</div>
               <div class="d1_2">
               <?php if (is_page('contact')): ?>
                     <ul><li class="current_page_item"><a href="<?php the_permalink() ?>"><?php wp_title(''); ?></a></li>
               <?php else : ?>
                     <ul><li><a href="<?php 
							$name = 'contact'; //page别名
                            global $wpdb;
                            $page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '$name'");
                            $page_data = get_page( $page_id )->post_content;
                            echo get_page_link( $page_id ); 
                            ?>">
							<?php
                            if($post->post_parent) {
                            $parent_title = get_the_title($post->post_parent);
                            echo $parent_title;
                            } else {
                            wp_title('');
                            }?></a>
                    </li>
               <?php endif;?>
                    <?php
                      if($post->post_parent)
                      $children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
                      else
                      $children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
                      if ($children) {
                      echo '';
                      echo $children;
                      echo '</ul>';
                   } ?>
               </div>
               <div class="d1_3"></div>
               
               <div class="d1_1">THE LATEST CASE</div>
               <div class="d1_2">
                    <div class="e1">
               <?php
               $cat=get_category_by_slug('company-case'); //获取分类别名为 wordpress 的分类数据
               $cat_links=get_category_link($cat->term_id); // 通过$cat数组里面的分类id获取分类链接
               ?>
               <?php $posts = get_posts( "category=($cat->term_id)&numberposts=3" ); ?>
               <?php if( $posts ) : ?><!------判断如果有文章--->
               <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>      <!----循环开始---->
                         <div class="e1_1">
                              <?php the_post_thumbnail('thumbnail'); ?>
                              <div class="e1_2">
                                   <h4><a href="<?php the_permalink() ?>" target="_blank"><?php echo mb_strimwidth(get_the_title(), 0, 24,"...") ?></a></h4>
                              </div>
                         </div>
                <?php endforeach; ?>                                                <!---结束循环--->
                <?php else : ?>
                         <div class="e1_1">
                              <img src="<?php bloginfo('template_url'); ?>/images/al1.jpg" />
                              <div class="e1_2">
                                   <h4><a href="<?php the_permalink() ?>">这里显示案例名称标题</a></h4>
                              </div>
                         </div>
                         <div class="e1_1">
                              <img src="<?php bloginfo('template_url'); ?>/images/al2.jpg" />
                              <div class="e1_2">
                                   <h4><a href="<?php the_permalink() ?>">这里显示案例名称标题</a></h4>
                              </div>
                         </div>
                         <div class="e1_1">
                              <img src="<?php bloginfo('template_url'); ?>/images/al3.jpg" />
                              <div class="e1_2">
                                   <h4><a href="<?php the_permalink() ?>">这里显示案例名称标题</a></h4>
                              </div>
                         </div>
                <?php endif; ?> 
                    </div>
               </div>
               <div class="d1_3"></div>
               
               <div class="d1_4">
                    <div class="e2">
                    <?php if (get_option('mytheme_dh_1')!=""): ?>
                        <?php echo get_option('mytheme_dh_1'); ?>
                    <?php else : ?>
                        0731-1234567
                    <?php endif; ?>
                    </div>
               </div>
          </div>
     </div>
     <div style="font: 0px/0px sans-serif;clear: both;display: block"> </div>
</div>


<?php get_footer(); ?>