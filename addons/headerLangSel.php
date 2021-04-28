<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/private/everywhere.php"; ?>

<?php

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $http_s = "https";
} else {
    $http_s = "http";
}

$url = $http_s . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

if ($http_s == "http") {
    if (substr($_SERVER['HTTP_HOST'], 0, strlen($_SERVER['HTTP_HOST'])) === "localhost") {
        ob_end_clean();
        header("HTTP/1.1 301 Moved Permanantly");
        echo("<script>location.href = \"https://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}\";</script>");
        exit;
    }
}

?>

<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/properties.php";

?>

<div class="header">
    <span class="header_title">
    <script src="/addons/header.js"></script>
        <a href="/" style="text-decoration:none;">
            <img src="/resources/image/logo.png" height=24px width=24px style="vertical-align:middle;margin-right:10px;" />
            <span class="header_title_text"><b>PinPages Social</b> <?= $prop_version ?></span>
        </a>
    </span>
</div>
