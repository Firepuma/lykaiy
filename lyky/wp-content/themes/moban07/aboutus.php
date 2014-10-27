<?php  
/* 
Template Name:aboutus
*/  
?> 


<?php get_header(); ?>
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
              <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		       <?php the_content(); ?>
              <?php endwhile; endif; ?>
          </div>
     </div>
      <!----侧栏---->
     <div class="zb">
          <div class="d1">
               <div class="d1_1">FAST NAVIGATION</div>
               <div class="d1_2">
               <?php if (is_page('about-us')): ?>
                     <ul><li class="current_page_item"><a href="<?php the_permalink() ?>"><?php wp_title(''); ?></a></li>
               <?php else : ?>
                     <ul><li><a href="<?php 
							$name = 'about-us'; //page别名
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
     <!---->
     <div class="f3">
               <div class="f3_1">
                    <div class="g1"><img src="<?php bloginfo('template_url'); ?>/images/ct1.png" /></div>
                    <div class="g2">
                         <div class="spbf_001">
                         <?php if (get_option('mytheme_spbf')!=""): ?>
                          <?php echo stripslashes(get_option('mytheme_spbf')); ?>
                    <?php else : ?>
                          <embed src="http://www.tudou.com/v/JR6tmNonORg/&resourceId=0_05_05_99&bid=05/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque" width="100%" height="100%"></embed>
				    <?php endif; ?>
                         </div>
                    </div>
               </div>
               <div class="f3_2">
                    <div class="g3"><img src="<?php bloginfo('template_url'); ?>/images/ct3.png" /></div>
                    <div class="g4">
                         <div class="g4_1">
                              <h3>最新动态</h3>
                              <?php
                              $cat=get_category_by_slug('company-news'); //获取分类别名为 wordpress 的分类数据
                              $cat_links=get_category_link($cat->term_id); // 通过$cat数组里面的分类id获取分类链接
                              ?>
                              <?php $posts = get_posts( "category=($cat->term_id)&numberposts=5" ); ?>
                              <?php if( $posts ) : ?><!------判断如果有文章--->
                              <ul>
                              <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>      <!----循环开始---->
                                  <li><a href="<?php the_permalink() ?>"><?php echo mb_strimwidth(get_the_title(), 0, 24,"...") ?></a></li>
                              <?php endforeach; ?>                                                <!---结束循环--->
                              <?php else : ?>
                                  <li><a href="<?php the_permalink() ?>">行的建站程序—wordpres</a></li>
                                  <li><a href="<?php the_permalink() ?>">的原创中文主题和</a></li>
                                  <li><a href="<?php the_permalink() ?>">中文模板，这是一种非</a></li>
                                  <li><a href="<?php the_permalink() ?>">常具有优势的建站程序</a></li>
                              </ul>
                              <?php endif; ?> 
                         </div>
                         <div class="g4_2">
                              <h3>联系方式</h3>
                              <p>
                              <?php if (get_option('mytheme_dh_1')!=""): ?>
                                  TEL：<?php echo get_option('mytheme_dh_1'); ?><br />
                              <?php else : ?>
                                  TEL：0731-1234567<br />
                              <?php endif; ?>
                              <?php if (get_option('mytheme_cz_1')!=""): ?>
                                  EAX：<?php echo get_option('mytheme_cz_1'); ?><br />
                              <?php else : ?>
                                  EAX：+010-12345678<br />
                              <?php endif; ?>
                              <?php if (get_option('mytheme_em_1')!=""): ?>
                                  E-mail：<?php echo get_option('mytheme_em_1'); ?>
                               <?php else : ?>
                                  E-mail：online@xxxxxx.com
                               <?php endif; ?>
                               </p>
                              <ul>
                                  <?php if (get_option('mytheme_qq_1')!=""): ?>
                                     <li><a class="qq4" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo get_option('mytheme_qq_1'); ?>&amp;site=qq&amp;menu=yes" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/qqtb1.png" /></a></li>
                                 <?php else : ?>
                                     <li><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/qqtb1.png" /></a></li>
                                  <?php endif; ?>
                                  <?php if (get_option('mytheme_qq_2')!=""): ?>
                                     <li><a class="qq4" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo get_option('mytheme_qq_2'); ?>&amp;site=qq&amp;menu=yes" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/qqtb2.png" /></a></li>
                                 <?php else : ?>
                                     <li><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/qqtb2.png" /></a></li>
                                  <?php endif; ?>
                                  <?php if (get_option('mytheme_qq_3')!=""): ?>
                                     <li><a class="qq4" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo get_option('mytheme_qq_3'); ?>&amp;site=qq&amp;menu=yes" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/qqtb3.png" /></a></li>
                                 <?php else : ?>
                                     <li><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/qqtb3.png" /></a></li>
                                  <?php endif; ?>
                                  <?php if (get_option('mytheme_em_1')!=""): ?>
                                     <li><a href="mailto:<?php echo get_option('mytheme_em_1'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/msntb1.png" /></a></li>
                                  <?php else : ?>
                                     <li><a href="#"><img src="<?php bloginfo('template_url'); ?>/images/msntb1.png" /></a></li>
                                  <?php endif; ?>
                              </ul>
                         </div>
                    </div>
               </div>
          </div>
     <div style="font: 0px/0px sans-serif;clear: both;display: block"> </div>
</div>


<?php get_footer(); ?>