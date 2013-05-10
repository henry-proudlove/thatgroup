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
	$('body')
		.removeClass()
		.addClass($(data).find('#main').attr('data'));
}

$(document).ready(function(){
	var internalA = '#branding a:not("a.nav-pag , a.current"), #nav-below a';
	
   	$(internalA).address();
   	
    $.address.change(function(e) {
    	console.log(e);
        //var target = e.value.replace($.address.baseURL() + '/', '');
    	var target = e.value.replace('http://localhost/', '');
    	$('a[href="http://localhost' + target +'"]').addClass('current');
        console.log($.address.value());
		$.address.value(target);
		$.ajax({
			url: target,
			data: {},
			beforeSend: function(){
				$('body').append('<p class="loader">Loading</p>');
			},
			success: function (data) {
				if(target == siteURL + '/'){
					pageTrans(data , true);
				}else{
					pageTrans(data , false);
				}
				
			},
			complete: function(){
				$('.loader').remove();
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
						 content.addClass('active')
				   },
					success: function (data) {
						lw = $(data).find('#load').children().length * 320;
						if(content.width() < lw){
							content.addClass('active')
								.prepend($(data).find('#load'))
								.trigger('navslide')
								.find('.nav-pag.next').removeClass('hide');
						}else{
							content.prepend($(data).find('#load'));
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