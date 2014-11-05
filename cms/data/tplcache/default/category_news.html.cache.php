<?php include $this->_include('header.html'); ?>

<div class="mainbody">

	<div class="w210 fl">
	<?php include $this->_include('left.html'); ?>
	</div>
	<div class="w740 fr">
		<div class="page bg">
		<div class="newstitle">您当前位置：<a  href="<?php echo $site_url; ?>">首页</a> >><?php echo position($catid, ' &gt;&gt;&nbsp;&nbsp;'); ?></div>
		<div class="blank10 clear"></div>
            <!--栏目循环 调用当前栏目的下级栏目 并且栏目类型是内部栏目-->
            <?php $return = $this->_category("parentid=$catid typeid=1");  if (is_array($return))  foreach ($return as $key=>$xiao) { $allchildids = @explode(',', $xiao['allchildids']);    $current = in_array($catid, $allchildids);?>
		    <div class="newslist">
                <h3><span class="bt"><?php echo $xiao['catname']; ?></span> <span class="more"><a href="<?php echo $xiao['url']; ?>">更多&gt;&gt;</a></span></h3> 	
			    <ul class="noborder">
                <?php $return = $this->_listdata("catid=$xiao[catid] num=9  order=time"); extract($return); if (is_array($return))  foreach ($return as $key=>$xiao) { ?>
                <li><span class="date"><?php echo date("Y-m-d", $xiao['time']); ?></span> <a href="<?php echo $xiao['url']; ?>">·  <?php echo $xiao['title']; ?></a></li>
                <?php } ?>
                </ul>
		   </div>
		   <div class="blank10 clear"></div>
            <?php } ?>
            <!--栏目循环 end-->
		
		</div>

		<div class="clear"></div>
	</div>
	<div class="blank10 clear"></div>


</div>

<?php include $this->_include('footer.html'); ?>