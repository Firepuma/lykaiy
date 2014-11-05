<?php include $this->admin_tpl('header');?>

<div class="subnav">
	<div class="content-menu">
		<a href="<?php echo url('block'); ?>"  class="on"><em>全部区块</em></a>
		<?php if($this->menu('block-add')) { ;?>
		<a href="<?php echo url('block/add'); ?>" class="add"><em>添加区块</em></a>
    	<?php } ?>
	</div>
	<div class="bk10"></div>
		<form action="" method="post">
		<input name="id" type="hidden" value="<?php echo $data['id']; ?>">
		<table width="100%" class="table_form">
		<tr>
			<th width="80">区块名称： </th>
			<td><input class="input-text" type="text" name="data[name]" value="<?php echo $data['name']; ?>" size="40"/>    编辑方式：<select class="select" id="type" name="data[type]" onChange="select_type(this.value)">
			<option class="select"  value="0"> ... 请选择方式</option>
			<?php if (is_array($this->type))  foreach ($this->type as $i=>$v) { ?>
			<option value="<?php echo $i; ?>" <?php if ($data['type']==$i) { ?>selected<?php } ?>><?php echo $v; ?></option>
			<?php }  ?>
			</select></td>
		</tr>
		<tr id="text_1" style="display:none">
			<th>区块内容： </th>
			<td><textarea name="data[content_1]" id="data[content]" cols="105" rows="28" style="width: 680px; height: 385px;"><?php echo $data['content']; ?></textarea>
			<br><div class="onShow">区块内容支持HTML标签</div></td>
		</tr>
		<tr id="text_2" style="display:none">
			<th>区块内容： </th>
			<td><?php echo $this->field->file('content_2',$data['content'],array('type'=>'gif,jpg,jpeg,png','preview'=>1,'size'=>2,'buttontxt'=>'上传图片')); ?>
			</td>
		</tr>
		<tr id="text_3" style="display:none;">
			<th>区块内容：</th>
			<td>
			<?php echo $this->field->editor('content_3', $data['content'], array('system'=>1)); ?>
			</td>
		</tr>
		<tr>
			<th>&nbsp;</th>
			<td><input class="button" type="submit" name="submit" value="提交" /></td>
		</tr>
		</table>
		</form>
</div>
<script type="text/javascript">
function select_type(id) {
	$("#text_1").hide();
	$("#text_2").hide();
	$("#text_3").hide();
	$("#text_"+id).show();
}
<?php if ($data['type']) { ?>
$("#text_<?php echo $data['type']; ?>").show();
<?php } ?>
</script><script type="text/javascript">top.document.getElementById('position').innerHTML = '区块编辑';</script>

</body>
</html>