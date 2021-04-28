PinPages = {
    goto: (page) => {
        document.getElementById('nd_maincontent').contentWindow.location.href = page;
        document.getElementById('nd_maincontent').focus();
    },

    search: () => {
        document.getElementById('nd_maincontent').contentWindow.location.href = "/search_home";
        document.getElementById('nd_maincontent').focus();
    },

    explore: () => {
        document.getElementById('nd_maincontent').contentWindow.location.href = "/search/?q=.";
        document.getElementById('nd_maincontent').focus();
    },

    modal: {
        createPost: () => {
            document.getElementById('nd_maincontent').contentWindow.location.href = "/add";
            document.getElementById('nd_maincontent').focus();
        }
    },

    menu: {
        settings: () => {
            document.getElementById('nd_maincontent').contentWindow.location.href = "/account";
            document.getElementById('nd_maincontent').focus();
        },
        share: () => {
            document.getElementById('share-dialog-link').innerHTML = '<input id="share-dialog-link-inner" type="text" value="' + location.href.split("\"").join("&quot;") + '" />';
            document.getElementById('share-dialog-link').href = location.href;

            parts = document.getElementById('nd_maincontent').contentWindow.location.href.split("/");
            parts.shift();
            parts.shift();
            parts.shift();
            url = parts.join("/");
            
            document.getElementById('share-dialog-qr').src = "/library/page_qr_share.php?u=/" + url;

            document.getElementById('share-facebook').href = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURI(location.href);
            document.getElementById('share-twitter').href = "https://twitter.com/home?status=" + encodeURI(location.href + ", " + lang_share_from + " #PinPages " + lang_share_by + " @MtkProjects");
            document.getElementById('share-linkedin').href = "https://www.linkedin.com/shareArticle?mini=true&url=" + encodeURI(location.href);
            document.getElementById('share-reddit').href = "http://www.reddit.com/submit?url=" + encodeURI(location.href);
            document.getElementById('share-email').href = "mailto:?body=" + encodeURI(location.href + ", " + lang_share_from + " PinPages, " + lang_share_by + " Minteck Projects");

            $("#mx_Dialog_Container").fadeIn(100);
        },
        page: () => {
            document.getElementById('nd_maincontent').contentWindow.location.href = "/page";
            document.getElementById('nd_maincontent').focus();
        },
        board: () => {
            document.getElementById('nd_maincontent').contentWindow.location.href = "/board";
            document.getElementById('nd_maincontent').focus();
        },
        notifications: () => {
            document.getElementById('nd_maincontent').contentWindow.location.href = "/notifications";
            document.getElementById('nd_maincontent').focus();
        }
    },

    share: {
        copy: () => {
            document.getElementById('share-dialog-link-inner').select();
            document.getElementById('share-dialog-link-inner').setSelectionRange(0, 99999);
            document.execCommand("copy");
        },

        close: () => {
            $("#mx_Dialog_Container").fadeOut(100);
        }
    }
}