<?php

include_once "./email_util.php";
include_once "./email_template.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/postLanguageHandler.php";

$user = strtok($_COOKIE['token'], '_');
$address = $_POST['email'];

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token'])) {} else {
    header("HTTP/1.1 401 Invalid Token");
    exit;
}

if (trim($address) == "") {
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/email")) {
        $address = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/email");
        unlink($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/email");
        $email = generateEmail($lang_pm3glob_mailc1 . $user . $lang_pm3glob_mailc2);
        sendEmail_quiet($address,$lang_pm3glob_mailc3,$email,$lang_pm3glob_mailc4 . $user . $lang_pm3glob_mailc5);
        die("ok");
    }
} else {
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/email",$address);
    $email = generateEmail($lang_polymer_email7a . $user . $lang_polymer_email7b);
    sendEmail($address,$lang_polymer_email8,$email,$lang_polymer_email9a . $user . $lang_polymer_email9b);
}

header("HTTP/1.1 200 API Request Done");