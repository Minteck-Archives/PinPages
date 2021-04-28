<?php

$user = strtok($_COOKIE['token'], '_');

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

$friends = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/friends/incoming"));
$friends2 = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/friends/valided"));

if (in_array($user, $friends2))
{
    echo("friend");
    exit;
}

if (in_array($user, $friends))
{
    echo("sent");
    exit;
}

file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/friends/incoming", $user . "\n" . file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/friends/incoming"));
header("HTTP/1.1 200 API Request Done");
echo("ok");
exit;