<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->site_config['site_name'];?> - 后台管理中心 - Powered by XiaoCms</title>
<script type="text/javascript" src="../core/img/js/jquery.min.js"></script>
<style type="text/css">body, h1, h2, h3, ul, li, p { margin:0; padding:0; font-size:12px; font-family:arial,\5b8b\4f53;; }
body { position:relative; background:#fff url(./img/bg_x.gif) repeat-x 0 -344px; border:0px solid #ffaa09; scroll:no; overflow:hidden; }
div, img { border:0; }
ul li { list-style:none; }
a { color:#333; font-size:12px; text-decoration:none; }
a:hover { color:#f60; }
#head h1 { text-indent:-9999px; background:url(./img/bg_logo.png) no-repeat 0 0; height:30px; }
#menu_position { position:absolute; top:0; left:180px; z-index:99; }
#head .user { color:#fff; position:absolute; top:6px; right:20px; z-index:10; }
#head .user a { color:#fff; }
#head .user span { width:50px;}
#menu { position:relative; }
#menu li ul, #menu li.iehover ul { width:101px; display:none; position:absolute; top:100%; left:0; padding:2px 0 0; background:url(./img/bg_menu.gif) repeat-y 0px 0; margin-top:-3px; }
#menu li { float:left; display:inline; position:relative; width:60px; line-height:24px; }
#menu ul li { width:100%; display:block; }
#menu ul li.menubtm { background:url(./img/bg.gif) repeat-y 0 0; height:4px; overflow:hidden; }
#menu li a { float:left; display:block; color:#fff; text-align:center; height:30px; line-height:24px; width:100%; font-weight:bold; margin-top:3px; }
#menu li.iehover a, #menu li.iehover a:hover, #menu li:hover a, #menu li:hover a:hover { background:url(./img/bg.gif) no-repeat -1px -634px; color:#333; font-weight:bold; }
#menu li.focused a { background:url(./img/bg.gif) no-repeat -1px -634px; color:#666; font-weight:bold; }
#menu li:hover li a, #menu li.iehover li a, #menu li li a { float: none; margin:0 1px 0 2px; color:#333; height:24px; line-height:24px; text-align:left; padding-left:8px; width:88px; font-weight:normal; background:url(./img/bg.gif) no-repeat 0 -667px; }
#menu li:hover li a:hover, #menu li:hover li:hover a, #menu li.iehover li a:hover, #menu li.iehover li.iehover a, #menu li li a:hover { background: url(./img/bg_x.gif) repeat-x 0 -225px; color:#fff; font-weight:normal; }
#menu li:hover ul, #menu li.iehover ul { display:block; }
#main { background:url(./img/bg_y.gif) repeat-y <?php echo $left_width-6 ;?>px 0; }
#left { width:<?php echo $left_width ;?>px; background:url(./img/bg-left2.gif) repeat-x ; position:absolute; top:30px; left:0; }
#left h2 {background:url(./img/bg-left1.gif) left top no-repeat; height:33px; line-height:33px;padding-left:22px;}
#left h2 span { background:url(./img/bg-left3.gif) right no-repeat;padding-right:12px; height:33px; float:right;  }
#left h2 span a.new { width:16px; height:16px; font-size:16px; background:url(./img/bg.gif) no-repeat -57px -544px; }
#left h2 span a.new:hover { background-position:-89px -544px; }
#left h2 span a.refresh {display: block; width:16px; height:16px; font-size:16px; background:url(./img/bg.gif) no-repeat -89px -569px; margin-top:10px;}
#left h2 span a.refresh:hover { background-position: -109px -569px; }
#right { margin-left:<?php echo $left_width ;?>px; }
#position { background:url(./img/bg.gif) no-repeat 0 -328px; height:16px; line-height:16px; padding-left:18px; margin-left:8px; }
#position a { background:url(./img/bg.gif) no-repeat right -840px; padding:0 12px 0 0; margin-right:6px; color:#008ACC; }
#position a:hover { text-decoration:underline; }
#shortcut { float:right; margin-right:3px; margin-top:-3px; }
#shortcut span { display:block; float:left; margin-right:5px; padding:2px; cursor:pointer; }
#shortcut span.sc_now { background:#fff; border:1px solid #9AC4DC; padding:1px; }
#shortcut span img { display:block; }
#home { overflow:hidden; width:100%; padding-top: 8px; clear:both;margin-bottom: 6px; }
</style>
</head>
<body scroll="no">
<!--头部开始-->
<div id="head">
  <h1>XiaoCms</h1>
  <div id="menu_position">
    <ul id="menu">
        <li id="_MP104" ><a href="javascript:_MP(104,'<?php echo url('index/my') ;?>');">设置</a>
          <ul>
          <li id="_MP1045" ><a href="javascript:_MP(1045,'<?php echo url('index/my') ;?>');" >我的账号</a></li>
		  <?php if($this->menu('index-config') ) { ;?>
          <li id="_MP1042" ><a href="javascript:_MP(1042,'<?php echo url('index/config', array('type'=>1)) ;?>');" >系统设置</a></li>
		  <?php } ;?>

		  <?php if($this->menu('administrator-index')) { ;?>
          <li id="_MP1099" ><a href="javascript:_MP(1099,'<?php echo url('administrator/index') ;?>');" >账号管理</a></li>
		  <?php } ;?>

          <li id="_MP107" ><a href="javascript:_MP(107,'<?php echo url('index/cache') ;?>');" >更新缓存</a></li>
		  
		  <?php if($this->menu('database-index')) { ;?>
          <li id="_MP403" ><a href="javascript:_MP(403,'<?php echo url('database') ;?>');" >数据备份</a></li>
		  <?php } ;?>

		  <?php if($this->menu('models-index')) { ;?>
          <li id="_MP1046" ><a href="javascript:_MP(1046,'<?php echo url('models') ;?>');" >内容模型</a></li>
          <li id="_MP1047" ><a href="javascript:_MP(1047,'<?php echo url('models', array('typeid'=>3)) ;?>');" >表单模型</a></li>
          <li id="_MP1048" ><a href="javascript:_MP(1047,'<?php echo url('models', array('typeid'=>4)) ;?>');" >自定义表</a></li>
		  <?php } ;?>
		  
<!--    <li id="_MP403" ><a href="javascript:_MP(4031,'<?php echo url('uploadfile/manager') ;?>');" >附件管理</a></li> -->

		  <li class="menubtm"></li>
          </ul>
        </li>
		<?php if($this->menu('category-index')) { ;?>
        <li id="_MP101" ><a href="javascript:_MP(101,'<?php echo url('category') ;?>');" >栏目</a></li>
    	<?php } ?>
		<?php if($this->menu('block-index')) { ;?>
        <li id="_MP102" ><a href="javascript:_MP(102,'<?php echo url('block') ;?>');" >区块</a></li>
    	<?php } ?>
		<?php if (defined('XIAOCMS_MEMBER') && $this->menu('member-index')) {  ?>
        <li id="_MP103" ><a href="javascript:_MP(103,'<?php echo url('member') ;?>');" >会员</a></li>
		<?php } ?>
    	
		<?php if($this->menu('template-index')) { ;?>
         <li id="_MP105" ><a href="javascript:_MP(105,'<?php echo url('template') ;?>');" >模板</a></li>
		<?php } ?>

		<?php if($this->site_config['diy_url']==2 && $this->menu('createhtml-index')) { ?>
        <li id="_MP106" ><a href="javascript:_MP(106,'<?php echo url('createhtml') ;?>');" >生成</a>
          <ul>
          <li id="_MP1061" ><a href="javascript:_MP(1061,'<?php echo url('createhtml') ;?>');" >生成首页</a></li>
		  
	      <?php if($this->menu('createhtml-category')) { ;?>
          <li id="_MP1062" ><a href="javascript:_MP(1062,'<?php echo url('createhtml/category') ;?>');" >生成栏目页</a></li>
		  <?php } ?>
		  
	      <?php if($this->menu('createhtml-show')) { ;?>
          <li id="_MP1063" ><a href="javascript:_MP(1063,'<?php echo url('createhtml/show') ;?>');" >生成内容页</a></li>
		  <?php } ?>

		  <li class="menubtm"></li>
          </ul>
        </li>
		<?php } ?>
   </ul>
  </div>
  <!--账户信息-->
  <div class="user">
    <?php echo $this->admin['username']; ?>（<?php echo $this->admin['realname']; ?>），<a href="javascript:;" onClick="logout();">退出</a></div>
</div>
<!--头部结束-->
<div id="main">
  <!--左侧开始-->
  <div id="left">
    <h2>
      <span style="float:right;"><a href="javascript:;" onClick="refresh();" class="refresh" title="刷新菜单"></a></span>
      <label id='root_menu_name'><a href='<?php echo url('content'); ?>' target='right'>内容管理</a></label>
    </h2>
    <iframe name="leftMain" id="leftMain" src="<?php echo url('index/tree'); ?>" frameborder="false" scrolling="auto" style="border:none" width="100%" height="600" allowtransparency="true"></iframe>
  </div>
  <!--左侧结束-->
  <!--右侧开始-->
  <div id="right">
    <div id="home">
    	<div id="shortcut">
    		<span title="网站首页" onclick="window.open('../')">
    			<img width="16" height="16" src="./img/ref.gif" />
    		</span>
    		<span>
    			<a  href="javascript:_MP(107,'<?php echo url('index/cache'); ?>');" title="更新缓存"><img width="16" height="16" src="./img/add.gif" /></a>
    		</span>
    		<span>
    			<a  href="http://www.xiaocms.com" title="官方首页"  target="_blank" ><img width="16" height="16" src="./img/home.gif" /></a>
    		</span>
    	</div>
    	<div id="position">后台首页</div>
    </div>
    <iframe name="right" id="rightMain" src="<?php echo url('index/main'); ?>" frameborder="false" scrolling="auto" style="border:none;" width="100%" allowtransparency="true"></iframe>
  </div>
</div>
<script type="text/javascript"> 
window.onresize = function(){
	var heights = document.documentElement.clientHeight;
	document.getElementById('rightMain').height = heights-61;
	document.getElementById('leftMain').height = heights-63;
}
window.onresize();
function _MP(id, target_show_url) {
	var title = $("#_MP"+id).find('a').html();
	$("#rightMain").attr('src', target_show_url);
	$('.focused').removeClass("focused");
	$('#_MP'+id).addClass("focused");
}
function logout(){
	if (confirm("确定退出吗"))
	top.location = '<?php echo url("login/logout"); ?>';
	return false;
}
function refresh() {
	document.getElementById('leftMain').src = '<?php echo url('index/tree'); ?>';
}
</script>
</body>
</html>