<?php
$column_num = array(
        "0"=>"choose one",
		"2"=>"2 Columns", 
		"3"=>"3 Columns", 
        "4"=>"4 Columns", 
		"5"=>"5 Columns",
        "6"=>"6 Columns",
	);

$color_infoBox = array( 
        "yellow"=>"Yellow",
        "blue"=>"Blue",
        "red"=>"Red", 
		"green"=>"Green", 
        "orange"=>"Orange",
		"gray"=>"Gray",
		"brown"=>"Brown",
	);
	
$color_toggle = array( 
        "yellow"=>"Yellow",
        "blue"=>"Blue",
        "red"=>"Red", 
		"green"=>"Green", 
        "orange"=>"Orange",
		"gray"=>"Gray",
		"brown"=>"Brown",
		"nocolor"=>"No Color",
	);

$color = array(
        "blue"=>"Blue", 
		"green"=>"Green", 
        "orange"=>"Orange",
        "black"=>"Black", 
		"red"=>"Red", 
        "yellow"=>"Yellow",
	);

$target = array(
		"_self"=>"no", 
		"_blank"=>"yes", 
	);
    
$display = array(
		"display:none"=>"no", 
		"yes"=>"yes", 
	);

$size = array(
        "normal"=>"Normal",
		"small"=>"Small",  
        "big"=>"Big",
	);

$icon = array(
        "none"=>"No Icon", 
		"ico-tick"=>"Tick", 
		"ico-alert"=>"Alert", 
        "ico-download"=>"Download",
        "ico-info"=>"Info",
        "ico-note"=>"Note",
        "ico-star"=>"Star",
        "ico-heart"=>"Heart",
        "ico-search"=>"Search",
	);

// Bootstrap file for getting the ABSPATH constant to wp-load.php
require_once('config.php');

// check for rights
if ( !is_user_logged_in() || !current_user_can('edit_posts') ) 
	wp_die(__("You are not allowed to be here"));
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo 'Rockable Themes Shortcodes'; ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
	<script type="text/javascript" src="<?php echo get_template_directory_uri()?>/includes/javascripts/jquery1.5.2.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/functions/shortcodes/tinymce.js"></script>
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/shortcodes.css" type="text/css" media="screen, projection"/>
	<base target="_self" />
</head>
<body>
	<form name="rockable_form" action="#">
	<div class="tabs">
		<ul>
            <li id="button_tab" class="current"><span><a href="javascript:mcTabs.displayTab('button_tab','button_panel');" onMouseDown="return false;"><?php echo 'Button'; ?></a></span></li>
			<li id="infoBox_tab"><span><a href="javascript:mcTabs.displayTab('infoBox_tab','infoBox_panel');" onMouseDown="return false;"><?php echo 'Info Boxes'; ?></a></span></li>
			<li id="column_tab"><span><a href="javascript:mcTabs.displayTab('column_tab','column_panel');" onMouseDown="return false;"><?php echo 'Columns'; ?></a></span></li>
            <li id="toggle_tab"><span><a href="javascript:mcTabs.displayTab('toggle_tab','toggle_panel');" onMouseDown="return false;"><?php echo 'Toggle Content'; ?></a></span></li>
            <!--<li id="tab_group_tab"><span><a href="javascript:mcTabs.displayTab('tab_group_tab','tab_group_panel');" onMouseDown="return false;"><?php // echo 'Tabs'; ?></a></span></li>-->
        </ul>
	</div>	
	<div class="panel_wrapper" style="height:350px;">
	
    		<!-- button_panel -->
		<div id="button_panel" class="panel current">
		<fieldset>
			<legend>Customize your Button</legend>
		<table border="0" cellpadding="4" cellspacing="0">
        </tr>
          <tr>
            <td nowrap="nowrap"><label for="link_shortcode">Insert button link:</label></td>
            <td>
			<input type="text" id="link_shortcode" value="#" size="37" maxlength="60" />
            </td>
          </tr>
         <tr>
            <td nowrap="nowrap"><label for="color_shortcode">Select Button Color:</label></td>
            <td><select id="color_shortcode" name="color_shortcode" style="width: 200px">
				<?php
				if(is_array($color)) {
					foreach ($color as $color_key => $color_sc_value) {
							echo '<option value="' . $color_key . '" >' . $color_sc_value . '</option>' . "\n";
					}
				}
				?>
            </select></td>
          </tr>
           <tr>
            <td nowrap="nowrap"><label for="text_shortcode">Button text:</label></td>
            <td>
			<input type="text" id="text_shortcode" value="Read More" size="37" maxlength="60" />
            </td>
          </tr>
           <tr>
            <td nowrap="nowrap"><label for="target_shortcode">Open in a new window?</label></td>
            <td><select id="target_shortcode" name="target_shortcode" style="width: 200px">
				<?php
				if(is_array($target)) {
					foreach ($target as $target_key => $target_sc_value) {
							echo '<option value="' . $target_key . '" >' . $target_sc_value . '</option>' . "\n";
					}
				}
				?>
            </select></td>
          </tr>
           <tr>
            <td nowrap="nowrap"><label for="size_shortcode">Button Size:</label></td>
            <td><select id="size_shortcode" name="size_shortcode" style="width: 200px">
				<?php
				if(is_array($size)) {
					foreach ($size as $size_key => $size_sc_value) {
							echo '<option value="' . $size_key . '" >' . $size_sc_value . '</option>' . "\n";
					}
				}
				?>
            </select></td>
          </tr>
           <tr>
            <td nowrap="nowrap"><label for="icon_shortcode">Button Icon:</label></td>
            <td><select id="icon_shortcode" name="icon_shortcode" style="width: 200px">
				<?php
				if(is_array($icon)) {
					foreach ($icon as $icon_key => $icon_sc_value) {
							echo '<option value="' . $icon_key . '" >' . $icon_sc_value . '</option>' . "\n";
					}
				}
				?>
            </select></td>
          </tr>
        </table>
		</fieldset>
        
        
        <fieldset>
		<legend>Button Preview</legend>
        <div id="button_preview" style="width:100%; margin-top: 10px; margin-bottom: 10px;">
        
                    <div id='button_id' style="margin-left:auto;">
                        <a href=""><span id="span_preview"><small id="small_preview"></small><small id="second_small" style="font-size: 12px;"></small></span></a>
                        <div style="clear:both;"></div>
                     </div><!--end button_id-->
                     
           <div style="clear:both;"></div>
        </div><!--end button_preview-->
        </fieldset>
        </div><!-- button_panel -->
    
    	<!-- infoBox_panel -->
		<div id="infoBox_panel" class="panel">
		<fieldset>
			<legend>Customize your InfoBox</legend>
		<table border="0" cellpadding="4" cellspacing="0">
           
          <tr>
            <td nowrap="nowrap"><label for="color_infoBox">Select InfoBox Color:</label></td>
            <td><select id="color_infoBox" name="color_infoBox" style="width: 200px">
				<?php
				if(is_array($color_infoBox)) {
					foreach ($color_infoBox as $color_key => $color_sc_value) {
							echo '<option value="' . $color_key . '" >' . $color_sc_value . '</option>' . "\n";
					}
				}
				?>
            </select></td>
          </tr>
          <tr>
            <td nowrap="nowrap"><label for="width_infoBox">InfoBox Width in pixels:</label></td>
            <td>
			<input type="text" id="width_infoBox" value="" size="37" maxlength="60"/><div class="" style="float:right;">(Blank = 100% width)</div>
            </td>
          </tr>
           <tr>
            <td nowrap="nowrap"><label for="icon_infobox">InfoBox Icon:</label></td>
            <td><select id="icon_infobox" name="icon_infobox" style="width: 200px">
				<?php
				if(is_array($icon)) {
					foreach ($icon as $icon_key => $icon_sc_value) {
							echo '<option value="' . $icon_key . '" >' . $icon_sc_value . '</option>' . "\n";
					}
				}
				?>
            </select></td>
          </tr>
          <tr>
            <td nowrap="nowrap"><label for="text_infoBox">InfoBox Text:</label></td>
            <td>
            <textarea cols="55" rows="5" id="text_infoBox" style="padding:5px;">Type your text here</textarea>
            </td>
          </tr>
        </table>
		</fieldset>
        <fieldset>
		<legend>InfoBox Preview</legend>
        <div id="infoBox_preview" style="margin-top:10px;">
		<span id='infoBox_id' style="display: inline-block;"><div id="infoBox_span_preview"></div></span>
        </div>
        </fieldset>
        <div class="spacer" style="height: 15px;"></div>
		</div><!-- infoBox_panel -->
		
		<!-- column_panel -->
		<div id="column_panel" class="panel">
        <fieldset style="height: 70px;">
			<legend>Customize your Columns</legend>
		<table border="0" cellpadding="4" cellspacing="0">
        <tr>
            <td nowrap="nowrap"><label for="column_num">Choose the number of columns:</label></td>
            <td><select id="column_num" name="column_num" style="width: 200px">
				<?php
			if(is_array($column_num)) {
					foreach ($column_num as $column_num_key => $column_num_sc_value) {
							echo '<option value="' . $column_num_key . '" >' . $column_num_sc_value . '</option>' . "\n";
					}
				}
				?>
            </select></td>
          </tr>
          </table>
          <div id="column_buttons" style="margin-top: 10px;"></div>
		</fieldset> 
        <fieldset>
		<legend>Column Preview</legend>
         <div id="column_preview" style="height:62px; margin:15px 0 0 0;">
        </div>
        </fieldset>
        <div><input type="button" id="reset_columns" value="Reset Columns" name="reset_button" /></div>
		</div><!-- column_panel -->
        
        <!-- tab_group_panel -->
		<div id="tab_group_panel" class="panel" style="padding:0 0 20px 0;">
        <fieldset>
			<legend>Customize your Tabs</legend>
		  <table border="0" cellpadding="5" cellspacing="0" id="tab_table">
           <tr>
           <td> 
           <input type="text" id="tab_title" value="Tab title here" size="30" maxlength="60" style="float: left; padding:5px;"/>
           <textarea cols="50" rows="5" name="tab_text" style="float: left; margin:0 0 0 15px; padding:5px;" id="tab_text">Type tab text here</textarea>
           <input type="button" value="X" name="del_tab" id="del_tab" alt="Remove" style="width: 16px; height: 16px; float: right; margin-left: 5px; background:url(images/delete.png) no-repeat; border:none; text-indent:-99999px; cursor:pointer;"/>
           </td>
          </tr>
           <tr id="newTab_container">
          </tr>
            <tr class="button_container">
            <td><input type="button" value=" Add New Tab" name="new_tab" id="new_tab" style="height: 16px; background:url(images/add.png) no-repeat; padding:0 0 0 12px; border:none; cursor:pointer;"/></td>
            </tr>
          </table>
		</fieldset> 
		<div class="spacer" style="height: 15px;"></div>
		</div><!-- tab_group_panel -->
        
         <!-- toggle_panel -->
		<div id="toggle_panel" class="panel" style="padding:0 0 20px 0;">
        <fieldset>
			<legend>Toggle Content Options</legend>
		  <table border="0" cellpadding="5" cellspacing="0" id="tab_table">

          <tr>
            <td nowrap="nowrap"><label for="color_infoBox">Toggle Content Color:</label></td>
            <td><select id="color_toggle" name="color_toggle" style="width: 200px">
				<?php
				if(is_array($color_toggle)) {
					foreach ($color_toggle as $color_key => $color_sc_value) {
							echo '<option value="' . $color_key . '" >' . $color_sc_value . '</option>' . "\n";
					}
				}
				?>
            </select></td>
          </tr> 
          
          <td nowrap="nowrap"><label for="toggle_display">Set content open by default?:</label></td>
          <td><select id="toggle_display" name="toggle_display" style="width: 200px">
				<?php
				if(is_array($display)) {
					foreach ($display as $color_key => $color_sc_value) {
							echo '<option value="' . $color_key . '" >' . $color_sc_value . '</option>' . "\n";
					}
				}
				?>
            </select></td>
          
          <tr> 
           <td nowrap="nowrap"><label for="column_num">Toggle Content Title:</label>
           <td>
			<input type="text" id="toggle_title" value="Type title here" size="37" maxlength="60" style="padding-left:3px;"/>
            </td>
           </td>
          </tr>
          <tr>
            <td nowrap="nowrap"><label for="text_toggle">Toggle Content Text:</label></td>
            <td>
            <textarea cols="55" rows="5" id="text_toggle" style="padding:3px 5px 5px 3px;">Type your text here</textarea>
            </td>
          </tr>

          </table>
		</fieldset> 
        <fieldset>
		<legend>Toggle Content Preview</legend>
         <div id="toggle_preview" style="margin:10px 0 10px 0;">
         <div id="toggle_shortcode"><h2 class="slidetoggle"><a href="#" class="tog_prev_a"></a></h2>
         <div class="toggle-content" style="display:none"><div class="block"></div></div>
         </div>
        </div>
        </fieldset>
		<div class="spacer" style="height: 15px;"></div>
		</div><!-- toggle_panel -->
	</div>

	<div class="mceActionPanel">
		<div style="float: left">
			<input type="button" id="cancel" name="cancel" value="<?php echo "Cancel"; ?>" onClick="tinyMCEPopup.close();" />
		</div>

		<div style="float: right">
			<input type="submit" id="insert" name="insert" value="<?php echo "Insert"; ?>" onClick="insertWebtreatsLink();" />
		</div>
	</div>
</form>
</body>

	<script type='text/javascript'>
jQuery(function(){
    chooseColumn();
    jQuery('#reset_columns').click(function(){
    jQuery('#column_preview').html('');
    jQuery("#column_num").val(0);
    jQuery('#column_buttons').html('');
    }); 
});
/************************Column shortcode script********************/ 
function chooseColumn(){  
    jQuery("#column_num").change(function(){
var columns = jQuery("#column_num").val();
var colBut = jQuery("#column_buttons");	
var colPrev = jQuery('#column_preview');
var one_half_prev = '<input type="button" style="width:270px; height:40px; margin-right:2px;" value="1/2" name="one_half"/>';
var one_third_prev = '<input type="button" style="width:180px; height:40px; margin-right:2px;" value="1/3" name="one_third"/>';
var two_third_prev = '<input type="button" style="width:360px; height:40px; margin-right:2px;" value="2/3" name="two_third"/>';
var one_fourth_prev = '<input type="button" style="width:135px; height:40px; margin-right:2px;" value="1/4" name="one_fourth"/>';
var two_fourth_prev = '<input type="button" style="width:270px; height:40px; margin-right:2px;" value="2/4" name="two_fourth"/>';
var three_fourth_prev = '<input type="button" style="width:405px; height:40px; margin-right:2px;" value="3/4" name="three_fourth"/>';	
var one_fifth_prev = '<input type="button" style="width:108px; height:40px; margin-right:2px;" value="1/5" name="one_fifth"/>';	
var two_fifth_prev = '<input type="button" style="width:216px; height:40px; margin-right:2px;" value="2/5" name="two_fifth"/>';	  
var three_fifth_prev = '<input type="button" style="width:324px; height:40px; margin-right:2px;" value="3/5" name="three_fifth"/>';
var four_fifth_prev = '<input type="button" style="width:432px; height:40px; margin-right:2px;" value="4/5" name="four_fifth"/>';
var one_sixth_prev = '<input type="button" style="width:90px; height:40px; margin-right:2px;" value="1/6" name="one_sixth"/>';	
var two_sixth_prev = '<input type="button" style="width:180px; height:40px; margin-right:2px;" value="2/6" name="two_sixth"/>';	  
var three_sixth_prev = '<input type="button" style="width:270px; height:40px; margin-right:2px;" value="3/6" name="three_sixth"/>';
var four_sixth_prev = '<input type="button" style="width:360px; height:40px; margin-right:2px;" value="4/6" name="four_sixth"/>';
var five_sixth_prev = '<input type="button" style="width:450px; height:40px; margin-right:2px;" value="5/6" name="five_sixth"/>';	  	    
jQuery('#column_preview').html('');		
        if(columns==2){
     var i=0;
    colBut.html('<input type="button" value="1/2" name="1/2" id="col_button"/>'); 
    jQuery("#column_buttons input[value='1/2']").click(function(){ 
        colPrev.append(one_half_prev); 
        i++; if(i>=2){$(this).hide();}
        });  
     } 
        if(columns==3){
            var i=0;
    colBut.html('<input type="button" value="1/3" name="1/3" id="col_button"/> <input type="button" value="2/3" name="2/3" id="col_button"/>');
    jQuery("#column_buttons input[value='1/3']").click(function(){ 
        colPrev.append(one_third_prev); 
        i++; if(i>=3){$(this).hide();}
        if(i>=2){jQuery("#column_buttons input[value='2/3']").hide();}
        }); 
    jQuery("#column_buttons input[value='2/3']").click(function(){ 
        colPrev.append(two_third_prev); 
        i+=2; if(i>=2){$(this).hide();}
        if(i>=3){jQuery("#column_buttons input[value='1/3']").hide();}
        });   
     }	
     if(columns==4){
        var i=0;
    colBut.html('<input type="button" value="1/4" name="1/4" id="col_button"/> <input type="button" value="2/4" name="2/4" id="col_button"/> <input type="button" value="3/4" name="3/4" id="col_button"/>');
    jQuery("#column_buttons input[value='1/4']").click(function(){ 
        colPrev.append(one_fourth_prev); 
        i++; if(i>=4){$(this).hide();}
        if(i>=2){jQuery("#column_buttons input[value='3/4']").hide();}
        if(i>=3){jQuery("#column_buttons input[value='2/4']").hide();}
        }); 
    jQuery("#column_buttons input[value='2/4']").click(function(){ 
        colPrev.append(two_fourth_prev); 
        i+=2; if(i>=4){$(this).hide(); jQuery("#column_buttons input[value='1/4']").hide();}
        if(i==3){$(this).hide();}
        if(i>=2){jQuery("#column_buttons input[value='3/4']").hide();}
        }); 
    jQuery("#column_buttons input[value='3/4']").click(function(){ 
        colPrev.append(three_fourth_prev); 
        i+=3; if(i>=3){$(this).hide(); jQuery("#column_buttons input[value='2/4']").hide();}
        if(i==4){jQuery("#column_buttons input[value='1/4']").hide();}
        }); 
     }
     if(columns==5){
        var i=0;
    colBut.html('<input type="button" value="1/5" name="1/5" id="col_button"/> <input type="button" value="2/5" name="2/5" id="col_button"/> <input type="button" value="3/5" name="3/5" id="col_button"/> <input type="button" value="4/5" name="4/5" id="col_button"/>');
    jQuery("#column_buttons input[value='1/5']").click(function(){ 
        colPrev.append(one_fifth_prev); 
        i++; if(i>=5){$(this).hide();}
        if(i>=2){jQuery("#column_buttons input[value='4/5']").hide();}
        if(i>=3){jQuery("#column_buttons input[value='3/5']").hide();}
        if(i>=4){jQuery("#column_buttons input[value='2/5']").hide();}
        }); 
    jQuery("#column_buttons input[value='2/5']").click(function(){ 
        colPrev.append(two_fifth_prev); 
        i+=2; if(i>=4){$(this).hide();}
        if(i>=2){jQuery("#column_buttons input[value='4/5']").hide();}
        if(i>=3){jQuery("#column_buttons input[value='3/5']").hide();}
        if(i>=5){jQuery("#column_buttons input[value='1/5']").hide();}
        }); 
    jQuery("#column_buttons input[value='3/5']").click(function(){ 
        colPrev.append(three_fifth_prev); 
        i+=3; if(i>=3){$(this).hide(); jQuery("#column_buttons input[value='4/5']").hide();}
        if(i>=4){jQuery("#column_buttons input[value='2/5']").hide();}
        if(i>=5){jQuery("#column_buttons input[value='1/5']").hide();}
        }); 
     jQuery("#column_buttons input[value='4/5']").click(function(){ 
        colPrev.append(four_fifth_prev); 
        i+=4; if(i>=4){$(this).hide(); jQuery("#column_buttons input[value='2/5']").hide(); jQuery("#column_buttons input[value='3/5']").hide();}
        if(i>=5){jQuery("#column_buttons input[value='1/5']").hide();}
        });    
     }	
     if(columns==6){
        var i=0;
    colBut.html('<input type="button" value="1/6" name="1/6" id="col_button"/> <input type="button" value="2/6" name="2/6" id="col_button"/> <input type="button" value="3/6" name="3/6" id="col_button"/> <input type="button" value="4/6" name="4/6" id="col_button"/> <input type="button" value="5/6" name="5/6" id="col_button"/>');
      jQuery("#column_buttons input[value='1/6']").click(function(){ 
        colPrev.append(one_sixth_prev); 
        i++; if(i>=6){$(this).hide();}
        if(i>=2){jQuery("#column_buttons input[value='5/6']").hide();}
        if(i>=3){jQuery("#column_buttons input[value='4/6']").hide();}
        if(i>=4){jQuery("#column_buttons input[value='3/6']").hide();}
        if(i>=5){jQuery("#column_buttons input[value='2/6']").hide();}
        }); 
    jQuery("#column_buttons input[value='2/6']").click(function(){ 
        colPrev.append(two_sixth_prev); 
        i+=2; if(i>=5){$(this).hide();}
        jQuery("#column_buttons input[value='5/6']").hide();
        if(i>=3){jQuery("#column_buttons input[value='4/6']").hide();}
        if(i>=4){jQuery("#column_buttons input[value='3/6']").hide();}
        if(i>=6){jQuery("#column_buttons input[value='1/6']").hide();}
        }); 
    jQuery("#column_buttons input[value='3/6']").click(function(){ 
        colPrev.append(three_sixth_prev); 
        i+=3; if(i>=6){$(this).hide(); jQuery("#column_buttons input[value='1/6']").hide();}
        jQuery("#column_buttons input[value='4/6']").hide();
        jQuery("#column_buttons input[value='5/6']").hide();
        if(i>=4){$(this).hide();}
        if(i>=5){jQuery("#column_buttons input[value='2/6']").hide();}
        }); 
     jQuery("#column_buttons input[value='4/6']").click(function(){ 
        colPrev.append(four_sixth_prev); 
        i+=4; if(i>=4){$(this).hide(); jQuery("#column_buttons input[value='5/6']").hide(); jQuery("#column_buttons input[value='3/6']").hide();}
        if(i>=5){jQuery("#column_buttons input[value='2/6']").hide();}
        if(i>=6){jQuery("#column_buttons input[value='1/6']").hide();}
        }); 
     jQuery("#column_buttons input[value='5/6']").click(function(){ 
        colPrev.append(five_sixth_prev); 
        i+=5; if(i>=5){$(this).hide(); jQuery("#column_buttons input[value='4/6']").hide(); jQuery("#column_buttons input[value='3/6']").hide(); jQuery("#column_buttons input[value='2/6']").hide();}
        if(i>=6){jQuery("#column_buttons input[value='1/6']").hide();}
        }); 
     }
     }); 
}
/*************************************************************************/
	jQuery(function(){
		jQuery('#button_panel select').change(function(){
			updateButton();
		});
		updateButton();
	})
	function updateButton(){
		var color = 'button_link_'+jQuery('#color_shortcode').val();
        var size = 'button_size_'+jQuery('#size_shortcode').val();
        var icon =jQuery('#icon_shortcode').val();
		jQuery("#button_preview").find("a").removeClass().addClass("button_rt "+color+" "+size);
        jQuery("#small_preview").removeClass().addClass(icon);
	}
    
    jQuery(function(){
		jQuery('#infoBox_panel select').change(function(){
			updateinfoBox();
		});
		updateinfoBox();
	})
	function updateinfoBox(){
		var color = 'infoBox_color_'+jQuery('#color_infoBox').val();
        var icon =jQuery('#icon_infobox').val();
		jQuery("#infoBox_preview").find("span").removeClass().addClass("infoBox_rt "+color);
        jQuery("#infoBox_preview").find("div").removeClass().addClass(icon+" infoBox_text");
	}
    
    var link = jQuery('#link_shortcode');
    
    link.focus(function(){
    if($(this).val() == $(this).attr('defaultValue')) {
        $(this).val(''); }
})
        link.blur(function() {
            if($(this).val()=='') {
                $(this).val($(this).attr('defaultValue')) }
})
var text = jQuery('#text_shortcode');
    
    text.focus(function(){
    if($(this).val() == $(this).attr('defaultValue')) {
        $(this).val(''); }
})
        text.blur(function() {
            if($(this).val()=='') {
                $(this).val($(this).attr('defaultValue')) }
})

jQuery(function(){
text.change(function(){
jQuery('#second_small').text(
        text.val());
if(text.val()=='') {
jQuery('#second_small').text(text.attr('defaultValue')) }
})
jQuery('#second_small').text(text.attr('defaultValue'))
})

var infoBox = jQuery('#text_infoBox');

jQuery(function(){
infoBox.change(function(){
jQuery('#infoBox_span_preview').text(
        infoBox.val());
if(infoBox.val()=='') {
jQuery('#infoBox_span_preview').text(infoBox.attr('defaultValue')) }
})
jQuery('#infoBox_span_preview').text(infoBox.attr('defaultValue'));
jQuery('.panel_wrapper').css({'height':'350px','overflow':'auto'}).attr('scrollTop', jQuery('.panel_wrapper').attr('scrollHeight'));
})

   infoBox.live('focus', function(event) {
    if($(this).val() == $(this).attr('defaultValue')) {
        $(this).val(''); }
})

   infoBox.live('blur', function(event) {
    if($(this).val() == '') {
        $(this).val($(this).attr('defaultValue')); }
})

var infobox_width = jQuery('#width_infoBox');

   infobox_width.focus(function(){
    if($(this).val() == $(this).attr('defaultValue')) {
        $(this).val(''); }
})
        infobox_width.blur(function() {
            if($(this).val()=='') {
                $(this).val($(this).attr('defaultValue')) }
})

/*******************Tab Scripts*******************/
var tab = '<tr><td style="padding:5px 0 5px 5px;"><input type="text" id="tab_title" value="Tab title here" size="30" maxlength="60" style="float: left; padding:5px;"/><textarea cols="50" rows="5" name="tab_text" style="float:left; margin:0 0 0 15px; padding:5px;" id="tab_text">Type tab text here</textarea><input type="button" value="X" name="del_tab" id="del_tab" style="float: right; margin-left: 5px; background:url(images/delete.png) no-repeat; border:none; text-indent:-99999px; cursor:pointer; width: 16px; height: 16px;"/></td></tr>';

jQuery('#new_tab').click(function(){
    jQuery("#newTab_container").append(tab).children(':last').hide().fadeIn(500);
	jQuery('.panel_wrapper').css({'height':'350px','overflow':'auto'}).attr('scrollTop', jQuery('.panel_wrapper').attr('scrollHeight'));
})



$("#del_tab").live('click', function(event) {
        $(this).parent().parent().fadeOut(400, function(){
            $(this).remove();
        });
})

var tab_title = jQuery('#tab_title');

   tab_title.live('focus', function(event) {
    if($(this).val() == $(this).attr('defaultValue')) {
        $(this).val(''); }
})
        tab_title.live('blur', function(event) {
            if($(this).val()=='') {
                $(this).val($(this).attr('defaultValue')) }
})

var tab_text = jQuery('#tab_text');

   tab_text.live('focus', function(event) {
    if($(this).val() == $(this).attr('defaultValue')) {
        $(this).val(''); }
})
 tab_text.live('blur', function(event) {
    if($(this).val() == '') {
        $(this).val($(this).attr('defaultValue')); }
})
   
/*********************************Toggle Content Scripts************************/
jQuery(function(){
	jQuery('#toggle_panel select').change(function(){
		updatetoggle();
	});
	updatetoggle();
})
function updatetoggle(){
	var color = 'toggle_color_'+jQuery('#color_toggle').val();
	jQuery("#toggle_preview").find("#toggle_shortcode").removeClass().addClass("toggle "+color);
}

var toggle_title = jQuery('#toggle_title');

   toggle_title.live('focus', function(event) {
    if($(this).val() == $(this).attr('defaultValue')) {
        $(this).val(''); }
})
        toggle_title.live('blur', function(event) {
            if($(this).val()=='') {
                $(this).val($(this).attr('defaultValue')) }
})

var toggle_text = jQuery('#text_toggle');

   toggle_text.live('focus', function(event) {
    if($(this).val() == $(this).attr('defaultValue')) {
        $(this).val(''); }
})
 toggle_text.live('blur', function(event) {
    if($(this).val() == '') {
        $(this).val($(this).attr('defaultValue')); }
})

jQuery(function(){  
jQuery('h2.slidetoggle').toggle(function() {
    $(this).parent().find("div:first").slideDown(400);
    $(this).removeClass().addClass("slidetoggle_hide");
    }, function(){
     $(this).parent().find("div:first").slideUp(400);
     $(this).removeClass().addClass("slidetoggle_show");
    });
    jQuery('#toggle_display').change(function(){
        if(jQuery('#toggle_display').val()=='yes'){
    jQuery('#toggle_shortcode h2').removeClass().addClass("slidetoggle_hide");
    jQuery(".toggle-content").slideDown(400);
    }
    else{ jQuery("#toggle_shortcode h2").removeClass().addClass("slidetoggle_show");
    jQuery(".toggle-content").slideUp(400);
    }
    });
    jQuery(".toggle-content:hidden").prev().removeClass().addClass("slidetoggle_show");
});

jQuery(function(){
toggle_text.change(function(){
jQuery('.block').text(
        toggle_text.val());
if(toggle_text.val()=='') {
jQuery('.block').text(toggle_text.attr('defaultValue')) }
})
jQuery('.block').text(toggle_text.attr('defaultValue'));
jQuery('.panel_wrapper').css({'height':'350px','overflow':'auto'}).attr('scrollTop', jQuery('.panel_wrapper').attr('scrollHeight'));
})

jQuery(function(){
toggle_title.change(function(){
jQuery('.tog_prev_a').text(
        toggle_title.val());
if(toggle_title.val()=='') {
jQuery('.tog_prev_a').text(toggle_title.attr('defaultValue')) }
})
jQuery('.tog_prev_a').text(toggle_title.attr('defaultValue'));
})
	</script>
</html>
