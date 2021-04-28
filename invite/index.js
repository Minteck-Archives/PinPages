// var input = document.getElementById("searchbar");
document.getElementById('confirm').checked = false;

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

function confirmFriend() {
  if (document.getElementById('confirm').checked) {
    document.getElementById('send').classList.remove('hide')
  } else {
    document.getElementById('send').classList.add('hide')
  }
}

function sendFriendRequest() {
  document.getElementById('request').classList.add('hide')
  document.getElementById('status').classList.remove('hide')
  request = "/library/request_friend.php"
  ssldata = new FormData
  ssldata.append('user', user)
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
        document.getElementById('status').classList.add('hide')
        document.getElementById('save_success').classList.remove('hide')
        return
      }
      if (statusText == "sent") {
        document.getElementById('status').classList.add('hide')
        document.getElementById('save_error_2').classList.remove('hide')
        return
      }
      if (statusText == "friend") {
        document.getElementById('status').classList.add('hide')
        document.getElementById('save_error_3').classList.remove('hide')
        return
      }
      document.getElementById('status').classList.add('hide')
      document.getElementById('save_error_1').classList.remove('hide')
    }
  })
}