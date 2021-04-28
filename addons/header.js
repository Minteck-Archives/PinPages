function settings() {
    location.href = "/account"
}

function page() {
    location.href = "/page"
}

var client = {
    isDesktop: function () {
        return navigator.userAgent.includes("pinpages-client/");
    },
    isMobile: function () {
        return navigator.userAgent.includes("KHTML,") && navigator.userAgent.includes("Android");
    },
    compatibility: {
        mobileClient: function () {
            if (navigator.userAgent.includes("Android")) {
                return true;
            } else {
                return false;
            }
        },
        desktopClient: function () {
            if (navigator.userAgent.includes("Windows")) {
                return true;
            } else {
                return false;
            }
        }
    }
}
