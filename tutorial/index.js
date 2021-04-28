function preventStep(fromSettings) {
    if (currentPage > 1) {
        currentPage = currentPage - 1
        $("#tutorial_desc_1").fadeOut("500")
        $("#tutorial_desc_2").fadeOut("500")
        $("#tutorial_desc_3").fadeOut("500")
        $("#tutorial_desc_4").fadeOut("500")
        $("#tutorial_panel_1").fadeOut("500")
        $("#tutorial_panel_2").fadeOut("500")
        $("#tutorial_panel_3").fadeOut("500")
        $("#tutorial_panel_4").fadeOut("500")
        setTimeout(function () {
            $("#tutorial_desc_" + currentPage).fadeIn("500")
            $("#tutorial_panel_" + currentPage).fadeIn("500")
        }, 505)
    } else {
        if (fromSettings) {
            location.href = "/account/datapictures";
        }
    }
}

function nextStep() {
    if (currentPage == 4) {
        // location.href = "/app/?lang=" + langprop
        $("#tutorial_desc_1").fadeOut("500")
        $("#tutorial_desc_2").fadeOut("500")
        $("#tutorial_desc_3").fadeOut("500")
        $("#tutorial_desc_4").fadeOut("500")
        $("#tutorial_panel_1").fadeOut("500")
        $("#tutorial_panel_2").fadeOut("500")
        $("#tutorial_panel_3").fadeOut("500")
        $("#tutorial_panel_4").fadeOut("500")
        setTimeout(function () {
            location.href = "/app/?lang=" + langprop
        }, 505)
    }
    if (currentPage < 4) {
        currentPage = currentPage + 1
        $("#tutorial_desc_1").fadeOut("500")
        $("#tutorial_desc_2").fadeOut("500")
        $("#tutorial_desc_3").fadeOut("500")
        $("#tutorial_desc_4").fadeOut("500")
        $("#tutorial_panel_1").fadeOut("500")
        $("#tutorial_panel_2").fadeOut("500")
        $("#tutorial_panel_3").fadeOut("500")
        $("#tutorial_panel_4").fadeOut("500")
        setTimeout(function () {
            $("#tutorial_desc_" + currentPage).fadeIn("500")
            $("#tutorial_panel_" + currentPage).fadeIn("500")
        }, 505)
    }
}