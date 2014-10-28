jQuery(document).ready(function($) {

  if ($.browser.msie && $.browser.version < 7) return; // Don't execute code if it's IE6 or below cause it doesn't support it.
  
    $(".fade").fadeTo(1, 1);
    $(".fade").hover(
      function () {
        $(this).fadeTo("fast", 0.6);
      },
      function () {
        $(this).fadeTo("slow", 1);
      }
  ); 
  
  
  ddsmoothmenu.init({
  	mainmenuid: "smoothmenu1", //menu DIV id
  	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
  	classname: 'ddsmoothmenu', //class added to menu's outer DIV
  	//customtheme: ["#1c5a80", "#18374a"],
  	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
  })
  
  $('.ddsmoothmenu ul li a.selected').hover(function() { //mouse in
		$(this).css({'color':'#ffffff'});
    Cufon.refresh();
	}, function() { //mouse out
		$(this).css({'backgroundColor':'#72a200','color':'#ffffff'});
	});
      
  $(".tabs_container").each(function(){
  	$("ul.tabs",this).tabs("div.panes > div", {tabs:'li',effect: 'fade', fadeOutSpeed: -400});
  });
  $(".mini_tabs_container").each(function(){
  	$("ul.mini_tabs",this).tabs("div.panes > div", {tabs:'li',effect: 'fade', fadeOutSpeed: -400});
  });
  $.tools.tabs.addEffect("slide", function(i, done) {
  	this.getPanes().slideUp();
  	this.getPanes().eq(i).slideDown(function()  {
  		done.call();
  	});
  });
  
  //$('.toggle .toggle_content:first').show();
	$(".toggle_title").toggle(
		function(){
			$(this).addClass('toggle_active');
			$(this).siblings('.toggle_content').slideDown("fast");
		},
		function(){
			$(this).removeClass('toggle_active');
			$(this).siblings('.toggle_content').slideUp("fast");
		}
	);
  	
  /* initialize prettyphoto */
  $("a[rel^='prettyPhoto']").prettyPhoto({
  	theme: 'light_square',
    social_tools : false,
    
  });

  /* Ajax Contact Form Processing */
  $('#buttonsend').click( function() {
	
	var name    = $('#name').val();
	var subject = $('#subject').val();
	var email   = $('#email').val();
	var message = $('#message').val();
	var siteurl = $('#siteurl').val();
  var sendto = $('#sendto').val();		
	
	$('.loading').fadeIn('fast');
	
	if (name != "" && subject != "" && email != "" && message != "")
		{

			$.ajax(
				{
					url: siteurl+'/sendemail.php',
					type: 'POST',
					data: "name=" + name + "&subject=" + subject + "&email=" + email + "&message=" + message+ "&sendto=" + sendto,
					success: function(result) 
					{
						$('.loading').fadeOut('fast');
						if(result == "email_error") {
							$('#email').css({"background":"#FFFCFC","border-top":"1px solid #ffb6b6","border-left":"none","border-right":"1px solid #ffb6b6","border-bottom":"none"});
						} else {
							$('#name, #subject, #email, #message').val("");
							$('.success-contact').show().fadeOut(6200, function(){ $(this).remove(); });
						}
					}
				}
			);
			return false;
			
		} 
	else 
		{
			$('.loading').fadeOut('fast');
			if( name == "") $('#name').css({"background":"#FFFCFC","border":"1px solid #ffb6b6"});
			if(subject == "") $('#subject').css({"background":"#FFFCFC","border":"1px solid #ffb6b6"});
			if(email == "" ) $('#email').css({"background":"#FFFCFC","border":"1px solid #ffb6b6"});
			if(message == "") $('#message').css({"background":"#FFFCFC","border":"1px solid #ffb6b6"});
			return false;
		}
  });

	$('#name, #subject, #email,#message').focus(function(){
		$(this).css({"background":"#ffffff","border":"1px solid #cccbcb"});
	});
        
});