<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '添加/修改后台用户';
</script>
<style>input {margin: 0 5px 0 0px;} span {margin-right:10px;}</style>
<div class="subnav">

	<div class="bk10"></div>
	<div class="table_form">
		<form action="" method="post">
		<table width="100%" class="table_form">
		<tr>
			<th width="100">用户名： </th>
			<td><?php if ($data['username']) {  echo $data['username'];  } else { ?><input class="input-text" type="text" name="data[username]" value="" size="30"/><?php } ?></td>
		</tr>
		<tr>
			<th>密码： </th>
			<td><input class="input-text" type="text" name="data[password]" value="" size="30"/><div class="onShow">如果不修改密码，请留空。</div></td>
		</tr>

		<tr>
			<th>备注： </th>
			<td><input class="input-text" type="text" name="data[realname]" value="<?php echo $data['realname']; ?>" size="30"/><div class="onShow">如：编辑</div></td>
		</tr>
		
		<tr>
			<th>超级管理员： </th>
			<td><input name="data[roleid]" type="radio" value="1" <?php if ($data['roleid']) echo 'checked' ?>> 是
					&nbsp;&nbsp;&nbsp;<input name="data[roleid]" type="radio" value="0" <?php if (!$data['roleid']) echo 'checked' ?>> 否<div class="onShow">超级管理员不受权限所控制(注:系统必须含有一个超级管理员，否则会出问题)</div></td>
		</tr>
		<tr>
			<th>权限设置： </th>
			<td>	
<table width="100%">
<tbody>
	<tr height="25" >
		<td align="left"  width="100">
		<input name="auth[index-config]" value="1" id="c_index" type="checkbox" onClick="setC('index')" <?php if ($auth['index-config']) echo 'checked' ?> >系统设置</td>
		<td align="left">
	</td>
	</tr>

	<tr height="25">
		<td align="left">
		<input name="auth[category-index]" value="1" id="c_category" type="checkbox" onClick="setC('category')" <?php if ($auth['category-index']) echo 'checked' ?> >栏目管理 </td>
		<td align="left">
				<input class="c_category" name="auth[category-add]" type="checkbox" value="1" <?php if ($auth['category-add']) echo 'checked' ?> ><span>添加</span>
				<input class="c_category" name="auth[category-edit]" type="checkbox" value="1" <?php if ($auth['category-edit']) echo 'checked' ?> ><span>编辑</span>
				<input class="c_category" name="auth[category-del]" type="checkbox" value="1" <?php if ($auth['category-del']) echo 'checked' ?> ><span>删除</span>
		</td>
	</tr>
	<tr height="25">
		<td align="left">
		<input name="auth[block-index]" value="1" id="c_block" type="checkbox" onClick="setC('block')" <?php if ($auth['block-index']) echo 'checked' ?>>区块管理</td>
		<td align="left">
				<input class="c_block" name="auth[block-add]" type="checkbox" value="1" <?php if ($auth['block-add']) echo 'checked' ?> ><span>添加</span>
				<input class="c_block" name="auth[block-edit]" type="checkbox" value="1" <?php if ($auth['block-edit']) echo 'checked' ?> ><span>编辑</span>
				<input class="c_block" name="auth[block-del]" type="checkbox" value="1" <?php if ($auth['block-del']) echo 'checked' ?> ><span>删除</span>
		</td>
	</tr>
	<tr height="25">
		<td align="left">
		<input name="auth[content-index]" value="1" id="c_content" type="checkbox" onClick="setC('content')"  <?php if ($auth['content-index']) echo 'checked' ?> >内容管理</td>
		<td align="left">
			<input class="c_content" name="auth[content-add]" type="checkbox" value="1"  <?php if ($auth['content-add']) echo 'checked' ?> ><span>添加</span>
			<input class="c_content" name="auth[content-edit]" type="checkbox" value="1"  <?php if ($auth['content-edit']) echo 'checked' ?> ><span>编辑</span>
			<input class="c_content" name="auth[content-del]" type="checkbox" value="1"  <?php if ($auth['content-del']) echo 'checked' ?> ><span>删除</span>
		</td>
	</tr>
	<tr height="25">
		<td align="left">
		<input name="auth[diytable-index]" value="1" id="c_diytable" type="checkbox" onClick="setC('diytable')" <?php if ($auth['diytable-index']) echo 'checked' ?> >自定义表</td>
		<td align="left">
			<input class="c_diytable" name="auth[diytable-add]" type="checkbox" value="1"  <?php if ($auth['diytable-add']) echo 'checked' ?>><span>添加</span>
			<input class="c_diytable" name="auth[diytable-edit]" type="checkbox" value="1"  <?php if ($auth['diytable-edit']) echo 'checked' ?>><span>编辑</span>
			<input class="c_diytable" name="auth[diytable-del]" type="checkbox" value="1"  <?php if ($auth['diytable-del']) echo 'checked' ?>><span>删除</span>
		</td>
	</tr>
	<tr height="25">
    	<td align="left">
		<input name="auth[form-index]" value="1" id="c_form" type="checkbox" onClick="setC('form')"  <?php if ($auth['form-index']) echo 'checked' ?>>表单管理</td>
		<td align="left">
			<input class="c_form" name="auth[form-edit]" type="checkbox" value="1" <?php if ($auth['form-edit']) echo 'checked' ?>><span>编辑</span>
			<input class="c_form" name="auth[form-del]" type="checkbox" value="1" <?php if ($auth['form-del']) echo 'checked' ?>><span>删除</span>
		</td>
	</tr>
	<tr height="25">
		<td align="left">
		<input name="auth[member-index]" value="1" id="c_member" type="checkbox" onClick="setC('member')" <?php if ($auth['member-index']) echo 'checked' ?>>会员管理</td>
		<td align="left">
			<input class="c_member" name="auth[member-edit]" type="checkbox" value="1" <?php if ($auth['member-edit']) echo 'checked' ?>><span>编辑</span>
			<input class="c_member" name="auth[member-del]" type="checkbox" value="1" <?php if ($auth['member-del']) echo 'checked' ?>><span>删除</span>
		</td>
	</tr>

	<tr height="25">
		<td align="left">
		<input name="auth[template-index]" value="1" id="c_template" type="checkbox" onClick="setC('template')"  <?php if ($auth['template-index']) echo 'checked' ?>>模板管理</td>
		<td align="left">
			<input class="c_template" name="auth[template-add]" type="checkbox" value="1" <?php if ($auth['template-add']) echo 'checked' ?>><span>添加</span>
			<input class="c_template" name="auth[template-edit]" type="checkbox" value="1" <?php if ($auth['template-edit']) echo 'checked' ?>><span>编辑</span>
			<input class="c_template" name="auth[template-updatefilename]" type="checkbox" value="1" <?php if ($auth['template-updatefilename']) echo 'checked' ?>><span>备注</span>
    	</td>
	</tr>
	<tr height="25">
		<td align="left">
		<input name="auth[administrator-index]" value="1" id="c_admin" type="checkbox" onClick="setC('admin')"  <?php if ($auth['administrator-index']) echo 'checked' ?>>管理员管理</td>
		<td align="left">
				<input class="c_admin" name="auth[administrator-add]" type="checkbox" value="1" <?php if ($auth['administrator-add']) echo 'checked' ?>><span>添加</span>
				<input class="c_admin" name="auth[administrator-edit]" type="checkbox" value="1" <?php if ($auth['administrator-edit']) echo 'checked' ?>><span>编辑</span>
				<input class="c_admin" name="auth[administrator-del]" type="checkbox" value="1" <?php if ($auth['administrator-del']) echo 'checked' ?>><span>删除</span><div class="onShow">开启此项也意味着赋予最大权限</div>
		</td>
	</tr>
	<tr height="25">
		<td align="left">
		<input name="auth[database-index]" value="1" id="c_database" type="checkbox" onClick="setC('database')" <?php if ($auth['database-index']) echo 'checked' ?>>数据备份</td>
		<td align="left">
			<input class="c_database" name="auth[database-import]" type="checkbox" value="1" <?php if ($auth['database-import']) echo 'checked' ?>><span>数据恢复</span>
			<input class="c_database" name="auth[database-repair]" type="checkbox" value="1" <?php if ($auth['database-repair']) echo 'checked' ?>><span>修复表</span>
			<input class="c_database" name="auth[database-optimize]" type="checkbox" value="1" <?php if ($auth['database-optimize']) echo 'checked' ?>><span>优化表</span>
			<input class="c_database" name="auth[database-table]" type="checkbox" value="1" <?php if ($auth['database-table']) echo 'checked' ?>><span>查看表结构</span>
		</td>
	</tr>
	<tr height="25">
		<td align="left">
		<input name="auth[createhtml-index]" value="1" id="c_createhtml" type="checkbox" onClick="setC('createhtml')" <?php if ($auth['createhtml-index']) echo 'checked' ?>>生成html</td>
		<td align="left">
			<input class="c_createhtml" name="auth[createhtml-category]" type="checkbox" value="1" <?php if ($auth['createhtml-category']) echo 'checked' ?>><span>生成栏目</span>
			<input class="c_createhtml" name="auth[createhtml-one_cat]" type="checkbox" value="1" <?php if ($auth['createhtml-one_cat']) echo 'checked' ?>><span>生成栏目附加</span>
			<input class="c_createhtml" name="auth[createhtml-all_cat]" type="checkbox" value="1" <?php if ($auth['createhtml-all_cat']) echo 'checked' ?>><span>生成栏目附加</span>
			<input class="c_createhtml" name="auth[createhtml-show]" type="checkbox" value="1" <?php if ($auth['createhtml-show']) echo 'checked' ?>><span>生成内容页</span>
			<input class="c_createhtml" name="auth[createhtml-all_show]" type="checkbox" value="1" <?php if ($auth['createhtml-all_show']) echo 'checked' ?>><span>生成内容页附加</span>
    	</td>
	</tr>

	<tr height="25">
		<td align="left">
    	<input name="auth[models-index]" value="1" id="c_models" type="checkbox" onClick="setC('models')" <?php if ($auth['models-index']) echo 'checked' ?>>模型管理 </td>
		<td align="left">
				<input class="c_models" name="auth[models-add]" type="checkbox" value="1" <?php if ($auth['models-add']) echo 'checked' ?>><span>添加</span>
				<input class="c_models" name="auth[models-edit]" type="checkbox" value="1" <?php if ($auth['models-edit']) echo 'checked' ?>><span>编辑</span>
				<input class="c_models" name="auth[models-del]" type="checkbox" value="1" <?php if ($auth['models-del']) echo 'checked' ?>><span>删除</span>
				<input class="c_models" name="auth[models-field]" type="checkbox" value="1" <?php if ($auth['models-field']) echo 'checked' ?>><span>字段管理</span>
				<input class="c_models" name="auth[models-addfield]" type="checkbox" value="1" <?php if ($auth['models-addfield']) echo 'checked' ?>><span>添加字段</span>
				<input class="c_models" name="auth[models-editfield]" type="checkbox" value="1" <?php if ($auth['models-editfield']) echo 'checked' ?>><span>修改字段</span>
				<input class="c_models" name="auth[models-delfield]" type="checkbox" value="1" <?php if ($auth['models-delfield']) echo 'checked' ?>><span>删除字段</span>
				<input class="c_models" name="auth[models-disable]" type="checkbox" value="1" <?php if ($auth['models-disable']) echo 'checked' ?>><span>禁用/启用</span>
				
		</td>
	</tr>

</tbody>
</table>
			<div class="onShow">模型管理包含了内容、会员、表单、自定义、等模型设置</div>
			
			</td>
		</tr>
		
		<tr>
			<th>禁止管理的栏目： </th>
			<td>	<?php if (is_array($cats))  foreach ($cats as $k=>$v) { ?>
			<?php if ($v['typeid']!=1) continue; ?><input class="c_add" name="auth[catid-<?php echo $v['catid']; ?>]" type="checkbox" value="1" <?php if ($auth['catid-'.$v['catid']]) echo 'checked' ?>><span><?php echo $v['catname']; ?></span>
			<?php }  ?>
			</td>
		</tr>	
	<tr>
			<th></th>
			<td><input class="button" type="submit" name="submit" value="提交" /></td>
		</tr>
		</table>
		</form>
	</div>
</div>
<script type="text/javascript">
function setC(c) {
	if($("#c_"+c).attr('checked')==true) {
		$(".c_"+c).attr("checked",true);
	} else {
		$(".c_"+c).attr("checked",false);
	}
}
</script>
</body>
</html>