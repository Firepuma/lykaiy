<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '附件管理';
</script>
<div class="subnav">
		<table width="100%"  class="m-table m-table-row" id="imgPreview">
		<thead class="m-table-thead s-table-thead">
		<tr>
			<th align="left">更多功能后续添加中.. 当前目录：<?php echo $dir; ?></th>
		</tr>
		</thead>
		<tbody >
		
		<?php if ($dir!='data/upload/') { ?>
		<tr><td align="left"><a href="<?php echo $pdir; ?>"><img src="./img/folder-closed.gif">返回上一层目录</a></td></tr>
		<?php } ?>
		
		<?php if (is_array($dirlist)) foreach ($dirlist as $k=>$t) { ?>
		<tr>
		<td align="left">
		<img src="./img/folder-closed.gif">
		&nbsp;<a href="<?php echo $t['url']; ?>"><?php echo $t['name']; ?></a></td>
		</tr>
		<?php } ?>
		
		<?php if (is_array($list)) foreach ($list as $k=>$t) { ?>
		<tr>
		<td align="left" onclick="album_cancel(this)">
		<img src="./img/<?php echo $t['ico']; ?>">
		&nbsp;<a href="javascript:;" rel="<?php echo SITE_PATH.$dir;  echo $t['name']; ?>" title="<?php echo $t['name']; ?>"><?php echo $t['name']; ?></a></td>
		</tr>
		<?php } ?>
		
		</tbody>
		</table>
</div>
<script type="text/javascript">
(function(c){c.expr[':'].linkingToImage=function(a,g,e){return!!(c(a).attr(e[3])&&c(a).attr(e[3]).match(/\.(gif|jpe?g|png|bmp)$/i))};c.fn.imgPreview=function(j){var b=c.extend({imgCSS:{},distanceFromCursor:{top:10,left:10},preloadImages:true,onShow:function(){},onHide:function(){},onLoad:function(){},containerID:'imgPreviewContainer',containerLoadingClass:'loading',thumbPrefix:'',srcAttr:'href'},j),d=c('<div/>').attr('id',b.containerID).append('<img/>').hide().css('position','absolute').appendTo('body'),f=c('img',d).css(b.imgCSS),h=this.filter(':linkingToImage('+b.srcAttr+')');function i(a){return a.replace(/(\/?)([^\/]+)$/,'$1'+b.thumbPrefix+'$2')}if(b.preloadImages){(function(a){var g=new Image(),e=arguments.callee;g.src=i(c(h[a]).attr(b.srcAttr));g.onload=function(){h[a+1]&&e(a+1)}})(0)}h.mousemove(function(a){d.css({top:a.pageY+b.distanceFromCursor.top+'px',left:a.pageX+b.distanceFromCursor.left+'px'})}).hover(function(){var a=this;d.addClass(b.containerLoadingClass).show();f.load(function(){d.removeClass(b.containerLoadingClass);f.show();b.onLoad.call(f[0],a)}).attr('src',i(c(a).attr(b.srcAttr)));b.onShow.call(d[0],a)},function(){d.hide();f.unbind('load').attr('src','').hide();b.onHide.call(d[0],this)});return this}})(jQuery);
$(function(){
	var obj=$("#imgPreview a[rel]");
	if(obj.length>0) {
		$('#imgPreview a[rel]').imgPreview({
			srcAttr: 'rel',
			imgCSS: { width: 200 }
		});
	}
});	

</script>
</body>
</html>