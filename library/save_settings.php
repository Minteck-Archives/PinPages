<?php

$user = strtok($_COOKIE['token'], '_');

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token'])) {} else {
    header("HTTP/1.1 401 Invalid Token");
    exit;
}

// isset($_POST['discovery']) && isset($_POST['realname']) && isset($_POST['dark']) && isset($_POST['private']) && isset($_POST['timezone'])

if (isset($_POST['discovery'])) {
    $discovery = $_POST['discovery'];
} else {
    $discovery = strtolower(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/privacy/discovery"));
}

if (isset($_POST['dark'])) {
    $dark = $_POST['dark'];
} else {
    $dark = strtolower(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/dark"));
}

if (isset($_POST['timezone'])) {
    $timezone = $_POST['timezone'];
} else {
    $timezone = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/timezone");
}

if (isset($_POST['private'])) {
    $private = $_POST['private'];
} else {
    $private = strtolower(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/privacy/private"));
}

if (isset($_POST['realname'])) {
    $realname = $_POST['realname'];
    $realname_orig = $_POST['realname'];
} else {
    $realname = strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/realname"));
    $realname_orig = strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/realname"));
}

if ($discovery == "true")
{
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/privacy/discovery","True");
}
else
{
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/privacy/discovery","False");
}
file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/timezone",$timezone);
if ($private == "true")
{
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/privacy/private","True");
}
else
{
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/privacy/private","False");
}
if ($dark == "true")
{
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/dark","True");
}
else
{
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/dark","False");
}
if (trim($realname) == "")
{
    echo("Error 3");
    exit;
}
$realname = str_replace("#", " ", $realname);
$realname = str_replace("<", "&lt;", $realname);
$realname = str_replace(">", "&gt;", $realname);
include_once $_SERVER['DOCUMENT_ROOT'] . "/library/auto_moderate.php";
$realname = autoModerate($realname);
if (strpos($realname_orig, '"') !== false || strpos($realname_orig, '#') !== false || strpos($realname_orig, '@') !== false || strpos($realname_orig, '{') !== false || strpos($realname_orig, '}') !== false || strpos($realname_orig, '¤') !== false || strpos($realname_orig, '`') !== false)
{
    echo("Error 2");
    exit;
}
else
{
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/realname",strrev($realname));
    header("HTTP/1.1 200 API Request Done");
    echo("ok");
    exit;
}