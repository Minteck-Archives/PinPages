// document.getElementById('searchbar').value = query

document.getElementById("searchbar").addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
    event.preventDefault();
    document.getElementById("sbsubmit").click();
  }
}); 

function handleSearch() {
    if (document.getElementById("searchbar").value.trim() == "") {} else {
      location.href = "/search/?q=" + document.getElementById("searchbar").value.trim()
    }
}

function logout() {
  location.href = "/logout/?lang=" + langprop
}

function clearNotifications() {

  ssldata = new FormData()
  request = "/library/notifications_read.php"

  $.ajax({
      url: request,
      dataType: 'html',
      cache: false,
      data: ssldata,
      contentType: false,
      processData: false,
      type: 'post',
      success: function (data) {
          statusText = data;
          if (statusText == "ok") {
              location.reload()
          } else {
              location.href = "/"
          }
      }})
}