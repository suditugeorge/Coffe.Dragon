$ ->
	$('form').submit (el) ->
	  el.preventDefault()
	  $name_field = $('#input-name')
	  $email_field = $('#input-email')
	  $message_filed = $('#input-message')

	  $name_field_error = $('.input-name-error')
	  $email_field_error = $('.input-email-error')
	  $message_filed_error = $('.input-message-error')

	  $name_field_error.addClass 'hidden'
	  $email_field_error.addClass 'hidden'
	  $message_filed_error.addClass 'hidden'
	  $name_field.removeClass 'input-error'
	  $email_field.removeClass 'input-error'
	  $message_filed.removeClass 'input-error'

	  name = $name_field.val()
	  if name.trim() == ''
	  	$name_field.addClass 'input-error'
	  	$name_field_error.removeClass 'hidden'
	  	return

	  email = $email_field.val()
	  emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
	  if !emailRegex.test(email)
	    $email_field.addClass 'input-error'
	    $email_field_error.removeClass 'hidden'
	    return

	  message = $message_filed.val()
	  if message.trim() == ''
	  	$message_filed.addClass 'input-error'
	  	$message_filed_error.removeClass 'hidden'
	  	return

	  $.post '/contact', { email: email, name: name, message: message }, (json) ->
	    if json.success
	      window.location.href = "/"
	    else
	    	window.location.href = "/"
	  return