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

foreach ($shares as $share) {
    $index = $index + 1;
    $shareparts = explode("|", $share);
    if ($shareparts[0] == $suser) {
        $shareparts = [""];
        $shares[$index] = implode("|", $shareparts);
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/settings/shares", implode("\n", $shares));
    }
}

$index = -1;
foreach ($ushares as $share) {
    $index = $index + 1;
    if ($share == $user) {
        $ushares[$index] = "";
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/board/shared", implode("\n", $ushares));
    }
}

echo("ok");