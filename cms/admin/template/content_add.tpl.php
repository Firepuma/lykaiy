<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '添加内容';
</script>
<div class="subnav">
		<form method="post" action="" id="myform" name="myform">
		<table width="100%" class="table_form">
		<tbody>
		<tr>
			<th width="88"><font color="red">*</font>&nbsp;栏目：</th>
			<td>
			<select class="select"  name="data[catid]">
			<?php echo $category; ?>
			</select>
			</td>
		</tr>
		
		<?php if ($this->content_model[$modelid]['setting']['default']['title']['show']) { ?>
		<tr>
			<th><font color="red">*</font>&nbsp;<?php echo $this->content_model[$modelid]['setting']['default']['title']['name']; ?>：</th>
			<td><input type="text" class="input-text" size="80" id="title" value="<?php echo $data['title']; ?>" name="data[title]" onBlur="check_title()"><span id="title_text"></span></td>
		</tr>
		<?php }  if ($this->content_model[$modelid]['setting']['default']['thumb']['show']) { ?>
		<tr>
			<th><?php echo $this->content_model[$modelid]['setting']['default']['thumb']['name']; ?>：</th>
			<td><?php echo $this->field->file('thumb',$data['thumb'],array('type'=>'gif,jpg,jpeg,png','preview'=>1,'size'=>0.5,'buttontxt'=>'上传图片')); ?></td>
		</tr>

		<?php }  if ($this->content_model[$modelid]['setting']['default']['keywords']['show']) { ?>
		<tr>
			<th><?php echo $this->content_model[$modelid]['setting']['default']['keywords']['name']; ?>：</th>
			<td><input type="text" class="input-text" size="50" id="keywords" value="<?php echo $data['keywords']; ?>" name="data[keywords]">
		</td>
		</tr>

		<?php }  if ($this->content_model[$modelid]['setting']['default']['description']['show']) { ?>
		<tr>
			<th><?php echo $this->content_model[$modelid]['setting']['default']['description']['name']; ?>：</th>
			<td><textarea style="width:490px;height:44px;" maxlength="255" id="description" name="data[description]"><?php echo $data['description']; ?></textarea></td>
		</tr>
		<?php }  echo $data_fields; ?>
		<tr>
			<th>推荐：</th>
			<td>
		<?php if (is_array($this->status_arr)) foreach ($this->status_arr  as $key=>$t) { ?>
			<input type="radio" <?php if (isset($data['status']) && $data['status']==$key) { ?>checked<?php } ?> value="<?php echo $key; ?>" name="data[status]" > <?php echo $t; ?> &nbsp;
		<?php } ?>		
	     	<?php if ($this->content_model[$modelid]['setting']['default']['time']['show']) { ?>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;发布时间：<?php echo $this->field->date('time',$data['time'],array('system'=>1)); ?>
	    	<?php }  if ($this->content_model[$modelid]['setting']['default']['hits']['show']) { ?>

			&nbsp;阅读数：<input type="text" class="input-text" size="5" value="<?php echo $data['hits']; ?>" name="data[hits]"><?php } ?></td>
		</tr>
		<tr>
			<th>&nbsp;</th>
			<td><input type="submit" class="button" value="提交" name="submit" onClick="$('#load').show()">
			<span id="load" style="display:none"><img src="./img/loading.gif"></span>
			</td>
		</tr>
		</tbody>
		</table>
	</form>
</div>
<script type="text/javascript">
function check_title() {
	$('#title_text').html('');
	get_kw();
	$.post('./index.php?c=content&a=check_title&id='+Math.random(), { title:$('#title').val(), id:<?php echo $data[id] ? $data[id] : 0; ?> }, function(data){ 
        $('#title_text').html(data); 
	});
}
</script>
</body>
</html>
