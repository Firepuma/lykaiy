<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '栏目管理';
</script>

<div class="subnav">
	<div class="content-menu">
		<a href="<?php echo url('category'); ?>"  class="on"><em>全部栏目</em></a>
		<?php if($this->menu('category-add')) { ;?>
		<a href="<?php echo url('category/add'); ?>"  class="add"><em>添加栏目</em></a>
    	<?php } ?>
	</div>
	<div class="bk10"></div>
		<form action="" method="post" name="myform">
		<table width="100%"  class="m-table m-table-row">
		<thead class="m-table-thead s-table-thead">
		<tr>
			<th width="40" align="left">排序</th>
			<th width="20" align="left">ID </th>
			<th  align="left">栏目名称</th>
			<th width="100"  align="left">类型</th>
			<th width="100" align="left">内容</th>
			<th width="100" align="left">显示</th>
			<th width="150" align="left">操作</th>
		</tr>
		</thead>
		<tbody >
		<?php echo $categorys ;?> 
		<tr >
		<td colspan="7" align="left" style="border-bottom:0px;">
			<input type="submit" class="button" value="排序" name="submit" onClick="$('#load').show()">&nbsp;
			<span id="load" style="display:none"><img src="./img/loading.gif"></span>
		</td>
		</tr>
		</tbody>
		</table>
		</form>
</div>
</body>
</html>