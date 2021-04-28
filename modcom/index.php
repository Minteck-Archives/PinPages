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

if (isset($_GET['postid']))
{
    $postid = $_GET['postid'];
    if ($postid == "")
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

if (isset($_GET['comid']))
{
    $comid = $_GET['comid'];
    if ($comid == "")
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

if (isset($_GET['comuser']))
{
    $comuser = $_GET['comuser'];
    if ($comuser == "")
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

if (isset($_GET['postuser']))
{
    $postuser = $_GET['postuser'];
    if ($postuser == "")
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

if (isset($_GET['comtext']))
{
    $comtext = $_GET['comtext'];
    if ($comtext == "")
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

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $postuser . "/page/" . $postid))
{
    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $postuser . "/page/" . $postid . "/content") == "deleted" || file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $postuser . "/page/" . $postid . "/content") == "mdeleted")
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
        <title><?= $lang_moderate_titlep1 . $postid . ":" . $comid . $lang_moderate_titlep2 ?></title>
        <meta charset="UTF-8">
        <script>postid = "<?= $postid ?>"; postuser = "<?= $postuser ?>"; comid = "<?= $comid ?>"; comuser = "<?= $comuser ?>"; comtext = "<?= $comtext ?>";</script>
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
            <div id="ep_deldiv">
                <h1><?= $lang_polymer2_comdel1 ?></h1>
                <?= $lang_polymer2_comdel2 ?><br><br>
                <b><?= $lang_polymer2_comdel3 ?></b><br>
                <?= $postuser ?>
                <br><br><b><?= $lang_polymer2_comdel4 ?></b><br>
                <?= $comuser ?>
                <br><br><b><?= $lang_polymer2_comdel5 ?></b><br>
                <?= $comtext ?>
                <br><br><b><?= $lang_polymer2_comdel6 ?></b><br>
                <?= $postid . ":" . $comid ?><br><br>
                <?= $lang_polymer_mod1 ?><input id="reason" type="text" value="<?= $lang_polymer_mod2 ?>" placeholder="<?= $lang_polymer_mod2 ?>"><br><br>
                <a onclick="confirmDelete()" id="dact2" class="jslink"><?= $lang_polymer2_comdel7 ?></a><br>
                <a onclick="cancel()" class="jslink"><?= $lang_polymer2_comdel8 ?></a>
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