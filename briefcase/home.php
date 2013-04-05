<?php
/*###########################################################################
HOME PAGE DISPLAY : Portfolio or Blog Template
###########################################################################*/
?>

<?php if ( get_option('rt_homepage_displays')=='Portfolio' ) { ?>

   <?php include (TEMPLATEPATH . '/index.php'); ?>
   
<?php } elseif ( get_option('rt_homepage_displays')=='Blog-Template' ) { ?> 

   <?php include (TEMPLATEPATH . '/template_blog.php'); ?>

<?php } ?>
