jQuery(document).ready(function() {   
        //upbottom为上传按钮的id   
        jQuery('.up #upbottom').click(function() {   
             targetfield = jQuery(this).prev('input');   
             tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');   
             return false;   
        });   
        
        window.send_to_editor = function(html) {   
             imgurl = jQuery('img',html).attr('src');   
             jQuery(targetfield).val(imgurl);   
             tb_remove();   
        }   
        
 });  




