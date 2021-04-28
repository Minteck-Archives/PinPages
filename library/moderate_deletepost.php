<?php

$user = strtok($_COOKIE['token'], '_');

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token'])) {} else {
    header("HTTP/1.1 401 Invalid Token");
    exit;
}

if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == 2 || file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == 1)
{

}
else
{
    echo("DENIED!");
    exit;
}

$reason = $_POST['reason'];
$reason = str_replace("#"," ",$reason);
$reason = str_replace("<", "&lt;", $reason);
$reason = str_replace(">", "&gt;", $reason);

include_once $_SERVER['DOCUMENT_ROOT'] . "/library/auto_moderate.php";
$reason = autoModerate($reason);

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

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser)) {
    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/protected" == "1")) {
        die("PROTECTED!");
    }
} else {
    die();
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $id . "/comments"))
{
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $id . "/comments", "");
}
if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $id . "/content"))
{
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $id . "/content", "mdeleted#" . $reason);
}
if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $id . "/link"))
{
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $id . "/link", "");
}
header("HTTP/1.1 200 API Request Done");