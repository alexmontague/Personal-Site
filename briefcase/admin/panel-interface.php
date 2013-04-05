<?php

/*##########################################################################################
Rockable Framework Admin Interface
##########################################################################################*/
$functions_path = RT_FILEPATH . '/admin/';

function rockableframework_add_admin() {

    global $query_string;
    
    $themename =  get_option('rt_themename');
    $shortname =  get_option('rt_shortname'); 
	$icon = RT_DIRECTORY . '/admin/images/rt_icon8.png';
	
   
    if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'rockableframework' ) {
		if (isset($_REQUEST['rt_save']) && 'reset' == $_REQUEST['rt_save']) {
			$options =  get_option('rt_template'); 
			rt_reset_options($options,'rockableframework');
			header("Location: admin.php?page=rockableframework&reset=true");
			die;
		}
    }


//Updater
$rockable_total_update_count = get_option('rockable_'.get_option('rt_themename').'_update_count');
$rockable_update_title = get_option('rockable_'.get_option('rt_themename').'_update_count'). 'Update Available';
$count = "<span class='update-plugins count-$rockable_total_update_count' title='$rockable_update_title'><span class='update-count'>" .$rockable_total_update_count . "</span></span>";



/*##########################################################################################
Load theme options menu in wordpress dashboard
##########################################################################################*/
 if(function_exists('add_object_page')) {
	 //Possition Object Page after Comments Separator
	 global $_wp_last_object_menu; $_wp_last_object_menu = 26;
	 
                                add_object_page('Page Title', 'RockableThemes', 8, 'rockableframework', 'rockableframework_options_page', $icon);
                        } else {
                                add_menu_page('Page Title', $themename, 8,'edit_theme_options', 'rockableframework_options_page'); }
								$rt_page = add_submenu_page('rockableframework', $themename, 'Theme Options', 8, 'rockableframework','rockableframework_options_page');
								//$rt_updates = add_submenu_page('rockableframework', $themename, 'Updates' .$count , 8, 'rockable_updates','rockable_updates'); // Updates
	


// After activation, go to admin panel page
if (is_admin() && $_GET['activated'] == 'true') {
    header("Location: admin.php?page=rockableframework");
}

//Add Separator after Comments Section
add_action('admin_head', 'edit_admin_menu');
function edit_admin_menu(){
	global $menu;
	$menu[26] = array('', 8, 'separator', '', 'wp-menu-separator');
	ksort($menu);
}
	
// Add framework functionaily to the head individually
	add_action("admin_print_scripts-$rt_page", 'rt_load_only');
} 

add_action('admin_menu', 'rockableframework_add_admin', 10);


/*##########################################################################################
Rockable Framework Reset Function
##########################################################################################*/
function rt_reset_options($options,$page = ''){

	global $wpdb;
	$query_inner = '';
	$count = 0;
	
	$excludes = array( 'blogname' , 'blogdescription' );
	
	foreach($options as $option){
			
		if(isset($option['id'])){ 
			$count++;
			$option_id = $option['id'];
			$option_type = $option['type'];
			
			//Skip assigned id's
			if(in_array($option_id,$excludes)) { continue; }
			
			if($count > 1){ $query_inner .= ' OR '; }
			if($option_type == 'multicheck'){
				$multicount = 0;
				foreach($option['options'] as $option_key => $option_option){
					$multicount++;
					if($multicount > 1){ $query_inner .= ' OR '; }
					$query_inner .= "option_name = '" . $option_id . "_" . $option_key . "'";
					
				}
				
			} else if(is_array($option_type)) {
				$type_array_count = 0;
				foreach($option_type as $inner_option){
					$type_array_count++;
					$option_id = $inner_option['id'];
					if($type_array_count > 1){ $query_inner .= ' OR '; }
					$query_inner .= "option_name = '$option_id'";
				}
				
			} else {
				$query_inner .= "option_name = '$option_id'";
			}
		}
			
	}
	
	//When Theme Options page is reset - Add the rt_options option
	if($page == 'rockableframework'){
		$query_inner .= " OR option_name = 'rt_options'";
	}
	
	//echo $query_inner;
	
	$query = "DELETE FROM $wpdb->options WHERE $query_inner";
	$wpdb->query($query);
		
}



/*##########################################################################################
Panel
##########################################################################################*/
function rockableframework_options_page(){
    $options =  get_option('rt_template');      
    $themename =  get_option('rt_themename');
	$theme_version =  get_option('rt_themeversion');
?>

<div class="wrap" id="rt_container">
  <div id="rt-popup-save" class="rt-save-popup">
    <div class="rt-save-save"><?php esc_html_e('Options Updated', 'rt')?></div>
  </div>
  <div id="rt-popup-reset" class="rt-save-popup">
    <div class="rt-save-reset"><?php esc_html_e('Options Reseted', 'rt')?></div>
  </div>
  
  
  
  
  <form action="" enctype="multipart/form-data" id="ofform">

    <div id="logo-area">
     <div id="logo-area-pt1"></div><!--end pt1-->
     
     <div id="logo-area-pt2">
       <h1><img src="<?php echo RT_DIRECTORY; ?>/admin/images/admin_logo4.png" /></h1>
      <div id="logo-mask">
       <h5><span><?php esc_html_e('Theme Name:', 'rt')?></span> <?php echo $themename ?>  <span style="margin:0 0 0 2px;">- <?php esc_html_e('Theme Version:', 'rt')?></span> <?php echo $theme_version ?></h5>
      </div><!--end logo-mask-->
     </div><!--end pt2-->
       
     <div id="logo-area-pt3"></div><!--end pt3-->
    </div><!--end logo-area-->
  
    <div id="header">
      <div id="header-part1"></div><!--end part1-->
      
      <div id="header-part2">
           <div class="whois">
              <span class="whoispt1"></span>
                  <span class="whoispt2">
                     G'day <?php { $user = wp_get_current_user(); $link = $user->display_name; echo apply_filters('loginout', $link); } ?>
                  </span><!--whoispt2-->
              <span class="whoispt3"></span>
           </div><!--end who is-->
           
           <p class="slide"><a href="#" class="btn-slide" title="More"></a></p>
       </div><!--end part 2-->
       
      <div id="header-part3"></div><!--end part3-->
    </div><!--end header-->
    
    
    <div id="panel-slide">
         <div class="panel-data">
                  <div class="support">
                     <img src="<?php echo RT_DIRECTORY; ?>/admin/images/support.png" />
                     <a href="http://rockablethemes.com/support/" target="_blank"><?php esc_html_e('Support Forum', 'rt')?></a>
                  </div><!--end support-->
                  
                  <div class="doccs">
                     <img src="<?php echo RT_DIRECTORY; ?>/admin/images/Documents.png" />
                     <a href="http://rockablethemes.com/updates/themes/euphoria/Euphoria Magazine - Documentation.pdf" target="_blank"><?php esc_html_e('Theme Docs', 'rt')?></a>
                  </div><!--end docs-->
                  
                  <div class="changelog">
                     <img src="<?php echo RT_DIRECTORY; ?>/admin/images/changelog.png" />
                     <a href="http://www.rockablethemes.com/updates/themes/euphoria/euphoria-changelog.rtf" target="_blank"><?php esc_html_e('View Changelog', 'rt')?></a>
                  </div><!--end changelog-->
                  
                  <div class="affiliates">
                     <img src="<?php echo RT_DIRECTORY; ?>/admin/images/affiliates.png" />
                     <a href="http://rockablethemes.com/affiliates/" class="earn" title="30% on every sale" target="_blank"><?php esc_html_e('Earn with us', 'rt')?></a>
                  </div><!--end affiliates-->

                  
         </div><!--end panel-data-->
    </div><!--end panel-slide-->
    
    
    
    <div class="header-pt2"></div>
    
    <?php $return = rockableframework_machine($options); ?>
    
    <div id="main">
    <div class="second-tab">
    
    </div><!--end second-tab-->
    
      <div id="rt-nav">
        <ul>
          <div class="border-top"></div>
          <?php echo $return[1] ?>
          <div class="border-bottom"></div>
        </ul>
      </div>
      <div id="content"> <?php echo $return[0]; /* Settings */ ?> </div>
      <div class="clear"></div>
    </div>

<div class="save_bar_top">
    <div class="divider-save"></div>

    <div class="save-bar-wrapper">
    <input type="submit" value="Update Options" class="button-primary" />
    <span class="ajax-loading-img ajax-loading-img-bottom"><span class="procesing"><?php esc_html_e('Procesing', 'rt')?></span></span>
    <div style="display:inline" >
		<span class="submit-footer-reset">
		<input name="reset" type="button" value="Reset Options" class="button submit-button reset-button" id="reset-trigger"/>
		</span>
    </div>
  </div><!--end save-bar-wrapper-->
</div><!--end save_bar_top-->
<div style="clear:both;"></div>
<div class="save-bar-footer">
</div><!--end save-bar-footer-->
<?php  if (!empty($update_message)) echo $update_message; ?>



<div style="clear:both;"></div>
  </form>
  <script type="text/javascript">
	jQuery(function(){
		jQuery("#reset-trigger").click(function(){
			if(confirm('Click OK to reset. Any settings will be lost!')){
				jQuery("#reset").click();
			}
			return false;
		});
	});
  </script>
  <form action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" method="post" style="display:none" id="ofform-reset">
    <span class="submit-footer-reset">
    <input name="reset" type="submit" value="Reset Options" id="reset" />
    <input type="hidden" name="rt_save" value="reset" />
    </span>
  </form>
</div>

<div class="main-footer">
   <h5>Rockable Panel Version 2.0</h5>
</div><!--end main-footer-->
<!--wrap-->
<?php
}




/*##########################################################################################
Load required javascripts
##########################################################################################*/
function rt_load_only() {
	add_action('admin_head', 'rt_admin_head');
	wp_enqueue_script('jquery-ui-core');
	wp_register_script('jquery-input-mask', RT_DIRECTORY.'/admin/js/jquery.maskedinput-1.2.2.js', array( 'jquery' ));
	wp_enqueue_script('jquery-input-mask');
	
	function rt_admin_head() { 
		echo '<link rel="stylesheet" type="text/css" href="'.RT_DIRECTORY.'/admin/admin-style.css" media="screen" />';
?>

<script type="text/javascript" src="<?php echo RT_DIRECTORY; ?>/admin/js/ajaxupload.js"></script>
<script type="text/javascript" src="<?php echo RT_DIRECTORY; ?>/admin/js/jquery-ui-custom.js"></script>
<script type="text/javascript" src="<?php echo RT_DIRECTORY; ?>/admin/js/jquery.tipTip.js"></script>
<script type="text/javascript">
jQuery(function(){
 				jQuery("#rt_container").before("<div id='percent-loaded'></div><div id='loading-bar'></div>");
				jQuery("#loading-bar").progressbar({value:1}).find('.ui-progressbar-value').addClass('ui-corner-all');
				
				var cache = [];
					  <?php
						  $img_dir = '../wp-content' . array_pop(explode('wp-content',RT_DIRECTORY)) . '/admin/images';
						  $imgs = scandir($img_dir);
						  $js_string = "var imgs = [";
						  foreach( $imgs as $img){
							  if ( preg_match('/.jpg|.png|.gif$/',$img) ){
								  $js_string .= "'" . $img . "',";
							  }
						  }
						  $js_string .= "''];";
						  echo $js_string;
					  ?>
 				imgs.pop();
				var imgNo = imgs.length;
				var imgsLoaded = 0;
				var cached = [];
				var steps = 500/imgNo;
				var seconds = [new Date().getSeconds()*1000 + new Date().getMilliseconds()];
				var n = 0, c = 0;
				
				jQuery.loadImage = function(src){
					if(src && imgs.join().indexOf(src) < 0){ return false; }
					imgsLoaded += 1;
					seconds[imgsLoaded] = new Date().getSeconds()*1000 + new Date().getMilliseconds();
					speed = (seconds[imgsLoaded] - seconds[imgsLoaded-1] < 50) ? 20 : seconds[imgsLoaded] - seconds[imgsLoaded-1];
					speed = (seconds[imgsLoaded] - seconds[imgsLoaded-1] > 600) ? 600 : speed;
					if(jQuery.browser.opera && navigator.userAgent.split('/').pop() < 11){speed = 'slow';}
					var width = (imgsLoaded*steps > 500) ? '500' : Math.floor(imgsLoaded*steps);
 					jQuery(".ui-progressbar-value").animate({width: width},speed,function(){
						jQuery("#percent-loaded").text(Math.floor((width/500)*100)+'%');
						if(jQuery(this).width() > 495){
						  jQuery("#percent-loaded").fadeOut('fast');
						  jQuery("#loading-bar").fadeOut('fast',function(){
							jQuery("#rt_container").hide().css('margin-left','0').fadeIn('slow');
						  });
						}
					});
					
				}
				jQuery.checkCache = function(currentImg, index){
					if(currentImg.width > 0 || currentImg.complete){
						jQuery.loadImage();
						imgs[index] = 'loaded';
					}
				}
				
  				for(var index = 0; index < imgNo; index++){
 					var currentImg = new Image();
					currentImg.onload = function(){
						jQuery.loadImage(this.src.split('/').pop());
					}
					currentImg.src = "<?php echo RT_DIRECTORY; ?>/admin/images/"+imgs[imgsLoaded];
					jQuery.checkCache(currentImg,index);
					cached[index] = currentImg;
				}
				
});

		
			jQuery(document).ready(function(){
				jQuery(".btn-slide").click(function(){
					jQuery("#panel-slide").slideToggle("400");
					jQuery(this).toggleClass("active-slide"); return false;
				});
			});
			
			
			jQuery(document).ready(function(){
			  jQuery(".btn-slide").tipTip({maxWidth: "auto", edgeOffset: 10, defaultPosition: "left" });
			  });
			  
			jQuery(document).ready(function(){
			  jQuery(".earn").tipTip({maxWidth: "auto", edgeOffset: 10, defaultPosition: "top" });
			  });
			
			
			jQuery(document).ready(function(){
			
			var flip = 0;
				
			jQuery('#expand_options').click(function(){
				if(flip == 0){
					flip = 1;
					jQuery('#rt_container #rt-nav').hide();
					jQuery('#rt_container #content').width(755);
					jQuery('#rt_container .group').add('#rt_container .group h2').show();
	
					jQuery(this).text('[-]');
					
				} else {
					flip = 0;
					jQuery('#rt_container #rt-nav').show();
					jQuery('#rt_container #content').width(595);
					jQuery('#rt_container .group').add('#rt_container .group h2').hide();
					jQuery('#rt_container .group:first').show();
					jQuery('#rt_container #rt-nav li').removeClass('current');
					jQuery('#rt_container #rt-nav li:first').addClass('current');
					
					jQuery(this).text('[+]');
				
				}
			
			});
			
				jQuery('.group').hide();
				jQuery('.group:first').fadeIn();
				
				jQuery('.group .collapsed').each(function(){
					jQuery(this).find('input:checked').parent().parent().parent().nextAll().each( 
						function(){
           					if (jQuery(this).hasClass('last')) {
           						jQuery(this).removeClass('hidden');
           						return false;
           					}
           					jQuery(this).filter('.hidden').removeClass('hidden');
           				});
           		});
           					
				jQuery('.group .collapsed input:checkbox').click(unhideHidden);
				
				function unhideHidden(){
					if (jQuery(this).attr('checked')) {
						jQuery(this).parent().parent().parent().nextAll().removeClass('hidden');
					}
					else {
						jQuery(this).parent().parent().parent().nextAll().each( 
							function(){
           						if (jQuery(this).filter('.last').length) {
           							jQuery(this).addClass('hidden');
									return false;
           						}
           						jQuery(this).addClass('hidden');
           					});
           					
					}
				}
				
				jQuery('.rt-radio-img-img').click(function(){
					jQuery(this).parent().parent().find('.rt-radio-img-img').removeClass('rt-radio-img-selected');
					jQuery(this).addClass('rt-radio-img-selected');
					
				});
				jQuery('.rt-radio-img-label').hide();
				jQuery('.rt-radio-img-img').show();
				jQuery('.rt-radio-img-radio').hide();
				jQuery('#rt-nav li:first').addClass('current');
				jQuery('#rt-nav li a').click(function(evt){
				
						jQuery('#rt-nav li').removeClass('current');
						jQuery(this).parent().addClass('current');
						
						var clicked_group = jQuery(this).attr('href');
		 
						jQuery('.group').hide();
						
						jQuery(clicked_group).fadeIn();
		
						evt.preventDefault();
						
					});
				
				if('<?php if(isset($_REQUEST['reset'])) { echo $_REQUEST['reset'];} else { echo 'false';} ?>' == 'true'){
					
					var reset_popup = jQuery('#rt-popup-reset');
					reset_popup.fadeIn();
					window.setTimeout(function(){
						   reset_popup.fadeOut();                        
						}, 2000);
						//alert(response);
					
				}
					
			//Update Message popup
			jQuery.fn.center = function () {
				this.animate({"top":( jQuery(window).height() - this.height() - 200 ) / 2+jQuery(window).scrollTop() + "px"},100);
				this.css("left", 250 );
				return this;
			}
		
			
			jQuery('#rt-popup-save').center();
			jQuery('#rt-popup-reset').center();
			jQuery(window).scroll(function() { 
			
				jQuery('#rt-popup-save').center();
				jQuery('#rt-popup-reset').center();
			
			});
			
	
				
			//AJAX Upload
			
			jQuery( '.image_upload_button').each(function(){
			
			var clickedObject = jQuery(this);
var clickedID = jQuery(this).attr( 'id' );
new AjaxUpload(clickedObject, {
				  action: '<?php echo admin_url( "admin-ajax.php" ); ?>',
				  name: clickedID, // File upload name
				  data: { // Additional data to send
						action: 'rt_ajax_post_action',
						type: 'upload',
						data: clickedID },
				  autoSubmit: true, // Submit file after selection
				  responseType: false,
				  onChange: function(file, extension){},
				  onSubmit: function(file, extension){
						
						this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
						
				  },
				  onComplete: function(file, response) {
				   
					
					
					this.enable(); // enable upload button
						var buildReturn = '<img class="hide rt-option-image" id="image_'+clickedID+'" src="'+response+'" alt="" />';

						jQuery( ".upload-error").remove();
						jQuery( "#image_" + clickedID).remove();	
						jQuery('.img-container_'+ clickedID).append(buildReturn);
						jQuery( 'img#image_'+clickedID).fadeIn();
						jQuery( '.img-container_'+ clickedID).children('span').fadeIn();
						clickedObject.parent().prev( 'input').val(response);
				  }
				});
			
			});
			
			//AJAX Remove (clear option value)
			jQuery( '.image_reset_button').click(function(){
			
					var clickedObject = jQuery(this);
					var clickedID = jQuery(this).attr( 'id' );
					var theID = jQuery(this).attr( 'title' );	
	
					var ajax_url = '<?php echo admin_url( "admin-ajax.php" ); ?>';
				
					var data = {
						action: 'rt_ajax_post_action',
						type: 'image_reset',
						data: theID
					};
					
					jQuery.post(ajax_url, data, function(response) {
						var image_to_remove = jQuery( '#image_' + theID);
						var button_to_hide = jQuery( '#reset_' + theID);
						image_to_remove.fadeOut(500,function(){ jQuery(this).remove(); });
						button_to_hide.fadeOut();
						jQuery('#' + theID + '_upload').val( '' );
						
						
						
					});
					
					return false; 
					
				});
				
				
				
				
				
				
				
				
				
				
				 	
			
			//Save everything else
			jQuery('#ofform').submit(function(){
				
					function newValues() {
					  var serializedValues = jQuery("#ofform").serialize();
					  return serializedValues;
					}
					jQuery(":checkbox, :radio").click(newValues);
					jQuery("select").change(newValues);
					jQuery('.ajax-loading-img').fadeIn();
					var serializedReturn = newValues();
					 
					var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
				
					 //var data = {data : serializedReturn};
					var data = {
						<?php if(isset($_REQUEST['page']) && $_REQUEST['page'] == 'rockableframework'){ ?>
						type: 'options',
						<?php } ?>

						action: 'rt_ajax_post_action',
						data: serializedReturn
					};
					
					jQuery.post(ajax_url, data, function(response) {
						var success = jQuery('#rt-popup-save');
						var loading = jQuery('.ajax-loading-img');
						loading.fadeOut();  
						success.fadeIn();
						window.setTimeout(function(){
						   success.fadeOut(); 
						   
												
						}, 2000);
					});
					
					return false; 
					
				});   	 	
				
				
				jQuery(".group").has('.rt-tab').each(function(){
					groupID = jQuery(this).attr('id');
					jQuery(this).
						prepend("<div class='tabNav tabnav-" +groupID+ "'></div>").
						children(".rt-tab").each(function(i){
							jQuery('.tabnav-'+groupID).append("<span class='tabControl tab-"+i+"'><span><small>" +jQuery(this).attr('title')+ "</small></span></span>");
						});
				});
				jQuery(".tabControl").click(function(){
					var tabIndex = jQuery(this).attr('class').split('-')[1].split(' ')[0];
					var tabs = jQuery(this).parent().siblings('.rt-tab');
					jQuery(this).addClass('activeTab').siblings().removeClass('activeTab');
					tabs.fadeOut(0).eq(tabIndex).fadeIn();
				});
				jQuery('#rt-nav li a').click(function(){	
					var group = jQuery('#' + jQuery(this).attr('href').split('#')[1]);
					group.find(".rt-tab").hide().filter(":first").show();
					group.find('.tabControl').removeClass('activeTab').filter('.tab-0').addClass('activeTab');
				}).eq(0).click();
				
				jQuery(".tabNav").append("<div style='clear:both;'></div>");
				jQuery('.tabNav').nextAll('.rt-tab').fadeOut(0);
				jQuery('.tabControl:eq(0)').click();
				
				jQuery(".controls").has("input:checkbox").width(357).next(".explain").width(200);
				jQuery(".controls input:checkbox").hide().each(function(){jQuery(this).after("<label class='switch' for='" +jQuery(this).attr('name')+ "'></label");});
				jQuery(".controls input:checkbox:checked + .switch").addClass('on');
				jQuery(".switch").click(function(){
					var state = (jQuery(this).hasClass('on'))? ' on' : '';
					jQuery(this).append("<span class='switch"+state+"'></span>").toggleClass('on');
					jQuery('span.switch').fadeOut('fast',function(){jQuery(this).remove();});
				});
				
				
				jQuery(".controls select").each(function(){
					var currentSelect = jQuery(this);
										currentSelect.hide();

					currentSelect.after('<div class="select-mask"><span class="selected">' +currentSelect.val()+ '</span><div class="options-wrapper"></div>');
					currentSelect.children('option').each(function(){
                    currentSelect.next('.select-mask').find('.options-wrapper').append('<span class="option">'+jQuery(this).text()+'</span>');
                   });
                      currentSelect.next('.select-mask').find('.option:contains('+currentSelect.val()+'):first').hide();
				});				
				jQuery(".select-mask").click(function(event){
					jQuery('.options-wrapper').not(jQuery(this).find('.options-wrapper')).hide();
					jQuery(this).find('.options-wrapper').css('z-index','1000').slideToggle(250,function(){ jQuery(this).filter(":hidden").css('z-index','999'); });
					event.stopPropagation();
				});
				jQuery(".select-mask").find('.option').click(function(e){
					var selectEl = jQuery(this).parents('.select-mask').prev('select');
					selectEl.val(jQuery(this).text());
					jQuery(this).parents('.select-mask').find('.selected').text(jQuery(this).text());
					jQuery(this).hide().siblings().show();
					if(jQuery(this).parents('.select-tab').size() < 1){
						jQuery('.select-tab[id*='+ selectEl.attr('title') +'-]').fadeOut(300).filter("#"+selectEl.attr('title')+'-'+selectEl.val()).delay(300).fadeIn('slow');
					}
				});			
				
				jQuery("body").click(function(){
					jQuery(".options-wrapper").hide();
				});
				
				jQuery(".select-tab").hide();
				jQuery("#rt_container select").each(function(){
					jQuery("#"+jQuery(this).attr('title')+'-'+jQuery(this).val()).show();
				});
				
			});
			

			
		</script>
<?php }
}


/*##########################################################################################
Save Action
##########################################################################################*/
add_action('wp_ajax_rt_ajax_post_action', 'rt_ajax_callback');

function rt_ajax_callback() {
	global $wpdb; // this is how you get access to the database
		
	$save_type = $_POST['type'];
	//Uploads
	if($save_type == 'upload'){
		
		$clickedID = $_POST['data']; // Acts as the name
		$filename = $_FILES[$clickedID];
       	$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 
		
		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';    
		$uploaded_file = wp_handle_upload($filename,$override);
		 
				$upload_tracking[] = $clickedID;
				update_option( $clickedID , $uploaded_file['url'] );
				
		 if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }	
		 else { echo $uploaded_file['url']; } // Is the Response
	}
	elseif($save_type == 'image_reset'){
			
			$id = $_POST['data']; // Acts as the name
			global $wpdb;
			$query = "DELETE FROM $wpdb->options WHERE option_name LIKE '$id'";
			$wpdb->query($query);
	
	}	
	elseif ($save_type == 'options' OR $save_type == 'framework') {
		$data = $_POST['data'];
		
		parse_str($data,$output);
		//print_r($output);
		
		//Pull options
        	$options = get_option('rt_template');
		
		foreach($options as $option_array){

			$id = $option_array['id'];
			$old_value = get_option($id);
			$new_value = '';
			
			if(isset($output[$id])){
				$new_value = $output[$option_array['id']];
			}
	
			if(isset($option_array['id'])) { // Non - Headings...

			
					$type = $option_array['type'];
					
					if ( is_array($type)){
						foreach($type as $array){
							if($array['type'] == 'text'){
								$id = $array['id'];
								$std = $array['std'];
								$new_value = $output[$id];
								if($new_value == ''){ $new_value = $std; }
								update_option( $id, stripslashes($new_value));
							}
						}                 
					}
					elseif($new_value == '' && $type == 'checkbox'){ // Checkbox Save
						
						update_option($id,'false');
					}
					elseif ($new_value == 'true' && $type == 'checkbox'){ // Checkbox Save
						
						update_option($id,'true');
					}
					elseif($type == 'multicheck'){ // Multi Check Save
						
						$option_options = $option_array['options'];
						
						foreach ($option_options as $options_id => $options_value){
							
							$multicheck_id = $id . "_" . $options_id;
							
							if(!isset($output[$multicheck_id])){
							  update_option($multicheck_id,'false');
							}
							else{
							   update_option($multicheck_id,'true'); 
							}
						}
					} 
					
					elseif($type != 'upload_min'){
					
						update_option($id,stripslashes($new_value));
					}
				}
			}	
	
	}

  die();

}



/*##########################################################################################
Generates The Options Within the Panel
##########################################################################################*/
function rockableframework_machine($options) {
        
    $counter = 0;
	$menu = '';
	$output = '';
	foreach ($options as $value) {
	   
		$counter++;
		$val = '';
		//Start Heading
		 if ( $value['type'] != "heading" && $value['type'] != "tab" && $value['type'] != "select-tab" && $value['type'] != "close-select-tabs" ) {
		 	$class = ''; if(isset( $value['class'] )) { $class = $value['class']; }
			//$output .= '<div class="section section-'. $value['type'] .'">'."\n".'<div class="option-inner">'."\n";
			if($openSTab && $value['type'] == "select" && !$value['inside-tab']){ $output .= '</div><!--end select tab-->'."\n"; $openSTab = $openInnerSTab = false; }
			$output .= '<div class="section section-'.$value['type'].' '. $class .'">'."\n";
			$output .= '<h3 class="heading">'. $value['name'] .'</h3>'."\n";
			$output .= '<div class="option">'."\n" . '<div class="controls">'."\n";
		 } 
		 //End Heading
		$select_value = '';                                   
		switch ( $value['type'] ) {
		
		case 'text':
			$val = $value['std'];
			$std = get_option($value['id']);
			if ( $std != "") { $val = $std; }
			$output .= '<input class="rt-input" name="'. $value['id'] .'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $val .'" />';
		break;
		
		case 'select':

			$output .= '<select class="rt-input" name="'. $value['id'] .'" id="'. $value['id'] .'" title="'. $value['id2'] .'">';
		
			$select_value = get_option($value['id']);
			 
			foreach ($value['options'] as $option) {
				
				$selected = '';
				
				 if($select_value != '') {
					 if ( $select_value == $option) { $selected = ' selected="selected"';} 
			     } else {
					 if ( isset($value['std']) )
						 if ($value['std'] == $option) { $selected = ' selected="selected"'; }
				 }
				  
				 $output .= '<option'. $selected .'>';
				 $output .= $option;
				 $output .= '</option>';
			 
			 } 
			 $output .= '</select>';

			
		break;
		case 'select2':

			$output .= '<select class="rt-input" name="'. $value['id'] .'" id="'. $value['id'] .'">';
		
			$select_value = get_option($value['id']);
			 
			foreach ($value['options'] as $option => $name) {
				
				$selected = '';
				
				 if($select_value != '') {
					 if ( $select_value == $option) { $selected = ' selected="selected"';} 
			     } else {
					 if ( isset($value['std']) )
						 if ($value['std'] == $option) { $selected = ' selected="selected"'; }
				 }
				  
				 $output .= '<option'. $selected .' value="'.$option.'">';
				 $output .= $name;
				 $output .= '</option>';
			 
			 } 
			 $output .= '</select>';

			
		break;
		case 'textarea':
			
			$cols = '8';
			$ta_value = '';
			
			if(isset($value['std'])) {
				
				$ta_value = $value['std']; 
				
				if(isset($value['options'])){
					$ta_options = $value['options'];
					if(isset($ta_options['cols'])){
					$cols = $ta_options['cols'];
					} else { $cols = '8'; }
				}
				
			}
				$std = get_option($value['id']);
				if( $std != "") { $ta_value = stripslashes( $std ); }
				$output .= '<textarea class="rt-input" name="'. $value['id'] .'" id="'. $value['id'] .'" cols="'. $cols .'" rows="8">'.$ta_value.'</textarea>';
			
			
		break;
		case "radio":
			
			 $select_value = get_option( $value['id']);
				   
			 foreach ($value['options'] as $key => $option) 
			 { 

				 $checked = '';
				   if($select_value != '') {
						if ( $select_value == $key) { $checked = ' checked'; } 
				   } else {
					if ($value['std'] == $key) { $checked = ' checked'; }
				   }
				$output .= '<input class="rt-input rt-radio" type="radio" name="'. $value['id'] .'" value="'. $key .'" '. $checked .' />' . $option .'<br />';
			
			}
			 
		break;
		case "checkbox": 
		
		   $std = $value['std'];  
		   
		   $saved_std = get_option($value['id']);
		   
		   $checked = '';
			
			if(!empty($saved_std)) {
				if($saved_std == 'true') {
				$checked = 'checked="checked"';
				}
				else{
				   $checked = '';
				}
			}
			elseif( $std == 'true') {
			   $checked = 'checked="checked"';
			}
			else {
				$checked = '';
			}
			$output .= '<input type="checkbox" class="checkbox rt-input" name="'.  $value['id'] .'" id="'. $value['id'] .'" value="true" '. $checked .' />';

		break;
		case "multicheck":
		
			$std =  $value['std'];         
			
			foreach ($value['options'] as $key => $option) {
											 
			$rt_key = $value['id'] . '_' . $key;
			$saved_std = get_option($rt_key);
					
			if(!empty($saved_std)) 
			{ 
				  if($saved_std == 'true'){
					 $checked = 'checked="checked"';  
				  } 
				  else{
					  $checked = '';     
				  }    
			} 
			elseif( $std == $key) {
			   $checked = 'checked="checked"';
			}
			else {
				$checked = '';                                                                                    }
			$output .= '<input type="checkbox" class="checkbox rt-input" name="'. $rt_key .'" id="'. $rt_key .'" value="true" '. $checked .' /><label for="'. $rt_key .'">'. $option .'</label><br />';
										
			}
		break;
		case "upload":
			
			$output .= rockableframework_uploader_function($value['id'],$value['std'],null);
			
		break;
		case "upload_min":
			
			$output .= rockableframework_uploader_function($value['id'],$value['std'],'min');
			
		break;
		
		
		case "divider":
		    $output .= '<div class="divider">'; 
			$output .= '</div>';
		break;
		
		case "images":
			$i = 0;
			$select_value = get_option( $value['id']);
				   
			foreach ($value['options'] as $key => $option) 
			 { 
			 $i++;

				 $checked = '';
				 $selected = '';
				   if($select_value != '') {
						if ( $select_value == $key) { $checked = ' checked'; $selected = 'rt-radio-img-selected'; } 
				    } else {
						if ($value['std'] == $key) { $checked = ' checked'; $selected = 'rt-radio-img-selected'; }
						elseif ($i == 1  && !isset($select_value)) { $checked = ' checked'; $selected = 'rt-radio-img-selected'; }
						elseif ($i == 1  && $value['std'] == '') { $checked = ' checked'; $selected = 'rt-radio-img-selected'; }
						else { $checked = ''; }
					}	
				
				$output .= '<span>';
				$output .= '<input type="radio" id="rt-radio-img-' . $value['id'] . $i . '" class="checkbox rt-radio-img-radio" value="'.$key.'" name="'. $value['id'].'" '.$checked.' />';
				$output .= '<div class="rt-radio-img-label">'. $key .'</div>';
				$output .= '<img src="'.$option.'" alt="" class="rt-radio-img-img '. $selected .'" onClick="document.getElementById(\'rt-radio-img-'. $value['id'] . $i.'\').checked = true;" />';
				$output .= '</span>';
				
			}
		
		break; 
		
		case "info":
			$default = $value['std'];
			$output .= $default;
		break;                                
		
		case "heading":
			
			if($openTab){
			   $output .= '</div>'."\n";
			}
			if($openSTab){
			   $output .= '</div>'."\n";
				$openInnerSTab = $openSTab = false;
			}
			if($counter >= 2){
			   $output .= '</div>'."\n";
			}
			$openTab = false;
			$openInnerTab = false;
			$jquery_click_hook = ereg_replace("[^A-Za-z0-9]", "", strtolower($value['name']) );
			$jquery_click_hook = "rt-option-" . $jquery_click_hook;
			$name = (isset( $value['icon'] ))? '<img src="' .RT_DIRECTORY. '/admin/images/' .$value['icon']. '" alt="' .$value['name']. '"/><span>' .$value['name']. '</span>' : $value['name'];
			$menu .= '<li><a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'">'. $name . '</a></li>';
			
			
			$output .= '<div class="group" id="'. $jquery_click_hook  .'"><h2>'.$value['name'].'</h2>'."\n";
		break;                                    
		
		case "tab":			
			if($openInnerTab){
			   $output .= '</div>'."\n";
				if($openSTab){
					$output .= '</div>'."\n";
					$openInnerSTab = $openSTab = false;
				}
			}
			else{
				$openInnerTab = true;
			}
			$output .= '<div class="rt-tab" title="' .$value['name']. '" id="tab-'. $jquery_click_hook . '-' . $counter  .'">';
			$openTab = true;
		break;
		
		case "select-tab":			
			if($openInnerSTab){
			   $output .= '</div>'."\n";
			}
			else{
				$openInnerSTab = true;
			}
			$output .= '<div class="select-tab" id="' .$value['select-id']. '-' .$value['option']. '">';
			$openSTab = true;
		break;
		
		case "close-select-tabs":
			$output .= '</div>'."\n";
			$openSTab = $openInnerSTab = false;
		break;
 		
		} 
		
		// if TYPE is an array, formatted into smaller inputs... ie smaller values
		if ( is_array($value['type'])) {
			foreach($value['type'] as $array){
			
					$id = $array['id']; 
					$std = $array['std'];
					$saved_std = get_option($id);
					if($saved_std != $std){$std = $saved_std;} 
					$meta = $array['meta'];
					
					if($array['type'] == 'text') { // Only text at this point
						 
						 $output .= '<input class="input-text-small rt-input" name="'. $id .'" id="'. $id .'" type="text" value="'. $std .'" />';  
						 $output .= '<span class="meta-two">'.$meta.'</span>';
					}
				}
		}
		if ( $value['type'] != "heading" && $value['type'] != "tab" && $value['type'] != "select-tab"  && $value['type'] != "close-select-tabs" ) { 
			if ( $value['type'] != "checkbox" ) 
				{ 
				$output .= '<br/>';
				}
			if(!isset($value['desc'])){ $explain_value = ''; } else{ $explain_value = $value['desc']; } 
			$output .= '</div><div class="explain">'. $explain_value .'</div>'."\n";
			$output .= '<div class="clear"> </div></div></div>'."\n";
			}
	   
	}
    $output .= '</div>'; 
    return array($output,$menu);

}






/*##########################################################################################
Uploader
##########################################################################################*/
function rockableframework_uploader_function($id,$std,$mod){

    
	$uploader = '';
    $upload = get_option($id);
	
	if($mod != 'min') { 
			$val = $std;
            if ( get_option( $id ) != "") { $val = get_option($id); }
            $uploader .= '<input class="rt-input2" name="'. $id .'" id="'. $id .'_upload" type="text" value="'. $val .'" />';
	}
	$uploader .= '<div class="upload_button_div">';
	
	$uploader .= '<span class="button image_upload_button" id="'.$id.'"><span class="updateb"><h6>Upload</h6></span></span>';
	
	
	
	$uploader .='</div>' . "\n";
	
	
	
	if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}
	
	
	$uploader .= '<div class="clear"></div>' . "\n";
	
	
    $uploader .= '<div id="img-reset" class="img-container_'. $id .'">';
	
	$uploader .= '<span class="button image_reset_button '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';
	
	if(!empty($upload)){
    	$uploader .= '<img class="rt-option-image" id="image_'.$id.'" src="'.$upload.'" alt="" />';
		}
		
		
		
	$uploader .= '</div>';


return $uploader;
}



/*##########################################################################################
Add default options after activation
##########################################################################################*/
if (is_admin() && (isset($_GET['activated'] ) && $pagenow == "themes.php") || (isset($_GET['reset']) && $pagenow == "admin.php") ) {
	//Call action that sets
	add_action('wp_loaded','rt_option_setup');
}

function rt_option_setup(){

	//Update EMPTY options
	$rt_array = array();
	add_option('rt_options',$rt_array);

	$template = get_option('rt_template');
	$saved_options = get_option('rt_options');
	
	foreach($template as $option) {
		if($option['type'] != 'heading'){
			$id = $option['id'];
			$std = $option['std'];
			$db_option = get_option($id);
			if(empty($db_option)){
				if(is_array($option['type'])) {
					foreach($option['type'] as $child){
						$c_id = $child['id'];
						$c_std = $child['std'];
						update_option($c_id,$c_std);
						$rt_array[$c_id] = $c_std; 
					}
				} else {
					update_option($id,$std);
					$rt_array[$id] = $std;
				}
			}
			else { //So just store the old values over again.
				$rt_array[$id] = $db_option;
			}
		}
	}
	update_option('rt_options',$rt_array);
}


/*##########################################################################################
Add Favicon
##########################################################################################*/
function theme_favicon() {
		$shortname =  get_option('rt_shortname'); 
		if (get_option($shortname . '_custom_favicon') != '') {
	        echo '<link rel="shortcut icon" href="'.  get_option('rt_custom_favicon')  .'"/>'."\n";
	    }
		else { ?>
			<link rel="shortcut icon" href="<?php echo bloginfo('stylesheet_directory') ?>/admin/images/favicon.ico" />
<?php }
}


add_action('wp_head', 'theme_favicon');

?>
