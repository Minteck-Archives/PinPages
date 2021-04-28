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

if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == 2)
{

}
else
{
    echo("DENIED!");
    exit;
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token'])) {} else {
    header("HTTP/1.1 401 Invalid Token");
    exit;
}

if (isset($_POST['user']))
{
    $suser = $_POST['user'];
}
else
{
    echo("No user");
    exit;
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser)) {
    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/protected" == "1")) {
        die("PROTECTED!");
    }
} else {
    die();
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser))
{
    rrmdir($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser);
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/resources/image/profile/" . $suser . ".jpg"))
{
    unlink($_SERVER['DOCUMENT_ROOT'] . "/resources/image/profile/" . $suser . ".jpg");
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/resources/image/profile/" . $suser . ".tmp"))
{
    unlink($_SERVER['DOCUMENT_ROOT'] . "/resources/image/profile/" . $suser . ".tmp");
}

header("HTTP/1.1 200 API Request Done");
echo("ok");
exit;