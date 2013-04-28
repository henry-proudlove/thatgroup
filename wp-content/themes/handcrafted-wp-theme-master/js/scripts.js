jQuery.fn.ajaxLink = function(){
	$(this).click(function(e){
		e.preventDefault();
		target = $(this).attr('href');
		$.ajax({
			url: target,
			data: {},
			beforeSend: function(){
				$('body').append('<p class="loader">Loading</p>');
				$('#nav-below').addClass('hidden');
			},
			success: function (data) {
				if(target == siteURL + '/'){
					pageTrans(data , '-home');
				}else{
					pageTrans(data , '');
				}
			},
			complete: function(){
				$('.loader').remove();
			},
			dataType: 'html'
		});
	});
};

jQuery.fn.cycleInit = function(){
	if(this.children().size() > 1){	
		$(this).addClass('cycle').after('<nav id="pager">').cycle({
			pager:  '#pager'
		});
	}
};

function pageTrans(data , home){
	$('#main')
		.children()
		.addClass('outgoing' + home)
		.parent()
		.append($(data).find('#primary').addClass('incoming' + home));
	$('body')
		.removeClass()
		.addClass($(data).find('#main').attr('data'));
	$('.outgoing' + home)
		.on('webkitTransitionEnd oTransitionEnd transitionend msTransitionEnd', function() {
			$(this).remove();
			$('#primary').removeClass('incoming' + home);
			setTimeout(function() {
				  $('#carousel-images').cycleInit();
			}, 1000);
			$('#nav-below').removeClass('hidden');
	})
}

$(document).ready(function(){
	
	$('#carousel-images').cycleInit();
	
	$('#nav-container')
		.addClass('home')
		.clone()
		.removeClass('home')
		.addClass('drop up')
		.appendTo('#utility');
	$("#contactform").validate({
		rules: {
		select: "required" }
	});
	
	// Load in posts of each section on nav item roll
	
	$('.nav-holder:not(:first-child)').hover(
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
						$('a[href*="' + siteURL + '"]').unbind('click').ajaxLink();
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
	$('a[href*="' + siteURL + '"]').ajaxLink();
	
	$('.nav-title').hover(function(){
		$('#nav-container.drop').removeClass('up').addClass('down');
	});
	
	$('#nav-container.drop').mouseleave(function(){
		$(this).removeClass('down').addClass('up');
	});
});

