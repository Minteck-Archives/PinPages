<?php 

include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/qqq.php";

if (isset($_GET['returnto']))
{
    $return = $_GET['returnto'];
}
else
{
    $return = "/";
}

if (isset($_GET['args']))
{
    $args = $_GET['args'];
}
else
{
    $args = "";
}

if (!isset($_GET['switch'])) {
    $_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/" . $lang . ".php")) {
        $_lang = "en";
    }
    setcookie("lang", $_lang, 0, "/");
    header("Location: " . $return . '?source=langsel' . $args);
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/favicon.svg" />
        <link rel="stylesheet" href="/resources/style/global.css" />
        <title>PinPages</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="/resources/libs/jquery.js"></script>
        <script src="index.js"></script>
    </head>
    <body class="dbody">
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/headerLangSel.php"; ?>
        <div class="header_escape discover">
            <center><span class="welcome" id="welcome">PinPages</span><br><br><br><br></center>
            <center>
                <a id="lang_qqq" title="Use it when you translate PinPages and want to know where a message is used" onclick="document.cookie = 'lang=qqq; Path=/';location.href = `<?= $return . '?source=langsel' . $args ?>`">Raw Translation Values (debugging)</a><br>
                <?php

                foreach (scandir($_SERVER['DOCUMENT_ROOT'] . "/resources/i18n") as $lfile) {
                    if (strlen($lfile) == 6) {
                        $langprop = explode(".", $lfile)[0];
                        require $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/" . $lfile;
                        echo("<a id=\"lang_" . $lang . "\" title=\"" . $lang__credits . "\" onclick=\"document.cookie = 'lang=" . $lang . "; Path=/';location.href = `" . $return . '?source=langsel' . $args . "`\">" . $lang__name . "</a><br>");
                    }
                }

                ?>
            </center>
        </div>
    </body>
</html>