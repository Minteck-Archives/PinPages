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

$count = trim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/count")) + 1

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/favicon.svg" />
        <link rel="stylesheet" href="/resources/style/global.css" />
        <title><?= $lang_add_titlep1 . $count . $lang_add_titlep2 ?></title>
        <meta charset="UTF-8">
        <script>id = "<?= $count ?>"</script>
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
                <h1 class="ep_title"><?= $lang_add_title ?> <span class="ep_posttitle"><span class="ep_postid"><?= $lang_add_id ?> <?= $count ?></span></span></h1>
                <h2><?= $lang_add_text ?></h2>
                <span id="ep_chars">0</span>/1000<br>
                <textarea onchange="countChars()" onkeyup="countChars()" id="ep_text" class="ep_text"></textarea><br>
                <h2><?= $lang_add_link ?></h2>
                <input type="text" id="ep_lname" placeholder="<?= $lang_add_lname ?>" class="header_search"><br>
                <input type="text" id="ep_ltarg" placeholder="<?= $lang_add_ltarg ?>" class="header_search">
                <br><br>
                <i><?= $lang_add_disclaimer ?></i>
                <br><br>
                <a onclick="savePost()" id="ep_save" class="jslink"><?= $lang_add_save ?></a>
            </div>
        </div>
        <script src="index.js"></script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>