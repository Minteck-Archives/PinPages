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

function saveGroup() {
    document.getElementById('group').disabled = true;
    request = "/library/moderate_savegroup.php"
    ssldata = new FormData
    ssldata.append('user', suser)
    ssldata.append('group', document.getElementById('group').value)
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
            document.getElementById('group').disabled = false;
        }
    })
}