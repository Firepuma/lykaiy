<div class="sidenav bg">
    <div class="leftbox">
        <ul>
            <?php $return = $this->_category("catid=19,20,21");  if (is_array($return))  foreach ($return as $key=>$xiao) { $allchildids = @explode(',', $xiao['allchildids']);    $current = in_array($catid, $allchildids);?>
            <li><s></s><a <?php if ($current) { ?>class="select"<?php } ?>
                href="<?php echo $xiao['url']; ?>"><?php echo $xiao['catname']; ?></a></li>
            <?php } ?>
        </ul>
    </div>
</div>
<div class="blank10 clear"></div>
<div class="contact-area bg">
    <?php $this->block(4);?>
</div>