<?php get_header(); ?> 

<!--container -->
<div class="container">
    
	<?php get_sidebar(); ?>
    
    <!--content-->
    <div class="content inside blog">
        <?php the_post(); ?> 

        <div class="single-heading">
		  <?php if ( is_day() ) : ?>
                          <h1 class="page-title"><?php esc_html_e('Daily Archives:','rt') ?> <?php printf( '<span>%s</span>', get_the_time(get_option('date_format')) ) ?></h1>
          <?php elseif ( is_month() ) : ?>
                          <h1 class="page-title"><?php esc_html_e('Monthly Archives:','rt') ?> <?php printf( '<span>%s</span>', get_the_time('F Y') ) ?></h1>
          <?php elseif ( is_year() ) : ?>
                          <h1 class="page-title"><?php esc_html_e('Yearly Archives:','rt') ?> <?php printf( '<span>%s</span>', get_the_time('Y') ) ?></h1>
          <?php elseif ( is_category()) : ?>
                          <h1 class="page-title"><?php esc_html_e('Category:','rt') ?> <span><?php single_cat_title(); ?></span></h1>
                          
          <?php elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) : ?>
                          <h1 class="page-title"><?php esc_html_e('Blog Archives','rt') ?></h1>
                          

                          
          <?php endif; ?>
		</div>
        
        <?php if ( get_option('rt_bc_archive') == "true") { ?>
           <div class="breadcrumbs"><?php if (function_exists('rt_breadcrumbs')) rt_breadcrumbs(); ?></div>
        <?php } ?>

        <hr class="divider" />
 
<?php rewind_posts(); ?>
        
 
<?php while ( have_posts() ) : the_post(); ?>
 
                <div class="section-blog post">
                <div class="text">	
                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_html__('Permalink to %s', 'rt'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                    
                    <div class="entry-summary">
                        <p><?php echo rt_excerpt($catex = get_option('rt_catex'), $catexend = get_option('rt_catexend')); ?></p>
                    </div><!-- .entry-summary -->
                    
                    <?php if ( get_option('rt_arch_thumb') == "true") { ?>
                       <?php the_post_thumbnail('blog-thumb'); ?>
                    <?php } ?>
 
                   <?php if ( get_option('rt_arch_more') == "true") { ?>
                      <a href="<?php echo get_permalink() ?>" class="button archive"><?php esc_html_e('More','rt') ?></a>
                   <?php } ?>
                   <div style="clear:both;"></div>

                </div><!--end text-->
                <div class="arrow-section"></div>   
                </div><!--end section-blog -->
 
<?php endwhile; ?>        
    
          <?php if ( get_option('rt_archive_nav')=='Load-More' ) { ?>
             <div class="page-navigation">
                <input type="hidden" value="<?php next_posts(); ?>" name="rt_link" class="rt_link" />
             </div><!--end page-navigation-->
          <?php } elseif ( get_option('rt_archive_nav')=='Custom-Pagination' ) { ?>
             <?php if(function_exists('pagenavi')) { pagenavi(); } ?>
          <?php } elseif ( get_option('rt_archive_nav')=='Default-WordPress' ) { ?>   
                  <div id="nav-above" >
                      <span class="alignleft nav-previous"><?php next_posts_link(esc_html__('&laquo; Previous', 'rt')) ?></span>
                      <span class="alignright nav-next"><?php previous_posts_link(esc_html__('Next &raquo;', 'rt')) ?></span>
                  </div><!-- #nav-above -->
          <?php } ?>  
        
        <!--<a href="" class="more">More</a>-->
    </div><!--end content-->
    
    <div style="clear:both;"></div>
</div><!--end container -->

<?php get_footer(); ?>