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

function toggleShowComments(post) {
  if (document.getElementById('comshow_' + post).classList.contains("show_comments")) {
    document.getElementById('comshow_' + post).classList.remove("show_comments")
    document.getElementById('comshow_' + post).classList.remove("show_comments")
    document.getElementById('comshow_' + post).classList.add("hide_comments")
    // document.getElementById('up_commentsph_post' + post).classList.remove("hide")
    $('#up_commentsph_post' + post).show(500);
  } else {
    document.getElementById('comshow_' + post).classList.add("show_comments")
    document.getElementById('comshow_' + post).classList.remove("hide_comments")
    // document.getElementById('up_commentsph_post' + post).classList.add("hide")
    $('#up_commentsph_post' + post).hide(500);
  }
}

// document.getElementsByClassName("up_newcomment").addEventListener("keyup", function(event) {
//   if (event.keyCode === 13) {
//       event.preventDefault();
//       document.getElementById("up_comsubm").click();
//   }
// }); 

function removeComment(comuser,comtext,comid,postid,postuser) {
  $(".editcom").fadeOut("0")
  request = "/library/delete_comment.php"
  ssldata = new FormData
  ssldata.append('comuser', comuser)
  ssldata.append('comtext', comtext)
  ssldata.append('comid', comid)
  ssldata.append('postid', postid)
  ssldata.append('postuser', postuser)
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
      document.getElementById("up_newcomment_post" + postid).value = "";
      location.reload()
    }
})
}

function addComment(id) {
  if (document.getElementById("up_newcomment_post" + id).value.trim() == "") {
    return;
  }
  document.getElementById("up_newcomment_post" + id).disabled = true;
  request = "/library/create_comment.php"
  ssldata = new FormData
  ssldata.append('post', id)
  ssldata.append('user', puser)
  ssldata.append('text', document.getElementById("up_newcomment_post" + id).value.trim())
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
        // document.getElementById('up_commentsph_post' + id).innerHTML = cppic + "<span class=\"up_puser\">" + user + "</span> • " + document.getElementById("up_newcomment_post" + id).value.replace("#", " ").replace("<", "&lt;").replace(">", "&gt;").trim() + "<br>" + document.getElementById('up_commentsph_post' + id).innerHTML
        // document.getElementById("up_newcomment_post" + id).disabled = false;
        document.getElementById("up_newcomment_post" + id).value = "";
        location.reload()
      }
  })
}

function switchMore() {
  if (document.getElementById("more_switch").innerHTML == lang_page_more) {
    $("#up_more").show(500)
    document.getElementById("more_switch").innerHTML = lang_page_less
    document.getElementById("more_switch").classList.add('ms_less')
  } else {
    $("#up_more").hide(500)
    document.getElementById("more_switch").innerHTML = lang_page_more
    document.getElementById("more_switch").classList.remove('ms_less')
  }
}