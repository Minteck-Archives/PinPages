<?php

$user = strtok($_COOKIE['token'], '_');

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token'])) {} else {
    header("HTTP/1.1 401 Invalid Token");
    exit;
}

if (isset($_POST['id']))
{
    $id = $_POST['id'];
}
else
{
    echo("no id");
    exit;
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $id . "/comments"))
{
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $id . "/comments", "");
}
if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $id . "/content"))
{
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $id . "/content", "deleted");
}
if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $id . "/link"))
{
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $id . "/link", "");
}
header("HTTP/1.1 200 API Request Done");