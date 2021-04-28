<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/library/json_user_data.php";

header("Content-Type: application/json");
// header("Content-Description: File Transfer");
// header("Content-Disposition: attachment; filename=\"userdata.json\"");
echo(json_encode(getData(), JSON_PRETTY_PRINT));