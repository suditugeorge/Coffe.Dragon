$ ->
	if $( window ).width() < 1040
		$("#logo").fadeOut()
		$('#logo').addClass 'hidden'
	if $( window ).width() >= 1040
		$("#logo").fadeIn()
		$('#logo').removeClass 'hidden'
