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

if (isset($_GET['name']))
{
    $suser = $_GET['name'];
}
else
{
    echo("<script>location.href = \"/app/?lang=" . $langprop . "\"</script>");
    exit;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/favicon.svg" />
        <link rel="stylesheet" href="/resources/style/global.css" />
        <title><?= $lang_invite_pagetitle ?></title>
        <meta charset="UTF-8">
        <script src="/resources/libs/jquery.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script>user = `<?= $suser ?>`</script>
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
            <h1><?= $lang_invite_title ?></h1>
            <?php

            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser))
            {

            }
            else
            {
                echo("<h2>" . $lang_invite_error . "</h2>" . $lang_invite_edesc);
                exit;
            }

            if ($suser != $user)
            {

            }
            else
            {
                echo("<h2>" . $lang_invite_error . "</h2>" . $lang_invite_edesc2);
                exit;
            }

            $friends = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/friends/valided"));
            $friends = array_map('trim', $friends);
            if (in_array($suser,$friends)) {
                echo("<h2>" . $lang_polymer_ierr . "</h2>" . $lang_polymer_iedesc);
                exit;
            }

            ?>
            <span class="save_error_1 hide" id="save_error_1" style="padding: 5px;border-radius: 5px;background: #ed6969;border-color: #a84b4b;border-style: solid;border-width: 1px;color: black;">
                <img src="/resources/icons/lightback/ic_warning_grey600_24dp.png" style="vertical-align: middle;filter: brightness(0%);" width="24px" height="24px"> <?= $lang_invite_error1 ?>
            </span>
            <span class="save_error_2 hide" id="save_error_2" style="padding: 5px;border-radius: 5px;background: #ed6969;border-color: #a84b4b;border-style: solid;border-width: 1px;color: black;">
                <img src="/resources/icons/lightback/ic_warning_grey600_24dp.png" style="vertical-align: middle;filter: brightness(0%);" width="24px" height="24px"> <?= $lang_invite_error2 ?>
            </span>
            <span class="save_error_3 hide" id="save_error_3" style="padding: 5px;border-radius: 5px;background: #ed6969;border-color: #a84b4b;border-style: solid;border-width: 1px;color: black;">
                <img src="/resources/icons/lightback/ic_warning_grey600_24dp.png" style="vertical-align: middle;filter: brightness(0%);" width="24px" height="24px"> <?= $lang_invite_error3 ?>
            </span>
            <span class="hide" id="save_success"><span style="padding: 5px;border-radius: 5px;background: #7aed69;border-color: #4ba860;border-style: solid;border-width: 1px;color: black;">
                <img src="/resources/icons/lightback/ic_check_grey600_24dp.png" style="vertical-align: middle;filter: brightness(0%);" width="24px" height="24px"> <?= $lang_invite_success ?></span><br><center><i><?= $lang_invite_sucdesc ?></i></center>
            </span>
            <div id="request">
                <h2><?= $lang_invite_summary ?></h2>
                <?= $lang_invite_summaryp1 . $suser . $lang_invite_summaryp2 ?>
                <h2><?= $lang_invite_confirm ?></h2>
                <input type="checkbox" id="confirm" name="confirm" onchange="confirmFriend()">
                <label for="confirm"><?= $lang_invite_cftext ?></label><br><br>
                <a class="jslink hide" id="send" onclick="sendFriendRequest()"><?= $lang_invite_send ?></a>
            </div>
            <span id="status" class="hide"><?= $lang_invite_status ?></span>
        </div>
        <script src="index.js"></script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>