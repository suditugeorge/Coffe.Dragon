$(document).ready ->
  $('#list').click (event) ->
    event.preventDefault()
    $('#products .item').addClass 'list-group-item'
    return
  $('#grid').click (event) ->
    event.preventDefault()
    $('#products .item').removeClass 'list-group-item'
    $('#products .item').addClass 'grid-group-item'
    return
  return