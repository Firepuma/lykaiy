<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>提示信息 - XiaoCms</title>
<link type="text/css" rel="stylesheet" href="<?php echo SITE_PATH; ?>core/img/message/xiaocms.css"/>
</head>
<body>
<div class="box_border" <?php if ($status==1){ ?>id="right" <?php }else{?> id="wrong" <?php } ?>>
  <div class="content">
     <h1><?php echo $msg; ?></h1>
    <p>
	<?php if($url==1){ ?>
	<a href="javascript:history.back();" >如果您的浏览器没有自动跳转，请点击这里</a>
	<script language="javascript">setTimeout(function(){history.back();}, <?php echo $time; ?>);</script>
	<?php } else{?>
	<a href="<?php echo $url?>">如果您的浏览器没有自动跳转，请点击这里</a>
	<script language="javascript">setTimeout("location.href='<?php echo $url; ?>';", <?php echo $time; ?>);</script>   
	<?php } ?>
	</p>
  </div>
</div>
</body>
</html>