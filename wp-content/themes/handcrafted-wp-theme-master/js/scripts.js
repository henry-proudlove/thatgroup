

jQuery.fn.ajaxLink = function(){
	$(this).click(function(e){
		e.preventDefault();
		console.log('FIRE');
		target = $(this).attr('href');
		$.ajax({
			url: target,
			data: {},
			beforeSend: function(){
				$('body').append('<p class="loader">Loading</p>');
			},
			success: function (data) {
				html = $(data).find('#primary');
				$('#main').children().addClass('outgoing').parent().append(html);
				bodyclass = $(data).find('#main').attr('data');
				$('body').removeClass().addClass(bodyclass);				
				$('.outgoing').on('webkitTransitionEnd oTransitionEnd transitionend msTransitionEnd', function() {
					$(this).remove();
					$('#primary').removeClass('incoming');
				})
			},
			complete: function(){
				$('.loader').remove();
			},
			dataType: 'html'
		});
	});
};

$(document).ready(function(){
	
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
				content.addClass('active');
				$.ajax({
					url: target,
					data: {},
					beforeSend: function(){
						 $('body').append('<p class="loader">Loading</p>');
				   },
					success: function (data) {
						content.append($(data).find('#load'));
						$('.ajax-link').unbind('click').ajaxLink();
					},
					complete: function(){
						$('.loader').remove();
					},
					dataType: 'html'
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

