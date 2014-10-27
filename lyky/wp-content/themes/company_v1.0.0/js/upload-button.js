jQuery(document).ready(function() {

// Feature IconUpload Button
	jQuery('#tj_feature_icon_button').click(function() {

		window.send_to_editor = function(html)

		{
			imgurl = jQuery('img',html).attr('src');
			jQuery('#tj_feature_icon').val(imgurl);
			tb_remove();
		}


		tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
		return false;

	});

// Author Avatar Upload Button
	jQuery('#tj_author_avatar_button').click(function() {

		window.send_to_editor = function(html)

		{
			imgurl = jQuery('img',html).attr('src');
			jQuery('#tj_testimonial_author_avatar').val(imgurl);
			tb_remove();
		}


		tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
		return false;

	});

});
