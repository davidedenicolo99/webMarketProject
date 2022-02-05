/**
 * Quando clicco sulla X della notifica, mando una richiesta POST che 
 * a notifiche.php che fa eliminare SOLO quella notifica dal db.
 */
$(document).ready(function () {
    
    $(".delete").click(function (e) { 
            
            let idnotifica = this.id;
            $.ajax({
                url: 'notifiche.php',
                type: 'post',
                data: { "delete": idnotifica},
             });
        });
});