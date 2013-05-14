var loader = '<div id="loader" style="width: 150px; height: 80px"></div><script>var stage = new swiffy.Stage(document.getElementById("loader"),swiffyobject);stage.start();</script>';

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

/*$(document).on('navslide', function(e){
	el = $(e.target);
	load = el.find('#load');
	elw = el.width();
	lw = load.children().length * 320;
	next = el.find('.nav-pag.next');
	prev = el.find('.nav-pag.prev');
	
});*/

function getCondition(el, direction){
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

function cycleValid(){
	$('#carousel-images').cycleInit();
	$("#contactform").validate({
		rules: {
		select: "required" }
	});
}

function pageTrans(data , home, external){
	if(!external){
		if(!home){
			$('#main')
				.children()
				.fadeOut('fast', function(){
					$(this).remove().parent();
					$('#main').append($(data).find('#primary').addClass('incoming'));
				});
		}else{
			$('#main')
				.children()
				.fadeOut('fast', function(){
					$(this).remove().parent();
					$('#main').append($(data).find('#primary').addClass('incoming-home'));
				});
		}
	}else{
		$('#main')
				.children()
				.fadeOut('fast', function(){
					$(this).remove().parent();
					$('#main').append($(data).find('#primary'));
				});
	}
	$('body')
		.removeClass()
		.addClass($(data).find('#main').attr('data'));
}

$(document).ready(function(){

	var internalA = '#branding a:not("a.nav-pag , a.current, a.map, input[type="submit""), #nav-below a';
		
   	$(internalA).address(function() {  
   		target = $(this).attr('href').replace('http://localhost/', '');
		return target;
	});  
   	
    $.address.internalChange(function(e) {
    	console.log(e);
		target = $.address.value();
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
    });
    
   	$.address.externalChange(function(e) {
    	console.log(e);
    	var target = e.value.replace('http://localhost/', '');
        console.log($.address.value());
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
    
	cycleValid();

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
			var content = $(this).find('.nav-content');
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

	$('.nav-title').hover(function(){
		$('#nav-container.drop').removeClass('up').addClass('down');
	});

	$('#nav-container.drop').on('mouseleave' , function(){
		$(this)
			.removeClass('down').addClass('up')
			.find('.active').removeClass('active');
	});
	
	// Menu Pagination
	
	$('.nav-content').on('navmoved' , function(e){
	el = $(this);
	next = el.find('.nav-pag.next');
	prev = el.find('.nav-pag.prev');
	if(getCondition(el, true)){
		next.removeClass('hide');
	}else{
		next
			.addClass('hide')
	}
	if(getCondition(el, false)){
		prev.removeClass('hide');
	}else{
		prev.addClass('hide');
	}
	});
	
	$('.nav-pag.next').click(function(e){
		e.preventDefault();
		console.log(e);
		el = $(this).parent();
		if(getCondition(el, true)){
			load.animate({'left' : '-=320'}, function(){
				el.trigger('navmoved');
			});
		}
	});
	
	$('.nav-pag.prev').click(function(e){
		e.preventDefault();
		el = $(this).parent();
		if(getCondition(el, false)){
			load.animate({'left' : '+=320'}, function(){
				el.trigger('navmoved');
			});
		}
	});
	
	
	
});