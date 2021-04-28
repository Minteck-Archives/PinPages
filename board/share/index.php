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
        <title><?= $lang_board_share12 ?></title>
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
            <center id="page">
                <h1><?= $lang_board_share1 ?></h1>
                <p>
                    <?php
                    
                    if (trim(str_replace("\n", "", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/settings/shares") == ""))) {
                        $noShares = true;
                        echo("<i>" . $lang_board_share13 . "</i>");
                    } else {
                        $found = false;
                        foreach (explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/settings/shares")) as $line) {
                            if (trim($line) != "") {
                                $found = true;
                            }
                        }
                        if (!$found) {
                            $noShares = true;
                            echo("<i>" . $lang_board_share13 . "</i>");
                        } else {
                            $noShares = false;
                        }
                    }
                    
                    ?>
                    <?= !$noShares ? "<ul>" : "" ?>
                        <?php

                        $shares = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/settings/shares");
                        $shares = explode("\n", $shares);
                        foreach ($shares as $share) {
                            if ($share != "") {
                                $shareparts = explode("|", $share);
                                echo("<li><i><a href=\"/page/?user=" . $shareparts[0] . "\">" . $shareparts[0] . "</a></i> — <select onchange=\"updatePerms(`" . $shareparts[0] . "`)\" id=\"perms-" . $shareparts[0] . "\"><option value=\"1\">" . $lang_board_share2 . "</option><option value=\"0\">" . $lang_board_share3 . "</option></select> — <a onclick=\"removeUser(`" . $shareparts[0] . "`)\">" . $lang_board_share4 . "</a></li>");
                            }
                        }

                        ?>
                    <?= !$noShares ? "</ul>" : "" ?>
                </p>
                <h2><?= $lang_board_share9 ?></h2>
                <p>
                    <input type="text" class="header_search" placeholder="<?= $lang_board_share10 ?>" id="addshare-username"> — <select id="addshare-perms"><option value="1"><?= $lang_board_share2 ?></option><option value="0"><?= $lang_board_share3 ?></option></select> — <a onclick="addShare()"><?= $lang_board_share11 ?></a>
                </p>
            </center>
            <center id="loader1" class="hide">
                <h1><?= $lang_board_share5 ?></h1>
                <p><?= $lang_board_share6 ?></p>
            </center>
            <center id="loader2" class="hide">
                <h1><?= $lang_board_share7 ?></h1>
                <p><?= $lang_board_share8 ?></p>
            </center>
        </div>
        <script src="index.js"></script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>