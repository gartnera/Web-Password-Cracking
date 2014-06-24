$(document).ready(function(){
	$('.hash-meta').click(function(){
		var next = $(this).next();
		if (next.hasClass('hidden'))
			next.removeClass('hidden');
		else
			next.addClass('hidden');
	})
})