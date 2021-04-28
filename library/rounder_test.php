<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/library/rounder_functions.php";

if (isset($_GET['value'])) {
    $value = $_GET['value'];
    if (isset($_GET['sep'])) {
        $sep = $_GET['sep'];
    } else {
        $sep = 0;
    }
    echo("<h1>Transform equal to approximative</h1>");
    echo("<h2>Debugging Info</h2>\nIs value an integer: ");
    var_dump(is_int($value));
    echo("<br>Value content: ");
    var_dump($value);
    echo("<br>Corrected value: ");
    var_dump((int)$value);
    echo("<h2>Results</h2>");
    if (can_to_int($value) === false) {
        echo("<span style=\"color:red;\">Invalid Value</span>");
    } else {
        if (try_to_int($value) > 999999999 || try_to_int($value) < 0) {
            echo("<span style=\"color:red;\">Invalid Value</span>");
        } else {
            echo("Approximation: ");
            var_dump(rounder_approximate($value, $sep));
        }
    }
} else {
    echo("
    
    <h1>PinPages Number Approximation Tool</h1>
    
    <p>Use this tool to transform an equal number (1234567) to an approximative number (1000000).</p>
    <p>To start, specify the value using the <code>&value=</code> argument. Optionally, use the <code>&sep=</code> as a thousands separator.</p><i><small>version 0.1-{$prop_version}</small></i>
    
    ");
}