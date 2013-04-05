<?php get_header(); ?> 

<!--container -->
<div class="container">
    
	<?php get_sidebar(); ?>
    
    <!--content-->
    <div class="content inside search">
        <h1><?php printf( esc_html__( 'Search Results for: %s', 'rt' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
        
        <?php if ( get_option('rt_bc_search') == "true") { ?>
           <div class="breadcrumbs"><?php if (function_exists('rt_breadcrumbs')) rt_breadcrumbs(); ?></div>
        <?php } ?>
        <hr class="divider" />
        
		<?php if ( have_posts() )  : $count = 0; while (have_posts()) : the_post(); $count++; ?>
                        
                    <div class="section-blog post">
                      <div class="text search">	
                        <h2><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h2>
                        
                        <?php if ( get_option('rt_search_thumb') == "true") { ?>
                           <?php the_post_thumbnail('blog-thumb'); ?>
                        <?php } ?>
                        
                        <p><?php echo rt_excerpt($searchex = get_option('rt_searchex'), $searchexend = get_option('rt_searchexend')); ?></p>
                        
                        <small class="post-date first"><?php esc_html_e('Published', 'rt')?> <?php echo get_the_date() ?></small>
                      </div><!--end text-->
                      <div class="arrow-section"></div>
                    </div><!--end section-blog-->
                        
                        
        <?php endwhile; else : ?>
                        <div class="post no-results not-found">
                            <h2><?php esc_html_e( 'Nothing Found', 'rt' ); ?></h2>
                            <div class="entry-content">
                                <p><?php esc_html_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'rt'); ?></p>
                                <hr />
                                <?php include (TEMPLATEPATH . '/includes/search-form.php'); ?>
                            </div><!--end entry-content -->
                        </div><!--end post -->
        <?php endif; ?>
        
          <?php if ( get_option('rt_search_nav')=='Load-More' ) { ?>
             <div class="page-navigation">
                <input type="hidden" value="<?php next_posts(); ?>" name="rt_link" class="rt_link" />
             </div><!--end page-navigation-->
          <?php } elseif ( get_option('rt_search_nav')=='Custom-Pagination' ) { ?>
             <?php if(function_exists('pagenavi')) { pagenavi(); } ?>
          <?php } elseif ( get_option('rt_search_nav')=='Default-WordPress' ) { ?>   
                  <div id="nav-above" >
                      <span class="alignleft nav-previous"><? next_posts_link(esc_html__('&laquo; Previous', 'rt')) ?></span>
                      <span class="alignright nav-next"><? previous_posts_link(esc_html__('Next &raquo;', 'rt')) ?></span>
                  </div><!-- #nav-above -->
          <?php } ?>  
                  
    </div><!--end content-->
    
    <div style="clear:both;"></div>
</div><!--end container -->

<?php get_footer(); ?>