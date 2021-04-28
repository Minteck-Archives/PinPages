<?php 

include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/languageHandler.php";

?>

<script src="/resources/libs/jquery.js"></script>
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

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/favicon.svg" />
        <link rel="stylesheet" href="/resources/style/global.css" />
        <title><?= $lang_notifications_page ?></title>
        <meta charset="UTF-8">
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
        <script src="/resources/libs/jquery.js"></script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/header.php"; ?>
        <script src="index.js"></script>
        <div class="header_escape">
        <h1><?= $lang_notifications_title ?></h1>
            <h2><?= $lang_notifications_ur ?></h2>
            <?php

                $notifs = false;
                $lines = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/notifications/unread"));
                foreach ($lines as $line) {
                    if ($line == "")
                    {
                    }
                    else
                    {
                        $array = explode("#", $line);
                        echo("<span class=\"notif_title\">" . $array[0] . "</span><span class=\"notif_date\"> • " . $array[2] . "</span><br><span class=\"notif_desc\">" . $array[1] . "</span><br><br>");
                        $notifs = true;
                    }
                }
                if ($notifs == false)
                {
                    echo("<span class=\"tip\">" . $lang_notifications_nour . "</span><br><br>");
                }
                else
                {
                    echo("<a onclick=\"clearNotifications()\" class=\"jslink\">". $lang_notifications_read . "</a>");
                }

            ?>
            <h2><?= $lang_notifications_re ?></h2>
            <?php

                $notifs = false;
                $lines = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/notifications/read"));
                $count = count($lines);
                foreach ($lines as $line) {
                    if (trim($line) == "") {
                        $count = $count - 1;
                    }
                }
                $current = 0;
                $halt = false;
                foreach ($lines as $line) {
                    if ($line == "")
                    {
                    }
                    else
                    {
                        if (!$halt) {
                            if ($current < 10) {
                                $array = explode("#", $line);
                                if (count($array) == 3) {
                                    echo("<span class=\"notif_title\">" . $array[0] . "</span><span class=\"notif_date\"> • " . $array[2] . "</span><br><span class=\"notif_desc\">" . $array[1] . "</span><br><br>");
                                    $notifs = true;
                                    $current = $current + 1;
                                }
                            } else {
                                echo("<i>" . $lang_pm3notifs_more1 . ($count - 10) . $lang_pm3notifs_more2 . "</i>");
                                $halt = true;
                            }
                        }
                    }
                }
                if ($notifs == false)
                {
                    echo("<span class=\"tip\">" . $lang_notifications_nore . "</span><br><br>");
                }
                else
                {
                }

            ?>
        </div>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>