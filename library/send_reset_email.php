<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/postLanguageHandler.php";

if (isset($_POST['username'])) {
    $user = $_POST['username'];
} else {
    echo("No user");
    exit;
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];
} else {
    echo("No user");
    exit;
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user)) {} else {
    echo("Error 2");
    exit;
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/email")) {} else {
    echo("Error 1");
    exit;
}

if ($email != file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/email")) {
    echo("Error 2");
    exit;
}

function generateToken($user) {
    $token = md5(uniqid(rand(), true));
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/reset")) {
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

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/reset")) {
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/reset/" . $emailtok,date("dmYH"));
} else {
    mkdir($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/reset");
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/reset/" . $emailtok,date("dmYH"));
}

include_once "./email_util.php";
include_once "./email_template.php";
$email = generateEmail($lang_polymer_reset10a . $emailtok . $lang_polymer_reset10b);
sendEmail_quiet(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/email"),$lang_polymer_reset11,$email,$lang_polymer_reset12a . $emailtok . $lang_polymer_reset12b);
header("HTTP/1.1 200 API Request Done");
echo("ok");
exit;