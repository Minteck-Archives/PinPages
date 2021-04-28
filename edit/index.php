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

if (isset($_GET['id']))
{
    $id = $_GET['id'];
    if ($id == "")
    {
        echo("<script>document.cookie = \"\";location.href = \"/page/?lang=" . $langprop . "\"</script>");
        exit;
    }
}
else
{
    echo("<script>document.cookie = \"\";location.href = \"/page/?lang=" . $langprop . "\"</script>");
    exit;
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $id))
{
    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $id . "/content") == "deleted" || file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $id . "/content") == "mdeleted")
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
        <title><?= $lang_edit_titlep1 . $id . $lang_edit_titlep2 ?></title>
        <meta charset="UTF-8">
        <script>id = "<?= $id ?>"</script>
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
                <h1 class="ep_title"><?= $lang_edit_title ?> <span class="ep_posttitle"><a class="jslink" onclick="deletePost()"><?= $lang_edit_delete ?></a> <span class="ep_postid"><?= $lang_edit_id ?> <?= $id ?></span></span></h1>
                <h2><?= $lang_edit_text ?></h2>
                <?php

                $post = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $id . "/content");
                $steps = explode('#', $post);

                ?>
                <span id="ep_chars"><?= strlen($steps[1]) ?></span>/1000<br>
                <textarea onchange="countChars()" onkeyup="countChars()" id="ep_text" class="ep_text"><?php
                
                echo(str_replace("<br>", "\n", $steps[1]));

                ?></textarea><br>
                <h2><?= $lang_edit_link ?></h2>
                <?php

                $linkparts = explode("#", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $id . "/link"));
                $lname = "";
                $ltarg = "";
                if (isset($linkparts[0]))
                {
                    $lname = str_replace("&lt;", "<", $linkparts[0]);
                    $lname = str_replace("&gt;", ">", $lname);
                }
                if (isset($linkparts[1]))
                {
                    $ltarg = str_replace("▓", "#", $linkparts[1]);
                }

                ?>
                <input type="text" id="ep_lname" placeholder="<?= $lang_edit_lname ?>" value="<?= $lname ?>" class="header_search"><br>
                <input type="text" id="ep_ltarg" placeholder="<?= $lang_edit_ltarg ?>" value="<?= $ltarg ?>" class="header_search">
                <br><br>
                <a onclick="savePost()" id="ep_save" class="jslink"><?= $lang_edit_save ?></a>
            </div>
            <div id="ep_deldiv" class="hide">
                <h1><?= $lang_delete_title ?></h1>
                <?= $lang_delete_desc ?><br><br>
                <a onclick="confirmDelete()" class="jslink"><?= $lang_delete_yes ?></a><br>
                <a onclick="cancelDelete()" class="jslink"><?= $lang_delete_no ?></a>
            </div>
        </div>
        <script src="index.js"></script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>