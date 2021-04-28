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

if (isset($_GET['id']))
{
    $id = $_GET['id'];
    if ($id == "")
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

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $id))
{
    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $id . "/content") == "deleted" || file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $id . "/content") == "mdeleted")
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
        <title><?= $lang_moderate_titlep1 . $id . $lang_moderate_titlep2 ?></title>
        <meta charset="UTF-8">
        <script>id = "<?= $id ?>"; suser = "<?= $suser ?>"</script>
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
                <h1 class="ep_title"><?= $lang_moderate_title ?></h1>
                <a onclick="removePost()" id="ep_remove" class="jslink"><?= $lang_moderate_remove ?></a><br>
                <span class="tip"><?= $lang_moderate_tremove ?></span><br><br>
                <a onclick="disableComments()" id="ep_disable" class="jslink"><?= $lang_moderate_disable ?></a><br>
                <span class="tip"><?= $lang_moderate_tdisable ?></span>
            </div>
            <div id="ep_deldiv" class="hide">
                <h1><?= $lang_moderate_dtitle ?></h1>
                <?= $lang_moderate_ddesc ?><br><br>
                <?= $lang_polymer_mod1 ?><input id="reason" type="text" value="<?= $lang_polymer_mod2 ?>" placeholder="<?= $lang_polymer_mod2 ?>"><br>
                <a onclick="confirmDelete()" id="dact2" class="jslink hide"><?= $lang_moderate_dact2 ?></a>
                <a onclick="confirmDisable()" id="dact1" class="jslink hide"><?= $lang_moderate_dact1 ?></a><br>
                <a onclick="cancel()" class="jslink"><?= $lang_moderate_dcancel ?></a>
            </div>
            <div id="ep_procdiv" class="hide">
                <h1><?= $lang_moderate_ptitle ?></h1>
                <?= $lang_moderate_pdesc ?>
            </div>
        </div>
        <script src="index.js"></script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>