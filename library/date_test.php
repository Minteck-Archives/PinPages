<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/library/date_functions.php";

if (isset($_GET['ppd'])) {
    if (isset($_GET['offset'])) {
        $date = $_GET['ppd'];
        $offset = $_GET['offset'];
        echo("<h1>Adding/removing offset to date</h1>");
        echo("<h2>Debugging Info</h2>Is offset an integer: ");
        var_dump(is_int($offset));
        echo("<br>Offset value: ");
        var_dump($offset);
        echo("<br>Offset can be converted to integer: ");
        var_dump(can_to_int($offset));
        echo("<br>Date value: ");
        var_dump($date);
        echo("<br>Date is valid: ");
        var_dump(validate_ppd($date));
        echo("<br>Corrected offset: ");
        var_dump(try_to_int($offset));
        echo("<br>Corrected date: ");
        var_dump(correct_ppd($date));
        echo("<h2>Results</h2>");
        if (validate_ppd($date) === false) {
            echo("<span style=\"color:red;\">Invalid Date</span>");
        } else {
            if (can_to_int($offset) === false) {
                echo("<span style=\"color:red;\">Invalid Offset</span>");
            } else {
                if (try_to_int($offset) > 24 || try_to_int($offset) < -24) {
                    echo("<span style=\"color:red;\">Invalid Offset</span>");
                } else {
                    echo("New date: ");
                    var_dump(add_offset_ppd(correct_ppd($date), $offset));
                    echo("<br>New date is valid: ");
                    var_dump(validate_ppd(add_offset_ppd(correct_ppd($date), $offset)));
                }
            }
        }
    } else {
        echo("
        
        <h1>PinPages Date Transformation Tool</h1>
        
        <p>You specified the <code>&ppd=</code> argument but forgot the <code>&offset=</code> argument.</p>
        <p>Adding an offset of +2 will add 2 hours to the current time, and adding an offset of -3 will remove 3 hours from the current time</p><i><small>version 1.0-{$prop_version}</small></i>
        
        ");
    }
} else {
    if (isset($_GET['offset'])) {

    } else {
        echo("
        
        <h1>PinPages Date Transformation Tool</h1>
        
        <p>Use this tool to add/remove hours from a date and time at the PinPages's format (DD/MM/YYYY HH:MM).</p>
        <p>To start, specify the date using the <code>&ppd=</code> argument and the change offset using the <code>&offset=</code> argument.</p><i><small>version 1.0-{$prop_version}</small></i>
        
        ");
    }
}