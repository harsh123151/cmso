$(document).ready(function () {
  $('#selectallboxes').click(function (event) {
    if (this.checked) {
      $('.checkBoxes').each(function () {
        this.checked = true
      })
    } else {
      $('.checkBoxes').each(function () {
        this.checked = false
      })
    }
  })

  $('#summernote').summernote({
    height: 200,
  })

  var loader = "<div id='load-screen'><div id='loading'></div></div>"

  $('body').prepend(loader)
  $('#load-screen')
    .delay(200)
    .fadeOut(600, function () {
      $(this).remove()
    })
})
setInterval(function () {
  $.get('includes/Functions.php?runfunction=useronline', (data) => {
    $('.usersonline').text(data)
  })
}, 300)
$('.delete_link').on('click', function (event) {
  event.preventDefault()
  console.log('hello')
  var postid = $(this).attr('rel')
  $('#deletelink').attr('href', 'posts.php?delete=' + postid)
  $('#deleteModal').modal('show')
})
