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

$friends = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/friends/valided"));
$friends = array_map('trim', $friends);
$friends2 = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/friends/valided"));
$friends2 = array_map('trim', $friends2);
$friends3 = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/friends/incoming"));
$friends3 = array_map('trim', $friends3);

if (in_array($user, $friends2) && in_array($suser, $friends))
{
}
else
{
    echo("e3");
    exit;
}

if (in_array($user, $friends3))
{
    echo("e2");
    exit;
}

$preback1 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/friends/valided");
$preback2 = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/friends/valided");
if (strpos($preback1, $user . "\n") !== false)
{
    $back1 = str_replace($user . "\n", "", $preback1);
}
else
{
    $back1 = str_replace($user, "", $preback1);
}
if (strpos($preback2, $suser . "\n") !== false)
{
    $back2 = str_replace($suser . "\n", "", $preback2);
}
else
{
    $back2 = str_replace($suser, "", $preback2);
}

file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/friends/valided", $back1);
file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/friends/valided", $back2);
header("HTTP/1.1 200 API Request Done");
echo("ok");
exit;