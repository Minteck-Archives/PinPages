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

if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == 2)
{

}
else
{
    echo("<script>location.href = \"/errorpage/?lang=" . $langprop . "\"</script>");
    exit;
}

if (isset($_GET['user']))
{
    $suser = $_GET['user'];
    if ($suser == "")
    {
        echo("<script>location.href = \"/page/?lang=" . $langprop . "\"</script>");
        exit;
    }
}
else
{
    echo("<script>location.href = \"/page/?lang=" . $langprop . "\"</script>");
    exit;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/favicon.svg" />
        <link rel="stylesheet" href="/resources/style/global.css" />
        <title><?= $lang_permmgr_titlep1 . $suser . $lang_verifmgr_titlep2 ?></title>
        <meta charset="UTF-8">
        <script>suser = "<?= $suser ?>"</script>
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
            <div id="ep_editdiv">
                <?php

                if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/protected") == "1")
                {
                    echo("<h1>" . $lang_mod_nopermt . "</h1>" . $lang_mod_nopermd);
                    exit;
                }
                
                $group = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/permissions");

                ?>
                <h1 class="ep_title"><?= $lang_permmgr_title ?></h1>
                <?= $lang_permmgr_desc ?><br><br><?= $lang_permmgr_list . " " . $suser . " : " ?> 
                <select id="group" onchange="saveGroup();">
                    <option value="header_1" disabled><?= $lang_permmgr_hdr1 ?></option>
                    <?php

                    if ($group == "0")
                    {
                        echo("<option value=\"0\" selected>" . $lang_permmgr_grp0 . "</option>");
                    }
                    else
                    {
                        echo("<option value=\"0\">" . $lang_permmgr_grp0 . "</option>");
                    }

                    ?>
                    <option value="header_2" disabled><?= $lang_permmgr_hdr2 ?></option>
                    <?php

                    if ($group == "1")
                    {
                        echo("<option value=\"1\" selected>" . $lang_permmgr_grp1 . "</option>");
                    }
                    else
                    {
                        echo("<option value=\"1\">" . $lang_permmgr_grp1 . "</option>");
                    }

                    if ($group == "2")
                    {
                        echo("<option value=\"2\" selected>" . $lang_permmgr_grp2 . "</option>");
                    }
                    else
                    {
                        echo("<option value=\"2\">" . $lang_permmgr_grp2 . "</option>");
                    }

                    ?>
                </select>
                <br><span class="tip"><?= $lang_permmgr_auto ?></span>
            </div>
        </div>
        <script src="index.js"></script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>