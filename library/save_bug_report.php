<?php

$user = strtok($_COOKIE['token'], '_');

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token'])) {} else {
    header("HTTP/1.1 401 Invalid Token");
    exit;
}

if (isset($_POST['text']))
{
    if (trim($_POST['text']) != "") {
        $text = $_POST['text'];
    } else {
        echo("no text");
        exit;    
    }
}
else
{
    echo("no text");
    exit;
}

if (isset($_POST['id']))
{
    if (trim($_POST['id']) != "") {
        $id = $_POST['id'];
    } else {
        echo("no id");
        exit;    
    }
}
else
{
    echo("no id");
    exit;
}

if (isset($_POST['name']))
{
    if (trim($_POST['name']) != "") {
        $name = $_POST['name'];
    } else {
        echo("no name");
        exit;    
    }
}
else
{
    echo("no name");
    exit;
}

if (1 == 1)
{
    $newtext = str_replace("#", " ", $text);
    $newtext = str_replace("<", "&lt;", $newtext);
    $newtext = str_replace(">", "&gt;", $newtext);
    $newtext = str_replace("\n", "<br>", $newtext);

    include_once $_SERVER['DOCUMENT_ROOT'] . "/library/auto_moderate.php";
    $newtext = autoModerate($newtext);

    $newname = str_replace("#", " ", $name);
    $newname = str_replace("<", "&lt;", $newname);
    $newname = str_replace(">", "&gt;", $newname);
    $newname = str_replace("\n", "<br>", $newname);

    include_once $_SERVER['DOCUMENT_ROOT'] . "/library/auto_moderate.php";
    $newname = autoModerate($newname);

    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/private/bugs-reports/" . $user . "/" . $id))
    {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/private/bugs-reports/" . $user . "/" . $id . "/name", $newname);
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/private/bugs-reports/" . $user . "/" . $id . "/description", $newtext);
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/private/bugs-reports/" . $user . "/" . $id . "/date", date('d/m/Y'));
        header("HTTP/1.1 200 API Request Done");
        echo("ok");
        exit;
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