<?php

if (isset($_POST['lang']))
{
    $langprop = $_POST['lang'];
}
else
{
    $langprop = 'en';
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/" . $langprop . ".php"))
{
    include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/" . $langprop . ".php";
}
else
{
    include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/en.php";
}

set_error_handler(function ($severity, $message, $file, $line) {
    if (startsWith($message, "Undefined variable: lang_")) {
        $echostr = strtoupper(str_replace("Undefined variable: lang_", "", $message));
        echo($echostr);
    } else {
        echo("<br><b>Notice: </b>" . $message . " in <b>" . $file . "</b> at line<b> " . $line . "</b><br>");
    }
}, E_NOTICE);