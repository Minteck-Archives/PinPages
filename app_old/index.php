<?php 

include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/languageHandler.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/properties.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/library/markdown/lib.php";

?>

<?php

if (isset($_COOKIE['token']))
{
    $user = strtok($_COOKIE['token'], '_');
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token']))
    {
        $loggedIn = true;
    }
    else
    {
        $user = null;
        header("Location: /login");
die();
    }
}
else
{
    $user = null;
    header("Location: /login");
die();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/favicon.svg" />
        <link rel="stylesheet" href="/resources/style/global.css" />
        <title><?= $lang_polymer_home ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="/resources/libs/jquery.js"></script>
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
        <script>var langprop = "<?= $langprop ?>";</script>
        <?php
        
        if ($loggedIn) {
            include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/header.php";
        } else {
            include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/headerLoggedOut.php";
        }
        
        ?>
        <div class="header_escape">
            <?php

            if ($loggedIn) {
                include_once $_SERVER['DOCUMENT_ROOT'] . "/private/today-loggedin.php";
            } else {
                include_once $_SERVER['DOCUMENT_ROOT'] . "/private/today-loggedout.php";
            }

            ?>
        </div>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
    <script src="index.js"></script>
</html>