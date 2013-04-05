<?php

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php esc_html_e('This post is password protected. Enter the password to view comments.', 'rt') ?></p>
	<?php
		return;
	}

/*-----------------------------------------------------------------------------------*/
/*	Display the comments + Pings
/*-----------------------------------------------------------------------------------*/

		if ( have_comments() ) : // if there are comments ?>
        
        
        <div id="comment-wrap" class="clearfix">
        
        <?php if ( ! empty($comments_by_type['comment']) ) : // if there are normal comments ?>
        
        <h2><?php comments_number(esc_html__('No Comments', 'rt'), esc_html__('One Comment', 'rt'), esc_html__('Comments (%)', 'rt'));?></h2>
        <hr class="divider" />
        
		<ol class="commentlist">
        <?php wp_list_comments('type=comment&avatar_size=66&callback=tz_comment'); ?>
        </ol>

        <?php endif; ?>

        <?php if ( ! empty($comments_by_type['pings']) ) : // if there are pings ?>
		
		<h3 id="pings"><?php esc_html_e('Trackbacks for this post', 'rt') ?></h3>
		
		<ol class="pinglist">
        <?php wp_list_comments('type=pings&callback=tz_list_pings'); ?>
        <div style="clear:both;"></div> 
        </ol>
        
        <?php endif; ?>
		
		<div class="navigation">
			<div class="alignleft"><?php previous_comments_link(); ?></div>
			<div class="alignright"><?php next_comments_link(); ?></div>
		</div>
		</div>
		<?php
		
		
/*-----------------------------------------------------------------------------------*/
/*	Deal with no comments or closed comments
/*-----------------------------------------------------------------------------------*/
		
		if ('closed' == $post->comment_status ) : // if the post has comments but comments are now closed ?>
		
		<p class="nocomments"><?php esc_html_e('Comments are now closed for this article.', 'rt') ?></p>
		
		<?php endif; ?>

 		<?php else :  ?>
		
        <?php if ('open' == $post->comment_status) : // if comments are open but no comments so far ?>

        <?php else : // if comments are closed ?>
		
		<?php if (is_single()) { ?><p class="nocomments"><?php esc_html_e('Comments are closed.', 'rt') ?></p><?php } ?>

        <?php endif; ?>
        
<?php endif;


/*-----------------------------------------------------------------------------------*/
/*	Comment Form
/*-----------------------------------------------------------------------------------*/

	if ( comments_open() ) : ?>
    
    <?php if ( !have_comments() ) : // if there are comments ?>
        
    
    <?php endif; ?>
    
    <div id="respond-wrap" class="clearfix">

	<div id="respond" class="clearfix">
    
    	<h2 class="respond-title"><?php comment_form_title( esc_html__('Add Comment', 'rt'), esc_html__('Leave a Comment to %s', 'rt') ); ?></h2>
        <hr class="divider" />

		<div class="cancel-comment-reply">
			<?php cancel_comment_reply_link(esc_html__('Click here to cancel reply', 'rt')); ?>
		</div>
	
		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p><?php printf(esc_html__('You must be %1$slogged in%2$s to post a comment.', 'rt'), '<a href="'.get_option('siteurl').'/wp-login.php?redirect_to='.urlencode(get_permalink()).'">', '</a>') ?></p>
		<?php else : ?>
	
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="add-comments">
	
			<?php if ( is_user_logged_in() ) : ?>
		
			<p><?php printf(esc_html__('Logged in as %1$s. %2$sLog out &raquo;%3$s', 'rt'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : get_option('siteurl').'/wp-login.php?action=logout" title="').'" title="'.esc_html__('Log out of this account', 'rt').'">', '</a>') ?></p>
		
			<?php else : ?>
		
            <div class="input-name">
               <div><input type="text" name="author" id="author" tabindex="1" value="" onfocus="if (this.value == '') {this.value = '';}" onblur="if (this.value == '') {this.value = '';}" /></div>
               <?php esc_html_e('Name','rt') ?><sup>*</sup>
            </div><!--end input-name-->
		
            <div class="input-email">
               <div><input type="text" name="email" id="email" tabindex="2" value="" onfocus="if (this.value == '') {this.value = '';}" onblur="if (this.value == '') {this.value = '';}" /></div>
               <?php esc_html_e('E-Mail','rt') ?><sup>*</sup>
            </div><!--end input-email-->
		
            <div class="input-website">
               <div><input type="text" name="url" id="url" tabindex="3" value="" onfocus="if (this.value == '') {this.value = '';}" onblur="if (this.value == '') {this.value = '';}" /></div>
               <?php esc_html_e('Website','rt') ?>
            </div><!--end input-website-->
		
			<?php endif; ?>
		
            <div class="form-textarea">
               <div><textarea name="comment" cols="40" rows="10" tabindex="4" style="height:132px !important;"></textarea></div>
            </div><!--end form-textarea-->
			
			<!--<p class="allowed-tags"><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
		
	
                <div><input name="submit" type="submit" value="<?php esc_html_e('Submit', 'rt')?>" class="button" tabindex="5" /></div>
				<?php comment_id_fields(); ?>

			<?php do_action('comment_form', $post->ID); ?>
	
		</form>

	<?php endif; // If registration required and not logged in ?>
	</div><div style="clear:both;"></div>
	</div>
	<?php endif; // if you delete this the sky will fall on your head ?>
