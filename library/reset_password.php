<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/postLanguageHandler.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/library/get_location.php";

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

if (isset($_POST['token'])) {} else {
    echo("No tok");
    exit;
}

$parts = explode("_",$_POST['token']);
if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $parts[0])) {
    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $parts[0] . "/reset/" . $_POST['token']) != date("dmYH")) {
        echo("Error 3");    
        exit;
    }
} else {
    header("HTTP/1.1 401 Invalid Token");
    exit;
}

$user = strtok($_POST['token'], '_');
include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/postLanguageHandler.php";

if (isset($_POST['password']))
{
    if (strlen($_POST['password']) < 8) {
        echo("Error 2");
        exit;
    }
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/password",password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 15]));
    $tokens = scandir($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens");
    foreach($tokens as $token) {
        if ($token != "." && $token != "..")
        {
            rmdir($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $token);
        }
    }
    $tokens = scandir($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/reset");
    foreach($tokens as $token) {
        if ($token != "." && $token != "..")
        {
            unlink($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/reset/" . $token);
        }
    }
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/email")) {
        include_once "./email_util.php";
        include_once "./email_template.php";
        $email = generateEmail($lang_polymer2_email3 . getLocation($lang_polymer2_unknownloc) . $lang_polymer_reset29b . date("d/m/Y H:i:s") . $lang_polymer_reset29c . getUserAgent() . $lang_polymer_reset29d);
        sendEmail_quiet(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/email"),$lang_polymer_reset30,$email,$lang_polymer2_email4 . getLocation($lang_polymer2_unknownloc) . $lang_polymer_reset31b . date("d/m/Y H:i:s") . $lang_polymer_reset31c . getUserAgent() . $lang_polymer_reset31d);
    }
    header("HTTP/1.1 200 API Request Done");
    echo("ok");
    exit;
}
else
{
    echo("Missing Variables");
    exit;
}