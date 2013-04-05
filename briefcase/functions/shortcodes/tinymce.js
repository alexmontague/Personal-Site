function insertWebtreatsLink() {
	
	var tagtext;
	
	var infoBox = document.getElementById('infoBox_panel');
	var button = document.getElementById('button_panel');
    var column = document.getElementById('column_panel');
    var tab = document.getElementById('tab_group_panel');
    var toggle = document.getElementById('toggle_panel');
	
	// who is active ?
	if (infoBox.className.indexOf('current') != -1) {
	    tagtext = "[infoBox"
		var text = document.getElementById('text_infoBox').value;
        var color = document.getElementById('color_infoBox').value;
        var width = document.getElementById('width_infoBox').value;
        var icon = document.getElementById('icon_infobox').value;
        
        if (color != 0 && color == 'blue' ){
			tagtext+=" color=\""+ color +"\""	
		}
        if (color != 0 && color== 'red' ){
			tagtext+=" color=\""+ color +"\""
		}
        if (color != 0 && color == 'orange' ){
			tagtext+=" color=\""+ color +"\""	
		}
        if (color != 0 && color== 'yellow' ){
			tagtext+=" color=\""+ color +"\""
		}
        if (color != 0 && color == 'green' ){
			tagtext+=" color=\""+ color +"\""	
		}
        if (color != 0 && color== 'gray' ){
			tagtext+=" color=\""+ color +"\""
		}
		if (color != 0 && color== 'brown' ){
			tagtext+=" color=\""+ color +"\""
		}
		if (icon != 0 && icon  == 'ico-tick' ){
			tagtext+=" icon=\""+ icon +"\""	
		}
        if (icon != 0 && icon== 'ico-alert' ){
			tagtext+=" icon=\""+ icon +"\""
		}
        if (icon != 0 && icon== 'ico-download' ){
			tagtext+=" icon=\""+ icon +"\""
		}
        if (icon != 0 && icon== 'ico-info' ){
			tagtext+=" icon=\""+ icon +"\""
		}
        if (icon != 0 && icon== 'ico-note' ){
			tagtext+=" icon=\""+ icon +"\""
		}
        if (icon != 0 && icon== 'ico-star' ){
			tagtext+=" icon=\""+ icon +"\""
		}
        if (icon != 0 && icon== 'ico-search' ){
			tagtext+=" icon=\""+ icon +"\""
		}
        if (icon != 0 && icon== 'ico-heart' ){
			tagtext+=" icon=\""+ icon +"\""
		}
        if (icon != 0 && icon== 'none' ){
			tagtext+=" icon=\""+ icon +"\""
		}
        if (width != 0){
			tagtext+=" width=\""+ width +"px\""
		}
        if (text != 0){
			tagtext+="]"+ text +"[/infoBox] ";	
		}
       	if ( text == 0){
			tinyMCEPopup.close();
		}
	}

	if (button.className.indexOf('current') != -1) {
	   tagtext = "[button"	
        var link = document.getElementById('link_shortcode').value;
		var color = document.getElementById('color_shortcode').value;
        var text = document.getElementById('text_shortcode').value;
        var target = document.getElementById('target_shortcode').value;
        var size = document.getElementById('size_shortcode').value;
        var icon = document.getElementById('icon_shortcode').value;
        
        if (link != 0){
			tagtext+=" link=\""+ link +"\""	
		}
        if (target != 0 && target == '_self' ){
			tagtext+=" target=\""+ target +"\""	
		}
        if (target != 0 && target== '_blank' ){
			tagtext+=" target=\""+ target +"\""
		}
        if (color != 0 && color == 'green' ){
			tagtext+=" color=\""+ color +"\""	
		}
        if (color != 0 && color == 'orange' ){
			tagtext+=" color=\""+ color +"\""	
		}
        if (color != 0 && color== 'blue' ){
			tagtext+=" color=\""+ color +"\""
		}
         if (color != 0 && color == 'black' ){
			tagtext+=" color=\""+ color +"\""	
		}
        if (color != 0 && color == 'red' ){
			tagtext+=" color=\""+ color +"\""	
		}
        if (color != 0 && color== 'yellow' ){
			tagtext+=" color=\""+ color +"\""
		}
        if (size != 0 && size== 'small' ){
			tagtext+=" size=\""+ size +"\""	
		}
        if (size != 0 && size== 'normal' ){
			tagtext+=" size=\""+ size +"\""
		}
        if (size != 0 && size== 'big' ){
			tagtext+=" size=\""+ size +"\""
		}
        if (icon != 0 && icon  == 'ico-tick' ){
			tagtext+=" icon=\""+ icon +"\""	
		}
        if (icon != 0 && icon== 'ico-alert' ){
			tagtext+=" icon=\""+ icon +"\""
		}
        if (icon != 0 && icon== 'ico-download' ){
			tagtext+=" icon=\""+ icon +"\""
		}
        if (icon != 0 && icon== 'ico-info' ){
			tagtext+=" icon=\""+ icon +"\""
		}
        if (icon != 0 && icon== 'ico-note' ){
			tagtext+=" icon=\""+ icon +"\""
		}
        if (icon != 0 && icon== 'none' ){
			tagtext+=" icon=\""+ icon +"\""
		}
        if (text != 0){
			tagtext+="]"+ text +"[/button]";	
		}
        if ( link == 0 || color == 0 ){
			tinyMCEPopup.close();
		}
	}
	
    if (column.className.indexOf('current') != -1) {
    var childInput = document.getElementById('column_preview').childNodes; 
    for(var i=0; i<childInput.length; i++){
        if(i==0){tagtext=""}    
        var name = childInput[i].name;
        if(name!=" " && i!=childInput.length-1){
        tagtext+="\n["+name+"][/"+name+"]"}
        if(i==childInput.length-1){
        var name2 = childInput[i].name;
        tagtext+="\n["+name2+"_last][/"+name2+"_last]";
        }
    }}
    
    	if (tab.className.indexOf('current') != -1) {
	   tagtext = "[tabgroup]"	
        var title = document.getElementById('tab_table').getElementsByTagName('input');
        var childTab = document.getElementById('tab_table').getElementsByTagName('textarea');
        var j=0;
        for(var i=0;i<title.length;i++){
        if(title[i].type=='text'){
        if (title != 0){
			tagtext+="\n[tab title=\""+ title[i].value +"\"]"	
		}
        if (childTab[j].value != 0){
			tagtext+= childTab[j].value +"[/tab]" 	
		} j++; }
        if ( title == 0 && text == 0 ){
			tinyMCEPopup.close();
		}}
        tagtext += "\n[/tabgroup] ";
	}
    
    if (toggle.className.indexOf('current') != -1) {
        var title = document.getElementById('toggle_title').value;
        var text = document.getElementById('text_toggle').value;
        var display = document.getElementById('toggle_display').value;
		var color = document.getElementById('color_toggle').value;
	   tagtext = "[toggle"
        if (color != 0 && color== 'red' ){
			tagtext+=" color=\""+ color +"\""
		}
        if (color != 0 && color == 'orange' ){
			tagtext+=" color=\""+ color +"\""	
		}
        if (color != 0 && color== 'yellow' ){
			tagtext+=" color=\""+ color +"\""
		}
        if (color != 0 && color == 'green' ){
			tagtext+=" color=\""+ color +"\""	
		}
        if (color != 0 && color== 'gray' ){
			tagtext+=" color=\""+ color +"\""
		}
		if (color != 0 && color== 'brown' ){
			tagtext+=" color=\""+ color +"\""
		}
	    if (color != 0 && color == 'blue' ){
			tagtext+=" color=\""+ color +"\""	
		}
	    if (color != 0 && color == 'nocolor' ){
			tagtext+=" color=\""+ color +"\""	
		}	
		
        if (title != 0){
			tagtext+=" title=\""+ title +"\""	
		}
        if (display != 0 && display== 'display:none' ){
			tagtext+=" display=\""+ display +"\""
		}
        if (display != 0 && display== '' ){
			tagtext+=" display=\""+ display +"\""
		}
        if (text != 0){
			tagtext+="]"+ text +"[/toggle] ";	
		}
        if ( title == 0 && text==0){
			tinyMCEPopup.close();
		}
	}
    
	if(window.tinyMCE) {
		//TODO: For QTranslate we should use here 'qtrans_textarea_content' instead 'content'
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
}
