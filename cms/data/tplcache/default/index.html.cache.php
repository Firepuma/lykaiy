<?php include $this->_include('header.html'); ?>

<div class="mainbody index">
<!--sql调用演示 #xiaocms_表示表前缀
					<?php $return = $this->_listdata("sql=SELECT * FROM  `#xiaocms_category` LIMIT 0 , 30"); extract($return); if (is_array($return))  foreach ($return as $key=>$xiao) {  echo $xiao['catname'];  } ?>
-->

        <div class="w710 fl">
            <div class="banner">
                <!--调用区块代码就简单了 后面跟着的就是区块ID 一看便知-->
                <div id="slideBox" class="slideBox">
                    <div class="hd">
                        <ul><li>1</li><li>2</li><li>3</li></ul>
                    </div>
                    <div class="bd">
                        <ul>
                            <li><a href="" target="_blank"><img src="<?php $this->block(1);?>" /></a></li>
                            <li><a href="" target="_blank"><img src="<?php $this->block(2);?>" /></a></li>
                            <li><a href="" target="_blank"><img src="<?php $this->block(3);?>" /></a></li>
                        </ul>
                    </div>

                    <!-- 下面是前/后按钮代码，如果不需要删除即可 -->
                    <a class="prev" href="javascript:void(0)"></a>
                    <a class="next" href="javascript:void(0)"></a>
                </div>

                <script id="jsID" type="text/javascript">
                    jQuery(".slideBox").slide({mainCell:".bd ul",effect:"leftLoop",autoPlay:true,delayTime:1000,interTime:4000});
                </script>
            </div>
            <div class="blank10 clear"></div>
            <div class="picMarquee-left picMarquee-transport">
                <div class="hd">
                    <h3>矿山运输工具</h3>
                    <a class="next"></a>
                    <a class="prev"></a>
                </div>
                <div class="bd transport">
                    <ul class="picList">
                        <?php $return = $this->_listdata("catid=20  num=10  cache=60"); extract($return); if (is_array($return))  foreach ($return as $key=>$xiao) { ?>
                        <li>
                            <div class="pic">
                                <a href="<?php echo $xiao['url']; ?>" target="_blank">
                                    <img src="<?php echo thumb($xiao[thumb],100,100); ?>" /><br/>
                                    <div class="title"><?php echo $xiao['title']; ?></div>
                                </a>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="blank10 clear"></div>

            </div>
            <script  type="text/javascript">
                jQuery(".picMarquee-transport").slide({mainCell:".transport ul",autoPlay:true,effect:"leftMarquee",vis:4,interTime:50,trigger:"click"});
            </script>
            <div class="blank10 clear"></div>
            <div class="picMarquee-left picMarquee-support">
                <div class="hd support">
                    <h3>矿用支护产品</h3>
                    <a class="next"></a>
                    <a class="prev"></a>
                </div>
                <div class="bd">
                    <ul class="picList">
                        <?php $return = $this->_listdata("catid=19  num=10  cache=60"); extract($return); if (is_array($return))  foreach ($return as $key=>$xiao) { ?>
                        <li>
                            <div class="pic">
                                <a href="<?php echo $xiao['url']; ?>" target="_blank">
                                    <img src="<?php echo thumb($xiao[thumb],100,100); ?>" /><br/>
                                    <div class="title"><?php echo $xiao['title']; ?></div>
                                </a>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="blank10 clear"></div>
            </div>
            <script  type="text/javascript">
                jQuery(".picMarquee-support").slide({mainCell:".support ul",autoPlay:true,effect:"leftMarquee",vis:4,interTime:50,trigger:"click"});
            </script>
        </div>
        <div class="w230 fr">
            <div class="ent-info">
                <h3>涟源市凯越矿山设备有限责任公司</h3>
                <div class="item">
                    <div class="label">地址：</div>
                    <div class="address">湖南省涟源市石马山镇人民东路（原电线厂）</div>
                </div>
                <div class="item">
                     <div class="label">组织代码：</div>
                     <div class="">09713321-2</div>
                </div>

                <div class="item">
                    <div class="label">质量技术监督登记号：</div>
                    <div class="">431382-009394</div>
                </div>
            </div>
            <div class="contact">
                <div class="item online">
                    <div class="title">在线联系：</div>
                    <div style="text-align:center">
                        <a><img src="<?php echo $site_template; ?>images/qq.png"/></a>
                        <div class="qq-tip">点击qq头像联系我</div>
                    </div>
                </div>
                <div class="item mobile">
                    <div class="title">其他联系方式</div>
                    <p>肖先生：18688939187</p>
                    <p>吴先生：18688939187</p>
                </div>
            </div>
        </div>
	<div class="blank10 clear"></div>
</div>
<?php include $this->_include('footer.html'); ?>