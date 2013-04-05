<?php /* Template Name: Blog Template */ ?>
<?php get_header(); ?>

 

<!--container -->
<div class="container">
    
	<?php get_sidebar(); ?>
    
    <!--content-->
    <div class="content inside blog" id="content">
 
		   <?php if (is_front_page()) {?>

           <?php } else { ?>
                  <div class="head">
                     <a href="<?php page_nav('before'); ?>" title="Previous"><span class="head-left"></span></a>
                     <h1><?php $parent_title = get_the_title($post->post_parent); echo $parent_title; ?></h1>
                     <a href="<?php page_nav('after'); ?>" title="Next"><span class="head-right"></span></a>
                  </div><!--end head-->
            
                    <?php if ( get_option('rt_bc_blog') == "true") { ?>
                       <div class="breadcrumbs"><?php if (function_exists('rt_breadcrumbs')) rt_breadcrumbs(); ?></div>
                    <?php } ?>                  
                  <hr class="blog" />
           <?php } ?>
        
		   <?php
           $query_string = "&cat=".get_option('rt_blog_exclude_cat')."&paged=$paged";
           $blog_posts = new WP_Query($query_string); 
           ?>
       
            <?php if ($blog_posts->have_posts()) : $count = 0; while ($blog_posts->have_posts()) : $blog_posts->the_post(); $count++; ?>
              
              <!--section-blog-->
                  <div class="section-blog post">
                  
                      <!--text-->
                      <div class="text">
                          <h2><a href="<?php echo get_permalink() ?>" title=""><?php the_title(); ?></a></h2>
                          
                          <?php if (is_front_page()) {?>
                             <p><?php echo rt_excerpt($blog1_ex = get_option('rt_index_blog1_ex'), $blog1_exte = get_option('rt_index_blog1_exte')); ?></p>
                          <?php } else { ?>
                             <p><?php echo rt_excerpt($blog1_ex = get_option('rt_blog1_ex'), $blog1_exte = get_option('rt_blog1_exte')); ?></p>
                          <?php } ?>
                          
                          
                          <?php if (is_front_page()) {?>
                             <?php if ( get_option('rt_index_blog1_thumb') == "true") { ?>
                                <a href="<?php echo get_permalink() ?>" class="load-bg-blog"><?php the_post_thumbnail('blog-thumb'); ?></a>
                             <?php } ?>
                          <?php } else { ?>
                             <?php if ( get_option('rt_blog1_thumb') == "true") { ?>
                                <a href="<?php echo get_permalink() ?>" class="load-bg-blog"><?php the_post_thumbnail('blog-thumb'); ?></a>
                             <?php } ?>
                          <?php } ?>
                          
                          
                          <?php if (is_front_page()) {?>
                             <?php if ( get_option('rt_index_blog1_caption') == "true") { ?>
                                <div class="img-desc"><?php the_post_thumbnail_caption(); ?></div><!--end img-desc-->
                             <?php } ?>
                          <?php } else { ?>
                             <?php if ( get_option('rt_blog1_caption') == "true") { ?>
                                <div class="img-desc"><?php the_post_thumbnail_caption(); ?></div><!--end img-desc-->
                             <?php } ?>
                          <?php } ?>
                          
                          
                          <?php if (is_front_page()) {?>
							  <?php if ( get_option('rt_index_blog1_meta') == "true") { ?>
                                  <div class="arrow-date-link"></div>
                                  <div class="date-link">
                                      <div class="blog-like"><?php echo $like->gen_like(get_the_ID(),$post_type)?></div>
                                      <a href="<?php echo get_permalink() ?>" class="link"></a>
                                      <div class="date"><?php the_time('F jS Y') ?></div>
                                      <div class="comm"><?php comments_popup_link( esc_html__( 'Leave a comment', 'rt'), esc_html__( '1 Comment', 'rt'), esc_html__( '% Comments', 'rt') ) ?></div>
                                      
                                      <div class="icons">
                                          <a href="http://twitter.com/home?status=Reading on <?php bloginfo('name') ?> - <?php the_title(); ?> <?php the_permalink(); ?>" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icon_twitter.png" alt="" /></a>
                                          <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icon_facebook.png" alt="" /></a>
                                      </div>
                                  </div><!--end date-link-->
                              <?php } ?>
                          <?php } else { ?>
							  <?php if ( get_option('rt_blog1_meta') == "true") { ?>
                                  <div class="arrow-date-link"></div>
                                  <div class="date-link">
                                      <div class="blog-like"><?php echo $like->gen_like(get_the_ID(),$post_type)?></div>
                                      <a href="<?php echo get_permalink() ?>" class="link"></a>
                                      <div class="date"><?php the_time('F jS Y') ?></div>
                                      <div class="comm"><?php comments_popup_link( esc_html__( 'Leave a comment', 'rt'), esc_html__( '1 Comment', 'rt'), esc_html__( '% Comments', 'rt') ) ?></div>
                                      
                                      <div class="icons">
                                          <a href="http://twitter.com/home?status=Reading on <?php bloginfo('name') ?> - <?php the_title(); ?> <?php the_permalink(); ?>" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icon_twitter.png" alt="" /></a>
                                          <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icon_facebook.png" alt="" /></a>
                                      </div>
                                  </div><!--end date-link-->
                              <?php } ?>
                          <?php } ?>
                          
                          
                          <?php if (is_front_page()) {?>
                             <?php if ( get_option('rt_index_blog1_readmore') == "true") { ?>
                                <a href="<?php echo get_permalink() ?>" class="button"><?php esc_html_e('More','rt') ?></a>
                             <?php } ?>
                          <?php } else { ?>
                             <?php if ( get_option('rt_blog1_readmore') == "true") { ?>
                                <a href="<?php echo get_permalink() ?>" class="button"><?php esc_html_e('More','rt') ?></a>
                             <?php } ?>
                          <?php } ?>
                          
                      </div><!--end text-->
                      <div class="arrow-section"></div>
              </div><!--end section-blog-->
              
      
              
          <?php endwhile; else: ?>
          <?php endif; ?>
           
          <!-- Page Navigation -->
		   <?php if (is_front_page()) { ?>
				<?php if ( get_option('rt_index_blog1_nav')=='Load-More' ) { ?>
                   <div class="page-navigation">
                      <input type="hidden" value="<?php next_posts(); ?>" name="rt_link" class="rt_link" />
                   </div><!--end page-navigation-->
                <?php } elseif ( get_option('rt_index_blog1_nav')=='Custom-Pagination' ) { ?>
                   <?php if(function_exists('pagenavi')) { pagenavi(); } ?>
                <?php } elseif ( get_option('rt_index_blog1_nav')=='Default-WordPress' ) { ?>   
                        <div id="nav-above" >
                            <span class="alignleft nav-previous"><?php next_posts_link(esc_html__('&laquo; Previous', 'rt')) ?></span>
                            <span class="alignright nav-next"><?php previous_posts_link(esc_html__('Next &raquo;', 'rt')) ?></span>
                        </div><!-- #nav-above -->
                <?php } ?>
           
		   <?php } else { ?>
           		<?php $wp_query = $blog_posts; ?>
	            <?php rockable_ajax_pagination(); ?>
	            <?php remove_action('wp_footer','rockable_ajax_pagination'); ?>
				<?php if ( get_option('rt_blog1_nav')=='Load-More' ) { ?>
                   <div class="page-navigation">
                      <input type="hidden" value="<?php next_posts(); ?>" name="rt_link" class="rt_link" />
                   </div><!--end page-navigation-->
                <?php } elseif ( get_option('rt_blog1_nav')=='Custom-Pagination' ) { ?>
                   <?php if(function_exists('pagenavi')) { pagenavi(); } ?>
                <?php } elseif ( get_option('rt_blog1_nav')=='Default-WordPress' ) { ?>   
                        <div id="nav-above" >
                            <span class="alignleft nav-previous"><?php next_posts_link(esc_html__('&laquo; Previous', 'rt')) ?></span>
                            <span class="alignright nav-next"><?php previous_posts_link(esc_html__('Next &raquo;', 'rt')) ?></span>
                        </div><!-- #nav-above -->
                <?php } ?>
                
           <?php } ?>
           
        
    </div><!--end content-->
    
    <div style="clear:both;"></div>
</div><!--end container -->

<?php get_footer(); ?>