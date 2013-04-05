<?php if ( get_option('rt_dashboard') == "true") { ?>
<div class="toggle-container">
  <div class="toggle-wrapper">
    <div class="panel-block">
			<div class="panel-about">
				<h1><?php esc_html_e('About Me','rt') ?></h1>
				<hr />
                
				   <p><?php echo get_option('rt_panel_about'); ?></p>
				   <a href="<?php echo get_option('rt_panel_about_link'); ?>" class="more"><?php esc_html_e('more','rt') ?></a>
                 
			</div>
            
            
			<div class="panel-works">
				<h1><?php esc_html_e('Latest Works','rt') ?> <a href="<?php echo get_option('rt_panel_works_link'); ?>"><?php echo get_option('rt_panel_works_text'); ?></a></h1>
				<hr />
				<?php include (TEMPLATEPATH . '/includes/panel-carousel.php'); ?>
			</div>
            
            
			<div class="panel-contacts">
				<h1><?php esc_html_e('Contact','rt') ?> <a href="<?php echo get_option('rt_panel_contacts_link'); ?>"><?php echo get_option('rt_panel_contacts_text'); ?></a></h1>
				<hr />
                <?php include (TEMPLATEPATH . '/includes/panel-contact.php'); ?>
			</div><!--end panel-contacts-->
    </div><!--end panel-block--> 
  </div><!--end toggle-wrapper-->  
</div><!--end toggle-container-->



<div class="panel-button">
  <div>Open</div>
</div>    
<?php } ?>