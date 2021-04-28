function submitForm() {
    $("#login_error_1").fadeOut(500)
    $("#login_error_2").fadeOut(500)
    $("#login_error_3").fadeOut(500)
    $("#login_error_4").fadeOut(500)
    document.forms['login_form'].username.disabled = true;
    document.forms['login_form'].password.disabled = true;
    document.forms['login_form'].submit.disabled = true;

    if (document.forms['login_form'].username.value == "" || document.forms['login_form'].password.value == "") {
        document.forms['login_form'].username.disabled = false;
        document.forms['login_form'].password.disabled = false;
        document.forms['login_form'].submit.disabled = false;
        return;
    }

    var loginData = {
        username: document.forms['login_form'].username.value,
        password: document.forms['login_form'].password.value,
        lang: langprop
    }

    ssldata = new FormData()
    ssldata.append("username", loginData.username)
    ssldata.append("password", loginData.password)
    ssldata.append("lang", loginData.lang)
    request = "/library/login.php"

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
                document.forms['login_form'].password.disabled = false;
                document.forms['login_form'].submit.disabled = false;
                document.forms['login_form'].password.value = "";
                return;
            }
            if (statusText == "Error 2") {
                $("#login_error_2").fadeIn(500)
                document.forms['login_form'].username.disabled = false;
                document.forms['login_form'].password.disabled = false;
                document.forms['login_form'].submit.disabled = false;
                document.forms['login_form'].password.value = "";
                return;
            }
            if (statusText == "Error 4") {
                $("#login_error_4").fadeIn(500)
                document.forms['login_form'].username.disabled = false;
                document.forms['login_form'].password.disabled = false;
                document.forms['login_form'].submit.disabled = false;
                document.forms['login_form'].password.value = "";
                return;
            }
            if (statusText.startsWith("ok")) {
                location.href = callback;
            } else {
                $("#login_error_3").fadeIn(500)
                document.forms['login_form'].username.disabled = false;
                document.forms['login_form'].password.disabled = false;
                document.forms['login_form'].submit.disabled = false;
                document.forms['login_form'].password.value = "";
                return;
            }
        }
    });
}