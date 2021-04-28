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

function showConfirm() {
    document.getElementById('ep_editdiv').classList.add('hide')
    document.getElementById('ep_deldiv').classList.remove('hide')
}

function cancel() {
    document.getElementById('ep_editdiv').classList.remove('hide')
    document.getElementById('ep_deldiv').classList.add('hide')
}

function toggleVerification() {
    document.getElementById('ep_procdiv').classList.remove('hide')
    document.getElementById('ep_deldiv').classList.add('hide')
    request = "/library/moderate_togglepartner.php"
    ssldata = new FormData
    ssldata.append('user', suser)
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