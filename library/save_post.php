<?php

$user = strtok($_COOKIE['token'], '_');

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token'])) {} else {
    header("HTTP/1.1 401 Invalid Token");
    exit;
}

if (isset($_POST['text']))
{
    $text = $_POST['text'];
}
else
{
    echo("no text");
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

if (strlen($text) < 1037 || strlen($text) == 1037)
{
    $newtext = str_replace("#", " ", $text);
    $newtext = str_replace("<", "&lt;", $newtext);
    $newtext = str_replace(">", "&gt;", $newtext);
    $newtext = str_replace("\n", "<br>", $newtext);

    include_once $_SERVER['DOCUMENT_ROOT'] . "/library/auto_moderate.php";
    $newtext = autoModerate($newtext);

    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $id))
    {
        $post = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $id . "/content");
        $steps = explode('#', $post);
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $id . "/content", $steps[0] . "#" . $newtext . "#" . $steps[2] . "#" . date('d/m/Y H:i'));
        $newlname = str_replace("#", " ", $_POST['lname']);
        $newlname = str_replace("<", "&lt;", $newlname);
        $newlname = str_replace(">", "&gt;", $newlname);
        $newltarg = $_POST['ltarg'];
        $newltarg = str_replace("#", "▓", $newltarg);
        $newlname = autoModerate($newlname);
        if (trim($newltarg != "")) {
            if (substr($newltarg, 0, 7) === "http://") {} else {
                if (substr($newltarg, 0, 8) === "https://") {} else {
                    if (trim($newltarg) != "") {
                        $newltarg = "http://" . $newltarg;
                    }
                }
            }
        }
        if (isset($_POST['lname']))
        {
            if (isset($_POST['ltarg']))
            {
                file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $id . "/link", $newlname);
            }
            if (trim($_POST['lname']) == "") {
                if (isset($_POST['ltarg']))
                {
                    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $id . "/link", $newltarg);
                }
            }
        }
        else
        {
            if (isset($_POST['ltarg']))
            {
                file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $id . "/link", $newltarg);
            }
        }
        if (isset($_POST['ltarg']))
        {
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $id . "/link", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $id . "/link") . "#" . $newltarg);
        }
        header("HTTP/1.1 200 API Request Done");
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
