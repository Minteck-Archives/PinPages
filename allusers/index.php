<?php

$visible = [];

$profiles = scandir($_SERVER['DOCUMENT_ROOT'] . "/data");
foreach ($profiles as $profile) {
    if ($profile != "." && $profile != ".." && $profile != ".htaccess") {
        if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $profile . "/privacy/discovery") == "True") {
            array_push($visible, $profile);
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php
    
    foreach ($visible as $profile) {
        echo("<a href=\"/page/?user={$profile}\">{$profile}</a><br>");
    }

    ?>
</body>
</html>