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

if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board")) {
    die("No Board profile");
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board"))
{
    rrmdir($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board");
}

header("HTTP/1.1 200 API Request Done");
echo("ok");
exit;