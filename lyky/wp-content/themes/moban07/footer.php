<div id="footer">
     <div class="ym3">
          <div class="ym3_1">
               <div class="c1"></div>
               <?php wp_nav_menu(array( 'theme_location' => 'footer-menu' ) ); ?>
               <div class="c2"></div>
          </div>
          <div class="ym3_2">
               <div class="c3">
                    <div class="c3_1 f_bq">
                         <h3>COPYRIGHT</h3>
                         <p class="pf01">Copyright &copy;<?php echo date("Y"); echo " "; bloginfo('name'); ?>　版权所有 &copy; <?php bloginfo('name'); ?><br /><?php echo get_option('mytheme_icp_b');  ?></p>
                           <p><a href="http://www.themepark.com.cn" target="_blank" class="banquan">技术支持：WEB主题公园</a></p>
                    </div>
                    <div class="c3_2">
                         <h3>SHARE</h3>
                         <div class="fx">
                         <!-- JiaThis Button BEGIN -->
                         <div id="fenx">
	                          <a class="jiathis_button_qzone"></a>
	                          <a class="jiathis_button_tsina"></a>
	                          <a class="jiathis_button_tqq"></a>
	                          <a class="jiathis_button_renren"></a>
	                          <a class="jiathis_button_baidu"></a>
                              <a class="jiathis_button_taobao"></a>
	                          <a class="jiathis_button_kaixin001"></a>
	                          <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
                         </div>
                         <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=1346137794081482" charset="utf-8"></script>
                         <!-- JiaThis Button END -->
                         </div>
                    </div>
                    <div class="c3_3">
                    <?php 
                              $name = 'contact'; //page别名
                              global $wpdb;
                              $page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '$name'");
                              $page_data = get_page( $page_id )->post_content;?>
                         <a href="<? echo get_page_link( $page_id ); ?>"><img src="<?php bloginfo('template_url'); ?>/images/smn.png" /></a></div>
                    <div class="c3_4">
                         <?php if (get_option('mytheme_qq_1')!=""): ?>
                              <a class="qq4" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo get_option('mytheme_qq_1'); ?>&amp;site=qq&amp;menu=yes" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/qq.png" /></a>
                         <?php else : ?>
                              <a class="qq4" href="http://wpa.qq.com/msgrd?v=3&amp;uin=394448932&amp;site=qq&amp;menu=yes" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/qq.png" /></a>
                         <?php endif; ?>
                    </div>
               </div>
               <div class="c4">
                   <h3>CONTACT</h3>
                   <p class="dbwz1">
                        <?php if (get_option('mytheme_dh_1')!=""): ?>
                              TEL：<?php echo get_option('mytheme_dh_1'); ?>　<?php echo get_option('mytheme_dh_2'); ?>　<?php echo get_option('mytheme_dh_3'); ?><br />
                         <?php else : ?>
                              TEL：0731-1234567  0731-7654321<br />
                         <?php endif; ?>
                        <?php if (get_option('mytheme_dz_1')!=""): ?>
                              ADD：<?php echo get_option('mytheme_dz_1'); ?><br />
                         <?php else : ?>
                              ADD：这里输入您的详细地址如湖南省长沙市雨花区劳动中路华都小户型5楼<br />
                         <?php endif; ?>
                        <?php if (get_option('mytheme_em_1')!=""): ?>
                              E-mail：<a href="mailto:<?php echo get_option('mytheme_em_1'); ?>"><?php echo get_option('mytheme_em_1'); ?></a>
                         <?php else : ?>
                              E-mail：<a href="mailto:t-ducks@foxmail.com ">asdaasda@asd.com</a>
                         <?php endif; ?>
                   </p>
                   <p class="dbwz2">
                         <?php if (get_option('mytheme_lx_1')!=""): ?>
                              <?php echo get_option('mytheme_lx_1'); ?>
                         <?php else : ?>
                              公交路线：906/905/101/123/等东塘西站下车，正对立交桥右边即到。<br />自行路线：这里是路线描述请您输入详细路线谢谢。这里是路线描述请您输入详细路线谢谢这里是路线描述请您输入详细路线谢谢。
                         <?php endif; ?>
                         <?php echo stripslashes(get_option('mytheme_analytics')); ?>
                   </p>
               </div>
          </div>
     </div>
</div>
<div id="footer2">
     <div class="yqlj">   <?php wp_nav_menu(array('container' => false, 'theme_location' => 'link-menu2','menu_class'=> 'link-menu2' ) );?></div>
</div>

	<?php wp_footer(); ?>
	
	<!-- Don't forget analytics -->
	
</body>

</html>
