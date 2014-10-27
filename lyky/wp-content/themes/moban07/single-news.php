<?php get_header(); ?>
<div class="ny1" style="background:url(<?php bloginfo('template_url'); ?>/images/nb1.jpg) center">
     <div class="ny1_1"></div>
</div>
<div class="ny2">
     <!----正文---->
      <div class="yb">
          <div class="f1">
               <h2><?php
                  $cat=get_category_by_slug('company-news'); //获取分类别名为 wordpress 的分类数据
			      echo $cat->name;
                  ?></h2>
               <div class="f1_1">
                  <a>首页</a>
                  <a><?php
                  $cat=get_category_by_slug('company-news'); //获取分类别名为 wordpress 的分类数据
			      echo $cat->name;
                  ?></a>
				  <a style=" color:#0099FF;">文章内容</a>
               </div>
          </div>
          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <div class="f2">
               <h3><?php the_title(''); ?></h3>
               <?php the_content(); ?>
               <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
          </div>
          <div class="k4">
               <div class="k4_1">
                    <li>更新时间：<?php the_time('20y-m-d H:i')?></li>
                    <li>发布者：<?php the_author(); ?></li>
                    <li>
                        <div class="fxx">分享到：</div>
                        <div id="ckepop">
	                         <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt" target="_blank">
                                  <img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border="0" />
                             </a>
                             <a class="jiathis_counter_style_margin:3px 0 0 2px"></a>
                        </div>
                    </li>
               </div>
          </div>
          <div class="f3">
              <div class="n1">
                   <div class="n1_1">
                       <?php if (get_next_post($categoryIDS)) { next_post_link('<div class="sxyp_1">上一篇：</div> %link','%title',true);} else { echo '<div class="sxyp_1">上一篇：已是最新文章</div>';} ?><br />
                       <?php if (get_previous_post($categoryIDS)) { previous_post_link('<div class="sxyp_1">下一篇：</div> %link','%title',true);} else { echo '<div class="sxyp_1">下一篇：已是最后文章</div>';} ?>
                   </div>
                   <div class="n1_2"><img src="<?php bloginfo('template_url'); ?>/images/ct5.png" /></div>
              </div>
              <div class="n2">
                   <div class="spbf_002">
                   <?php if (get_option('mytheme_spbf')!=""): ?>
                          <?php echo stripslashes(get_option('mytheme_spbf')); ?>
                    <?php else : ?>
                          <embed src="http://www.tudou.com/v/JR6tmNonORg/&resourceId=0_05_05_99&bid=05/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque" width="100%" height="100%"></embed>
				    <?php endif; ?>
                   </div>
              </div>
          </div>
          <?php endwhile; endif; ?>
     </div>
     <!----侧栏---->
     <div class="zb">
          <div class="d1">
               <div class="d1_1">FAST NAVIGATION</div>
               <div class="d1_2">
                              <?php
                              $cat=get_category_by_slug('company-news'); //获取分类别名为 wordpress 的分类数据
							  $cat_links=get_category_link($cat->term_id); // 通过$cat数组里面的分类id获取分类链接
                              ?>
                              <?php if (is_category('company-news')): ?>
                                   <ul><li class="current_page_item"><a href="<?php echo $cat_links; ?>"><?php echo $cat->name; ?></a></li>
                              <?php else : ?>
                                   <ul><li><a href="<?php echo $cat_links; ?>"><?php echo $cat->name; ?></a></li>
                              <?php endif;?>
                              <?php echo wp_list_categories("child_of=".$cat->term_id."&depth=0&hide_empty=0&title_li=");?></ul>
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
