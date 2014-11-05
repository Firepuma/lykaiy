<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '<?php echo $this->typename[$this->typeid]; ?>管理';
</script>
<div class="subnav">
	<div class="content-menu">
		<a href="<?php echo url('models/index',  array('typeid'=>$this->typeid)); ?>" class="on"><em><?php echo $this->typename[$this->typeid]; ?></em></a>
		<a href="<?php echo url('models/add',    array('typeid'=>$this->typeid)); ?>" class="add"><em>添加模型</em></a>
	</div>
	<div class="bk10"></div>
		<table width="100%"  class="m-table m-table2 m-table-row">
		   <thead class="m-table-thead s-table-thead">
			<tr>
				<th width="40" align="left">ID</th>
				<th  align="left">模型名称</th>
				<th  align="left">数据表名</th>
				<th  align="left">模型类型</th>
				<th align="left" width="200" >操作</th>
			</tr>
			</thead>
			<tbody>
			<?php if (is_array($list)) foreach ($list as $t) {  
			$setting=string2array($t['setting']);?>
			<tr >
				<td align="left"><?php echo $t['modelid']; ?></td>
				<td align="left"><?php echo $t['modelname']; ?></td>
				<td align="left"><?php echo $t['tablename']; ?></td>
				<td align="left"><?php echo $this->typename[$t['typeid']]; ?></td>
				<td align="left">
				<a href="<?php echo url('models/field/',array('typeid'=>$this->typeid, 'modelid'=>$t['modelid'])); ?>">字段管理</a> | 
				<a href="<?php echo url('models/edit',array('typeid'=>$this->typeid, 'modelid'=>$t['modelid'])); ?>">编辑</a> | 
				<a  href="<?php if ($setting['disable'])  echo url('models/disable/',array('mode'=>1,'typeid'=>$this->typeid,'modelid'=>$t['modelid']));  else { ?>javascript:confirmurl('<?php echo url('models/disable/',array('mode'=>1,'typeid'=>$this->typeid,'modelid'=>$t['modelid'])); ?>','警告:禁用后不可访问该模型确定禁用吗')<?php }  ?>"><?php if ($setting['disable']) { ?><font color="#FF0000">启用</font><?php } else {  echo '禁用';  } ?></a> | 
				<a  href="javascript:confirmurl('<?php echo url('models/del/',array('typeid'=>$this->typeid,'modelid'=>$t['modelid'])); ?>','警告:确定删除 『 <?php echo $t['modelname']; ?> 』模型吗？一旦删除不可恢复 ')" >删除</a> </td>
			</tr>
			<?php }  ?>
			<tbody>
		</table>
</div>
</body>
</html>