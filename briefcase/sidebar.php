<div class="left">

    <div class="logo">
				<a href="<?php echo get_option('home'); ?>" title="<?php bloginfo('name'); ?>">
					<?php if ( get_option('rt_logo_path') ) { ?>
						<img src="<?php echo get_option('rt_logo_path');?>" alt="<?php bloginfo('name'); ?>" />
						<?php } else { ?>
                        <img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo3.png" alt="<?php bloginfo('name'); ?>" />
					<?php } ?>
				</a>
                
			    <?php if ( get_option('rt_description') == "true") { ?>
                  <div class="description"><?php bloginfo('description'); ?></div>
                <?php } ?>
    </div><!--end logo-->
    
    <div class="menu">
           <?php if(is_active_sidebar('sidebar-main')) : dynamic_sidebar('sidebar-main'); else : ?>
           <?php endif; ?>
    </div><!--end menu -->
    
</div><!--end left -->
