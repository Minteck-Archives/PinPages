<?php

include_once "lib.php";

if (isset($_GET['text'])) {
    echo HTMLtoMD($_GET['text']);
} else {
    echo("No Markdown Given via the <code>/?text=</code> parameter.");
}