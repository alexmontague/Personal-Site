<?php
/*###########################################################################
DEREGISTER DEFAULT WIDGETS
###########################################################################*/
function rt_unregister_default_widgets() {
    unregister_widget('WP_Widget_Search');
}
add_action('widgets_init', 'rt_unregister_default_widgets', 1);



/*###########################################################################
TWITTER STREAM
###########################################################################*/
class Rockable_Twitter extends WP_Widget {

   function Rockable_Twitter() {
	   $widget_ops = array('description' => 'Add your Twitter feed to your sidebar.' );
       parent::WP_Widget(false, __('ROCKABLE : Twitter Stream', 'rt'),$widget_ops);
   }
   
   function widget($args, $instance) {  
    extract( $args );
    $title = ( !empty($instance['title']) ) ? $instance['title'] : '';
    $limit = ( !empty($instance['limit']) ) ? $instance['limit'] : 5;
    $username = ( !empty($instance['username']) ) ? $instance['username'] : 'rt';
        
    $unique_id = $args['widget_id'].rand(0,100);
    $before_widget = '<div class="widget-container widget_twitter">';
    $after_widget = '</div>';
    $before_title = '<h1>';
    $after_title = '</h1>';
    ?>
    <?php echo $before_widget; ?>
    <?php if ($title) echo $before_title . $title . $after_title; ?>
    <div class="back" id="twitter_update_list_<?php echo $unique_id; ?>"></div>
    <?php echo rockable_twitter_script($unique_id,$username,$limit); //Javascript output function ?>
    <?php echo $after_widget; ?>


    <?php
   }

   function update($new_instance, $old_instance) {                
       return $new_instance;
   }

   function form($instance) {        
   
       (isset($instance['title'])) ? $title = esc_attr($instance['title']) : $title = '';
       (isset($instance['username'])) ? $username = esc_attr($instance['username']) : $username = '';
       (isset($instance['limit'])) ? $limit = esc_attr($instance['limit']) : $limit = '';
       ?>
       <p>
	   	   <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title (optional):','rt'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
       </p>
       <p>
	   	   <label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username:','rt'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('username'); ?>"  value="<?php echo $username; ?>" class="widefat" id="<?php echo $this->get_field_id('username'); ?>" />
       </p>
       <p>
	   	   <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limit:','rt'); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('limit'); ?>"  value="<?php echo $limit; ?>" class="" size="3" id="<?php echo $this->get_field_id('limit'); ?>" />

       </p>
      <?php
   }
   
} 
register_widget('Rockable_Twitter');



function rockable_twitter_script($unique_id, $username, $limit) {
    ?>
    <script type="text/javascript">
        <!--//--><![CDATA[//><!--

        function twitterCallback2(twitters) {

            var statusHTML = [];
            for (var i=0; i<twitters.length; i++){
                var username = twitters[i].user.screen_name;
                var username_avatar = twitters[i].user.profile_image_url;
                var status = twitters[i].text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
                    return '<a href="'+url+'">'+url+'</a>';
                }).replace(/\B@([_a-z0-9]+)/ig, function(reply) {
                    return  reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
                });
                statusHTML.push('<div class="tweet_item"><div class="tweet_image"><img src="'+username_avatar+'" width="30" height="30" alt="" /></div><div class="tweet_text"><div class="inner">'+status+'</div></div><div class="clear"></div></div>');
            }
            document.getElementById('twitter_update_list_<?php echo $unique_id; ?>').innerHTML = statusHTML.join('');
        }

        function relative_time(time_value) {
            var values = time_value.split(" ");
            time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
            var parsed_date = Date.parse(time_value);
            var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
            var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
            delta = delta + (relative_to.getTimezoneOffset() * 60);

            if (delta < 60) {
                return 'less than a minute ago';
            } else if(delta < 120) {
                return 'about a minute ago';
            } else if(delta < (60*60)) {
                return (parseInt(delta / 60)).toString() + ' minutes ago';
            } else if(delta < (120*60)) {
                return 'about an hour ago';
            } else if(delta < (24*60*60)) {
                return 'about ' + (parseInt(delta / 3600)).toString() + ' hours ago';
            } else if(delta < (48*60*60)) {
                return '1 day ago';
            } else {
                return (parseInt(delta / 86400)).toString() + ' days ago';
            }
        }
        //-->!]]>
    </script>
    <script type="text/javascript" src="http://api.twitter.com/1/statuses/user_timeline/<?php echo $username; ?>.json?callback=twitterCallback2&amp;count=<?php echo $limit; ?>&amp;include_rts=t"></script>
    <?php
}


/*###########################################################################
POPULAR POSTS
###########################################################################*/
class rockable_popular extends WP_Widget {

function rockable_popular() {
   $widget_ops = array('description' => 'Popular Posts widget with thumbnails.' );
   parent::WP_Widget(false, $name = __('ROCKABLE : Popular Posts'), $widget_ops);    
}
 
function widget($args, $instance) {        
   extract( $args );
   $number = $instance['number']; if ($number == '') $number = 5;
   $popular_title = $instance['popular_title']; 
?>
<div class="popular-posts">
         <h1><?php echo $popular_title; ?></h1>
          
              <ul>
              <?php $popular = new WP_Query('orderby=comment_count&posts_per_page='. $number); while ($popular->have_posts()) : $popular->the_post(); ?>
                  
                  <li>
                    <div class="popular-thumb">
						  <?php $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), '');
                                if (has_post_thumbnail()) {
                                echo '<a href="'.get_permalink().'" title="'.get_the_title().'">
                                        <img src="'.get_bloginfo('template_url').'/includes/thumb.php?src='.$thumbnail[0].'&amp;w=153&amp;h=35&amp;zc=1&amp;q=95" alt="popup" />
                                        </a>'; 
                          } ?>
                   </div>
                     
                   <p class="popular-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
                   <span class="meta"><?php the_time('F jS, Y') ?> <cite><img src="<?php bloginfo('stylesheet_directory'); ?>/images/pix_gray.png" alt="" /> <?php comments_popup_link( 'no comments', 'one comment', '% comments'); ?></cite></span>
                      
                  </li>
                  
              <?php endwhile; wp_reset_query(); ?>
              </ul>
</div><!--end popular-posts-->


<?php } function update($new_instance, $old_instance) { return $new_instance; }

function form($instance) {                
   $number = esc_attr($instance['number']);
   $popular_title = esc_attr($instance['popular_title']); ?>
   
   <p>
   <label for="<?php echo $this->get_field_id('popular_title'); ?>">Title:</label>
   <input type="text" name="<?php echo $this->get_field_name('popular_title'); ?>" value="<?php echo $popular_title; ?>" class="widefat" id="<?php echo $this->get_field_id('popular_title'); ?>" />
   </p>
           
   <p>
   <label for="<?php echo $this->get_field_id('number'); ?>">Number of Posts
   <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
   </label>
   </p>
       
<?php } } register_widget('rockable_popular');



/*###########################################################################
SEARCH & STAY IN TOUCH
###########################################################################*/
class rockable_search_social extends WP_Widget {

function rockable_search_social() {
   $widget_ops = array('description' => 'This widget includes a search area and a social widget.' );
   parent::WP_Widget(false, $name = __('ROCKABLE : Search Widget'), $widget_ops);    
}
 
function widget($args, $instance) {        
   extract( $args );
   $search_title = $instance['search_title'];
?>
       
<div class="sidebar-block">
        <h1><?php echo $search_title; ?></h1>

        <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
          <div class="search-bg">
          <input type="text" value="Search" name="s" id="search-input" onfocus="if (this.value == 'Search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search';}" />
          </div><!--end search-bg-->
          <div><input type="submit" id="go" alt="Search" title="Search" value="GO" /></div>
        </form>
</div><!--end sidebar-block-->


<?php } function update($new_instance, $old_instance) { return $new_instance; }
			function form($instance) {                
			   $search_title = esc_attr($instance['search_title']);
   ?>   
   
   <p>
   <label for="<?php echo $this->get_field_id('search_title'); ?>">Title:</label>
   <input type="text" name="<?php echo $this->get_field_name('search_title'); ?>" value="<?php echo $search_title; ?>" class="widefat" id="<?php echo $this->get_field_id('search_title'); ?>" />
   </p>
       
<?php } } register_widget('rockable_search_social');

