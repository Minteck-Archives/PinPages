function submitSignup() {
    $("#signup_error_1").fadeOut(500)
    $("#signup_error_2").fadeOut(500)
    $("#signup_error_3").fadeOut(500)
    $("#signup_error_4").fadeOut(500)
    $("#signup_error_5").fadeOut(500)
    $("#signup_error_6").fadeOut(500)
    $("#signup_error_7").fadeOut(500)
    $("#signup_error_8").fadeOut(500)
    $("#signup_error_9").fadeOut(500)
    $("#signup_error_10").fadeOut(500)
    document.forms['signup'].signup_username.disabled = true;
    document.forms['signup'].signup_realname.disabled = true;
    document.forms['signup'].signup_password_first.disabled = true;
    document.forms['signup'].signup_password_repeat.disabled = true;
    document.forms['signup'].signup_submit.disabled = true;
    $("#loader").fadeIn(500)

    var signupData = {
        username: document.forms['signup'].signup_username.value,
        realname: document.forms['signup'].signup_realname.value,
        password: document.forms['signup'].signup_password_first.value,
        password_confirm: document.forms['signup'].signup_password_repeat.value,
        lang: langprop
    }

    if (signupData.username == "") {
        $("#signup_error_1").fadeIn(500)
        $("#loader").fadeOut(500)
        document.forms['signup'].signup_username.disabled = false;
        document.forms['signup'].signup_realname.disabled = false;
        document.forms['signup'].signup_password_first.disabled = false;
        document.forms['signup'].signup_password_repeat.disabled = false;
        document.forms['signup'].signup_submit.disabled = false;
        return;
    }

    if (signupData.realname == "") {
        $("#signup_error_2").fadeIn(500)
        $("#loader").fadeOut(500)
        document.forms['signup'].signup_username.disabled = false;
        document.forms['signup'].signup_realname.disabled = false;
        document.forms['signup'].signup_password_first.disabled = false;
        document.forms['signup'].signup_password_repeat.disabled = false;
        document.forms['signup'].signup_submit.disabled = false;
        return;
    }

    if (signupData.password == "") {
        $("#signup_error_3").fadeIn(500)
        $("#loader").fadeOut(500)
        document.forms['signup'].signup_username.disabled = false;
        document.forms['signup'].signup_realname.disabled = false;
        document.forms['signup'].signup_password_first.disabled = false;
        document.forms['signup'].signup_password_repeat.disabled = false;
        document.forms['signup'].signup_submit.disabled = false;
        return;
    }

    if (signupData.password_confirm == "") {
        $("#signup_error_4").fadeIn(500)
        $("#loader").fadeOut(500)
        document.forms['signup'].signup_username.disabled = false;
        document.forms['signup'].signup_realname.disabled = false;
        document.forms['signup'].signup_password_first.disabled = false;
        document.forms['signup'].signup_password_repeat.disabled = false;
        document.forms['signup'].signup_submit.disabled = false;
        return;
    }

    if (signupData.password_confirm == signupData.password_confirm) {} else {
        $("#signup_error_5").fadeIn(500)
        $("#loader").fadeOut(500)
        document.forms['signup'].signup_username.disabled = false;
        document.forms['signup'].signup_realname.disabled = false;
        document.forms['signup'].signup_password_first.disabled = false;
        document.forms['signup'].signup_password_repeat.disabled = false;
        document.forms['signup'].signup_submit.disabled = false;
        return;
    }

    ssldata = new FormData()
    ssldata.append("username", signupData.username)
    ssldata.append("realname", signupData.realname)
    ssldata.append("password", signupData.password)
    ssldata.append("passconf", signupData.password_confirm)
    ssldata.append("lang", signupData.lang)
    request = "/library/signup.php"

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
            $("#loader").fadeOut(500)
            if (statusText == "Error 7") {
                $("#signup_error_7").fadeIn(500)
                document.forms['signup'].signup_username.disabled = false;
                document.forms['signup'].signup_realname.disabled = false;
                document.forms['signup'].signup_password_first.disabled = false;
                document.forms['signup'].signup_password_repeat.disabled = false;
                document.forms['signup'].signup_submit.disabled = false;
                return;
            }
            if (statusText == "Error 8") {
                $("#signup_error_8").fadeIn(500)
                document.forms['signup'].signup_username.disabled = false;
                document.forms['signup'].signup_realname.disabled = false;
                document.forms['signup'].signup_password_first.disabled = false;
                document.forms['signup'].signup_password_repeat.disabled = false;
                document.forms['signup'].signup_submit.disabled = false;
                return;
            }
            if (statusText == "Error 6") {
                $("#signup_error_6").fadeIn(500)
                document.forms['signup'].signup_username.disabled = false;
                document.forms['signup'].signup_realname.disabled = false;
                document.forms['signup'].signup_password_first.disabled = false;
                document.forms['signup'].signup_password_repeat.disabled = false;
                document.forms['signup'].signup_submit.disabled = false;
                return;
            }
            if (statusText == "Error 9") {
                $("#signup_error_9").fadeIn(500)
                document.forms['signup'].signup_username.disabled = false;
                document.forms['signup'].signup_realname.disabled = false;
                document.forms['signup'].signup_password_first.disabled = false;
                document.forms['signup'].signup_password_repeat.disabled = false;
                document.forms['signup'].signup_submit.disabled = false;
                return;
            }
            if (statusText.startsWith("ok")) {
                location.href = callback
            } else {
                $("#signup_error_10").fadeIn(500)
                document.forms['signup'].signup_username.disabled = false;
                document.forms['signup'].signup_realname.disabled = false;
                document.forms['signup'].signup_password_first.disabled = false;
                document.forms['signup'].signup_password_repeat.disabled = false;
                document.forms['signup'].signup_submit.disabled = false;
                return;
            }
        }})
}

function submitForm() {
    $("#login_error_1").fadeOut(500)
    $("#login_error_2").fadeOut(500)
    $("#login_error_3").fadeOut(500)
    $("#login_error_4").fadeOut(500)
    $("#login_error_5").fadeOut(500)
    $("#login_error_6").fadeOut(500)
    $("#login_error_7").fadeOut(500)
    $("#login_error_8").fadeOut(500)
    $("#login_error_9").fadeOut(500)
    $("#login_error_10").fadeOut(500)
    document.forms['login_form'].username.disabled = true;
    document.forms['login_form'].password.disabled = true;
    document.forms['login_form'].passwordrepeat.disabled = true;
    document.forms['login_form'].passwordrepeat.disabled = true;
    document.forms['login_form'].nickname.disabled = true;
    document.forms['login_form'].submit.disabled = true;

    if (document.forms['login_form'].username.value == "" || document.forms['login_form'].password.value == "") {
        document.forms['login_form'].username.disabled = false;
        document.forms['login_form'].password.disabled = false;
        document.forms['login_form'].passwordrepeat.disabled = false;
        document.forms['login_form'].passwordrepeat.disabled = false;
        document.forms['login_form'].nickname.disabled = false;
        document.forms['login_form'].submit.disabled = false;
        return;
    }

    var loginData = {
        username: document.forms['login_form'].username.value,
        password: document.forms['login_form'].password.value,
        passwordrepeat: document.forms['login_form'].passwordrepeat.value,
        nickname: document.forms['login_form'].nickname.value,
        lang: langprop
    }

    ssldata = new FormData()
    ssldata.append("username", loginData.username)
    ssldata.append("password", loginData.password)
    ssldata.append("passconf", loginData.passwordrepeat)
    ssldata.append("realname", loginData.nickname)
    ssldata.append("lang", loginData.lang)
    request = "/library/signup.php"

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
                document.forms['login_form'].passwordrepeat.disabled = false;
                document.forms['login_form'].passwordrepeat.disabled = false;
                document.forms['login_form'].nickname.disabled = false;
                document.forms['login_form'].submit.disabled = false;
                document.forms['login_form'].password.value = "";
                document.forms['login_form'].passwordrepeat.value = "";
                return;
            }
            if (statusText == "Error 2") {
                $("#login_error_2").fadeIn(500)
                document.forms['login_form'].username.disabled = false;
                document.forms['login_form'].password.disabled = false;
                document.forms['login_form'].passwordrepeat.disabled = false;
                document.forms['login_form'].passwordrepeat.disabled = false;
                document.forms['login_form'].nickname.disabled = false;
                document.forms['login_form'].submit.disabled = false;
                document.forms['login_form'].password.value = "";
                document.forms['login_form'].passwordrepeat.value = "";
                return;
            }
            if (statusText == "Error 3") {
                $("#login_error_3").fadeIn(500)
                document.forms['login_form'].username.disabled = false;
                document.forms['login_form'].password.disabled = false;
                document.forms['login_form'].passwordrepeat.disabled = false;
                document.forms['login_form'].passwordrepeat.disabled = false;
                document.forms['login_form'].nickname.disabled = false;
                document.forms['login_form'].submit.disabled = false;
                document.forms['login_form'].password.value = "";
                document.forms['login_form'].passwordrepeat.value = "";
                return;
            }
            if (statusText == "Error 4") {
                $("#login_error_4").fadeIn(500)
                document.forms['login_form'].username.disabled = false;
                document.forms['login_form'].password.disabled = false;
                document.forms['login_form'].passwordrepeat.disabled = false;
                document.forms['login_form'].passwordrepeat.disabled = false;
                document.forms['login_form'].nickname.disabled = false;
                document.forms['login_form'].submit.disabled = false;
                document.forms['login_form'].password.value = "";
                document.forms['login_form'].passwordrepeat.value = "";
                return;
            }
            if (statusText == "Error 5") {
                $("#login_error_5").fadeIn(500)
                document.forms['login_form'].username.disabled = false;
                document.forms['login_form'].password.disabled = false;
                document.forms['login_form'].passwordrepeat.disabled = false;
                document.forms['login_form'].passwordrepeat.disabled = false;
                document.forms['login_form'].nickname.disabled = false;
                document.forms['login_form'].submit.disabled = false;
                document.forms['login_form'].password.value = "";
                document.forms['login_form'].passwordrepeat.value = "";
                return;
            }
            if (statusText == "Error 6") {
                $("#login_error_6").fadeIn(500)
                document.forms['login_form'].username.disabled = false;
                document.forms['login_form'].password.disabled = false;
                document.forms['login_form'].passwordrepeat.disabled = false;
                document.forms['login_form'].passwordrepeat.disabled = false;
                document.forms['login_form'].nickname.disabled = false;
                document.forms['login_form'].submit.disabled = false;
                document.forms['login_form'].password.value = "";
                document.forms['login_form'].passwordrepeat.value = "";
                return;
            }
            if (statusText == "Error 7") {
                $("#login_error_7").fadeIn(500)
                document.forms['login_form'].username.disabled = false;
                document.forms['login_form'].password.disabled = false;
                document.forms['login_form'].passwordrepeat.disabled = false;
                document.forms['login_form'].passwordrepeat.disabled = false;
                document.forms['login_form'].nickname.disabled = false;
                document.forms['login_form'].submit.disabled = false;
                document.forms['login_form'].password.value = "";
                document.forms['login_form'].passwordrepeat.value = "";
                return;
            }
            if (statusText == "Error 8") {
                $("#login_error_8").fadeIn(500)
                document.forms['login_form'].username.disabled = false;
                document.forms['login_form'].password.disabled = false;
                document.forms['login_form'].passwordrepeat.disabled = false;
                document.forms['login_form'].passwordrepeat.disabled = false;
                document.forms['login_form'].nickname.disabled = false;
                document.forms['login_form'].submit.disabled = false;
                document.forms['login_form'].password.value = "";
                document.forms['login_form'].passwordrepeat.value = "";
                return;
            }
            if (statusText == "Error 9") {
                $("#login_error_9").fadeIn(500)
                document.forms['login_form'].username.disabled = false;
                document.forms['login_form'].password.disabled = false;
                document.forms['login_form'].passwordrepeat.disabled = false;
                document.forms['login_form'].passwordrepeat.disabled = false;
                document.forms['login_form'].nickname.disabled = false;
                document.forms['login_form'].submit.disabled = false;
                document.forms['login_form'].password.value = "";
                document.forms['login_form'].passwordrepeat.value = "";
                return;
            }
            if (statusText == "Error 10") {
                $("#login_error_10").fadeIn(500)
                document.forms['login_form'].username.disabled = false;
                document.forms['login_form'].password.disabled = false;
                document.forms['login_form'].passwordrepeat.disabled = false;
                document.forms['login_form'].passwordrepeat.disabled = false;
                document.forms['login_form'].nickname.disabled = false;
                document.forms['login_form'].submit.disabled = false;
                document.forms['login_form'].password.value = "";
                document.forms['login_form'].passwordrepeat.value = "";
                return;
            }
            if (statusText.startsWith("ok")) {
                location.href = callback;
            } else {
                $("#login_error_10").fadeIn(500)
                document.forms['login_form'].username.disabled = false;
                document.forms['login_form'].password.disabled = false;
                document.forms['login_form'].passwordrepeat.disabled = false;
                document.forms['login_form'].passwordrepeat.disabled = false;
                document.forms['login_form'].nickname.disabled = false;
                document.forms['login_form'].submit.disabled = false;
                document.forms['login_form'].password.value = "";
                document.forms['login_form'].passwordrepeat.value = "";
                return;
            }
        }
    });
}