var internalA = 'a[href*="' + siteURL + '"]:not("#wpadminbar a")';

/*jQuery.fn.ajaxLink = function(){
	$(this).click(function(e){
		e.preventDefault();
		target = $(this).attr('href');
		if (target !== $.address.value){
			$.ajax({
				url: target,
				data: {},
				beforeSend: function(){
					$('body').append('<p class="loader">Loading</p>');
				},
				success: function (data) {
					if(target == siteURL + '/'){
						pageTrans(e , data , '-home');
					}else{
						pageTrans(e, data , '');
					}
				},
				complete: function(){
					$('.loader').remove();
				},
				dataType: 'html'
			});
		}
	});
};*/

jQuery.fn.cycleInit = function(){
	if(this.children().size() > 1){	
		$(this).addClass('cycle').after('<nav id="pager">').cycle({
			pager:  '#pager'
		});
	}
};

function pageTrans(e, data , home){
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
				  cycleValid();
			}, 1000);
			$('#nav-below').removeClass('hidden');
	})
}

$(document).on('navswitch' , function(){
	$('#nav-container.home')
		.find('.nav-holder.about')
		.appendTo('#site-description');
});

$('.nav-content').on('navslide' , function(e){
	parent = $(this);
	pw = parent.width();
	load = parent.find('#load');
	lw = load.children().length * 320;
	pages = parseInt(load.attr('data-page'));
	nextLink = '<a href="#" class="nav-pag next">Next</a>';
	prevLink = '<a href="#" class="nav-pag prev">Previous</a>';
	if(pw < lw || pages > 1){
		$(nextLink)
			.appendTo(parent)
			.hover(
				function(){
					if((lw + load.position().left) > pw){
						load.css('left' , '-=320');
						nextInt = window.setInterval(
							function(){
								if((lw + load.position().left) > pw){
									load.css('left' , '-=320');
								}
								}else{
									window.clearInterval(nextInt);
								},750);
					}else{
						console.log('Rightmost visible');
					}
				}, function(){
					window.clearInterval(nextInt);    
				});
		$(prevLink)
			.appendTo(parent)
			.hover(
				function(){
					if(load.position().left < 0){
						load.css('left' , '+=320');
						prevInt = window.setInterval(
							function(){
								if(load.position().left < 0){
									load.css('left' , '+=320');
								}
							} ,750);
					}else{
						window.clearInterval(nextInt);
					}
			}, function(){
				window.clearInterval(prevInt);
			});
	}else{
	}
	
});

function cycleValid(){
	$('#carousel-images').cycleInit();
	$("#contactform").validate({
		rules: {
		select: "required" }
	});
}

$(document).ready(function(){

	// Add jQuery Address functionality to the links in the navbar

   // $(internalA).address();
    
    // Our event responder that triggers whenever the address is changed (including on first load!)
    
    $.address.change(function(event) {
        var uri = event.value;
        var rel = uri.replace('http://localhost/' , '');
        console.log($.address.path());
        $.address.value(rel);  
        
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
			if (content.is(':empty')){
				var target = $(this).find('.nav-link').attr('href');
				$.ajax({
					url: target,
					data: {},
					beforeSend: function(){
						 $('body').append('<p class="loader">Loading</p>');
				   },
					success: function (data) {
						content
							.addClass('active')
							.append($(data)
							.find('#load'))
							.trigger('navslide');
						//$(internalA).unbind('click').ajaxLink();					
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
			$(this).find('.nav-content').removeClass('active').unbind('hover');
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