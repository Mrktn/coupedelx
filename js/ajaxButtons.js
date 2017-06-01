$(document).ready(function () {
    
    $('body').on('click', '.payeBouton', function () {
        var monbouton = $(this);
        var ecole = $(this).attr("ecole");
        var sport = $(this).attr("sport");

        $.get("index.php?page=index&todo=aPaye&ecole=" + ecole + "&sport=" + sport, function (data) {
            // 1 = success, 0 = failure
            if (data == 1 || data === '1' || data == '1')
            {
                $.notify({
                    message: "C'est bon, l'école a bien payé pour ce sport !"
                }, {
                    type: 'success'
                });

                monbouton.removeClass("payeBouton");
                monbouton.removeClass("btn-success");
                monbouton.addClass("unpayeBouton");
                monbouton.addClass("btn-danger");

                monbouton.text("Annuler le paiement");
                
                $("span[ecole="+ecole+"][sport="+sport+"].payeState").css('color', 'green');
                
                $("div[ecole="+ecole+"][sport="+sport+"].panel").removeClass("nonPaye");
                $("div[ecole="+ecole+"][sport="+sport+"].panel").addClass("paye");

            } else
            {
                $.notify({
                    message: "Il y a eu un problème : " + data
                }, {
                    type: 'danger'
                });
            }
        });
    });


    $('body').on('click', '.unpayeBouton', function () {
        var monbouton = $(this);
        var ecole = $(this).attr("ecole");
        var sport = $(this).attr("sport");

        $.get("index.php?page=index&todo=aUnpaye&ecole=" + ecole + "&sport=" + sport, function (data) {
            // 1 = success, 0 = failure
            if (data == 1 || data === '1' || data == '1')
            {
                $.notify({
                    message: "C'est bon, le paiement a bien été annulé !"
                }, {
                    type: 'success'
                });

                monbouton.removeClass("unpayeBouton");
                monbouton.removeClass("btn-danger");
                monbouton.addClass("payeBouton");
                monbouton.addClass("btn-success");

                monbouton.text("Confirmer le paiement");
                
                $("span[ecole="+ecole+"][sport="+sport+"].payeState").css('color', 'red');
                
                $("div[ecole="+ecole+"][sport="+sport+"].panel").removeClass("paye");
                $("div[ecole="+ecole+"][sport="+sport+"].panel").addClass("nonPaye");

            } else
            {
                $.notify({
                    message: "Il y a eu un problème : " + data
                }, {
                    type: 'danger'
                });
            }
        });
    });
});