<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>管理员登陆</title>
<meta name="author" content="xiaocms" />
<meta name="copyright" content="Copyright (c)  www.xiaocms.com All Rights Reserved." />
<link href="./img/login/login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../core/img/js/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
    $("#username").focus();
});
</script>
<style type="text/css">
* { padding:0; margin:0; }
fieldset, img { border:0; }
body { font: 12px tahoma, Arial, Verdana, sans-serif; color: #666666; }
a { color: #666666; text-decoration: none; }
a:hover { color: #ff6600; text-decoration: none; }
img { vertical-align: middle; image-rendering: optimizeQuality; -ms-interpolation-mode: bicubic; }
table { border-collapse: collapse; border-spacing: 0px; }
input { vertical-align: middle; outline: none; }
input.text { width: 180px; height: 24px; line-height: 24px; padding: 0px 4px; color: #666666; -webkit-box-shadow: inset 0px 1px 2px rgba(0, 0, 0, 0.1); -moz-box-shadow: inset 0px 1px 2px rgba(0, 0, 0, 0.1); box-shadow: inset 0px 1px 2px rgba(0, 0, 0, 0.1); -webkit-border-radius: 2px; -moz-border-radius: 2px; border-radius: 2px; border-top: 1px solid #999999; border-right: 1px solid #e1e1e1; border-bottom: 1px solid #e1e1e1; border-left: 1px solid #999999; }
input.text:hover { -webkit-transition: box-shadow linear 0.2s; -moz-transition: box-shadow linear 0.2s; -ms-transition: box-shadow linear 0.2s; -o-transition: box-shadow linear 0.2s; transition: box-shadow linear 0.2s; -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1), 0 0 8px rgba(82, 168, 236, 0.6); -moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1), 0 0 8px rgba(82, 168, 236, 0.6); box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1), 0 0 8px rgba(82, 168, 236, 0.6); border: 1px solid #74b9ef; }
.login { width: 520px; height: 302px; padding: 110px 160px 0px 160px; margin: 60px auto 0px auto; overflow: hidden; background: url(./img/login_bg.jpg) 0px 0px no-repeat; }
.login table { width: 520px; height: 220px; }
.login th { height: 30px; padding-right: 6px; font-weight: normal; text-align: right; }
.login .captcha { width: 90px; text-transform: uppercase; ime-mode: disabled; }
.login .homeButton { width: 37px; height: 30px; line-height: 30px; cursor: pointer; outline: none; border: none; background: url(./img/login_bg.jpg) 0px -420px no-repeat; }
.login .loginButton { width: 70px; height: 30px; line-height: 30px; color: #476b89; cursor: pointer; outline: none; border: none; background: url(./img/login_bg.jpg) -37px -420px no-repeat; }
.powered { padding-right: 10px; text-align: center; font-size: 9px; color: #999999; }
.powered a { color: #888888; margin: 0px 3px; }
</style>
</head>
<body>
<div class="login">
  <form action="" method="post">
    <table>
      <tr>
        <td width="190" rowspan="2" align="center" valign="bottom"></td>
        <th>用户名:</th>
        <td><input type="text" id="username"  name="username"  class="text" value="" maxlength="20" /></td>
      </tr>
      <tr>
        <th>密&nbsp;&nbsp;&nbsp;码:</th>
        <td><input  name="password" type="password"  class="text" value="" maxlength="20" autocomplete="off" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <th>验证码:</th>
        <td><input type="text" name="code" class="text captcha" maxlength="4" autocomplete="off" />
          <img id="code" src="../index.php?c=api&a=checkcode&width=85&height=26" align="absmiddle" title="看不清楚？换一张" onclick="document.getElementById('code').src='../index.php?c=api&a=checkcode&width=85&height=26&'+Math.random();" style="cursor:pointer; margin-top:-3px;"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <th>&nbsp; </th>
        <td><input type="button" class="homeButton" value="" onclick="location.href='/'" /><input type="submit" class="loginButton" value="登录" name="submit"  /></td>
      </tr>
    </table>
  </form>
</div>
<div class="powered"><a href="http://www.xiaocms.com" target="_blank">Copyright &copy; <?php echo date('Y'); ?> www.XiaoCms.com All Rights Reserved.</a></div>
</body>
</html>