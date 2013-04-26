jQuery.fn.ajaxLink = function(){
	$(this).click(function(e){
		e.preventDefault();
		target = $(this).attr('href');
		target += ' #primary';
		console.log(target);
		$('#main').load(target);
	});
};

$(document).ready(function(){
	
	// Global loader
	$("body").on({
		ajaxStart: function() { 
			$(this).append('<p class="loader">Loading</p>');
		},
		ajaxStop: function() { 
			$('.loader').remove();
			$('.ajax-link').ajaxLink();
		}    
	});
	
	//Validate contact form
	$("#contactform").validate({
		rules: {
			select: "required" }
	});
	
	// Load in posts of each section on nav item roll
	
	$('#utility .nav-holder:not(:first)').hover(
		function(){
			var content = $(this).find('.nav-content');
			if (content.is(':empty')){
				var target = $(this).find('.nav-link').attr('href');
				target += ' #load';
				content.addClass('active').load(target, function() {
				});
			}else{
				content.addClass('active').children();
			}
		}, 
		function(){
			$(this).find('.nav-content').removeClass('active');
		}	
	);
	
	$('.nav-link:not(:first)').click(function(e){
		e.preventDefault();
	});
	$('.nav-link:first').ajaxLink();
});

