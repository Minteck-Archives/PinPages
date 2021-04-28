save_threads = 0;
receive_threads = 0;
oldcontent = "";

if (editable) {} else {
    document.getElementById('boardbox').disabled = true;
}

function saveBoard() {
    document.getElementById('boardstatus').innerHTML = lang_sync_saving;
    save_threads = save_threads + 1;
    ssldata = new FormData()
    ssldata.append("user", user)
    ssldata.append("content", document.getElementById('boardbox').value);
    request = "/library/board_save.php"

    $.ajax({
        url: request,
        dataType: 'html',
        cache: false,
        data: ssldata,
        contentType: false,
        processData: false,
        type: 'post',
        success: function (data) {
            if (data.startsWith("ok=")) {
                oldcontent = document.getElementById('boardbox').value;
                setTimeout(() => {
                    if (save_threads <= 1) {
                        users = data.replace("ok=", "")
                        if (typeof users != "undefined") {
                            if ((users - 1 + 1) > 1) {
                                document.getElementById('boardstatus').innerHTML = lang_sync_ok + lang_sync_users1 + users + lang_sync_users3;
                            } else {
                                document.getElementById('boardstatus').innerHTML = lang_sync_ok + lang_sync_users1 + users + lang_sync_users2;
                            }
                        } else {
                            document.getElementById('boardstatus').innerHTML = lang_sync_ok;
                        }
                        save_threads = 0;
                    } else {
                        save_threads = save_threads - 1;
                    }
                }, 1500)
            } else {
                if (save_threads <= 1) {
                    document.getElementById('boardstatus').innerHTML = lang_sync_err;
                    save_threads = 0;
                } else {
                    save_threads = save_threads - 1;
                }
            }
        },
        error: function (data) {
            if (save_threads <= 1) {
                document.getElementById('boardstatus').innerHTML = lang_sync_conn;
                save_threads = 0;
            } else {
                save_threads = save_threads - 1;
            }
        }
    });
}

function getBoard() {
    if (save_threads == 0) {
        receive_threads = receive_threads + 1;
        ssldata = new FormData()
        ssldata.append("user", user)
        request = "/library/board_get.php"

        $.ajax({
            url: request,
            dataType: 'html',
            cache: false,
            data: ssldata,
            contentType: false,
            processData: false,
            type: 'post',
            success: function (data) {
                if (data.startsWith("ok|")) {
                    dataparts = data.split("|");
                    document.getElementById('boardbox').value = dataparts[2].replace("=", "");
                    users = dataparts[1];
                    if (receive_threads <= 1) {
                        if (typeof users != "undefined") {
                            if ((users - 1 + 1) > 1) {
                                document.getElementById('boardstatus').innerHTML = lang_sync_ok + lang_sync_users1 + users + lang_sync_users3;
                            } else {
                                document.getElementById('boardstatus').innerHTML = lang_sync_ok + lang_sync_users1 + users + lang_sync_users2;
                            }
                        } else {
                            document.getElementById('boardstatus').innerHTML = lang_sync_ok;
                        }
                        receive_threads = 0;
                    } else {
                        receive_threads = receive_threads - 1;
                    }
                } else {
                    if (receive_threads <= 1) {
                        document.getElementById('boardstatus').innerHTML = lang_sync_err;
                        receive_threads = 0;
                    } else {
                        receive_threads = receive_threads - 1;
                    }
                }
            },
            error: function (data) {
                if (receive_threads <= 1) {
                    document.getElementById('boardstatus').innerHTML = lang_sync_conn;
                    receive_threads = 0;
                } else {
                    receive_threads = receive_threads - 1;
                }
            }
        });
    }
}

setInterval(getBoard, 2000);
// setInterval(getBoard, 1);