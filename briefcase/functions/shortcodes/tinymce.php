<?php
class add_webtreats_button {
	
	var $pluginname = 'rockable_shortcodes';

	
	function add_webtreats_button()  {
		
		// Set path to editor_plugin.js
		$this->path = get_template_directory_uri() . '/functions/shortcodes/';	
		
		
        // init process for button control
		add_action('init', array (&$this, 'addbuttons') );
	}
	
	function addbuttons() {
	
		// Don't bother doing this stuff if the current user lacks permissions
		if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) 
			return;
		
		// Add only in Rich Editor mode
		if ( get_user_option('rich_editing') == 'true') {
		 
			$svr_uri = $_SERVER['REQUEST_URI'];
			if ( strstr($svr_uri, 'post.php') || strstr($svr_uri, 'post-new.php') || strstr($svr_uri, 'page.php') || strstr($svr_uri, 'page-new.php')  ) {
				add_filter("mce_external_plugins", array (&$this, 'add_tinymce_plugin' ), 5);
				add_filter('mce_buttons', array (&$this, 'register_button' ), 5);
			
			}
		}
	}
	
	function register_button($buttons) {
	
		array_push($buttons, 'separator', $this->pluginname );
	
		return $buttons;
	}
	
	function add_tinymce_plugin($plugin_array) {
		$svr_uri = $_SERVER['REQUEST_URI'];
		if ( strstr($svr_uri, 'post.php') || strstr($svr_uri, 'post-new.php' )) {
			$plugin_array[$this->pluginname] =  $this->path . 'editor_plugin_post.js';
		}
		if ( strstr($svr_uri, 'page.php') || strstr($svr_uri, 'page-new.php')) {
			$plugin_array[$this->pluginname] =  $this->path . 'editor_plugin_page.js';
		}
		
		return $plugin_array;
	}
	
	
}

$tinymce_button = new add_webtreats_button ();

?>