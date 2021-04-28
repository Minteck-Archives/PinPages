<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/library/get_location.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/postLanguageHandler.php";

function isSecure() {
    return
      (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
      || $_SERVER['SERVER_PORT'] == 443;
}

function tokenUtil_login($user,$lang_log_login_title,$lang_log_login_desc,$lang_polymer2_unknownloc,$lang_polymer2_logindesc) {
    header("HTTP/1.1 200 API Request Done");
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user))
    {
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/"))
        {
            $location = getLocation($lang_polymer2_unknownloc);
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/notifications/unread",$lang_log_login_title . "#" . $lang_polymer2_logindesc . $location . "#" . date("d/m/Y H:i") . "\n" . file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/notifications/unread"));
            $token = generateToken($user);
            if (isSecure()) {
                header("Set-Cookie: token=" . $token . "; Secure; HttpOnly; Path=/");
            } else {
                header("Set-Cookie: token=" . $token . "; HttpOnly; Path=/");
            }
            echo("ok");
            exit;
        }
        else
        {
            $location = getLocation($lang_polymer2_unknownloc);
            mkdir($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/");
            $token = generateToken($user);
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/notifications/unread",$lang_log_login_title . "#" . $lang_polymer2_logindesc . $location . "#" . date("d/m/Y H:i") . "\n" . file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/notifications/unread"));
            if (isSecure()) {
                setcookie("token", $token, 0, "/", "", true, false);
            } else {
                setcookie("token", $token, 0, "/", "", false, false);
            }
            echo("ok");
            exit;
        }
    }
    else
    {
        echo("No User");
        exit;
    }
}

function generateToken($user) {
    $piece1 = rand(1111111,9999999);
    $piece2 = rand(1111111,9999999);
    $piece3 = rand(1111111,9999999);
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $user . "_" . $piece1 . $piece2 . $piece3))
    {
        generateToken($user);
    }
    else
    {
        mkdir($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $user . "_" . $piece1 . $piece2 . $piece3);
        return $user . "_" . $piece1 . $piece2 . $piece3;
    }
}