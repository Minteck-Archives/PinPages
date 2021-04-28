<?php

$user = strtok($_COOKIE['token'], '_');

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token'])) {} else {
    header("HTTP/1.1 401 Invalid Token");
    exit;
}

if (isset($_POST['user'])) {
    $suser = $_POST['user'];
} else {
    die("No user");
}

if (isset($_POST['perms'])) {
    if ($_POST['perms'] == "0" || $_POST['perms'] == "1") {
        if ($_POST['perms'] == "1") {
            $perms = $_POST['perms'];
        }
    } else {
        die("Invalid perms");
    }
} else {
    die("No perms");
}

if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board")) {
    die("No source board");
}

if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/board")) {
    die("No dest board");
}

$shares = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/settings/shares");
$shares = explode("\n", $shares);
$ushares = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/board/shared");
$ushares = explode("\n", $ushares);
$index = -1;

if (count($shares) >= 1000) {
    die("Too much");
} else {
    array_push($shares, $suser . "|" . $perms);
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/settings/shares", implode("\n", $shares));
    array_push($ushares, $user);
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/board/shared", implode("\n", $ushares));
}

echo("ok");