<?php 

include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/languageHandler.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/properties.php";

?>

<?php

if (isset($_COOKIE['token']))
{
    $user = strtok($_COOKIE['token'], '_');
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token']))
    {
    }
    else
    {
        echo("<script>location.href = \"/login/?lang={$langprop}&return=" . urlencode($_SERVER['REQUEST_URI']) . "\"</script>");
        exit;
    }
}
else
{
    echo("<script>location.href = \"/login/?lang={$langprop}&return=" . urlencode($_SERVER['REQUEST_URI']) . "\"</script>");
        exit;
}

if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == 2 || file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == 1)
{

}
else
{
    echo("<script>location.href = \"/errorpage/?lang=" . $langprop . "\"</script>");
    exit;
}

if (isset($_GET['user']))
{
    $suser = $_GET['user'];
    if (trim($suser) == "")
    {
        echo("<script>location.href = \"/page\"</script>");
        exit;
    }
    if ($suser == $user) {
        echo("<script>location.href = \"/page\"</script>");
        exit;
    }
}
else
{
    echo("<script>location.href = \"/page/?lang=" . $langprop . "\"</script>");
    exit;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/favicon.svg" />
        <link rel="stylesheet" href="/resources/style/global.css" />
        <title><?= $lang_pm3mod_usermod ?></title>
        <meta charset="UTF-8">
        <script src="/resources/libs/jquery.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <?php

        if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/dark") == "True")
        {
            echo("<link rel=\"stylesheet\" href=\"/resources/style/dark.css\" />"); 
        }

        ?>
    </head>
    <body class="abody">
        <script>var langprop = "<?= $langprop ?>";var postuser = "<?= $postuser ?>";</script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/header.php"; ?>
        <div class="header_escape">
            <h1><?= $lang_pm3mod_umtitle . $suser ?></h1>
            <?php
            
                $echod = false;
                if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == "1" || file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == "2")
                {
                    echo("<ul>");
                    echo("<li><a href=\"/verification/?user=" . $suser . "\">" . $lang_moderation_verif . "</a></li><li><a href=\"/rmppic/?user=" . $suser . "\">" . $lang_moderation_ppic . "</a>");
                    $echod = true;
                    if (!file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == "2")
                    {
                        echo("</ul>");
                    }
                }
                if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == "2")
                {
                    echo("<li><a href=\"/delete/?user=" . $suser . "\">" . $lang_moderation_delete . "</a></li><li><a href=\"/protect/?user=" . $suser . "\">" . $lang_moderation_protect . "</a></li><li><a href=\"/partner/?user=" . $suser . "\">" . $lang_moderation_partner . "</a></li><li><a href=\"/permmgr/?user=" . $suser . "\">" . $lang_moderation_perms . "</a></li><li><a href=\"/biomgr/?user=" . $suser . "\">" . $lang_pm3mod_bio . "</a></ul>");
                    $echod = true;
                }

                if (!$echod) {
                    echo("<script>location.href = \"/page\"</script>");
                    exit;
                }
            
            ?>
        </div>
        <script src="index.js"></script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>