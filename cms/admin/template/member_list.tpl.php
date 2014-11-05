<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '会员列表';
</script>

<div class="subnav">
	<div class="content-menu">
		<a href="../member/index.php?c=register"   class="add" target="_blank"><em>注册会员</em></a>
		<?php if($this->menu('models-index')) { ;?>
		<a href="<?php echo url('models',array('typeid'=>2)); ?>"  class="on"><em>会员模型</em></a>
    	<?php } ?>
	</div>
	<div class="bk10"></div>
		<form action="" method="post" name="myform" id="myform">
		<input name="status" id="list_form" type="hidden" value="">
		<table width="100%"  class="m-table m-table-row">
		<thead class="m-table-thead s-table-thead">
		<tr>
			<th width="25" align="left"><input name="deletec" id="deletec" type="checkbox" onclick="setC()"></th>
			<th width="30" align="left">ID </th>
			<th align="left">用户名</th>
			<th width="100" align="left">会员模型</th>
			<th width="150" align="left">注册时间</th>
			<th width="120" align="left">注册IP</th>
			<th  width="150" align="left">操作</th>
		</tr>
		</thead>
		<tbody >
		<?php if (is_array($list)) {foreach ($list as $t) {  ?>
		<tr >
			<td ><input name="member[]" value="<?php echo $t['id']; ?>"  type="checkbox" class="deletec"></td>
			<td align="left"><?php echo $t['id']; ?></td>
			<td align="left"><?php if (!$t['status']) { ?><font color="#FF0000">[未审]</font><?php } ?>
			<a href="<?php echo url('member/edit',array('id'=>$t['id'])); ?>"><?php echo $t['username']; ?></a></td>
			<td align="left"><a href="<?php echo url('member/index', array('modelid'=>$t['modelid'])); ?>"><?php echo $member_model[$t['modelid']]['modelname']; ?></a></td>
			<td align="left"><?php echo date('Y-m-d H:i:s', $t['regdate']); ?></td>
			<td align="left"><?php echo $t['regip']; ?></td>
			<td align="left"><a href="<?php echo url('member/edit',array('id'=>$t['id'])); ?>">详细</a> | 
			<a href="javascript:confirmurl('<?php echo url('member/del/',array('modelid'=>$t['modelid'],'id'=>$t['id']));?>','确定删除会员 『 <?php echo $t['username']; ?> 』吗？ ')" >删除</a> 
			</td>
		</tr>
		<?php } } ?>
		<tr >
			<td colspan="7" align="left" style="border-bottom:0px;">
			<div class="pageleft">
			<input type="submit"  class="button" value="删除" name="order" onClick="confirm_delete()">&nbsp;
			<input type="submit" class="button" value="设为审核" name="submit_status_1" onClick="$('#list_form').val('1')">&nbsp;
			<input type="submit" class="button" value="设未审核" name="submit_status_0" onClick="$('#list_form').val('2')">
			</div>
			<div class="pageright"><?php echo  $pagelist; ?></div>
			
			</td>
		</tr>    
		</tbody>
		</table>
		</form>
	</div>

</body>
</html>