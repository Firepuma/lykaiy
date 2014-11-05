<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '添加栏目';
</script>

<div class="subnav">
	<div class="content-menu">
		<a href="<?php echo url('category'); ?>"  class="on"><em>全部栏目</em></a>
		<?php if($this->menu('category-add')) { ;?>
		<a href="<?php echo url('category/add'); ?>"  class="add"><em>添加栏目</em></a>
    	<?php } ?>
	</div>
	<div class="bk10"></div>
		<form method="post" action="" id="myform" name="myform">
		<input type="hidden" value="<?php echo $catid; ?>" name="catid">
				<div class="col-tab">
					<ul class="tabBut cu-li">
						<li onClick="SwapTab('setting','on','',2,1);" class="on" id="tab_setting_1">栏目设置</li>
						<li onClick="SwapTab('setting','on','',2,2);" id="tab_setting_2" class="">其他设置</li>
					</ul>
					
					<div class="contentList pad-10" id="div_setting_1" style="display: block;">
					<table width="100%" class="table_form ">
					<tbody>
					<?php if ($add) { ?>
					<tr>
						<th width="105">批量添加：</th>
						<td>
						<input type="radio" value="0" name="addall" onclick='$("#addall").hide();$("#_addall").show();' checked> 否&nbsp;&nbsp;
						<input type="radio" value="1" name="addall" onclick='$("#addall").show();$("#_addall").hide();'> 是
						</td>
					</tr>
					<tbody id='addall' style="display:none">
					<tr>
						<th><font color="red">*</font> 格式见左侧：</th>
						<td><textarea style="width:200px;height:110px" name="names"></textarea>
						<div class="onShow">格式：栏目名称|栏目目录 一行一个 如： 新闻|news</div>
						</td>
					</tr>
					</tbody>
					<?php } ?>
					<tbody id='_addall'>
					<tr>
						<th width="105"><font color="red">*</font> 栏目名称：</th>
						<td><input type="text" class="input-text" size="30" value="<?php echo $data['catname']; ?>" name="data[catname]" id="dir" onBlur="ajaxdir()"></td>
					</tr>
					<tr>
						<th><font color="red">*</font> 栏目目录：</th>
						<td><input type="text" class="input-text" size="30" value="<?php echo $data['catdir']; ?>" name="data[catdir]" id="dir_text"></td>
					</tr>

					</tbody>
					<tr>
						<th width="105"><font color="red">*</font> 上级栏目：</th>
						<td>
						<select class="select"  id="parentid" name="data[parentid]">
						<option value="0">作为顶级栏目</option>
						<?php echo $category_select; ?>
						</select>
							       <input type="radio" <?php if (!isset($data['ismenu']) || $data['ismenu']==1) { ?>checked<?php } ?> value="1" name="data[ismenu]"> 显示&nbsp;
						<input type="radio" <?php if (isset($data['ismenu']) && $data['ismenu']==0) { ?>checked<?php } ?> value="0" name="data[ismenu]"> 隐藏
						</td>
					</tr>
					<tr>
						<th><font color="red">*</font> 栏目类型：</th>
						<td>
						<input type="radio" value="1" name="data[typeid]" <?php if ($data[typeid]==1) { ?>checked<?php } ?> onClick="settype(1)"  <?php if ($istype) { ?>disabled<?php } ?>> 列表栏目&nbsp;&nbsp;
						<input type="radio" value="2" name="data[typeid]" <?php if ($data[typeid]==2) { ?>checked<?php } ?> onClick="settype(2)" <?php if ($istype) { ?>disabled<?php } ?>> 单页面&nbsp;&nbsp;
						<input type="radio" value="3" name="data[typeid]" <?php if ($data[typeid]==3) { ?>checked<?php } ?> onClick="settype(3)" <?php if ($istype) { ?>disabled<?php } ?>> 外部链接 <?php if ($istype) { ?><div class="onShow">当内部栏目有数据时不可更改类型</div><?php } ?>
						</td>
					</tr>


					<tr class="type_3" style="display:none;">
						<th><font color="red">*</font> 链接地址：</th>
						<td><input type="text" class="input-text" size="50" value="<?php echo $data['http']; ?>" name="data[http]"><div class="onShow">请使用http://开头 如：http://www.xiaocms.com</div></td>
					</tr>
					</tbody>
					</table>
					
					<table width="100%"    class="type_1 table_form"  style="display:none;">
					<tbody>
					<tr>
						<th width="105"><font color="red">*</font> 内容模型：</th>
						<td>
						<select class="select"  onChange="change_tpl(this.value)" id="modelid" name="data[modelid]" <?php if ($catid && $istype) { ?>disabled<?php } ?>>
						<option value="0"> -- </option>
						<?php if (is_array($this->content_model)) foreach ($this->content_model as $t) { ?>
						<option value="<?php echo $t['modelid']; ?>" <?php if ($t['modelid']==$data['modelid']) { ?>selected<?php } ?>><?php echo $t['modelname']; ?></option>
						<?php } ?>
						</select><div class="onShow">只有列表栏目才能选择内容模型</div></td>
					</tr>
					<tr>
						<th>列表模板：</th>
						<td id="list_template">
						<input type="text" class="input-text" size="30" value="<?php echo $data['listtpl']; ?>" name="data[listtpl]" id="listtpl"> 列表显示数量：<input type="text" class="input-text" size="5" value="<?php if(empty($data['pagesize'])) echo 10; else echo $data['pagesize']; ?>" name="data[pagesize]">
						</td>
					</tr>
					<tr>
						<th>内容模板：</th>
						<td id="list_template">
						<input type="text" class="input-text" size="30" value="<?php echo $data['showtpl']; ?>" name="data[showtpl]" id="showtpl">
						</td>
					</tr>
					</tbody>
					</table>
	
					<table width="100%"    class="type_2 table_form"  style="display:none;">
					<tbody>

					<tr >
						<th width="105">单页模板：</th>
						<td id="show_template">
						<input type="text" class="input-text" size="30" value="<?php echo $data['pagetpl']; ?>" name="data[pagetpl]" id="pagetpl"><div class="onShow">单页面也可以用来建立频道页。</div>
						</td>
					</tr>
					
					<tr >
						<th>单页面内容：</th>
						<td>
						<?php echo $this->field->editor('content', $data['content'], array('system'=>1)); ?>
						</td>
					</tr>

					</tbody>
					</table>
		
					</div>


					<div class="contentList pad-10 hidden" id="div_setting_2" style="display: none;">					
					<table width="100%" class="table_form">
					<tr>
						<th width="105">投稿权限：</th>
						<td>
						<input name="data[ispost]" type="radio" value="0"<?php if ($data['ispost']==0) { ?> checked<?php } ?> >&nbsp;禁止投稿
						&nbsp;&nbsp;&nbsp;
						<input name="data[ispost]" type="radio" value="1"<?php if ($data['ispost']==1) { ?> checked<?php } ?> >&nbsp;允许游客投稿
							&nbsp;&nbsp;&nbsp;
						<?php if (!defined('XIAOCMS_MEMBER')) {?><div style="display:none;"><?php } ?>
						<input name="data[ispost]" type="radio" value="2"<?php if ($data['ispost']==2) { ?> checked<?php } ?> >&nbsp;只允许会员投稿 
						<?php if (!defined('XIAOCMS_MEMBER')) {?></div><?php } ?>
						<div class="onShow">子栏目开放投稿 上级栏目也要开放哦</div>
						</td>
					</tr>
					<tr <?php if (!defined('XIAOCMS_MEMBER')) {?>style="display:none;"<?php } ?>>
						<th >投稿审核：</th>
						<td>
						<input name="data[verify]" type="radio" value="0"<?php if ($data['verify']==0 || !$data['verify']) { ?> checked<?php } ?> >&nbsp;需要审核	&nbsp;&nbsp;&nbsp;
						<input name="data[verify]" type="radio" value="1"<?php if ($data['verify']==1) { ?> checked<?php } ?> >&nbsp;无需审核
						&nbsp;&nbsp;<div class="onShow">针对会员设置 游客无效</div>
						</td>
					</tr>
					<tr <?php if (!defined('XIAOCMS_MEMBER')) {?>style="display:none;"<?php } ?>>
						<th >查看权限：</th>
						<td>
						<input name="data[islook]" type="radio" value="0"<?php if ($data['islook']==0) { ?> checked<?php } ?> >&nbsp;任何人都可以查看
						&nbsp;&nbsp;&nbsp;
						<input name="data[islook]" type="radio" value="1"<?php if ($data['islook']==1) { ?> checked<?php } ?> >&nbsp;只有会员才可以查看
						</td>
					</tr>
					<tr>
						<th>栏目图片：</th>
						<td><?php echo $this->field->file('image',$data['image'],array('type'=>'gif,jpg,jpeg,png','preview'=>1,'size'=>2,'buttontxt'=>'上传图片')); ?></div>
						</td>
					</tr>
					<tr>
						<th >seo标题：</th>
						<td><input type="text" maxlength="60" size="60" value="<?php echo $data['seo_title']; ?>"   name="data[seo_title]" class="input-text"></td>
					</tr>
					<tr>
						<th>关键字：</th>
						<td><input type="text" maxlength="60" size="60" value="<?php echo $data['seo_keywords']; ?>"  name="data[seo_keywords]" class="input-text"></td>
					</tr>
					<tr>
						<th>描述：</th>
						<td><textarea style="width:90%;height:50px" name="data[seo_description]"><?php echo $data['seo_description']; ?></textarea></td>
					</tr>

					</table>

					</div>


					<div class="bk15"></div>
					<input type="submit" class="button" value="提交" name="submit">
				</div>
		</form>
</div>
<script type="text/javascript">
function ajaxdir() {
	var dir = $('#dir_text').val();
	if (dir == '') {
	    $.post('../index.php?c=api&a=pinyin&id='+Math.random(), { name:$('#dir').val() }, function(data){ $('#dir_text').val(data); });
	}
}

function SwapTab(name,cls_show,cls_hide,cnt,cur){
	for(i=1;i<=cnt;i++){
		if(i==cur){
			$('#div_'+name+'_'+i).show();
			$('#tab_'+name+'_'+i).attr('class',cls_show);
		}else{
			$('#div_'+name+'_'+i).hide();
			$('#tab_'+name+'_'+i).attr('class',cls_hide);
		}
	}
}

var data = <?php echo json_encode($this->content_model); ?>;

function settype(id) {
	$(".type_1").hide();
	$(".type_2").hide();
	$(".type_3").hide();
	$(".type_"+id).show();
	if (id ==2) {
		var page = $("#pagetpl").val();
		if (page) {}
		else {
			$("#pagetpl").val("page.html")
		}
	}
}

function change_tpl(mid) {
	$("#listtpl").val(data[mid]['listtpl']);
	$("#showtpl").val(data[mid]['showtpl']);
}
settype(<?php echo $data[typeid]; ?>);

</script>
</body>
</html>