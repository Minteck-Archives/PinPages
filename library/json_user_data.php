<?php

function getData() {
    if (substr($_SERVER['DOCUMENT_ROOT'], -1) === "/" || substr($_SERVER['DOCUMENT_ROOT'], -1) === "\\") {
        rtrim($_SERVER['DOCUMENT_ROOT']);
    }
    
    $user = strtok($_COOKIE['token'],'_');
    
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token'])) {} else {
        header("HTTP/1.1 401 Invalid Token");
        exit;
    }
    
    $data['username'] = $user;
    $data['settings']['realname'] = strrev(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/realname"));
    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/dark") == "True") {
        $data['settings']['darkmode'] = true;
    } else {
        $data['settings']['darkmode'] = false;
    }
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/email")) {
        if (trim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/email")) != "") {
            $data['settings']['email'] = trim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/email"));
        } else {
            $data['settings']['email'] = null;
        }
    } else {
        $data['settings']['email'] = null;
    }
    if (trim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == "0")) {
        $data['settings']['permissions'] = 0;
    } else {
        if (trim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/permissions") == "1")) {
            $data['settings']['permissions'] = 1;
        } else {
            $data['settings']['permissions'] = 2;
        }
    }
    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/protected") == "1") {
        $data['settings']['protected'] = true;
    } else {
        $data['settings']['protected'] = false;
    }
    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/privacy/discovery") == "True") {
        $data['settings']['discoverable'] = true;
    } else {
        $data['settings']['discoverable'] = false;
    }
    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/privacy/private") == "True") {
        $data['settings']['privatepage'] = true;
    } else {
        $data['settings']['privatepage'] = false;
    }
    if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/verification/status") == "True") {
        $data['verification']['enabled'] = true;
        $data['verification']['since'] = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/verification/since");
    } else {
        $data['verification']['enabled'] = false;
        $data['verification']['since'] = null;
    }
    
    $data['notifications']['unread']['count'] = 0;
    $data['notifications']['unread']['last']['title'] = null;
    $data['notifications']['unread']['last']['desc'] = null;
    $data['notifications']['unread']['last']['date'] = null;
    $data['notifications']['read']['count'] = 0;
    $data['notifications']['read']['last']['title'] = null;
    $data['notifications']['read']['last']['desc'] = null;
    $data['notifications']['read']['last']['date'] = null;
    $notifications = array_reverse(explode("\n",file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/notifications/unread")));
    foreach ($notifications as $notification) {
        if (trim($notification) == "") {} else {
            $notification = str_replace("\r", "",$notification);
            $data['notifications']['unread']['count'] = $data['notifications']['unread']['count'] + 1;
            $details = explode("#",$notification);
            $data['notifications']['unread']['last']['title'] = $details[0];
            $data['notifications']['unread']['last']['desc'] = $details[1];
            $data['notifications']['unread']['last']['date'] = $details[2];
        }
    }
    $notifications = array_reverse(explode("\n",file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/notifications/read")));
    foreach ($notifications as $notification) {
        if (trim($notification) == "") {} else {
            $notification = str_replace("\r", "",$notification);
            $data['notifications']['read']['count'] = $data['notifications']['read']['count'] + 1;
            $details = explode("#",$notification);
            $data['notifications']['read']['last']['title'] = $details[0];
            $data['notifications']['read']['last']['desc'] = $details[1];
            $data['notifications']['read']['last']['date'] = $details[2];
        }
    }
    
    $data['friends']['requests']['count'] = 0;
    $data['friends']['requests']['list'] = array();
    $data['friends']['accepted']['count'] = 0;
    $data['friends']['accepted']['list'] = array();
    
    $friends = array_reverse(explode("\n",file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/friends/incoming")));
    foreach ($friends as $friend) {
        if (trim($friend) == "") {} else {
            $friend = str_replace("\r", "",$friend);
            $data['friends']['requests']['count'] = $data['friends']['requests']['count'] + 1;
            array_push($data['friends']['requests']['list'], $friend);
        }
    }
    $friends = array_reverse(explode("\n",file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/friends/valided")));
    foreach ($friends as $friend) {
        if (trim($friend) == "") {} else {
            $friend = str_replace("\r", "",$friend);
            $data['friends']['accepted']['count'] = $data['friends']['accepted']['count'] + 1;
            array_push($data['friends']['accepted']['list'], $friend);
        }
    }
    $data['page']['views'] = 0;
    $views = explode("\n",file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/views"));
    foreach ($views as $view) {
        $data['page']['views'] = $data['page']['views'] + 1;
    }
    $data['page']['posts']['count'] = 0;
    $posts = array_reverse(scandir($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page"));
    foreach ($posts as $post) {
        if ($post == "." || $post == ".." || $post == "views" || $post == "count") {} else {
            $data['page']['posts']['count'] = $data['page']['posts']['count'] + 1;
            $data['page']['posts']['list'][$post] = null;
            $postcnt = explode('#', file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $post . "/content"));
            if ($postcnt[0] == "deleted" || $postcnt[0] == "mdeleted") {
                $data['page']['posts']['list'][$post]['type'] = "deleted";
                $data['page']['posts']['list'][$post]['status'] = "deleted";
                $data['page']['posts']['list'][$post]['content'] = null;
                $data['page']['posts']['list'][$post]['comments'] = null;
                $data['page']['posts']['list'][$post]['link'] = null;
                $data['page']['posts']['list'][$post]['link']['target'] = null;
                $data['page']['posts']['list'][$post]['link']['name'] = null;
                $data['page']['posts']['list'][$post]['timestamps']['create'] = null;
                $data['page']['posts']['list'][$post]['timestamps']['edit'] = null;
            } else {
                $data['page']['posts']['list'][$post]['type'] = $postcnt[0];
                $data['page']['posts']['list'][$post]['status'] = "alive";
                $data['page']['posts']['list'][$post]['content'] = $postcnt[1];
                $data['page']['posts']['list'][$post]['comments'] = null;
                $data['page']['posts']['list'][$post]['link'] = null;
                $data['page']['posts']['list'][$post]['link']['target'] = null;
                $data['page']['posts']['list'][$post]['link']['name'] = null;
                $data['page']['posts']['list'][$post]['timestamps']['create'] = $postcnt[2];
                $data['page']['posts']['list'][$post]['timestamps']['edit'] = null;
                if (isset($postcnt[3])) {
                    $data['page']['posts']['list'][$post]['timestamps']['edit'] = $postcnt[3];
                }
                if (trim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $post . "/link")) != "#") {
                    $link = explode('#', file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $post . "/link"));
                    $data['page']['posts']['list'][$post]['link']['target'] = $link[1];
                    $data['page']['posts']['list'][$post]['link']['name'] = $link[0];
                }
                $comments = array_reverse(explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/page/" . $post . "/comments_new")));
                $data['page']['posts']['list'][$post]['comments'] = array();
                $data['page']['posts']['list'][$post]['comments']['count'] = 0;
                foreach ($comments as $comment) {
                    if (trim($comment) == "") {} else {
                        $data['page']['posts']['list'][$post]['comments']['count'] = $data['page']['posts']['list'][$post]['comments']['count'] + 1;
                        $comdata = explode('#', $comment);
                        $comstat = null;
                        $comuser = null;
                        $comtext = null;
                        if ($comdata[0] == "deleted") {
                            $comstat = "deleted";
                        } else {
                            $comstat = "alive";
                            $comuser = $comdata[0];
                            $comtext = $comdata[1];
                        }
                        $comcount = $data['page']['posts']['list'][$post]['comments']['count'] = $data['page']['posts']['list'][$post]['comments']['count'];
                        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $comuser)) {
                            $data['page']['posts']['list'][$post]['comments'][$comcount]['status'] = "user_deleted";
                            $data['page']['posts']['list'][$post]['comments'][$comcount]['sender'] = null;
                            $data['page']['posts']['list'][$post]['comments'][$comcount]['content'] = null;
                        } else {
                            $data['page']['posts']['list'][$post]['comments'][$comcount]['status'] = $comstat;
                            $data['page']['posts']['list'][$post]['comments'][$comcount]['sender'] = $comuser;
                            $data['page']['posts']['list'][$post]['comments'][$comcount]['content'] = $comtext;
                        }
                    }
                }
            }
        }
    }
    return $data;
}