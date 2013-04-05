<?php get_header(); ?> 

<!--container -->
<div class="container">

    <?php get_sidebar(); ?>
        
    <!--content-->
    <div class="content content-images index-port">        
    
			<?php $portfolio = new WP_Query(); $portfolio->query('post_type=portfolio&posts_per_page='.get_option('rt_index_port_items').'&paged='.get_query_var('paged')); ?>
			<?php while ($portfolio->have_posts()) : $portfolio->the_post(); ?>
            
                 <div class="post">
                    <div class="post-border">
                     <?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); if(has_post_thumbnail()): ?>
                        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="load-bg-index">
							  <img src="<?php bloginfo('template_url'); ?>/includes/thumb.php?src=<?php echo $thumbnail[0]; ?>&amp;w=228&amp;h=138&amp;q=100&amp;zc=1" alt="" />
                        </a>
                              
                              <?php if ( get_option('rt_index_title') == "true") { ?>
                                 <span><?php the_title(); ?></span>
                              <?php } ?>
                              
                              <?php if ( get_option('rt_index_like') == "true") { ?>
                                 <div class="porto-like"><?php echo $like->gen_like(get_the_ID(),$post_type)?></div>
                              <?php } ?>
                        
					 <?php endif; ?>
                     <div style="clear:both;"></div>
                    </div><!--end post-border-->   
                 </div><!--end post-->
                  
            <?php endwhile; //wp_reset_query(); ?>
        
			
          <?php if ( get_option('rt_index_port_nav')=='Load-More' ) { ?>
             <div class="page-navigation">
                <input type="hidden" value="<?php next_posts(); ?>" name="rt_link" class="rt_link" />
             </div><!--end page-navigation-->
          <?php } elseif ( get_option('rt_index_port_nav')=='Custom-Pagination' ) { ?>
             <?php if(function_exists('pagenavi')) { pagenavi(); } ?>
          <?php } elseif ( get_option('rt_index_port_nav')=='Default-WordPress' ) { ?>   
                  <div id="nav-above" >
                      <span class="alignleft nav-previous"><?php next_posts_link(esc_html__('&laquo; Previous', 'rt')) ?></span>
                      <span class="alignright nav-next"><?php previous_posts_link(esc_html__('Next &raquo;', 'rt')) ?></span>
                  </div><!-- #nav-above -->
          <?php } ?>  

			                   
    </div><!--end content-->
    
</div><!--end container -->

<?php get_footer(); ?>