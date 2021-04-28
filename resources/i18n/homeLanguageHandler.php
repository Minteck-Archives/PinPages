<?php

if (isset($_COOKIE['lang']))
{
    $langprop = $_COOKIE['lang'];
}
else
{
    // echo("<script>location.href = \"/lang\"</script>");
    header("Location: /lang");
    exit;
}

if (isset($_COOKIE['token'])) {
    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . strtok($_COOKIE['token'], '_') . "/tokens/" . $_COOKIE['token']))
    {
        header("Set-Cookie: token=");
    }
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/" . $langprop . ".php"))
{
    include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/" . $langprop . ".php";
    echo("<script>console.log(\"[PinPages] > Fichier de langue '" . $langprop . "' chargé\");var langprop = '" . $langprop . "'</script>");
}
else
{
    include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/en.php";
    echo("<script>console.log(\"[PinPages] > Fichier de langue 'en' chargé\");var langprop = '" . $langprop . "'</script>");
}

function startsWith ($string, $startString) { 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
}

function endsWith($haystack, $needle) {
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}

set_error_handler(function ($severity, $message, $file, $line) {
    if (startsWith($message, "Undefined variable: lang_")) {
        $echostr = strtoupper(str_replace("Undefined variable: lang_", "", $message));
        echo($echostr);
    } else {
        echo("<br><b>Notice: </b>" . $message . " in <b>" . $file . "</b> at line<b> " . $line . "</b><br>");
    }
}, E_NOTICE);