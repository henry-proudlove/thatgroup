
loader = '<div id="loader"><div class="loader-sec left"></div><div class="loader-sec middle"></div><div class="loader-sec right"></div></div>';

jQuery.fn.cycleInit = function(){
	if(this.children().size() > 1){	
		$(this).addClass('cycle').after('<nav id="pager">').cycle({
			pager:  '#pager',
			
		});
	}
};


// Move home about link to #site-description

$(document).on('carousel' , function(e){
	console.log('fuck');
});

$(document).on('navswitch' , function(){
	$('#nav-container.home')
		.find('.nav-holder.about')
		.appendTo('#site-description');
});

$(document).on('aboutpage' , function(){
	$('.hit-area').hover(
		function(){
			name = $(this).attr('id');
			console.log(name);
			$('#people-list').find('#' + name).addClass('active');
		}, 
		function(){
			$('#people-list').find('.active').removeClass('active');	
		}
	);
	$('.people-item').hover(
		function(){
			name = $(this).attr('id');
			console.log(name);
			$('#people-holder').find('#' + name).addClass('active');
		}, 
		function(){
			$('#people-holder').find('.active').removeClass('active');	
		}
	);
	
	$('.people-item, .hit-area').click(function(e){
		e.preventDefault();
		console.log('fuck yeah');
		name = $(this).attr('id');
		$('#people-biogs').find('#' + name).fadeIn('fast');
		$('body').css('overflow' , 'hidden');
	});
	
	$('.people-biog').click(function(){
		$(this).fadeOut('fast');
		$('body').css('overflow' , 'auto');
	});
});


// Get position of menu items relative to container

function getPos(el, direction){
	load = el.find('#load');
	elw = el.width();
	lw = load.children().length * 320;
	next = el.find('.nav-pag.next');
	prev = el.find('.nav-pag.prev');
	if(direction == true){
		return (lw + parseInt(load.css('left'))) > elw;
	}else{
		return parseInt(load.css('left')) < 0;
	}
}	
function pageTrans(data , home, external){
	$('#carousel-images').cycle('destroy');
	var addedClass = '';
	if(!external){
		if(!home){
			addedClass = 'incoming';
		}else{
			addedClass = 'incoming-home';
		}
	}else{
		addedClass = '';
	}
	$('#main')
		.children()
		.fadeOut('fast', function(){
			$(this).remove().parent();
			$('#main').append($(data).find('#primary').addClass(addedClass));
			if($('#content.about').length > 0){
				$(document).trigger('aboutpage');
			}else if($('#content.project').length > 0){
				$('#carousel-images').cycleInit();
			}
		});
	window.scrollTo(0,0);
	$('body')
		.removeClass()
		.addClass($(data).find('#main').attr('data'));
	$('#nav-container.down')
		.removeClass('down')
		.addClass('up')
		.find('.nav-content')
		.each(function(){
			$(this).removeClass('active');
		});
}

function mobScroll(el){
	p = el.parent();
	var mob = $(window).width() < 650;
	if(mob == true){
		if(p.hasClass('home')){
			window.scrollTo(0, el.offset().top);
		}else{
			window.scrollTo(0,0);
		}
	}
}

$.address.init(function(event) {
}).internalChange(function(event) {
	var target =  $.address.path();
	$.ajax({
		url: target,
		data: {},
		beforeSend: function(){
			$('body > .loader-holder')
				.append(loader)
				.fadeIn('fast');
		},
		success: function (data) {
			if(target == siteURL + '/'){
				pageTrans(data , true, false);
			}else{
				pageTrans(data , false, false);
			}
		},
		complete: function(){
			$('.loader-holder').fadeOut('fast' , function(){
				$(this).children().remove();
			});
		},
		dataType: 'html'
	});    
}).bind('externalChange', function(event) {
	var target = $.address.path();
	console.log(target);
	if (target == '/about/'){
		$(document).trigger('aboutpage');
	}
	$.address.value(target);
	$.ajax({
		url: target,
		data: {},
		beforeSend: function(){
		},
		success: function (data) {
			pageTrans(data , true, true);
		},
		complete: function(){
		},
		dataType: 'html'
	});    
});

$(document).ready(function(){
	$('#carousel-images').cycleInit();
	$('#nav-container')
		.addClass('home')
		.clone()
		.removeClass('home')
		.addClass('drop up')
		.appendTo('#utility')
		.trigger('navswitch');

	// Load in posts of each section on nav item roll

	$('.nav-holder:not(".about")').on('click mouseenter' ,
		function(e){
			e.preventDefault();
			el = $(this);
			var content = el.find('.nav-content');
			if (content.find('#load').length < 1){
				var target = $(this).find('.nav-link').attr('href');
				$.ajax({
					url: target,
					data: {},
					beforeSend: function(){
						content
							.addClass('active')
							.find('.loader-holder')
							.append(loader)
							.fadeIn('fast');
				   },
					success: function (data) {
						lw = $(data).find('#load').children().length * 320;
						if(content.width() < lw){
							content.addClass('active')
								.prepend($(data).find('#load'))
								.find('.nav-pag.next').removeClass('hide');
							mobScroll(el);
						}else{
							content.prepend($(data).find('#load'));
						}			
					},
					complete: function(){
						$('.loader-holder').fadeOut('fast' , function(){
							$(this).children().remove();
						});
					},
					dataType: 'html'
				});
			}else{
				content.addClass('active');
				mobScroll(el);
			}
	});
	$('.nav-holder:not(".about")').mouseleave(function(){
			$(this).find('.nav-content').removeClass('active');
			$('.loader-holder').children().remove();
	});
	
	$('.nav-holder').mouseenter(function(){
		$(this)
			.siblings()
			.find('.nav-content')
			.removeClass('active')
	});

	$('.nav-title').on('hover click' , function(){
		$('#nav-container.drop').removeClass('up').addClass('down disable');
		var t = setTimeout(function(){
						$('#nav-container.drop').removeClass('disable');
				},700)
	});

	$('#nav-container.drop').on('mouseleave' , function(){
		$(this)
			.removeClass('down').addClass('up')
			.find('.nav-content')
			.each(function(){
				$(this).removeClass('active');
			});
	});
	
	// Menu Pagination
	
	$('.nav-pag.next').click(function(e){
		e.preventDefault();
		console.log(e);
		el = $(this).parent();
		if(getPos(el, true)){
			load.animate({'left' : '-=320'}, function(){
				$(this).parent().trigger('navmoved');
			});
		}
	});
	
	$('.nav-pag.prev').click(function(e){
		e.preventDefault();
		el = $(this).parent();
		if(getPos(el, false)){
			load.animate({'left' : '+=320'}, function(){
				$(this).parent().trigger('navmoved');
			});
		}
	});
	
	$('.nav-content').on('navmoved' , function(e){
		console.log(e);
		el = $(this);
		next = el.find('.nav-pag.next');
		prev = el.find('.nav-pag.prev');
		if(getPos(el, true)){
			next.removeClass('hide');
		}else{
			next.addClass('hide')
		}
		if(getPos(el, false)){
			prev.removeClass('hide');
		}else{
			prev.addClass('hide');
		}
	});
	
});