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
        <title><?= $lang_pm3acc_timedate ?></title>
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
        <script src="index.js"></script>
        <script>
            
            var lang_pictures_add = "<?= $lang_pictures_upload ?>"
            var lang_pictures_edit = "<?= $lang_pictures_update ?>"
            var lang_uts = "<?= $lang_newsetup_uts ?>"
            
        </script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>
