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
        echo("<script>location.href = \"/login/?return=" . urlencode($_SERVER['REQUEST_URI']) . "\"</script>");
        exit;
    }
}
else
{
    echo("<script>location.href = \"/login/?return=" . urlencode($_SERVER['REQUEST_URI']) . "\"</script>");
        exit;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/favicon.svg" />
        <link rel="stylesheet" href="/resources/style/global.css" />
        <title><?= $lang_board_about ?></title>
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
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/header_board.php"; ?>
        <div class="header_escape">
        <center>
                <img src="/resources/image/logo_board.png" style="vertical-align:middle;margin-right:10px;" width="256px" class="redmob" height="256px">
                <h1><b>PinPages</b> Board</h1>
                <?= $lang_board_about1 ?><?php
                
                include_once $_SERVER['DOCUMENT_ROOT'] . "/properties.php";
                echo($prop_version);
                
                ?><br>
                <?= $lang_newsetup_bty2 . $prop_builton . $lang_newsetup_bty3 . $prop_testedon . $lang_newsetup_bty4 ?><br><br>
                <?= $lang_board_about2 ?> Apache, PHP, JavaScript, HTML5, CSS3, ECMA Script 2015, ECMA Script 2016, Product Sans, Material Design, The HyperText Transfer Protocol, The HyperText Transfer Protocol on SSL, Google Translate, <?= $lang_board_about3 ?><br><br>
                <?= $lang_board_about4 ?>KDE Plasma 5, Microsoft Visual Studio Code, GNU Image Manipulation Program, GNU/Linux, Ubuntu GNU/Linux, Mozilla Firefox Nightly ,<?= $lang_board_about5 ?>
            </center>
        </div>
        <script src="index.js"></script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>