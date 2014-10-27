<?php
/*
Template Name: Contact Form
*/
?>

<?php 
if(isset($_POST['submitted'])) {
		if(trim($_POST['contactName']) === '') {
			$nameError = 'Please enter your name.';
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		if(trim($_POST['email']) === '')  {
			$emailError = 'Please enter your email address.';
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = 'You entered an invalid email address.';
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		if(trim($_POST['comments']) === '') {
			$commentError = 'Please enter a message.';
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
			
		if(!isset($hasError)) {
			$emailTo = get_option('company_email');
			if (!isset($emailTo) || ($emailTo == '') ){
				$emailTo = get_option('admin_email');
			}
			$subject = '[Contact Form] From '.$name;
			$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
			$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);
			$emailSent = true;
		}
	
} ?>

<?php get_header(); ?>

	<div class="page-header">
	
		<h1 class="page-title container"><?php the_title(); ?></h1>
		
	</div><!-- .page-header -->

	<div id="main" class="clearfix">

    <div id="content">

	    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		    <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<div class="entry-content">
				<?php the_content(); ?>
				<?php if(isset($emailSent) && $emailSent == true) { ?>
				
	                <div class="thanks">
	                    <p><?php _e('Thanks, your email was sent successfully. ', 'junkie') ?></p>
	                </div><!-- .thanks -->
	                
	            <?php } else { ?>
	
	                <?php if(isset($hasError) || isset($captchaError)) { ?>
	                <?php } ?>
	
	                <form action="<?php the_permalink(); ?>" id="contact-form" method="post">
	                    <div class="contact-form">
	                        <div><label for="contactName"><?php _e('Name:', 'junkie') ?></label>
	                            <input class="txt" type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" />
	                            <?php if($nameError != '') { ?>
	                                <span class="error"><?php echo $nameError; ?></span>
	                            <?php } ?>
	                        </div>
	
	                        <div><label for="email"><?php _e('Email:', 'junkie') ?></label>
	                            <input class="txt" type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" />
	                            <?php if($emailError != '') { ?>
	                                <span class="error"><?php echo $emailError; ?></span>
	                            <?php } ?>
	                        </div>
	
	                        <div class="textarea"><label for="commentsText"><?php _e('Message:', 'junkie') ?></label>
	                            <textarea name="comments" id="commentsText" rows="20" cols="30" class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
	                            <?php if($commentError != '') { ?>
	                                <p><span class="error"><?php echo $commentError; ?></span></p>
	                            <?php } ?>
	                        </div>
	
	                        <div>
	                            <input type="hidden" name="submitted" id="submitted" value="true" />
	                            <input name="submit" type="submit" id="submit" class="button" value="<?php _e('Send Email', 'junkie') ?>" />
	                        </div>
	                    </div>
	                </form>
	            <?php } ?>
			</div><!-- .entry-content -->
		</div><!-- #post-<?php the_ID(); ?> -->
		<?php endwhile; endif; ?>
		
	</div><!-- #content -->
		
	<?php get_sidebar(); ?>
	
	</div><!-- #main -->
	 		
<?php get_footer(); ?>