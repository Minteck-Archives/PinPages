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

include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/homeLanguageHandler.php";

if (isset($_COOKIE['token']))
{
    $user = strtok($_COOKIE['token'], '_');
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token']))
    {
        header("Location: /app");
        exit;
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/favicon.svg" />
        <link rel="stylesheet" href="/resources/style/global.css" />
        <title><?= $lang_welcome_title ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="/resources/libs/jquery.js"></script>
        <script src="/index.js"></script>
        <script>validateToken()</script>
    </head>
    <body class="dbody nd_WelcomeBkg">
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/private/everywhere.php"; ?>
        <div class="nd_AuthPage">
        <div class="nd_AuthPage_modal" style="position: relative; background: initial;"><div class="nd_AuthPage_modalBlur" style="position: absolute; inset: 0px; filter: blur(10px); background: rgba(0, 0, 0, 0) url(&quot;/resources/image/background.jpg&quot;) repeat fixed center center / cover;"></div><div class="nd_AuthPage_modalContent" style="display: flex; z-index: 1; background: rgba(255, 255, 255, 0.59) none repeat scroll 0% 0%; border-radius: 4px;"><div class="nd_Welcome"><div class="nd_WelcomePage nd_WelcomePage_guest nd_WelcomePage_loggedIn"><div class="nd_WelcomePage_body">

<div class="nd_Parent">
    <a href="/" target="_blank" rel="noopener">
        <img src="/resources/image/logo.svg" alt="" class="nd_Logo">
    </a>
    <h1 class="nd_Header_title"><?= $lang_welcome_doctitle ?></h1>
    <h4 class="nd_Header_subtitle"><?= $lang_welcome_tagline ?></h4>
    <div class="nd_ButtonGroup">
        <div class="nd_ButtonRow">
            <a href="/login" class="nd_ButtonParent nd_ButtonSignIn nd_Button_iconSignIn">
                <div class="nd_ButtonLabel"><?= $lang_welcome_login ?></div>
            </a>
            <a href="/signup" class="nd_ButtonParent nd_ButtonCreateAccount nd_Button_iconCreateAccount">
                <div class="nd_ButtonLabel"><?= $lang_welcome_register ?></div>
            </a>
        </div>
    </div>
</div>
</div></div><div class="nd_Dropdown nd_AuthBody_language" onclick="location.href='/lang/?switch'"><div aria-haspopup="listbox" aria-expanded="false" aria-label="Language Dropdown" aria-describedby="nd_LanguageDropdown_value" role="button" tabindex="0" class="nd_AccessibleButton nd_Dropdown_input nd_no_textinput"><div class="nd_Dropdown_option" id="nd_LanguageDropdown_value"><div><?= $lang__name ?></div></div><span class="nd_Dropdown_arrow"></span></div></div></div></div></div>
<div class="nd_AuthFooter"><a href="https://minteck-projects.alwaysdata.net/status" target="_blank" rel="noreferrer noopener"><?= $lang_welcome_btn_stat ?></a><a href="https://gitlab.com/minteck-projects" target="_blank" rel="noreferrer noopener"><?= $lang_welcome_btn_bugs ?></a><a href="https://mpbugger.alwaysdata.net" target="_blank" rel="noreferrer noopener">github</a><a href="https://minteck-projects.alwaysdata.net" target="_blank" rel="noreferrer noopener"><?= $lang_welcome_btn_mprj ?></a></div></div>
    </body>
</html>
