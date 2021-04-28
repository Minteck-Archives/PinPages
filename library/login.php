<?php

$root = $_SERVER['DOCUMENT_ROOT'];
include_once $root . "/library/token_util.php";
include_once $root . "/library/get_location.php";
include_once $root . "/resources/i18n/postLanguageHandler.php";

function getUserAgent() {
    if (isset($_SERVER['HTTP_USER_AGENT']))
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }
    else
    {
        return $lang_polymer_login3ca;
    }
}

if (isset($_POST['username']))
{
    $user = $_POST['username'];
}
else
{
    echo("No user");
    exit;
}

if (isset($_POST['password']))
{
    $pass = $_POST['password'];
}
else
{
    echo("No pass");
    exit;
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/ipdata/" . $_SERVER['REMOTE_ADDR'])) {
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/ipdata/" . $_SERVER['REMOTE_ADDR'] . "/fails")) {
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/ipdata/" . $_SERVER['REMOTE_ADDR'] . "/fails/count")) {
            if ((trim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/ipdata/" . $_SERVER['REMOTE_ADDR'] . "/fails/count")) >= 5) && file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/ipdata/" . $_SERVER['REMOTE_ADDR'] . "/fails/ts") == date("dmYH")) {
                echo("Error 4");
                exit;
            }
        }
    }
}

if (file_exists($root . "/data/" . $user))
{
    if (password_verify($pass,file_get_contents($root . "/data/" . $user . "/password"))) {
        // file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/notifications/unread",$lang_log_login_title . "#" . $lang_log_login_desc . $_SERVER['REMOTE_ADDR'] . "#" . date("d/m/Y H:i:s") . "\n" . file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/notifications/unread"));
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/email")) {
            include_once "./email_util.php";
            include_once "./email_template.php";
            $location = getLocation($lang_polymer2_unknownloc);
            $email = generateEmail($lang_polymer2_email1 . $location . $lang_polymer_login1b . date("d/m/Y H:i:s") . $lang_polymer_login1c . getUserAgent() . $lang_polymer_login1d);
            sendEmail_quiet(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/email"),$lang_polymer_login2,$email,$lang_polymer2_email2 . $location . $lang_polymer_login3b . date("d/m/Y H:i:s") . $lang_polymer_login3c . getUserAgent() . $lang_polymer_login3d);
        }
        tokenUtil_login($user,$lang_log_login_title,$lang_log_login_desc,$lang_polymer2_unknownloc,$lang_polymer2_logindesc);
    }
    else
    {
        echo("Error 2");
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/ipdata/" . str_replace(":", "_", $_SERVER['REMOTE_ADDR']))) {} else {
            mkdir($_SERVER['DOCUMENT_ROOT'] . "/ipdata/" . str_replace(":", "_", $_SERVER['REMOTE_ADDR']));
        }
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/ipdata/" . str_replace(":", "_", $_SERVER['REMOTE_ADDR']))) {} else {
            mkdir($_SERVER['DOCUMENT_ROOT'] . "/ipdata/" . str_replace(":", "_", $_SERVER['REMOTE_ADDR']));
        }
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/ipdata/" . str_replace(":", "_", $_SERVER['REMOTE_ADDR']) . "/fails")) {} else {
            mkdir($_SERVER['DOCUMENT_ROOT'] . "/ipdata/" . str_replace(":", "_", $_SERVER['REMOTE_ADDR']) . "/fails");
        }
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/ipdata/" . str_replace(":", "_", $_SERVER['REMOTE_ADDR']) . "/fails/ts")) {} else {
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/ipdata/" . str_replace(":", "_", $_SERVER['REMOTE_ADDR']) . "/fails/ts", date("dmYH"));
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/ipdata/" . str_replace(":", "_", $_SERVER['REMOTE_ADDR']) . "/fails/count", '0');
        }
        if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/ipdata/" . str_replace(":", "_", $_SERVER['REMOTE_ADDR']) . "/fails/ts") == date("dmYH")) {
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/ipdata/" . str_replace(":", "_", $_SERVER['REMOTE_ADDR']) . "/fails/count")) {} else {
                file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/ipdata/" . str_replace(":", "_", $_SERVER['REMOTE_ADDR']) . "/fails/count", '0');
            }
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/ipdata/" . str_replace(":", "_", $_SERVER['REMOTE_ADDR']) . "/fails/count", trim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/ipdata/" . str_replace(":", "_", $_SERVER['REMOTE_ADDR']) . "/fails/count")) + 1);
        }
        else
        {
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/ipdata/" . str_replace(":", "_", $_SERVER['REMOTE_ADDR']) . "/fails/ts", date("dmYH"));
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/ipdata/" . str_replace(":", "_", $_SERVER['REMOTE_ADDR']) . "/fails/count", '0');
        }
        exit;
    }
}
else
{
    echo("Error 1");
    exit;
}
