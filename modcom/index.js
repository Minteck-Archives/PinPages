// var input = document.getElementById("searchbar");
var oldcount

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

function savePost() {
    document.getElementById('ep_text').disabled = true;
    document.getElementById('ep_lname').disabled = true;
    document.getElementById('ep_ltarg').disabled = true;
    text = document.getElementById('ep_text').value
    lname = document.getElementById('ep_lname').value
    ltarg = document.getElementById('ep_ltarg').value
    request = "/library/save_post.php"
    ssldata = new FormData
    ssldata.append('text', text)
    ssldata.append('id', id)
    ssldata.append('lname', lname)
    ssldata.append('ltarg', ltarg)
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
            location.href = "/page/?lang=" + langprop
        }
    })
}

function countChars() {
    count = document.getElementById('ep_text').value.length
    document.getElementById('ep_chars').classList.remove('ep_climit')
    if (count >= 500)
    {
        if (count > 500) {
            document.getElementById('ep_chars').innerHTML = "500"
            document.getElementById('ep_text').value = oldvalue
            document.getElementById('ep_chars').classList.add('ep_climit')
        } else {
            document.getElementById('ep_chars').innerHTML = document.getElementById('ep_text').value.length
            document.getElementById('ep_chars').classList.add('ep_climit')
            oldvalue = document.getElementById('ep_text').value
        }
        document.getElementById('ep_save').classList.add('hide')
    } else {
        document.getElementById('ep_chars').innerHTML = document.getElementById('ep_text').value.length
        oldvalue = document.getElementById('ep_text').value
        document.getElementById('ep_save').classList.remove('hide')
    }
}

function removePost() {
    document.getElementById('ep_editdiv').classList.add('hide')
    document.getElementById('ep_deldiv').classList.remove('hide')
    document.getElementById('dact1').classList.add('hide')
    document.getElementById('dact2').classList.remove('hide')
}

function disableComments() {
    document.getElementById('ep_editdiv').classList.add('hide')
    document.getElementById('ep_deldiv').classList.remove('hide')
    document.getElementById('dact1').classList.remove('hide')
    document.getElementById('dact2').classList.add('hide')
}

function cancel() {
    location.href = "/page/?lang=" + langprop + "&user=" + postuser
}

function confirmDelete() {
    document.getElementById('ep_procdiv').classList.remove('hide')
    document.getElementById('ep_deldiv').classList.add('hide')
    request = "/library/moderate_deletecomment.php"
    ssldata = new FormData
    ssldata.append('postuser', postuser)
    ssldata.append('comuser', comuser)
    ssldata.append('comid', comid)
    ssldata.append('comtext', comtext)
    ssldata.append('postid', postid)
    if (document.getElementById('reason').value.trim() == "") {
        reason = "???"
    } else {
        reason = document.getElementById('reason').value.trim()
    }
    ssldata.append('reason', reason)
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
            location.href = "/page/?lang=" + langprop + "&user=" + postuser + "#" + postid
        }
    })
}

// function confirmDelete() {
//     document.getElementById('ep_procdiv').classList.remove('hide')
//     document.getElementById('ep_deldiv').classList.add('hide')
    // request = "/library/moderate_deletepost.php"
    // ssldata = new FormData
    // ssldata.append('user', suser)
    // ssldata.append('id', id)
    // if (document.getElementById('reason').value.trim() == "") {
    //     reason = "???"
    // } else {
    //     reason = document.getElementById('reason').value.trim()
    // }
    // ssldata.append('reason', reason)
    // $.ajax({
    //     url: request,
    //     dataType: 'html',
    //     cache: false,
    //     data: ssldata,
    //     contentType: false,
    //     processData: false,
    //     type: 'post',
    //     success: function (data) {
    //         statusText = data;
    //         location.href = "/page/?lang=" + langprop + "&user=" + suser
    //     }
    // })
// }