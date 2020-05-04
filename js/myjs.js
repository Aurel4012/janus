jQuery(document).ready(function() {
	console.log('script loaded!');
    // gestion burger si changement de menu
      jQuery("[data-trigger]").on("click", function(e){
          e.preventDefault();
          e.stopPropagation();
          console.log('burger click');
          var offcanvas_id =  jQuery(this).attr('data-trigger');
          jQuery(offcanvas_id).toggleClass("show");
          jQuery('body').toggleClass("offcanvas-active");
          jQuery(".screen-overlay").toggleClass("show");
      }); 
    // Gestion rdv
    jQuery('.call-rdv').on('click', function() {
      console.log('call rdv clicked');
      jQuery('#rdv_modal').modal('toggle')
    }); 
    jQuery('#radios-0').click(function() {
       if(jQuery('#radios-0').is(':checked')) {
        console.log('today');
        jQuery("#datetimepicker").remove();
       }
    });

    jQuery('#radios-1').click(function() {
       if(jQuery('#radios-1').is(':checked')) {
        jQuery("#datetimepicker").remove();
        console.log('other day');
        jQuery('.radio1').append( '<input id="datetimepicker" type="text" name="date_rdv" value="" autocomplete="off">' );
        jQuery.datetimepicker.setLocale('fr');
        jQuery('#datetimepicker').datetimepicker({
          
           
           allowTimes:[
             '09:00','09:30','10:00','10:30', '11:00','11:30', 
             '14:00','14:30', '15:00','15:30','16:00','16:30','17:00','17:30','18:00'
            ],
           timepicker:true,
           format:'d/m/Y H:i',
           minDate: new Date(),
           step: 30,

        });
    }
    });

    jQuery('#form_rdv').on('submit', function(e) {
             e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire
       
             var jQuerythis = jQuery(this); // L'objet jQuery du formulaire
       
            // Je récupère les valeurs
            var reponse = jQuery('#reponse').val();
            // verifier(prenom);
          // Je vérifie une première fois pour ne pas lancer la requête HTTP
            // si je sais que mon PHP renverra une erreur

            jQuery('#loading-image').bind('ajaxStart', function(){
                jQuery(this).show();
            }).bind('ajaxStop', function(){
                jQuery(this).hide();
            });
                // Envoi de la requête HTTP en mode asynchrone
                jQuery.ajax({
                    url: jQuerythis.attr('action'), // Le nom du fichier indiqué dans le formulaire
                    type: jQuerythis.attr('method'), // La méthode indiquée dans le formulaire (get ou post)
                    data: jQuerythis.serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
                      success: function(data) { // Je récupère la réponse du fichier PHP
                        console.log('Reponse: '+ data.reponse+'\n')
                        
                        var text = data.reponse;
                        var code = data.code;
                                           // J'affiche cette réponse
                                if(code == "1") { /// ici tout est ok
                                  jQuery('.modal-body').empty();
                                  jQuery('.modal-footer').empty(); 
                                  jQuery('.modal-footer').append('<button type="button" class="btn btn-secondary" data-dismiss="modal" id="cnl_rdv">Fermer</button>');
                                  jQuery('.modal-body').append('<div class="text-center"><i class="fa fa-check-circle fa-5x" style="color:#005a80;" aria-hidden="true"></i><h3>'+data.reponse+'</h3></div>');
                                     console.log('Reponse: '+ data.reponse+'\n');
                                      
                                }
                                          if(code== "2"){
                                           jQuery('.modal-body').empty();
                                           jQuery('.modal-footer').empty(); 
                                           jQuery('.modal-footer').append('<button type="button" class="btn btn-secondary" data-dismiss="modal" id="cnl_rdv">Fermer</button>');
                                           jQuery('.modal-body').append('<div class="text-center"><i class="fa fa-times-circle fa-5x" style="color:#a94442;" aria-hidden="true"></i><h3 class="text-danger">'+data.reponse+'</h3></div>');
                                           jQuery("#warning").html(data.reponse).show( "slow" ).delay(4000).fadeOut(600);
                                           jQuery(".info").removeClass("error");
                                          
                                           }
                                          

                      },//end success
                      error:function(err){
                        if (err.status===0){
                          console.log(err.status)
                          // window.location.href = "maintenance.html"; //redirige
                        }
                      
                      }
              });//end ajax
      });//end form
}); //end doc ready
