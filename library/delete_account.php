<?php

function rrmdir($dir) { 
    if (is_dir($dir)) {
    $objects = scandir($dir); 
    foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (is_dir($dir."/".$object))
                    rrmdir($dir."/".$object);
                else
                    unlink($dir."/".$object); 
                }
            }
            rmdir($dir); 
    } 
}

$user = strtok($_COOKIE['token'], '_');

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token'])) {} else {
    header("HTTP/1.1 401 Invalid Token");
    exit;
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/email")) {
    die("An email is linked to this account. For security reasons, you cannot delete account using this API function, consider using 'delete_account_mail.php' and providing the given token.");
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user))
{
    rrmdir($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user);
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/resources/image/profile/" . $user . ".jpg"))
{
    unlink($_SERVER['DOCUMENT_ROOT'] . "/resources/image/profile/" . $user . ".jpg");
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/resources/image/profile/" . $user . ".tmp"))
{
    unlink($_SERVER['DOCUMENT_ROOT'] . "/resources/image/profile/" . $user . ".tmp");
}

header("HTTP/1.1 200 API Request Done");
echo("ok");
exit;