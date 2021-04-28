<?php

$user = strtok($_COOKIE['token'], '_');
$token = $_COOKIE['token'];

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token'])) {} else {
    header("HTTP/1.1 401 Invalid Token");
    exit;
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $token))
{
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/notifications/read",file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/notifications/unread") . "\n" . file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/notifications/read"));
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/notifications/unread","");
    header("HTTP/1.1 200 API Request Done");
    echo("ok");
}
else
{
    echo("Token Issue");
    exit;
}