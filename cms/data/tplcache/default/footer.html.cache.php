		<!--底部信息-->
	<div class="clear blank10"></div>
    <div class="footer">
        <div class="footnav">
        <a href="<?php echo $site_url; ?>">首页</a>
<!--注意 当啥参数都不写的时候 nav后面需要跟两个空格-->
		<?php $return = $this->_category(" ");  if (is_array($return))  foreach ($return as $key=>$xiao) { $allchildids = @explode(',', $xiao['allchildids']);    $current = in_array($catid, $allchildids);?>
		<a href="<?php echo $xiao['url']; ?>"><?php echo $xiao['catname']; ?></a>
		<?php } ?>
			
        </div>
       <div class="copyright">Powered by <a href="http://www.xiaocms.com" target="_blank">Firepuma</a>  © 2014</div>
    </div>
</body>
</html>