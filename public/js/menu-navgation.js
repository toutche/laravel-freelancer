$(document).ready(function() {
  	 	

/* the Responsive menu script */
 	$('body').addClass('js');
		  var $menu = $('#menu'),
		  	  $menulink = $('.menu-link'),
		  	  $menuTrigger = $('.has-subnav > a');
		
	$menulink.click(function(e) {
			e.preventDefault();
			$menulink.toggleClass('active');
			$menu.toggleClass('active');
	});

	var add_toggle_links = function() {	
	 	if ($('.menu-link').is(":visible")) {
				$('.has-subnav').click(function(e) {		
					var $this = $(this);
					$this.toggleClass('active').find('ul').toggleClass('active');
				});	 	
		} else {
			$('.toggle-link').empty();
		}
	 }
	add_toggle_links();
	$(window).bind("resize", add_toggle_links);	
		
});