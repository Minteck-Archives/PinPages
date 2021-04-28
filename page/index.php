<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
use ColorThief\ColorThief;
include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/languageHandler.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/properties.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/library/markdown/lib.php";

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

if (substr($_SERVER['DOCUMENT_ROOT'], -1) === "/" || substr($_SERVER['DOCUMENT_ROOT'], -1) === "\\") {
    rtrim($_SERVER['DOCUMENT_ROOT']);
}

?>

<?php

if (isset($_COOKIE['token']))
{
    $user = "../private/logout-user";
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . strtok($_COOKIE['token'], '_') . "/tokens/" . $_COOKIE['token']))
    {
        $user = strtok($_COOKIE['token'], '_');
        $loggedIn = true;
    }
    else
    {
        $user = "../private/logout-user";
        header("Location: /login");
die();
    }
}
else
{
    $user = "../private/logout-user";
    header("Location: /login");
die();
}

if (!isset($user)) {
    $user = "../private/logout-user";
    header("Location: /login");
die();
}

function transformDate($date) {
    global $user;
    include_once $_SERVER['DOCUMENT_ROOT'] . "/library/date_functions.php";
    if ($user == "../private/logout-user") {
        $offset = "0";
    } else {
        $offset = getTimezone($user);
    }
    if (validate_ppd($date) === false) {
        return $date;
    } else {
        if (can_to_int($offset) === false) {
            return $date;
        } else {
            if (try_to_int($offset) > 24 || try_to_int($offset) < -24) {
                return $date;
            } else {
                if (validate_ppd(add_offset_ppd(correct_ppd($date), $offset))) {
                    return add_offset_ppd(correct_ppd($date), $offset);
                } else {
                    return $date;
                }
            }
        }
    }
}

if (isset($_GET['user']))
{
    if (trim($_GET['user']) == "")
    {
        $suser = $user;
    }
    else
    {
        $suser = $_GET['user'];
    }
}
else
{
    $suser = $user;
}

if ($suser == $user && $loggedIn === false) {
    echo("<script>location.href = '/errorpage'</script>");
    exit;
}

if ($suser == $user) {
    $allowed = true;
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser)) {
    $views = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/views"));
$views = array_map('trim', $views);
if (in_array($user,$views)) {
}
else
{
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/views", $user . "\n" . file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/views"));
    $viewscount = trim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/views"));
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/views", $viewscount + 1);
}
}

if ($loggedIn) {
    $friends = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/friends/valided"));
    $friends = array_map('trim', $friends);
} else {
    $friends = array();
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser)) {
    if ($suser != $user) {
        if (in_array($suser,$friends)) {
            $allowed = true;
        }
        else
        {
            if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/privacy/private") == "False") {
                $allowed = true;
            } else {
                $allowed = false;
            }
        }
    }
    
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/resources/image/profile/" . $user . ".jpg"))
    {
        echo("<script>var cppic = `<img class=\"up_ppic\" src=\"/resources/image/profile/" . $user . ".jpg\" height=24px width=24px>`</script>");
    }
    else
    {
        echo("<script>var cppic = `<a class=\"up_noppic\"></a>`</script>");
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/favicon.svg" />
        <link rel="stylesheet" href="/resources/style/global.css" />
        <title><?php
        
        if ($suser == $user || in_array($suser, $friends)) {
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser)) {
                echo(strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/realname")));
            } else {
                echo($suser);    
            }
        } else {
            echo($suser);
        }

        echo($lang_page_suffix);
        
        ?></title>
        <meta charset="UTF-8">
        <script src="/resources/libs/jquery.js"></script>
        <script src="index.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script>
            puser = "<?= $suser ?>"
            user = "<?= $user ?>"
        </script>
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
        <script>var langprop = "<?= $langprop ?>";</script>
        <?php
        
        if ($loggedIn) {
            include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/header.php";
        } else {
            include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/headerLoggedOut.php";
        }
        
        ?>
        <div class="header_escape">
            <div class="up_banner" <?php
            
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser)) {
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/resources/image/profile/" . $suser . ".jpg")) {
                    $dominantColor = ColorThief::getColor($_SERVER['DOCUMENT_ROOT'] . "/resources/image/profile/" . $suser . ".jpg");
                    // var_dump($dominantColor);
                    echo(" style=\"background-color:rgb({$dominantColor[0]}, {$dominantColor[1]}, {$dominantColor[2]});background-image:none;box-shadow:5px 1px 5px black;\"");
                } else {
                    echo(" style=\"background-color:#d63023;background-image:none;box-shadow:5px 1px 5px black;\"");
                }
            } else {
                echo(" style=\"background-color:#d63023;background-image:none;box-shadow:5px 1px 5px black;\"");
            }
            
            ?>>
                <br><br><br>
                <?php
                
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser))
                {
                }
                else
                {
                    echo("<h1>" . $lang_page_ttitle . "</h1>");
                    echo($lang_page_tdesc1 . $suser . $lang_page_tdesc2);
                    exit;
                }

                ?>
                <h1 class="up_title">
                <?php

                if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/resources/image/profile/" . $suser . ".jpg"))
                {
                    echo("<img class=\"up_profile\" src=\"/resources/image/profile/" . $suser . ".jpg\" height=38px width=38px>");
                    if (in_array($suser, $friends))
                    {
                        echo("<span class=\"up_tuser up_tuser_alt\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/realname")) . "</span>");
                    }
                    else
                    {
                        if ($suser == $user)
                        {
                            echo("<span class=\"up_tuser up_tuser_alt\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/realname")) . "</span>");
                        }
                        else {
                            echo("<span class=\"up_tuser up_tuser_alt\">" . $suser . "</span>");   
                        }
                    }
                }
                else
                {
                    echo("<a class=\"up_noprof\"></a>");
                    if (in_array($suser, $friends))
                    {
                        echo("<span class=\"up_tuser\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/realname")) . "</span>");
                    }
                    else
                    {
                        if ($suser == $user)
                        {
                            echo("<span class=\"up_tuser\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/realname")) . "</span>");
                        }
                        else {
                            echo("<span class=\"up_tuser\">" . $suser . "</span>");   
                        }
                    }
                }

                if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/verification/status") == "True")
                {
                    echo("<a class=\"validation\" title=\"" . $lang_search_verified . "\"></a>");
                }
                else
                {
                    echo("");
                }

                if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/partner")) {
                    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/partner") == "1")
                {
                    echo("<a class=\"partnership\" title=\"" . $lang_page_partner . "\"></a>");
                }
                else
                {
                    echo("");
                }
                }

                ?>
                <span class="up_bbuttons">
                    <?php
                    if ($loggedIn) {
                        if ($suser != $user)
                    {
                    if (in_array($suser, $friends))
                    {
                        echo("<a class=\"up_bbuttons_link srremove\" href=\"/remove/?name=" . $suser . "\" class=\"srremove\">" . $lang_search_remove . "</a>");
                    }
                    else
                    {
                        echo("<a class=\"up_bbuttons_link sradd\" href=\"/invite/?name=" . $suser . "\" class=\"srremove\">" . $lang_search_request . "</a>");
                    }
                    }
                    }

                    ?>
                </span>
                </h1>
                <?php
                
                $slug = normalize($suser);
                $slug = preg_replace("/[^0-9a-zA-Z ]/m", "", $slug);
                $slug = str_replace(" ", "-", $slug);
                $slug = strtolower($slug);
                
                ?>
                <span class="up_bstats">@<?= $slug ?> — <?= file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/views") ?> <?php
                if (trim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/views")) < 2) {
                    echo $lang_polymer_view1;
                }
                else
                {
                    echo $lang_page_view;
                }
                ?></span>  <img title="<?= $lang_page_viewdesc1 ?>&#13;&#13;<?= $lang_polymer_viewdesc ?>" id="tooltip1" class="up_viewtooltip" src="/resources/icons/lightback/ic_info_outline_grey600_24dp.png" height=18px width=18px> — <?php
                
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/status")) {
                    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/status") == date("YmdHi")) {
                        echo($lang_pm3page_online);
                    } else {
                        if (substr(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/status"), 0, -1) == date("YmdH") . substr(date("i"), 0, 1)) {
                            echo($lang_pm3page_away);
                        } else {
                            $olddate = DateTime::createFromFormat('YmdHi', file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/status"));
                            $newdate = DateTime::createFromFormat('YmdHi', date("YmdHi"));;
                            $interval = $olddate->diff($newdate);
                            if ($interval->y > 0) {
                                if ($interval->y > 1) {
                                    echo($lang_pm3page_offline . " " . $interval->y . " " . $lang_pm3page_date_yearp);
                                } else {
                                    echo($lang_pm3page_offline . " " . $interval->y . " " . $lang_pm3page_date_year);
                                }
                            } else {
                                if ($interval->m > 0) {
                                    if ($interval->m > 1) {
                                        echo($lang_pm3page_offline . " " . $interval->m . " " . $lang_pm3page_date_monthp);
                                    } else {
                                        echo($lang_pm3page_offline . " " . $interval->m . " " . $lang_pm3page_date_month);
                                    }
                                } else {
                                    if ($interval->d > 0) {
                                        if ($interval->d > 1) {
                                            echo($lang_pm3page_offline . " " . $interval->d . " " . $lang_pm3page_date_dayp);
                                        } else {
                                            echo($lang_pm3page_offline . " " . $interval->d . " " . $lang_pm3page_date_day);
                                        }
                                    } else {
                                        if ($interval->h > 0) {
                                            if ($interval->h > 1) {
                                                echo($lang_pm3page_offline . " " . $interval->h . " " . $lang_pm3page_date_hourp);
                                            } else {
                                                echo($lang_pm3page_offline . " " . $interval->h . " " . $lang_pm3page_date_hour);
                                            }
                                        } else {
                                            if ($interval->i > 0) {
                                                if ($interval->i > 1) {
                                                    echo($lang_pm3page_offline . " " . $interval->i . " " . $lang_pm3page_date_minp);
                                                } else {
                                                    echo($lang_pm3page_offline . " " . $interval->i . " " . $lang_pm3page_date_min);
                                                }
                                            } else {
                                                echo($lang_pm3page_offlinenow);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else {
                    echo($lang_pm3page_offline2);
                }

                ?><br><br>
            </div>
            <center>
            <center>
                <div class="up_content">
                <!--<div id="up_more">
                <?php
            
            if ($suser != $user) {
                if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/protected") == "1")
                {
                    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == "1" || file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == "2")
                    {
                        echo("<i>" . $lang_moderation_protected . "</i><hr class=\"up_secsep\">");
                    }
                }
                else
                {
                    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == "1" || file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == "2")
                    {
                        echo("<a href=\"/verification/?user=" . $suser . "\">" . $lang_moderation_verif . "</a> | <a href=\"/partner/?user=" . $suser . "\">" . $lang_moderation_partner . "</a> | <a href=\"/rmppic/?user=" . $suser . "\">" . $lang_moderation_ppic . "</a>");
                        if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == "1") {
                            echo("<hr class=\"up_secsep\">");
                        }
                    }
                    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == "2")
                    {
                        echo(" | <a href=\"/delete/?user=" . $suser . "\">" . $lang_moderation_delete . "</a> | <a href=\"/protect/?user=" . $suser . "\">" . $lang_moderation_protect . "</a> | <a href=\"/permmgr?user=" . $suser . "\">" . $lang_moderation_perms . "</a><hr class=\"up_secsep\">");
                    }
                }
            } else {
                echo("<a href=\"/add\">{$lang_page_new}</a><hr class=\"up_secsep\">");
            }

            ?>
                <h2><?= $lang_polymer2_bio1 ?></h2>
                    <?php
                    
                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/bio")) {
                        if (trim(HTMLtoMD(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/bio"))) != "") {
                            echo(HTMLtoMD(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/bio")));
                            if ($suser == $user) {
                                echo("<br><br><a href=\"/bio/?user=" . $suser . "\">" . $lang_polymer2_bio4 . "</a>");
                            }
                        } else {
                            echo($lang_polymer2_bio2);
                            if ($suser == $user) {
                                echo("<br><br><a href=\"/bio/?user=" . $suser . "\">" . $lang_polymer2_bio5 . "</a>");
                            }
                        }
                    } else {
                        echo($lang_polymer2_bio2);
                        if ($suser == $user) {
                            echo("<br><br><a href=\"/bio/?user=" . $suser . "\">" . $lang_polymer2_bio5 . "</a>");
                        }
                    }

                    ?>

                    <?php

$firstel = true;

if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/verification/status") == "True")
{
    if ($firstel) {
        echo("<br><hr class=\"up_secsep\"><br><a class=\"validation\" title=\"" . $lang_search_verified . "\"></a> {$lang_search_verified}<br>");
        $firstel = false;
    } else {
        echo("<a class=\"validation\" title=\"" . $lang_search_verified . "\"></a> {$lang_search_verified}<br>");
    }
}
else
{
    echo("");
}

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/partner")) {
    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/partner") == "1")
{
    if ($firstel) {
        echo("<br><hr class=\"up_secsep\"><br><a class=\"partnership\" title=\"" . $lang_page_partner . "\"></a> {$lang_page_partner}<br>");
        $firstel = false;
    } else {
        echo("<a class=\"partnership\" title=\"" . $lang_page_partner . "\"></a> {$lang_page_partner}<br>");
    }
}
else
{
    echo("");
}
}

                    ?>

                    <br><hr class="up_secsep">
                </div>
                <script>$("#up_more").hide(0)</script>
                </div>
            </center>
            <span id="more_switch" onclick="switchMore()"><?= $lang_page_more ?></span>
            <script>lang_page_less = "<?= $lang_page_less ?>"</script>
            <script>lang_page_more = "<?= $lang_page_more ?>"</script>
            <hr class="up_secsep">-->
            <center><span id="up_badges">
                <!-- <table class="up_badge_ph">
                    <tbody>
                        <tr>
                            <td><center><span class="up_badge_img"><img class="up_badge_el" src="/resources/icons/lightback/ic_whatshot_grey600_24dp.png"></span></center></td>
                        </tr>
                        <tr>
                            <td><center><span class="up_badge_title">Partenaire PinPages</span></center></td>
                        </tr>
                    </tbody>
                </table>
                <span class="up_badge_sep">|</span> -->
                <a href="/about/?user=<?= $suser ?>"><table class="up_badge_ph"><tbody><tr><td><center><span class="up_badge_img"><img class="up_badge_el" src="/resources/icons/lightback/ic_book_grey600_24dp.png"></span></center></td></tr><tr><td><center><span class="up_badge_title"><?= $lang_pm3page_viewbio ?></span></center></td></tr></tbody></table></a>
                <?php
                
                if ($loggedIn) {
                    if ((file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == "2" || file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == "1") && ($suser != $user)) {
                        if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/protected") != "1") {
                            echo('<a href="/moduser/?user=' . $suser . '"><table class="up_badge_ph"><tbody><tr><td><center><span class="up_badge_img"><img class="up_badge_el" src="/resources/icons/lightback/ic_warning_grey600_24dp.png"></span></center></td></tr><tr><td><center><span class="up_badge_title">' . $lang_pm3page_modtools . '</span></center></td></tr></tbody></table></a>');
                        } else {
                            echo('<table class="up_badge_ph"><tbody><tr><td><center><span class="up_badge_img"><img class="up_badge_el" src="/resources/icons/lightback/ic_sync_problem_grey600_24dp.png"></span></center></td></tr><tr><td><center><span class="up_badge_title">' . $lang_pm3page_protected . '</span></center></td></tr></tbody></table>');
                        }
                    }
                }
                
                ?>
                <span class="up_badge_sep">|</span>
                <?php

                if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/partner") && file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/partner") == "1") {
                    echo('<table class="up_badge_ph"><tbody><tr><td><center><span class="up_badge_img"><img class="up_badge_el" src="/resources/icons/lightback/ic_whatshot_grey600_24dp.png"></span></center></td></tr><tr><td><center><span class="up_badge_title">' . $lang_pm3page_partner . '</span></center></td></tr></tbody></table>');
                }

                if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/verification/status") == "True") {
                    echo('<table class="up_badge_ph"><tbody><tr><td><center><span class="up_badge_img"><img class="up_badge_el" src="/resources/icons/lightback/ic_verified_user_grey600_24dp.png"></span></center></td></tr><tr><td><center><span class="up_badge_title">' . $lang_pm3page_certified . '</span></center></td></tr></tbody></table>');
                }

                ?><table class="up_badge_ph"><tbody><tr><td><center><span class="up_badge_img"><img class="up_badge_el" src="/resources/icons/lightback/ic_notifications<?php
                
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/status")) {
                    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/status") == date("YmdHi")) {
                        echo("_on");
                    } else {
                        if (substr(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/status"), 0, -1) == date("YmdH") . substr(date("i"), 0, 1)) {
                            echo("");
                        } else {
                            echo("_off");
                        }
                    }
                } else {
                    echo("_off");
                }
                
                ?>_grey600_24dp.png"></span></center></td></tr><tr><td><center><span class="up_badge_title"><?php
                
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/status")) {
                    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/status") == date("YmdHi")) {
                        echo($lang_pm3page_online);
                    } else {
                        if (substr(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/status"), 0, -1) == date("YmdH") . substr(date("i"), 0, 1)) {
                            echo($lang_pm3page_away2);
                        } else {
                            echo($lang_pm3page_offline2);
                        }
                    }
                } else {
                    echo($lang_pm3page_offline2);
                }
                
                ?></span></center></td></tr></tbody></table>
                <?php

                if ($suser == $user) {
                    echo('<span class="up_badge_sep">|</span>' . "\n" . '<a href="/add"><table class="up_badge_ph"><tbody><tr><td><center><span class="up_badge_img"><img class="up_badge_el" src="/resources/icons/lightback/ic_add_grey600_24dp.png"></span></center></td></tr><tr><td><center><span class="up_badge_title">' . $lang_pm3page_write . '</span></center></td></tr></tbody></table></a>');
                }
                
                ?>
            </span></center>
            <div class="up_content">
                <?php
                
                if (!$allowed): ?>
                    <center><i><?= $lang_permission_desc ?></i></center>
                    </div></div></center></center></div></body></html>
                <?php die();endif ?>
                <?php
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

                $posts = scandir($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page");
                /*$posts = */sort($posts, SORT_NUMERIC);
                $posts = array_reverse($posts);
                foreach($posts as $post) {
                    if ($post == "." || $post == ".." | $post == "count" | $post == "views") {

                    } else {
                        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $post . "/comments_new")) {} else {
                            file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $post . "/comments_new","");
                        }
                        $parts = explode("#", HTMLtoMD(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $post . "/content")));
                        if ($parts[0] == "text") {
                            echo("<div class=\"up_post\" id=\"" . $post . "\"><div class=\"up_pp\">");
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
                                //echo("<span class=\"up_puser\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/realname")) . "</span>");
                                echo("<span class=\"up_puser\"><a href=\"/page/?user=" . $suser . "\" class=\"up_pagelink\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/realname")) . "</a></span>");
                            }
                            else
                            {
                                if ($suser == $user)
                                {
                                    // echo("<span class=\"up_puser\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/realname")) . "</span>");
                                    echo("<span class=\"up_puser\"><a href=\"/page/?user=" . $user . "\" class=\"up_pagelink\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/realname")) . "</a></span>");
                                }
                                else
                                {
                                    // echo("<span class=\"up_puser\">" . $suser . "</span>");   
                                    echo("<span class=\"up_puser\"><a href=\"/page/?user=" . $suser . "\" class=\"up_pagelink\">" . $suser . "</a></span>");
                                }
                            }
                            // if (HTMLtoMD(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $post . "/comments_new")) != "disabled") {
                            if (substr(HTMLtoMD(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $post . "/comments_new")), 0, 8 ) !== "disabled") {
                            $comments = explode("\n", HTMLtoMD(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $post . "/comments_new")));
                            
                            echo("<span class=\"up_pdate\"> • ". transformDate($parts[2]));
                            if (isset($parts[3]))
                            {
                                echo(" • " . $lang_page_last . transformDate($parts[3]));
                            }
                            echo("</span>");

                            if ($loggedIn) {
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
                            }

                            echo("</div><span class=\"up_pcont\">" . $parts[1]);
                            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $post . "/link"))
                            {
                                if (HTMLtoMD(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $post . "/link")) != "")
                                {
                                    $linkparts = explode("#", HTMLtoMD(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $post . "/link")));
                                    if ($linkparts[0] == "%none%")
                                    {
                                        echo("<br><a target=\"_blank\" href=\"" . str_replace("▓", "#", $linkparts[1]) . "\">" . str_replace(">", "&gt;",     str_replace("<", "&lt;", str_replace("▓", "#", $linkparts[1]))) . "</a>");
                                    }
                                    else
                                    {
                                        echo("<br><a target=\"_blank\" href=\"" . str_replace("▓", "#", $linkparts[1]) . "\">" . $linkparts[0] . "</a>");
                                    }
                                }
                            }
                            $comcount = 0;
                            foreach ($comments as $com) {
                                if (trim($com) != "") {
                                    $comcount = $comcount + 1;
                                }
                            }
                            echo("</span><hr class=\"up_pcontsep\"><div class=\"up_comments\"><b>" . $lang_page_comments . " (&zwnj;" . $comcount . "&zwnj;)</b></span>");
                            if ($loggedIn) {
                                echo("<div class=\"up_newcomment\"><br><input id=\"up_newcomment_post" . $post . "\" class=\"up_newcomment header_search\" placeholder=\"" . $lang_page_comtph . "\" type=\"text\"> <a id=\"up_comsubm\" onclick=\"addComment('" . $post . "')\">" . $lang_page_comsub . "</a><br></div><center>");
                            } else {
                                echo("<center>");
                            }

                            if (str_replace("\n", "", trim(HTMLtoMD(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $post . "/comments_new")))) != "") {
                                echo("<div id=\"comshow_" . $post . "\"class=\"show_comments\" onclick=\"toggleShowComments('" . $post . "')\"></div>");
                            } else {
                                echo("<span class=\"tip\">" . $lang_polymer_nocom . "</span>");
                            }

                            echo("</center><div id=\"up_commentsph_post" . $post . "\" class=\"up_commentsph hide\">");
                            foreach($comments as $comment) {
                                if (substr($comment, 0, 7) == "deleted") {
                                    echo("<b>" . $lang_polymer2_comdelnc1 . "</b> - " . $lang_polymer2_comdelnc2 . explode("#",$comment)[1] . "<br>");
                                } else {
                                if (HTMLtoMD(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $post . "/comments_new")) == "" || $comment == "")
                                {

                                }
                                else{
                                    $comparts = explode('#', $comment);
                                $comuser = trim($comparts[0]);
                                if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/resources/image/profile/" . $comuser . ".jpg"))
                            {
                                echo("<img class=\"up_ppic\" src=\"/resources/image/profile/" . $comuser . ".jpg\" height=24px width=24px>");
                            }
                            else
                            {
                                if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $comuser . "/permissions")) {
                                    echo("<a class=\"up_noppic\"></a>");
                                }
                            }

                            if (in_array($comuser, $friends))
                            {
                                if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $comuser . "/permissions")) {
                                    if (trim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $comuser . "/permissions")) == "1" || trim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $comuser . "/permissions")) == "2")
                                    {
                                        // echo("<span class=\"up_puser\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $comuser . "/realname")) . "<img class=\"up_moderator\" src=\"/resources/icons/darkback/ic_bug_report_white_24dp.png\" height=18px width=18px title=\"" . $lang_page_moderator . "\"></span>");
                                        echo("<span class=\"up_puser\"><a href=\"/page/?user=" . $comuser . "\" class=\"up_pagelink\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $comuser . "/realname")) . "<img class=\"up_moderator\" src=\"/resources/icons/darkback/ic_bug_report_white_24dp.png\" height=18px width=18px title=\"" . $lang_page_moderator . "\"></a></span>");
                                    }
                                    else
                                    {
                                        echo("<span class=\"up_puser\"><a href=\"/page/?user=" . $comuser . "\" class=\"up_pagelink\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $comuser . "/realname")) . "</a></span>");
                                    }
                                } else {
                                    echo("");
                                }
                            }
                            else
                            {
                                if ($comuser == $user)
                                {
                                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $comuser))
                                    {
                                        if (trim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $comuser . "/permissions")) == "1" || trim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $comuser . "/permissions")) == "2")
                                        {
                                            echo("<span class=\"up_puser\"><a href=\"/page/?user=" . $user . "\" class=\"up_pagelink\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/realname")) . "<img class=\"up_moderator\" src=\"/resources/icons/darkback/ic_bug_report_white_24dp.png\" height=18px width=18px title=\"" . $lang_page_moderator . "\"></a></span>");
                                        }
                                        else
                                        {
                                            echo("<span class=\"up_puser\"><a href=\"/page/?user=" . $user . "\" class=\"up_pagelink\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/realname")) . "</a></span>");
                                        }
                                    }
                                    else
                                    {
                                         echo("<span class=\"up_puser\">" . $lang_page_deleted . "</span>");
                                    }
                                }
                                else
                                {
                                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $comuser))
                                    {
                                        if (trim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $comuser . "/permissions")) == "1" || trim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $comuser . "/permissions")) == "2")
                                        {
                                            // echo("<span class=\"up_puser\">" . $comuser . "<img class=\"up_moderator\" src=\"/resources/icons/darkback/ic_bug_report_white_24dp.png\" height=18px width=18px title=\"" . $lang_page_moderator . "\"></span>");
                                            echo("<span class=\"up_puser\"><a href=\"/page/?user=" . $comuser . "\" class=\"up_pagelink\">" . $comuser . "<img class=\"up_moderator\" src=\"/resources/icons/darkback/ic_bug_report_white_24dp.png\" height=18px width=18px title=\"" . $lang_page_moderator . "\"></a></span>");
                                        }
                                        else
                                        {
                                            echo("<span class=\"up_puser\"><a href=\"/page/?user=" . $comuser . "\" class=\"up_pagelink\">" . $comuser . "</a></span>");
                                        }
                                    }
                                    else
                                    {
                                        //echo("<span class=\"up_puser\">" . $lang_page_deleted . "</span>");
                                    }
                                }
                            }

                            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $comuser)) {
                                if (trim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $comuser . "/permissions")) == "1" || trim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $comuser . "/permissions")) == "2") {
                                    echo(" • " . HTMLtoMD_extended($comparts[1]));
                                } else {
                                    echo(" • " . HTMLtoMD($comparts[1]));
                                }
                            } else {
                                echo("");
                            }
                            if ($comuser == $user)
                                {
                                    echo(" • <a onclick=\"removeComment(`" . $comparts[0] . "`,`" . $comparts[1] . "`,`" . $comparts[2] . "`,`" . $post . "`,`" . $suser . "`)\" class=\"jslink editcom\">" . $lang_polymer_editcom . "</a><br>");
                                } else {
                                    if ($loggedIn) {
                                        if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == "1" || file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == "2") {
                                            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $comuser . "/permissions")) {
                                                echo(" • <a href=\"/modcom/?comuser=" . $comparts[0] . "&comtext=" . $comparts[1] . "&comid=" . $comparts[2] . "&postid=" . $post . "&postuser=" . $suser . "\" class=\"jslink editcom\">" . $lang_polymer2_censcom . "</a>");
                                                echo("<br>");
                                            }
                                        } else {
                                            echo("<br>");
                                        }
                                    } else {
                                        echo("<br>");
                                    }
                                }
                                }}

                            }

                            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $post . "/comments")) {
                                echo("</div></div><hr class=\"up_pcontsep\"><b>" . $lang_polymer_oldcom . "</b>");
                                echo("</div>");
                            } else {
                                echo("</div></div></div>");
                            }
                        } else {
                            // echo("<i>" . $lang_page_disabled . "</i>");
                            echo("<span class=\"up_pdate\"> • ". transformDate($parts[2]));
                            if (isset($parts[3]))
                            {
                                echo(" • " . $lang_page_last . transformDate($parts[3]));
                            }
                            echo("</span>");

                            $comments = explode("\n", HTMLtoMD(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $post . "/comments_new")));

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
                            $delmsg = explode("#", HTMLtoMD(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $post . "/comments_new")));
                            if (isset($delmsg[1])) {
                                echo("</span><hr class=\"up_pcontsep\"><b>" . $lang_polymer_del2 . $delmsg[1] . "</b>");
                            } else {
                                echo("</span><hr class=\"up_pcontsep\"><b>" . $lang_polymer_del2 . "???" . "</b>");
                            }
                            // echo("<hr class=\"up_pcontsep\"><b>" . $lang_polymer_oldcom . "</b></div></div>");
                            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/page/" . $post . "/comments")) {
                                echo("</div></div><hr class=\"up_pcontsep\"><b>" . $lang_polymer_oldcom . "</b>");
                            } else {
                                echo("</div></div>");
                            }

                        }} elseif ($parts[0] == "deleted") {
                            //echo("<div class=\"up_post\" id=\"" . $post . "\"><i>" . $lang_page_deleted2 . "</i></div>");
                        } if ($parts[0] == "mdeleted") {
                            if (isset($parts[1])) {
                                echo("<div class=\"up_post\" id=\"" . $post . "\"><i>" . $lang_polymer_del1 . $parts[1] . "</i></div>");
                            } else {
                                echo("<div class=\"up_post\" id=\"" . $post . "\"><i>" . $lang_polymer_del1 . "???" . "</i></div>");
                            }
                        }
                    }
                }

                ?>
            </div></center>
        </div>
        <script src="index.js"></script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>
