jQuery(document).ready(function($){

/*-----------------------------------------------------------------------------------*/
/*	jQuery Superfish Menu
/*-----------------------------------------------------------------------------------*/

    function init_nav(){
        jQuery('ul.nav').superfish({ 
	        delay:       1000,                             // one second delay on mouse out 
	        animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation 
	        speed:       'fast'                           // faster animation speed 
    	});
    }
    init_nav();

/*-----------------------------------------------------------------------------------*/
/*	Responsive Menu
/*-----------------------------------------------------------------------------------*/
	$(window).resize(function(){
		if($("#primary-nav").width() >768){
			$("#responsive-menu").hide();
		} 

	});
	
	$(".btn-nav-right").click(function(){
			$("#responsive-menu").slideToggle(300);
	});


/*-----------------------------------------------------------------------------------*/
/*	Home Testimonials
/*-----------------------------------------------------------------------------------*/

	if($('#home-testimonials').length){
		// Randomise
		$('.testimonial-nav').each(function(){
		    var container = $(this),
		    	children = container.children('li');
		    children.sort(function(a,b){
		          var temp = parseInt( Math.random()*10 );
		          var isOddOrEven = temp%2;
		          var isPosOrNeg = temp>5 ? 1 : -1;
		          return( isOddOrEven*isPosOrNeg );
		    }).appendTo(container);            
		});

		
		var len=$(".testimonial").length;
		var index=0;
		var int;
		
		function auto_move(){
			if(index==len-1)
			index=0;
			$('#home-testimonials .testimonial-nav a,#home-testimonials .testimonial').removeClass('active');
			var obj=$('#home-testimonials .testimonial-nav a:eq('+index+')');
			obj.addClass('active');
			$(obj.attr('href')).addClass('active');
			index++;
		}
		auto_move();
		int=setInterval(function(){auto_move();},4000);
		
		$('#home-testimonials .testimonial-nav a').each(function(e, element) {
			$(this).hover(function(){
				$('#home-testimonials .testimonial-nav a,#home-testimonials .testimonial').removeClass('active');
				$(this).addClass('active');
				$($(this).attr('href')).addClass('active');
				clearInterval(int);
			},function(){
				index=e;
				int=setInterval(function(){auto_move();},4000);
			});
        });
		$('#home-testimonials .testimonial-nav a').click(function(){ return false; });
	}

// Quick Sand
    function control_quicksand(){
	    
        jQuery('#sort-by').children('li').each(function(){
            $text = jQuery(this).find('a').text();
            $class = jQuery(this).attr('class');
            $class = $class.replace('cat-item','');
            jQuery(this).find('a').attr('href','');
            jQuery(this).find('a').attr('class',$class);
            jQuery(this).attr('class','');
        });
        
        jQuery('#sort-by').append('<li class="active" ><a class="all">All</a></li>');

        var $filterType = jQuery('#sort-by li.active a').attr('class');

        var $holder = jQuery('ul.ourHolder');

        var $data = $holder.clone();

        jQuery('#sort-by>li a').click(function(e) {
            jQuery('#sort-by li').removeClass('active');
            var $filterType = jQuery(this).attr('class');

            jQuery(this).parent().addClass('active');

            
            if ($filterType == 'all') {

                var $filteredData = $data.children('li');

            }else {

                var $filteredData = $data.find('li[data-type*=' + $filterType + ']');

            }

            $holder.quicksand($filteredData,{
                duration: 500,
                easing: 'easeInOutQuad'
            }, function() {
                //tj_prettyPhoto();
	            tj_overlay();
                        
            });
           
            return false;

        });

    }
    control_quicksand();
    
//search button
$("#search-button").toggle(function(){
		$("#header-search").slideDown(400);
	},function(){
		$("#header-search").slideUp(400);
})       
	 // Can also be used with $(document).ready()
	$(window).load(function() {
	  $('.flexslider').flexslider({
		animation: "fade",
		directionNav: true,
		smoothHeight: false,
		controlNav: false 
	  });     
	});       
})
  


