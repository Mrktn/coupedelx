$(document).ready(function () {

    $(".boutonNonPaye").click(function () {
        $(".boutonTout").removeClass("active");
        $(".boutonNonPaye").addClass("active");

        if ($(".boutonNonValide").hasClass("active")) {
            $(".nonValide.nonPaye").show();
        }
        $(".paye").hide();
    });

    $(".boutonNonValide").click(function () {
        $(".boutonTout").removeClass("active");
        $(".boutonNonValide").addClass("active");

        if ($(".boutonNonPaye").hasClass("active")) {
            $(".nonValide.nonPaye").show();
        }
        $(".valide").hide();
    });

    $(".boutonTout").click(function () {
        $(".boutonNonValide").removeClass("active");
        $(".boutonNonPaye").removeClass("active");


        $(".valide").show();
        $(".paye").show();
    });

});