	<!--footer-->
	<div class="footer">
		
		<div class="footer-content">
			<!--footer left-->
			<div class="footer-left">
            
				<div class="footer-logo">
                    <a href="<?php echo get_option('home'); ?>" title="<?php bloginfo('name'); ?>">
                        <?php if ( get_option('rt_logo_path_bottom') ) { ?>
                            <img src="<?php echo get_option('rt_logo_path_bottom');?>" alt="<?php bloginfo('name'); ?>" />
                            <?php } else { ?>
                            <img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo3.png" alt="<?php bloginfo('name'); ?>" />
                        <?php } ?>
                    </a>
                    
					<?php if ( get_option('rt_description_bottom') == "true") { ?>
                      <div class="description"><?php bloginfo('description'); ?></div>
                    <?php } ?>
                </div><!--end footer-logo-->
                
                <?php if ( get_option('rt_footer_latest') == "true") { ?>
				<div class="latest-works">
					<h1><span></span> <?php esc_html_e('&nbsp;latest works&nbsp;','rt') ?> <span></span></h1>
					
                    <div class="latest-works-items">
                    <?php $portfolio = new WP_Query(); $portfolio->query('post_type=portfolio&posts_per_page='.get_option('rt_footer_port_items'));  while ( $portfolio->have_posts() ) : $portfolio->the_post(); ?>

						  <?php $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), '');
                                if (has_post_thumbnail()) {
                                echo '<a href="'.$thumbnail[0].'" title="'.get_the_title().'" class="lightbox" rel="portfolio"><span class="overlay"></span>
                                        <img src="'.get_bloginfo('template_url').'/includes/thumb.php?src='.$thumbnail[0].'&amp;w=36&amp;h=36&amp;zc=1&amp;q=95" alt="popup" />
                                        </a>'; 
                          } ?>
                    
                    <?php endwhile; wp_reset_query(); ?>
                    </div><!--end latest-works-items-->    
                    
				</div><!--end latest-works-->
                <?php } ?>
			</div><!--end footer left-->
            
            
			<!--footer-center-->
			<div class="footer-center">
				<?php if(is_active_sidebar('footer-center')) : dynamic_sidebar('footer-center'); else : ?>
                <?php endif; ?>
                
				<div class="footer-icons">
					<a href="https://twitter.com/#!/RockableThemes" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icon_twitter.png" alt="" /></a>
					<a href="https://www.facebook.com/rockablethemes" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icon_facebook.png" alt="" /></a>
					<a href="http://feeds.feedburner.com/rockablethemes" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icon_rss.png" alt="" /></a>
				</div><!--end footer-icons-->
			</div><!--end footer-center-->
            
            
            
			<!--footer-right-->
			<div class="footer-right">
				<?php if(is_active_sidebar('footer-right')) : dynamic_sidebar('footer-right'); else : ?>
                <?php endif; ?>
			</div><!--end footer-right-->
		
        <?php if ( get_option('rt_display_copyright') == "true") { ?>
           <div class="copyright"><?php esc_html_e('Copyright &#169; 2012 Briefcase, Free Premium Theme. All Rights Reserved','rt') ?><a href="http://rockablethemes.com" target="_blank"> Rockable Themes</a> &amp; <a href="http://designmodo.com" target="_blank">DesignModo</a> </div>
        <?php } ?>
        
        </div>
	</div>
	<!--end footer-->
</div><!--end root -->

<?php wp_footer(); ?>

<?php if ( get_option('rt_analytics') <> "" ) { echo stripslashes(get_option('rt_analytics')); } ?>
<div style="clear:both;"></div>
<?php if ( get_option('rt_mint') <> "" ) { echo stripslashes(get_option('rt_mint')); } ?>	
</body>
</html>