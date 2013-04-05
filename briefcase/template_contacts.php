<?php /* Template Name: Contacts Template */ ?>

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
		$emailTo = get_option('rt_email');
		if (!isset($emailTo) || ($emailTo == '') ){
			$emailTo = get_option('admin_email');
		}
		$subject = '[PHP Snippets] From '.$name;
		$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
		$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}

} ?>

<?php get_header() ?>
<!--container -->
<div class="container">
    
	<?php get_sidebar(); ?>
    
		<!--content-->
		<div class="content about inside">

        <div class="head">
           <a href="<?php page_nav('before'); ?>" title="Previous"><span class="head-left"></span></a>
           <h1><?php $parent_title = get_the_title($post->post_parent); echo $parent_title; ?></h1>
           <a href="<?php page_nav('after'); ?>" title="Next"><span class="head-right"></span></a>
        </div><!--end head-->
        
			<!--breadcrumbs-->
			  <?php if ( get_option('rt_bc_contact') == "true") { ?>
                 <div class="breadcrumbs"><?php if (function_exists('rt_breadcrumbs')) rt_breadcrumbs(); ?></div>
              <?php } ?>
			<!--end breadcrumbs-->
			<hr class="divider" />
			<!--text-->
            
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            
			<div class="text">
						<?php if(isset($emailSent) && $emailSent == true) { ?>
								<p class="success"><?php esc_html_e('Thanks, your email was sent successfully.', 'rt')?></p>
 						<?php } else { ?>
                        
                            <?php if ( get_option('rt_contact_data') == "true") { ?>
							   <?php the_content(); ?>
                            <?php } ?>
                            
							<?php if(isset($hasError) || isset($captchaError)) { ?>
								<p class="error"><?php esc_html_e('Sorry, an error occured.', 'rt')?><p>
						<?php } ?>
			</div><!--text-->
			
            <?php if ( get_option('rt_contacts_est') == "true") { ?>
            <div class="mail">E-mail: <a href=""><?php echo get_option('rt_contacts_mail'); ?></a></div>
			<div class="skype">Skype: <a href=""><?php echo get_option('rt_contacts_skype'); ?></a></div>
			<div class="twitter">Twitter: <a href=""><?php echo get_option('rt_contacts_twitter'); ?></a></div>
            <?php } ?>
            
			<hr class="divider" />
            
            

			
            <h2><?php esc_html_e('Contact Us', 'rt')?></h2>
			<!--fieldset-->
			<fieldset>
				<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
					<div class="input-name">
                       <span class="form-labels"><?php esc_html_e('Name', 'rt')?></span>
                       <div>
                       <input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" />
								<?php if($nameError != '') { ?><span class="error"><?=$nameError;?></span><?php } ?>
                       </div>
                    </div>
                    
                    
					<div class="input-email">
                       <?php esc_html_e('E-Mail', 'rt')?>
                       <div>
                       <input type="text" name="email"  value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" />
								<?php if($emailError != '') { ?>
									<span class="error"><?=$emailError;?></span>
								<?php } ?>
                       </div>
                    </div>
                    
					<div class="form-textarea">
                       <?php esc_html_e('Message', 'rt')?>
                       <div>
                       <textarea name="comments" id="commentsText" cols="40" rows="10" class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
							    <?php if($commentError != '') { ?>
									<span class="error"><?=$commentError;?></span>
								<?php } ?>
                       </div>
                    </div>
        
                    <div><input type="hidden" name="submitted" id="submitted" value="true" /></div>
                    <input type="hidden" name="contact-page" id="contact-page" value="true" />
                    <div><button class="button" id="send" type="submit" ><?php esc_html_e('Send Email', 'rt')?></button></div>
                    
				</form>
			</fieldset>
        <?php } ?>
		</div><!--end content-->
  
        <?php endwhile; endif; ?>
    
</div><!--end container -->
</div>
<?php get_footer(); ?>