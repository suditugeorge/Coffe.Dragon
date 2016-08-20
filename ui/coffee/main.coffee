$ ->
	if $( window ).innerWidth() > 1040
		$('.logo').removeClass 'hidden'

	$(window).resize ->
		$logo = $('.logo')
		if $(window).innerWidth() < 1040
			$logo.addClass 'hidden'
		else 
			$logo.removeClass 'hidden'

	$('#addProduct').click () ->
		$.post '/create-product', {}, (json) ->
			window.location.href = json.url
			return
		return
