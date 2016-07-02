$ ->
	if $( window ).innerWidth() > 1040
		$('.logo').removeClass 'hidden'

	$(window).resize ->
		$logo = $('.logo')
		if $(window).innerWidth() < 1040
			$logo.addClass 'hidden'
		else
			$logo.removeClass 'hidden'
