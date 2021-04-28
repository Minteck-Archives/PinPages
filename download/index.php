<?php 

// echo($_SERVER['PHP_SELF']);
// exit;

include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/languageHandler.php";

if (isset($_COOKIE['token']))
{
    $user = strtok($_COOKIE['token'], '_');
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token']))
    {
    }
    else
    {
        $user = "none";
    }
}
else
{
    $user = "none";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/favicon.svg" />
        <link rel="stylesheet" href="/resources/style/global.css" />
        <title><?= $lang_download_title ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <?php

        if ($user != "none")
        {
            if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/dark") == "True")
            {
                    echo("<link rel=\"stylesheet\" href=\"/resources/style/dark.css\" />"); 
            }
        }

        ?>
    </head>
    <body class="abody">
        <?php 
        
        if ($user == "none") {
            include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/headerWhenLoggedOut.php";
        } else {
            include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/header.php";
        }
        
        ?>
        <div class="header_escape centered">
            <div id="dl_windows" class="hide">
                <img src="/resources/image/windows.png" width="128px" height="128px" class="dlbutton"><br><br>
                <a style="font-weight:bold;" href="https://pinpages-app.alwaysdata.net/pinpages-client-win32.exe" id="dlconfirm"><?= $lang_download_getwin ?></a><br><br><?= $lang_download_winrq ?>
            </div>
            <div id="dl_android" class="hide">
                <img src="/resources/image/android.png" width="128px" height="128px" class="dlbutton"><br><br>
                <a style="font-weight:bold;" href="https://pinpages-app.alwaysdata.net/pinpages-client-android.apk" id="dlconfirm"><?= $lang_download_getandro ?></a><br><br><?= $lang_download_androsteps ?>
            </div>
            <div id="dl_uncompatible" class="hide">
                <img src="/resources/image/warning.png" width="128px" height="128px" class="dlbutton"><br><br>
                <?= $lang_download_uncompatible ?>
            </div>
            <div id="loader">
                <img src="/resources/image/loader.gif" width="64px" height="64px">
            </div>
        </div>
    </body>
    <script src="index.js"></script>
</html>