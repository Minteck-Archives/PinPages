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

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/favicon.svg" />
        <link rel="stylesheet" href="/resources/style/global.css" />
        <title><?= $lang_polymer2_bio7 ?></title>
        <meta charset="UTF-8">
        <script>id = "<?= $count ?>"</script>
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
                <h1 class="ep_title"><?= $lang_polymer2_bio6 ?></h1>
                <span id="ep_chars"><?php
                
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/bio")) {
                    echo(strlen(str_replace("&pinpages-hashtag;", "#", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/bio"))));
                } else {
                    echo("0");
                }

                ?></span>/5000<br>
                <textarea onchange="countChars()" onkeyup="countChars()" id="ep_text" class="ep_text"><?php
                
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/bio")) {
                    echo(str_replace("&pinpages-hashtag;", "#", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/bio")));
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
                        <tr><td><code>||http://example.com||abc&&</code></td><td><?= $lang_pm3bio_mdguide_link ?></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        <script src="index.js"></script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>