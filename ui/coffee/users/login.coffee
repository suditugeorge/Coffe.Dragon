register = () ->
  #Take the JQuery object and what the user inseted from the email
  $email_field = $('[name="email-register"]')
  email = $email_field.val()
  #Validate the email using a regex
  emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
  if !emailRegex.test(email)
    $email_field.addClass 'input-error'
    $('.email-error').removeClass 'hidden'
    return
  $email_field.removeClass 'input-error'
  $('.email-error').addClass 'hidden'
  $password_field = $('[name="password-register"]')
  password = $password_field.val()
  passwordRegex = (/^(?=.*[a-z])[0-9a-zA-Z]{8,}$/)
  if !passwordRegex.test(password)
    $password_field.addClass 'input-error'
    $('.password-register-error').removeClass 'hidden'
    return
  $password_field.removeClass 'input-error'
  $('.password-register-error').addClass 'hidden'
  $confirmPssField = $('[name="confirm-password"]')
  confirmPass = $confirmPssField.val()
  if(password != confirmPass)
    $confirmPssField.addClass 'input-error'
    $('.confirm-password-error').removeClass 'hidden'
    return
  $confirmPssField.removeClass 'input-error'
  $('.confirm-password-error').addClass 'hidden'
  $.post '/register', { email: email, password: password }, (json) ->
    if json.success
      $('.defined-error').addClass 'hidden'
      window.location.href = "/"
      return
    else
      error = $('.defined-error')
      error.html(json.message)
      error.removeClass 'hidden'
      return
  return
  return
$ ->
  $('#login-form-link').click (e) ->
    $('#register-form').addClass 'hidden'
    $('#login-form').delay(100).fadeIn 100
    $('#register-form').fadeOut 100
    $('#register-form-link').removeClass 'active'
    $(this).addClass 'active'
    e.preventDefault()
    return
  $('#register-form-link').click (e) ->
    $('#register-form').removeClass 'hidden'
    $('#register-form').delay(100).fadeIn 100
    $('#login-form').fadeOut 100
    $('#login-form-link').removeClass 'active'
    $(this).addClass 'active'
    e.preventDefault()
    return
  $('#register-submit').click (e) ->
    #Call the function register witch does not take any parameters
    register()
    return
  $('[name="login-submit"]').click (e) ->
    $email_field = $('[name="username"]')
    email = $email_field.val()
    emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    if !emailRegex.test(email)
      $email_field.addClass 'input-error'
      $('.username-error').removeClass 'hidden'
      return
    $email_field.removeClass 'input-error'
    $('.username-error').addClass 'hidden'
    $password_field = $('[name="password"]')
    password = $password_field.val()
    passwordRegex = (/^(?=.*[a-z])[0-9a-zA-Z]{8,}$/)
    if !passwordRegex.test(password)
      $password_field.addClass 'input-error'
      $('.password-error').removeClass 'hidden'
      return
    $.post '/doLogin', { email: email, password: password }, (json) ->
      if json.success
        $('.defined-error').addClass 'hidden'
        window.location.href = "/home"
        return
      else
        error = $('.defined-error')
        error.html(json.message)
        error.removeClass 'hidden'
        return
    return
  $(document).keypress (e) ->
    if e.which == 13
      if $('#register-form-link').hasClass('active')
        register()
    return
  return


  