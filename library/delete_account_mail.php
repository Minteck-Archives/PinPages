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

if (isset($_POST['token'])) {} else {
    echo("No tok");
    exit;
}

$parts = explode("_",$_POST['token']);
if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $parts[0])) {
    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $parts[0] . "/delete/" . $_POST['token']) != date("dmYH")) {
        echo("Error 3");    
        exit;
    }
} else {
    header("HTTP/1.1 401 Invalid Token");
    exit;
}

$user = strtok($_POST['token'], '_');
include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/postLanguageHandler.php";

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