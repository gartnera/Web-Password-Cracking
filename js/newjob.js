$(document).ready(function () {
	$(".attack_method").click(function () {
		var id = $(this).context.value;

		if (id == 1) {
			$("#dictionary-options").css({'display': 'none'});
			$("#mask-options").fadeIn(500);
		}

		else if (id == 2) {
			$("#mask-options").css({'display': 'none'});
			$("#dictionary-options").fadeIn(500);
		}
		else {
			$("#dictionary-options").fadeOut(500);
			$("#mask-options").fadeOut(500);
		}

	});
});

