<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '表单列表';
</script>

<div class="subnav">
	<div class="content-menu">
		<a href="#" class="on2"><em><?php echo $this->model['modelname'] ?></em></a>
		<?php if($this->menu('models-edit')) { ;?>
		<a href="<?php echo url('models/edit',array('typeid'=>3,'modelid'=>$modelid, 'cid'=>$cid)); ?>" class="on"><em>表单设置</em></a>
    	<?php } ?>

	<?php if (!$this->join) { ?><a href="../index.php?c=index&a=form&modelid=<?php echo $modelid; ?>" class="add" target="_blank"><em>发布内容</em></a><?php };?>
	</div>
	<div class="bk10"></div>

		<form action="" method="post"  name="myform" id="myform">
		<input name="status" id="list_form" type="hidden" value="">
		<table width="100%"  class="m-table m-table-row">
		<thead class="m-table-thead s-table-thead">
		<tr>
			<th width="20" align="left"><input name="deletec" id="deletec" type="checkbox" onClick="setC()"></th>
			<th width="20"  align="left">ID </th>
			<th width="50"  align="left">状态 </th>
			<?php if (is_array($this->model['setting']['form']['show'])) foreach ($this->model['setting']['form']['show'] as $f) { ?>
			<th align="left"><?php echo $this->model['fields'][$f]['name']; ?></th>
			<?php } ?>
			<?php if ($this->join) { ?><th  align="left">关联id</th><?php } ?>
			<th width="100"  align="left">发布人</th>
			<th width="150"  align="left">更新时间</th>
			<th width="100"  align="left">操作</th>
		</tr>
		</thead>
		<tbody >
		<?php if (is_array($list)) { foreach ($list as $t) { ?>
		<tr >
			<td align="left"><input name="formidarr[]" value="<?php echo $t['id']; ?>"type="checkbox" class="deletec"></td>
			<td align="left"><?php echo $t[id]; ?></td>
			<td align="left">	<?php if (!$t['status']) { ?><font color="#f00">[未审核]</font>
			<?php } else { ?><font color="#999">正常</font><?php } ; ?>
			</td>
			<?php if (is_array($this->model['setting']['form']['show']))  foreach ($this->model['setting']['form']['show'] as $f) { ?>
			<td align="left"><?php echo $t[$f]; ?></td>
			<?php }  if ($this->join) { ?><td align="left"><a href="<?php echo url('form/index',array('userid'=>$t['userid'],'modelid'=>$modelid,'cid'=>$t['cid'])); ?>"><?php echo $t['cid']; ?></a></td><?php } ?>
			<td align="left"><?php if ($t['username']) { ?><a href="<?php echo url('form/index',array('userid'=>$t['userid'],'modelid'=>$modelid,'cid'=>$cid)); ?>"><?php echo $t['username']; ?></a><?php } else {  echo $t['ip'];  } ?></td>
			<td align="left"><span style="<?php if (date('Y-m-d', $t['time']) == date('Y-m-d')) { ?>color:#F00<?php } ?>"><?php echo date('Y-m-d H:i:s', $t['time']); ?></span></td>
			<td align="left">
			<a href="<?php echo url('form/edit',array('id'=>$t['id'],'modelid'=>$modelid, 'cid'=>$cid)); ?>">查看编辑</a> | 
			<a  href="javascript:confirmurl('<?php echo url('form/del/',array('modelid'=>$modelid,'id'=>$t['id'], 'cid'=>$cid));?>','确定删除 吗？')" >删除</a> 
			</td>
		</tr>
		<?php } } ?>

		</tbody>
		</table><br/>
			<div class="pageleft">
			<input type="submit" class="button" value="删除" name="submit_del" onClick="confirm_delete()">&nbsp;
			<input type="submit" class="button" value="设为审核" name="submit_status_1" onClick="$('#list_form').val('1')">&nbsp;
			<input type="submit" class="button" value="设未审核" name="submit_status_0" onClick="$('#list_form').val('2')">&nbsp;
		</div>
			<div class="pageright"><?php echo  $pagelist; ?></div>
		</form>
</div>

</body>
</html>