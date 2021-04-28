<?php 

// echo($_SERVER['PHP_SELF']);
// exit;

if (substr( $_SERVER['REQUEST_URI'], 0, 10 ) === "/errorpage")
{
}
else
{
    echo("<script>location.href = \"/errorpage\"</script>");
    // echo($_SERVER['PHP_SELF']);
    exit;
}

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
        <title><?= $lang_error_title ?></title>
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
            <span style="font-size:48px;color:#904faa;">ノಠ_ಠノ</span><br>
            <?php
            
            if ($user == "none") {
                echo($lang_error_desc);
            } else {
                echo($lang_error_ldesc);
            }
            
            ?>
        </div>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer-centered.php"; ?>
    </body>
    <script src="index.js"></script>
</html>