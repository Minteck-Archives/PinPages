<?php

function getLocation ($lang_polymer2_unknownloc) {
    include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/postLanguageHandler.php";
    $ip = $_SERVER['REMOTE_ADDR'];
    set_error_handler(function ($severity, $message, $file, $line) {
        throw new ErrorException($message, $severity, $severity, $file, $line);
    });
    try {
        $details = json_decode(file_get_contents("http://ipinfo.io/${ip}/json"));
    } catch (Exception $e) {
        return $lang_polymer2_unknownloc;
        exit;
    }
    if (isset($details->city)) {
        return $details->city . ", " . $details->region . ", " . $details->country;
        exit;
    } else {
        return $lang_polymer2_unknownloc;
        exit;
    }
}
