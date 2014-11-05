<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '<?php if(empty($catid)) echo '全部内容'; else { echo $this->category_cache[$catid]['catname'];} ?>';
</script>

<div class="subnav">
	<div class="content-menu">
		<div class="left">
		<a href="<?php echo url('content/index', array('catid'=>$catid, )); ?>" class="on2"><em><?php if(empty($catid)) echo '全部内容'; else { echo $this->category_cache[$catid]['catname'];} ?></em></a>
		<?php if($this->menu('content-add')) { ;?>
		<a href="<?php echo url('content/add',   array('catid'=>$catid)); ?>" class="add"><em>发布内容</em></a>
    	<?php } ?>
		<?php if (is_array($this->status_arr)) { ?><select class="select"  name="pageselect" onchange="self.location.href=options[selectedIndex].value" >
		<option  value="<?php echo url('content/index', array('catid'=>$catid)); ?>" <?php if (!isset($status)) { ?>selected<?php } ?>>全部</option>
		<?php foreach ($this->status_arr  as $key=>$t) { ?>
		<option value="<?php echo url('content/index', array('catid'=>$catid, 'status'=>$key)); ?>"  <?php if (isset($status) && $status==$key) { ?>selected<?php } ?>><?php echo $t; ?></option>
		<?php } ?></select><?php } ?>


		</div>
		<div class="right">
		<form method="get" action="" >
		<input type="hidden"  value="content"  name="c" />
		<input name="catid" type="hidden" value="<?php echo $catid; ?>">

		<input type="text" size="18" value="<?php echo $title; ?>" class="input-text"  name="title" />
		<input type="submit"  class="button"  value="搜索标题"   />
        </form>
		</div>
	</div>
	<div class="bk10"></div>

		<form action="" method="post" name="myform" id="myform" >
		<input name="status" id="list_form" type="hidden" value="">
		<input name="catid" type="hidden" value="<?php echo $catid; ?>">
		<table width="100%"  class="m-table m-table-row">
		<thead class="m-table-thead s-table-thead">
		<tr>
			<th width="20" align="left"><input id="deletec" type="checkbox" onClick="setC()"></th>
			<th width="25" align="left">ID </th>
			<th align="left">标题</th>
			<th width="80" align="left">栏目</th>
			<th width="60" align="left">发布人</th>
			<th width="80" align="left">更新时间</th>
			<th width="160" align="left">操作</th>
			<th width="40" align="left">排序</th>
		</tr>
		</thead>
		<tbody>
		<?php if (is_array($list)) foreach ($list as $t) { ?>
		<tr>
			<td align="left">
			
			<input name="batch[]" value="<?php echo $t['id']; ?>" type="checkbox" class="deletec"></td>
			<td align="left"><?php echo $t['id']; ?></td>
			<td align="left">
			<?php if (is_array($this->status_arr))  foreach ($this->status_arr  as $key=>$r) { ?>
			<?php  if ($t['status']==$key && $key!=1) {?>
			<a href="<?php echo url('content/index', array('catid'=>$catid, 'status'=>$key)); ?>"><font color="#f00">[<?php echo $r; ?>]</font></a>
			<?php }  ?>
			<?php } ?>
			<a href="<?php echo url('content/edit',array('id'=>$t['id'])); ?>"><?php echo $t['title']; ?></a>
			</td>
			<td align="left"><a href="<?php echo url('content/index',array('catid'=>$t['catid'])); ?>"><?php echo $this->category_cache[$t['catid']]['catname']; ?></a></td>

			<td align="left"><a href="<?php echo url('content/index',array('username'=>$t['username'],'catid'=>$t['catid'])); ?>"><?php echo $t['username']; ?></a></td>
			
			<td align="left"><span style="<?php if (date('Y-m-d', $t['time']) == date('Y-m-d')) { ?>color:#F00<?php } ?>" title="<?php echo date('H:i', $t['time']); ?>"><?php echo date('Y-m-d', $t['time']); ?></span></td>
			
			<td align="left">
			<?php if (get_cache('form_model'))  foreach (get_cache('form_model') as $j) { if ($j['joinid']==$modelid && !empty($catid) && empty($child)) {?>
			<a href="<?php echo url('form/index',array('cid'=>$t['id'], 'modelid'=>$j['modelid'])); ?>"><?php echo $j['modelname']; ?></a> |
			<?php } }  ?>

			
			<a href="<?php echo $this->view->get_show_url($t); ?>" target="_blank">查看</a> | 
			<a href="<?php echo url('content/edit',array('id'=>$t['id'])); ?>" >编辑</a> | 
			<a href="javascript:confirmurl('<?php echo url('content/del/',array('catid'=>$t['catid'],'id'=>$t['id'])); ?>','确定删除 『 <?php echo $t['title']; ?> 』吗？ ')" >删除</a> 
			</td>
			<td align="left"><input type="text" name="listorder[<?php echo $t['id']; ?>]" class="input-text-c"  size='1'  value="<?php echo $t['listorder']; ?>"></td>
		</tr>
		<?php } ?>
		<tr >
			<td colspan="8"  align="left" style="border-bottom:0px;">
			<div  class="pageleft">

			<input type="submit"  class="button" value="删除" name="delete" onClick="confirm_delete()" >&nbsp;
			
			<input type="submit"  class="button" value="排序" name="order" onClick="$('#list_form').val('listorder')">&nbsp;

		<?php if (is_array($this->status_arr)) foreach ($this->status_arr  as $key=>$t) { ?>
    		<input type="submit"  class="button" value="设为<?php echo $t; ?>" onClick="$('#list_form').val('<?php echo $key; ?>')">&nbsp;
		<?php } ?>
		<?php if(empty($child) && !empty($catid)) { ?>
			批量移动至
			<select class="select"  name="movecatid">
			<?php echo $category; ?>
			</select>
			<input type="submit" class="button" value="确定移动" name="move" onClick="$('#list_form').val('move')">
		<?php } ?>
			</div>
			<div class="pageright"><?php echo $pagelist; ?></div>
			</td>
		</tr>	

		</tbody>
		</table>
		</form>
</div>

</body>
</html>