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

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token'])) {} else {
    header("HTTP/1.1 401 Invalid Token");
    exit;
}

$reason = $_POST['reason'];
$reason = str_replace("#"," ",$reason);
$reason = str_replace("<", "&lt;", $reason);
$reason = str_replace(">", "&gt;", $reason);

if (isset($_POST['id']))
{
    $id = $_POST['id'];
}
else
{
    echo("No id");
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

if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/protected") == "1")
{
    echo("Protected!");
    exit;
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/album/" . $id . "/desc"))
{
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/album/" . $id . "/desc", $reason);
}
if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/album/" . $id . "/id"))
{
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/album/" . $id . "/id", "mdeleted");
}
header("HTTP/1.1 200 API Request Done");