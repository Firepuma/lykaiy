/*!
 * Admin js
 */

jQuery(document).ready(function() {

var uploadparent = 0;
 function media_upload( button_class) {
    var _custom_media = true,
    _orig_send_attachment = wp.media.editor.send.attachment;
    jQuery('body').on('click',button_class, function(e) {
	uploadparent = jQuery(this).closest('div');
        var button_id ='#'+jQuery(this).attr('id');
        /* console.log(button_id); */
        var self = jQuery(button_id);
        var send_attachment_bkp = wp.media.editor.send.attachment;
        var button = jQuery(button_id);
       // var id = button.attr('id').replace('_button', '');
        _custom_media = true;
        wp.media.editor.send.attachment = function(props, attachment){
            if ( _custom_media  ) {
              // jQuery('.custom_media_id').val(attachment.id); 		  
               uploadparent.find('.slideimages').val(attachment.url);
			   uploadparent.find('.imagebox').attr('src',attachment.url);
              // jQuery('.custom_media_image').attr('src',attachment.url).css('display','block');   
            } else {
                return _orig_send_attachment.apply( button_id, [props, attachment] );
            }
        }
        wp.media.editor.open(button);
        return false;
    });
}
media_upload( '.upload_image_button');			
			
			
// Show/hide slides
		jQuery('.slidetitle').click(function() {
				jQuery(this).next().toggle("fast");
				});


// Jquery confim window on reset to defaults
jQuery('#mantra_defaults').click (function() {
		if (!confirm('Reset Mantra Settings to Defaults?')) { return false;}
	});

// Hide or show dimmensions
jQuery('#mantra_dimselect').change(function() {
	if	(jQuery('#mantra_dimselect option:selected').val()=="Absolute") {
				jQuery('#relativedim').hide("normal");jQuery('#absolutedim').show("normal");
				}
	else {
				jQuery('#relativedim').show("normal");jQuery('#absolutedim').hide("normal");
				}
	});

if (jQuery('#mantra_dimselect option:selected').val()=="Absolute") {
		jQuery('#relativedim').hide("normal");jQuery('#absolutedim').show("normal");}
else {
		jQuery('#relativedim').show("normal");jQuery('#absolutedim').hide("normal");
		}


// Hide or show slider settings
jQuery('#mantra_slideType').change(function() {
	jQuery('.slideDivs').hide("normal");
	switch (jQuery('#mantra_slideType option:selected').val()) {

		case "Custom Slides" :
 		jQuery('#sliderCustomSlides').show("normal");
		break;

		case "Latest Posts" :
 		jQuery('#sliderLatestPosts').show("normal");
		break;

		case "Random Posts" :
 		jQuery('#sliderRandomPosts').show("normal");
		break;

		case "Sticky Posts" :
 		jQuery('#sliderStickyPosts').show("normal");
		break;

		case "Latest Posts from Category" :
 		jQuery('#sliderLatestCateg').show("normal");
		break;

		case "Random Posts from Category" :
 		jQuery('#sliderRandomCateg').show("normal");
		break;

		case "Specific Posts" :
 		jQuery('#sliderSpecificPosts').show("normal");
		break;

	}//switch

});//function

jQuery('.slideDivs').hide("normal");
	switch (jQuery('#mantra_slideType option:selected').val()) {

		case "Custom Slides" :
 		jQuery('#sliderCustomSlides').show("normal");
		break;

		case "Latest Posts" :
 		jQuery('#sliderLatestPosts').show("normal");
		break;

		case "Random Posts" :
 		jQuery('#sliderRandomPosts').show("normal");
		break;

		case "Sticky Posts" :
 		jQuery('#sliderStickyPosts').show("normal");
		break;

		case "Latest Posts from Category" :
 		jQuery('#sliderLatestCateg').show("normal");
		break;

		case "Random Posts from Category" :
 		jQuery('#sliderRandomCateg').show("normal");
		break;

		case "Specific Posts" :
 		jQuery('#sliderSpecificPosts').show("normal");
		break;
};//switch

//Slide type value
$sliderNr=jQuery('#mantra_slideType').val();

//Show category if a category type is selected
if ($sliderNr=="Latest Posts from Category" || $sliderNr=="Random Posts from Category" )
		jQuery('#slider-category').show();
else 	jQuery('#slider-category').hide();

//Show number of slides if that's the case
if ($sliderNr=="Latest Posts" || $sliderNr =="Random Posts" || $sliderNr =="Sticky Posts" ||  $sliderNr=="Latest Posts from Category" || $sliderNr=="Random Posts from Category" )
		jQuery('#slider-post-number').show();
else 	jQuery('#slider-post-number').hide();

//On change
jQuery('#mantra_slideType').change(function(){
	$sliderNr=jQuery('#mantra_slideType').val();
//Show category if a category type is selected
	if ($sliderNr=="Latest Posts from Category" || $sliderNr=="Random Posts from Category" )
				jQuery('#slider-category').show();
	else 		jQuery('#slider-category').hide();
//Show number of slides if that's the case
	if ($sliderNr=="Latest Posts" || $sliderNr =="Random Posts" || $sliderNr =="Sticky Posts" || $sliderNr=="Latest Posts from Category" || $sliderNr=="Random Posts from Category" )
			jQuery('#slider-post-number').show();
else 		jQuery('#slider-post-number').hide();
     });//onchange funciton



// Create accordion from existing settings table
	jQuery('.form-table').wrap('<div>');
	jQuery(function() {
			jQuery( "#accordion" ).accordion({
				header: 'h3',
				autoHeight: false, // for jQueryUI <1.10
				heightStyle: "content", // required in jQueryUI 1.10
				collapsible: true,
				navigation: true,
				active: false
				});
					});


  });// ready

  // Change border for selecte inputs
function changeBorder (idName, className) {
	jQuery('.'+className).removeClass( 'checkedClass' );
	jQuery('.'+className).removeClass( 'borderful' );
	jQuery('#'+idName).addClass( 'borderful' );

return 0;
}