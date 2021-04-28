// var input = document.getElementById("searchbar");

document.getElementById("account_email").value = currentEmail;

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

document.getElementById("account_email").addEventListener("keyup", validateEmail)

function validateEmail() {
  if (document.getElementById("account_email").value.trim() == "") {
    document.getElementById("change_email").classList.add('hide');
    document.getElementById("reset_email").classList.remove('hide');
    document.getElementById("accmail_invalid").classList.add('hide');
    document.getElementById("account_email").classList.remove('red_color');
  } else {
    if (document.getElementById("account_email").value.includes("@") && document.getElementById("account_email").value.includes(".") && !document.getElementById("account_email").value.includes(" ") && !document.getElementById("account_email").value.includes('"') && !document.getElementById("account_email").value.includes("`") && !document.getElementById("account_email").value.includes("'") && !document.getElementById("account_email").value.includes("|") && !document.getElementById("account_email").value.includes("]") && !document.getElementById("account_email").value.includes("[") && !document.getElementById("account_email").value.includes("}") && !document.getElementById("account_email").value.includes("{") && !document.getElementById("account_email").value.includes("(") && !document.getElementById("account_email").value.includes(")") && !document.getElementById("account_email").value.length < 4) {
      document.getElementById("change_email").classList.remove('hide');
      document.getElementById("accmail_invalid").classList.add('hide');
      document.getElementById("reset_email").classList.add('hide');
      document.getElementById("account_email").classList.remove('red_color');
    } else if (document.getElementById("account_email").value.includes(" ")) {
      document.getElementById("change_email").classList.add('hide');
      document.getElementById("accmail_invalid").classList.remove('hide');
      document.getElementById("reset_email").classList.add('hide');
      document.getElementById("account_email").classList.add('red_color');
    } else {
      document.getElementById("change_email").classList.add('hide');
      document.getElementById("accmail_invalid").classList.remove('hide');
      document.getElementById("reset_email").classList.add('hide');
      document.getElementById("account_email").classList.add('red_color');
    }
  }
}

function changeEmail() {
  document.getElementById("error_email").classList.add("hide")
  document.getElementById("success_email").classList.add("hide")

  document.getElementById("account_email").disabled = true;
  document.getElementById("change_email").classList.add("hide")
  document.getElementById("reset_email").classList.add("hide")
  ssldata = new FormData()
  ssldata.append("email", document.getElementById("account_email").value)
  ssldata.append("lang", langprop)
  request = "/library/change_email.php"

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
            document.getElementById("account_email").value = "";
            document.getElementById("change_email").classList.add("hide")
            document.getElementById("account_email").classList.add("hide")
            document.getElementById("accmail_invalid").classList.add("hide")
            document.getElementById("success_email").classList.remove("hide")
          } else {
            document.getElementById("account_email").disabled = false;
            document.getElementById("error_email").innerHTML = statusText.replace("err: ","")
            document.getElementById("error_email").classList.remove("hide")
          }
      }})
}

function uploadProfilePic() {
  if (document.getElementById('profilepic').value == "") {
    document.getElementById('pp_error_3').classList.remove('hide')
    return;
  }
  else
  {
    document.getElementById('pp_error_2').classList.add('hide')
    document.getElementById('pp_error_3').classList.add('hide')
    document.getElementById('pp_error_1').classList.add('hide')
    document.getElementById('pp_success_1').classList.add('hide')
    document.getElementById('pp_success_2').classList.add('hide')
    document.getElementById('profilepic').disabled = true;
    var file_data = $("#profilepic").prop("files")[0];
    var form_data = new FormData();
    form_data.append("profilepic", file_data)
    $.ajax({
      url: "/library/profile_picture.php",
      dataType: 'html',
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function(data) {
        document.getElementById('profilepic').disabled = false;
        if (data == "Error 8") {
          document.getElementById('pp_error_1').classList.remove('hide')
          return
        }
        if (data == "Error 7" || data.startsWith("<br />\n<b>Warning</b>:  POST Content-Length of")) {
          document.getElementById('pp_error_2').classList.remove('hide')
          return
        }
        document.getElementById('ppreset').classList.remove('hide')
        document.getElementById('ppupload').classList.remove('ppadd')
        document.getElementById('ppupload').classList.add('ppupdate')
        document.getElementById('pp_success_1').classList.remove('hide')
        document.getElementById('when_uploaded').innerHTML = " | <a class=\"jslink\" onclick=\"uploadProfilePic()\">" + lang_pictures_edit + "</a>"
        return
      }
    })
  }
}

function showDelete() {
  document.getElementsByClassName('header')[0].classList.add('blur')
  document.getElementsByClassName('header_escape')[0].classList.add('blur')
  $('#delete').fadeIn(500)
  $('.abody').css('overflow','hidden')
  document.getElementsByClassName('delete_confirm')[0].classList.add('delete_confirm_disabled')
  var dcd = true;
  setTimeout(function () {
    document.getElementsByClassName('delete_confirm')[0].classList.remove('delete_confirm_disabled')
    var dcd = false;
  }, 5000)
}

function hideDelete() {
  document.getElementsByClassName('header')[0].classList.remove('blur')
  document.getElementsByClassName('header_escape')[0].classList.remove('blur')
  $('#delete').fadeOut(500)
  $('.abody').css('overflow','')
  var dcd
}

$("#ppupload").click(function(e){
  e.preventDefault();
  $("#profilepic").trigger('click');
});

function uploadValidation() {
  if (document.getElementById('profilepic').value != "") {
    document.getElementById('when_uploaded').classList.add('show')
    $('#when_uploaded').css('display', 'initial')
  } else {
    document.getElementById('when_uploaded').classList.remove('show')
    $('#when_uploaded').css('display', 'none')
  }
}

function removeProfilePic() {
  var form_data = new FormData
  document.getElementById('pp_error_2').classList.add('hide')
    document.getElementById('pp_error_3').classList.add('hide')
    document.getElementById('pp_error_1').classList.add('hide')
    document.getElementById('pp_success_1').classList.add('hide')
    document.getElementById('pp_success_2').classList.add('hide')
  document.getElementById('ppupload').classList.remove('ppadd')
  document.getElementById('ppupload').classList.add('ppadd')
  $.ajax({
    url: "/library/remove_profile_picture.php",
    dataType: 'html',
    cache: false,
    contentType: false,
    processData: false,
    data: form_data,
    type: 'post',
    success: function(data) {
      ProfilePicture = false
      document.getElementById('ppreset').classList.add('hide')
      document.getElementById('pp_success_2').classList.remove('hide')
      document.getElementById('when_uploaded').classList.remove('show')
      document.getElementById('when_uploaded').classList.add('hide')
      $('#when_uploaded').css('display', '')
      document.getElementById('when_uploaded').innerHTML = " | <a class=\"jslink\" onclick=\"uploadProfilePic()\">" + lang_pictures_add + "</a>"
    }});
}

if (ProfilePicture == false) {
  document.getElementById('ppreset').classList.add('hide')
}

if (document.getElementById('profilepic').value == "") {
  document.getElementById('when_uploaded').classList.add('hide')
}

$('#delete').fadeOut(0)

function deleteAccount() {
  document.getElementById('deletecnt').classList.add('hide')
  form_data = new FormData
  $.ajax({
    url: "/library/delete_account.php",
    dataType: 'html',
    cache: false,
    contentType: false,
    processData: false,
    data: form_data,
    type: 'post',
    success: function(data) {
      document.cookie = ""
      location.href ="/"
    }
  })
}

function sendDeleteEmail() {
  document.getElementById('deletecnt').classList.add('hide')
  form_data = new FormData
  form_data.append('lang', langprop);
  $.ajax({
    url: "/library/send_delete_email.php",
    dataType: 'html',
    cache: false,
    contentType: false,
    processData: false,
    data: form_data,
    type: 'post',
    success: function(data) {
      document.getElementById('deletecnt').classList.remove('hide')
      document.getElementsByClassName('delete_confirm')[0].onclick = undefined;
      document.getElementsByClassName('delete_confirm')[0].classList.add('delete_confirm_validated');
      document.getElementsByClassName('delete_confirm')[0].innerHTML = lang_delete_ems;
      document.getElementsByClassName('delete_cancel')[0].innerHTML = lang_delete_emsok;
    }
  })
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

if ( (client.compatibility.mobileClient() || client.compatibility.desktopClient()) && (client.isMobile() == false && client.isDesktop() == false) ) {
  document.getElementById('downloadlink').classList.remove('hide');
}

function dlJson() {
  document.getElementById('dl_json').classList.add('hide');
  document.getElementById('dl_ini').classList.add('hide');
  document.getElementById('dl_xml').classList.add('hide');
  document.getElementById('dl_csv').classList.add('hide');

  document.getElementById('dl_json').classList.remove('hide');

  document.getElementById('dlsel_json').innerHTML = "<a onclick=\"dlJson()\">JSON</a>";
  document.getElementById('dlsel_ini').innerHTML = "<a onclick=\"dlIni()\">INI</a>";
  document.getElementById('dlsel_xml').innerHTML = "<a onclick=\"dlXml()\">XML</a>";
  document.getElementById('dlsel_csv').innerHTML = "<a onclick=\"dlCsv()\">CSV</a>";

  document.getElementById('dlsel_json').innerHTML = "JSON";
}

function dlIni() {
  document.getElementById('dl_json').classList.add('hide');
  document.getElementById('dl_ini').classList.add('hide');
  document.getElementById('dl_xml').classList.add('hide');
  document.getElementById('dl_csv').classList.add('hide');

  document.getElementById('dl_ini').classList.remove('hide');

  document.getElementById('dlsel_json').innerHTML = "<a onclick=\"dlJson()\">JSON</a>";
  document.getElementById('dlsel_ini').innerHTML = "<a onclick=\"dlIni()\">INI</a>";
  document.getElementById('dlsel_xml').innerHTML = "<a onclick=\"dlXml()\">XML</a>";
  document.getElementById('dlsel_csv').innerHTML = "<a onclick=\"dlCsv()\">CSV</a>";

  document.getElementById('dlsel_ini').innerHTML = "INI";
}

function dlXml() {
  document.getElementById('dl_json').classList.add('hide');
  document.getElementById('dl_ini').classList.add('hide');
  document.getElementById('dl_xml').classList.add('hide');
  document.getElementById('dl_csv').classList.add('hide');

  document.getElementById('dl_xml').classList.remove('hide');

  document.getElementById('dlsel_json').innerHTML = "<a onclick=\"dlJson()\">JSON</a>";
  document.getElementById('dlsel_ini').innerHTML = "<a onclick=\"dlIni()\">INI</a>";
  document.getElementById('dlsel_xml').innerHTML = "<a onclick=\"dlXml()\">XML</a>";
  document.getElementById('dlsel_csv').innerHTML = "<a onclick=\"dlCsv()\">CSV</a>";

  document.getElementById('dlsel_xml').innerHTML = "XML";
}

function dlCsv() {
  document.getElementById('dl_json').classList.add('hide');
  document.getElementById('dl_ini').classList.add('hide');
  document.getElementById('dl_xml').classList.add('hide');
  document.getElementById('dl_csv').classList.add('hide');

  document.getElementById('dl_csv').classList.remove('hide');

  document.getElementById('dlsel_json').innerHTML = "<a onclick=\"dlJson()\">JSON</a>";
  document.getElementById('dlsel_ini').innerHTML = "<a onclick=\"dlIni()\">INI</a>";
  document.getElementById('dlsel_xml').innerHTML = "<a onclick=\"dlXml()\">XML</a>";
  document.getElementById('dlsel_csv').innerHTML = "<a onclick=\"dlCsv()\">CSV</a>";

  document.getElementById('dlsel_csv').innerHTML = "CSV";
}

$("#settings_timedate").hide(0);

function showcat(element) {
  document.getElementsByTagName('body')[0].classList.add('noscroll')
  $("#settings_home").hide(500);
  $("#settings_appearance").hide(500);
  $("#settings_password").hide(500);
  $("#settings_datapictures").hide(500);
  $("#settings_name").hide(500);
  $("#settings_privacy").hide(500);
  $("#settings_friends").hide(500);
  $("#settings_timedate").hide(500);
  $("#settings_about").hide(500);

  let stateObj = {
    foo: ".",
};

history.pushState(stateObj, "page 2", "#" + element);

  setTimeout(() => {
    $("#settings_" + element).show(500);
    setTimeout(() => {
      document.getElementsByTagName('body')[0].classList.remove('noscroll')
    }, 500)
  }, 500)
}

let stateObj = {
  foo: ".",
};

history.pushState(stateObj, "page 2", "#home");