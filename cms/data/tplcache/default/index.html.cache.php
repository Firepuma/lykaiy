<?php include $this->_include('index_header.html'); ?>

<div class="mainbody index">
<!--sql调用演示 #xiaocms_表示表前缀
					<?php $return = $this->_listdata("sql=SELECT * FROM  `#xiaocms_category` LIMIT 0 , 30"); extract($return); if (is_array($return))  foreach ($return as $key=>$xiao) {  echo $xiao['catname'];  } ?>
-->

        <div class="w740 fl">
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
            <div class="picMarquee-left bg">
                <div class="hd">
                    <h3>产品展示</h3>
                    <a class="next"></a>
                    <a class="prev"></a>
                </div>
                <div class="bd">
                    <ul class="picList">
                        <?php $return = $this->_listdata("catid=5  num=10  cache=60"); extract($return); if (is_array($return))  foreach ($return as $key=>$xiao) { ?>
                        <li>
                            <div class="pic"><a href="<?php echo $xiao['url']; ?>" target="_blank"><img src="<?php echo thumb($xiao[thumb],100,100); ?>" /></a></div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>	<div class="blank10 clear"></div>

            </div>

            <script  type="text/javascript">
                jQuery(".picMarquee-left").slide({mainCell:".bd ul",autoPlay:true,effect:"leftMarquee",vis:6,interTime:50,trigger:"click"});
            </script>
        </div>
        <div class="w210 fr">
            <div class="contact">
                <div class="ent-img" style="text-align: center;">
                    <img src="fsdf" style="width:200px; height:200px;" alt="企业形象"/>
                </div>

                <div style="text-align: center;">
                    <a>
                        <img src="fasdf" alt="QQ图标">
                    </a>
                </div>
                <div style="text-align: center;">
                    <a>
                        <img src="fasdf" alt="QQ图标">
                    </a>
                </div>
            </div>
        </div>
	<div class="blank10 clear"></div>

<div  class="link bg">测试区块：<?php $this->block(7);?></div>
</div>

<?php include $this->_include('footer.html'); ?>