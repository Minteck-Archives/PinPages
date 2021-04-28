<?php

$user = strtok($_COOKIE['token'], '_');

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token'])) {} else {
    header("HTTP/1.1 401 Invalid Token");
    exit;
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/resources/image/profile/" . $user . ".jpg"))
{
    unlink($_SERVER['DOCUMENT_ROOT'] . "/resources/image/profile/" . $user . ".jpg");
    header("HTTP/1.1 200 API Request Done");
    echo("ok");
    exit;
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/resources/image/profile/" . $user . ".tmp"))
{
    unlink($_SERVER['DOCUMENT_ROOT'] . "/resources/image/profile/" . $user . ".tmp");
    header("HTTP/1.1 200 API Request Done");
    echo("ok");
    exit;
}