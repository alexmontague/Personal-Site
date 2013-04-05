(function() {
	
	
	tinymce.create('tinymce.plugins.rockable_shortcodes', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {

			ed.addCommand('mceRockable_shortcodes', function() {
				ed.windowManager.open({
					file : url + '/window_post.php',
					width : 600,
					height : 440,
					inline : 1
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});

			// Register example button
			ed.addButton('rockable_shortcodes', {
				title : 'Shortcodes',
				cmd : 'mceRockable_shortcodes',
				image : url + '/shortcodes.png'
			});

		
		},


	});

	// Register plugin
	tinymce.PluginManager.add('rockable_shortcodes', tinymce.plugins.rockable_shortcodes);
})();


