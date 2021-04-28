<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/properties.php";

function try_to_int($obj) {
    try {
        (int)$obj = (int)$obj;
        return (int)$obj;
    } catch (Warning $warn) {
        return $obj;
    }
}

function can_to_int($obj) {
    try {
        (int)$obj2 = (int)$obj;
        if ((string)$obj2 != $obj) {
            return false;
        } else {
            return true;
        }
    } catch (Warning $warn) {
        return false;
    }
}

function rounder_approximate(int $value, string $separator = "") {
    if ($value > 999999999999 || $value < 0) {
        return null;
    }
    if ($value == 0) {
        return 0;
    }
    if ($value < 10) {
        return 0;
    }
    $prefix = substr((string)$value, 0, 1);
    $qty = strlen(substr((string)$value, 1));
    (string)$finalstr = $prefix;
    $i = 0;
    while ($i++ < $qty) {
        (string)$finalstr = $finalstr . "0";
    }
    $final = (int)$finalstr;
    if ($separator != "") {
        $sepstr = number_format($final, 0, ".", $separator);
        return $sepstr;
    } else {
        return (string)$final;
    }
}