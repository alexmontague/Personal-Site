<?php
if(isset($_POST['submitted']) && !isset($_POST['contact-page'])) {
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
		$emailTo = get_option('tz_email');
		if (!isset($emailTo) || ($emailTo == '') ){
			$emailTo = get_option('admin_email');
		}
		$subject = '[PHP Snippets] From '.$name;
		$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
		$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}

}
if(isset($_POST['contact-page'])){
	unset($_POST);	
}
?>

						<?php if(isset($emailSent) && $emailSent == true) { ?>
								<p class="success"><?php esc_html_e('Thanks, your email was sent successfully.', 'rt')?></p>
 						<?php } else { ?>
							<?php if(isset($hasError) || isset($captchaError)) { ?>
								<p class="error"><?php esc_html_e('Sorry, an error occured.', 'rt')?><p>
							<?php } ?>
						<?php } ?>

    
    			<form action="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>" id="contactForm2" method="post">
					<div class="pc-name">
                       <input type="text" name="contactName" id="contactName" value="Name<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" onfocus="if (this.value == 'Name') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Name';}"  />
					   <?php if($nameError != '') { ?><span class="error"><?=$nameError;?></span><?php } ?>
                    </div>
                    
                    <div class="pc-mail"> 
                       <input type="text" name="email" value="Email<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" onfocus="if (this.value == 'Email') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Email';}" />
					   <?php if($emailError != '') { ?><span class="error"><?=$emailError;?></span><?php } ?>
                    </div>
                    
                    
					<div class="pc-text">
                       <textarea name="comments" id="commentsText" cols="40" rows="10" class="required requiredField" ><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
					   <?php if($commentError != '') { ?><span class="error"><?=$commentError;?></span><?php } ?>
                    </div>
                    
                    
                    <div><input type="hidden" name="submitted" id="submitted" value="true" /></div>
                    <div><button class="button" type="submit" id="send"><?php esc_html_e('Submit', 'rt')?></button></div>
				</form>
				
	

	