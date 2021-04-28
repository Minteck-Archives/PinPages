window.onload = () => {
    ssldata = new FormData()
    ssldata.append("token", token)
    ssldata.append("lang", langprop)
    request = "/library/delete_account_mail.php"

    $.ajax({
        url: request,
        dataType: 'html',
        cache: false,
        data: ssldata,
        contentType: false,
        processData: false,
        type: 'post',
        success: function (data) {
            document.getElementById('progress').classList.add('hide');
            if (data.startsWith("ok")) {
                document.getElementById('success').classList.remove('hide');
                document.cookie = "token=";
                location.href = "/";
            } else {
                document.getElementById('error').classList.remove('hide');
            }
        },
        error: function (data) {
            document.getElementById('progress').classList.add('hide');
            document.getElementById('error').classList.remove('hide');
        }
    });
}