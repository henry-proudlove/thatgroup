$(document).ready(function(){
	$("#contactform").validate({
		rules: {
			select: "required" }
	});
	
	$('#utility li').not(':first').hover(
		function () {
			var target = $(this).find('a').attr('href');
			target = target.substring(0,target.length - 1);
			target += '#load';
			//$(this).load(target);
		  },
		  function () {
			//$(this).find("li:last").remove();
		  }
	);
});