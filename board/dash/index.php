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
        <title><?= $lang_board_dash ?></title>
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
            <?php
            
            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board")) {
                mkdir($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board");
                file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/shared", "");
                file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/content", "");
                file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/online", "");
                mkdir($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/settings");
                file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/settings/color", "0");
                file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/settings/font", "0");
                file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/settings/autoclear", "0");
                file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/settings/shares", "");
            }

            ?>
            <h1><?= $lang_board_home ?></h1>
            <h2><?= $lang_board_my ?></h2>
            <ul>
                <li><a href="/board/edit/?user=<?= $user ?>"><?= $lang_board_edit ?></a></li>
            </ul>
            <h2><?= $lang_board_shared ?></h2>
            <ul>
                <?php
                
                $lines = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/board/shared"));
                $printed = false;
                foreach ($lines as $sel) {
                    if (trim($sel) != "") {
                        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $sel)) {
                            echo('<li><a href="/board/edit/?user=' . $sel . '">' . $sel . '</a></li>');
                            $printed = true;
                        } else {
                            echo("<li><i>" . $lang_board_removed . "</i></li>");
                            $printed = true;
                        }
                    }
                }
                if (!$printed) {
                    echo("<i>" . $lang_board_nothing . "</i>");
                }
                
                ?>
            </ul>
        </div>
        <script src="index.js"></script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>