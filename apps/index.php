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
        <title><?= $lang_pm3apps_title ?></title>
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
    <body class="obody">
        <script>var langprop = "<?= $langprop ?>";</script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/header.php"; ?>
        <div class="header_escape">
            <h1><center><?= $lang_pm3apps_header ?></center></h1>
            <div id="apps_list">
                <div><table><tr>
                    <td><img src="/resources/image/logo_social.png" id="apps_logo"></td>
                    <td><b>PinPages Social</b><p><?= $lang_pm3apps_social_desc ?></p><a href="/app" id="apps_button"><?= $lang_pm3apps_social_action ?></a></td>
                </tr></table></div>
                <div><table><tr>
                    <td><img src="/resources/image/logo_board.png" id="apps_logo"></td>
                    <td><b>PinPages Board</b><p><?= $lang_pm3apps_board_desc ?></p><a href="/board" id="apps_button"><?= $lang_pm3apps_board_action ?></a></td>
                </tr></table></div>
                <div><table><tr>
                    <td><img src="/resources/image/logo_stats.png" id="apps_logo"></td>
                    <td><b>PinPages Stats</b><p><?= $lang_pm3apps_stats_desc ?></p><i><?= $lang_pm3apps_soon ?></i></td>
                </tr></table></div>
                <div><table><tr>
                    <td><img src="/resources/image/logo_track.png" id="apps_logo"></td>
                    <td><b>PinPages Tracking</b><p><?= $lang_pm3apps_track_desc ?></p><i><?= $lang_pm3apps_soon ?></i></td>
                </tr></table></div>
            </div>
        </div>
        <script src="index.js"></script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>