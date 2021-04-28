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

if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == 2)
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
        <title><?= $lang_delete_titlep1 . $suser . $lang_verifmgr_titlep2 ?></title>
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
                <h1 class="ep_title"><?= $lang_delete_title ?></h1>
                <?= $lang_delete_desc1 . $suser . $lang_delete_desc2 ?><br><span style="color:red;font-weight:bold"><?= $lang_protect_disclaimer ?></span><br><br>
                <a onclick="next()" id="dact1" class="jslink"><?= $lang_protect_continue ?></a><br>
            </div>
            <div id="ep_deldiv" class="hide">
                <h1><?= $lang_protect_ctitle ?></h1>
                <?= $lang_delete_cdesc ?><br><span style="color:red;font-weight:bold"><?= $lang_protect_disclaimer ?></span><br><br>
                <a onclick="confirmYes()" id="dact1" class="jslink"><?= $lang_protect_cyes ?></a><br>
                <a onclick="confirmNo()" id="dact1" class="jslink"><?= $lang_protect_cno ?></a><br>
            </div>
            <div id="ep_procdiv" class="hide">
                <h1><?= $lang_delete_ptitle ?></h1>
                <?= $lang_delete_pdesc ?>
            </div>
        </div>
        <script src="index.js"></script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>