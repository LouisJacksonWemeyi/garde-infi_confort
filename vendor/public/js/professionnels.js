$(document).ready(function()
{
    
    $('#example').DataTable({
      "language": {
        "sProcessing": "Traitement en cours ...",
        "sLengthMenu": "Afficher _MENU_ lignes",
        "sZeroRecords": "Aucun résultat trouvé",
        "sEmptyTable": "Aucune donnée disponible",
        "sInfo": "Lignes _START_ à _END_ sur _TOTAL_",
        "sInfoEmpty": "Aucune ligne affichée",
        "sInfoFiltered": "(Filtrer un maximum de_MAX_)",
        "sInfoPostFix": "",
        "sSearch": "Chercher:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Chargement...",
        "oPaginate": {
          "sFirst": "Premier", "sLast": "Dernier", "sNext": "Suivant", "sPrevious": "Précédent"
        },
        "oAria": {
          "sSortAscending": ": Trier par ordre croissant", "sSortDescending": ": Trier par ordre décroissant"
        }
      },
      "aoColumnDefs": [ //permet de ne pas trier par rapport à Editer et supprimer
          {
            'bSortable': false, 'aTargets': [ 7, 8 ]
          }
       ]
    });


      

      
      $('body').on('keyup', '[class^="filtre"]', function ()
      {
            var formulaire = $("#form_filtre").serialize(); 
            
            
                         
            $.ajax
            (
                {
                    method : 'POST',
                    //la route (controleur) et le paramètre (id à supprimer)
                    url: url + "/professionnels/filtreProfessionnels",
                    dataType: 'html',
                    data:{
                        filtre : formulaire
                    },
                    success:function(result)
                    {
                        
                        //alert(result);
                  
                        $('#tab_pro').html(result);
                        //alert(JSON.stringify(result));
                        //[{"id":"17","nom_categorie":"a\r\n"},{"id":"18","nom_categorie":"b"},{"id":"19","nom_categorie":"c"}]
                        
                    }
                
                }
            );      
        });
      
      
      
      //quand on affiche le modal de mise à jour
      $('#squarespaceModal').on('shown.bs.modal', function(event)
      {
    
        var id = event.relatedTarget.id;
        //alert(id);
          //Permet d'ajouter les inforamtions de l'array js dans les inputs text pour mettre à jour un prestataire
          $('#nom_description').html(ar[id].prenom + ' ' + ar[id].nom);
          $('#exampleInputNom').val(ar[id].nom);
          $('#exampleInputPrenom').val(ar[id].prenom);
          $('#exampleInputAdresse').val(ar[id].adresse);
          $('#exampleInputNumero').val(ar[id].numero);
          $('#exampleInputBoite').val(ar[id].boite);
          $('#exampleInputCP').val(ar[id].cp);
          $('#exampleInputVille').val(ar[id].ville);
          $('#exampleInputEmail').val(ar[id].mail);
          $('#exampleInputTelephone').val(ar[id].telephone);
          $('#exampleInputInami').val(ar[id].inami);
          $('#exampleInputTVA').val(ar[id].tva);
          $('#exampleInputDisponibilite').val(ar[id].disponibilite);
          $('#exampleInputCommentaire').val(ar[id].commentaire);
          $('#exampleInputIdCache').val(ar[id].id);
      
   });
      
      
      var table = $('#example').DataTable();
      
      $('#example tbody').on( 'click', '[class^="supprimer_pro"]', function ()
      {
         var ok = confirm("Voulez-vous vraiment supprimer ce prestataire ?");
            if(ok)
            {
                  //je supprime la row du dataTable avant de passer à ajax et donc de supprimer en bd
                  table
                  .row( $(this).parents('tr') )
                  .remove()
                  .draw();
                  var nomdelaclasse = this.className;
                  //alert(nomdelaclasse);
                  var elements = nomdelaclasse.split('#');
                  var id_to_delete = elements[1];
                  //alert(id_to_delete);
                               
                  $.ajax
                  (
                      {
                          method : 'POST',
                          //la route (controleur) et le paramètre (id à supprimer)
                          url: url + "/professionnels/deleteProfessionnels/"+id_to_delete,
                          dataType: 'json',
                          
                          error:function(erreur)
                          {
                              alert("Erreur dans le fichier professionnels.js");
                          }
                      
                      }
                  );      
            }   
         
      } );
      
      
      
      
      //                                                    *** Mise à jour D'UN pro ***
      
        
        $('#form_update_pro').submit(function(ev)
        {
            ev.preventDefault(); // to stop the form from submitting
            
            
            
            var id_pro = $('#exampleInputIdCache').val();
            //alert($("#form_update_pro").serialize());
            //return false;
            $.ajax
                      (
                          {
                              method : 'POST',
                              //la route (controleur) et le paramètre (id à supprimer)
                              url: url + "/professionnels/updateProfessionnel/"+id_pro,
                              dataType: 'html',
                              data:{
                                  data_form_pro : $("#form_update_pro").serialize(),
                                  action : 'maj'
                              },
                              success:function(result)
                              {
                                  
                                  
                                  $("#result").show(); //DD: il faut le laisser autrement, il n'appraît plus quand on met à jour un second prestataire...
                                  $("#result").html(result);
                                  $("#result").fadeOut(3000);
                                  
                                  
                                  
                                  table
                           .row( $(this).parents('tr') )
                           .invalidate()
                           .draw();
                     
                                  
                                  
                                  
                              }
                          
                          }
                      );
              
      });
        
        //******* Ajout d'un pro ***********
        $('#form_insert_pro').submit(function(ev)
        {
            ev.preventDefault(); // to stop the form from submitting
            
            
            //alert($("#form_insert_pro").serialize());
            //return false;
            $.ajax
                      (
                          {
                              method : 'POST',
                              //la route (controleur) et le paramètre (id à supprimer)
                              url: url + "/professionnels/addProfessionnel/",
                              dataType: 'html',
                              data:{
                                  data_form_insert_pro : $("#form_insert_pro").serialize(),
                                  action : 'add'
                              },
                              success:function(result)
                              {
                                  
                                  
                                  $("#result_insert").show(); //DD: il faut le laisser autrement, il n'appraît plus quand on met à jour un second prestataire...
                                  $("#result_insert").html(result);
                                  $("#result_insert").fadeOut(3000);
                                  location.reload(); 
                                  
                                  
                              }
                          
                          }
                      );
              
      });
        
        
      //permet de rafraichier la page quand on ferme le modal bootstrap
        $('#squarespaceModalinsertpro').on('hidden.bs.modal', function ()
        {
            location.reload();
         });
        
        //permet de rafraichier la page quand on ferme le modal bootstrap
        $('#squarespaceModal').on('hidden.bs.modal', function ()
        {
            location.reload();
         });
      
        

    //                                                    *** AJOUT D'UNE CATEGORIE ***
      
      //quand on clic sur un élemnt dont la classe commence par supprimer_categorie
      $('body').on('click', '#add_categorie', function ()
      {
            
            var ajout = prompt("Veuillez indiquer le nom de la catégorie que vous souhaitez ajouter");
            if(ajout.length > 1)
            {                               
                  $.ajax
                  (
                      {
                          method : 'POST',
                          //la route (controleur) et le paramètre (id à supprimer)
                          url: url + "/categories/addCategorie",
                          dataType: 'html',
                          data :{
                              'nom_categorie': ajout
                          },
                          success:function(result)
                          {
                              $('#tab_categories').html(result);
                              //alert(JSON.stringify(result));
                              //[{"id":"17","nom_categorie":"a\r\n"},{"id":"18","nom_categorie":"b"},{"id":"19","nom_categorie":"c"}]
                              
                          }
                      
                      }
                  );      
            }
            
        });
      
      
    
    
});
    
    
    
        

