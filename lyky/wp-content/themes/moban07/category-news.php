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
     <!----正文---->
     <div class="newyb">
          <div class="k1">
               <a>首页</a>
               <a><?php
               $cat=get_category_by_slug('company-news'); //获取分类别名为 wordpress 的分类数据
			   echo $cat->name;
               ?></a>
			   <a style="padding-right:10px;"><?php wp_title(''); ?></a>
          </div>
          <div class="k2">
               <div class="k2_1">
                    <div class="m1">News Title</div>
                    <div class="m2">Time</div>
               </div>
               <ul>
               <?php $posts = query_posts($query_string . '&orderby=date&showposts=15'); ?>
               <?php if( $posts ) : ?>
               <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
                    <li>
                        <h3>
                            <a href="<?php the_permalink() ?>"><?php echo mb_strimwidth(get_the_title(), 0, 60,"...") ?></a><b><?php the_time('20y-m-d')?></b>
                        </h3>
                    </li>
               <?php endforeach; ?>
               <?php else : ?>
                    <li>
                        <h3>
                            <a href="<?php the_permalink() ?>">柯达将出售胶卷和相纸业务？</a><b>2012-02-02</b>
                        </h3>
                    </li>
                    <li>
                        <h3>
                            <a href="<?php the_permalink() ?>">奥林巴斯或将发布两款PEN系列相机与两款单反<b>2012-02-02</b></a>
                        </h3>
                    </li>
                    <li>
                        <h3>
                            <a href="<?php the_permalink() ?>">新摄影论坛使用规则及指南<b>2012-02-02</b></a>
                        </h3>
                    </li>
                    <li>
                        <h3>
                            <a href="<?php the_permalink() ?>">最易上手的图像处理软件：“好照片”桌面版，摄影后期必备！<b>2012-02-02</b></a>
                        </h3>
                    </li>
                    <li>
                        <h3>
                            <a href="<?php the_permalink() ?>">就是要印-随心设计属于自己的影集！<b>2012-02-02</b></a>
                        </h3>
                    </li>
                    <li>
                        <h3>
                            <a href="<?php the_permalink() ?>">新摄影iPhone版客户端正式上线 把摄影资讯装进口袋<b>2012-02-02</b></a>
                        </h3>
                    </li>
                    <li>
                        <h3>
                            <a href="<?php the_permalink() ?>">[2012金秋喀纳斯+禾木+胡杨林12日深度摄影创作活动开始报名了<b>2012-02-02</b></a>
                        </h3>
                    </li>
                    <li>
                        <h3>
                            <a href="<?php the_permalink() ?>">仅1元！原价180元雅趣摄影3小时课程<b>2012-02-02</b></a>
                        </h3>
                    </li>
                    <li>
                        <h3>
                            <a href="<?php the_permalink() ?>">就是要印-随心设计属于自己的影集！<b>2012-02-02</b></a>
                        </h3>
                    </li>
                    <li>
                        <h3>
                            <a href="<?php the_permalink() ?>">新摄影iPhone版客户端正式上线 把摄影资讯装进口袋<b>2012-02-02</b></a>
                        </h3>
                    </li>
                    <li>
                        <h3>
                            <a href="<?php the_permalink() ?>">[2012金秋喀纳斯+禾木+胡杨林12日深度摄影创作活动开始报名了<b>2012-02-02</b></a>
                        </h3>
                    </li>
                    <li>
                        <h3>
                            <a href="<?php the_permalink() ?>">仅1元！原价180元雅趣摄影3小时课程<b>2012-02-02</b></a>
                        </h3>
                    </li>
                    <li>
                        <h3>
                            <a href="<?php the_permalink() ?>">奥林巴斯或将发布两款PEN系列相机与两款单反<b>2012-02-02</b></a>
                        </h3>
                    </li>
                    <li>
                        <h3>
                            <a href="<?php the_permalink() ?>">新摄影论坛使用规则及指南<b>2012-02-02</b></a>
                        </h3>
                    </li>
               <?php  endif; ?>
               </ul>
               <div class="k2_2"><?php par_pagenavi(); ?> </div>
          </div>
     </div>
     <div class="newyb2"></div>
     <div style="font: 0px/0px sans-serif;clear: both;display: block"> </div>
</div>

<?php get_footer(); ?>
