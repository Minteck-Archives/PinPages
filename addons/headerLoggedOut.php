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

<script src="/resources/libs/jquery.js"></script>
<script>langprop = "<?= $langprop ?>"</script>
<div class="header">
    <span class="header_title">
        <a href="/app" style="text-decoration:none;">
            <img id="header_logo" src="/resources/image/logo.png" height=24px width=24px style="vertical-align:middle;margin-right:10px;" />
            <script src="/addons/header.js"></script>
            <span class="header_app">PinPages</span>
        </a>
    </span>
    <!-- <form action="javascript:alert('Valided');" class="header_form"> -->
        <input id="searchbar" class="header_search" type="text" placeholder="<?= $lang_search_placeholder ?>">
        <input onclick="handleSearch();" id="sbsubmit" class="header_submit" type="button" value="" title="<?= $lang_header_search ?>">
        <input onclick="location.href = '/login';" id="sblogin" class="header_login" type="button" value="" title="<?= $lang_header_login ?>">
    <!-- </form> -->
</div>

<?php

if (substr($_SERVER['DOCUMENT_ROOT'], -1) === "/" || substr($_SERVER['DOCUMENT_ROOT'], -1) === "\\") {
    rtrim($_SERVER['DOCUMENT_ROOT']);
}

?>
