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

if (isset($_GET['user']))
{
    if (trim($_GET['user']) == "")
    {
        if ($loggedIn) {
            $suser = $user;
        } else {
            die("<script>location.href = \"/errorpage\";</script>");
        }
    }
    else
    {
        $suser = $_GET['user'];
    }
}
else
{
    if ($loggedIn) {
        $suser = $user;
    } else {
        die("<script>location.href = \"/errorpage\";</script>");
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/favicon.svg" />
        <link rel="stylesheet" href="/resources/style/global.css" />
        <title><?= $lang_pm3bio_pagetitle ?></title>
        <meta charset="UTF-8">
        <script>id = "<?= $count ?>"</script>
        <script src="/resources/libs/jquery.js"></script>
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
        <script>var langprop = "<?= $langprop ?>";</script>
        <?php
        
        if ($loggedIn) {
            include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/header.php";
        } else {
            include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/headerLoggedOut.php";
        }
        
        ?>
        <div class="header_escape">
        <h1><?= $lang_pm3bio_header ?><a href="/page/?user=<?= $suser ?>"><?= $suser ?></a></h1>
                    <?php
                    
                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/bio")) {
                        if (trim(HTMLtoMD_bio(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/bio"))) != "") {
                            echo(HTMLtoMD_bio(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/bio")));
                            if ($suser == $user) {
                                echo("<p><a href=\"/bio/?user=" . $suser . "\">" . $lang_polymer2_bio4 . "</a></p>");
                            }
                        } else {
                            echo($lang_polymer2_bio2);
                            if ($suser == $user) {
                                echo("<p><a href=\"/bio/?user=" . $suser . "\">" . $lang_polymer2_bio5 . "</a></p>");
                            }
                        }
                    } else {
                        echo($lang_polymer2_bio2);
                        if ($suser == $user) {
                            echo("<p><a href=\"/bio/?user=" . $suser . "\">" . $lang_polymer2_bio5 . "</a></p>");
                        }
                    }

                    ?>
        </div>
        <script src="index.js"></script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>