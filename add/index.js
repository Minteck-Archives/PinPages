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
        location.href = "/search/?q=" + document.getElementById("searchbar").value.trim() + "&lang=" + langprop
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
    request = "/library/create_post.php"
    ssldata = new FormData
    ssldata.append('text', text)
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
    if (count >= 1000)
    {
        if (count > 1000) {
            document.getElementById('ep_chars').innerHTML = "1000"
            document.getElementById('ep_text').value = oldvalue
            document.getElementById('ep_chars').classList.add('ep_climit')
            document.getElementById('ep_save').classList.add('hide')
        } else {
            document.getElementById('ep_chars').innerHTML = document.getElementById('ep_text').value.length
            document.getElementById('ep_chars').classList.add('ep_climit')
            oldvalue = document.getElementById('ep_text').value
            document.getElementById('ep_save').classList.remove('hide')
        }
    } else {
        document.getElementById('ep_chars').innerHTML = document.getElementById('ep_text').value.length
        oldvalue = document.getElementById('ep_text').value
        document.getElementById('ep_save').classList.remove('hide')
    }
}

function deletePost() {
    document.getElementById('ep_editdiv').classList.add('hide')
    document.getElementById('ep_deldiv').classList.remove('hide')
}

function cancelDelete() {
    document.getElementById('ep_editdiv').classList.remove('hide')
    document.getElementById('ep_deldiv').classList.add('hide')
}

function confirmDelete() {
    request = "/library/delete_post.php"
    ssldata = new FormData
    ssldata.append('id', id)
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

countChars()
