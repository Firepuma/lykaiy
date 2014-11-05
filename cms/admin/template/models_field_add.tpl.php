<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '<?php echo $this->typename[$this->typeid]; ?> &gt; <?php echo $model_data['modelname']; ?> &gt; 添加字段';
</script>
<script type="text/javascript">
function field_setting(type) {
    $("#setting").html('loading...');
	$.getJSON("<?php echo url('models/field_type_setting/',array('type'=>'')); ?>"+type, function(data) {
		$("#setting").html(data);																		
	});
}
function ajaxname() {
	var field = $('#field').val();
	if (field == '') {
	    $.post('../index.php?c=api&a=pinyin&id='+Math.random(), { name:$('#name').val() }, function(data){ $('#field').val(data); });
	}
}

</script>
<div class="subnav">
	<div class="content-menu">
		<a href="<?php echo url('models/index', array('typeid'=>$this->typeid)); ?>" class="on"><em>模型管理</em></a>
		<a href="<?php echo url('models/field/', array('typeid'=>$this->typeid, 'modelid'=>$modelid)); ?>" class="on"><em>字段管理</em></a>
		<a href="<?php echo url('models/addfield/', array('typeid'=>$this->typeid, 'modelid'=>$modelid)); ?>" class="add"><em>添加字段</em></a>
	</div>
	<div class="bk10"></div>
		<form action="" method="post">
		<input name="data[modelid]" type="hidden" value="<?php echo $modelid; ?>">
		<table width="100%" class="table_form">
		<tr>
			<th>模型名称： </th>
			<td><?php echo $model_data['modelname']; ?></td>
		</tr>
		<tr>
			<th width="100"><font color="red">*</font> 字段类别： </th>
			<td><select class="select"  name="data[formtype]" id="formtype" onChange="field_setting(this.value)" >
			<option value="">--请选择字段类别--</option>
			<?php  foreach ($formtype as $k=>$t) { ?>
			  <option value="<?php echo $k; ?>" <?php if ($k==$data['formtype']) { ?>selected<?php }  ?>><?php echo $t; ?></option>
			<?php }  ?>
			</select><div class="onShow">表单的输入类型</div>
			</td>
		</tr>
		<tr>
			<th><font color="red">*</font> 字段别名： </th>
			<td><input class="input-text" type="text" name="data[name]" value="<?php echo $data['name']; ?>" size="30" id="name" onBlur="ajaxname()"/><div class="onShow">例如：标题。</div></td>
		</tr>
		<tr>
			<th><font color="red">*</font> 字段名称： </th>
			<td><input class="input-text" type="text" id="field" name="data[field]" value="<?php echo $data['field']; ?>" size="30" <?php if ($data[fieldid]) { ?>disabled<?php } ?> /><div class="onShow">必须英文字母开头、数字和下划线组成。如：xiaocms</div>
		</tr>

		<tr>
			<td colspan="2" style="padding: 0;">
			<div id="setting">
			<?php 
			if ($data['fieldid']) {
				$fieldsetting = $data['formtype'] . '_setting';
				if (method_exists($this->field,$fieldsetting)) echo $this->field->$fieldsetting($data['setting']);
			} ?>
			</div>
			</td>
		</tr>

		<tr>
			<th>输入提示： </th>
			<td><input class="input-text" type="text" name="data[tips]" value="<?php echo $data['tips']; ?>" size="30"/><div class="onShow">输入框旁的提示。</div></td>
		</tr>
		<?php if ($this->typeid==1 || $this->typeid==3) { ?>
		<tr>
			<th>投稿显示：</th>
			<td>
			<input type="radio" <?php if (!isset($data['isshow']) || $data['isshow']==1) { ?>checked<?php } ?> value="1" name="data[isshow]"> 显示&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" <?php if (isset($data['isshow']) && $data['isshow']==0) { ?>checked<?php } ?> value="0" name="data[isshow]"> 隐藏
			<div class="onShow">会员/游客发布时是否显示该字段。</div>
			</td>
		</tr>
		<?php } ?>
		<tr>
			<th >数据校验： </th>
			<td><input class="input-text" type="text" name="data[pattern]" id="pattern" value="<?php echo $data['pattern']; ?>" size="30"/><select  class="select" onChange="javascript:$('#pattern').val(this.value)" >
			<option value="">常用正则</option>
			<option value="1">不能为空</option>
			<option value="/^[0-9.-]+$/">数字</option>
			<option value="/^[0-9-]+$/">整数</option>
			<option value="/^[a-z]+$/i">字母</option>
			<option value="/^[0-9a-z]+$/i">数字+字母</option>
			<option value="/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/">E-mail</option>
			<option value="/^[0-9]{5,20}$/">QQ</option>
			<option value="/^http:\/\//">超级链接</option>
			<option value="/^(1)[0-9]{10}$/">手机号码</option>
			<option value="/^[0-9-]{6,13}$/">电话号码</option>
			<option value="/^[0-9]{6}$/">邮政编码</option>
			</select><div class="onShow">正则校验提交数据的合法性，如果不想校验请留空。</div>
			</td>
		</tr>
		<tr>
			<th>错误信息： </th>
			<td><input class="input-text" type="text" name="data[errortips]" value="<?php echo $data['errortips']; ?>" size="30"/><div class="onShow">未通过数据校验的提示信息。例如:不能为空</div></td>
		</tr>

		<tr>
			<th>&nbsp;</th>
			<td><input class="button" type="submit" name="submit" value="提交" onClick="$('#load').show()" />
			<span id="load" style="display:none"><img src="./img/loading.gif"></span></td>
		</tr>
		</table>
		</form>
</div>
</body>
</html>