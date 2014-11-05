<?php include $this->_include('header.html'); ?>
<div class="mainbody">
	<div class="w210 fl">
	<?php include $this->_include('left.html'); ?>  
	</div>
	<div class="w740 fr">
		<div class="page bg">
		<div class="newstitle">您当前位置：<a  href="<?php echo $site_url; ?>">首页</a> >> <?php echo position($catid, ' &gt;&gt;&nbsp;&nbsp;'); ?></div>
		<div class="blank10 clear"></div>
            <!--列表开始-->
		    <div class="newslist">
			
			    <ul class="noborder">
                <?php $return = $this->_listdata("catid=$catid page=$page"); extract($return); if (is_array($return))  foreach ($return as $key=>$xiao) { ?>
                <li><span class="date"><?php echo date("Y-m-d", $xiao['time']); ?></span> <a href="<?php echo $xiao['url']; ?>">· <?php echo $xiao['title']; ?></a></li>
                <?php } ?>
                </ul>
                <div class="listpage" ><?php echo $pagelist; ?></div>
		   </div>
	       <!--列表结束-->
		
		</div>

		<div class="clear"></div>
	</div>
	<div class="blank10 clear"></div>

</div>

<?php include $this->_include('footer.html'); ?>