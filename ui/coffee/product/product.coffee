$ ->
	$('#send-review').click () ->
		review = $('.status-box').val()
		if review == ""
			return
		product_id = $('.product').data('id')
		$.post '/add-review', {review:review,id:product_id}, (json) ->
			window.location.reload()
			return
