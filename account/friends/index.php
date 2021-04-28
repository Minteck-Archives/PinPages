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

function isUserTimezone($tz) {
    global $user;
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/timezone")) {
        $utz = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/timezone");
        if (trim($utz) == trim($tz)) {
            echo("selected");
        }
    } else {
        if (trim($tz) == "2") {
            echo("selected");
        }
    }
}

function jsSetTimezone() {
    global $user;
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/timezone")) {
        $utz = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/timezone");
        echo("<script>$('#timezone')[0].value = \"{$utz}\"</script>");
    } else {
        echo("<script>$('#timezone')[0].value = \"2\"</script>");
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/favicon.svg" />
        <link rel="stylesheet" href="/resources/style/global.css" />
        <title><?= $lang_pm3acc_friends ?></title>
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
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/header.php"; ?>
        <div class="header_escape">
        <div class="account_back"><center><a onclick="location.href = '/account';" class="ab_link"><img src="/resources/icons/lightback/ic_home_grey600_24dp.png" class="icc"><?= $lang_pm3_account ?></a></center></div><br>
        <h1><?= $lang_newsetup_friends ?></h1>
                                <h3><?= $lang_friends_requests ?> (<?php
            
            $friends = array_map('trim', explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/friends/incoming")));

            $pos = 0;
            foreach ($friends as $friend) {
                $friend = trim($friend);
                if ($friend == "") {} else {
                    $pos = $pos + 1;   
                }
            }
            echo($pos);
            
            ?>)</h3>
            <?php

            $isfriends = false;
            $friends = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/friends/incoming"));
            $friends = array_map('trim', $friends);
            foreach($friends as $friend) {
                if (trim($friend) != "") {
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $friend))
                {
                    $isfriends = true;
                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/resources/image/profile/" . $friend . ".jpg"))
                    {
                        echo("<img class=\"up_ppic\" src=\"/resources/image/profile/" . $friend . ".jpg\" height=38px width=38px>");
                        echo("<span class=\"up_puser up_puser_alt\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $friend . "/realname")) . "</span>");
                    }
                    else
                    {
                        echo("<a class=\"up_noppic\"></a>");
                        echo("<span class=\"up_puser\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $friend . "/realname")) . "</span>");
                    }
                    echo("<span onclick=\"validateFriend(`" . $friend . "`)\" class=\"srgo\">" . $lang_friends_validate . "</span>");
                    echo("<span onclick=\"ignoreFriend(`" . $friend . "`)\" class=\"srremove\">" . $lang_friends_ignore . "</span><br><hr class=\"dbfrsep\">");
                }
                }
            }
            if ($isfriends == false)
            {
                echo("<span class=\"tip\">" . $lang_friends_norqs . "</span>");
            }

            ?>
            <h3><?= $lang_friends_actual ?> (<?php
            
            $friends = array_map('trim', explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/friends/valided")));

            $pos = 0;
            foreach ($friends as $friend) {
                $friend = trim($friend);
                if ($friend == "") {} else {
                    $pos = $pos + 1;   
                }
            }
            echo($pos);
            
            ?>)</h3>
            <?php

            $isfriends = false;
            $fr_deleted = 0;
            $friends = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/friends/valided"));
            $friends = array_map('trim', $friends);
            foreach($friends as $friend) {
                if (trim($friend) != "") {
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $friend))
                {
                    $isfriends = true;
                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/resources/image/profile/" . $friend . ".jpg"))
                    {
                        echo("<img class=\"up_ppic\" src=\"/resources/image/profile/" . $friend . ".jpg\" height=38px width=38px>");
                        echo("<span class=\"up_puser up_puser_alt\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $friend . "/realname")) . "</span>");
                    }
                    else
                    {
                        echo("<a class=\"up_noppic\"></a>");
                        echo("<span class=\"up_puser\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $friend . "/realname")) . "</span>");
                    }
                    echo("<a href=\"/remove/?lang=" . $langprop . "&name=" . $friend . "\" class=\"srremove nolink\">" . $lang_friends_remove . "</a>");
                    echo("<a href=\"/page/?lang=" . $langprop . "&user=" . $friend . "\" class=\"sradd nolink\">" . $lang_friends_page . "</a><br><hr class=\"dbfrsep\">");
                }
                else
                {
                    $fr_deleted = $fr_deleted + 1;  
                }
            }}
            if ($fr_deleted > 0)
            {
                if ($fr_deleted < 2)
                {
                    echo("<center><i>" . $lang_friends_hidden1 . $fr_deleted . $lang_friends_hidden2a . "</i></center>");
                }
                else
                {
                    echo("<center><i>" . $lang_friends_hidden1 . $fr_deleted . $lang_friends_hidden2b . "</i></center>");
                }
            }
            if ($isfriends == false)
            {
                echo("<span class=\"tip\">" . $lang_friends_noval . "</span>");
            }

            ?>
        </div>
        <script src="index.js"></script>
        <script>
            
            var lang_pictures_add = "<?= $lang_pictures_upload ?>"
            var lang_pictures_edit = "<?= $lang_pictures_update ?>"
            var lang_uts = "<?= $lang_newsetup_uts ?>"
            
        </script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>
