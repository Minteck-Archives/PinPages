// var input = document.getElementById("searchbar");

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
            location.reload()
        }})
}

function validateFriend(user) {
  ssldata = new FormData()
  ssldata.append('friend', user)
  request = "/library/validate_friend.php"
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
      location.reload()
    }
  })
}

function ignoreFriend(user) {
  ssldata = new FormData()
  ssldata.append('friend', user)
  request = "/library/ignore_friend.php"
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
      location.reload()
    }
  })
}