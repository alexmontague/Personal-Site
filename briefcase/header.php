<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head profile="http://gmpg.org/xfn/11">
   <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
   <title><?php rockable_titles(); ?></title>
   <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	  <?php if (is_single() || is_page() ) : if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
   <meta name="description" content="<?php the_excerpt_rss(); ?>" />
      <?php meta_post_keywords(); ?>
      <?php endwhile; endif; elseif(is_home()) : ?>
   <meta name="description" content="<?php if (strlen($rt_meta_desc) < 1) { bloginfo('description');} else {echo"$rt_meta_desc";}?>" />
      <?php meta_home_keywords(); ?>
      <?php endif; ?><?php rt_index(); ?><?php rt_canonical(); ?>
   <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php if ( get_option('rt_misc_feedburner') <> "" ) { echo get_option('rt_misc_feedburner'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
   
   <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style.css" type="text/css" media="screen,projection" />
   <!--[if IE 7]><link href="<?php bloginfo('stylesheet_directory'); ?>/css/ie7.css" rel="stylesheet" type="text/css" /><![endif]-->
   
   
   
   <?php wp_head(); ?> 
   <?php include (TEMPLATEPATH . '/includes/scripts.php'); ?> 
   
   
</head>

<body>
    <?php include (TEMPLATEPATH . '/includes/panel.php'); ?>
    <div class="root">