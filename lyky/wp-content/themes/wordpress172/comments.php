<?php
	if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('请不要直接加载该页面，谢谢！');
	
	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('这篇文章需要密码，请输入密码访问'); ?></p> 
	<?php
		return;
	}
?>

     <script type="text/javascript"> 
	var defaultAuthor = "称呼(必填)";
	var defaultEmail = "邮箱(不会被公开,必填)";
	var defaultUrl = "网站";
	var defaultComment = "评论内容...";
	
	function commentform_submit(){
		if(document.commentform.author.value == '' || document.commentform.author.value == defaultAuthor) {alert('咳咳...称呼忘填了');document.commentform.author.focus();return;}
		if(document.commentform.email.value == '' || document.commentform.email.value == defaultEmail) {alert('email...您的email没填');document.commentform.email.focus();return;}
		if(document.commentform.comment.value == '' || document.commentform.comment.value == defaultComment) {alert('评论内容在哪？');document.commentform.comment.focus();return;}
		if(document.commentform.url.value == defaultUrl) document.commentform.url.value = '';
		document.commentform.submit();
	}
	</script>


<?php if ($comments) : ?>

	<ol>

	<?php foreach ($comments as $comment) : ?>

    
<li id="comment">
    <a href="http://mohuansenling.com" class="avatar" target="_blank"><?php echo get_avatar( $comment, 43 ); ?></a>
    <div>
    <h2><a href="<?php comment_author_link(); ?>" class="urse" target="_blank"><?php comment_author(); ?></a> <span class="c_time"><?php comment_date(); ?></span></h2>
    <?php comment_text(); ?>
	</div>
    </li>

	<?php /* Changes every other comment to a different class */
		if ('alt' == $oddcomment) $oddcomment = '';
		else $oddcomment = 'alt';
	?>

	<?php endforeach; /* end for each comment */ ?>

	</ol>
	<div class="pagenavi"><?php paginate_comments_links('prev_text=上一页&next_text=下一页');?></div>
 <?php else : ?>
	<?php if ('open' == $post->comment_status) : ?>
	<?php else : ?>
		<p class="nocomments">抱歉，暂停评论。</p>
	<?php endif; ?>
<?php endif; ?>

<?php if ( comments_open() ) : ?>
<div class="clear"></div>
<div id="respond">
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<h3 class="clearfix"><span id="cancel-comment-reply"><?php cancel_comment_reply_link() ?></span></h3></form></div>

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p><?php printf(__('你需要 <a href="%s">登录</a> 才可以回复.'), wp_login_url( get_permalink() )); ?></p>
<?php else : ?>

      </div>
<div class="commentform">
	 <form action="<?php bloginfo('home') ?>/wp-comments-post.php" method="post" name="commentform" id="commentform">
     <h4>Comment on <a href="#top" class="back_top"></a></h4>

<?php if ( is_user_logged_in() ) : ?>
<ul>
<li class="smilies"><?php printf(__('当前您登录的用户名为 <a href="%1$s">%2$s</a>，'), get_option('siteurl') . '/wp-admin/profile.php', $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account'); ?>"><?php _e('退出 &raquo;'); ?></a></li>






<?php else : ?>

     <ul>
     <li><input name="author" type="text" class="input" value="Name" onfocus="if(this.value==defaultAuthor)this.value='';" onblur="if(this.value==''){this.value=defaultAuthor;}"><span class="login_register"><a href="<?php bloginfo('home') ?>/wp-login.php?redirect_to=<?php the_permalink() ?>">Login</a> | <a href="<?php bloginfo('home') ?>/wp-login.php?action=register">Regester</a></span></li>
     <li><input name="email" type="text" class="input" value="E-Mll" onfocus="if(this.value==defaultEmail)this.value='';" onblur="if(this.value==''){this.value=defaultEmail;}"></li>
     <li><input name="url" type="text" class="input" value="Website" onfocus="if(this.value==defaultUrl)this.value='';" onblur="if(this.value==''){this.value=defaultUrl;}"></li>

<?php endif; ?>
     <li><textarea name="comment" cols="" rows="" onfocus="if(this.value==defaultComment)this.value='';" onblur="if(this.value==''){this.value=defaultComment;}" onpropertychange="if(value.length&gt;1000) value=value.substr(0,1000)">Content...</textarea></li>
    
     <li class="bnt"><a onfocus="this.blur()" href="javascript:commentform_submit();">Sent </a></li><li>
	 <input type="hidden" id="comment_parent" name="comment_parent" value="0"></ul>

 <?php comment_id_fields(); ?> 
<?php do_action('comment_form', $post->ID); ?>
</form>
<?php endif; ?>

<?php endif; ?>
