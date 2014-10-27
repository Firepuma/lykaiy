<?php get_header(); ?>
<div class="ny1" style="background:url(<?php bloginfo('template_url'); ?>/images/nb1.jpg) center">
     <div class="ny1_1"></div>
</div>
<div class="ny2">
     <!----正文---->
     <div class="newyb">
          <div class="sousu_1">
               <a>首页</a>
			   <a style="padding-right:10px;"><?php wp_title(''); ?></a>
          </div>
          <div class="k2">
               <div class="k2_1">
                    <div class="m1">News Title</div>
                    <div class="m2">Time</div>
               </div>
               <ul>
                    <?php $posts = query_posts($query_string . '&orderby=date&showposts=15'); ?>
                    <?php if (have_posts()) : ?>

		            <?php while (have_posts()) : the_post(); ?>

			         <div <?php post_class() ?> id="post-<?php the_ID(); ?>">

				          <li><h2>
						       <a href="<?php the_permalink() ?>"><?php the_title(); ?><b><?php the_time('20y-m-d')?></b></a>
                          </h2></li>

			         </div>

		             <?php endwhile; ?>

	                 <?php else : ?>

		             <div class="sousu_2"><img src="<?php bloginfo('template_url'); ?>/images/sou_2.jpg" /></div>

	            <?php endif; ?>
               </ul>
               <div class="k2_2"><?php par_pagenavi(); ?></div>
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
     <div class="newyb2"></div>
     <div style="font: 0px/0px sans-serif;clear: both;display: block"> </div>
</div>

<?php get_footer(); ?>
