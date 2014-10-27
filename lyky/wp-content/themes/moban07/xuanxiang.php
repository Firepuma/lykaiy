<?php
/*添加主题选项*/
add_action('admin_menu', 'mytheme_page');
function mytheme_page (){
 
	if ( count($_POST) > 0 && isset($_POST['mytheme_settings']) ){
 
		$options = array (
	            'keywords',
				'description',
				'analytics',
				
				'logo',
				'ico',
				'icp_b',
				
				'jdt1',
				'jdxt1',
				'jdtbt1',
				'jdtlj1',
				'jdtjj1',
				
				'jdt2',
				'jdxt2',
				'jdtbt2',
				'jdtlj2',
				'jdtjj2',
				
				'jdt3',
				'jdxt3',
				'jdtbt3',
				'jdtlj3',
				'jdtjj3',
				
				'jdt4',
				'jdxt4',
				'jdtbt4',
				'jdtlj4',
				'jdtjj4',
				
				'spbf',
				'em_1',
				'cz_1',
				'qq_1',
				'qq_2',
				'qq_3',
				'dh_1',
				'dh_2',
				'dh_3',
				'dz_1',
				'lx_1',
				
				'ditu_tit',
		        'ditu_cont',
		        'ditu_zuob',
                'ditu_zuob3',
		
		);
 
		foreach ( $options as $opt ){
 
			delete_option ( 'mytheme_'.$opt, $_POST[$opt] );
 
			add_option ( 'mytheme_'.$opt, $_POST[$opt] );	
 
		}
 
	}
 
	add_theme_page(__('主题选项'), __('主题选项'), 'edit_themes', basename(__FILE__), 'mytheme_settings');
}
            //加载上传图片的js(wp自带)   
            wp_enqueue_script('thickbox');   
            //加载css(wp自带)   
            wp_enqueue_style('thickbox');  
function mytheme_settings(){?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/upload.js"></script>  
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/xuanxiang.css" type="text/css" />
<script src="<?php bloginfo('template_url'); ?>/js/jquery-1.11.0.js"></script> 
<script src="http://malsup.github.com/jquery.form.js"></script> 
    <script type="text/javascript">
        // wait for the DOM to be loaded 
        $(document).ready(function() { 
            // bind 'myForm' and provide a simple callback function 
$('#submit').click(function() { //When trigger is clicked...   
      
    $('.tishi2').fadeIn('500');
   });  
var options = {
	    
	    success: function() {
	        $(this).ajaxSubmit();
                $('.tishi').fadeIn('500');
			   setTimeout("$('.tishi2').fadeOut('slow')",3000);
			   setTimeout("$('.tishi').fadeOut('slow')",3000);
			   
	    },
		error: function() { 
		$('.tishi2').fadeOut('slow');
		alert("填写错误，重新填写！"); return false;
		                   
		 } 
		};
 
		    $('form.xuanxiangka').ajaxForm(options); 
			  
          
       
        }); 
 </script> 

   
<div class="wrap">
 
    <div class="tou"></div>
    <div class="shuoming">
      <?php   
	$ct = wp_get_theme();
$screenshot = $ct->get_screenshot();
$class = $screenshot ? 'has-screenshot' : '';
$customize_title = sprintf( __( 'Customize &#8220;%s&#8221;' ), $ct->display('Name') );
 ?>
        <p><b>主题名称：<?php echo $ct->display('Name'); ?></b> <a class="banben">版本：<?php echo $ct->display('Version'); ?></a> <a  href="http://www.themepark.com.cn/lbqsqytyzt.html" target="_blank" class="jieshao">详细介绍</a> 
        <a href="http://www.themepark.com.cn/lbqsqytyzt.html" target="_blank" class="bangzhu">教程和帮助</a></p>
        <p><b>主题出品：</b><a target="_blank" href="http://www.themepark.com.cn"><?php echo $ct->display('Author'); ?></a>  <a href="http://www.themepark.com.cn/lbqysybwordpresszt.html" target="_blank">这款主题有一个付费版本，代码更加简洁，对SEO更友好</a></p>
    
    </div>
    <div class="biaodan">
<div class="tishi2">
<p class="tishi">提交成功,刷新网页即可看到效果！</p>
<p class="tishi3">正在提交，请勿关闭网页！</p>

</div>
    <div class="biaodan">
        <form method="post" action=""class="xuanxiangka">
 
             <DIV id=con>
                   <UL id=tags>
                       <LI class=selectTag><div class="tb1"></div> <A onClick="selectTag('tagContent1',this)" href="javascript:void(0)">初始化设置</A> </LI>
                     
                       <LI><div class="tb2"></div><A onClick="selectTag('tagContent0',this)" href="javascript:void(0)">焦点图设置</A> </LI>
                  
                       <LI><div class="tb4"></div><A onClick="selectTag('tagContent2',this)" href="javascript:void(0)">其他设置</A> </LI>
                       
                       <LI><div class="tb4"></div><A onClick="selectTag('tagContent3',this)" href="javascript:void(0)">多语言</A> </LI>
                       <LI><div class="tb5"></div><A onClick="selectTag('tagContent4',this)" href="javascript:void(0)">移动设备</A> </LI>
                    
                    
                    
                        
                         
                   </UL></DIV>
                <DIV id=tagContent>
                
                
                <!--第一栏目：初始化设定-->
                   <DIV class="tagContent selectTag" id=tagContent1><?php include_once("options/options1.php"); ?></DIV>
                    <!--第一栏目：初始化设定-->
                   <DIV class=tagContent id=tagContent0> <?php include_once("options/options2.php"); ?></DIV>
                     <!--第三栏目：SEO-->
                   <DIV class=tagContent id=tagContent2> <?php include_once("options/options3.php"); ?></DIV>
                    <DIV class=tagContent id=tagContent3> <?php include_once("options/options4.php"); ?></DIV>
                    <!--第四栏目：内页设置-->
             <DIV class=tagContent id=tagContent4> <?php include_once("options/options5.php"); ?></DIV>
                     <!--第五栏目：其他设置-->
                 
               </DIV>
           
<p>
  <SCRIPT type=text/javascript>
function selectTag(showContent,selfObj){
	// 操作标签
	var tag = document.getElementById("tags").getElementsByTagName("li");
	var taglength = tag.length;
	for(i=0; i<taglength; i++){
		tag[i].className = "";
	}
	selfObj.parentNode.className = "selectTag";
	// 操作内容
	for(i=0; j=document.getElementById("tagContent"+i); i++){
		j.style.display = "none";
	}
	document.getElementById(showContent).style.display = "block";
	
}
</SCRIPT>
</p>
  
 
  <div class="submit">
 
		           <input type="submit" name="Submit" class="button-primary" value="保存设置"  id="submit"/>
 
	             	 <input type="hidden" name="mytheme_settings" value="save" style="display:none;" />
              
	                 </div>


</form>

</div>

 
<?php }
echo $after_widget;
/*添加主题选项over*/
?>