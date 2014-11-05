<?php include $this->admin_tpl('header');?>
<div class="subnav" style="padding-bottom: 0;">
	<div class="content-menu">
		<div class="left">
		<select class="select"  name="movecatid"  onchange="self.location.href=options[selectedIndex].value">
    	<option  value="<?php echo url('content/related', array('name'=>$name)); ?>">全部栏目</option>
		<?php echo $category; ?>
		</select>
		<?php if (is_array($this->status_arr)) { ?><select class="select"  name="pageselect" onchange="self.location.href=options[selectedIndex].value" >
		<option  value="<?php echo url('content/related', array('catid'=>$catid ,'name'=>$name)); ?>" <?php if (!isset($status)) { ?>selected<?php } ?>>全部</option>
		<?php foreach ($this->status_arr  as $key=>$t) { ?>
		<option value="<?php echo url('content/related', array('catid'=>$catid, 'status'=>$key ,'name'=>$name)); ?>"  <?php if (isset($status) && $status==$key) { ?>selected<?php } ?>><?php echo $t; ?></option>
		<?php } ?></select><?php } ?>
		</div>
		<div class="left">
		<form method="get" action="" >
		<input type="hidden"  value="content"  name="c" />
		<input type="hidden"  value="related"  name="a" />
		<input type="hidden"  value="<?php echo $name; ?>"  name="name" />
		<input name="catid" type="hidden" value="<?php echo $catid; ?>">
		<input type="text" size="18" value="<?php echo $title; ?>" class="input-text"  name="title" />
		<input type="submit"  class="button"  value="搜索标题"   />
        </form>
		</div>

	</div>
	<div class="bk10"></div>
		<table width="100%"  class="m-table m-table-row">
		<thead class="m-table-thead s-table-thead" style="background: #f5f5f5;">
		<tr>
			<th width="24" align="left">选择</th>
			<th align="left">标题</th>
			<th width="80" align="left">栏目</th>
			<th width="80" align="left">更新时间</th>
		</tr>
		</thead>
		<tbody>
		<?php if (is_array($list)) foreach ($list as $t) { ?>
		<tr>
			<td align="center">
			
			<input type="checkbox" class="deletec" onClick="select_list(this,'<?php echo $t['title']; ?>',<?php echo $t['id']; ?>,'<?php echo $this->view->get_show_url($t); ?>')"  title="点击选择" ></td>
			<td align="left">
			<?php if (is_array($this->status_arr))  foreach ($this->status_arr  as $key=>$r) { ?>
			<?php  if ($t['status']==$key) {?>
			<a href="<?php echo url('content/related', array('catid'=>$catid, 'status'=>$key,'name'=>$name)); ?>"><font color="#f00">[<?php echo $r; ?>]</font></a>
			<?php }  ?>
			<?php } ?><?php echo $t['title']; ?>
			</td>
			<td align="left"><a href="<?php echo url('content/related',array('catid'=>$t['catid'] ,'name'=>$name)); ?>"><?php echo $this->category_cache[$t['catid']]['catname']; ?></a></td>
			
			<td align="left"><span style="<?php if (date('Y-m-d', $t['time']) == date('Y-m-d')) { ?>color:#F00<?php } ?>" title="<?php echo date('H:i', $t['time']); ?>"><?php echo date('Y-m-d', $t['time']); ?></span></td>
			
		</tr>
		<?php } ?>
		<tr >
			<td colspan="4"  align="left" style="border-bottom:0px;">
			<div  class="pageleft"><?php echo $pagelist; ?></div>
			</td>
		</tr>	

		</tbody>
		</table>
</div>
<script>
function select_list(obj, title, id,url) {
    var relation_ids = window.parent.$('#<?php echo $name; ?>').val();
    var sid = 'v1' + id;
    if ($(obj).attr('class') == 'line_ff9966' || $(obj).attr('class') == null) {
        $(obj).attr('class', 'line_fbffe4');
        window.parent.$('#' + sid).remove();
        if (relation_ids != '') {
            var r_arr = relation_ids.split(',');
            var newrelation_ids = '';
            $.each(r_arr, function (i, n) {
                if (n != id) {
                    if (i == 0) {
                        newrelation_ids = n;
                    } else {
                        newrelation_ids = newrelation_ids + ',' + n;
                    }
                }
            });
            window.parent.$('#<?php echo $name; ?>').val(newrelation_ids);
        }
    } else {
        $(obj).attr('class', 'line_ff9966');
        var str = "<li id='" + sid + "'><span><a href='" + url + "'\" target=\"_blank\">" + title + "</a></span><a href='javascript:;' class='close' onclick=\"remove_relation('" + sid + "'," + id + ",'<?php echo $name; ?>')\"></a></li>";
        window.parent.$('#<?php echo $name; ?>_text').append(str);
        if (relation_ids == '') {
            window.parent.$('#<?php echo $name; ?>').val(id);
        } else {
            relation_ids = relation_ids + ',' + id;
            window.parent.$('#<?php echo $name; ?>').val(relation_ids);
        }
    }
}
</script>
</body>
</html>