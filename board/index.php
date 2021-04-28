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
        <title><?= $lang_board_title ?></title>
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
    <body class="abody boardhome">
        <script>var langprop = "<?= $langprop ?>";</script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/header_board.php"; ?>
        <div class="header_escape">
            <?php
            
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board")) {
                die("<script>location.href = \"/board/dash\";</script>");
            }
            
            ?>
            <center>
                <h1><?= $lang_board_welcome ?></h1>
                <p><b><?= $lang_board_ad ?></b></p>
            
                <h2><?= $lang_board_howto ?></h2>
                <p>
                    (1) <?= $lang_board_step1 ?><br>
                    (2) <?= $lang_board_step2 ?><br>
                    (3) <?= $lang_board_step3 ?><br>
                </p>

                <h2><?= $lang_board_points ?></h2>
                <ul id="boardpoints">
                    <li><?= $lang_board_point1 ?></li>
                    <li><?= $lang_board_point2 ?></li>
                    <li><?= $lang_board_point3 ?></li>
                    <li><?= $lang_board_point4 ?></li>
                    <li><?= $lang_board_point5 ?></li>
                    <li><?= $lang_board_point6 ?></li>
                </ul>

                <a id="boardsignup" class="loginsub" id="login_submit" href="/board/dash"><?= $lang_board_start ?></a>
            </center>

            <br><br><br>

            <p><small>* <?= $lang_board_disclaimer ?></small></p>
        </div>
        <script src="index.js"></script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>