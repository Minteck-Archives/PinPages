<?php

if (substr($_SERVER['DOCUMENT_ROOT'], -1) === "/" || substr($_SERVER['DOCUMENT_ROOT'], -1) === "\\") {
    rtrim($_SERVER['DOCUMENT_ROOT']);
}

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

if (isset($_POST['name']))
{
    $name = $_POST['name'];
}
else
{
    echo("No user");
    exit;
}

$botroot = $_SERVER['DOCUMENT_ROOT'] . "/bots";

// $bots = scandir($botroot . "/data/");
// $count = 0;
// foreach ($bots as $bot) {
//     if ($bot == "." || $bot == ".." || $bot == ".htaccess") {} else {
//         if (file_exists($botroot . "/data/" . $bot . "/owner")) {
//             $count = $count + 1;
//             if ($count == $pos) {
//                 if (file_get_contents($botroot . "/data/" . $bot . "/owner") == $user) {
//                     $suser = $bot;
//                     if (file_exists($botroot . "/data/" . $suser))
//                     {
//                         rrmdir($botroot . "/data/" . $suser);
//                     }

//                     if (file_exists($botroot . "/resources/image/profile/" . $suser . ".jpg"))
//                     {
//                         unlink($botroot . "/resources/image/profile/" . $suser . ".jpg");
//                     }

//                     if (file_exists($botroot . "/resources/image/profile/" . $suser . ".tmp"))
//                     {
//                         unlink($botroot . "/resources/image/profile/" . $suser . ".tmp");
//                     }
//                     header("HTTP/1.1 200 API Request Done");
//                     echo("ok");
//                     exit;
//                 }
//             }
//         }
//     }
// }

if (file_exists($botroot . "/data/" . $name) || file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $name)) {
    echo("already");
    exit;
}

if (strpos($name, '"') !== false || strpos($name, '#') !== false || strpos($name, '@') !== false || strpos($name, '{') !== false || strpos($name, '}') !== false || strpos($name, ':') !== false || strpos($name, '/') !== false || strpos($name, '\\') !== false || strpos($name, '?') !== false || strpos($name, '¤') !== false || strpos($name, '%') !== false || strpos($name, '`') !== false || strpos($name, '_') !== false || strpos($name, 'password') !== false || strpos($name, 'username') !== false || strpos($name, 'deleted') !== false || strpos($name, 'mdeleted') !== false || strpos($name, 'disabled') !== false)
{
    echo("invalid");
    exit;
}

include_once $_SERVER['DOCUMENT_ROOT'] . "/library/auto_moderate.php";
$name = autoModerate($name);
mkdir($botroot . "/data/" . $name);
file_put_contents($botroot . "/data/" . $name . "/owner", $user);
$piece1 = rand(1111111,9999999);
$piece2 = rand(1111111,9999999);
$piece3 = rand(1111111,9999999);
file_put_contents($botroot . "/data/" . $name . "/token", $name . "_" . $piece1 . $piece2 . $piece3);