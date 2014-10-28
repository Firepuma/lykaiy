/******************************
    Mantra Theme
    custom scripting
    (c) Cryout Creations
    www.cryoutcreations.eu
*******************************/


jQuery(document).ready(function() {

// standard menu touch support for tablets
	var isTouch = ('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch; // check touch support
	jQuery('#access .menu > ul > li a').click(function(e){
		var $link_id = jQuery(this).attr('href');
		if (jQuery(this).parent().data('clicked') == $link_id) { // second touch
			jQuery(this).parent().data('clicked', null);
			return true;
		}
		else { // first touch
			if (isTouch && (jQuery(this).parent().children('.sub-menu').length >0)) e.preventDefault();
			jQuery(this).parent().data('clicked', $link_id);
		}
    });

// Back to top button animation
jQuery(function() {
	jQuery(window).scroll(function() {
		var x=jQuery(this).scrollTop();
		 var ver = getInternetExplorerVersion();
		// no fade animation (transparency) if IE8 or below
		if ( ver > -1 && ver <= 8 ) {
			if(x != 0) {
					jQuery('#toTop').show();
					} else {
					jQuery('#toTop').hide();
						}
		}
		// fade animation if not IE8 or below
		else {
		if(x != 0) {
				jQuery('#toTop').fadeIn(3000);
			} else {
				jQuery('#toTop').fadeOut();
			}
	}
	});
	jQuery('#toTop').click(function() { jQuery('body,html').animate({scrollTop:0},800); });
});


// Menu animation
jQuery("#access ul ul").css({display: "none"}); // Opera Fix
jQuery("#access").removeClass("jssafe"); // JS failsafe
jQuery("#access .menu ul li").hoverIntent({
	over: function(){jQuery(this).children("ul").show(400);},
	out: function(){ jQuery(this).children('ul').hide();},
	timeout:400}
);


// Social Icons Animation
jQuery(".socialicons").hover(
	function(){  jQuery(this).animate({"top": "-3px" },{ queue: false, duration:125}); },
	function(){  jQuery(this).animate({ "top": "0px" }, { queue: false, duration:125 });
});


/*! http://tinynav.viljamis.com v1.03 by @viljamis 
    mod 0.1.1 by cryout creations */
(function ($, window, i) {
  $.fn.tinyNav = function (options) {

    // Default settings
    var settings = $.extend({
      'active' : 'selected', // String: Set the "active" class
      'header' : '' // Show header instead of the active item
    }, options);

    return this.each(function () {

      i++; // Used for namespacing

      var $nav = $(this),
        // Namespacing
        namespace = 'tinynav',
        namespace_i = namespace + i,
        l_namespace_i = '.l_' + namespace_i,
        $select = $('<select/>').addClass(namespace + ' ' + namespace_i);

      if ($nav.is('ul,ol')) {

        if (settings.header) {
          $select.append( $('<option/>').text(settings.header) );
        }

        // Build options
        var options = '';
		var indent = 0;
		var indented = ["&nbsp;"];
		for ( var i = 0; i < 10; i++) { indented.push(indented[indented.length-1]+'-&nbsp;'); }
		indented[0] = "";
        $nav
          .addClass('l_' + namespace_i)
          .children('li')
          .each(buildNavTree=function () {
            var a = $(this).children('a').first();

            options += '<option value="' + a.attr('href') + '">' + indented[indent] + a.text() + '</option>';
              indent++;
              $(this).children('ul,ol').children('li').each(buildNavTree);
              indent--;
          });

        // Append options into a select
        $select.append(options);

        // Select the active item
        if (!settings.header) {
          $select
            .find(':eq(' + $(l_namespace_i + ' li')
            .index($(l_namespace_i + ' li.' + settings.active)) + ')')
            .attr('selected', true);
        }

        // Change window location
        $select.change(function () {
		var loc = $(this).val(); loc = loc.replace(/[\s\t]/gi,'');
		var menu = settings.header; menu = menu.replace(/[\s\t]/gi,'');
          if ((loc!==menu)) { window.location.href = $(this).val(); } else return false;
        });

        // Inject select
        $(l_namespace_i).after($select);

      }

	var current_url = location.protocol + '//' + location.host + location.pathname;
	$('option[value="'+current_url+'"]').attr("selected","selected");

    });

  };
})(jQuery, this, 0);
// end tinynav


// detect and apply custom class for safari
if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
	jQuery('body').addClass('safari');
}


});
// end document.ready


// Columns equalizer, used if at least one sidebar has a bg color
function equalizeHeights(){
    var h1 = jQuery("#primary").height();
	var h2 = jQuery("#secondary").height();
	var h3 = jQuery("#content").height();
    var max = Math.max(h1,h2,h3);
	if (h1<max) { jQuery("#primary").height(max); };
	if (h2<max) { jQuery("#secondary").height(max); };

}

/*!
* FitVids 1.0
*
* Copyright 2011, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
* Date: Thu Sept 01 18:00:00 2011 -0500
*/

(function( $ ){

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null
    }

    var div = document.createElement('div'),
        ref = document.getElementsByTagName('base')[0] || document.getElementsByTagName('script')[0];

   div.className = 'fit-vids-style';
    div.innerHTML = '&shy;<style> .fluid-width-video-wrapper { width: 100%; position: relative; padding: 0; } .fluid-width-video-wrapper iframe, .fluid-width-video-wrapper object, .fluid-width-video-wrapper embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; } </style>';

    ref.parentNode.insertBefore(div,ref);

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each(function(){
      var selectors = [
        "iframe[src*='player.vimeo.com']",
        "iframe[src*='www.youtube.com']",
        "iframe[src*='www.kickstarter.com']",
        "object",
        "embed"
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      var $allVideos = $(this).find(selectors.join(','));

      $allVideos.each(function(){
        var $this = $(this);
        if (this.tagName.toLowerCase() == 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
        var height = this.tagName.toLowerCase() == 'object' ? $this.attr('height') : $this.height(),
            aspectRatio = height / $this.width();
			if(!$this.attr('id')){
				var videoID = 'fitvid' + Math.floor(Math.random()*999999);
				$this.attr('id', videoID);
			}
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+"%");
        $this.removeAttr('height').removeAttr('width');
      });
    });

  }
})( jQuery );


/*!
 * hoverIntent r7 // 2013.03.11 // jQuery 1.9.1+
 * http://cherne.net/brian/resources/jquery.hoverIntent.html
 *
 * You may use hoverIntent under the terms of the MIT license.
 * Copyright 2007, 2013 Brian Cherne
 */
(function(e){e.fn.hoverIntent=function(t,n,r){var i={interval:100,sensitivity:7,timeout:0};if(typeof t==="object"){i=e.extend(i,t)}else if(e.isFunction(n)){i=e.extend(i,{over:t,out:n,selector:r})}else{i=e.extend(i,{over:t,out:t,selector:n})}var s,o,u,a;var f=function(e){s=e.pageX;o=e.pageY};var l=function(t,n){n.hoverIntent_t=clearTimeout(n.hoverIntent_t);if(Math.abs(u-s)+Math.abs(a-o)<i.sensitivity){e(n).off("mousemove.hoverIntent",f);n.hoverIntent_s=1;return i.over.apply(n,[t])}else{u=s;a=o;n.hoverIntent_t=setTimeout(function(){l(t,n)},i.interval)}};var c=function(e,t){t.hoverIntent_t=clearTimeout(t.hoverIntent_t);t.hoverIntent_s=0;return i.out.apply(t,[e])};var h=function(t){var n=jQuery.extend({},t);var r=this;if(r.hoverIntent_t){r.hoverIntent_t=clearTimeout(r.hoverIntent_t)}if(t.type=="mouseenter"){u=n.pageX;a=n.pageY;e(r).on("mousemove.hoverIntent",f);if(r.hoverIntent_s!=1){r.hoverIntent_t=setTimeout(function(){l(n,r)},i.interval)}}else{e(r).off("mousemove.hoverIntent",f);if(r.hoverIntent_s==1){r.hoverIntent_t=setTimeout(function(){c(n,r)},i.timeout)}}};return this.on({"mouseenter.hoverIntent":h,"mouseleave.hoverIntent":h},i.selector)}})(jQuery)


// Returns the version of Internet Explorer or a -1
// (indicating the use of another browser).
function getInternetExplorerVersion()
{
  var rv = -1; // Return value assumes failure.
  if (navigator.appName == 'Microsoft Internet Explorer')
  {
    var ua = navigator.userAgent;
    var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
    if (re.exec(ua) != null)
      rv = parseFloat( RegExp.$1 );
  }
  return rv;
}


