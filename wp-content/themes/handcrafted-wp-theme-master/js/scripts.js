var internalA = '#branding a:not("a.nav-pag"), #nav-below a';

jQuery.fn.cycleInit = function(){
	if(this.children().size() > 1){	
		$(this).addClass('cycle').after('<nav id="pager">').cycle({
			pager:  '#pager'
		});
	}
};

$(document).on('navswitch' , function(){
	$('#nav-container.home')
		.find('.nav-holder.about')
		.appendTo('#site-description');
});

$(document).on('navslide', function(e){
	el = $(e.target);
	load = el.find('#load');
	elw = el.width();
	lw = load.children().length * 320;
	next = el.find('.nav-pag.next');
	prev = el.find('.nav-pag.prev');
	
	el.on('navmoved' , function(e){
		if(getCondition(true, load, lw, elw)){
			next.removeClass('hide');
		}else{
			next.addClass('hide');
			next.off('mouseover');
			window.clearInterval();
		}
		if(getCondition(false, load, lw, elw)){
			prev.removeClass('hide');
		}else{
			prev.addClass('hide');
			prev.off('mouseover');
			window.clearInterval();
		}
	});
	
	next.click(function(e){
		e.preventDefault();
		if(getCondition(true, load, lw, elw)){
			load.animate({'left' : '-=320'}, function(){
				el.trigger('navmoved');
			});
		}
	});
	
	
	
	prev.click(function(e){
		e.preventDefault();
		if(getCondition(false, load, lw, elw)){
			load.animate({'left' : '+=320'}, function(){
				el.trigger('navmoved');
			});
		}
	});
	
});

function getCondition(direction, load, lw, pw){
	if(direction == true){
		return (lw + parseInt(load.css('left'))) > pw;
	}else{
		return parseInt(load.css('left')) < 0;
	}
}

function cycleValid(){
	$('#carousel-images').cycleInit();
	$("#contactform").validate({
		rules: {
		select: "required" }
	});
}

function pageTrans(data , home){
	$('#main')
		.children()
		.fadeOut('fast', function(){
			$(this).remove().parent();
			$('#main').append($(data).find('#primary').addClass('incoming' + home));
		});
	$('body')
		.removeClass()
		.addClass($(data).find('#main').attr('data'));
	$('.outgoing' + home)
		.on('webkitTransitionEnd oTransitionEnd transitionend msTransitionEnd', function() {
			$(this).remove();
			$('#primary').removeClass('incoming' + home);
			setTimeout(function() {
				  cycleValid();
			}, 1000);
			$('#nav-below').removeClass('hidden');
	})
}

$(document).ready(function(){

	// Add jQuery Address functionality to the links in the navbar

   	$(internalA).address();
    
    $.address.internalChange(function(e) {
    	console.log(e);
        var uri = e.value;
        var target = uri.replace('http://localhost/' , '');
        console.log($.address.path());
        $.address.value(target);
		if (target != $.address.value){
			$.ajax({
				url: target,
				data: {},
				beforeSend: function(){
					$('body').append('<p class="loader">Loading</p>');
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
		}
        
    });
    
    $.address.externalChange(function(e) {
    	console.log(e);
	});

	cycleValid();

	$('#nav-container')
		.addClass('home')
		.clone()
		.removeClass('home')
		.addClass('drop up')
		.appendTo('#utility')
		.trigger('navswitch');

	// Load in posts of each section on nav item roll

	$('.nav-holder:not(".about")').hover(
		function(e){
			var content = $(this).find('.nav-content');
			if (content.find('#load').length < 1){
				var target = $(this).find('.nav-link').attr('href');
				$.ajax({
					url: target,
					data: {},
					beforeSend: function(){
						 $('body').append('<p class="loader">Loading</p>');
				   },
					success: function (data) {
						lw = $(data).find('#load').children().length * 320;
						if(content.width() < lw){
							content.addClass('active')
								.prepend($(data).find('#load'))
								.trigger('navslide')
								.find('.nav-pag.next').removeClass('hide');
						}else{
							content
								.addClass('active')
								.prepend($(data).find('#load'));
						}			
					},
					complete: function(){
						$('.loader').remove();
					},
					dataType: 'html'
				});
			}else{
				content.addClass('active').trigger('navslide');
				//$(internalA).unbind('click').ajaxLink();
			}
		}, 
		function(){
			$(this).find('.nav-content').removeClass('active').off('hover navslide').children().off('click navmoved');
		}	
	);

	$('.nav-title').hover(function(){
		$('#nav-container.drop').removeClass('up').addClass('down');
	});

	$('#nav-container.drop').on('mouseleave' , function(){
		$(this)
			.removeClass('down').addClass('up')
			.find('.active').removeClass('active');
	});
});