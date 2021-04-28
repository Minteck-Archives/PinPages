function saveSettings() {
    document.getElementById("autoclear").disabled = true;
    document.getElementById("font").disabled = true;
    document.getElementById("colorscheme").disabled = true;
    ssldata = new FormData()
    if (document.getElementById("autoclear").checked) {
        ssldata.append("autoclear", "true");
    } else {
        ssldata.append("autoclear", "false");
    }
    if (document.getElementById("font").value == "1") {
        ssldata.append("font", "true");
    } else {
        ssldata.append("font", "false");
    }
    if (document.getElementById("colorscheme").value == "1") {
        ssldata.append("color", "true");
    } else {
        ssldata.append("color", "false");
    }
    request = "/library/board_savesettings.php"

    $.ajax({
        url: request,
        dataType: 'html',
        cache: false,
        data: ssldata,
        contentType: false,
        processData: false,
        type: 'post',
        success: function (data) {
            if (data.startsWith("ok")) {
                document.getElementById("autoclear").disabled = false;
                document.getElementById("font").disabled = false;
                document.getElementById("colorscheme").disabled = false;
            } else {
                alert(lang_err)
            }
        },
        error: function (data) {
            alert(lang_err)
        }
    });
}