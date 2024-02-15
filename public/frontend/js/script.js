$("[data-background]").each(function () {
    $(this).css("background-image", "url(" + $(this).attr("data-background") + ")");
});

$(document).ready(function () {
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll > 300) {
            $(".navbar").addClass("fixed-top");
            $(".navbar").addClass("white_navbar");
            $(".navbar").removeClass("color_navbar");
            $(".navbar").removeAttr("data-bs-theme");
        }

        else {
            $(".navbar").removeClass("fixed-top");
            $(".navbar").removeClass("white_navbar");
            $(".navbar").addClass("color_navbar");
            $(".navbar").attr("data-bs-theme", "dark");
        }
    })
})
