<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/languageHandler.php";

$user = strtok($_COOKIE['token'], '_');

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token']))
{
    rmdir($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token']);
    header("Set-Cookie: token=; HttpOnly; Path=/");
    $res = setcookie('token', '', time() - 3600);
    // echo("<script>location.href = \"/\"</script>");
    header("Location: /");
} else {
    // echo("<script>location.href = \"/\"</script>");
    header("Location: /");
}