<?php

if (isset($_POST['token']))
{
    $user = strtok($_POST['token'], '_');
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_POST['token']))
    {
        echo("True");
        exit;
    }
    else
    {
        echo("False");
        exit;
    }
}
else
{
    echo("No token");
    exit;
}
header("HTTP/1.1 200 API Request Done");