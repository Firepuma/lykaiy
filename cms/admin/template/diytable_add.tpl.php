<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '自定义表内容修改添加';
</script>
<div class="subnav">
	<div class="content-menu">
		<a href="<?php echo url('diytable/index',array('modelid'=>$this->modelid)); ?>" class="on2"><em>返回<?php echo $this->model['modelname'] ?>列表</em></a>
		<?php if($this->menu('diytable-add')) { ;?>
	    <a href="<?php echo url('diytable/add',array('modelid'=>$modelid)); ?>"	class="add" ><em>发布内容</em></a>
    	<?php } ?>

	</div>
	<div class="bk10"></div> 
		<form method="post" action="" id="myform" name="myform">
		<table width="100%" class="table_form">
		<tbody>

		<tr>
			<th width="80">名称：</th>
			<td><?php echo $this->model['modelname']; ?> </td>
		</tr>

		<?php echo $fields; ?>

		<tr>
			<th>&nbsp;</th>
			<td><input type="submit" class="button" value="提交" name="submit" onClick="$('#load').show()">
			<span id="load" style="display:none"><img src="./img/loading.gif"></span></td>
		</tr>
		</tbody>
		</table>
		<br>
		</form>
</div>
</body>
</html>
