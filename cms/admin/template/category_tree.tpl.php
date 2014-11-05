<?php include $this->admin_tpl('header');?>
<script type="text/javascript" src="../core/img/js/jquery.cookie.js"></script>
<script type="text/javascript" src="../core/img/js/jquery.treeview.js"></script>
<SCRIPT LANGUAGE="JavaScript">
$(document).ready(function(){
    $("#category_tree").treeview({
			control: "#treecontrol",
			persist: "cookie",
			cookieId: "treeview-black"
	});
});

function open_list(obj) {
	window.top.$("#current_pos_attr").html($(obj).html());
}
</SCRIPT>
 <div class="treeview">
 <div id="treecontrol">
 <span style="display:none">
		<a href="#"></a>
		<a href="#"></a>
		</span>
		<a href="#"><img src="./img/minus.gif" />   <?php echo $tips; ?></a>
</div>
<?php echo $categorys; ?>

<?php echo $form; ?>
<?php echo $diytable; ?>

</div>
</body>
</html>