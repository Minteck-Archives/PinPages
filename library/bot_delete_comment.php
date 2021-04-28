<?php

if (isset($_POST['comuser'])) {
    $comuser = $_POST['comuser'];
} else {
    echo "Missing!";
    exit;
}

if (isset($_POST['comid'])) {
    $comid = $_POST['comid'];
} else {
    echo "Missing!";
    exit;
}

if (isset($_POST['postuser'])) {
    $postuser = $_POST['postuser'];
} else {
    echo "Missing!";
    exit;
}

if (isset($_POST['comuser'])) {
    $comuser = $_POST['comuser'];
} else {
    echo "Missing!";
    exit;
}

if (isset($_POST['comtext'])) {
    $comtext = $_POST['comtext'];
} else {
    echo "Missing!";
    exit;
}

if (isset($_POST['postid'])) {
    $postid = $_POST['postid'];
} else {
    echo "Missing!";
    exit;
}

if (isset($_POST['postuser'])) {
    $postuser = $_POST['postuser'];
} else {
    echo "Missing!";
    exit;
}

$user = strtok($_COOKIE['token'], '_');

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token'])) {} else {
    header("HTTP/1.1 401 Invalid Token");
    exit;
}

if ($comuser != $user) {
    echo("Invalid user!");
    exit;
}

$botroot = $_SERVER['DOCUMENT_ROOT'] . "/bots";

$comments = file_get_contents($botroot . "/data/" . $postuser . "/" . $postid . "/comments_new");
$comments_new = str_replace($comuser . "#" . $comtext . "#" . $comid, "", $comments);
file_put_contents($botroot . "/data/" . $postuser . "/" . $postid . "/comments_new", $comments_new);
header("HTTP/1.1 200 API Request Done");