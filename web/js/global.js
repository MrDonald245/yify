function resetForm() {
    document.getElementById("keywords").value = "";
    document.getElementById("quality").value = "720p";
    document.getElementById("genres").value = "All";
    document.getElementById("rating").value = "0";
    document.getElementById("orderby").value = "latest";
    document.getElementById("limit").value = "20";
}

!function (a, b, c, d) {
    "use strict";
    a(function () {
        a("#mobileMenu").hide(), a(".toggleMobile").click(function () {
            a(this).toggleClass("active"), a("#mobileMenu").slideToggle(500)
        })
    }), a(b).on("resize", function () {
        a(this).width() > 500 && (a("#mobileMenu")
            .hide(), a(".toggleMobile").removeClass("active"))
    })
}(jQuery, window, document), $(document).ready(function () {
    $("a[href='.gotop']").click(function () {
        return $("html, body").animate({scrollTop: 0}, "slow"), !1
    })
});