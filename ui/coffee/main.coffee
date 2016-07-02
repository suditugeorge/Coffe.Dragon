$ ->
	if $( window ).width() > 1040
		$('.logo').removeClass 'hidden'

	$(window).resize ->
		$logo = $('.logo')
		console.log $(window).width()
		if $(window).width() < 1040
			$logo.addClass 'hidden'
		else 

			$logo.removeClass 'hidden'
