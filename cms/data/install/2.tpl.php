<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>XiaoCms 企业建站版安装向导</title>
<script type="text/javascript" src="./core/img/js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="./data/install/xiaocms.css" />
</head>
<body>
<div class="install-box">
  <div class="head"> XiaoCms  安装向导 </div>
  <div class="install">
    <form  action="index.php?c=install&a=step3" method="post" name="form1" id="form1">
      <?php if(@!$error) { ?>
      <div class="formitm">
        <label class="lab" >数据库服务器：</label>
        <input name="data[host]" type="text" value="localhost" class="u-ipt" />
      </div>
      <div class="formitm">
        <label class="lab" >数据库用户名：</label>
        <input name="data[username]" type="text" value="" class="u-ipt" />
      </div>

      <div class="formitm">
        <label class="lab" >数据库名称：</label>
        <input name="data[dbname]" type="text" value=""  class="u-ipt" />
      </div>
      <div class="formitm">
        <label class="lab" >数据库密码：</label>
        <input name="data[password]" type="text" value="" class="u-ipt" />
      </div>
      <div class="formitm">
        <label class="lab" >数据表前缀：</label>
        <input name="data[prefix]" type="text" value="xiao_" class="u-ipt" />
       </div>
      <div class="formitm">
        <label class="lab" >后台帐号：</label>
        <input name="data[admin_name]" type="text" value="admin" class="u-ipt" />
      </div>
      <div class="formitm">
        <label class="lab" >后台密码：</label>
        <input name="data[admin_pass]" type="text" value="admin" class="u-ipt" />
      </div>
      <div class="formitm">
        <label class="lab" >安装测试数据：</label>
        <label class="u-opt">
          <input name="data[import]" type="checkbox" value="1" checked align="bottom"/>
        </label>
      </div>
      <div id="tip" style="display: none;">
        <div class="formitm"  style="text-align: center;">安 装 中，请 稍 候 . . .</div>
      </div>
      <div class="install-button"><a id="submit" href="javascript:;" class="button">下一步</a></div>
      <?php } else { ?>
      <div class="install-error"><?php echo $error; ?></div>
      <?php } ; ?>
    </form>
  </div>
</div>
<div class="copyright">Copyright &copy; 2014 <a target="_blank" href="http://www.xiaocms.com">www.XiaoCms.com</a> All Rights Reserved. </div>

<script>
$(function (){
	$('input[name=data[username]]').focus();
	$('#submit').click(function (){
		if(!$('input[name=data[username]]').val())
		{
			alert('请输入数据库用户名');
			return $('input[name=data[username]]').focus();
		}
		if(!$('input[name=data[dbname]]').val())
		{
			alert('请输入数据库名称');
			return $('input[name=data[dbname]]').focus();
		}
		if(!$('input[name=data[admin_name]]').val())
		{
			alert('请输入后台账号');
			return $('input[name=data[admin_name]]').focus();
		}

		if(!$('input[name=data[admin_pass]]').val())
		{
			alert('请输入后台密码');
			return $('input[name=data[admin_pass]]').focus();
		}

		$.post("?c=install&a=test", $('form').serialize(), function (data){
		if(data == 1) {
           document.getElementById("tip").style.display = '';
           document.getElementById("form1").submit();
		} else if(data == 2) {
			alert('mysql数据库连接失败');
		} else if(data == 3) {
			var dbname = $('input[name=data[dbname]]').val();
			alert('不存在数据库'+dbname+'，且无权限创建数据库');
		} else if(data == 4) {
			if (confirm('数据库中已有和XiaoCms系统相同的表前缀，确定覆盖安装吗？\n\n此操作会丢失数据！建议更改表前缀')) {
            document.getElementById("tip").style.display = '';
            document.getElementById("form1").submit();
			}
		} else {
			alert('连接失败');
		}
		});

	});
});
</script>

</body>
</html>