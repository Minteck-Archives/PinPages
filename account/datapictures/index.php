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
        <title><?= $lang_pm3acc_datapictures ?></title>
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
        <h1><?= $lang_newsetup_datapictures ?></h1>
                                <h2><?= $lang_newsetup_datapictures1 ?></h2>
                                <span class="pp_error_1 hide" id="pp_error_1"><span style="padding: 5px;border-radius: 5px;background: #ed6969;border-color: #a84b4b;border-style: solid;border-width: 1px;color: black;">
                <img src="/resources/icons/lightback/ic_warning_grey600_24dp.png" style="vertical-align: middle;filter: brightness(0%);" width="24px" height="24px"> <?= $lang_pictures_invalid ?>
            </span><br><br></span>
            <span class="pp_error_2 hide" id="pp_error_2"><span style="padding: 5px;border-radius: 5px;background: #ed6969;border-color: #a84b4b;border-style: solid;border-width: 1px;color: black;">
                <img src="/resources/icons/lightback/ic_warning_grey600_24dp.png" style="vertical-align: middle;filter: brightness(0%);" width="24px" height="24px"> <?= $lang_pictures_error ?>
            </span><br><br></span>
            <span class="pp_error_3 hide" id="pp_error_3"><span style="padding: 5px;border-radius: 5px;background: #ed6969;border-color: #a84b4b;border-style: solid;border-width: 1px;color: black;">
                <img src="/resources/icons/lightback/ic_warning_grey600_24dp.png" style="vertical-align: middle;filter: brightness(0%);" width="24px" height="24px"> <?= $lang_pictures_error3 ?>
            </span><br><br></span>
            <span class="pp_success_1 hide" id="pp_success_1"><span style="padding: 5px;border-radius: 5px;background: #7aed69;border-color: #4ba860;border-style: solid;border-width: 1px;color: black;">
                <img src="/resources/icons/lightback/ic_check_grey600_24dp.png" style="vertical-align: middle;filter: brightness(0%);" width="24px" height="24px"> <?= $lang_pictures_success1 ?>
            </span><br><br></span>
            <span class="pp_success_2 hide" id="pp_success_2"><span style="padding: 5px;border-radius: 5px;background: #7aed69;border-color: #4ba860;border-style: solid;border-width: 1px;color: black;">
                <img src="/resources/icons/lightback/ic_check_grey600_24dp.png" style="vertical-align: middle;filter: brightness(0%);" width="24px" height="24px"> <?= $lang_pictures_success2 ?>
            </span><br><br></span>
            <form name="ppic" id="ppic" style="display:none;">
                <input type="file" name="profilepic" id="profilepic" style="display:none;" accept="image/*" onchange="uploadValidation()">
            </form>
            <?php
            
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/resources/image/profile/" . $user . ".jpg"))
            {
                echo("<a class=\"ppupdate ppupload\" href=\"#\" id=\"ppupload\"></a>");
                echo("<script>var ProfilePicture = true</script>");
                echo("<span id=\"when_uploaded\"> | <a class=\"jslink\" onclick=\"uploadProfilePic()\">" . $lang_pictures_update . "</a></span><span id=\"ppinvalid\">" . $lang_pictures_invalid . " | </span><span id=\"ppreset\"> | <a class=\"jslink\" onclick=\"removeProfilePic()\">" . $lang_pictures_remove . "</a></span>");
            }
            else
            {
                echo("<a class=\"ppadd ppupload\" href=\"#\" id=\"ppupload\"></a>");
                echo("<script>var ProfilePicture = false</script>");
                echo("<span id=\"when_uploaded\"> | <a class=\"jslink\" onclick=\"uploadProfilePic()\">" . $lang_pictures_upload . "</a></span><span id=\"ppreset\"> | <a class=\"jslink\" onclick=\"removeProfilePic()\">" . $lang_pictures_remove . "</a></span>");
            }

            ?>
                            <h2><?= $lang_polymer2_dldata1 ?></h2>
                            <span id="dl_json"><?= $lang_polymer2_dldata2 ?><br>
                            <a href="/getdata/?type=json"><?= $lang_polymer2_dldata3 ?></a></span>
                            <h2><?= $lang_polymer_email0 ?></h2>
            <?php

            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/email")) {
                echo($lang_polymer_email1 . "<br>");
                echo("<input id=\"account_email\" onchange=\"validateEmail()\" type=\"text\" class=\"header_search\" placeholder=\"" . $lang_polymer_email2 . "\" value=\"" . file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/email") . "\"><script>var currentEmail = \"" . file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/email") . "\";</script>");
            }
            else
            {
                echo($lang_polymer_email3 . "<br>");
                echo("<input id=\"account_email\" onchange=\"validateEmail()\" type=\"text\" class=\"header_search\" placeholder=\"" . $lang_polymer_email2 . "\" value=\"\"><script>var currentEmail = \"\";</script>");
            }

            ?>
            <br><a class="jslink hide" id="change_email" onclick="changeEmail()"><?= $lang_polymer_email4 ?></a><span class="hide red_color" id="accmail_invalid"><?= $lang_polymer_email5 ?></span>
            <a class="jslink hide" id="reset_email" onclick="changeEmail()"><?= $lang_pm3glob_resetmail ?></a>
            <span class="success_email hide" id="success_email" style="padding: 5px;border-radius: 5px;background: #7aed69;border-color: #4ba860;border-style: solid;border-width: 1px;color: black;">
                <img src="/resources/icons/lightback/ic_check_grey600_24dp.png" style="vertical-align: middle;filter: brightness(0%);" width="24px" height="24px"> <?= $lang_polymer_email6 ?>
            </span>
            <span class="error_email hide" id="error_email" style="padding: 5px;border-radius: 5px;background: #ed6969;border-color: #a84b4b;border-style: solid;border-width: 1px;color: black;">
                <img src="/resources/icons/lightback/ic_warning_grey600_24dp.png" style="vertical-align: middle;filter: brightness(0%);" width="24px" height="24px">
            </span>
            <h2><?= $lang_account_admin ?></h2>
            <center><span class="adminel" onclick="showDelete()"><img src="/resources/icons/lightback/ic_delete_grey600_24dp.png" class="accountadminicons" height=24px width=24px> <?= $lang_accadmin_delete ?></span></center><br>
            <center><span class="adminel" onclick="location.href = '/tutorial/?source=settings'"><img src="/resources/icons/lightback/ic_directions_grey600_24dp.png" class="accountadminicons" height=24px width=24px> <?= $lang_polymer_admint ?></span></center>
            <h2><?= $lang_overview_verification ?></h2>
            <?php

            if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/verification/status") == "False")
            {
                echo("<a class=\"unverified\"></a> <span class=\"verification\">" . $lang_verification_no . "</span><br>");
            }
            else
            {
                echo("<a class=\"verified\"></a> <span class=\"verification\" style=\"bottom: 36px;position: relative;\">" . $lang_verification_yesp1 . file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/verification/since") . $lang_verification_yesp2 . "</span>");
            }

            ?>
        </div>
        <div class="vcenter hide" id="delete">
            <div class="vcenter" id="deletecnt">
                <img src="/resources/icons/darkback/ic_warning_white_24dp.png" height=48px width=48px>
                <h2 style="font-family:Roboto;color:white;"><?= $lang_remove_warn ?></h2>
                <br>
                <span style="color:white;">
                    <?= $lang_remove_desc ?><br>
                    <?= $lang_remove_ask ?><br><br><br>
                </span>
                <a onclick="<?= !file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/email") ? "deleteAccount()" : "sendDeleteEmail()" ?>" class="delete_confirm"><?= $lang_remove_yes ?></a><br><br><br>
                <a onclick="hideDelete()" class="delete_cancel"><?= $lang_remove_no ?></a><br>
            </div>
        </div>
        <script src="index.js"></script>
        <script>
            
            var lang_pictures_add = "<?= $lang_pictures_upload ?>"
            var lang_pictures_edit = "<?= $lang_pictures_update ?>"
            var lang_uts = "<?= $lang_newsetup_uts ?>"
            var lang_delete_ems = "<?= $lang_pm3del_confirm ?>"
            var lang_delete_emsok = "<?= $lang_pm3del_confirm2 ?>"
            
        </script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>
