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
        <title><?= $lang_account_pagetitle ?></title>
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
    <body class="abody"style="/*overflow: hidden;*/">
        <center>
        <script>var langprop = "<?= $langprop ?>";</script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/header.php"; ?>
        <div class="header_escape">
            <!-- <table style="margin: -5px;width: 100%;height: 92.1%;">
                <tbody style="margin: -4px;height: 92.1%;">
                    <tr style="margin: -4px;height: 92.1%;">
                        <td class="settings_panel settings" style="margin: -4px;height: 92.1%;width: 15%;padding: 15px;">
                            <div onclick="showcat('appearance');" class="settingpc"><center><?= $lang_newsetup_appearance ?></center></div>
                            <div onclick="showcat('password');" class="settingpc"><center><?= $lang_newsetup_password ?></center></div>
                            <div onclick="showcat('datapictures');" class="settingpc"><center><?= $lang_newsetup_datapictures ?></center></div>
                            <div onclick="showcat('name');" class="settingpc"><center><?= $lang_newsetup_name ?></center></div>
                            <div onclick="showcat('privacy');" class="settingpc"><center><?= $lang_newsetup_privacy ?></center></div>
                            <div onclick="showcat('friends');" class="settingpc"><center><?= $lang_newsetup_friends ?></center></div>
                            <div onclick="showcat('timedate');" class="settingpc"><center><?= $lang_newsetup_timedate ?></center></div>
                            <div onclick="showcat('about');" class="settingpc_special settingpc_specialsep"><center><?= $lang_newsetup_about ?></center></div>
                        </td>
                        <td class="settings_elements" style="margin: -4px;vertical-align:top;overflow:scroll;height:50%;">
                            <div class="settings_home settingel" id="settings_home" style="overflow:auto;width:100%;height:100%;display:block;">
                                <center><img src="/resources/image/account.svg" width=256px height=256px style="filter: hue-rotate(58.1deg);"><h1><?= $lang_polymer_account ?><br><?= $lang_polymer_account2 ?></h1></center>
    </div>
                                <div class="settings_timedate settingel hide" id="settings_timedate" style="overflow:auto;width:100%;height:100%;display:block;">
                                    <h1><?= $lang_newsetup_timedate ?></h1>
                                    <?= $lang_timedate_timezone ?>
                                    <select id="timezone" onchange="saveSettings();">
                                        <option value="-11" <?= isUserTimezone('-11') ?>>Midway Island</option>
                                        <option value="-10" <?= isUserTimezone('-10') ?>>Hawaii</option>
                                        <option value="-8" <?= isUserTimezone('-8') ?>>Alaska</option>
                                        <option value="-7" <?= isUserTimezone('-7') ?>>Pacific Time, Tijuana, Arizona</option>
                                        <option value="-6" <?= isUserTimezone('-6') ?>>Chihuahua, Mountain Time, Central America, Saskatchewan</option>
                                        <option value="-5" <?= isUserTimezone('-5') ?>>Central Time, Mexico City, Bogota</option>
                                        <option value="-4" <?= isUserTimezone('-4') ?>>Eastern Time, Venezuela, Atlantic Time (Barbados), Manaus, Santiago</option>
                                        <option value="-3" <?= isUserTimezone('-3') ?>>Atlantic Time (Canada), Brasilia, Buenos Aires, Montevideo</option>
                                        <option value="-2" <?= isUserTimezone('-2') ?>>Newfoundland, Greenland, Mid-Atlantic</option>
                                        <option value="-1" <?= isUserTimezone('-1') ?>>Cape Verde Islands</option>
                                        <option value="+0" <?= isUserTimezone('0') ?>>Azores</option>
                                        <option value="1" <?= isUserTimezone('1') ?>>Casablanca, London, Dublin, Western Africa Time</option>
                                        <option value="2" <?= isUserTimezone('2') ?>>Amsterdam, Berlin, Belgarde, Brussels, Paris, Sarajevo, Windhoek, Cairo, Harare</option>
                                        <option value="3" <?= isUserTimezone('3') ?>>Amman, Jordan, Athens, Instanbul, Beirut, Lebanon, Helsinki, Jerusalem, Minsk, Baghdad, Moscow, Kuwait, Nairobi</option>
                                        <option value="4" <?= isUserTimezone('4') ?>>Baku, Tbilisi, Yerevan, Dubai, Tehran, Kabul</option>
                                        <option value="5" <?= isUserTimezone('5') ?>>Islamabad, Karachi, Ural'sk, Yekaterinburg, Kolkata, Sri Lanka, Kathmandu</option>
                                        <option value="6" <?= isUserTimezone('6') ?>>Astana, Yangon</option>
                                        <option value="7" <?= isUserTimezone('7') ?>>Krasnoyarsk, Bangkok, Jakarta</option>
                                        <option value="8" <?= isUserTimezone('8') ?>>Beijing, Hong Kong, Irkutsk, Kuala Lumpur, Perth, Taipei</option>
                                        <option value="9" <?= isUserTimezone('9') ?>>Seoul, Tokyo, Osaka, Yakutsk, Adelaide, Darwin</option>
                                        <option value="10" <?= isUserTimezone('10') ?>>Brisbane, Hobart, Sydney, Canberra, Vladiovostok, Guam</option>
                                        <option value="11" <?= isUserTimezone('11') ?>>Magadan</option>
                                        <option value="12" <?= isUserTimezone('12') ?>>Marshall Islands, Auckland, Fiji</option>
                                        <option value="13" <?= isUserTimezone('13') ?>>Tonga</option>
                                    </select>
                                    <?= jsSetTimezone() ?>
                                </div>
                            <div class="settings_appearance hide settingel" id="settings_appearance" style="overflow:auto;width:100%;height:100%;">
                                <h1><?= $lang_newsetup_appearance ?></h1>
                                <?php
            
            if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/dark") == "True") {
                echo("<input type=\"checkbox\" id=\"appearance_dark\" name=\"appearance_dark\" onchange=\"saveSettings();reloadNeeded();\" checked>");
            } else {
                echo("<input type=\"checkbox\" id=\"appearance_dark\" name=\"appearance_dark\" onchange=\"saveSettings();reloadNeeded();\">");
            }
            
            ?>
                            <label for="appearance_dark"><?= $lang_appearance_dark ?></label> <a class="hide" href="/account/?lang=<?= $langprop ?>" id="reloadNeeded"><?= $lang_account_reload ?></a><br>
        </div>
                            <div class="settings_password hide settingel" id="settings_password" style="overflow:auto;width:100%;height:100%;">
                                <h1><?= $lang_newsetup_password ?></h1>
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
                            <div class="settings_datapictures hide settingel" id="settings_datapictures" style="overflow:auto;width:100%;height:100%;">
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
            <span class="success_email hide" id="success_email" style="padding: 5px;border-radius: 5px;background: #7aed69;border-color: #4ba860;border-style: solid;border-width: 1px;color: black;">
                <img src="/resources/icons/lightback/ic_check_grey600_24dp.png" style="vertical-align: middle;filter: brightness(0%);" width="24px" height="24px"> <?= $lang_polymer_email6 ?>
            </span>
            <span class="error_email hide" id="error_email" style="padding: 5px;border-radius: 5px;background: #ed6969;border-color: #a84b4b;border-style: solid;border-width: 1px;color: black;">
                <img src="/resources/icons/lightback/ic_warning_grey600_24dp.png" style="vertical-align: middle;filter: brightness(0%);" width="24px" height="24px">
            </span>
            <h2><?= $lang_account_admin ?></h2>
            <center><span class="adminel" onclick="showDelete()"><img src="/resources/icons/lightback/ic_delete_grey600_24dp.png" class="accountadminicons" height=24px width=24px> <?= $lang_accadmin_delete ?></span></center><br>
            <center><span class="adminel" onclick="location.href = '/tutorial/?lang=<?= $langprop ?>&source=settings'"><img src="/resources/icons/lightback/ic_directions_grey600_24dp.png" class="accountadminicons" height=24px width=24px> <?= $lang_polymer_admint ?></span></center>
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
                            <div class="settings_name hide settingel" id="settings_name" style="overflow:auto;width:100%;height:100%;">
                                <h1><?= $lang_newsetup_name ?></h1>
                                <input type="text" id="appearance_name" name="appearance_name" value="<?= strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/realname")) ?>"> <a class="jslink" onclick="saveSettings()"><?= $lang_appearance_namesb ?></a><br>
            <span class="tip"><?= $lang_appearance_namedisc ?></span>
        </div>
                            <div class="settings_friends hide settingel" id="settings_friends" style="overflow:auto;width:100%;height:100%;">
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
                            <div class="settings_privacy settingel hide" id="settings_privacy" style="overflow:auto;width:100%;height:100%;">
                                <h1><?= $lang_newsetup_privacy ?></h1>
                                <?php
            
            if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/privacy/discovery") == "True") {
                echo("<input type=\"checkbox\" id=\"privacy_discovery\" name=\"privacy_discovery\" onchange=\"saveSettings()\" checked>");
            } else {
                echo("<input type=\"checkbox\" id=\"privacy_discovery\" name=\"privacy_discovery\" onchange=\"saveSettings()\">");
            }
            
            ?>

            <label for="privacy_discovery"><?= $lang_privacy_discovery ?></label>
            
            <?php

            if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/privacy/private") == "True") {
                echo("<br><input type=\"checkbox\" id=\"privacy_private\" name=\"privacy_private\" onchange=\"saveSettings()\" checked>");
            } else {
                echo("<br><input type=\"checkbox\" id=\"privacy_private\" name=\"privacy_private\" onchange=\"saveSettings()\">");
            }

            ?>
            <label for="privacy_private"><?= $lang_privacy_private ?></label>
        </div>
                            <div class="settings_about hide settingel" id="settings_about" style="overflow:auto;width:100%;height:100%;vertical-align:middle;text-align:center;">
                                <center>
                                    <img src="/resources/image/logo.png" style="vertical-align:middle;margin-right:10px;" width="256px" class="redmob" height="256px">
                                    <h1>PinPages <?php
                                    
                                    include_once $_SERVER['DOCUMENT_ROOT'] . "/properties.php";
                                    echo($prop_version);

                                    ?></h1>
                                    <?= $lang_newsetup_bty1 ?><br>
                                    <?= $lang_newsetup_bty2 . $prop_builton . $lang_newsetup_bty3 . $prop_testedon . $lang_newsetup_bty4 ?><br><br>
                                    <?= $lang_newsetup_thanks ?><br><br>
                                    <a href="/privacy/?lang=<?= $langprop ?>"><?= $lang_footer_privacy ?></a> • <a href="/terms/?lang=<?= $langprop ?>"><?= $lang_footer_terms ?></a> • © Minteck Projects
                                </center>
        </div>
                        </td>
                    </tr>
                </tbody>
           </table>
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
                <a onclick="deleteAccount()" class="delete_confirm"><?= $lang_remove_yes ?></a><br><br><br>
                <a onclick="hideDelete()" class="delete_cancel"><?= $lang_remove_no ?></a><br>
            </div>
        </div> -->
        <h1><?= $lang_pm3_account ?></h1>
        <a href="/account/about" class="accountel_placeholder">
            <div class="accountel">
                <img class="ael_img" src="/resources/icons/lightback/ic_info_outline_grey600_24dp.png">
                <span class="ael_label"><?= $lang_pm3acc_abouti ?></span>
            </div>
        </a>
        <a href="/account/appearance" class="accountel_placeholder">
            <div class="accountel">
                <img class="ael_img" src="/resources/icons/lightback/ic_format_paint_grey600_24dp.png">
                <span class="ael_label"><?= $lang_pm3acc_appearancei ?></span>
            </div>
        </a>
        <a href="/account/datapictures" class="accountel_placeholder">
            <div class="accountel">
                <img class="ael_img" src="/resources/icons/lightback/ic_account_circle_grey600_24dp.png">
                <span class="ael_label"><?= $lang_pm3acc_datapicturesi ?></span>
            </div>
        </a>
        <a href="/account/friends" class="accountel_placeholder">
            <div class="accountel">
                <img class="ael_img" src="/resources/icons/lightback/ic_supervisor_account_grey600_24dp.png">
                <span class="ael_label"><?= $lang_pm3acc_friendsi ?></span>
            </div>
        </a>
        <a href="/account/name" class="accountel_placeholder">
            <div class="accountel">
                <img class="ael_img" src="/resources/icons/lightback/ic_edit_grey600_24dp.png">
                <span class="ael_label"><?= $lang_pm3acc_namei ?></span>
            </div>
        </a>
        <a href="/account/password" class="accountel_placeholder">
            <div class="accountel">
                <img class="ael_img" src="/resources/icons/lightback/ic_vpn_key_grey600_24dp.png">
                <span class="ael_label"><?= $lang_pm3acc_passwordi ?></span>
            </div>
        </a>
        <a href="/account/privacy" class="accountel_placeholder">
            <div class="accountel">
                <img class="ael_img" src="/resources/icons/lightback/ic_lock_outline_grey600_24dp.png">
                <span class="ael_label"><?= $lang_pm3acc_privacyi ?></span>
            </div>
        </a>
        <a href="/account/time-date" class="accountel_placeholder">
            <div class="accountel">
                <img class="ael_img" src="/resources/icons/lightback/ic_access_time_grey600_24dp.png">
                <span class="ael_label"><?= $lang_pm3acc_timedatei ?></span>
            </div>
        </a>
        <script>
            
            var lang_pictures_add = "<?= $lang_pictures_upload ?>"
            var lang_pictures_edit = "<?= $lang_pictures_update ?>"
            var lang_uts = "<?= $lang_newsetup_uts ?>"
            
        </script>
        <script src="index.js"></script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>
