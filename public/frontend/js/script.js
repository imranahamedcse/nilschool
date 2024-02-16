$("[data-background]").each(function () {
    $(this).css("background-image", "url(" + $(this).attr("data-background") + ")");
});

var currentUrl = window.location.pathname;
if (currentUrl == '/') {
    $(".navbar").addClass("color_navbar");
} else {
    $(".navbar").addClass("white_navbar");
}

$(document).ready(function () {
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll > 300) {
            $(".navbar").addClass("fixed-top");
            $(".navbar").removeAttr("data-bs-theme");
            $(".navbar").addClass("white_navbar");
            $(".navbar").removeClass("color_navbar");
        }

        else {
            $(".navbar").removeClass("fixed-top");
            $(".navbar").attr("data-bs-theme", "dark");
            $(".navbar").removeClass("white_navbar");
            if (currentUrl == '/') {
                $(".navbar").addClass("color_navbar");
            } else {
                $(".navbar").addClass("white_navbar");
            }
        }
    })
})
