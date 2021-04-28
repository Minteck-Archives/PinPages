<?php

/*

The following PHP code will affect ALL PAGES of the website
Be sure of what you do here, since this may completly break everything

*/

if (strpos($_SERVER['HTTP_USER_AGENT'], 'WOW64') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Edge/1') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Edge/1.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Edge/2.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Edge/3.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Edge/4.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Edge/5.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Edge/6.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Edge/7.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Edge/8.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Edge/9.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox/1') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox/2') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox/3') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox/4') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox/1.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox/2.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox/3.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox/4.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox/5.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox/6.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox/7.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox/8.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox/9.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Safari/1.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Safari/2.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Safari/3.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Safari/4.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Safari/5.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Safari/6.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Safari/7.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Safari/8.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Safari/9.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome/1') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome/2') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome/1.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome/2.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome/3.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome/4.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome/5.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome/6.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome/7.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome/8.') !== false
|| strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome/9.') !== false
    ) {
        $OBRedirectServer = "minteck-projects.alwaysdata.net";
        die("<script>location.href = \"http://{$OBRedirectServer}/deprecated\"</script><meta http-equiv=\"refresh\" content=\"0; url=http://{$OBRedirectServer}/deprecated\">");
    }

$wkmvs = false;

if (isset($_GET['webkit_mobile'])) {
    if ($_GET['webkit_mobile'] == "enable") {
        $wkmvs = true;
        setcookie("__wkm_hide_header", "yes", 0, "/");
    } else if ($_GET['webkit_mobile'] == "disable") {
        $wkmvs = false;
        setcookie("__wkm_hide_header", "no", 0, "/");
    } else {
        echo("ERROR");
        exit;
    }
}

if ($wkmvs || (isset($_COOKIE['__wkm_hide_header']) && $_COOKIE['__wkm_hide_header'] == "yes")) {
    echo("<style>.header{display: none !important;}.header_escape{padding-top: 5px !important;}.oom{display: initial !important;}</style>");
}

if (isset($_COOKIE['token']))
{
    $user = strtok($_COOKIE['token'], '_');
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token']))
    {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/status", date("YmdHi"));
    }
}

if (isset($lang)) {
    echo("<script>lang_search = \"" . $lang_search_placeholder . "\";lang_search2 = \"" . $lang_pm3search_ask . "\";</script><script src=\"/resources/libs/listeners.js\"></script>");
}