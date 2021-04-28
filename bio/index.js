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
    text = document.getElementById('ep_text').value
    request = "/library/save_bio.php"
    ssldata = new FormData
    ssldata.append('text', text)
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
            location.href = "/about"
        }
    })
}

function countChars() {
    count = document.getElementById('ep_text').value.length
    document.getElementById('ep_chars').classList.remove('ep_climit')
    if (count >= 5000)
    {
        if (count > 5000) {
            document.getElementById('ep_chars').innerHTML = "5000"
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

function deletePost() {
    document.getElementById('ep_editdiv').classList.add('hide')
    document.getElementById('ep_deldiv').classList.remove('hide')
}

function cancelDelete() {
    document.getElementById('ep_editdiv').classList.remove('hide')
    document.getElementById('ep_deldiv').classList.add('hide')
}

countChars()