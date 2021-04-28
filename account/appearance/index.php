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

function isUserTimezone($tz) {
    global $user;
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/timezone")) {
        $utz = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/timezone");
        if (trim($utz) == trim($tz)) {
            echo("selected");
        }
    } else {
        if (trim($tz) == "2") {
            echo("selected");
        }
    }
}

function jsSetTimezone() {
    global $user;
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/timezone")) {
        $utz = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/timezone");
        echo("<script>$('#timezone')[0].value = \"{$utz}\"</script>");
    } else {
        echo("<script>$('#timezone')[0].value = \"2\"</script>");
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/favicon.svg" />
        <link rel="stylesheet" href="/resources/style/global.css" />
        <title><?= $lang_pm3acc_appearance ?></title>
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
        <script>var langprop = "<?= $langprop ?>";</script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/header.php"; ?>
        <div class="header_escape">
        <div class="account_back"><center><a onclick="location.href = '/account';" class="ab_link"><img src="/resources/icons/lightback/ic_home_grey600_24dp.png" class="icc"><?= $lang_pm3_account ?></a></center></div><br>
        <h1><?= $lang_newsetup_appearance ?></h1>
                                <?php
            
            if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/dark") == "True") {
                echo("<input type=\"checkbox\" id=\"appearance_dark\" name=\"appearance_dark\" onchange=\"saveSettings();\" checked>");
            } else {
                echo("<input type=\"checkbox\" id=\"appearance_dark\" name=\"appearance_dark\" onchange=\"saveSettings();\">");
            }
            
            ?>
                            <label for="appearance_dark"><?= $lang_appearance_dark ?></label> <a class="hide" href="/account/appearance" id="reloadNeeded"><?= $lang_account_reload ?></a><br>
        </div>
        <script src="index.js"></script>
        <script>
            
            var lang_pictures_add = "<?= $lang_pictures_upload ?>"
            var lang_pictures_edit = "<?= $lang_pictures_update ?>"
            var lang_uts = "<?= $lang_newsetup_uts ?>"
            
        </script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>
