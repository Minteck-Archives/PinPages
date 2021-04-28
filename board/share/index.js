function updatePerms(user) {
    document.getElementById("perms-" + user).disabled = true;
    ssldata = new FormData()
    if (document.getElementById("perms-" + user).value == "1") {
        ssldata.append("perms", "1");
    } else {
        ssldata.append("perms", "0");
    }
    ssldata.append("user", user)
    request = "/library/board_updateperms.php"

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
                document.getElementById("perms-" + user).disabled = false;
            } else {
                location.reload();
            }
        },
        error: function (data) {
            location.reload();
        }
    });
}

function removeUser(user) {
    document.getElementById("page").classList.add("hide");
    document.getElementById("loader1").classList.remove("hide");
    ssldata = new FormData()
    ssldata.append("user", user)
    request = "/library/board_removeshare.php"

    $.ajax({
        url: request,
        dataType: 'html',
        cache: false,
        data: ssldata,
        contentType: false,
        processData: false,
        type: 'post',
        success: function (data) {
            location.reload();
        },
        error: function (data) {
            location.reload();
        }
    });
}

function addShare() {
    document.getElementById("addshare-username").disabled = true;
    document.getElementById("addshare-perms").disabled = true;
    ssldata = new FormData()
    if (document.getElementById("addshare-perms").value == "1") {
        ssldata.append("perms", "1");
    } else {
        ssldata.append("perms", "0");
    }
    ssldata.append("user", document.getElementById("addshare-username").value)
    request = "/library/board_createshare.php"

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
                document.getElementById("addshare-perms").value = "1"
                document.getElementById("addshare-username").value = ""
                location.reload()
            } else {
                location.reload();
            }
        },
        error: function (data) {
            location.reload();
        }
    });
}