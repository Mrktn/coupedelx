$(document).ready(function () {

    $(".boutonNonPaye").click(function () {

        // If we're releasing the button
        if ($(".boutonNonPaye").hasClass("active"))
        {
            $(".boutonNonPaye").removeClass("active");
            $(".paye").show();

            // If the other is currently not pressed
            if (!$(".boutonNonValide").hasClass("active"))
            {
                $(".boutonTout").addClass("active");
            } else
            {
                $(".boutonTout").removeClass("active");
                $(".valide").hide();
            }
            
            
        }

        // We're pressing the button
        else
        {
            $(".boutonNonPaye").addClass("active");
            $(".boutonTout").removeClass("active");
            
            $(".paye").hide();
        }
    });

    $(".boutonNonValide").click(function () {
        // If we're releasing the button
        if ($(".boutonNonValide").hasClass("active"))
        {
            $(".valide").show();
            $(".boutonNonValide").removeClass("active");

            // If the other is currently not pressed
            if (!$(".boutonNonPaye").hasClass("active"))
            {
                $(".boutonTout").addClass("active");
            } else
            {
                $(".boutonTout").removeClass("active");
                $(".paye").hide();
            }
        }

        // We're pressing the button
        else
        {
            $(".boutonNonValide").addClass("active");
            $(".boutonTout").removeClass("active");
            
            $(".valide").hide();
        }
    });

    $(".boutonTout").click(function () {
        $(".boutonNonValide").removeClass("active");
        $(".boutonNonPaye").removeClass("active");


        $(".valide").show();
        $(".paye").show();
    });

});