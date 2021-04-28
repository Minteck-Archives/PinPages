<?php

$user = strtok($_COOKIE['token'], '_');
include_once $_SERVER['DOCUMENT_ROOT'] . "/library/auto_moderate.php";

if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == 2)
{

}
else
{
    echo("DENIED!");
    exit;
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token'])) {} else {
    header("HTTP/1.1 401 Invalid Token");
    exit;
}

if (isset($_POST['user']))
{
    $suser = $_POST['user'];
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
    echo("no text");
    exit;
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser)) {
    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/protected" == "1")) {
        die("PROTECTED!");
    }
} else {
    die();
}

if (strlen($text) < 5000 || strlen($text) == 5000)
{
    $newtext = str_replace("#", "&pinpages-hashtag;", $text);
    $newtext = str_replace("<", "&pp-lt;", $newtext);
    $newtext = str_replace(">", "&pp-gt;", $newtext);
    $newtext = str_replace("&pp-lt;br&pp-gt;", "<br>", $newtext);
    $newtext = str_replace("&pp-lt;", "&lt;", $newtext);
    $newtext = str_replace("&pp-gt;", "&gt;", $newtext);
    $newtext = autoModerate($newtext);

    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser))
    {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/bio", $newtext);
        header("HTTP/1.1 200 API Request Done");
    }
    else
    {
        echo("no exist");
        exit;
    }
}
else
{
    echo("too long");
    exit;
}