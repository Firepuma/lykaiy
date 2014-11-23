<?php include $this->_include('header.html'); ?>
<div class="mainbody">
    <div class="w710 fr">
        <div class="page">
            <div class="newstitle">您当前位置：<a  href="<?php echo $site_url; ?>">首页</a> >> <?php echo position($catid, ' &gt;&gt;&nbsp;&nbsp;'); ?></div>
            <div class="blank10 clear"></div>

            <!--列表开始-->
            <div class="piclist">
                <ul class="noborder">
                    <?php $return = $this->_listdata("catid=$catid page=$page cache=36000"); extract($return); if (is_array($return))  foreach ($return as $key=>$xiao) { ?>
                    <li>
                        <div><a href="<?php echo $xiao['url']; ?>"><img src="<?php echo image($xiao[thumb]); ?>" /></a></div>
                        <div class="picname"><a href="<?php echo $xiao['url']; ?>"><?php echo $xiao['title']; ?></a></div>
                    </li>
                    <?php } ?>

                </ul>
                <div class="listpage" ><?php echo $pagelist; ?></div>
            </div>
            <!--列表结束-->

        </div>

        <div class="clear"></div>
    </div>
	<div class="w230 fl">
	<?php include $this->_include('left.html'); ?>
	</div>

	<div class="blank10 clear"></div>
</div>

<?php include $this->_include('footer.html'); ?>