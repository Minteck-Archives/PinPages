<center><h1><?= $lang_polymer_hometitle ?></h1>
<b><?= $lang_home_didyouknow ?> </b><?php

if ($lang == "fr" && file_exists($_SERVER['DOCUMENT_ROOT'] . "/library/motd_fr.dic")) {
    $lines = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/library/motd_fr.dic"));
} else {
    $lines = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/library/motd.dic"));
}
$choices = count($lines);
$random = rand(1, $choices) - 1;
echo($lines[$random]);

?>
            <h2><?= $lang_polymer_latest ?></h2>
            <?php

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

            $friends = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/friends/valided"));
            $friends = array_map('trim', $friends);
            foreach ($friends as $friend) {
                if ($friend == "." || $friend == "" || $friend == "..") {
                }
                else
                {
                    $suser = $friend;
                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $friend)) {
                        // echo("<h3>" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $friend . "/realname")) . "</h3>");
                        if ($suser == $user)
                {
                    echo("<center><div class=\"up_post\"><center><a href=\"/add\" class=\"up_new\"><center><div class=\"up_new\"><img src=\"/resources/icons/darkback/ic_add_circle_outline_white_24dp.png\" width=36px height=36px class=\"up_newlogo\"> <span class=\"up_new\">" . $lang_page_new . "</span></center></div></center></a></div></center>");
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
                            
                            echo("<span class=\"up_pdate\"> • ". transformDate($parts[2]));
                            if (isset($parts[3]))
                            {
                                echo(" • " . $lang_page_last. transformDate($parts[3]));
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
                            
                            echo("</span><hr class=\"up_pcontsep\"><a href=\"/page/?user=" . $suser . "#" . $post ."\"><b>" . $lang_polymer_view . "</b></a></center></div></center>");

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
            }

            ?>
            <h2><?= $lang_dashboard_notif ?></h2>
            <?php

                $notifs = false;
                $lines = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/notifications/unread"));
                foreach ($lines as $line) {
                    if ($line == "")
                    {
                    }
                    else
                    {
                        $array = explode("#", $line);
                        echo("<span class=\"notif_title\">" . $array[0] . "</span><span class=\"notif_date\"> • " . $array[2] . "</span><br><span class=\"notif_desc\">" . $array[1] . "</span><br><br>");
                        $notifs = true;
                    }
                }
                if ($notifs == false)
                {
                    echo("<span class=\"tip\">" . $lang_notifications_none . "</span><br><br>");
                }
                else
                {
                    echo("<a onclick=\"clearNotifications()\" class=\"jslink\">". $lang_notifications_read . "</a> | ");
                }

            ?>
            <a href="/notifications"><?= $lang_notifications_all ?></a>
            <h2><?= $lang_friends_requests ?></h2>
            <?php

            $isfriends = false;
            $friends = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/friends/incoming"));
            $friends = array_map('trim', $friends);
            foreach($friends as $friend) {
                if (trim($friend) != "") {
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $friend))
                {
                    $isfriends = true;
                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/resources/image/profile/" . $friend . ".jpg"))
                    {
                        echo("<img class=\"up_ppic\" src=\"/resources/image/profile/" . $friend . ".jpg\" height=38px width=38px>");
                        echo("<span class=\"up_puser up_puser_alt\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $friend . "/realname")) . "</span>");
                    }
                    else
                    {
                        echo("<a class=\"up_noppic\"></a>");
                        echo("<span class=\"up_puser\">" . strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $friend . "/realname")) . "</span>");
                    }
                    echo("<span onclick=\"validateFriend(`" . $friend . "`)\" class=\"srgo\">" . $lang_friends_validate . "</span>");
                    echo("<span onclick=\"ignoreFriend(`" . $friend . "`)\" class=\"srremove\">" . $lang_friends_ignore . "</span><br><hr class=\"dbfrsep\">");
                }
                }
            }
            if ($isfriends == false)
            {
                echo("<span class=\"tip\">" . $lang_friends_norqs . "</span>");
            }

            ?>
            </center>