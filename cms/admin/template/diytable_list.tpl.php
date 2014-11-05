<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '自定义表列表';
</script>

<div class="subnav">
	<div class="content-menu">
		<a href="<?php echo url('diytable/index',array('modelid'=>$modelid)); ?>" class="on2"><em><?php echo $this->model['modelname'] ?></em></a>
		<?php if($this->menu('diytable-add')) { ;?>
	    <a href="<?php echo url('diytable/add',array('modelid'=>$modelid)); ?>"	class="add" ><em>发布内容</em></a>
    	<?php } ?>
	</div>
	<div class="bk10"></div>

		<form action="" method="post"  name="myform" id="myform">
		<input name="status" id="list_form" type="hidden" value="">
		<table width="100%"  class="m-table m-table-row" id="imgPreview">
		<thead class="m-table-thead s-table-thead">
		<tr>
			<th width="20" align="left"><input name="deletec" id="deletec" type="checkbox" onClick="setC()"></th>
			<th width="20"  align="left">ID </th>
			<?php if (is_array($this->model['setting']['form']['show'])) foreach ($this->model['setting']['form']['show'] as $f) { ?>
			<th align="left"><?php echo $this->model['fields'][$f]['name']; ?></th>
			<?php } ?>
			<th width="100"  align="left">操作</th>
		</tr>
		</thead>
		<tbody >
		<?php if (is_array($list)) { foreach ($list as $t) { ?>
		<tr >
			<td align="left"><input name="formidarr[]" value="<?php echo $t['id']; ?>"type="checkbox" class="deletec"></td>
			<td align="left"><?php echo $t['id']; ?></td>
			<?php if (is_array($this->model['setting']['form']['show']))  foreach ($this->model['setting']['form']['show'] as $f) { ?>
			<td align="left">
			<?php $img = string2array($this->model['fields'][$f]['setting']); if(!empty($img['preview']) && $this->model['fields'][$f]['formtype']=='file'){ ?>
			<a href="javascript:;" rel="<?php echo $t[$f]; ?>" ><img src="<?php echo $t[$f]; ?>"  onload="javascript:if(this.width>100)this.width=100"></a>
			<?php } else echo $t[$f]; ?>
			</td>
			<?php }   ?>
			<td align="left">
			<a href="<?php echo url('diytable/edit',array('id'=>$t['id'],'modelid'=>$modelid, 'cid'=>$cid)); ?>">查看编辑</a> | 
			<a  href="javascript:confirmurl('<?php echo url('diytable/del/',array('modelid'=>$modelid,'id'=>$t['id'], 'cid'=>$cid));?>','确定删除 吗？')" >删除</a> 
			</td>
		</tr>
		<?php } } ?>

		</tbody>
		</table><br/>
			<div class="pageleft">
			<input type="submit" class="button" value="删除" name="submit_del" onClick="confirm_delete()">&nbsp;
		</div>
			<div class="pageright"><?php echo  $pagelist; ?></div>
		</form>
</div>
<script type="text/javascript">
(function(c){c.expr[':'].linkingToImage=function(a,g,e){return!!(c(a).attr(e[3])&&c(a).attr(e[3]).match(/\.(gif|jpe?g|png|bmp)$/i))};c.fn.imgPreview=function(j){var b=c.extend({imgCSS:{},distanceFromCursor:{top:10,left:10},preloadImages:true,onShow:function(){},onHide:function(){},onLoad:function(){},containerID:'imgPreviewContainer',containerLoadingClass:'loading',thumbPrefix:'',srcAttr:'href'},j),d=c('<div/>').attr('id',b.containerID).append('<img/>').hide().css('position','absolute').appendTo('body'),f=c('img',d).css(b.imgCSS),h=this.filter(':linkingToImage('+b.srcAttr+')');function i(a){return a.replace(/(\/?)([^\/]+)$/,'$1'+b.thumbPrefix+'$2')}if(b.preloadImages){(function(a){var g=new Image(),e=arguments.callee;g.src=i(c(h[a]).attr(b.srcAttr));g.onload=function(){h[a+1]&&e(a+1)}})(0)}h.mousemove(function(a){d.css({top:a.pageY+b.distanceFromCursor.top+'px',left:a.pageX+b.distanceFromCursor.left+'px'})}).hover(function(){var a=this;d.addClass(b.containerLoadingClass).show();f.load(function(){d.removeClass(b.containerLoadingClass);f.show();b.onLoad.call(f[0],a)}).attr('src',i(c(a).attr(b.srcAttr)));b.onShow.call(d[0],a)},function(){d.hide();f.unbind('load').attr('src','').hide();b.onHide.call(d[0],this)});return this}})(jQuery);
$(function(){
	var obj=$("#imgPreview a[rel]");
	if(obj.length>0) {
		$('#imgPreview a[rel]').imgPreview({
			srcAttr: 'rel',
			imgCSS: { width: 300 }
		});
	}
});
</script>

</body>
</html>