<div class="sidenav bg">
	<div class="title"><s></s>产品分类</div>
         <div class="leftbox">
				<ul>
			<?php $return = $this->_category("parentid=5");  if (is_array($return))  foreach ($return as $key=>$xiao) { $allchildids = @explode(',', $xiao['allchildids']);    $current = in_array($catid, $allchildids);?>
                 <li><s></s><a <?php if ($current) { ?>class="select"<?php } ?> href="<?php echo $xiao['url']; ?>"><?php echo $xiao['catname']; ?></a></li>
			<?php } ?>
				</ul> 
    </div>
</div>
<div class="blank10 clear"></div>

<div class="contact bg">
 <div class="newstitle"><h3>联系我们</h3></div> 
 <?php $this->block(4);?> 
</div>