<?php
/**
 * Theme Short-code Functions
 */

//************************************* Button 

function webtreats_button( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'color'     => '',
        'link'      => '',
        'text'      => '',
        'icon'      => '',
        'target'    => '_self',
        'size'      => '',
    ), $atts));

	$out = "<span id='button_id'><a target=\"".$target."\" class=\"button_rt button_link_".$color." button_size_".$size."\" href=\"" .$link. "\"><span><small class=\"first_small ".$icon."\"></small><small id='second_small'>" .do_shortcode($content). "</small></span></a></span>";
    
    return $out;
}
add_shortcode('button', 'webtreats_button');

//************************************* InfoBox 

function webtreats_infoBox( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'text'      => '',
        'color'     => '',
        'width'      => '100%',
        'border'     => '',
        'icon'      => '',
    ), $atts));

	$out = "<div id='infoBox_id' class='infoBox_rt infoBox_color_".$color."' style='width:".$width."'><div class=\"".$icon." infoBox_text\">" .do_shortcode($content). "</div></div>";
    
    return $out;
}
add_shortcode('infoBox', 'webtreats_infoBox');

//************************************* Toggle Content 

function toggle_func( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'title'      => '',
        'text'      => '',
		'color'     => '',
        'display'      => '',
    ), $atts));

    $out .= '<div id="toggle_shortcode" class="toggle toggle_color_'.$color.'">';
	$out .= '<h2 class="slidetoggle"><a href="#">' .$title. '</a></h2>';
	$out .= '<div class="toggle-content" style="'.$display.'">';
	$out .= '<div class="block">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	$out .= '</div>';
    $out .= '</div>';

   return $out;
}
add_shortcode('toggle', 'toggle_func');

//************************************* Columns Shortcodes
@ini_set('pcre.backtrack_limit', 500000);

if ( !function_exists('webtreats_formatter') ) :
function webtreats_formatter($content) {
	$new_content = '';
	
	/* Matches the contents and the open and closing tags */
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	
	/* Matches just the contents */
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	
	/* Divide content into pieces */
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
	
	/* Loop over pieces */
	foreach ($pieces as $piece) {
		/* Look for presence of the shortcode */
		if (preg_match($pattern_contents, $piece, $matches)) {
			
			/* Append to content (no formatting) */
			$new_content .= $matches[1];
		} else {
			
			/* Format and append to content */
			$new_content .= wptexturize(wpautop($piece));		
		}
	}
	
	return $new_content;
}

// Remove the 2 main auto-formatters
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

// Before displaying for viewing, apply this function
add_filter('the_content', 'webtreats_formatter', 99);
add_filter('widget_text', 'webtreats_formatter', 99);

endif;
 
function webtreats_one_third( $atts, $content = null ) {
   return '<div id="column" class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'webtreats_one_third');

function webtreats_one_third_last( $atts, $content = null ) {
   return '<div id="column" class="one_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_third_last', 'webtreats_one_third_last');

function webtreats_two_third( $atts, $content = null ) {
   return '<div id="column" class="two_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'webtreats_two_third');

function webtreats_two_third_last( $atts, $content = null ) {
   return '<div id="column" class="two_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_third_last', 'webtreats_two_third_last');

function webtreats_one_half( $atts, $content = null ) {
   return '<div id="column" class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'webtreats_one_half');

function webtreats_one_half_last( $atts, $content = null ) {
   return '<div id="column" class="one_half last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_half_last', 'webtreats_one_half_last');

function webtreats_one_fourth( $atts, $content = null ) {
   return '<div id="column" class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'webtreats_one_fourth');

function webtreats_one_fourth_last( $atts, $content = null ) {
   return '<div id="column" class="one_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_fourth_last', 'webtreats_one_fourth_last');

function webtreats_two_fourth( $atts, $content = null ) {
   return '<div id="column" class="two_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fourth', 'webtreats_two_fourth');

function webtreats_two_fourth_last( $atts, $content = null ) {
   return '<div id="column" class="two_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_fourth_last', 'webtreats_two_fourth_last');

function webtreats_three_fourth( $atts, $content = null ) {
   return '<div id="column" class="three_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'webtreats_three_fourth');

function webtreats_three_fourth_last( $atts, $content = null ) {
   return '<div id="column" class="three_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('three_fourth_last', 'webtreats_three_fourth_last');

function webtreats_one_fifth( $atts, $content = null ) {
   return '<div id="column" class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'webtreats_one_fifth');

function webtreats_one_fifth_last( $atts, $content = null ) {
   return '<div id="column" class="one_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_fifth_last', 'webtreats_one_fifth_last');

function webtreats_two_fifth( $atts, $content = null ) {
   return '<div id="column" class="two_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'webtreats_two_fifth');

function webtreats_two_fifth_last( $atts, $content = null ) {
   return '<div id="column" class="two_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_fifth_last', 'webtreats_two_fifth_last');

function webtreats_three_fifth( $atts, $content = null ) {
   return '<div id="column" class="three_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'webtreats_three_fifth');

function webtreats_three_fifth_last( $atts, $content = null ) {
   return '<div id="column" class="three_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('three_fifth_last', 'webtreats_three_fifth_last');

function webtreats_four_fifth( $atts, $content = null ) {
   return '<div id="column" class="four_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'webtreats_four_fifth');

function webtreats_four_fifth_last( $atts, $content = null ) {
   return '<div id="column" class="four_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('four_fifth_last', 'webtreats_four_fifth_last');

function webtreats_one_sixth( $atts, $content = null ) {
   return '<div id="column" class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'webtreats_one_sixth');

function webtreats_one_sixth_last( $atts, $content = null ) {
   return '<div id="column" class="one_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_sixth_last', 'webtreats_one_sixth_last');

function webtreats_two_sixth( $atts, $content = null ) {
   return '<div id="column" class="two_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_sixth', 'webtreats_two_sixth');

function webtreats_two_sixth_last( $atts, $content = null ) {
   return '<div id="column" class="two_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_sixth_last', 'webtreats_two_sixth_last');

function webtreats_three_sixth( $atts, $content = null ) {
   return '<div id="column" class="three_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_sixth', 'webtreats_three_sixth');

function webtreats_three_sixth_last( $atts, $content = null ) {
   return '<div id="column" class="three_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('three_sixth_last', 'webtreats_three_sixth_last');

function webtreats_four_sixth( $atts, $content = null ) {
   return '<div id="column" class="four_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_sixth', 'webtreats_four_sixth');

function webtreats_four_sixth_last( $atts, $content = null ) {
   return '<div id="column" class="four_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('four_sixth_last', 'webtreats_four_sixth_last');

function webtreats_five_sixth( $atts, $content = null ) {
   return '<div id="column" class="five_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'webtreats_five_sixth');

function webtreats_five_sixth_last( $atts, $content = null ) {
   return '<div id="column" class="five_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('five_sixth_last', 'webtreats_five_sixth_last');

//************************************************Tab Shortcode***************************************************************

function concat($text){
    $expl = explode(" ",$text); 
    if(is_array($expl)){ 
        foreach($expl as $key => $value){  
          if($key==0){$concat = $value;}
           else $concat = $concat.'_'.$value;  
        }}
        return $concat;}

function etdc_tab_group( $atts, $content ){
$GLOBALS['tab_count'] = 0;

do_shortcode( $content );

if( is_array( $GLOBALS['tabs'] ) ){
foreach( $GLOBALS['tabs'] as $tab ){
$title = concat($tab['title']);
$tabs[] = '<li><a href="'.$title.'">'.$tab['title'].'</a></li>';
$panes[] = '<div id="'.$title.'id'.'" class="tab-shortcodes">'.do_shortcode($tab['content']).'</div>';
}
$return = "\n".'<!-- the tabs --><ul class="tabs-sel">'.implode( "\n", $tabs ).'</ul>'."\n".'<div style="clear:both;">'."\n".'</div><!-- tab "panes" --><div class="tab-div">'.implode( "\n", $panes ).'</div>'."\n";
$GLOBALS['tabs']=array();
}
return $return;
}

add_shortcode( 'tabgroup', 'etdc_tab_group' );


function etdc_tab( $atts, $content ){
extract(shortcode_atts(array(
'title' => 'Tab %d',
), $atts));

$x = $GLOBALS['tab_count'];
$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );

$GLOBALS['tab_count']++;
}

add_shortcode( 'tab', 'etdc_tab' );

?>