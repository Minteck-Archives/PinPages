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
        echo("<script>document.cookie = \"\";location.href = \"/?lang=" . $langprop . "\"</script>");
        exit;
    }
}
else
{
    echo("<script>document.cookie = \"\";location.href = \"/?lang=" . $langprop . "\"</script>");
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
    if ($suser == "")
    {
        echo("<script>location.href = \"/page/?lang=" . $langprop . "\"</script>");
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
        <title><?= $lang_verifmgr_titlep1 . $suser . $lang_verifmgr_titlep2 ?></title>
        <meta charset="UTF-8">
        <script>suser = "<?= $suser ?>"</script>
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
            <div id="ep_editdiv">
                <?php
                
                if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/protected") == "1")
                {
                    echo("<h1>" . $lang_mod_nopermt . "</h1>" . $lang_mod_nopermd);
                    exit;
                }

                ?>
                <h1 class="ep_title"><?= $lang_moderation_partner ?></h1>
                <?php

                if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/partner") && file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/partner") == "1")
                {
                    echo("<span>" . $lang_partner_status . " <b>" . $lang_partner_enabled . "</b></span><br><br><a onclick=\"showConfirm()\" id=\"ep_act\" class=\"jslink\">" . $lang_partner_remove . "</a><br>
                    <span class=\"tip\">" . $lang_partner_tremove . "</span>");
                }
                else
                {
                    echo("<span>" . $lang_partner_status . " <b>" . $lang_partner_disabled . "</b></span><br><br><a onclick=\"showConfirm()\" id=\"ep_act\" class=\"jslink\">" . $lang_partner_add . "</a><br>
                    <span class=\"tip\">" . $lang_partner_tadd . "</span>");
                }

                ?>
            </div>
            <div id="ep_deldiv" class="hide">
                <?php

                if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/partner") && file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/partner") == "1")
                {
                    echo("<h1>" . $lang_partner_ctitle . "</h1>" . $lang_partner_ydesc . "<br><br><a onclick=\"toggleVerification()\" id=\"dact2\" class=\"jslink\">" . $lang_partner_yact . "</a><br><a onclick=\"cancel()\" class=\"jslink\">" . $lang_partner_cancel . "</a>");
                }
                else
                {
                    echo("<h1>" . $lang_partner_ctitle . "</h1>" . $lang_partner_ndesc . "<br><br><a onclick=\"toggleVerification()\" id=\"dact2\" class=\"jslink\">" . $lang_partner_nact . "</a><br><a onclick=\"cancel()\" class=\"jslink\">" . $lang_partner_cancel . "</a>");
                }

                ?>
            </div>
            <div id="ep_procdiv" class="hide">
                <h1><?= $lang_moderate_ptitle ?></h1>
                <?= $lang_moderate_pdesc ?>
            </div>
        </div>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
        <script src="index.js"></script>
    </body>
</html>