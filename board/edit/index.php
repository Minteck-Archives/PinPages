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

if (isset($_GET['user'])) {
    $suser = $_GET['user'];
    if ($suser == $user) {
        $editable = true;
    } else {
        $shares = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/board/settings/shares");
        $shares = explode("\n", $shares);
        foreach ($shares as $share) {
            $pieces = explode("|", $share);
            if ($pieces[0] == $user) {
                if ($pieces[1] == "1") {
                    $editable = true;
                } else {
                    $editable = false;
                }
            }
        }
    }
} else {
    die("<script>location.href = \"/board/dash\";</script>");
}
if (!isset($editable)) {
    die("<script>location.href = \"/board/dash\";</script>");
}
// $editable = false;

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/favicon.svg" />
        <link rel="stylesheet" href="/resources/style/global.css" />
        <title><?php if ($editable) {echo($lang_board_change);} else {echo($lang_board_immutable);} ?></title>
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
        <script>var user = "<?= $suser ?>";</script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/header_board.php"; ?>
        <div class="header_escape">
            <textarea id="boardbox" onchange="saveBoard();" oninput="saveBoard();" spellcheck="false" draggable="false" maxlength="100000" spellcheck="true" autofocus placeholder="<?php if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/board/settings/hidden")){echo($lang_board_editph);} ?>" class="board-box-<?= file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/board/settings/color") ?><?= file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/board/settings/font") ?>" <?php if (!$editable){echo("disabled");} ?>><?= file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/board/content") ?></textarea>
            <small id="boardstatus"><?= $lang_board_unsyncedyet ?></small>
            <script>lang_sync_ok = "<?= $lang_board_synced ?>";</script>
            <script>lang_sync_yet = "<?= $lang_board_unsyncedyet ?>";</script>
            <script>lang_sync_err = "<?= $lang_board_interror ?>";</script>
            <script>lang_sync_conn = "<?= $lang_board_connerror ?>";</script>
            <script>lang_sync_timeout = "<?= $lang_board_toerror ?>";</script>
            <script>lang_sync_saving = "<?= $lang_board_syncing ?>";</script>
            <script>lang_sync_getting = "<?= $lang_board_syncing2 ?>";</script>
            <script>lang_sync_users1 = "<?= $lang_board_syncusers1 ?>";</script>
            <script>lang_sync_users2 = "<?= $lang_board_syncusers2 ?>";</script>
            <script>lang_sync_users3 = "<?= $lang_board_syncusers3 ?>";</script>
            <script>editable = <?= $editable ? "true" : "false" ?>;</script>
        </div>
        <script src="index.js"></script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>