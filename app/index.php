<?php 

include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/languageHandler.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/properties.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/library/markdown/lib.php";

?>

<?php

if (isset($_COOKIE['token']))
{
    $user = strtok($_COOKIE['token'], '_');
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

?>
<!DOCTYPE html>

<head>
    <link rel="icon" href="/favicon.svg" />
    <link rel="stylesheet" href="/resources/style/global.css" />
    <link rel="stylesheet" href="/resources/style/superstyle-light.css" />
    <title>PinPages</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/resources/libs/jquery.js"></script>
    <script src="index.js"></script>
    <script>
        lang_share_from = "<?= $lang_share_from ?>";
        lang_share_by = "<?= $lang_share_by ?>";
    </script>
</head>

<body style="height: 100%; margin: 0px; --avatar-url:url('/resources/image/profile/?u=<?= $user ?>');" data-vector-indexeddb-worker-script="bundles/4b24573a6fca6ac60cde/indexeddb-worker.js">
    <noscript>Sorry, PinPages requires JavaScript to be enabled.</noscript>
    <section id="matrixchat" style="height: 100%; overflow: auto;" class="notranslate">
        <div class="mx_MatrixChat_wrapper" aria-hidden="false">
            <div class="mx_ToastContainer" role="alert"></div>
            <div class="mx_MatrixChat">
                <div class="mx_LeftPanel2 mx_LeftPanel2_hasTagPanel" style="width:294px;">
                    <aside class="mx_LeftPanel2_roomListContainer" style="width:100%;">
                        <div class="mx_LeftPanel2_userHeader">
                            <div aria-haspopup="true" aria-expanded="false" role="button" tabindex="0" class="mx_UserMenu">
                                <div class="mx_UserMenu_row"><span class="mx_UserMenu_userAvatarContainer"><img src="/resources/image/profile/?u=<?= $user ?>" style="width: 32px; height: 32px;" alt="" role="button" tabindex="0" class="mx_AccessibleButton mx_BaseAvatar mx_BaseAvatar_image mx_UserMenu_userAvatar"></span><span class="mx_UserMenu_userName"><?= $user ?></span><span class="nd_logout_item" onclick="location.href='/logout';" style="cursor:pointer;" title="<?= $lang_app_logout ?>"></span></div>
                            </div>
                        </div>
                        <div class="mx_LeftPanel2_filterContainer">
                            <a class="mx_RoomSearch" onclick="PinPages.search()">
                                <div class="mx_RoomSearch_icon"></div><span class="mx_RoomSearch_input"><?= $lang_app_search ?></span>
                            </a>
                            <div title="<?= $lang_app_explore ?>" onclick="PinPages.explore()" role="button" tabindex="0" class="mx_AccessibleButton mx_LeftPanel2_exploreButton"></div>
                        </div>
                        <div class="mx_LeftPanel2_roomListWrapper mx_LeftPanel2_roomListWrapper_stickyTop mx_LeftPanel2_roomListWrapper_stickyBottom">
                            <div class="mx_LeftPanel2_actualRoomListContainer mx_AutoHideScrollbar" tabindex="-1">
                                <div class="mx_RoomList2" role="tree">
                                    <div class="mx_RoomSublist2" role="group">
                                        <div style="position: relative; user-select: auto; width: auto; height: 180px; max-height: 180px; min-height: 76px; box-sizing: border-box; flex-shrink: 0;">
                                            <div class="mx_RoomSublist2_tiles">
                                            <?php
                                            
                                            $friends = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/friends/valided"));
                                            sort($friends, SORT_NATURAL + SORT_FLAG_CASE);

                                            foreach ($friends as $friend) {
                                                if (trim($friend) != "") {
                                                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . trim($friend))) {
                                                        echo('<div onclick="PinPages.goto(\'/page/?user=' . $friend . '\')" tabindex="-1" role="treeitem" aria-label="' . $friend . '" aria-selected="false" class="mx_AccessibleButton mx_RoomTile2"><div class="mx_DecoratedRoomAvatar"><img class="mx_BaseAvatar mx_BaseAvatar_image" src="/resources/image/profile/?u=' . $friend . '" style="width: 32px; height: 32px;" alt=""></div><div class="mx_RoomTile2_nameContainer"><div title="' . $friend . '" class="mx_RoomTile2_name" tabindex="-1" dir="auto">' . $friend .'</div></div><div class="mx_RoomTile2_badgeContainer" aria-hidden="true"></div></div>');
                                                    }
                                                }
                                            }

                                            ?>
                                            </div>
                                        <div style="width: 100%; height: 100%; position: absolute; transform: scale(0); left: 0px; flex: 0 1 0%;" class="__resizable_base__"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
                <main class="mx_RoomView">
                    <div class="mx_RoomHeader light-panel">
                        <div class="mx_RoomHeader_wrapper" aria-owns="mx_RightPanel">
                            <div class="mx_RoomHeader_avatar">
                                <a href="#/home"><div class="mx_DecoratedRoomAvatar"><img src="/resources/image/logo.svg" style="width: 32px; height: 32px;" alt="" role="button" tabindex="0" class="mx_AccessibleButton mx_BaseAvatar mx_BaseAvatar_image"><div class="mx_TextWithTooltip_tooltip"></div></span></div></a>
                            </div>
                            <div class="mx_RoomHeader_e2eIcon"></div>
                            <a href="#/home"><div class="mx_RoomHeader_name">
                                <div dir="auto" class="mx_RoomHeader_nametext" id="nd_pagename">PinPages</div>
                            </div></a>
                            <div class="mx_RoomHeader_topic" dir="auto"></div>
                            <div class="mx_RoomHeader_buttons">
                                <div title="<?= $lang_app_settings ?>" onclick="PinPages.menu.settings()" role="button" tabindex="0" class="mx_AccessibleButton mx_RoomHeader_button mx_RoomHeader_settingsButton"></div>
                                <div title="<?= $lang_app_share ?>" onclick="PinPages.menu.share()" role="button" tabindex="0" class="mx_AccessibleButton mx_RoomHeader_button mx_RoomHeader_shareButton"></div>
                                <div aria-selected="false" onclick="PinPages.menu.page()" role="tab" title="<?= $lang_app_page ?>" tabindex="0" class="mx_AccessibleButton mx_RightPanel_headerButton mx_RightPanel_membersButton"></div>
                                <div aria-selected="false" role="tab" onclick="PinPages.menu.board()" title="<?= $lang_app_board ?>" tabindex="0" class="mx_AccessibleButton mx_RightPanel_headerButton mx_RightPanel_filesButton"></div>
                            </div>
                            <div class="mx_HeaderButtons" role="tablist">
                                <div aria-selected="false" role="tab" onclick="PinPages.menu.notifications()" title="<?= $lang_app_notifications ?>" tabindex="0" class="mx_AccessibleButton mx_RightPanel_headerButton mx_RightPanel_notifsButton"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mx_MainSplit">
                        <div class="mx_RoomView_body mx_fadable">
                            <div class="mx_RoomView_timeline mx_RoomView_timeline_rr_enabled">
                                <div class="mx_AutoHideScrollbar mx_ScrollPanel mx_RoomView_messagePanel mx_GroupLayout">
                                    <div class="nd_content_box">
                                        <iframe src="/home" frameborder="0" id="nd_maincontent" class="nd_content_frame"></iframe>
                                        <script>

                                            oldu = null;
                                            setInterval(() => {
                                                hash = location.hash.substr(1);

                                                if (hash == "" && hash != oldu) {
                                                    document.getElementById('nd_maincontent').src = "/home";

                                                    oldu = hash;
                                                } else if (hash != oldu) {
                                                    if (hash.startsWith("/") && (hash.substr(1, 1) != "/")) {
                                                        document.getElementById('nd_maincontent').src = hash;
                                                    } else {
                                                        document.getElementById('nd_maincontent').src = "/home";
                                                    }

                                                    oldu = hash;
                                                }
                                            }, 200)

                                            document.getElementById('nd_maincontent').onload = () => {
                                                els = document.getElementById('nd_maincontent').contentWindow.location.href.split("/");

                                                els.shift();
                                                els.shift();
                                                els.shift();
                                                
                                                oldu = "/" + els.join("/");

                                                window.history.replaceState("PinPages", "PinPages", "#/" + els.join("/"));

                                                if (document.getElementById('nd_maincontent').contentWindow.document.title.endsWith("PinPages")) {
                                                    document.getElementById('nd_pagename').innerHTML = document.getElementById('nd_maincontent').contentWindow.document.title.substr(0, document.getElementById('nd_maincontent').contentWindow.document.title.length - 11).split("<").join("&lt;").split(">").join("&gt;");
                                                    document.title = document.getElementById('nd_maincontent').contentWindow.document.title.substr(0, document.getElementById('nd_maincontent').contentWindow.document.title.length - 11).split("<").join("&lt;").split(">").join("&gt;") + " | PinPages";
                                                } else if (document.getElementById('nd_maincontent').contentWindow.document.title.endsWith("PinPages Board")) {
                                                    document.getElementById('nd_pagename').innerHTML = document.getElementById('nd_maincontent').contentWindow.document.title.substr(0, document.getElementById('nd_maincontent').contentWindow.document.title.length - 17).split("<").join("&lt;").split(">").join("&gt;");
                                                    document.title = document.getElementById('nd_maincontent').contentWindow.document.title.substr(0, document.getElementById('nd_maincontent').contentWindow.document.title.length - 17).split("<").join("&lt;").split(">").join("&gt;") + " | PinPages";
                                                } else {
                                                    document.getElementById('nd_pagename').innerHTML = document.getElementById('nd_maincontent').contentWindow.document.title.split("<").join("&lt;").split(">").join("&gt;");
                                                    document.title = document.getElementById('nd_maincontent').contentWindow.document.title.split("<").join("&lt;").split(">").join("&gt;") + " | PinPages";
                                                }
                                            }

                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="mx_RoomView_statusArea">
                                <div class="mx_RoomView_statusAreaBox">
                                    <div class="mx_RoomView_statusAreaBox_line"></div>
                                    <div class="mx_RoomStatusBar">
                                        <div class="mx_RoomStatusBar_indicator"></div>
                                        <div role="alert"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mx_MessageComposer mx_GroupLayout">
                                <div class="mx_MessageComposer_wrapper">
                                    <div class="mx_MessageComposer_row">
                                        <div class="mx_MessageComposer_avatar"><img src="/resources/image/profile/?u=<?= $user ?>" style="width: 24px; height: 24px;" alt="" role="button" tabindex="0" class="mx_AccessibleButton mx_BaseAvatar mx_BaseAvatar_image"></div>
                                        <div class="mx_SendMessageComposer">
                                            <div class="mx_SendMessageComposer_overlayWrapper"></div>
                                            <div class="mx_BasicMessageComposer"><div onclick="PinPages.modal.createPost()" class="mx_BasicMessageComposer_input mx_BasicMessageComposer_input_shouldShowPillAvatar mx_BasicMessageComposer_inputEmpty" tabindex="0" aria-label="Create a new post…" role="textbox" aria-multiline="true" aria-autocomplete="both" aria-haspopup="listbox" aria-expanded="false" dir="auto" style="--placeholder:'<?= $lang_app_write ?>';cursor:pointer;"><div><br></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="mx_CallContainer"></div>
    </section>

    <audio id="messageAudio">
        <source src="media/message.ogg" type="audio/ogg">
        <source src="media/message.mp3" type="audio/mpeg">
    </audio>
    <audio id="ringAudio" loop="">
        <source src="media/ring.ogg" type="audio/ogg">
        <source src="media/ring.mp3" type="audio/mpeg">
    </audio>
    <audio id="ringbackAudio" loop="">
        <source src="media/ringback.ogg" type="audio/ogg">
        <source src="media/ringback.mp3" type="audio/mpeg">
    </audio>
    <audio id="callendAudio">
        <source src="media/callend.ogg" type="audio/ogg">
        <source src="media/callend.mp3" type="audio/mpeg">
    </audio>
    <audio id="busyAudio">
        <source src="media/busy.ogg" type="audio/ogg">
        <source src="media/busy.mp3" type="audio/mpeg">
    </audio>
    <audio id="remoteAudio"></audio>
    
    <div id="mx_theme_accentColor"></div>
    <div id="mx_theme_secondaryAccentColor"></div>
    <div id="mx_theme_tertiaryAccentColor"></div>

    <div id="mx_Dialog_StaticContainer"></div>
    <div id="mx_Dialog_Container" style="display:none;"><div class="mx_Dialog_wrapper"><div class="mx_Dialog"><div data-focus-guard="true" tabindex="0" style="width: 1px; height: 0px; padding: 0px; overflow: hidden; position: fixed; top: 1px; left: 1px;"></div><div data-focus-guard="true" tabindex="1" style="width: 1px; height: 0px; padding: 0px; overflow: hidden; position: fixed; top: 1px; left: 1px;"></div><div data-focus-lock-disabled="false" role="dialog" aria-labelledby="mx_BaseDialog_title" aria-describedby="mx_Dialog_content" class="mx_ShareDialog mx_Dialog_fixedWidth"><div class="mx_Dialog_header mx_Dialog_headerWithCancel"><div class="mx_Dialog_title" id="mx_BaseDialog_title"><?= $lang_share_title ?></div><div aria-label="<?= $lang_share_close ?>" title="<?= $lang_share_close ?>" onclick="PinPages.share.close();" role="button" tabindex="0" class="mx_AccessibleButton mx_Dialog_cancelButton"></div></div><div class="mx_ShareDialog_content"><div class="mx_ShareDialog_matrixto"><a href="about:blank" class="mx_ShareDialog_matrixto_link" id="share-dialog-link" onclick="event.preventDefault();PinPages.share.copy();return false;" onmousedown="event.preventDefault();PinPages.share.copy();return false;"><input id="share-dialog-link-inner" type="text" value="about:blank" /></a><div aria-label="<?= $lang_share_copy ?>" title="<?= $lang_share_copy ?>" onclick="PinPages.share.copy();" role="button" tabindex="0" class="mx_AccessibleButton mx_ShareDialog_matrixto_copy"><div></div></div></div><hr><div class="mx_ShareDialog_split"><div class="mx_ShareDialog_qrcode_container"><div class="mx_QRCode"><img id="share-dialog-qr" src="/library/page_qr_share.php" class="mx_VerificationQRCode" alt="QR Code"></div></div><div class="mx_ShareDialog_social_container"><a rel="noreferrer noopener" target="_blank" title="Facebook" id="share-facebook" href="https://www.facebook.com/sharer/sharer.php?u=about:blank" class="mx_ShareDialog_social_icon"><img src="/resources/icons/new/facebook.png" alt="Facebook" height="64" width="64"></a><a rel="noreferrer noopener" target="_blank" id="share-twitter" title="Twitter" href="https://twitter.com/home?status=about:blank" class="mx_ShareDialog_social_icon"><img src="/resources/icons/new/twitter.png" alt="Twitter" height="64" width="64"></a><a rel="noreferrer noopener" target="_blank" title="LinkedIn" id="share-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=about:blank" class="mx_ShareDialog_social_icon"><img src="/resources/icons/new/linkedin.png" alt="LinkedIn" height="64" width="64"></a><a rel="noreferrer noopener" target="_blank" title="Reddit" id="share-reddit" href="http://www.reddit.com/submit?url=about:blank" class="mx_ShareDialog_social_icon"><img src="/resources/icons/new/reddit.png" alt="Reddit" height="64" width="64"></a><a rel="noreferrer noopener" id="share-email" target="_blank" title="email" href="mailto:?body=about:blank" class="mx_ShareDialog_social_icon"><img src="/resources/icons/new/email.png" alt="email" height="64" width="64"></a></div></div></div></div><div data-focus-guard="true" tabindex="0" style="width: 1px; height: 0px; padding: 0px; overflow: hidden; position: fixed; top: 1px; left: 1px;"></div></div><div class="mx_Dialog_background"></div></div></div>
</body>

</html>
