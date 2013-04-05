<script type="text/javascript">

    var rt_themeurl = "<?php bloginfo('stylesheet_directory'); ?>";

    /********************************************************************************************* 
Grid Slider Initialization
     *********************************************************************************************/
    $(document).ready(	
    function() {
        $(".grid-container").gridSlider({
            num_cols:5,
            num_rows:3,
            tile_width:36,
            tile_height:36,
            tile_margin:17,
            tile_border:1,			
            margin:10,			
            auto_scale:true,
            auto_center:true,
            auto_rotate:true,
            delay:<?php echo get_option('rt_carousel_delay') ?>,
            mouseover_pause:false,
            effect:"h_slide",	
            duration:<?php echo get_option('rt_carousel_duration') ?>,
            easing:"",
            display_panel:false,
            panel_direction:"bottom",
            display_timer:true,
            display_dbuttons:true,
            mouseover_dbuttons:false,			
            display_numinfo:false,
            display_index:false,
            display_number:false,
            display_play:false,
            display_caption:false,
            mouseover_caption:true,
            caption_effect:"fade",			
            caption_position:"inside",
            caption_align:"bottom",					
            caption_width:0,
            caption_height:0,
            cont_nav:true,
            shuffle:false,
            category_index:0
        });
    }
);


    /********************************************************************************************* 
Like Module Script
     *********************************************************************************************/
    jQuery(document).ready(function(){
        jQuery("div").live("click",function(){
         
            if(""+jQuery(this).attr("class")=="like-disable"||""+jQuery(this).attr("class")=="like-enable"){
                /** Like**/
                var image = '<div class="heart-zoom" id="zoom_like"></div>';
                var element = jQuery(this);     
                jQuery(this).append(image);
                jQuery(this).children("#zoom_like").animate({
                    opacity: 0,
                    height: '+=25px',
                    width: '+=25px',
                    left:'+=-6px',
                    top:'+=-5px'
                }, 500, function() {
                    jQuery(element).children("#zoom_like").remove();
                });
                var a = parseInt(""+jQuery(this).parent("div").children('.like-counter').children('strong').html());
                var state = ""+jQuery(this).attr("class");
                var c = ""+jQuery(this).attr("id");
                //alert("C:"+c+"A:"+a);
                if(state=='like-enable'){
                    a++;
                    jQuery(this).parent("div").children(".like-enable").removeClass("like-enable").addClass("like-disable");
                    jQuery.post("<?php bloginfo('stylesheet_directory'); ?>/includes/extensions/like/like.class.php",{vote:"plus",post:c},function(data){
                        //alert(data);    
                    });
                }
                if(state=='like-disable'){
                    a--;
                    jQuery(this).parent("div").children(".like-disable").removeClass("like-disable").addClass("like-enable");
                    jQuery.post("<?php bloginfo('stylesheet_directory'); ?>/includes/extensions/like/like.class.php",{vote:"minus",post:c},function(data){
                        //alert(data);
                    }); 
                }
                if(a!=-1){
                    jQuery(this).parent("div").children(".like-counter").children("strong").html(a); 
                }else{
                    jQuery(this).parent("div").children(".like-counter").children("strong").html('0');
                }
                /* * end like **/
            }
            //"porto-disable", "porto-enable"
            if(""+jQuery(this).attr("class")=="porto-enable"||""+jQuery(this).attr("class")=="porto-disable"){ 
                /** portofolio* */
                var image = '<div class="heart-zoom-portfolio" id="zoom_like_portfolio"></div>';
                var element = jQuery(this);                
                jQuery(this).append(image);
                jQuery(this).children("#zoom_like_portfolio").animate({
                    opacity: 0,
                    height: '+=50px',
                    width: '+=50px',
                    left:'+=-26px',
                    top:'+=-26px'
                }, 500, function() {
                    jQuery(element).children("#zoom_like_portfolio").remove();
                });
           
                var a = parseInt(""+jQuery(this).parent("div").children('.like-counter').children('strong').html());
                var state = ""+jQuery(this).attr("class");
                var c = ""+jQuery(this).attr("id"); 
                if(state=='porto-enable'){
                    a++;
                    jQuery(this).parent("div").children(".porto-enable").removeClass("porto-enable").addClass("porto-disable");
                    jQuery.post("<?php bloginfo('stylesheet_directory'); ?>/includes/extensions/like/like.class.php",{vote:"plus",post:c},function(data){
                        //alert(data);    
                    });
                }
                if(state=='porto-disable'){
                    a--;
                    jQuery(this).parent("div").children(".porto-disable").removeClass("porto-disable").addClass("porto-enable");
                    jQuery.post("<?php bloginfo('stylesheet_directory'); ?>/includes/extensions/like/like.class.php",{vote:"minus",post:c},function(data){
                        //alert(data);    
                    }); 
                }
                if(a!=-1)
                    jQuery(this).parent("div").children(".like-counter").children("strong").html(""+a);
                else
                    jQuery(this).parent("div").children(".like-counter").children("strong").html('0');
                /** end portofolio* */
            }     
        });
    
    });




</script>