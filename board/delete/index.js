function deleteAccount() {
    document.getElementsByClassName("question")[0].classList.add('hide');
    document.getElementsByClassName("answer")[0].classList.remove('hide');
    ssldata = new FormData()
    request = "/library/board_deleteprofile.php"

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
                location.href = "/board";
            } else {
                alert(lang_err)
            }
        },
        error: function (data) {
            alert(lang_err)
        }
    });
}