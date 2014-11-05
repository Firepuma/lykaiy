<?php include $this->_include('header.html'); ?>

<div class="mainbody">
<!--sql调用演示 #xiaocms_表示表前缀
					<?php $return = $this->_listdata("sql=SELECT * FROM  `#xiaocms_category` LIMIT 0 , 30"); extract($return); if (is_array($return))  foreach ($return as $key=>$xiao) {  echo $xiao['catname'];  } ?> 
-->
	<div class="w740 fl">
		<!-- indexnewslist-->
		<div class="newwarp bg">
			<div class="newstitle"><h3><?php echo $cats[3][catname]; ?></h3><a href="<?php echo $cats[3][url]; ?>" class="more">更多&gt;&gt;</a></div>

			<?php $return = $this->_listdata("catid=3 num=1 cache=0"); extract($return); if (is_array($return))  foreach ($return as $key=>$xiao) { ?>
			<div class="newsfocus">
			<div><a href="<?php echo $xiao['url']; ?>"><img src="<?php echo image($xiao[thumb]); ?>" /></a></div>
				<h3><a href="<?php echo $xiao['url']; ?>" title="<?php echo $xiao['title']; ?>"><?php echo strcut($xiao[title],34); ?></a></h3>
				<p><?php echo strcut($xiao[description],60); ?> </p>
			</div>
			<?php } ?>

			<ul class="indexnewslist">
			<?php $return = $this->_listdata("catid=3 order=time num=3 "); extract($return); if (is_array($return))  foreach ($return as $key=>$xiao) { ?>
				<li><span><?php echo date("Y-m-d", $xiao['time']); ?></span>· <a href="<?php echo $xiao['url']; ?>"><?php echo strcut($xiao[title],34,''); ?></a></li>
			<?php } ?>
			</ul>
		</div>

		<!-- aboutus-->
		<div class="aboutus bg">
			<div class="newstitle"><h3><?php echo $cats[1][catname]; ?></h3><a href="<?php echo $cats[1][url]; ?>" class="more">更多&gt;&gt;</a></div>
			<div class="blank10 clear"></div>
			<?php $this->block(5);?>
		</div>
		<!-- /aboutus-->
		<div class="clear"></div>
	</div>
	<div class="w210 fr">
		<div class="contact bg">
			<div class="newstitle"><h3>联系我们</h3></div>
			<div class="blank10 clear"></div>
			<div class="contactus"><?php $this->block(4);?></div>
		</div>
	</div>
	<div class="blank10 clear"></div>

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
<div class="blank10 clear"></div>
</div>

<?php include $this->_include('footer.html'); ?>