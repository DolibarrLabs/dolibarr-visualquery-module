
$(document).ready(function () {
	$('#show_password').click(function() {
		$('input[name="password"]').attr('type', 'text');
		$(this).hide();
	});

	$('input[name="username"],input[name="password"]').keyup(function() {
		//if ($(this).val().length == 0) {
		if ($('input[name="username"]').val().length == 0 || $('input[name="password"]').val().length == 0) {
			$('div.tabsAction').addClass('hidden');
		}
		else {
			$('div.tabsAction').removeClass('hidden');
		}
	});
});
