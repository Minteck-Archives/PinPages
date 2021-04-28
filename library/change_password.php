<?php

$user = strtok($_COOKIE['token'], '_');
include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/postLanguageHandler.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/library/get_location.php";

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token'])) {} else {
    header("HTTP/1.1 401 Invalid Token");
    exit;
}

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

if (isset($_POST['oldpass']) && isset($_POST['newpass']) && isset($_POST['newrept']))
{
    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];
    $newrept = $_POST['newrept'];
    if (password_verify($_POST['oldpass'],file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/password")))
    {
        if ($newpass == $newrept)
        {
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/password",password_hash($newpass, PASSWORD_BCRYPT, ['cost' => 15]));
            $tokens = scandir($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens");
            foreach($tokens as $token) {
                if ($token != "." && $token != "..")
                {
                    rmdir($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $token);
                }
            }
            mkdir($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token']);
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/email")) {
                include_once "./email_util.php";
                include_once "./email_template.php";
                $email = generateEmail($lang_polymer2_email5 . getLocation($lang_polymer2_unknownloc) . $lang_polymer_pass1b . date("d/m/Y H:i:s") . $lang_polymer_pass1c . getUserAgent() . $lang_polymer_pass1d);
                sendEmail_quiet(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/email"),$lang_polymer_pass2,$email,$lang_polymer2_email6 . getLocation($lang_polymer2_unknownloc) . $lang_polymer_pass3b . date("d/m/Y H:i:s") . $lang_polymer_pass3c . getUserAgent() . $lang_polymer_pass3d);
                header("HTTP/1.1 200 API Request Done");
            }
            echo("ok");
            exit;
        }
        else
        {
            echo("Error 5");
            exit;
        }
    }
    else
    {
        echo("Error 4");
        exit;
    }
}
else
{
    echo("Missing Variables");
    exit;
}