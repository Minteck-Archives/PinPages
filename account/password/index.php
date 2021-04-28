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
        <title><?= $lang_pm3acc_password ?></title>
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
        <h1><?= $lang_newsetup_password ?></h1>
        <span class="save_error_1 hide" id="save_error_1" style="padding: 5px;border-color: #a84b4b;border-width: 1px;border-bottom-style: solid;margin-bottom: 5px;font-family: 'Roboto Light';">
            <img src="/resources/icons/lightback/ic_warning_grey600_24dp.png" style="vertical-align: middle;filter: brightness(0%);" width="24px" height="24px"> <?= $lang_password_error ?> 1
        </span>
        <span class="save_error_2 hide" id="save_error_2" style="padding: 5px;border-color: #a84b4b;border-width: 1px;border-bottom-style: solid;margin-bottom: 5px;font-family: 'Roboto Light';">
            <img src="/resources/icons/lightback/ic_warning_grey600_24dp.png" style="vertical-align: middle;filter: brightness(0%);" width="24px" height="24px"> <?= $lang_password_error ?> 2
        </span>
        <span class="save_error_3 hide" id="save_error_3" style="padding: 5px;border-color: #a84b4b;border-width: 1px;border-bottom-style: solid;margin-bottom: 5px;font-family: 'Roboto Light';">
            <img src="/resources/icons/lightback/ic_warning_grey600_24dp.png" style="vertical-align: middle;filter: brightness(0%);" width="24px" height="24px"> <?= $lang_password_error ?> 3
        </span>
        <span class="save_error_4 hide" id="save_error_4" style="padding: 5px;border-color: #a84b4b;border-width: 1px;border-bottom-style: solid;margin-bottom: 5px;font-family: 'Roboto Light';">
            <img src="/resources/icons/lightback/ic_warning_grey600_24dp.png" style="vertical-align: middle;filter: brightness(0%);" width="24px" height="24px"> <?= $lang_password_error ?> 4
        </span>
        <span class="save_error_5 hide" id="save_error_5" style="padding: 5px;border-color: #a84b4b;border-width: 1px;border-bottom-style: solid;margin-bottom: 5px;font-family: 'Roboto Light';">
            <img src="/resources/icons/lightback/ic_warning_grey600_24dp.png" style="vertical-align: middle;filter: brightness(0%);" width="24px" height="24px"> <?= $lang_password_error ?> 5
        </span>
        <span class="save_error_6 hide" id="save_error_6" style="padding: 5px;border-color: #a84b4b;border-width: 1px;border-bottom-style: solid;margin-bottom: 5px;font-family: 'Roboto Light';">
            <img src="/resources/icons/lightback/ic_warning_grey600_24dp.png" style="vertical-align: middle;filter: brightness(0%);" width="24px" height="24px"> <?= $lang_password_error ?> 6
        </span>
        <span class="save_success hide" id="save_success" style="padding: 5px;border-color: #4ba860;;border-width: 1px;border-bottom-style: solid;margin-bottom: 5px;font-family: 'Roboto Light';">
            <img src="/resources/icons/lightback/ic_check_grey600_24dp.png" style="vertical-align: middle;filter: brightness(0%);" width="24px" height="24px"> <?= $lang_password_success ?>
        </span>
                                <input type="password" id="password_old" name="password_old" placeholder="<?= $lang_password_oldpass ?>"><br>
            <input type="password" id="password_new" name="password_new" placeholder="<?= $lang_password_newpass ?>"><br>
            <input type="password" id="password_new2" name="password_new2" placeholder="<?= $lang_password_newrept ?>"><br>
            <a class="jslink" id="password_submit" onclick="changePassword();"><?= $lang_password_submit ?></a>
            <div id="loader" class="hide" style="margin:16px;">
        <svg class="spinner" width="48px" height="48px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
            <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
        </svg>
    </div>
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
