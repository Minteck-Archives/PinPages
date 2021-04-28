<?php 

// echo($_SERVER['PHP_SELF']);
// exit;

if (substr( $_SERVER['REQUEST_URI'], 0, 11 ) === "/permission")
{
}
else
{
    echo("<script>location.href = \"/permission\"</script>");
    // echo($_SERVER['PHP_SELF']);
    exit;
}

include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/languageHandler.php";

if (isset($_COOKIE['token']))
{
    $user = strtok($_COOKIE['token'], '_');
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token']))
    {
        $loggedIn = true;
    }
    else
    {
        $user = "../private/logout-user";
        header("Location: /login");
die();
    }
}
else
{
    $user = "../private/logout-user";
    header("Location: /login");
die();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/favicon.svg" />
        <link rel="stylesheet" href="/resources/style/global.css" />
        <title><?= $lang_permission_title ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <?php

if ($loggedIn) {
    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/dark") == "True")
{
    echo("<link rel=\"stylesheet\" href=\"/resources/style/dark.css\" />"); 
}
}

?>
    </head>
    <body class="abody">
    <?php
        
        if ($loggedIn) {
            include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/header.php";
        } else {
            include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/headerLoggedOut.php";
        }
        
        ?>
        <div class="header_escape centered">
            <span style="font-size:48px;color:#904faa;">(っ˘̩╭╮˘̩)っ</span><br>
            <?= $lang_permission_desc ?>
        </div>
    <script src="index.js"></script>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer-centered.php"; ?>
    </body>
</html>