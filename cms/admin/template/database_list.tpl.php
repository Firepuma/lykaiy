<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '数据库备份';
</script>
<div class="subnav">
	<div class="content-menu">
		<a href="<?php echo url('database/import'); ?>" class="on2"><em>数据库恢复</em></a>
	</div>
	<div class="bk10"></div>

<form method="post" name="myform" id="myform" action="">
<input name="list_form" id="list_form" type="hidden" value="">
<table width="100%"  class="m-table m-table2 m-table-row">
<thead class="m-table-thead s-table-thead">
       <tr>
           <th width="120" align="left">表类型</th>
           <th  align="left">表名</th>
           <th  align="left">记录数</th>
           <th  align="left">使用空间</th>
           <th  align="left">碎片</th>
           <th  width="130"  align="left">操作</th>
       </tr>
    </thead>
    <tbody >
	<?php foreach($data as $v){?>
	<tr >
	<td align="left"><input <?php if ($v['xiaosys']) echo 'class="selectform"';?> type="checkbox" name="table[]" value="<?php echo $v['Name']?>"/>
	  <?php if ($v['xiaosys']) echo '<font color="#c00">XiaoCms系统表</font>'; else echo '<font color="#369">其他系统表</font>';?></td>
	<td align="left"><?php echo $v['Name']?></td>
	<td align="left"><?php echo $v['Rows']?></td>
	<td align="left"><?php echo file_size_count($v['Data_length']+$v['Index_length'])?></td>
	<td align="left"><?php echo file_size_count($v['Data_free'])?></td>
	<td align="left">
    <a href="<?php echo url("database/repair", array("name"=>$v['Name']))?>">修复</a> | 
    <a href="<?php echo url("database/optimize", array("name"=>$v['Name']))?>">优化</a> | 
    <a href="javascript:void(0);" onclick="showcreat('<?php echo $v['Name']?>')">结构</a>
    </td>

	</tr>
	<?php }
	if (is_array($data)) {
	?>
    <tr >
	<td colspan="6" align="left">选择XiaoCms系统表&nbsp;&nbsp;<input name="selectform" class="cselectform" type="checkbox" onClick="setdb()">
	&nbsp;&nbsp;<input type="submit" class="button" value="开始备份" name="submit" ></td>
	</tr>
    <?php }?>
	</tbody>
</table>
<div class="btn">&nbsp;</div>
</form>
</div>
<script language="javascript">
function setdb() {
	if($(".cselectform").attr('checked')) {
		$(".selectform").attr("checked",true);
	} else {
		$(".selectform").attr("checked",false);
	}
}
function showcreat(tblname) {

	location.href='<?php echo url("database/table")?>&name='+tblname+'';
}
</script>
</body>
</html>
