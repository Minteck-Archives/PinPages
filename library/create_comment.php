<?php

$puser = strtok($_COOKIE['token'], '_');

// echo($_SERVER['DOCUMENT_ROOT'] . "<br>");
// echo($_COOKIE['token'] . "<br>");
// echo($_SERVER['DOCUMENT_ROOT'] . "/data/" . $puser . "/tokens/" . $_COOKIE['token'] . "<br>");
// exit;

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $puser . "/tokens/" . $_COOKIE['token'])) {} else {
    header("HTTP/1.1 401 Invalid Token");
    exit;
}

if (isset($_POST['post']))
{
    $post = $_POST['post'];
}
else
{
    echo("No post");
    exit;
}

if (isset($_POST['user']))
{
    $user = $_POST['user'];
}
else
{
    echo("No user");
    exit;
}

if (isset($_POST['text']))
{
    $text = $_POST['text'];
}
else
{
    echo("No text");
    exit;
}

$newtext = str_replace("#", " ", $text);
$newtext = str_replace("<", "&lt;", $newtext);
$newtext = str_replace("`", "'", $newtext);
$newtext = str_replace(">", "&gt;", $newtext);

include_once $_SERVER['DOCUMENT_ROOT'] . "/library/auto_moderate.php";
$newtext = autoModerate($newtext);

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $post . "/comments_count")) {
    $count = trim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $post . "/comments_count")) + 1;
} else {
    $count = 1;
}

file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $post . "/comments_new", $puser . "#" . $newtext . "#" . $count . "\n" . file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $post . "/comments_new"));
file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $post . "/comments_count",$count);
header("HTTP/1.1 200 API Request Done");