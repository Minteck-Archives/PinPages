<?php

$user = strtok($_COOKIE['token'], '_');

if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token'])) {} else {
    header("HTTP/1.1 401 Invalid Token");
    exit;
}

if (isset($_POST['user'])) {
    $suser = $_POST['user'];
    if ($suser == $user) {
        $editable = true;
    } else {
        $shares = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/board/settings/shares");
        $shares = explode("\n", $shares);
        foreach ($shares as $share) {
            $pieces = explode("|", $share);
            if ($pieces[0] == $user) {
                if ($pieces[1] == "1") {
                    $editable = true;
                } else {
                    $editable = false;
                }
            }
        }
    }
} else {
    die("No user");
}

if (!isset($editable)) {
    die("Denied/Not found");
}

$onlinemembersraw = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/board/online");
$onlinemembers = explode("\n", $onlinemembersraw);
$date = date("YmdHi") . substr(date("s"), 0, 1);
$index = -1;
$updated = false;
foreach ($onlinemembers as $member) {
    $index = $index + 1;
    $memberdata = explode("|", $member);
    if ($memberdata[0] == $user && $memberdata[1] == $_COOKIE['token']) {
        $memberdata[2] = $date;
        $member = implode("|", $memberdata);
        $onlinemembers[$index] = $member;
        $onlinemembersraw = implode("\n", $onlinemembers);
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/board/online", $onlinemembersraw);
        $updated = true;
    }
}
if (!$updated) {
    array_push($onlinemembers, $user . "|" . $_COOKIE['token'] . "|" . $date);
    $onlinemembersraw = implode("\n", $onlinemembers);
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/board/online", $onlinemembersraw);
}

$membersraw = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/board/online");
$members = explode("\n", $membersraw);
$date = date("YmdHi") . substr(date("s"), 0, 1);
$online = 0;
foreach ($members as $member) {
    if (trim($member) != "") {
        $memberdata = explode("|", $member);
        if ($memberdata[2] == $date) {
            $online = $online + 1;
        }
    }
}

echo("ok|" . $online . "|=" . file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $suser . "/board/content"));