<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '系统配置';
</script>
<div class="subnav">
	<form method="post" action="" id="myform" name="myform">
	<div class="pad-10">
		<div class="col-tab">
			<ul class="tabBut cu-li">
				<li onClick="SwapTab('setting','on','',7,1);" class="<?php if ($type==1) { ?>on<?php } ?>" id="tab_setting_1">基本设置</li>
				<li onClick="SwapTab('setting','on','',7,2);" id="tab_setting_2" class="<?php if ($type==2) { ?>on<?php } ?>">系统设置</li>
				<?php if (defined('XIAOCMS_MEMBER')) {?>
				<li onClick="SwapTab('setting','on','',7,3);" id="tab_setting_3" class="<?php if ($type==3) { ?>on<?php } ?>">会员配置</li>
				<?php } ?>
				<li onClick="SwapTab('setting','on','',7,4);" id="tab_setting_4" class="<?php if ($type==4) { ?>on<?php } ?>">URL配置</li>
				</ul>
			<div class="contentList pad-10" id="div_setting_1" style="display: none;">
			<table width="100%" class="table_form">
				<tr>
					<th width="100">网站名称： </th>
					<td><input class="input-text" type="text" name="data[site_name]" value="<?php echo $data['site_name']; ?>" size="30"/><div class="onShow">网站名称</div></td>
				</tr>
				<tr>
					<th>默认模板： </th>
					<td><select  class="select"  name="data[site_theme]">
					<?php if (is_array($theme)) { foreach ($theme as $t) { ?>
					<option value="<?php echo $t; ?>" <?php if ($data['site_theme']==$t) { ?>selected<?php } ?>><?php echo $t; ?></option>
					<?php }  }  ?>
					</select> &nbsp;&nbsp;手机版：<input name="data[site_mobile]" type="radio" value="1" <?php if (!empty($data['site_mobile'])) { ?>checked<?php } ?> /> 开启
					&nbsp;&nbsp;&nbsp;<input name="data[site_mobile]" type="radio" value="0" <?php if (empty($data['site_mobile'])) { ?>checked<?php } ?> /> 关闭
					<div class="onShow">开启后用手机访问自动显示手机版</div></td>
				</tr>
				<tr>
					<th>首页标题： </th>
					<td><input class="input-text" type="text" name="data[site_title]" value="<?php echo $data['site_title']; ?>" size="70"/></td>
				</tr>
				<tr>
					<th>关键字：</th>
					<td class="y-bg"><input class="input-text" type="text" name="data[site_keywords]" value="<?php echo $data['site_keywords']; ?>" size="70"/></td>
				</tr>
				<tr>
					<th>网站描述：</th>
					<td><textarea name="data[site_description]" rows="3" cols="70" class="text"><?php echo $data['site_description']; ?></textarea></td>
				</tr>
			</table>
			</div>

			<div class="contentList pad-10 hidden" id="div_setting_2" style="display: none;">
			<table width="100%" class="table_form ">
			<tr>
				<th width="100">自定义推荐位：</th>
				<td><textarea name="data[site_status]" rows="5" cols="55" class="text"><?php echo $data['site_status']; ?></textarea><br/><div class="onShow">(0=未审核,1=正常,不可用于其他) 格式为 数字|名称 </div></td>
			</tr>
			<tr>
				<th>下载远程图片： </th>
				<td><input name="data[site_download_image]" type="radio" value="1" <?php if (!empty($data['site_download_image'])) { ?>checked<?php } ?> /> 打开
					&nbsp;&nbsp;&nbsp;<input name="data[site_download_image]" type="radio" value="0" <?php if (empty($data['site_download_image'])) { ?>checked<?php } ?> /> 关闭
					<div class="onShow">选择关闭后则编辑器下方的下载远程图片按钮无效</div>
				</td>
			</tr>
			<tr>
				<th>图片水印设置： </th>
				<td>
				<input name="data[site_watermark]" type="radio" value="0" <?php if (empty($data['site_watermark'])) { ?>checked<?php } ?> onClick="setSateType(0)"> 关闭水印&nbsp;&nbsp;&nbsp;<input name="data[site_watermark]" type="radio" value="1" <?php if (!empty($data['site_watermark'])) { ?>checked<?php } ?> onClick="setSateType(1)"> 开启图片水印</td>
			</tr>
			<tbody id="w_0">
			<tr>
				<th>水印位置： </th>
				<td>
				<table width="400">
				<tr>
					<td><input type="radio" <?php if ($data['site_watermark_pos']==1) { ?>checked=""<?php } ?> value="1" name="data[site_watermark_pos]"> 顶部居左</td>
					<td><input type="radio" <?php if ($data['site_watermark_pos']==2) { ?>checked=""<?php } ?> value="2" name="data[site_watermark_pos]"> 顶部居中</td>
					<td><input type="radio" <?php if ($data['site_watermark_pos']==3) { ?>checked=""<?php } ?> value="3" name="data[site_watermark_pos]"> 顶部居右</td>
				</tr>
				<tr>
					<td><input type="radio" <?php if ($data['site_watermark_pos']==4) { ?>checked=""<?php } ?> value="4" name="data[site_watermark_pos]"> 中部居左</td>
					<td><input type="radio" <?php if ($data['site_watermark_pos']==5) { ?>checked=""<?php } ?> value="5" name="data[site_watermark_pos]"> 中部居中</td>
					<td><input type="radio" <?php if ($data['site_watermark_pos']==6) { ?>checked=""<?php } ?> value="6" name="data[site_watermark_pos]"> 中部居右</td>
				</tr>
				<tr>
					<td><input type="radio" <?php if ($data['site_watermark_pos']==7) { ?>checked=""<?php } ?> value="7" name="data[site_watermark_pos]"> 底部居左</td>
					<td><input type="radio" <?php if ($data['site_watermark_pos']==8) { ?>checked=""<?php } ?> value="8" name="data[site_watermark_pos]"> 底部居中</td>
					<td><input type="radio" <?php if (empty($data['site_watermark_pos']) || $data['site_watermark_pos']==9) { ?>checked=""<?php } ?> value="9" name="data[site_watermark_pos]"> 底部居右</td>
				</tr>
				</table>
				<div class="onShow">水印图片地址：/core/img/watermark/watermark.png</div></td>
			</tr>
			</tbody>
			</table>
			<script type="text/javascript">
			function setSateType(id) {
				if (id == 0) {
					$('#w_1').hide();
					$('.w_2').hide();
					$('#w_0').hide();
				} else if(id == 1) {
					$('.w_2').hide();
					$('#w_1').show();
					$('#w_0').show();
				} 
			}
			setSateType(<?php echo $data['site_watermark']; ?>);
			</script>
			</div>

			<div class="contentList pad-10 hidden" id="div_setting_3" style="display: none;" >
				<table width="100%" class="table_form">
				<tr>
					<th width="150">默认会员模型： </th>
					<td><select name="data[member_modelid]"><option value="0"> -- </option>
					<?php if (is_array($membermodel)) {foreach ($membermodel as $t) { ?>
					<option value="<?php echo $t['modelid']; ?>" <?php if ($data['member_modelid']==$t['modelid']) { ?>selected<?php } ?>><?php echo $t['modelname']; ?></option>
					<?php } } ?></select></td>
				</tr>
				
				<tr>
					<th >新会员注册： </th>
					<td><input name="data[member_register]" type="radio" value="1" <?php if ($data['member_register']==1) { ?>checked<?php } ?>> 打开
					&nbsp;&nbsp;&nbsp;<input name="data[member_register]" type="radio" value="0" <?php if ($data['member_register']==0) { ?>checked<?php } ?>> 关闭</td>
				</tr>
				<tr>
					<th>新会员审核： </th>
					<td><input name="data[member_status]" type="radio" value="1" <?php if ($data['member_status']==1) { ?>checked<?php } ?>> 打开
					&nbsp;&nbsp;&nbsp;<input name="data[member_status]" type="radio" value="0" <?php if ($data['member_status']==0) { ?>checked<?php } ?>> 关闭</td>
				</tr>
				<tr>
					<th>注册验证码： </th>
					<td><input name="data[member_regcode]" type="radio" value="1" <?php if ($data['member_regcode']==1) { ?>checked<?php } ?>> 打开
					&nbsp;&nbsp;&nbsp;<input name="data[member_regcode]" type="radio" value="0" <?php if ($data['member_regcode']==0) { ?>checked<?php } ?>> 关闭</td>
				</tr>
				<tr>
					<th>登录验证码： </th>
					<td><input name="data[member_logincode]" type="radio" value="1" <?php if ($data['member_logincode']==1) { ?>checked<?php } ?>> 打开
					&nbsp;&nbsp;&nbsp;<input name="data[member_logincode]" type="radio" value="0" <?php if ($data['member_logincode']==0) { ?>checked<?php } ?>> 关闭</td>
				</tr>
				</table>
				</div>

			<div class="contentList pad-10 hidden" id="div_setting_4" style="display: none;">
					<table width="100%" class="table_form">
					<tbody>
					<tr>
						<th width="200">自定义URL模式： </th>
						<td>
						<input name="data[diy_url]" type="radio" value="2" <?php if ($data['diy_url']==2) { ?>checked<?php } ?>   onClick="$('#url').show()"> <span style="color:#f00">生成静态 
						</span>&nbsp;&nbsp;&nbsp;
						<input name="data[diy_url]" type="radio" value="1" <?php if ($data['diy_url']==1) { ?>checked<?php } ?>   onClick="$('#url').show()"> 伪静态
						&nbsp;&nbsp;&nbsp;
						<input name="data[diy_url]" type="radio" value="0" <?php if (!$data['diy_url']) { ?>checked<?php } ?> onClick="$('#url').hide()"> 动态 <div class="onShow">更改url规则后请更新缓存</div></td>
					</tr>
					</tbody>
					<tbody id="url" style="display:<?php if (!$data['diy_url']) { ?>none<?php } ?>">

					<tr>
						<th width="200">栏目URL格式： </th>
						<td><input  class="input-text" type="text" name="data[list_url]" value="<?php echo $data['list_url']; ?>" size="40"/>
						<div class="onShow">参数说明：&nbsp;{catdir} 表示栏目目录 ，{catid} 表示栏目ID</div>
						</td>
					</tr>
					<tr>
						<th>栏目URL格式(带分页)： </th>
						<td><input  class="input-text" type="text" name="data[list_page_url]" value="<?php echo $data['list_page_url']; ?>" size="40"/>
						<div class="onShow">参数说明：&nbsp;{catdir} 表示栏目目录 ，{catid} 表示栏目ID ，{page}表示分页参数</div>
						</td>
					</tr>
					<tr>
						<th>内容URL格式： </th>
						<td><input  class="input-text" type="text" name="data[show_url]" value="<?php echo $data['show_url']; ?>" size="40"/>
						<div class="onShow">参数说明：&nbsp;{catdir} 表示栏目目录 ，{id} 表示内容ID ，备注：&nbsp;{id}必须存在</div>
						</td>
					</tr>
					<tr>
						<th>内容URL格式(带分页)： </th>
						<td><input  class="input-text" type="text" name="data[show_page_url]" value="<?php echo $data['show_page_url']; ?>" size="40"/>
						<div class="onShow">参数说明：&nbsp;{catdir} 表示栏目目录 ，{id} 表示内容ID ，{page}表示分页参数 备注：&nbsp;{id}必须存在</div>
						</td>
					</tr>
					<tr>
						<th >伪静态规则在线生成：</th>
						<td><p><a target="_blank" href="http://www.xiaocms.com/index.php?c=rewrite">在线生成伪静态规则</a></p>
						</td>
					</tr>
					<tr>
						<th >生成静态功能收费说明：</th>
						<td><p><a target="_blank" href="http://www.xiaocms.com/buy/" style="color: #f00;">生成静态功能是收费的，购买方式请看：http://www.xiaocms.com/buy/</a></p>
						</td>
					</tr>

					</tbody>
					</table>
					</div>
					
			<div class="bk15"></div>
			<input type="submit" class="button" value="提交" name="submit">
		</div>
	</div>
	</form>
</div>
<script type="text/javascript">
$('#div_setting_<?php echo $type; ?>').show();
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
</script>
</body>
</html>