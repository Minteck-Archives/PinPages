<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/postLanguageHandler.php";

$user = strtok($_COOKIE['token'], '_');

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user)) {} else {
    echo("Error 2");
    exit;
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/email")) {} else {
    echo("Error 1");
    exit;
}

function generateToken($user) {
    $token = md5(uniqid(rand(), true));
    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/delete")) {
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/reset/" . $token)) {
            generateToken();
        } else {
            return $token;
        }
    } else {
        return $token;
    }
}

$emailtok = $user . "_" . generateToken($user);

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/delete")) {
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/delete/" . $emailtok,date("dmYH"));
} else {
    mkdir($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/delete");
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/delete/" . $emailtok,date("dmYH"));
}

include_once "./email_util.php";
include_once "./email_template.php";
$email = generateEmail($lang_pm3del_email1 . $emailtok . $lang_pm3del_email2);
sendEmail_quiet(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/email"),$lang_pm3del_email3,$email,$lang_pm3del_email4 . $emailtok . $lang_pm3del_email5);
header("HTTP/1.1 200 API Request Done");
echo("ok");
exit;