<span class="oom"><center><br><a href="/login/"><?= $lang_header_login ?></a><br></center></span>
<center>
    <h1><?= $lang_polymer_hometitle ?></h1>
    <h2><?= $lang_hlo_famous ?></h2></center>

<script>
function requestFriend(user) {
  location.href = "/invite/?name=" + user
}

function removeFriend(user) {
  location.href = "/remove/?name=" + user
}

function viewPage(user) {
  location.href = "/page/?user=" + user
}
</script>

<?php

function isValided($user,$lang_search_verified) {
    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/verification/status") == "True")
    {
        // return "<a class=\"validation\" title=\"" . $lang_search_verified . "\"></a>";
        return "<span>  </span>";
    }
    else
    {
        return "";
    }
}

$root = $_SERVER['DOCUMENT_ROOT'];
$query = ".";
$first = true;
$friends = array();

$files = scandir($_SERVER['DOCUMENT_ROOT'] . "/data/");
foreach ($files as $file) {
    $user = $file;
    if ($file == "." || $file == ".." || $file == ".htaccess")
    {
    }
    else
    {
        $query = str_replace("/", "", $query);
        $query = str_replace("\\", "", $query);
        $query = str_replace("#", "", $query);
        if(preg_match("/{$query}/i", $file)) {

    if ((int)trim(file_get_contents($root . "/data/" . $file . "/views")) > 20) {
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
                        <a class=\"srimage userpp\" style=\"background-image:url('/resources/image/profile/" . $file . ".jpg');\"></a><span class=\"srname\">" . $file . "</span>" . isValided($user,$lang_search_verified) . "<a class=\"private\" title=\"" . $lang_search_private . "\"></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span><span onclick=\"removeFriend(`" . $file . "`)\" class=\"srremove\">" . $lang_search_remove . "</span>
                        </div>");
                        $first = false;
                    }
                    else
                    {
                        echo("<div class=\"search_result\">
                        <a class=\"srimage userpp\" style=\"background-image:url('/resources/image/profile/" . $file . ".jpg');\"></a><span class=\"srname\">" . $file . "</span>" . isValided($user,$lang_search_verified) . "<a class=\"private\" title=\"" . $lang_search_private . "\"></a>
                        </div>");
                        $first = false;
                        $psom = true;
                    }
                }
                else
                {
                    if (in_array($file, $friends))
                    {
                        echo("<hr style=\"border-width: 1px;border-bottom-width: 0px;border-color: lightgray;margin-left: 20px;margin-right: 20px;\">
                        <div class=\"search_result\">
                        <a class=\"srimage userpp\" style=\"background-image:url('/resources/image/profile/" . $file . ".jpg');\"></a></a><span class=\"srname\">" . $file . "</span>" . isValided($user,$lang_search_verified) . "<a class=\"private\" title=\"" . $lang_search_private . "\" title=\"" . $lang_search_private . "\"></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span><span onclick=\"removeFriend(`" . $file . "`)\" class=\"srremove\">" . $lang_search_remove . "</span>
                        </div>");
                        $first = false;
                        $psom = true;
                    }
                    else
                    {
                        echo("<hr style=\"border-width: 1px;border-bottom-width: 0px;border-color: lightgray;margin-left: 20px;margin-right: 20px;\">
                        <div class=\"search_result\">
                        <a class=\"srimage userpp\" style=\"background-image:url('/resources/image/profile/" . $file . ".jpg');\"></a><span class=\"srname\">" . $file . "</span>" . isValided($user,$lang_search_verified) . "<a class=\"private\" title=\"" . $lang_search_private . "\"></a>
                        </div>");
                        $first = false;
                        $psom = true;
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
                        <a class=\"srimage\" style=\"background-image:url('/resources/icons/darkback/ic_account_circle_white_24dp.png');\"></a><span class=\"srname\">" . $file . "</span>" . isValided($user,$lang_search_verified) . "<a class=\"private\" title=\"" . $lang_search_private . "\"></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span><span onclick=\"removeFriend(`" . $file . "`)\" class=\"srremove\">" . $lang_search_remove . "</span>
                        </div>");
                        $first = false;
                        $psom = true;
                    }
                    else
                    {
                        echo("<div class=\"search_result\">
                        <a class=\"srimage\" style=\"background-image:url('/resources/icons/darkback/ic_account_circle_white_24dp.png');\"></a><span class=\"srname\">" . $file . "</span>" . isValided($user,$lang_search_verified) . "<a class=\"private\" title=\"" . $lang_search_private . "\"></a>
                        </div>");
                        $first = false;
                        $psom = true;
                    }
                }
                else
                {
                    if (in_array($file, $friends))
                    {
                        echo("<hr style=\"border-width: 1px;border-bottom-width: 0px;border-color: lightgray;margin-left: 20px;margin-right: 20px;\">
                        <div class=\"search_result\">
                        <a class=\"srimage\" style=\"background-image:url('/resources/icons/darkback/ic_account_circle_white_24dp.png');\"></a><span class=\"srname\">" . $file . "</span>" . isValided($user,$lang_search_verified) . "<a class=\"private\" title=\"" . $lang_search_private . "\"></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span><span onclick=\"removeFriend(`" . $file . "`)\" class=\"srremove\">" . $lang_search_remove . "</span>
                        </div>");
                        $first = false;
                        $psom = true;
                    }
                    else
                    {
                        echo("<hr style=\"border-width: 1px;border-bottom-width: 0px;border-color: lightgray;margin-left: 20px;margin-right: 20px;\">
                        <div class=\"search_result\">
                        <a class=\"srimage\" style=\"background-image:url('/resources/icons/darkback/ic_account_circle_white_24dp.png');\"></a><span class=\"srname\">" . $file . "</span>" . isValided($user,$lang_search_verified) . "<a class=\"private\" title=\"" . $lang_search_private . "\"></a>
                        </div>");
                        $first = false;
                        $psom = true;
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
                        <a class=\"srimage userpp\" style=\"background-image:url('/resources/image/profile/" . $file . ".jpg');\"></a><span class=\"srname\">" . $file . "</span>" . isValided($user,$lang_search_verified) . "<a class=\"public\" title=\"" . $lang_search_public . "\"></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span><span onclick=\"removeFriend(`" . $file . "`)\" class=\"srremove\">" . $lang_search_remove . "</span>
                        </div>");
                        $first = false;
                        $psom = true;
                    }
                    else
                    {
                        echo("<div class=\"search_result\">
                        <a class=\"srimage userpp\" style=\"background-image:url('/resources/image/profile/" . $file . ".jpg');\"></a><span class=\"srname\">" . $file . "</span>" . isValided($user,$lang_search_verified) . "<a class=\"public\" title=\"" . $lang_search_public . "\"></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span>
                        </div>");
                        $first = false;
                        $psom = true;
                    }
                }
                else
                {
                    if (in_array($file, $friends))
                    {
                        echo("<hr style=\"border-width: 1px;border-bottom-width: 0px;border-color: lightgray;margin-left: 20px;margin-right: 20px;\">
                        <div class=\"search_result\">
                        <a class=\"srimage userpp\" style=\"background-image:url('/resources/image/profile/" . $file . ".jpg');\"></a></a><span class=\"srname\">" . $file . "</span>" . isValided($user,$lang_search_verified) . "<a class=\"public\" title=\"" . $lang_search_public . "\"></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span>
                        </div>");
                        $first = false;
                        $psom = true;
                    }
                    else
                    {
                        echo("<hr style=\"border-width: 1px;border-bottom-width: 0px;border-color: lightgray;margin-left: 20px;margin-right: 20px;\">
                        <div class=\"search_result\">
                        <a class=\"srimage userpp\" style=\"background-image:url('/resources/image/profile/" . $file . ".jpg');\"></a><span class=\"srname\">" . $file . "</span>" . isValided($user,$lang_search_verified) . "<a class=\"public\" title=\"" . $lang_search_public . "\"></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span>
                        </div>");
                        $first = false;
                        $psom = true;
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
                        <a class=\"srimage\" style=\"background-image:url('/resources/icons/darkback/ic_account_circle_white_24dp.png');\"></a><span class=\"srname\">" . $file . "</span>" . isValided($user,$lang_search_verified) . "<a class=\"public\" title=\"" . $lang_search_public . "\"></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span>
                        </div>");
                        $first = false;
                        $psom = true;
                    }
                    else
                    {
                        echo("<div class=\"search_result\">
                        <a class=\"srimage\" style=\"background-image:url('/resources/icons/darkback/ic_account_circle_white_24dp.png');\"></a><span class=\"srname\">" . $file . "</span>" . isValided($user,$lang_search_verified) . "<a class=\"public\" title=\"" . $lang_search_public . "\"></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span>
                        </div>");
                        $first = false;
                        $psom = true;
                    }
                }
                else
                {
                    if (in_array($file, $friends))
                    {
                        echo("<hr style=\"border-width: 1px;border-bottom-width: 0px;border-color: lightgray;margin-left: 20px;margin-right: 20px;\">
                        <div class=\"search_result\">
                        <a class=\"srimage\" style=\"background-image:url('/resources/icons/darkback/ic_account_circle_white_24dp.png');\"></a><span class=\"srname\">" . $file . "</span>" . isValided($user,$lang_search_verified) . "<a class=\"public\" title=\"" . $lang_search_public . "\"></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span>
                        </div>");
                        $first = false;
                        $psom = true;
                    }
                    else
                    {
                        echo("<hr style=\"border-width: 1px;border-bottom-width: 0px;border-color: lightgray;margin-left: 20px;margin-right: 20px;\">
                        <div class=\"search_result\">
                        <a class=\"srimage\" style=\"background-image:url('/resources/icons/darkback/ic_account_circle_white_24dp.png');\"></a><span class=\"srname\">" . $file . "</span>" . isValided($user,$lang_search_verified) . "<a class=\"public\" title=\"" . $lang_search_public . "\"></a><span class=\"sradd\" onclick=\"viewPage(`" . $file . "`)\">" . $lang_search_view . "</span>
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

<center>
    <h2><?= $lang_hlo_mprj ?></h2>
</center>

<?php

$friend = "Minteck Projects";
if ($friend == "." || $friend == "" || $friend == "..") {
}
else
{
    $suser = $friend;
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $friend)) {
        if ($suser == $user)
{
    echo("<center><div class=\"up_post\"><center><a href=\"/add/?lang=" . $langprop . "\" class=\"up_new\"><center><div class=\"up_new\"><img src=\"/resources/icons/darkback/ic_add_circle_outline_white_24dp.png\" width=36px height=36px class=\"up_newlogo\"> <span class=\"up_new\">" . $lang_page_new . "</span></center></div></center></a></div></center>");
}
else
{
    $pre_found = false;
    $pre_content = scandir($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page");
    foreach ($pre_content as $pcel)
    {
        if ($pcel == "." || $pcel == ".." || $pcel == "count" || $pcel == "views")
        {

        }
        else
        {
            $pre_found = true;
        }
    }
    if ($pre_found == false)
    {
        echo("<center><i>" . $lang_page_nothing . "</i></center>");
    }
}

$posts = scandir($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page");
$postcount = 0;
foreach(array_reverse($posts) as $post) {
    $postcount = $postcount + 1;
    if ($postcount >= 5) {
    } else {
    if ($post == "." || $post == ".." | $post == "count" | $post == "views") {

    } else {
        $parts = explode("#", HTMLtoMD(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $post . "/content")));
        if ($parts[0] == "text") {
            echo("<center><div class=\"up_post\"><center><div class=\"up_pp\">");
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/resources/image/profile/" . $suser . ".jpg"))
            {
                echo("<img class=\"up_ppic\" src=\"/resources/image/profile/" . $suser . ".jpg\" height=24px width=24px>");
            }
            else
            {
                echo("<a class=\"up_noppic\"></a>");
            }

            if (in_array($suser, $friends))
            {
                echo("<span class=\"up_puser\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/realname")) . "</span>");
            }
            else
            {
                if ($suser == $user)
                {
                    echo("<span class=\"up_puser\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/realname")) . "</span>");
                }
                else
                {
                    echo("<span class=\"up_puser\">" . $suser . "</span>");   
                }
            }

            // if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $post . "/comments") != "disabled") {
            // $comments = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $post . "/comments"));
            
            echo("<span class=\"up_pdate\"> • " . $parts[2]);
            if (isset($parts[3]))
            {
                echo(" • " . $lang_page_last . $parts[3]);
            }
            echo("</span>");

            if ($suser == $user)
            {
                echo("<a href=\"/edit/?id=" . $post . "\" class=\"up_delete\">" . $lang_page_edit . "</a>");
            } elseif (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == "1" || file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == "2") {
                if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/protected") == "1")
                {
                }
                else
                {
                    echo("<a href=\"/moderation/?id=" . $post . "&user=" . $suser . "\" class=\"up_delete\">" . $lang_page_moderate . "</a>");
                }
            }

            echo("</div><span class=\"up_pcont\">" . $parts[1]);
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $post . "/link"))
            {
                if (HTMLtoMD(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $post . "/link")) != "")
                {
                    $linkparts = explode("#", HTMLtoMD(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $post . "/link")));
                    if ($linkparts[0] == "%none%")
                    {
                        echo("<br><a href=\"" . str_replace("▓", "#", $linkparts[1]) . "\">" . str_replace(">", "&gt;",     str_replace("<", "&lt;", str_replace("▓", "#", $linkparts[1]))) . "</a>");
                    }
                    else
                    {
                        echo("<br><a href=\"" . str_replace("▓", "#", $linkparts[1]) . "\">" . $linkparts[0] . "</a>");
                    }
                }
            }
            
            echo("</span><hr class=\"up_pcontsep\"><a href=\"/page/?lang=" . $langprop . "&user=" . $suser . "#" . $post ."\"><b>" . $lang_polymer_view . "</b></a></center></div></center>");

            echo("");
        } if ($parts[0] == "deleted") {
            echo("<center><div class=\"up_post\"><center><i>" . $lang_page_deleted2 . "</i></center></div></center>");
        } if ($parts[0] == "mdeleted") {
            echo("<center><div class=\"up_post\"><center><i>" . $lang_page_deleted3 . "</i></center></div></center>");
        }
    }
}}
    }
}

?>
