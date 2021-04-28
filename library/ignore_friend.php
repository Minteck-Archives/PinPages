<?php

$user = strtok($_COOKIE['token'], '_');

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token'])) {} else {
    header("HTTP/1.1 401 Invalid Token");
    exit;
}

if (isset($_POST['friend']))
{
    $suser = $_POST['friend'];
}
else
{
    echo("No friend");
    exit;
}

$newfriends2 = str_replace($suser, "", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/friends/incoming"));
file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/friends/incoming", $newfriends2);
header("HTTP/1.1 200 API Request Done");
echo("done!");
exit;