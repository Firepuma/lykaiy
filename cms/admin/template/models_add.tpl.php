<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '<?php echo $this->typename[$this->typeid]; ?> &gt;添加/修改模型';
</script>
<div class="subnav">
	<div class="content-menu">
		<a href="<?php echo url('models/index',  array('typeid'=>$this->typeid)); ?>" class="on"><em><?php echo $this->typename[$this->typeid]; ?></em></a>
		<a href="<?php echo url('models/add',    array('typeid'=>$this->typeid)); ?>" class="add"><em>添加模型</em></a>
	</div>
		<div class="bk10"></div>

		<form action="" method="post">
				<table width="100%" class="table_form">	
				<tbody>

				<tr>
					<th width="165">模型类型： </th>
					<td><?php echo $this->typename[$this->typeid]; ?></td>
				</tr>
				<tr>
					<th><font color="red">*</font> 模型名称： </th>
					<td><input class="input-text" type="text" name="data[modelname]" value="<?php echo $data['modelname']; ?>" size="30"/></td>
				</tr>
				<tr>
					<th><font color="red">*</font> 模型表名： </th>
					<td><input class="input-text" type="text" name="data[tablename]" value="<?php echo $data['tablename']; ?>" size="30" <?php if ($data['modelid']) { ?>disabled<?php } ?> /><div class="onShow">只能由小写英文和数字组成(无需加表前缀)，此项添加后不能修改。</div></td>
				</tr>
				<?php if ($this->typeid == 1) { ?><!--内容模型-->
				<tr>
					<th>关联表单：</th>
					<td>
					<?php if (is_array($formmodel))
					foreach ($formmodel as $t) { ?>

					<input type="checkbox" value="<?php echo $t['modelid']; ?>" name="join[]" 
					<?php 
					if (in_array($t['modelid'], $join)) { ?>checked<?php } 
					else { 
					if (in_array($t['modelid'], $joindata)) { ?>disabled<?php }   }?> /> <?php echo $t['modelname']; ?>&nbsp;&nbsp;

					<?php }  ?>
					<div class="onShow">用于拓展内容（如评论，留言等）。</div>
					</td>
				</tr>
				<tr>
					<th>列表模板： </th>
					<td><input class="input-text" type="text" name="data[listtpl]" value="<?php echo $data['listtpl']; ?>" size="30"/><div class="onShow">例如：list_news.html。不填写则会是list_+模型名称拼音</div></td>
				</tr>
				<tr>
					<th>内容模板： </th>
					<td><input class="input-text" type="text" name="data[showtpl]" value="<?php echo $data['showtpl']; ?>" size="30"/><div class="onShow">例如：show_news.html。同上</div>
					</td>
				</tr>
				<?php } ?>
				<?php if ($this->typeid == 3) { ?><!--表单模型-->

				<tr>
					<th>表单提交模板：</th>
					<td>
					<input type="text" class="input-text" name="data[showtpl]" size="30" value="<?php echo $data['showtpl']; ?>"><div class="onShow">默认为form.html</div>
					</td>
				</tr>
				<tr>
					<th>表单类型：</th>
					<td>
					<?php echo $join_info; ?>
					</td>
				</tr>
				<tr>
					<th>提交权限：</th>
					<td>
					<input type="radio" <?php if (empty($data['setting']['form']['post'])) { ?>checked<?php } ?> value="0" name="data[setting][form][post]"> 游客
					&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" <?php if ($data['setting']['form']['post']==1) { ?>checked<?php } ?> value="1" name="data[setting][form][post]"> 会员
					</td>
				</tr>
				<tr>
					<th>提交次数：</th>
					<td>
					<input type="radio" <?php if (empty($data['setting']['form']['num'])) { ?>checked<?php } ?> value="0" name="data[setting][form][num]"> 不限
					&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" <?php if ($data['setting']['form']['num']==1) { ?>checked<?php } ?> value="1" name="data[setting][form][num]"> 一次
					<div class="onShow">会员提交次数限制(仅针对开启会员提交权限有效，如果想对游客限制可设置时间间隔)</div>
					</td>
				</tr>
				<tr>
					<th>时间间隔：</th>
					<td>
					<input type="text" class="input-text" size="10" value="<?php echo $data['setting']['form']['time']; ?>" name="data[setting][form][time]"><div class="onShow">单位分钟 填10 表示同一IP10分钟内只允许提交一次，不填则不限制</div>
					</td>
				</tr>
				<tr>
					<th>是否审核：</th>
					<td>
					<input type="radio" <?php if (empty($data['setting']['form']['check'])) { ?>checked<?php } ?> value="0" name="data[setting][form][check]"> 关闭
					&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" <?php if ($data['setting']['form']['check']==1) { ?>checked<?php } ?> value="1" name="data[setting][form][check]"> 打开
					</td>
				</tr>
				<tr>
					<th>开启验证码：</th>
					<td>
					<input type="radio" <?php if (empty($data['setting']['form']['code'])) { ?>checked<?php } ?> value="0" name="data[setting][form][code]"> 关闭
					&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" <?php if ($data['setting']['form']['code']==1) { ?>checked<?php } ?> value="1" name="data[setting][form][code]"> 打开
					</td>
				</tr>
				<tr <?php if (!defined('XIAOCMS_MEMBER')) {?>style="display:none;"<?php } ?>>
					<th>会员可查看：</th>
					<td>
					<input type="radio" <?php if (empty($data['setting']['form']['member'])) { ?>checked<?php } ?> value="0" name="data[setting][form][member]"> 关闭
					&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" <?php if ($data['setting']['form']['member']==1) { ?>checked<?php } ?> value="1" name="data[setting][form][member]"> 打开
					<div class="onShow">会员中心导航显示自己提交的内容列表</div>
					</td>
				</tr>

				
				<tr>
					<th>字段在列表中显示：</th>
					<td >
<style>
#Jan{text-align: center;width:404px;height:auto;font-weight: 700;border-bottom:1px solid #ccc;}
.td{float:left;width:133px;height: 38px;line-height: 38px;border-top:1px solid #ccc;border-left:1px solid #ccc;}
.tr{clear:both;height:40px}
.td1{border-right:1px solid #ccc;}
</style>
<div id="Jan">
<div class="tr" style="font-weight: 400;background: #eee;">
<div class="td">字段名称</div>
<div class="td" >后台列表显示</div>
<div class="td td1">会员中心列表显示</div>
</div>
						<?php if (is_array($form_field_list))  foreach ($form_field_list as $t) { ?>
<div class="tr">
<div class="td"><?php echo $t['name']; ?></div>
<div class="td"><input type="checkbox" value="<?php echo $t['field']; ?>" name="data[setting][form][show][]" <?php if (@in_array($t['field'], $data['setting']['form']['show'])) { ?>checked<?php } ?>> 显示</div>
<div class="td td1"><input type="checkbox" value="<?php echo $t['field']; ?>" name="data[setting][form][membershow][]" <?php if (@in_array($t['field'], $data['setting']['form']['membershow'])) { ?>checked<?php } ?>> 显示</div>
</div>
						<?php  } ?>
						
</div>
				</td>
				</tr>
				<tr>
					<th>表单提交地址：</th>
					<td><?php echo $form_url; ?> </td>
				</tr>
				<tr>
				  <th>模板调用参考：</th>
				  <td>
				  <pre ><?php echo $list_code; ?></pre>
				  </td>
				</tr>
				
				<?php } ?>
				<?php if ($this->typeid == 4) { ?><!--自定义表-->

				<tr>
					<th>字段在列表中显示：</th>
					<td >
<style>
#Jan{text-align: center;width:269px;height:auto;font-weight: 700;border-bottom:1px solid #ccc;}
.td{float:left;width:133px;height: 38px;line-height: 38px;border-top:1px solid #ccc;border-left:1px solid #ccc;}
.tr{clear:both;height:40px}
.td1{border-right:1px solid #ccc;}
</style>
<div id="Jan">
<div class="tr" style="font-weight: 400;background: #eee;">
<div class="td">字段名称</div>
<div class="td td1" >后台列表显示</div>
</div>
						<?php if (is_array($form_field_list))  foreach ($form_field_list as $t) { ?>
<div class="tr">
<div class="td"><?php echo $t['name']; ?></div>
<div class="td td1"><input type="checkbox" value="<?php echo $t['field']; ?>" name="data[setting][form][show][]" <?php if (@in_array($t['field'], $data['setting']['form']['show'])) { ?>checked<?php } ?>> 显示</div>

</div>
						<?php  } ?>
						
</div>
				</td>
				</tr>

				<tr>
				  <th>模板调用参考：</th>
				  <td>
				  <pre ><?php echo $list_code; ?></pre>
				  </td>
				</tr>
				
				<?php } ?>
				
				
				<tr>
					<th> </th>
					<td><input type="submit" class="button" value="提交" name="submit"></td>
				</tr>
				</tbody>
				</table>
				<div class="bk15"></div>
		</form>
</body>
</html>