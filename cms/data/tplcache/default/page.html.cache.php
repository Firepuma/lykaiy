<?php include $this->_include('header.html'); ?>

<div class="mainbody">
	<div class="w210 fl">
	<?php include $this->_include('left.html'); ?>
	</div>
	<div class="w740 fr">
		<div class="page bg">
		<div class="newstitle">您当前位置：<a  href="<?php echo $site_url; ?>">首页</a> >> <?php echo position($catid, ' &gt;&gt;&nbsp;&nbsp;'); ?></div>
		<div class="blank10 clear"></div>	
             <div class="content"><?php echo $content; ?></div>
		</div>
<?php echo $pagelist; ?>
		<div class="clear"></div>
	</div>
	<div class="blank10 clear"></div>


</div>

<?php include $this->_include('footer.html'); ?>