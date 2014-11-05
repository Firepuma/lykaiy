<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '<?php echo $this->typename[$this->typeid]; ?> &gt; <?php echo $data['modelname'] ?> &gt; 字段管理';
</script>

<div class="subnav">
	<div class="content-menu">
		<a href="<?php echo url('models/index',     array('typeid'=>$this->typeid)); ?>" class="on"><em><?php echo $this->typename[$this->typeid]; ?></em></a>
		<a href="<?php echo url('models/field/', array('typeid'=>$this->typeid, 'modelid'=>$modelid)); ?>" class="on"><em>字段管理</em></a>
		<a href="<?php echo url('models/addfield/', array('typeid'=>$this->typeid, 'modelid'=>$modelid)); ?>" class="add"><em>添加字段</em></a>
	</div>
	<div class="bk10"></div>
	    <form action="" method="post">
		<table width="100%"  class="m-table m-table2 m-table-row">
		<thead class="m-table-thead s-table-thead">
		<tr>
			<th width="40" align="left">排序</th>
			<th width="100" align="left">字段别名</th>
			<th align="left">输入类型</th>
			<th align="left">字段名称</th>
    		<?php if ($this->typeid==1 || $this->typeid==3) { ?>
			<th width="100" align="left">投稿显示</th>
	    	<?php } ?>
			<th width="100" align="left">是否必填</th>
			<th width="110"  align="left">操作</th>
		</tr>
		</thead>
		<tbody >
		
		<?php if (is_array($default_field))  foreach ($default_field as $name => $t) { ?>
		<tr height="25">
			<td align="left"></td>
			<td align="left"><?php echo $t['name']; ?></td>
			<td align="left"></td>
			<td align="left"><?php echo $name; ?></td>
    		<?php if ($this->typeid==1 || $this->typeid==3) { ?>
			<td align="left"></td>
	    	<?php } ?>
			<td align="left"> </td>
			<td align="left"><a href="<?php echo url('models/disable/',array('default'=>1,'modelid'=>$modelid,'name'=>$name)); ?>"><?php if ($t['show']) {  echo '显示';  } else {  echo "<font color='#FF0000'>隐藏</font>";  } ?></a> 
			</td>
		</tr>
		<?php }  ?>

		<?php if (is_array($list))  foreach ($list as $t) { ?>
		<tr >
			<td align="left">
			<input type="text" name="listorder[<?php echo $t['fieldid']; ?>]" class="input-text" style="width:25px;height:15px;" value="<?php echo $t['listorder']; ?>"></td>
			<td align="left"><?php echo $t['name']; ?></td>
			<td align="left">
	        <?php foreach ($this->field_type as $key=>$z) {
		            	if ($key==$t['formtype']) echo $z;
		    }?>
			</td>
			<td align="left"><?php echo $t['field']; ?></td>
    		<?php if ($this->typeid==1 || $this->typeid==3) { ?>
			<td align="left"><?php if ($t['isshow']) echo '显示'; else echo '隐藏'; ?></td>
	    	<?php } ?>
			<td align="left"><?php if ($t['pattern']) echo '必填'; else echo '选填'; ?></td>
			<td align="left">
			<a href="<?php echo url('models/editfield/',array('typeid'=>$this->typeid, 'modelid'=>$modelid, 'fieldid'=>$t['fieldid'])); ?>">编辑</a> | 
			<a href="<?php echo url('models/disable/',array('typeid'=>$this->typeid,'fieldid'=>$t['fieldid'])); ?>"><?php if ($t['disabled']==1) { ?><font color="#FF0000">启用</font><?php } else {  echo '禁用';  } ?></a> | 
			<?php if ($t['field'] == 'content' && $this->typeid ==2) { ?><a href="javascript:;" style="color:#ACA899">删除</a> <?php } else { ?><a  href="javascript:confirmurl('<?php echo url('models/delfield/',array('typeid'=>$this->typeid,'fieldid'=>$t['fieldid'])); ?>','警告:一旦删除字段，将会把 【<?php echo $t['name']; ?>】字段的数据全部删除并且不可恢复，确定删除 <?php echo $t['name']; ?> 吗？ ')" >删除</a> <?php } ?></td>
		</tr>
		<?php }  ?>
		<tr >
			<td colspan="6" align="left"><input class="button" type="submit" name="submit" value="排序" /></td>
			<?php if ($this->typeid==1 || $this->typeid==3) { ?>
			<td align="left"></td>
	    	<?php } ?>
		</tr>
		</tbody>
		</table>
	    </form>
</div>
</body>
</html>