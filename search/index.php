<?php 

include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/languageHandler.php";

function normalize ($string) {
    $table = array(
        'Š'=>'S', 'š'=>'s', 'Ð'=>'D', 'Ž'=>'Z', 'ž'=>'z', 'C'=>'C', 'c'=>'c', 'C'=>'C', 'c'=>'c',
        'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
        'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
        'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
        'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
        'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
        'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
        'ÿ'=>'y', 'R'=>'R', 'r'=>'r',
    );
   
    return strtr($string, $table);
}

if (isset($_COOKIE['token']))
{
    $user = strtok($_COOKIE['token'], '_');
    $suser = strtok($_COOKIE['token'], '_');
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token']))
    {
        $loggedIn = true;
    }
    else
    {
        $user = null;
        header("Location: /login");
die();
    }
}
else
{
    $user = null;
    header("Location: /login");
die();
}

if (isset($_GET['q']))
{
    $query = $_GET['q'];
    echo("<script>query = `" . $query . "`</script>");
}
else
{
    echo("<script>location.href = '/app'</script>");
    exit;
}

$query = str_replace("<", "&lt;", $query);
$query = str_replace(">", "&gt;", $query);
$root = $_SERVER['DOCUMENT_ROOT'];

function isValided($user,$lang_search_verified) {
    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/verification/status") == "True")
    {
        return "<a class=\"validation\" title=\"" . $lang_search_verified . "\"></a>";
        // return "<span>  </span>";
    }
    else
    {
        return "";
    }
}

?>

<script src="/resources/libs/jquery.js"></script>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/favicon.svg" />
        <link rel="stylesheet" href="/resources/style/global.css" />
        <title><?= $lang_search_title ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <?php

        if ($loggedIn) {
            if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/dark") == "True")
        {
            echo("<link rel=\"stylesheet\" href=\"/resources/style/dark.css\" />"); 
        }
        }

        ?>
    </head>
    <body class="abody">
        <script src="/resources/libs/jquery.js"></script>
        <?php
        
        if ($loggedIn) {
            include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/header.php";
        } else {
            include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/headerLoggedOut.php";
        }
        
        ?>
        <script src="index.js"></script>
        <div class="header_escape">
            <?php
            if ($query == "" || $query == "." || $query == "..")
            {
                echo("<h1>" . $lang_search_discover . "</h1>");
            }
            else
            {
                echo("<h1>" . $lang_search_resultsp1 . $query . $lang_search_resultsp2 . "</h1>");
            }
            ?>
            <p>
                <?= $lang_searchhome_descr ?><br>
                <input class="header_search" id="searchbox" type="text" placeholder="<?= $lang_searchhome_enter ?>"> &nbsp; 
                <button onclick="location.href='/search/?q='+document.getElementById('searchbox').value;"><?= $lang_searchhome_confirm ?></button>
            </p>
            <?php
            
            $root = $_SERVER['DOCUMENT_ROOT'];
            $first = true;
            $psom = false;

            $files = scandir($_SERVER['DOCUMENT_ROOT'] . "/data/");
            foreach ($files as $file) {
                $user = $file;
                if ($file == "." || $file == ".." || $file == ".htaccess" || !is_dir($_SERVER['DOCUMENT_ROOT'] . "/data/" . $file))
                {
                }
                else
                {
                    $query = str_replace("/", "", $query);
                    $query = str_replace("\\", "", $query);
                    $query = str_replace("#", "", $query);
                    if(preg_match("/{$query}/i", $file)) {
                if ($loggedIn) {
                    $fp = @fopen($root . "/data/" . $suser . "/friends/valided", 'r'); 
                if ($fp) {
                    $friends = explode("\n", file_get_contents($root . "/data/" . $suser . "/friends/valided"));
                    $friends = array_map('trim', $friends);
                }
                } else {
                    $friends = array();
                }

                if (file_get_contents($root . "/data/" . $file . "/privacy/discovery") == "True")
                {
                    if (file_get_contents($root . "/data/" . $file . "/privacy/private") == "True")
                    {
                        if (file_exists($root . "/resources/image/profile/" . $file . ".jpg"))
                        {
                            if ($first == true)
                            {
                                if (in_array($file, $friends))
                                {
                                    echo("<div class=\"search_result\">
                                    <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage userpp\" style=\"background-image:url('/resources/image/profile/" . $file . ".jpg');\"></a><span class=\"srname\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $file . "/realname")) . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"private\" title=\"" . $lang_search_private . "\"></a></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span><span onclick=\"removeFriend(`" . $file . "`)\" class=\"srremove\">" . $lang_search_remove . "</span>
                                    </div>");
                                    $first = false;
                                }
                                else
                                {
                                    if ($loggedIn) {
                                        echo("<div class=\"search_result\">
                                        <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage userpp\" style=\"background-image:url('/resources/image/profile/" . $file . ".jpg');\"></a><span class=\"srname\">" . $file . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"private\" title=\"" . $lang_search_private . "\"></a></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span><span class=\"sradd\" onclick=\"requestFriend(`" . $file . "`)\">" . $lang_search_request . "</span>
                                        </div>");
                                        $first = false;
                                        $psom = true;
                                    } else {
                                        echo("<div class=\"search_result\">
                                        <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage userpp\" style=\"background-image:url('/resources/image/profile/" . $file . ".jpg');\"></a><span class=\"srname\">" . $file . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"private\" title=\"" . $lang_search_private . "\"></a></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span>
                                        </div>");
                                        $first = false;
                                        $psom = true;
                                    }
                                }
                            }
                            else
                            {
                                if (in_array($file, $friends))
                                {
                                    echo("<hr style=\"border-width: 1px;border-bottom-width: 0px;border-color: lightgray;margin-left: 20px;margin-right: 20px;\">
                                    <div class=\"search_result\">
                                    <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage userpp\" style=\"background-image:url('/resources/image/profile/" . $file . ".jpg');\"></a></a><span class=\"srname\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $file . "/realname")) . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"private\" title=\"" . $lang_search_private . "\" title=\"" . $lang_search_private . "\"></a></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span><span onclick=\"removeFriend(`" . $file . "`)\" class=\"srremove\">" . $lang_search_remove . "</span>
                                    </div>");
                                    $first = false;
                                    $psom = true;
                                }
                                else
                                {
                                    if ($loggedIn) {
                                        echo("<hr style=\"border-width: 1px;border-bottom-width: 0px;border-color: lightgray;margin-left: 20px;margin-right: 20px;\">
                                        <div class=\"search_result\">
                                        <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage userpp\" style=\"background-image:url('/resources/image/profile/" . $file . ".jpg');\"></a><span class=\"srname\">" . $file . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"private\" title=\"" . $lang_search_private . "\"></a></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span><span class=\"sradd\" onclick=\"requestFriend(`" . $file . "`)\">" . $lang_search_request . "</span>
                                        </div>");
                                        $first = false;
                                        $psom = true;
                                    } else {
                                        echo("<hr style=\"border-width: 1px;border-bottom-width: 0px;border-color: lightgray;margin-left: 20px;margin-right: 20px;\">
                                        <div class=\"search_result\">
                                        <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage userpp\" style=\"background-image:url('/resources/image/profile/" . $file . ".jpg');\"></a></a><span class=\"srname\">" . $file . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"private\" title=\"" . $lang_search_private . "\"></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span>
                                        </div>");
                                        $first = false;
                                        $psom = true;
                                    }
                                }
                            }
                        }
                        else
                        {
                            if ($first == true)
                            {
                                if (in_array($file, $friends))
                                {
                                    echo("<div class=\"search_result\">
                                    <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage\" style=\"background-image:url('/resources/icons/darkback/ic_account_circle_white_24dp.png');\"></a><span class=\"srname\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $file . "/realname")) . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"private\" title=\"" . $lang_search_private . "\"></a></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span><span onclick=\"removeFriend(`" . $file . "`)\" class=\"srremove\">" . $lang_search_remove . "</span>
                                    </div>");
                                    $first = false;
                                    $psom = true;
                                }
                                else
                                {
                                    if ($loggedIn) {
                                        echo("<div class=\"search_result\">
                                        <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage\" style=\"background-image:url('/resources/icons/darkback/ic_account_circle_white_24dp.png');\"></a></a><span class=\"srname\">" . $file . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"private\" title=\"" . $lang_search_private . "\"></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span><span class=\"sradd\" onclick=\"requestFriend(`" . $file . "`)\">" . $lang_search_request . "</span>
                                        </div>");
                                        $first = false;
                                        $psom = true;
                                    } else {
                                        echo("<div class=\"search_result\">
                                        <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage\" style=\"background-image:url('/resources/icons/darkback/ic_account_circle_white_24dp.png');\"></a></a><span class=\"srname\">" . $file . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"private\" title=\"" . $lang_search_private . "\"></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span>
                                        </div>");
                                        $first = false;
                                        $psom = true;
                                    }
                                }
                            }
                            else
                            {
                                if (in_array($file, $friends))
                                {
                                    echo("<hr style=\"border-width: 1px;border-bottom-width: 0px;border-color: lightgray;margin-left: 20px;margin-right: 20px;\">
                                    <div class=\"search_result\">
                                    <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage\" style=\"background-image:url('/resources/icons/darkback/ic_account_circle_white_24dp.png');\"></a><span class=\"srname\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $file . "/realname")) . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"private\" title=\"" . $lang_search_private . "\"></a></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span><span onclick=\"removeFriend(`" . $file . "`)\" class=\"srremove\">" . $lang_search_remove . "</span>
                                    </div>");
                                    $first = false;
                                    $psom = true;
                                }
                                else
                                {
                                    if ($loggedIn) {
                                        echo("<hr style=\"border-width: 1px;border-bottom-width: 0px;border-color: lightgray;margin-left: 20px;margin-right: 20px;\">
                                        <div class=\"search_result\">
                                        <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage\" style=\"background-image:url('/resources/icons/darkback/ic_account_circle_white_24dp.png');\"></a><span class=\"srname\">" . $file . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"private\" title=\"" . $lang_search_private . "\"></a></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span><span class=\"sradd\" onclick=\"requestFriend(`" . $file . "`)\">" . $lang_search_request . "</span>
                                        </div>");
                                        $first = false;
                                        $psom = true;
                                    } else {
                                        echo("<hr style=\"border-width: 1px;border-bottom-width: 0px;border-color: lightgray;margin-left: 20px;margin-right: 20px;\">
                                        <div class=\"search_result\">
                                        <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage\" style=\"background-image:url('/resources/icons/darkback/ic_account_circle_white_24dp.png');\"></a><span class=\"srname\">" . $file . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"private\" title=\"" . $lang_search_private . "\"></a></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span>
                                        </div>");
                                        $first = false;
                                        $psom = true;
                                    }
                                }
                            }
                        }
                    }
                    else
                    {
                        if (file_exists($root . "/resources/image/profile/" . $file . ".jpg"))
                        {
                            if ($first == true)
                            {
                                if (in_array($file, $friends))
                                {
                                    echo("<div class=\"search_result\">
                                    <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage userpp\" style=\"background-image:url('/resources/image/profile/" . $file . ".jpg');\"></a></a><span class=\"srname\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $file . "/realname")) . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"public\" title=\"" . $lang_search_public . "\"></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span><span onclick=\"removeFriend(`" . $file . "`)\" class=\"srremove\">" . $lang_search_remove . "</span>
                                    </div>");
                                    $first = false;
                                    $psom = true;
                                }
                                else
                                {
                                    if ($loggedIn) {
                                        echo("<div class=\"search_result\">
                                        <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage userpp\" style=\"background-image:url('/resources/image/profile/" . $file . ".jpg');\"></a><span class=\"srname\">" . $file . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"public\" title=\"" . $lang_search_public . "\"></a></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span><span class=\"sradd\" onclick=\"requestFriend(`" . $file . "`)\">" . $lang_search_request . "</span>
                                        </div>");
                                        $first = false;
                                        $psom = true;
                                    } else {
                                        echo("<div class=\"search_result\">
                                        <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage userpp\" style=\"background-image:url('/resources/image/profile/" . $file . ".jpg');\"></a><span class=\"srname\">" . $file . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"public\" title=\"" . $lang_search_public . "\"></a></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span>
                                        </div>");
                                        $first = false;
                                        $psom = true;
                                    }
                                }
                            }
                            else
                            {
                                if (in_array($file, $friends))
                                {
                                    if ($loggedIn) {
                                        echo("<hr style=\"border-width: 1px;border-bottom-width: 0px;border-color: lightgray;margin-left: 20px;margin-right: 20px;\">
                                        <div class=\"search_result\">
                                        <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage userpp\" style=\"background-image:url('/resources/image/profile/" . $file . ".jpg');\"></a></a><span class=\"srname\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $file . "/realname")) . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"public\" title=\"" . $lang_search_public . "\"></a></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span><span onclick=\"removeFriend(`" . $file . "`)\" class=\"srremove\">" . $lang_search_remove . "</span>
                                        </div>");
                                        $first = false;
                                        $psom = true;
                                    } else {
                                        echo("<hr style=\"border-width: 1px;border-bottom-width: 0px;border-color: lightgray;margin-left: 20px;margin-right: 20px;\">
                                        <div class=\"search_result\">
                                        <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage userpp\" style=\"background-image:url('/resources/image/profile/" . $file . ".jpg');\"></a></a><span class=\"srname\">" . $file . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"public\" title=\"" . $lang_search_public . "\"></a></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span>
                                        </div>");
                                        $first = false;
                                        $psom = true;
                                    }
                                }
                                else
                                {
                                    if ($loggedIn) {
                                        echo("<hr style=\"border-width: 1px;border-bottom-width: 0px;border-color: lightgray;margin-left: 20px;margin-right: 20px;\">
                                        <div class=\"search_result\">
                                        <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage userpp\" style=\"background-image:url('/resources/image/profile/" . $file . ".jpg');\"></a><span class=\"srname\">" . $file . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"public\" title=\"" . $lang_search_public . "\"></a></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span><span class=\"sradd\" onclick=\"requestFriend(`" . $file . "`)\">" . $lang_search_request . "</span>
                                        </div>");
                                        $first = false;
                                        $psom = true;
                                    } else {
                                        echo("<hr style=\"border-width: 1px;border-bottom-width: 0px;border-color: lightgray;margin-left: 20px;margin-right: 20px;\">
                                        <div class=\"search_result\">
                                        <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage userpp\" style=\"background-image:url('/resources/image/profile/" . $file . ".jpg');\"></a><span class=\"srname\">" . $file . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"public\" title=\"" . $lang_search_public . "\"></a></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span>
                                        </div>");
                                        $first = false;
                                        $psom = true;
                                    }
                                }
                            }
                        }
                        else
                        {
                            if ($first == true)
                            {
                                if (in_array($file, $friends))
                                {
                                    echo("<div class=\"search_result\">
                                    <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage\" style=\"background-image:url('/resources/icons/darkback/ic_account_circle_white_24dp.png');\"></a><span class=\"srname\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $file . "/realname")) . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"public\" title=\"" . $lang_search_public . "\"></a></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span><span onclick=\"removeFriend(`" . $file . "`)\" class=\"srremove\">" . $lang_search_remove . "</span>
                                    </div>");
                                    $first = false;
                                    $psom = true;
                                }
                                else
                                {
                                    if ($loggedIn) {
                                        echo("<div class=\"search_result\">
                                        <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage\" style=\"background-image:url('/resources/icons/darkback/ic_account_circle_white_24dp.png');\"></a><span class=\"srname\">" . $file . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"public\" title=\"" . $lang_search_public . "\"></a></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span><span class=\"sradd\" onclick=\"requestFriend(`" . $file . "`)\">" . $lang_search_request . "</span>
                                        </div>");
                                        $first = false;
                                        $psom = true;
                                    } else {
                                        echo("<div class=\"search_result\">
                                        <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage\" style=\"background-image:url('/resources/icons/darkback/ic_account_circle_white_24dp.png');\"></a><span class=\"srname\">" . $file . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"public\" title=\"" . $lang_search_public . "\"></a></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span>
                                        </div>");
                                        $first = false;
                                        $psom = true;
                                    }
                                }
                            }
                            else
                            {
                                if (in_array($file, $friends))
                                {
                                    echo("<hr style=\"border-width: 1px;border-bottom-width: 0px;border-color: lightgray;margin-left: 20px;margin-right: 20px;\">
                                    <div class=\"search_result\">
                                    <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage\" style=\"background-image:url('/resources/icons/darkback/ic_account_circle_white_24dp.png');\"></a><span class=\"srname\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $file . "/realname")) . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"public\" title=\"" . $lang_search_public . "\"></a></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span><span onclick=\"removeFriend(`" . $file . "`)\" class=\"srremove\">" . $lang_search_remove . "</span>
                                    </div>");
                                    $first = false;
                                    $psom = true;
                                }
                                else
                                {
                                    if ($loggedIn) {
                                        echo("<hr style=\"border-width: 1px;border-bottom-width: 0px;border-color: lightgray;margin-left: 20px;margin-right: 20px;\">
                                        <div class=\"search_result\">
                                        <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage\" style=\"background-image:url('/resources/icons/darkback/ic_account_circle_white_24dp.png');\"></a><span class=\"srname\">" . $file . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"public\" title=\"" . $lang_search_public . "\"></a></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span><span class=\"sradd\" onclick=\"requestFriend(`" . $file . "`)\">" . $lang_search_request . "</span>
                                        </div>");
                                        $first = false;
                                        $psom = true;
                                    } else {
                                        echo("<hr style=\"border-width: 1px;border-bottom-width: 0px;border-color: lightgray;margin-left: 20px;margin-right: 20px;\">
                                        <div class=\"search_result\">
                                        <a onclick=\"viewPage(`" . $file . "`)\"><a class=\"srimage\" style=\"background-image:url('/resources/icons/darkback/ic_account_circle_white_24dp.png');\"></a><span class=\"srname\">" . $file . "<small> (@");$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", normalize($file));$slug = str_replace(" ", "-", $slug);$slug = strtolower($slug);echo($slug);echo(")</small></span>" . isValided($user,$lang_search_verified) . "<a class=\"public\" title=\"" . $lang_search_public . "\"></a></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span>
                                        </div>");
                                        $first = false;
                                        $psom = true;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            }
        }

            ?>
        </div>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>
