/*-----------------------------------------------------------------------------------

 	Custom JS - All front-end jQuery
 
-----------------------------------------------------------------------------------*/
 
jQuery(document).ready(function() {
	
	function portfolio_quicksand() {
		
		// Setting Up Our Variables
		var $filter;
		var $container;
		var $containerClone;
		var $filterLink;
		var $filteredItems
		
		// Set Our Filter
		$filter = $('.filter li.active a').attr('class');
		
		// Set Our Filter Link
		$filterLink = $('.filter li a');
		
		// Set Our Container
		$container = $('ul.galery');
		
		// Clone Our Container
		$containerClone = $.containerClone = $container.clone();
		
		// Apply our Quicksand to work on a click function
		// for each for the filter li link elements
		$filterLink.click(function(e) 
		{

		// Clone Our Container
		
			// Remove the active class
			$('.filter li').removeClass('active');
			$containerClone = $.containerClone;
			
			// Split each of the filter elements and override our filter
			//$filter = $.data(this,'value');
			$filter = $(this).attr('data-value');
			
			// Apply the 'active' class to the clicked link
			$(this).parent().addClass('active');
			// If 'all' is selected, display all elements
			// else output all items referenced to the data-type
			
			if ($filter == 'all') {
				$filteredItems = $containerClone.find('li'); 
			}
			else {
				$filteredItems = $containerClone.find('li[data-type~=' + $filter + ']'); 
			}

			// Finally call the Quicksand function
			$container.quicksand($filteredItems, 
			{
				// The Duration for animation
				duration: 750,
				// the easing effect when animation
				easing: 'easeInOutCirc',
				// height adjustment becomes dynamic
				adjustHeight: 'dynamic'
			});
			
			//Initalize our PrettyPhoto Script When Filtered
			$container.quicksand($filteredItems, 
				function () { lightbox(); }
			);	
			e.preventDefault();		
		});
	}
		
	if(jQuery().quicksand) {
		portfolio_quicksand();	
	}
		
	function lightbox() {
		// Apply PrettyPhoto to find the relation with our portfolio item
		$("a[rel^='prettyPhoto']").prettyPhoto({
			// Parameters for PrettyPhoto styling
			animationSpeed:'fast',
			slideshow:5000,
			theme:'pp_default',
			show_title:false,
			overlay_gallery: false,
			social_tools: false
		});
	}
	
	if(jQuery().prettyPhoto) {
		lightbox();
	}

	
}); // END OF DOCUMENT