$(document).ready(function(){
	$("form").submit(function(evt){
		var emailInvalid = $('#error-invalid-email');
		if (!$('[name="email"]').val().match(".+\@.+\..+")){
			emailInvalid.fadeIn(250);
			evt.preventDefault();
		}
		else
			emailInvalid.fadeOut(250);

		var password = $('[name="password"]').val();

		var shortPassword = $('#error-password-length');
		if (password.length < 10){
			shortPassword.fadeIn(250);
			evt.preventDefault();
		}
		else
			shortPassword.fadeOut(250);

		var mismatchPasswords = $('#error-password-mismatch');
		if (password !== $('[name="confirm-password"]').val()){
			mismatchPasswords.fadeIn(250);
		}
		else
			mismatchPasswords.fadeOut(250);

	});
})
