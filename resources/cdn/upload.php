<?php

header("Access-Control-Allow-Origin: *");

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');
}
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUET_HEADERS']))
        header("Access-Control-Allow-Headers: {$SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
}

echo("test");
exit;

function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
}

function generateRandomString($length = 25) {
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVEWXYZ";
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/" . $randomString . ".jpg")) {
        generateRandomString();
    } else {
        return $randomString;
    }
}

if (isset($_POST['user'])) {
    $user = $_POST['user'];
} else {
    header("HTTP/1.1 401 Invalid User");
    exit;
}

if ($_FILES['upload']['size'] > 8000000)
{
    echo("Error 7");
    exit;
}
else
{

$id = generateRandomString();
$target_file = $_SERVER['DOCUMENT_ROOT'] . "/" . $id . ".tmp";
$target_compress = $_SERVER['DOCUMENT_ROOT'] . "/" . $id . ".jpg";

move_uploaded_file($_FILES['upload']['tmp_name'],$target_file);

if ($_FILES['upload']['type'] != "image/jpeg" && $_FILES['upload']['type'] != "image/png" && $_FILES['upload']['type'] != "image/gif")
{
    echo("Error 8");
    exit;
}
else
{
    compress($target_file, $target_compress, 70);
    unlink($target_file);
    header("HTTP/1.1 200 API Request Done");
    echo($id);
    exit;
}

// echo "<p>";
//     file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/image/profile/" . $user . ".dat","");
//     if (copy($_FILES['profilepic']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/image/profile/" . $user . ".dat")) {
//       echo "File is valid, and was successfully uploaded.\n";
//     } else {
//        echo "Upload failed";
//     }

//     echo "</p>";
//     echo '<pre>';
//     echo 'Here is some more debugging info:';
//     print_r($_FILES);
//     print "</pre>";

}