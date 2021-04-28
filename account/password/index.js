document.getElementById("searchbar").addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
    event.preventDefault();
    document.getElementById("sbsubmit").click();
  }
}); 

function handleSearch() {
    if (document.getElementById("searchbar").value.trim() == "") {} else {
      location.href = "/search/?q=" + document.getElementById("searchbar").value.trim() + "&lang=" + langprop
    }
}

function logout() {
      location.href = "/logout/?lang=" + langprop
}

function changePassword() {
  $("#loader").fadeIn(500)
  $("#password_submit").fadeOut(500)
  var objects = {
    oldpass: document.getElementById("password_old"),
    newpass: document.getElementById("password_new"),
    newrept: document.getElementById("password_new2"),
    error1: document.getElementById("save_error_1"),
    error2: document.getElementById("save_error_2"),
    error3: document.getElementById("save_error_3"),
    error4: document.getElementById("save_error_4"),
    error5: document.getElementById("save_error_5"),
    error6: document.getElementById("save_error_6"),
    success: document.getElementById("save_success"),
    success2: document.getElementById("save_success")
  }

  objects.oldpass.disabled = true;
  objects.newpass.disabled = true;
  objects.newrept.disabled = true;
  objects.success.classList.add('hide')
  objects.success2.classList.add('hide')
  objects.error1.classList.add('hide')
  objects.error2.classList.add('hide')
  objects.error3.classList.add('hide')
  objects.error4.classList.add('hide')
  objects.error5.classList.add('hide')
  objects.error6.classList.add('hide')

  ssldata = new FormData()
  ssldata.append("oldpass", objects.oldpass.value)
  ssldata.append("newpass", objects.newpass.value)
  ssldata.append("newrept", objects.newrept.value)
  ssldata.append("lang", langprop)
  request = "/library/change_password.php"

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
          $("#loader").fadeOut(500)
          $("#password_submit").fadeIn(500)
          if (statusText == "ok") {
            objects.oldpass.disabled = false;
            objects.newpass.disabled = false;
            objects.newrept.disabled = false;
            objects.success2.classList.remove('hide');
            return;
          }
          if (statusText == "Error 4") {
            objects.oldpass.disabled = false;
            objects.newpass.disabled = false;
            objects.newrept.disabled = false;
            objects.error4.classList.remove('hide');
            return;
          }
          if (statusText == "Error 5") {
            objects.oldpass.disabled = false;
            objects.newpass.disabled = false;
            objects.newrept.disabled = false;
            objects.error5.classList.remove('hide');
          } else {
            objects.oldpass.disabled = false;
            objects.newpass.disabled = false;
            objects.newrept.disabled = false;
            objects.error6.classList.remove('hide');
          }
      }})

}