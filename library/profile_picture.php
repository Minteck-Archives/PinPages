<?php

$user = strtok($_COOKIE['token'], '_');

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token'])) {} else {
    header("HTTP/1.1 401 Invalid Token");
    exit;
}

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

$target_file = $_SERVER['DOCUMENT_ROOT'] . "/resources/image/profile/" . $user . ".tmp";
$target_compress = $_SERVER['DOCUMENT_ROOT'] . "/resources/image/profile/" . $user . ".jpg";

if ($_FILES['profilepic']['size'] > 1000000)
{
    echo("Error 7");
    exit;
}
else
{
    
move_uploaded_file($_FILES['profilepic']['tmp_name'],$target_file);

if ($_FILES['profilepic']['type'] != "image/jpeg" && $_FILES['profilepic']['type'] != "image/png" && $_FILES['profilepic']['type'] != "image/gif")
{
    echo("Error 8");
    exit;
}
else
{
    compress($target_file, $target_compress, 70);
    unlink($target_file);
    header("HTTP/1.1 200 API Request Done");
    echo("ok");
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