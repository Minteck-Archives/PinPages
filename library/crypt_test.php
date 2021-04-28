<?php

include_once "crypt_util.php";

if (isset($_GET['action']))
{
    $action = $_GET['action'];
    if ($action != "encrypt" && $action != "decrypt")
    {
        echo("<h1>Error</h1><h2>Incorrect Action</h2>Unexpected '" . $action . "' action.<br>Expecting: 'encrypt' or 'decrypt'");
        exit;
    }
}
else
{
    echo("<h1>Error</h1><h2>Incorrect Arguments</h2>No 'action' parameter set.");
    exit;
}

if (isset($_GET['string']))
{
    if ($action == "encrypt")
    {
        $return_string = encrypt($_GET['string']);
        echo("<h1>Success</h1><h2>Encrypt action done</h2><b>CryptUtil</b> returned <b><u>" . $return_string . "</u></b>");
        exit;
    }
    if ($action == "decrypt")
    {
        $return_string = decrypt($_GET['string']);
        echo("<h1>Success</h1><h2>Decrypt action done</h2><b>CryptUtil</b> returned <b><u>" . $return_string . "</u></b>");
        exit;
    }
}
else
{
    echo("<h1>Error</h1><h2>Incorrect Arguments</h2>No 'string' parameter set.");
    exit;
}
