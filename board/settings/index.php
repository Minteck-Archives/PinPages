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
        <title><?= $lang_board_settings ?></title>
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
        <script>var lang_err = "<?= $lang_board_settingserr ?>";</script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/header_board.php"; ?>
        <div class="header_escape">
            <center>
                <h1><?= $lang_board_settings1 ?></h1>
                <h2><?= $lang_board_settings11 ?></h2>
                <p>
                    <?= $lang_board_settings2 ?><br>
                    <select onchange="saveSettings()" id="colorscheme">
                        <option value="0" <?= file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/settings/color") == "0" ? "selected" : "" ?>><?= $lang_board_settings3 ?></option>
                        <option value="1" <?= file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/settings/color") == "1" ? "selected" : "" ?>><?= $lang_board_settings4 ?></option>
                    </select>
                </p>
                <p>
                    <?= $lang_board_settings5 ?><br>
                    <select onchange="saveSettings()" id="font">
                        <option value="0" <?= file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/settings/font") == "0" ? "selected" : "" ?>><?= $lang_board_settings6 ?></option>
                        <option value="1" <?= file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/settings/font") == "1" ? "selected" : "" ?>><?= $lang_board_settings7 ?></option>
                    </select>
                </p>
                <h2><?= $lang_board_settings12 ?></h2>
                <p>
                    <input onchange="saveSettings()" type="checkbox" id="autoclear" name="acbox" <?= file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/settings/autoclear") == "1" ? "checked" : "" ?>>
                    <label for="acbox"><?= $lang_board_settings8 ?></label>
                    <ul>
                        <li>
                            <a href="/board/share"><?= $lang_board_settings9 ?></a>
                        </li>
                        <li>
                            <a href="/board/delete"><?= $lang_board_settings10 ?></a>
                        </li>
                    </ul>
                </p>
            </center>
        </div>
        <script src="index.js"></script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>