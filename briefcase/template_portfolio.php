<?php /* Template Name: Portfolio Template */ ?>
<?php get_header(); ?> 

<!--container -->
<div class="container">
	<?php get_sidebar(); ?>    
		<div class="content port">
        
        <div class="head">
           <a href="<?php page_nav('before'); ?>" title="Previous"><span class="head-left"></span></a>
           <h1><?php $parent_title = get_the_title($post->post_parent); echo $parent_title; ?></h1>
           <a href="<?php page_nav('after'); ?>" title="Next"><span class="head-right"></span></a>
        </div><!--end head-->
        
        <?php if ( get_option('rt_bc_portfolio') == "true") { ?>
           <div class="breadcrumbs"><?php if (function_exists('rt_breadcrumbs')) rt_breadcrumbs(); ?></div>
        <?php } ?>
            <hr class="divider" />
            
            <?php if ( get_option('rt_portfolio_filter') == "true") { ?>
              <ul id="port-cat" class='filter'>
                <li>Filter : </li> 
                <li><a class="active all" data-value="all" href="#"><?php esc_html_e('All', 'rt')?></a></li>
                <?php wp_list_categories(array('title_li' => '', 'taxonomy' => 'portfolio-categories', 'walker' => new Portfolio_Walker())); ?>
              </ul>
            <?php } ?>
            
               
			<ul class="galery filterable-grid">
			<?php $paged = (get_query_var('paged')<=1)? 1 : get_query_var('paged'); $count = ($paged-1)*get_option('rt_port_items') + 1; ?>
			<?php $portfolio = new WP_Query(); $portfolio ->query('post_type=portfolio&posts_per_page='.get_option('rt_port_items').'&paged='.get_query_var('paged')); while ($portfolio ->have_posts()) : $portfolio ->the_post(); $terms = get_the_terms( get_the_ID(), 'portfolio-categories' ); ?>
            
            
                  <li data-id="id-<?php echo $count; ?>" data-type="<?php foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } ?>" class="filter-item">
                      <?php $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), '');
                            if (has_post_thumbnail()) {
                            echo '<a href="'.$thumbnail[0].'" title="'.get_the_title().'" class="lightbox" rel="portfolio"><span class="overlay"></span>
                                    <img src="'.get_bloginfo('template_url').'/includes/thumb.php?src='.$thumbnail[0].'&amp;w=140&amp;h=85&amp;zc=1&amp;q=95" alt=""/>
                                    </a>'; 
                      } ?>
                  
                  <?php $count++; ?>    
                  </li>
            
            <?php endwhile; wp_reset_query(); ?>
			</ul><!--end galery-->
            
            
            
            
            
            <div class="page-navigation">
               <input type="hidden" value="<?php next_posts(); ?>" name="rt_link" class="rt_link" />
            </div><!--end page-navigation-->
            
		</div><!--end content-->
</div><!--end container -->

<?php get_footer(); ?>