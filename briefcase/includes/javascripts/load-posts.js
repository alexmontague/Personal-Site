jQuery(document).ready(function($) {

	// The number of the next page to load (/page/x/).
	var pageNum = parseInt(rt_attr.startPage) + 1;
	
	// The maximum number of pages the current query can return.
	var max = parseInt(rt_attr.maxPages);
	
	// The link of the next page of posts.
	var nextLink = rt_attr.nextLink;
	var ajax_param = (jQuery(".rt_link:last").val().match(/\?/))? "&ajax=true" : "?ajax=true";
    var rt_param = jQuery(".rt_link:last").val()+ajax_param;

	// The link text.
	var linkText = rt_attr.linkText;

	/**
	 * Replace the traditional navigation with our own,
	 * but only if there is at least one page of new posts to load.
	 */
	
	if(pageNum <= max) {
		// Insert the "More Posts" link.
		$('.page-navigation')
			.append('<div class="rt_attr_post_'+ pageNum +'"></div>')
			.append('<p class="text-center" id="rt_more_post"><a href="#" class="button_link rt_pagination">'+linkText+'</a></p>');

		// Remove the traditional navigation.
		$('.navigation').remove();

	}
	
	
	/**
	 * Load new posts when the link is clicked.
	 */
	$('#rt_more_post a').click(function() {

		// Are there more posts to load?
		if(pageNum <= max) {
		
			// Show that we're working.
			$('.rt_link').remove();
			$(this).html('LOADING POSTS <br /><img src="'+rt_themeurl+'/images/loading-bottom.gif" />');

			 $('.rt_attr_post_'+ pageNum).load(rt_param + ' .content-images>div, .section-blog, .rt_link, .galery',
				function() {
					// Update page number and nextLink.
					pageNum++;

					// Add a new placeholder, for when user clicks again.
   					rt_param = jQuery(".rt_link:last").val();
					$('#rt_more_post')
						.before('<div class="rt_attr_post_'+ pageNum +'"></div>');
					
					// Update the button message.
					if(pageNum <= max) {
						$('#rt_more_post a').text('MORE POSTS');
					} else {
						$('#rt_more_post a').text('NO MORE POST TO LOAD');
					}
					
					if($('.content>.galery').length){
						var newItems = $('.rt_attr_post_'+(pageNum-1)+' li');
						$.containerClone.append(newItems);
						$('.filter .all').click();
						$('.rt_attr_post_'+(pageNum-1)).remove();
						
					}
				}
			);
		} else {
            return false;
		}
		return false;
	});
});