/* <![CDATA[ */
	var clearpath = admincpSettings.clearpath;

	jQuery(document).ready(function(){
		jQuery('#admincp-content>div').css("display","none");		

		jQuery('#admincp-content,#admincp-content > div').tabs({ fx: { opacity: 'toggle', duration:'fast' }, selected: 0 });
		jQuery(".box-description").click(function(){
			//alert(jQuery(this).parent().parent().html());
			var descheading = jQuery(this).parent().parent().find("h3").html();
			var desctext = jQuery(this).next(".box-descr").html();
			
			jQuery('body').append("<div id='custom-lbox'><div class='shadow'></div><div class='box-desc'><div class='box-desc-top'></div><div class='box-desc-content'><h3>"+descheading+"</h3>"+desctext+"<div class='lightboxclose'></div> </div> <div class='box-desc-bottom'></div>	</div></div>");
			jQuery(".shadow").animate({ opacity: "show" }, "fast").fadeTo("fast", 0.75);
			jQuery('.lightboxclose').click(function(){
				jQuery(".shadow").animate({ opacity: "hide" }, "fast", function(){jQuery("#custom-lbox").remove();});	
			});
		});
		
		jQuery(".defaults-button").click(function() {
		jQuery(".defaults-hover").animate({opacity: "show", top: "-240"}, "fast");
			});
		jQuery(".no").click(function() {
		jQuery(".defaults-hover").animate({opacity: "hide", top: "-300"}, "fast");
			});
		// ":not([safari])" is desirable but not necessary selector
/*		jQuery('input:checkbox:not([safari])').checkbox();
		jQuery('input[safari]:checkbox').checkbox({cls:'jquery-safari-checkbox'});
		jQuery('input:radio').checkbox();
*/		
		
		var $save_message = jQuery("#admincp-ajax-saving");
/*		$save_message.ajaxStart(function(){//disable resion: wp auto save admin-ajax.php conflict
			jQuery(this).children("img").css("display","block");
			jQuery(this).children("span").css("margin","6px 0px 0px 30px").html('Saving...');
			jQuery(this).fadeIn('fast');
		});
*/		
		jQuery('input#admincp-save').click(function($){
			//ryan 2013-0802
			$save_message.children("img").css("display","block");
			$save_message.children("span").css("margin","0").html('Saving...');
			$save_message.fadeIn('fast');
			
			var options_fromform = jQuery('#main_options_form').formSerialize(),
				add_nonce = '&_ajax_nonce='+admincpSettings.admincp_nonce;
			
			options_fromform += add_nonce;
			
			var save_button=jQuery(this);
			jQuery.ajax({
			   type: "POST",
			   url: ajaxurl,
			   data: options_fromform,
			   success: function(response){				   
					$save_message.children("img").css("display","none");
					$save_message.children("span").css("margin","0").html('Options Saved.');
					save_button.blur();
					
					setTimeout(function(){
						$save_message.fadeOut("slow");
					},500);
			   }
			});

			return false;
		});
		
		jQuery('#nav-general').css("display","block");
		jQuery('.nav-tab-wrapper>a').click(function(){
			jQuery(this).addClass("nav-tab-active");
			jQuery(this).siblings().removeClass("nav-tab-active");

			jQuery("#"+jQuery(this).attr('rel')).siblings().hide();
			jQuery("#"+jQuery(this).attr('rel')).fadeIn(400);

			// jQuery("#"+jQuery(this).attr('rel')).siblings().css("display","none");
			// jQuery("#"+jQuery(this).attr('rel')).css("display","block");
		})
		jQuery("input[type='number']").keyup(function(){
			this.value = this.value.replace(/[^\d]/g, '').replace(/(\d{4})(?=\d)/g, "$1 ");
		})
		/*slider suport*/
		if(jQuery(".slider"))
		jQuery(".slider").each(function(index, element) {
			
            jQuery( this ).slider({
				//range: true,
				step:1,
				min: 200,
				max: 480,
				values: 0,
				create: function( event, ui ) {
					jQuery(this).find("a").text(jQuery(this).prev().val()+"px");
					jQuery(this).slider( "value", jQuery(this).prev().val());
				},
				slide: function( event, ui ) {
					jQuery(this).find("a").text(jQuery(this).slider('values',0)+"px");
				},
				stop: function( event, ui ) {
					jQuery(this).find("a").html(jQuery(this).slider('values',0)+"px");
					jQuery(this).prev().val(jQuery(this).slider('values',0));
				}
			});
        });
	});
/* ]]> */