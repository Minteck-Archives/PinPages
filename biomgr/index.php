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

if (isset($_GET['user']))
{
    $suser = $_GET['user'];
    if (trim($suser) == "")
    {
        echo("<script>location.href = \"/page\"</script>");
        exit;
    }
    if ($suser == $user) {
        echo("<script>location.href = \"/page\"</script>");
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
        <title><?= $lang_pm3mod_biotitle1 . $suser . $lang_pm3mod_biotitle2 ?></title>
        <meta charset="UTF-8">
        <script>id = "<?= $count ?>"</script>
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
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/header.php"; ?>
        <div class="header_escape">
            <?php

            if (!file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == "2")
            {
                echo("<script>location.href = \"/page\"</script>");
                exit;
            }

            if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/protected") == "1")
            {
                echo("<h1>" . $lang_mod_nopermt . "</h1>" . $lang_mod_nopermd);
                exit;
            }

            ?>
            <div id="ep_editdiv">
                <h1 class="ep_title"><?= $lang_pm3mod_biohead . $suser ?></h1>
                <span id="ep_chars"><?= strlen($steps[1]) ?></span>/5000<br>
                <textarea onchange="countChars()" onkeyup="countChars()" id="ep_text" class="ep_text"><?php
                
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/bio")) {
                    echo(str_replace("&pinpages-hashtag;", "#", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/bio")));
                }

                ?></textarea><br><br>
                <a onclick="savePost()" id="ep_save" class="jslink"><?= $lang_polymer2_bio8 ?></a>
                <h2><?= $lang_pm3bio_mdguide ?></h2>
                <p><?= $lang_pm3bio_mdguide_i ?></p>
                <p><?= $lang_pm3bio_mdguide_i2 ?></p>
                <table>
                    <tbody>
                        <tr><td><code>&lt;br&gt;</code></td><td><?= $lang_pm3bio_mdguide_lf ?></td></tr>
                        <tr><td><code># abc</code></td><td><?= $lang_pm3bio_mdguide_h1 ?></td></tr>
                        <tr><td><code>## abc</code></td><td><?= $lang_pm3bio_mdguide_h2 ?></td></tr>
                        <tr><td><code>### abc</code></td><td><?= $lang_pm3bio_mdguide_h3 ?></td></tr>
                        <tr><td><code>#### abc</code></td><td><?= $lang_pm3bio_mdguide_h4 ?></td></tr>
                        <tr><td><code>##### abc</code></td><td><?= $lang_pm3bio_mdguide_h5 ?></td></tr>
                        <tr><td><code>###### abc</code></td><td><?= $lang_pm3bio_mdguide_h6 ?></td></tr>
                        <tr><td><code>*abc*</code></td><td><?= $lang_pm3bio_mdguide_ita ?></td></tr>
                        <tr><td><code>**abc**</code></td><td><?= $lang_pm3bio_mdguide_b ?></td></tr>
                        <tr><td><code>__abc__</code></td><td><?= $lang_pm3bio_mdguide_und ?></td></tr>
                        <tr><td><code>~~abc~~</code></td><td><?= $lang_pm3bio_mdguide_str ?></td></tr>
                        <tr><td><code>`abc`</code></td><td><?= $lang_pm3bio_mdguide_icode ?></td></tr>
                        <tr><td><code>```abc```</code></td><td><?= $lang_pm3bio_mdguide_code ?></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        <script src="index.js"></script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>