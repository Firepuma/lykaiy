<?php get_header(); ?>

<div class="ny1" style="background:url(<?php bloginfo('template_url'); ?>/images/nb1.jpg) center">
     <div class="ny1_1"></div>
</div>
<div class="ny2">
     <!----侧栏---->
     <div class="zb">
          <div class="d1">
               <div class="d1_1">FAST NAVIGATION</div>
               <div class="d1_2">
                              <?php
                              $cat=get_category_by_slug('company-case'); //获取分类别名为 wordpress 的分类数据
							  $cat_links=get_category_link($cat->term_id); // 通过$cat数组里面的分类id获取分类链接
                              ?>
                              <?php if (is_category('company-case')): ?>
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
     <!----正文---->
     <div class="yb">
          <div class="o1"><img src="<?php bloginfo('template_url'); ?>/images/albt.png" /></div>
          <div class="o2">
               <ul>
               <?php $posts = query_posts($query_string . '&orderby=date&showposts=9'); ?>
               <?php if( $posts ) : ?>
               <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
                    <li>
                         <div class="o2_1">
                              <a href="<?php the_permalink() ?>" target="_blank">
                                   <?php the_post_thumbnail('thumbnail'); ?>
                              </a>
                         </div>
                         <h3><a href="<?php the_permalink() ?>"><span><?php echo mb_strimwidth(get_the_title(), 0, 20,"...") ?></span><br />TIEM:<?php the_time('20y-m-d')?></a></h3>
                    </li>
               <?php endforeach; ?>
               <?php else : ?>
                    <li>
                         <div class="o2_1">
                              <a href="<?php bloginfo('template_url'); ?>/images/1.jpg" rel="lightbox[set_3]" class="case_img">
                                   <img src="<?php bloginfo('template_url'); ?>/images/cp1.jpg" />
                              </a>
                         </div>
                         <h3><a href="<?php the_permalink() ?>"><span>案例展示标题</span><br />TIEM:2012-02-02</a></h3>
                    </li>
                    <li>
                         <div class="o2_1">
                              <a href="<?php bloginfo('template_url'); ?>/images/1.jpg" rel="lightbox[set_3]" class="case_img">
                                   <img src="<?php bloginfo('template_url'); ?>/images/cp1.jpg" />
                              </a>
                         </div>
                         <h3><a href="<?php the_permalink() ?>"><span>案例展示标题</span><br />TIEM:2012-02-02</a></h3>
                    </li>
                    <li>
                         <div class="o2_1">
                              <a href="<?php bloginfo('template_url'); ?>/images/1.jpg" rel="lightbox[set_3]" class="case_img">
                                   <img src="<?php bloginfo('template_url'); ?>/images/cp1.jpg" />
                              </a>
                         </div>
                         <h3><a href="<?php the_permalink() ?>"><span>案例展示标题</span><br />TIEM:2012-02-02</a></h3>
                    </li>
                    <li>
                         <div class="o2_1">
                              <a href="<?php bloginfo('template_url'); ?>/images/1.jpg" rel="lightbox[set_3]" class="case_img">
                                   <img src="<?php bloginfo('template_url'); ?>/images/cp1.jpg" />
                              </a>
                         </div>
                         <h3><a href="<?php the_permalink() ?>"><span>案例展示标题</span><br />TIEM:2012-02-02</a></h3>
                    </li>
                    <li>
                         <div class="o2_1">
                              <a href="<?php bloginfo('template_url'); ?>/images/1.jpg" rel="lightbox[set_3]" class="case_img">
                                   <img src="<?php bloginfo('template_url'); ?>/images/cp1.jpg" />
                              </a>
                         </div>
                         <h3><a href="<?php the_permalink() ?>"><span>案例展示标题</span><br />TIEM:2012-02-02</a></h3>
                    </li>
                    <li>
                         <div class="o2_1">
                              <a href="<?php bloginfo('template_url'); ?>/images/1.jpg" rel="lightbox[set_3]" class="case_img">
                                   <img src="<?php bloginfo('template_url'); ?>/images/cp1.jpg" />
                              </a>
                         </div>
                         <h3><a href="<?php the_permalink() ?>"><span>案例展示标题</span><br />TIEM:2012-02-02</a></h3>
                    </li>
                    <li>
                         <div class="o2_1">
                              <a href="<?php bloginfo('template_url'); ?>/images/1.jpg" rel="lightbox[set_3]" class="case_img">
                                   <img src="<?php bloginfo('template_url'); ?>/images/cp1.jpg" />
                              </a>
                         </div>
                         <h3><a href="<?php the_permalink() ?>"><span>案例展示标题</span><br />TIEM:2012-02-02</a></h3>
                    </li>
                    <li>
                         <div class="o2_1">
                              <a href="<?php bloginfo('template_url'); ?>/images/1.jpg" rel="lightbox[set_3]" class="case_img">
                                   <img src="<?php bloginfo('template_url'); ?>/images/cp1.jpg" />
                              </a>
                         </div>
                         <h3><a href="<?php the_permalink() ?>"><span>案例展示标题</span><br />TIEM:2012-02-02</a></h3>
                    </li>
                    <li>
                         <div class="o2_1">
                              <a href="<?php bloginfo('template_url'); ?>/images/1.jpg" rel="lightbox[set_3]" class="case_img">
                                   <img src="<?php bloginfo('template_url'); ?>/images/cp1.jpg" />
                              </a>
                         </div>
                         <h3><a href="<?php the_permalink() ?>"><span>案例展示标题</span><br />TIEM:2012-02-02</a></h3>
                    </li>
               <?php  endif; ?>
               </ul>
               <div class="k2_2"><?php par_pagenavi(); ?> </div>
          </div>
          <div class="f3">
              <div class="n1">
                   <div class="n1_1">
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
     </div>
     <div style="font: 0px/0px sans-serif;clear: both;display: block"> </div>
</div>

<?php get_footer(); ?>
