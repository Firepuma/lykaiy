<?php
if (!defined('IN_XIAOCMS')) exit();

class field
{

    public static function input_setting($setting = '')
    {
        $setting['size'] = isset($setting['size']) ? $setting['size'] : '180';
        $setting['defaultvalue'] = isset($setting['defaultvalue']) ? $setting['defaultvalue'] : '';
        return '
	<table cellpadding="2" cellspacing="1" width="98%">
	<tr> 
      <th width="100">输入框长度：</th>
      <td><input type="text" name="data[setting][size]" value="' . $setting['size'] . '" size="10" class="input-text"><font color="gray">px</font></td>
    </tr>
	<tr> 
      <th>默认值：</th>
      <td><input type="text" name="data[setting][defaultvalue]" value="' . $setting['defaultvalue'] . '" size="40" class="input-text"></td>
    </tr>
	</table>';
    }

    public static function textarea_setting($setting = '')
    {
        $setting['width'] = isset($setting['width']) ? $setting['width'] : '100';
        $setting['height'] = isset($setting['height']) ? $setting['height'] : '46';
        $setting['defaultvalue'] = isset($setting['defaultvalue']) ? $setting['defaultvalue'] : '';
        return '
	<table cellpadding="2" cellspacing="1" width="98%">
	<tr>
      <th width="100">输入框宽度：</th>
      <td><input type="text" name="data[setting][width]" value="' . $setting['width'] . '" size="10" class="input-text"><font color="gray">px</font></td>
    </tr>
	<tr> 
      <th>输入框高度：</th>
      <td><input type="text" name="data[setting][height]" value="' . $setting['height'] . '" size="10" class="input-text"><font color="gray">px</font></td>
    </tr>
	<tr> 
      <th>默认值：</th>
      <td><textarea name="data[setting][defaultvalue]" rows="2" cols="20"  style="height:60px;width:250px;">' . $setting['defaultvalue'] . '</textarea></td>
    </tr>
	</table>';
    }

    public static function editor_setting($setting = '')
    {
        $setting['width'] = isset($setting['width']) ? $setting['width'] : '680';
        $setting['height'] = isset($setting['height']) ? $setting['height'] : '300';
        $setting['toolbar'] = isset($setting['toolbar']) ? $setting['toolbar'] : 0;
        $setting['items'] = isset($setting['items']) ? $setting['items'] : '';
        $setting['defaultvalue'] = isset($setting['defaultvalue']) ? $setting['defaultvalue'] : '';
        return '
	<table cellpadding="2" cellspacing="1" width="98%">
	<tbody>
	<tr> 
      <th width="100">编辑器样式：</th>
      <td><input type="radio" value="0" name="data[setting][toolbar]" ' . ($setting['toolbar'] == 0 ? 'checked' : '') . ' onclick="$(\'#editor_diy\').hide();"> 简洁型&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type="radio" value="1" name="data[setting][toolbar]"' . ($setting['toolbar'] == 1 ? 'checked' : '') . ' onclick="$(\'#editor_diy\').hide();"> 标准型&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type="radio" value="2" name="data[setting][toolbar]" ' . ($setting['toolbar'] == 2 ? 'checked' : '') . '  onclick="$(\'#editor_diy\').show();"> 自定义
	  </td>
    </tr>
	
	<tr  id="editor_diy"  ' . ($setting['toolbar'] != 2 ? 'style="display:none" ' : '') . ' > 
      <th>自定义配置：</th>
      <td><textarea name="data[setting][items]"  rows="5" cols="70" class="text">' . $setting['items'] . '</textarea><br/><font color="gray"><a href="http://www.xiaocms.com/X1help/9.html" target="_blank"  class="green">点击这里查看配置帮助文档</a></font></td>
    </tr>
	
	<tr> 
      <th>编辑器宽度：</th>
      <td><input type="text" name="data[setting][width]" value="' . $setting['width'] . '" size="10" class="input-text"><font color="gray">px</font></td>
    </tr>
	<tr> 
      <th>编辑器高度：</th>
      <td><input type="text" name="data[setting][height]" value="' . $setting['height'] . '" size="10" class="input-text"><font color="gray">px</font></td>
    </tr>
	<tr> 
      <th>默认值：</th>
      <td><textarea name="data[setting][defaultvalue]" rows="2" cols="70" >' . $setting['defaultvalue'] . '</textarea></td>
    </tr>
	</tbody>
	</table>';
    }

    public static function radio_setting($setting = '')
    {
        return self::select_setting($setting);
    }

    public static function checkbox_setting($setting = '')
    {
        $setting['checkboxhint'] = '多个默认选中值以“,”分开，格式：选中值1,选中值2。';
        return self::select_setting($setting);
    }

    public static function select_setting($setting = '')
    {
        $setting['content'] = isset($setting['content']) ? $setting['content'] : '';
        $setting['defaultvalue'] = isset($setting['defaultvalue']) ? $setting['defaultvalue'] : '';
        $setting['checkboxhint'] = isset($setting['checkboxhint']) ? $setting['checkboxhint'] : '';
        return '
    <table width="98%" cellspacing="1" cellpadding="2">
	<tbody>
	<tr> 
      <th width="100">选项列表 ：</th>
      <td><textarea name="data[setting][content]" style="width:400px;height:120px;" class="text">' . $setting['content'] . '</textarea><br/><font color="gray">格式：名称|赋值 (一行一个)。<a href="http://www.xiaocms.com/X1help/8.html" target="_blank"  class="green">详见帮助文档</a></font>
      </td>
    </tr>
	<tr> 
      <th>默认选中值 ：</th>
      <td><input type="text" name="data[setting][defaultvalue]" value="' . $setting['defaultvalue'] . '"  size="40" class="input-text"><font color="gray">' . $setting['checkboxhint'] . '这里填写的是赋值而不是名称哦</font></td>
    </tr>
    </tbody>
	</table>';
    }

    public static function files_setting($setting = '')
    {
        return self::file_setting($setting);
    }

    public static function file_setting($setting = '')
    {
        $setting['type'] = isset($setting['type']) ? $setting['type'] : '';
        $setting['size'] = isset($setting['size']) ? $setting['size'] : '2';
        $setting['preview'] = isset($setting['preview']) ? $setting['preview'] : 0;
        return '
    <table width="98%" cellspacing="1" cellpadding="2">
    <tbody>
	<tr> 
      <th width="100">允许格式 ：</th>
      <td><input type="text" class="input-text" size="50" value="' . $setting['type'] . '" name="data[setting][type]">
      <font color="gray">多个格式以,号分开，如：gif,png,jpg,zip,rar,tar</font>
      </td>
    </tr>
	<tr> 
      <th>图片预览 ：</th>
      <td><input type="radio" value="1" name="data[setting][preview]" ' . ($setting['preview'] == 1 ? 'checked' : '') . '> 显示预览&nbsp;&nbsp;
	  <input type="radio" value="0" name="data[setting][preview]"' . ($setting['preview'] == 0 ? 'checked' : '') . '> 关闭预览
      <div class="onShow">图片预览仅针对图片格式有效</div>
      </td>
    </tr>
    <tr> 
      <th>大小限制 ：</th>
      <td><input type="text" class="input-text" size="10" value="' . $setting['size'] . '" name="data[setting][size]">
      <font color="gray">MB</font>
      </td>
    </tr>
    </tbody>
	</table>';
    }

    public static function date_setting($setting = '')
    {
        $setting['type'] = isset($setting['type']) && $setting['type'] ? $setting['type'] : 'yyyy-MM-dd HH:mm:ss';
        return '
    <table width="98%" cellspacing="1" cellpadding="2">
    <tbody>
	<tr> 
      <th width="100">时间格式 ：</th>
      <td><input type="text" class="input-text" size="25" value="' . $setting['type'] . '" name="data[setting][type]">
      <font color="gray">格式yyyy-MM-dd HH:mm:ss 表示2014-02-06 11:20:20。</font>
      </td>
    </tr>
    </tbody>
	</table>';
    }

    public static function related_setting($setting = '')
    {
        $setting['size'] = isset($setting['size']) ? $setting['size'] : '200';
        $setting['defaultvalue'] = isset($setting['defaultvalue']) ? $setting['defaultvalue'] : '';
        return '
	<table cellpadding="2" cellspacing="1" width="98%">
	<tr> 
      <th width="100">输入框长度：</th>
      <td><input type="text" name="data[setting][size]" value="' . $setting['size'] . '" size="10" class="input-text"><font color="gray">px</font><div class="onShow">仅后台使用，请把投稿显示设置为隐藏</div></td>
    </tr>
	<tr> 
      <th>默认值：</th>
      <td><input type="text" name="data[setting][defaultvalue]" value="' . $setting['defaultvalue'] . '" size="40" class="input-text"><font color="gray">格式多个id,分开</font></td>
    </tr>
	</table>';
    }

    public static function diy_setting($setting = '')
    {
        $setting['form'] = isset($setting['form']) ? $setting['form'] : '';
        $setting['jscss'] = isset($setting['jscss']) ? $setting['jscss'] : '';
        $setting['isarr'] = isset($setting['isarr']) ? $setting['isarr'] : 0;
        return '
	<table cellpadding="2" cellspacing="1" width="98%">
	<tr> 
      <th width="100">输入表单：</th>
      <td><textarea name="data[setting][form]" rows="2" cols="20"  style="height:150px;width:600px;">' . $setting['form'] . '</textarea><br/><font color="gray"><a href="http://www.xiaocms.com/X1help/" target="_blank"  class="green">具体设计请看官方帮助文档</a></font></td>
    </tr>
	<tr> 
      <th >是否数组：</th>
      <td><input type="radio" value="1" name="data[setting][isarr]" ' . ($setting['isarr'] == 1 ? 'checked' : '') . '> 是&nbsp;&nbsp;
	  <input type="radio" value="0" name="data[setting][isarr]"' . ($setting['isarr'] == 0 ? 'checked' : '') . '> 否
	  </td>
    </tr>
	<tr> 
      <th>附加js/css：</th>
      <td><textarea name="data[setting][jscss]" rows="2" cols="20"  style="height:150px;width:600px;">' . $setting['jscss'] . '</textarea><br/><font color="gray"><a href="http://www.xiaocms.com/X1help/" target="_blank"  class="green">如果有js或css可在此添加，也可以在外部添加，没有可忽略，具体可以看帮助文档</a></font></td>
    </tr>
	</table>';
    }

    public static function input($name, $content = '', $setting = '')
    {
        $style = isset($setting['size']) ? " style='width:" . ($setting['size'] ? $setting['size'] : 150) . "px;'" : '';
        return '<input type="text" value="' . $content . '" class="input-text" name="data[' . $name . ']" ' . $style . '>';
    }

    public static function textarea($name, $content = '', $setting = '')
    {
        $style = isset($setting['width']) && $setting['width'] ? 'width:' . $setting['width'] . 'px;' : '';
        $style .= isset($setting['height']) && $setting['height'] ? 'height:' . $setting['height'] . 'px;' : '';
        return '<textarea style="' . $style . '" name="data[' . $name . ']">' . $content . '</textarea>';
    }

    public static function editor($name, $content = '', $setting = '')
    {
        $width = isset($setting['width']) && $setting['width'] ? $setting['width'] : '680';
        $height = isset($setting['height']) && $setting['height'] ? $setting['height'] : '420';
        $str = '';
        $page = !isset($setting['system']) && $name == 'content' ? ", 'pagebreak'" : '';
        $source = defined('XIAOCMS_ADMIN') ? "'source', '|'," : '';
        $other = defined('XIAOCMS_ADMIN') || defined('XIAOCMS_MEMBER') ? "allowFileManager : true, uploadJson : './index.php?c=uploadfile&a=kindeditor_upload', fileManagerJson : './index.php?c=uploadfile&a=kindeditor_filemanager'," : "allowImageUpload: false, allowFlashUpload: false,allowMediaUpload:false,allowFileUpload:false,";
		
        $items = isset($setting['items']) && $setting['items'] ? $setting['items'] : '';

        if (!defined('XIAOCMS_EDITOR_LD')) {
            $str .= '<script type="text/javascript" src="../core/img/kindeditor/kindeditor-min.js"></script>';
            define('XIAOCMS_EDITOR_LD', 1);
        }
		if ($setting['toolbar'] == 2) {
            $str .= "<script type=\"text/javascript\">
		KindEditor.ready(function(K) {
                window.editor = K.create('#" . $name . "', { 
				" . $other . "
				items:[" . $items . "]
			});
        });
		</script>";
        } else if ($setting['toolbar'] == 1) {
            $str .= "<script type=\"text/javascript\">
		KindEditor.ready(function(K) {
                window.editor = K.create('#" . $name . "', { 
				" . $other . "
				items:[" . $source . "'forecolor','bold','italic','underline','lineheight','|','fontname','fontsize','code','plainpaste','wordpaste','|','image','multiimage','flash','media','insertfile','link','unlink','|','justifyleft','justifycenter','justifyright','justifyfull','insertorderedlist','insertunorderedlist','indent','outdent','clearhtml','quickformat','hr','baidumap'" . $page . ",'|','fullscreen']
			});
        });
		</script>";
        } else {
            $str .= "<script type=\"text/javascript\">
		KindEditor.ready(function(K) {
                window.editor = K.create('#" . $name . "', { 
				" . $other . "
				items:[" . $source . "'forecolor','bold','italic','underline','|','image','flash','media','insertfile','link','unlink','fontname','fontsize','|','justifyleft','justifycenter','justifyright','justifyfull','clearhtml','quickformat','baidumap','|','fullscreen']
			});
        });
		</script>";
        }
        $str .= '<textarea id="' . $name . '" name="data[' . $name . ']" style="width:' . $width . 'px;height:' . $height . 'px;">' . $content . '</textarea>';
        if (!isset($setting['system']) && $name == 'content' && defined('XIAOCMS_ADMIN')) {
            $str .= '<div style="padding-top:3px;"><label><input type="checkbox" checked value="1" name="data[xiao_auto_description]">自动获取摘要 </label> <label><input type="checkbox" checked value="1" name="data[xiao_auto_thumb]">自动获取缩略图</label> <label><input type="checkbox" checked value="1" name="data[xiao_download_image]">下载远程图片</label></div>';
        }
        return $str;
    }

    public static function select($name, $content = '', $setting = '')
    {
        $select = explode(chr(13), $setting['content']);
        $str = "<select id='" . $name . "' name='data[" . $name . "]'>";
        foreach ($select as $t) {
            $select_name = $select_value = $selected = '';
            list($select_name, $select_value) = explode('|', $t);
            $select_value = is_null($select_value) ? trim($select_name) : trim($select_value);
            $selected = $select_value == $content ? ' selected' : '';
            $str .= "<option value='" . $select_value . "'" . $selected . ">" . $select_name . "</option>";
        }
        return $str . '</select>';
    }

    public static function radio($name, $content = '', $setting = '')
    {
        $select = explode(chr(13), $setting['content']);
        $str = '';
        foreach ($select as $t) {
            $select_name = $select_value = $selected = '';
            list($select_name, $select_value) = explode('|', $t);
            $select_value = is_null($select_value) ? trim($select_name) : trim($select_value);
            $selected = $select_value == $content ? ' checked' : '';
            $str .= $select_name . '&nbsp;<input type="radio" name="data[' . $name . ']" value="' . $select_value . '" ' . $selected . '/>&nbsp;&nbsp;';
        }
        return $str;
    }

    public static function checkbox($name, $content = '', $setting = '')
    {
        $arr = string2array($content);
        if ($arr) $content = $arr;
        else $content = @explode(',', $content);
        $select = explode(chr(13), $setting['content']);
        $str = '';
        foreach ($select as $t) {
            $select_name = $select_name = $selected = '';
            list($select_name, $select_value) = explode('|', $t);
            $select_value = is_null($select_value) ? trim($select_name) : trim($select_value);
            $selected = is_array($content) && in_array($select_value, $content) ? ' checked' : '';
            $str .= $select_name . '&nbsp;<input type="checkbox" name="data[' . $name . '][]" value="' . $select_value . '" ' . $selected . ' />&nbsp;&nbsp;';
        }
        return $str;
    }

    public static function file($name, $content = '', $setting = '')
    {
        $_type = explode(',', $setting['type']);
        if ($setting['buttontxt']) {
            $txt = $setting['buttontxt'];
        } else {
            $txt = '上传文件';
        }
        foreach ($_type as $t) {
            $type .= '*.' . $t . ';';
        }
        $size = $setting['size'] * 1024;
        $js = "<script type=\"text/javascript\">
$(function() {
var Button=$(\"#button_" . $name . "\");
	Button.uploadify({
		height : '22',
		width : '68',
		swf           : '../core/img/uploadify/uploadify.swf?ver='+ Math.random(),
		uploader      : './index.php?c=uploadfile&a=uploadify_upload&type=" . $setting['type'] . "',
 		method   : 'post',
		formData : { 'submit' : '1',
		                    'session_id' : '" . session_id() . "'
						},
        fileTypeExts: '" . $type . "',  
        fileObjName:'file',
		buttonText: '" . $txt . "',
        queueSizeLimit: 1,
		fileSizeLimit   : '" . $size . "', 
		onUploadSuccess :function(file,data,response){
		$(\"#" . $name . "\").val(data);
		},
		'onUploadProgress':function(file,bytesUploaded,bytesTotal,totalBytesUploaded,totalBytesTotal){
			var num = Math.round(bytesUploaded / bytesTotal * 10000) / 100.00 + \"%\";
			Button.uploadify('settings','buttonText','上传：' + num);
		},
		'onQueueComplete' : function(queueData) {
			Button.uploadify('disable', false);
			Button.uploadify('settings','buttonText','上传');
			Button.uploadify('cancel','*');
		}
	});
	});</script>";
        $preview = $setting['preview'] ? 'onmouseover="showImg(this)"  onmouseout="hideImg(this)"' : '';
        return $js . '
	<input type="text" class="input-text"  size="50" value="' . $content . '" name="data[' . $name . ']" id="' . $name . '" ' . $preview . '>
	<input id="button_' . $name . '" type="file" multiple="true">';
    }

    public static function files($name, $content = '', $setting = '')
    {
        $preview = $setting['preview'] ? 'onmouseover="showImg(this)"  onmouseout="hideImg(this)"' : '';
        if ($setting['preview']) $p = 1;
        else $p = 0;
        $_type = explode(',', $setting['type']);
        foreach ($_type as $t) {
            $type .= '*.' . $t . ';';
        }
        $size = $setting['size'] * 1024;
        $js = "<script type=\"text/javascript\">
$(function() {
var Button=$(\"#button_" . $name . "\");
	Button.uploadify({
		height : '22',
		width : '68',
		swf           : '../core/img/uploadify/uploadify.swf?ver='+ Math.random(),
		uploader      : './index.php?c=uploadfile&a=uploadify_upload&type=" . $setting['type'] . "',
 		method   : 'post',
		formData : { 'submit' : '1',
		                    'session_id' : '" . session_id() . "'
						},
        fileTypeExts: '" . $type . "',  
        fileObjName:'file',
		buttonText: '批量上传',
        queueSizeLimit: 10,
		fileSizeLimit   : '" . $size . "', 
		onUploadSuccess :function(file,data,response){
		htmlList('" . $name . "',data,file,'" . $preview . "');
		},
		'onUploadProgress':function(file,bytesUploaded,bytesTotal,totalBytesUploaded,totalBytesTotal){
			var num = Math.round(bytesUploaded / bytesTotal * 10000) / 100.00 + \"%\";
			Button.uploadify('settings','buttonText','上传：' + num);
		},
		'onQueueComplete' : function(queueData) {
			Button.uploadify('disable', false);
			Button.uploadify('settings','buttonText','上传');
			Button.uploadify('cancel','*');
		}
	});
	});</script>";
        $str = '
	    <fieldset class="blue pad-10">
        <legend>上传文件列表</legend>
        <div class="picList" id="list_' . $name . '_files"><ul id="' . $name . '-sort-items">';
        if ($content) {
            $content = string2array($content);
            $fileurl = $content['fileurl'];
            $filename = $content['filename'];
            if (is_array($fileurl) && !empty($fileurl)) {
                foreach ($fileurl as $id => $path) {
                    $str .= '<li id="files_999' . $id . '">';
                    $str .= '<input type="text" class="input-text" style="width:450px;" value="' . $fileurl[$id] . '" name="data[' . $name . '][fileurl][]"  id="' . $name . $id . '" ' . $preview . '>';
                    $str .= '<input type="text" class="input-text" style="width:160px;" value="' . $filename[$id] . '" name="data[' . $name . '][filename][]">';
                    $str .= '<a href="javascript:removediv(\'999' . $id . '\');">删除</a></li>';
                }
            }
        }
        $str .= '</ul></fieldset>
		<div class="bk10"></div>
		<input type="button"  class="button" value="添加地址" name="delete" onClick="add_null_file(\'' . $name . '\')" >&nbsp;
		<input id="button_' . $name . '" type="file" multiple="true">
		';
        return $js . $str;
    }

    public static function date($name, $content = '', $setting = '')
    {
        $type = isset($setting['type']) ? $setting['type'] : 'yyyy-MM-dd HH:mm:ss';
        if ($setting['system']) $content = $content ? date('Y-m-d H:i:s', $content) : date('Y-m-d H:i:s'); //系统内置日期字段和自定义是不一样的
        $str = '';
        if (!defined('XIAOCMS_DATE_LD')) {
            $str .= '<script type="text/javascript" src="../core/img/calendar/lhgcalendar.min.js"></script>';
            define('XIAOCMS_DATE_LD', 1); //防止重复加载JS
        }
        return $str . '
	<input type="text" class="date input-text" style="width:150px;" name="data[' . $name . ']" value="' . $content . '" id="' . $name . '" >
	<script type="text/javascript">
	$(function(){
    $("#' . $name . '").calendar({format : \'' . $type . '\'});
	});
    </script>';
    }
	
    public static function related($name, $content = '', $setting = '')
    {
     	$style = isset($setting['size']) ? " style='width:" . ($setting['size'] ? $setting['size'] : 200) . "px;'" : '';
		if ($content) {
	    	$_db = xiaocms::load_class('Model');
			$view = xiaocms::load_class('view');
	    	$_ids = $_db->setTableName('content')->getAll('id IN ('.$content.')',null,'id,title','id desc');
            foreach ($_ids as $t) {
               $ids .= '<li id="v1' . $t['id'] . '"><span><a href='.$view->get_show_url($t).' target="_blank">' . $t['title'] . '</a></span><a href="javascript:;" class="close" onclick="remove_relation(\'v1' . $t['id'] . '\',' . $t['id'] . ',\'' . $name . '\')"></a></li>';
            }
		}
        $str = '
		<input type="text" class="input-text" name="data[' . $name . ']" id="' . $name . '" readonly value="' . $content . '"  ' . $style . '  >
		<input type="button" value="添加相关" onClick="omnipotent(\'selectid\',\'' . url('content/related', array('name'=>$name)) . '\',\'添加相关内容\',1)" class="button">
		<ul class="list-dot" id="' . $name . '_text">' . $ids . '</ul>
		';
        return $str;
    }
	
    public static function diy($name, $content = '', $setting = '')
    { 
    	if (!empty($setting['isarr']))	$content = string2array($content);
        $form =  $setting['form'];
		$form = str_replace('$','',$form);
		$form = str_replace('xiao_field_name','$name',$form);
		$form = str_replace('xiao_field_value','$content',$form);
        eval( "\$form = \"$form\";" );
        return htmlspecialchars_decode($setting['jscss'] . $form);
    }
	
}