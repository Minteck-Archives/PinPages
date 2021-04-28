<?php

$user = strtok($_COOKIE['token'], '_');

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token'])) {} else {
    header("HTTP/1.1 401 Invalid Token");
    exit;
}

if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board")) {
    die("No Board Profile");
}

if (isset($_POST['autoclear'])) {
    $ac = $_POST['autoclear'];
} else {
    die("No Autoclear");
}

if (isset($_POST['font'])) {
    $font = $_POST['font'];
} else {
    die("No Font");
}

if (isset($_POST['color'])) {
    $color = $_POST['color'];
} else {
    die("No Color scheme");
}

if ($color == "true" || $color == "false") {
    if ($color == "true") {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/settings/color", "1");
    } else {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/settings/color", "0");
    }
} else {
    die("Invalid color");
}

if ($font == "true" || $font == "false") {
    if ($font == "true") {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/settings/font", "1");
    } else {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/settings/font", "0");
    }
} else {
    die("Invalid font");
}

if ($ac == "true" || $ac == "false") {
    if ($ac == "true") {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/settings/autoclear", "1");
    } else {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/settings/autoclear", "0");
    }
} else {
    die("Invalid autoclear");
}

die("ok");