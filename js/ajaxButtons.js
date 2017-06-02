$(document).ready(function () {
    
    $('body').on('click', '.payeBouton', function () {
        var monbouton = $(this);
        var ecole = $(this).attr("ecole");
        var sport = $(this).attr("sport");

        $.get("index.php?page=index&todo=payer&ecole=" + ecole + "&sport=" + sport, function (data) {
            // 1 = success, 0 = failure
            if (data == 1 || data === '1' || data == '1')
            {
                /*$.notify({
                    message: "C'est bon, l'école a bien payé pour ce sport !"
                }, {
                    type: 'success'
                });*/

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

        $.get("index.php?page=index&todo=unPayer&ecole=" + ecole + "&sport=" + sport, function (data) {
            // 1 = success, 0 = failure
            if (data == 1 || data === '1' || data == '1')
            {
                /*$.notify({
                    message: "C'est bon, le paiement a bien été annulé !"
                }, {
                    type: 'success'
                });*/

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
    
    
    
    $('body').on('click', '.valideBouton', function () {
        var monbouton = $(this);
        var ecole = $(this).attr("ecole");
        var sport = $(this).attr("sport");

        $.get("index.php?page=index&todo=valider&ecole=" + ecole + "&sport=" + sport, function (data) {
            // 1 = success, 0 = failure
            if (data == 1 || data === '1' || data == '1')
            {
                /*$.notify({
                    message: "La participation est validée !"
                }, {
                    type: 'success'
                });*/

                monbouton.removeClass("valideBouton");
                monbouton.removeClass("btn-success");
                monbouton.addClass("unvalideBouton");
                monbouton.addClass("btn-danger");

                monbouton.text("Invalider l'inscription");
                
                $("span[ecole="+ecole+"][sport="+sport+"].valideState").css('color', 'green');
                $("span[ecole="+ecole+"][sport="+sport+"].valideState").removeClass("glyphicon-remove");
                $("span[ecole="+ecole+"][sport="+sport+"].valideState").addClass("glyphicon-ok");
                
                $("div[ecole="+ecole+"][sport="+sport+"].panel").removeClass("nonValide");
                $("div[ecole="+ecole+"][sport="+sport+"].panel").addClass("valide");

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
    
    
    
    
    
    $('body').on('click', '.unvalideBouton', function () {
        var monbouton = $(this);
        var ecole = $(this).attr("ecole");
        var sport = $(this).attr("sport");

        $.get("index.php?page=index&todo=unValider&ecole=" + ecole + "&sport=" + sport, function (data) {
            // 1 = success, 0 = failure
            if (data == 1 || data === '1' || data == '1')
            {
                /*$.notify({
                    message: "La participation a bien été invalidée !"
                }, {
                    type: 'success'
                });*/

                monbouton.removeClass("unvalideBouton");
                monbouton.removeClass("btn-danger");
                monbouton.addClass("valideBouton");
                monbouton.addClass("btn-success");

                monbouton.text("Valider l'inscription");
                
                $("span[ecole="+ecole+"][sport="+sport+"].valideState").css('color', 'red');
                $("span[ecole="+ecole+"][sport="+sport+"].valideState").removeClass("glyphicon-ok");
                $("span[ecole="+ecole+"][sport="+sport+"].valideState").addClass("glyphicon-remove");
                
                $("div[ecole="+ecole+"][sport="+sport+"].panel").removeClass("valide");
                $("div[ecole="+ecole+"][sport="+sport+"].panel").addClass("nonValide");

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