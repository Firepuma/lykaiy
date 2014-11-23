<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $site_title; ?></title>
    <meta name="keywords" content="<?php echo $site_keywords; ?>" />
    <meta name="description" content="<?php echo $site_description; ?>" />
    <script type="text/javascript" src="<?php echo $site_url; ?>core/img/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $site_template; ?>images/jquery.SuperSlide.2.1.1.js"></script>
    <link rel="stylesheet"  href="<?php echo $site_template; ?>images/css.css" type="text/css"/>
    <!-- 下面列举了 XiaoCms 模板里面几个常用的标签
    <?php echo $site_url; ?> - 网站的网址
    <?php echo $site_name; ?>-网站名称
    <?php echo $site_title; ?> -标题 如果您不满意系统提供的标题组合方式完全可以自己写 如列表页{xiao:catname} 表示栏目标题
    <?php echo $site_keywords; ?> - {关键字}
    <?php echo $site_description; ?> - {描述}
    <?php echo $site_template; ?> - {当前网站模板目录}
    更多内容请参考http://www.xiaocms.com帮助文档
    另外要说明的是：jquery等js默认是引用后台的js 你做前台模板的时候还是自己引用其他地址的吧。
    -->


</head>
<body>
<!-- header-->
<div class="header">
    <a href="<?php echo $site_url; ?>" title="<?php echo $site_name; ?>" style="" class="site-logo">
        <div style="display:inline-block;" class="logo"><img src="<?php echo $site_template; ?>images/logo.png"/></div>&nbsp;&nbsp;
        <div class="logo-text">涟源凯跃</div>&nbsp;
    </a>
    &nbsp;&nbsp;&nbsp;&nbsp;<div class="tel">矿山设备经销批发零售总公司</div>
</div>

<div class="nav-bg">
    <ul id="nav" class="nav clearfix">
        <li class="nLi <?php if ($index) { ?>on<?php } ?>">
            <h3><a href="<?php echo $site_url; ?>">首页</a></h3>
        </li>
        <!--下面的栏目调用 适合N级栏目调用 XiaoCms的模板调用非常的灵活并且非常的简单易用。基本上没有调不出来的,更多的参考官方帮助文档-->
        <?php $return = $this->_category("num=7");  if (is_array($return))  foreach ($return as $key=>$xiao) { $allchildids = @explode(',', $xiao['allchildids']);    $current = in_array($catid, $allchildids);?>
        <li class="nLi <?php if ($current) { ?>on<?php } ?>">

            <h3><a href="<?php echo $xiao['url']; ?>"><?php echo $xiao['catname']; ?></a></h3>

            <?php if ($xiao['child']) { ?><!--判断如果存在下级栏目 如果存在则执行下面的代码-->
            <ul class="sub">
                <?php $return = $this->_category("parentid=$xiao[catid]");  if (is_array($return))  foreach ($return as $key=>$xiao) { $allchildids = @explode(',', $xiao['allchildids']);    $current = in_array($catid, $allchildids);?>
                <li><a href="<?php echo $xiao['url']; ?>"><?php echo $xiao['catname']; ?></a></li>
                <?php } ?>
            </ul>
            <?php } ?>

        </li>
        <?php } ?>

    </ul>
    <script  type="text/javascript">
        jQuery("#nav").slide({ type:"menu", titCell:".nLi", targetCell:".sub",effect:"slideDown",delayTime:300,triggerTime:0,returnDefault:true});
    </script>
</div>
<div class="nav-bg-bottom clear"></div>
