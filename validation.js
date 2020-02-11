$(function() {
  $('#loginform').validate({
    rules: {
      username: {
        minlength: 2,
        maxlength: 50,
        required: true
      },
      pwd: {
        required: true,
        email: true,
        minlength: 10
      }
    },
    errorPlacement: function(error, element) {
      var name = $(element).attr('name')
      error.appendTo($('#' + name + '_validate'))
    }
  })
})
