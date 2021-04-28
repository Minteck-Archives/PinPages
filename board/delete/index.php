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

if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board")) {
    die("<script>location.href = \"/board\"</script>");
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/favicon.svg" />
        <link rel="stylesheet" href="/resources/style/global.css" />
        <title><?= $lang_board_delete ?></title>
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
        <script>var lang_err = "<?= $lang_board_deleteerr ?>";</script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/header_board.php"; ?>
        <div class="header_escape">
            <center class="question">
                <h1><?= $lang_board_delete1 ?></h1>
                <p>
                    <?= $lang_board_delete2 ?>
                    <ul>
                        <li><a onclick="deleteAccount()"><?= $lang_board_delete3 ?></a></li>
                        <li><a href="/board/settings"><?= $lang_board_delete4 ?></a></li>
                    </ul>
                </p>
            </center>
            <center class="answer hide">
                <h1><?= $lang_board_delete5 ?></h1>
                <p>
                    <?= $lang_board_delete6 ?>
                </p>
            </center>
        </div>
        <script src="index.js"></script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>