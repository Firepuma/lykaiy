<?php include $this->_include('header.html'); ?>

<div class="mainbody">
	<div class="w210 fl">
	<?php include $this->_include('left.html'); ?>
	</div>
	<div class="w740 fr">
		<div class="page bg">
                    <div class="newstitle">您当前位置：<a  href="<?php echo $site_url; ?>">首页</a> >> <?php echo position($catid, ' &gt;&gt;&nbsp;&nbsp;'); ?></div>
                    <div class="blank10 clear"></div>	
                    <h2><?php echo $title; ?></h2> 
                    <div class="info">时间：<?php echo date("Y-m-d H:i:s", $time); ?> 点击：<script type="text/javascript" src="<?php echo url('api/hits',array('id'=>$id)); ?>"></script>次</div>
                    <div class="content"><?php echo $content; ?></div>
                    <div class="blank10 clear"></div>	
			 		<!--文章内容分页 begin-->
                <div class="listpage" ><?php echo $pagelist; ?></div>
					<!--文章内容分页 end-->
                   <?php if ($prev_page) { ?><p>上一篇：<a href="<?php echo $prev_page['url']; ?>"><?php echo $prev_page['title']; ?></a> </p><?php } ?>
                    <div class="blank5 clear"></div>
                   <?php if ($next_page) { ?><p>下一篇：<a href="<?php echo $next_page['url']; ?>"><?php echo $next_page['title']; ?></a> </p><?php } ?>

	   </div>
 	<div class="blank20 clear"></div>
	<div class="bg">
	<h2>评论-关联表单调用演示用它来扩展多种类型表单 比如产品订购等</h2><br/><br/>
                <?php $return = $this->_listdata("table=form_comment cid=$id order=time"); extract($return); if (is_array($return))  foreach ($return as $key=>$xiao) {  echo $xiao[pinglunneirong]; ?><br/><br/>
                <?php } ?></div>
	<div class="blank20 clear"></div>

<form action="<?php echo url('index/form', array('modelid'=>4, 'cid'=>$id)); ?>" method="post">
			<table width="100%" class="bg ">
			<tr>
				<td ><h3>评论内容：</h3></td>
			</tr>
			<tr><td><textarea class="pinglunneirong" name="data[pinglunneirong]"></textarea></td></tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td style="border:none"><input type="submit" class="button" value="提 交" name="submit"></td>
			</tr>
			</table>
</form>

		<div class="clear"></div>
	</div>
	<div class="blank10 clear"></div>


</div>

<?php include $this->_include('footer.html'); ?>
