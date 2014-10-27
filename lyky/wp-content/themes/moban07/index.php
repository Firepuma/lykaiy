<?php get_header(); ?>
       <script src="<?php bloginfo('template_url'); ?>/qplb/cufon-yui.js" type="text/javascript"></script>
        <script src="<?php bloginfo('template_url'); ?>/qplb/ChunkFive_400.font.js" type="text/javascript"></script>
		<script src="<?php bloginfo('template_url'); ?>/qplb/jquery.easing.1.3.js"  type="text/javascript"></script>
        <script src="<?php bloginfo('template_url'); ?>/qplb/qplbjs.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function() {
				var $pxs_container	= $('#pxs_container');
				$pxs_container.parallaxSlider();
			});
        </script>
        <script type="text/javascript"  charset=utf-8 src="<?php bloginfo('template_url'); ?>/js/lrscroll.js"></script> 
       
<div class="ym1">
		<div id="pxs_container" class="pxs_container">
			<div class="pxs_loading">Loading images...</div>
			<div class="pxs_slider_wrapper">
				<ul class="pxs_slider">
					<li style="background:
                    <?php if (get_option('mytheme_jdt1')!=""): ?>
                         url(<?php echo get_option('mytheme_jdt1'); ?>) center;">
                    <?php else : ?>
                         url(<?php bloginfo('template_url'); ?>/images/b1.jpg) center;">
				    <?php endif; ?>
                        <div class="gd1">
                             <div class="gd1_1" style="margin:167px 0 0 20px;">
                                  <h2>
                                  <?php if (get_option('mytheme_jdtbt1')!=""): ?>
                                       <?php echo get_option('mytheme_jdtbt1'); ?>
                                  <?php else : ?>
                                       显示图片标题
				                  <?php endif; ?>
                                  </h2>
                                  <div class="xtp">
                                  <?php if (get_option('mytheme_jdxt1')!=""): ?>
                                       <img src="<?php echo get_option('mytheme_jdxt1'); ?>"/>
                                  <?php else : ?>
                                       <img src="<?php bloginfo('template_url'); ?>/images/xb1.jpg"/>
				                  <?php endif; ?>
                                  </div>
                                  <p>
                                  <?php if (get_option('mytheme_jdtjj1')!=""): ?>
                                       <?php echo get_option('mytheme_jdtjj1'); ?>
                                  <?php else : ?>
                                       这里显示一段介绍文字如：通过相应功能截取关于我们页面中一段相关位子，以下是演示内容禁止拙劣的设计；禁止平庸的想法，这不仅是我们的口号，而且是我们严于律己的标准
				                  <?php endif; ?>
                                  </p>
                                  <div class="xlj">
                                  <?php if (get_option('mytheme_jdtlj1')!=""): ?>
                                       <a href="<?php echo get_option('mytheme_jdtlj1'); ?>" target="_blank">Click to view</a>
                                  <?php else : ?>
                                       <a href="#" target="_blank">Click to view</a>
				                  <?php endif; ?>
                                  </div>
                             </div>
                        </div>
                    </li>
					<li style="background:
                    <?php if (get_option('mytheme_jdt2')!=""): ?>
                         url(<?php echo get_option('mytheme_jdt2'); ?>) center;">
                    <?php else : ?>
                         url(<?php bloginfo('template_url'); ?>/images/b2.jpg) center;">
				    <?php endif; ?>
                        <div class="gd1">
                             <div class="gd1_1" style="margin:117px 0 0 520px;">
                                  <h2>
                                  <?php if (get_option('mytheme_jdtbt2')!=""): ?>
                                       <?php echo get_option('mytheme_jdtbt2'); ?>
                                  <?php else : ?>
                                       显示图片标题
				                  <?php endif; ?>
                                  </h2>
                                  <div class="xtp">
                                  <?php if (get_option('mytheme_jdxt2')!=""): ?>
                                       <img src="<?php echo get_option('mytheme_jdxt2'); ?>"/>
                                  <?php else : ?>
                                       <img src="<?php bloginfo('template_url'); ?>/images/xb2.jpg"/>
				                  <?php endif; ?>
                                  </div>
                                  <p>
                                  <?php if (get_option('mytheme_jdtjj2')!=""): ?>
                                       <?php echo get_option('mytheme_jdtjj2'); ?>
                                  <?php else : ?>
                                       这里显示一段介绍文字如：通过相应功能截取关于我们页面中一段相关位子，以下是演示内容禁止拙劣的设计；禁止平庸的想法，这不仅是我们的口号，而且是我们严于律己的标准
				                  <?php endif; ?>
                                  </p>
                                  <div class="xlj">
                                  <?php if (get_option('mytheme_jdtlj2')!=""): ?>
                                       <a href="<?php echo get_option('mytheme_jdtlj2'); ?>" target="_blank">Click to view</a>
                                  <?php else : ?>
                                       <a href="#" target="_blank">Click to view</a>
				                  <?php endif; ?>
                                  </div>
                             </div>
                        </div>
                    </li>
                    <li style="background:
                    <?php if (get_option('mytheme_jdt3')!=""): ?>
                         url(<?php echo get_option('mytheme_jdt3'); ?>) center;">
                    <?php else : ?>
                         url(<?php bloginfo('template_url'); ?>/images/b3.jpg) center;">
				    <?php endif; ?>
                        <div class="gd1">
                             <div class="gd1_1" style="margin:107px 0 0 630px;">
                                  <h2>
                                  <?php if (get_option('mytheme_jdtbt3')!=""): ?>
                                       <?php echo get_option('mytheme_jdtbt3'); ?>
                                  <?php else : ?>
                                       显示图片标题
				                  <?php endif; ?>
                                  </h2>
                                  <div class="xtp">
                                  <?php if (get_option('mytheme_jdxt3')!=""): ?>
                                       <img src="<?php echo get_option('mytheme_jdxt3'); ?>"/>
                                  <?php else : ?>
                                       <img src="<?php bloginfo('template_url'); ?>/images/xb3.jpg"/>
				                  <?php endif; ?>
                                  </div>
                                  <p>
                                  <?php if (get_option('mytheme_jdtjj3')!=""): ?>
                                       <?php echo get_option('mytheme_jdtjj3'); ?>
                                  <?php else : ?>
                                       这里显示一段介绍文字如：通过相应功能截取关于我们页面中一段相关位子，以下是演示内容禁止拙劣的设计；禁止平庸的想法，这不仅是我们的口号，而且是我们严于律己的标准
				                  <?php endif; ?>
                                  </p>
                                  <div class="xlj">
                                  <?php if (get_option('mytheme_jdtlj3')!=""): ?>
                                       <a href="<?php echo get_option('mytheme_jdtlj3'); ?>" target="_blank">Click to view</a>
                                  <?php else : ?>
                                       <a href="#" target="_blank">Click to view</a>
				                  <?php endif; ?>
                                  </div>
                             </div>
                        </div>
                    </li>
                    <li style="background:
                    <?php if (get_option('mytheme_jdt4')!=""): ?>
                         url(<?php echo get_option('mytheme_jdt4'); ?>) center;">
                    <?php else : ?>
                         url(<?php bloginfo('template_url'); ?>/images/b4.jpg) center;">
				    <?php endif; ?>
                        <div class="gd1">
                             <div class="gd1_1" style="margin:167px 0 0 20px;">
                                  <h2>
                                  <?php if (get_option('mytheme_jdtbt4')!=""): ?>
                                       <?php echo get_option('mytheme_jdtbt4'); ?>
                                  <?php else : ?>
                                       显示图片标题
				                  <?php endif; ?>
                                  </h2>
                                  <div class="xtp">
                                  <?php if (get_option('mytheme_jdxt4')!=""): ?>
                                       <img src="<?php echo get_option('mytheme_jdxt4'); ?>"/>
                                  <?php else : ?>
                                       <img src="<?php bloginfo('template_url'); ?>/images/xb4.jpg"/>
				                  <?php endif; ?>
                                  </div>
                                  <p>
                                  <?php if (get_option('mytheme_jdtjj4')!=""): ?>
                                       <?php echo get_option('mytheme_jdtjj4'); ?>
                                  <?php else : ?>
                                       这里显示一段介绍文字如：通过相应功能截取关于我们页面中一段相关位子，以下是演示内容禁止拙劣的设计；禁止平庸的想法，这不仅是我们的口号，而且是我们严于律己的标准
				                  <?php endif; ?>
                                  </p>
                                  <div class="xlj">
                                  <?php if (get_option('mytheme_jdtlj4')!=""): ?>
                                       <a href="<?php echo get_option('mytheme_jdtlj4'); ?>" target="_blank">Click to view</a>
                                  <?php else : ?>
                                       <a href="#" target="_blank">Click to view</a>
				                  <?php endif; ?>
                                  </div>
                             </div>
                        </div>
                    </li>
				</ul>
				<div class="pxs_navigation">
					<span class="pxs_next"></span>
					<span class="pxs_prev"></span>
                </div>
                <div class="ys11">
				<ul class="pxs_thumbnails">
					<li class="ys1"><img src="<?php bloginfo('template_url'); ?>/images/x1.png" alt="First Image" /></li>
					<li class="ys2"><img src="<?php bloginfo('template_url'); ?>/images/x1.png" alt="Second Image" /></li>
					<li class="ys3"><img src="<?php bloginfo('template_url'); ?>/images/x1.png" alt="Third Image" /></li>
					<li class="ys4"><img src="<?php bloginfo('template_url'); ?>/images/x1.png" alt="Forth Image" /></li>
				</ul>
                </div>
			</div>
            <div class="yy"></div>
		</div>
</div>

<div class="ym1_1"></div>
<div class="ym2">
     <div class="ym2_1">
          <div class="a1">
               <h2><a class="wz2">news</a> <a class="wz1">新闻动态</a></h2>
               <div class="a1_1">
                    <div id="s3" class="scrollDiv">
                    <?php
                        $cat=get_category_by_slug('company-news'); //获取分类别名为 wordpress 的分类数据
                        $cat_links=get_category_link($cat->term_id); // 通过$cat数组里面的分类id获取分类链接
                    ?>
                    <?php $posts = get_posts( "category=($cat->term_id)&numberposts=5" ); ?>
                        <?php if( $posts ) : ?><!------判断如果有文章--->
                        <ul>
                        <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>      <!----循环开始---->
                             <li>
                                <h2><a href="<?php the_permalink() ?>"><?php echo mb_strimwidth(get_the_title(), 0, 40,"...") ?></a></h2>
                                <b><?php the_time('20y-m-d')?></b>
                             </li>
                        <?php endforeach; ?>                                                <!---结束循环--->
                        <?php else : ?>
                            <li>
                                <h2><a href="<?php the_permalink() ?>">这里我们制作了一个可以上下滚动的新闻展示组件，这里可以...</a></h2>
                                <b>2013-02-02</b>
                             </li>
                             <li>
                                <h2><a href="<?php the_permalink() ?>">这里我们制作了一个可以上下滚动的新闻展示组件，这里可以...</a></h2>
                                <b>2013-02-02</b>
                             </li>
                             <li>
                                <h2><a href="<?php the_permalink() ?>">这里我们制作了一个可以上下滚动的新闻展示组件，这里可以...</a></h2>
                                <b>2013-02-02</b>
                             </li>
                        </ul>
                        <?php endif; ?> 
                    </div>
                    <div class="a1_2">
                         <span id="btn2"><img src="<?php bloginfo('template_url'); ?>/images/new_1.png" /></span>
                         <span id="btn1"><img src="<?php bloginfo('template_url'); ?>/images/new_2.png" /></span>
                    </div>
               </div>
          </div>
          <div class="a2">
                <h2><a class="wz2">Search</a> <a class="wz1">站内搜索</a></h2>
                <div class="a2_1">
                     <form action="<?php bloginfo('siteurl'); ?>" id="searchform" method="get">
                         <div class="a2_2">关键字：</div>
                         <input type="text" id="s" name="s" value="" />
                         <input type="submit" value="" id="searchsubmit" />
                     </form>
                </div>
          </div>
     </div>
     
     <div class="ym2_2">
          <div class="a3">
               <h2><a class="wz2">Search</a> <a class="wz1">站内搜索</a></h2>
               <div class="a3_1">
                    <div class="a3_2">
                        <div class="a3_3"><img src="<?php bloginfo('template_url'); ?>/images/tu1.jpg" /></div>
                        <div class="a3_4">
                             <ul><h2>企业介绍</h2><p>introduction</p></ul>
                              <?php 
                              $name = 'about-us'; //page别名
                              global $wpdb;
                              $page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '$name'");
                              $page_data = get_page( $page_id )->post_content;?>
                             <p><?php echo   mb_strimwidth(strip_tags($page_data), 0,164,"..."); ?></p>
                             <div class="ckgd1"><a href="<? echo get_page_link( $page_id ); ?>">—— Click to view</a></div>
                        </div>
                    </div>
               </div>
          </div>
          <div class="a4">
               <h2><a class="wz2">video</a> <a class="wz1">视频播放</a></h2>
               <div class="a4_1">
                    <div class="sp">
                    <?php if (get_option('mytheme_spbf')!=""): ?>  
                          <?php echo stripslashes(get_option('mytheme_spbf')); ?>
                    <?php else : ?>
                          <embed src="http://www.tudou.com/v/JR6tmNonORg/&resourceId=0_05_05_99&bid=05/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque" width="100%" height="100%"></embed>
				    <?php endif; ?>
                    </div>
               </div>
               <div class="a4_2">
                    <h3>Way of contact</h3>
                    <div class="tub">
                         <?php 
                              $name = 'contact'; //page别名
                              global $wpdb;
                              $page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '$name'");
                         $page_data = get_page( $page_id )->post_content;?>
                         <div class="tub_1"><a href="<? echo get_page_link( $page_id ); ?>"><img src="<?php bloginfo('template_url'); ?>/images/tb1.png" /></a></div>
                         <div class="tub_1">
                         <?php if (get_option('mytheme_em_1')!=""): ?>
                              <a href="mailto:<?php echo get_option('mytheme_em_1'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/tb2.png" /></a>
                         <?php else : ?>
                              <a href="mailto:t-ducks@foxmail.com "><img src="<?php bloginfo('template_url'); ?>/images/tb2.png" /></a>
                         <?php endif; ?>
                         </div>
                         <div class="tub_1">
                         <?php if (get_option('mytheme_qq_1')!=""): ?>
                              <a class="qq4" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo get_option('mytheme_qq_1'); ?>&amp;site=qq&amp;menu=yes" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/tb3.png" /></a>
                         <?php else : ?>
                              <a class="qq4" href="http://wpa.qq.com/msgrd?v=3&amp;uin=394448932&amp;site=qq&amp;menu=yes" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/tb3.png" /></a>
                         <?php endif; ?>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     
     <div class="ym2_3">
          <div class="a5">
          <?php
            $cat=get_category_by_slug('company-case'); //获取分类别名为 wordpress 的分类数据
            $cat_links=get_category_link($cat->term_id); // 通过$cat数组里面的分类id获取分类链接
          ?>
               <h2><a class="wz4">case</a> <a class="wz3">案例展示</a></h2>
               <div class="a5_1">
                    <div class="b1">
                    <a href="<?php echo $cat_links; ?>">Click to view</a></div>
               </div>
          </div>
          <div class="a6">
          <?php $posts = get_posts( "category=($cat->term_id)&numberposts=5" ); ?>
          <?php if( $posts ) : ?><!------判断如果有文章--->
             <ul>
          <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>      <!----循环开始---->
               <li>
                    <div class="sycp">
                        <div class="a6_1"><?php the_post_thumbnail('thumbnail'); ?></div>
                        <h3><a href="<?php the_permalink() ?>" target="_blank"><?php echo mb_strimwidth(get_the_title(), 0, 14,"...") ?></a></h3>
                        <p><a href="<?php the_permalink() ?>" target="_blank"><?php echo mb_strimwidth(strip_tags($post->post_content), 0,66,"..."); ?></a></p>
                        <div class="week_bok"><a href="<?php the_permalink() ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/cpbj2.png" /></a></div>
                    </div>
               </li>
          <?php endforeach; ?>                                                <!---结束循环--->
          <?php else : ?>
               <li>
                    <div class="sycp">
                        <div class="a6_1"><img src="<?php bloginfo('template_url'); ?>/images/cp1.jpg" /></div>
                        <h3><a href="<?php the_permalink() ?>">案例标题名称</a></h3>
                        <p><a href="<?php the_permalink() ?>">案例描述内容调用组件，通过相应功能截取描述中一段相关文章子显示…</a></p>
                        <div class="week_bok"><a href="<?php the_permalink() ?>"><img src="<?php bloginfo('template_url'); ?>/images/cpbj2.png" /></a></div>
                    </div>
               </li>
               <li>
                    <div class="sycp">
                        <div class="a6_1"><img src="<?php bloginfo('template_url'); ?>/images/cp1.jpg" /></div>
                        <h3><a href="<?php the_permalink() ?>">案例标题名称</a></h3>
                        <p><a href="<?php the_permalink() ?>">案例描述内容调用组件，通过相应功能截取描述中一段相关文章子显示…</a></p>
                        <div class="week_bok"><a href="<?php the_permalink() ?>"><img src="<?php bloginfo('template_url'); ?>/images/cpbj2.png" /></a></div>
                    </div>
               </li>
               <li>
                    <div class="sycp">
                        <div class="a6_1"><img src="<?php bloginfo('template_url'); ?>/images/cp1.jpg" /></div>
                        <h3><a href="<?php the_permalink() ?>">案例标题名称</a></h3>
                        <p><a href="<?php the_permalink() ?>">案例描述内容调用组件，通过相应功能截取描述中一段相关文章子显示…</a></p>
                        <div class="week_bok"><a href="<?php the_permalink() ?>"><img src="<?php bloginfo('template_url'); ?>/images/cpbj2.png" /></a></div>
                    </div>
               </li>
               <li>
                    <div class="sycp">
                        <div class="a6_1"><img src="<?php bloginfo('template_url'); ?>/images/cp1.jpg" /></div>
                        <h3><a href="<?php the_permalink() ?>">案例标题名称</a></h3>
                        <p><a href="<?php the_permalink() ?>">案例描述内容调用组件，通过相应功能截取描述中一段相关文章子显示…</a></p>
                        <div class="week_bok"><a href="<?php the_permalink() ?>"><img src="<?php bloginfo('template_url'); ?>/images/cpbj2.png" /></a></div>
                    </div>
               </li>
               <li>
                    <div class="sycp">
                        <div class="a6_1"><img src="<?php bloginfo('template_url'); ?>/images/cp1.jpg" /></div>
                        <h3><a href="<?php the_permalink() ?>">案例标题名称</a></h3>
                        <p><a href="<?php the_permalink() ?>">案例描述内容调用组件，通过相应功能截取描述中一段相关文章子显示…</a></p>
                        <div class="week_bok"><a href="<?php the_permalink() ?>"><img src="<?php bloginfo('template_url'); ?>/images/cpbj2.png" /></a></div>
                    </div>
               </li>
          </ul>
          <?php endif; ?> 
          </div>
     </div>
</div>


<?php get_footer(); ?>
