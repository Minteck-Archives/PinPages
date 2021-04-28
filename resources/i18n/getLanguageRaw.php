<?php

header("Content-Type: text/plain");

if (isset($_GET['lang'])) {
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/" . $_GET['lang'] . ".php")) {
        die(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/" . $_GET['lang'] . ".php"));
    } else {
        die("Not found");
    }
} else {
    die("No language given");
}