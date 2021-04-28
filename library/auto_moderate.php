<?php

function autoModerate($string) {
    $dictionary = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/library/auto_moderate.dic"));
    $string = trim(" " . $string . " ");
    foreach ($dictionary as $word) {
        $word = trim(strtolower($word));
        $wordlen = strlen($word);
        $replace = " " . str_repeat("+", $wordlen) . " ";
        $string = str_ireplace(" " . $word . " ", $replace, $string);
    }
    return $string;
}
