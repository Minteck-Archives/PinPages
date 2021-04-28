<?php

$user = strtok($_COOKIE['token'], '_');

if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == 2 || file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == 1)
{

}
else
{
    echo("DENIED!");
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

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token'])) {} else {
    header("HTTP/1.1 401 Invalid Token");
    exit;
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser)) {
    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/protected" == "1")) {
        die("PROTECTED!");
    }
} else {
    die();
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/verification/status"))
{
    $status = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/verification/status");
    if ($status == "True")
    {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/verification/status", "False");
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/verification/since", "");
        header("HTTP/1.1 200 API Request Done");
        echo("ok");
        exit;
    }
    else
    {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/verification/status", "True");
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/verification/since", date("d/m/Y"));
        header("HTTP/1.1 200 API Request Done");
        echo("ok");
        exit;
    }
}