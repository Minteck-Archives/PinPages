<?php

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

if (isset($_COOKIE['token'])) {
    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . strtok($_COOKIE['token'], '_') . "/tokens/" . $_COOKIE['token']))
    {
        header("Set-Cookie: token=");
    }
}

if (isset($_COOKIE['lang']))
{
    $langprop = $_COOKIE['lang'];
    $lang = $_COOKIE['lang'];
}
else
{
    // echo("<script>location.href = \"/lang/?returnto=" . strtok($_SERVER['REQUEST_URI'], '?') . "&args=" . urlencode(str_replace("?","&",str_replace(strtok($_SERVER['REQUEST_URI'], '?'),"",$_SERVER['REQUEST_URI']))) . "\"</script>");
    header("Location: /lang/?returnto=" . strtok($_SERVER['REQUEST_URI'], '?') . "&args=" . urlencode(str_replace("?","&",str_replace(strtok($_SERVER['REQUEST_URI'], '?'),"",$_SERVER['REQUEST_URI']))));
    exit;
}

if (endsWith($langprop, "-vu")) {
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/" . str_replace("-vu","",$langprop) . ".php"))
    {
        include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/" . str_replace("-vu","",$langprop) . ".php";
        echo("<script>console.log(\"[PinPages] > Fichier de langue '" . str_replace("-vu","",$langprop) . "' chargé\");var langprop = '" . str_replace("-vu","",$langprop) . "'</script>");
    }
    else
    {
        include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/en-vu.php";
        echo("<script>console.log(\"[PinPages] > Fichier de langue 'en-vu' chargé\");var langprop = 'en-vu'</script>");
    }
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/" . $langprop . ".php"))
    {
        include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/" . $langprop . ".php";
        echo("<script>console.log(\"[PinPages] > Fichier de langue '" . $langprop . "' chargé\");var langprop = '" . $langprop . "'</script>");
    }
    else
    {
        include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/en.php";
        echo("<script>console.log(\"[PinPages] > Fichier de langue 'en' chargé\");var langprop = 'en'</script>");
    }
} else {
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/" . $langprop . ".php"))
    {
        include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/" . $langprop . ".php";
        echo("<script>console.log(\"[PinPages] > Fichier de langue '" . $langprop . "' chargé\");var langprop = '" . $langprop . "'</script>");
    }
    else
    {
        include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/en.php";
        echo("<script>console.log(\"[PinPages] > Fichier de langue 'en' chargé\");var langprop = 'en'</script>");
    }
}

set_error_handler(function ($severity, $message, $file, $line) {
    if (startsWith($message, "Undefined variable: lang_")) {
        $echostr = strtoupper(str_replace("Undefined variable: lang_", "", $message));
        echo($echostr);
    } else {
        if ($severity == E_NOTICE) {
            echo("<br><b>PHP Notice: </b>" . $message . ", " . $file . " line " . $line . "<br>");
        }
        if ($severity == E_WARNING) {
            echo("<br><b>PHP Warning: </b>" . $message . ", " . $file . " line " . $line . "<br>");
        }
        if ($severity == E_ERROR) {
            echo("<br><b>PHP Error: </b>" . $message . ", " . $file . " line " . $line . "<br>");
            die();
        }
    }
}, E_ALL);