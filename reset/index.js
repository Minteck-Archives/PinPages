function submitForm() {
    $("#login_error_1").fadeOut(500)
    $("#login_error_2").fadeOut(500)
    $("#login_success").fadeOut(500)
    document.forms['login_form'].username.disabled = true;
    document.forms['login_form'].email.disabled = true;
    document.forms['login_form'].submit.disabled = true;

    if (document.forms['login_form'].username.value == "" || document.forms['login_form'].email.value == "") {
        document.forms['login_form'].username.disabled = false;
        document.forms['login_form'].email.disabled = false;
        return;
    }

    var loginData = {
        username: document.forms['login_form'].username.value,
        email: document.forms['login_form'].email.value,
        lang: langprop
    }

    ssldata = new FormData()
    ssldata.append("username", loginData.username)
    ssldata.append("email", loginData.email)
    ssldata.append("lang", loginData.lang)
    request = "/library/send_reset_email.php"

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
            if (statusText == "Error 1") {
                $("#login_error_1").fadeIn(500)
                document.forms['login_form'].username.disabled = false;
                document.forms['login_form'].email.disabled = false;
                document.forms['login_form'].submit.disabled = false;
                return;
            }
            if (statusText == "Error 2") {
                $("#login_error_2").fadeIn(500)
                document.forms['login_form'].username.disabled = false;
                document.forms['login_form'].email.disabled = false;
                document.forms['login_form'].submit.disabled = false;
                return;
            }
            $("#login_success").fadeIn(500)
            document.forms['login_form'].username.disabled = false;
            document.forms['login_form'].email.disabled = false;
            document.forms['login_form'].submit.disabled = false;
            return;
        }
    });
}