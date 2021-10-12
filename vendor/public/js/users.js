$(document).ready(function()
{
   // alert("ok");
      
$('#users').DataTable({
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
            'bSortable': false, 'aTargets': [ 5,6 ]
          }
       ]
    }
    );
      
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
      
      
      
      //quand on affiche le modal de mise à jour de l'utilisateur, je précomplète les champs
      $('#squarespaceModalupdateuser').on('shown.bs.modal', function(event)
      {
    
        var id = event.relatedTarget.id;
        //alert(id);
          //Permet d'ajouter les inforamtions de l'array js dans les inputs text pour mettre à jour un prestataire
          
          $('#exampleInputNom').val(ar[id].nom);
          $('#exampleInputLogin').val(ar[id].login);
          $('#exampleInputPrenom').val(ar[id].prenom);
          $('#exampleInputPassword').val(ar[id].password);
          $('#exampleInputActif').val(ar[id].actif);
          $('#exampleInputType_user').val(ar[id].type_user);
          $('#exampleInputIdCache').val(ar[id].id);
          
      
   });
      
      
      var table = $('#users').DataTable();
      
      $('#users tbody').on( 'click', '[class^="delete_user"]', function ()
      {
         var ok = confirm("Voulez-vous vraiment supprimer définitivement cet utilisateur ?");
            if(ok)
            {
                  //je supprime la row du dataTable avant de passer à ajax et donc de supprimer en bd
                  table
                  .row( $(this).parents('tr') )
                  .remove()
                  .draw();
                  var id_to_delete = this.id;
                  
                  
                  //alert(id_to_delete);
                               
                  $.ajax
                  (
                      {
                          method : 'POST',
                          //la route (controleur) et le paramètre (id à supprimer)
                          url: url + "/users/deleteUsers/"+id_to_delete,
                          dataType: 'text',
                          
                          error:function(erreur)
                          {
                              alert("Erreur dans le fichier professionnels.js");
                          }
                      
                      }
                  );      
            }   
         
      } );
      
      
      
      
      //                                                    *** Mise à jour D'UN utilsiateur ***
      
        
        $('#form_update_user').submit(function(ev)
        {
            ev.preventDefault(); // to stop the form from submitting
            
            
            
            var id_user = $('#exampleInputIdCache').val();
            //alert($("#form_update_pro").serialize());
            //return false;
            $.ajax
                      (
                          {
                              method : 'POST',
                              //la route (controleur) et le paramètre (id à supprimer)
                              url: url + "/users/updateUser/"+id_user,
                              dataType: 'html',
                              data:{
                                  data_form_user : $("#form_update_user").serialize(),
                                  action : 'maj'
                              },
                              success:function(result)
                              {
                                  
                                  
                                  $("#result_insert_user").show(); //DD: il faut le laisser autrement, il n'appraît plus quand on met à jour un second prestataire...
                                  $("#result_insert_user").html(result);
                                  $("#result_insert_user").fadeOut(3000);
                                  
                                  
                                  
                                  table
                           .row( $(this).parents('tr') )
                           .invalidate()
                           .draw();
                     
                                  
                                  
                                  
                              }
                          
                          }
                      );
              
      });
      //  
      //  //******* Ajout d'un user ***********
        $('#form_insert_user').submit(function(ev)
        {
            ev.preventDefault(); // to stop the form from submitting
            
            
            //alert($("#form_insert_user").serialize());
            //return false;
            $.ajax
                      (
                          {
                              method : 'POST',
                              //la route (controleur) et le paramètre (id à supprimer)
                              url: url + "/users/addUser/",
                              dataType: 'html',
                              data:{
                                  data_form_insert_user : $("#form_insert_user").serialize(),
                                  action : 'add'
                              },
                              success:function(result)
                              {
                                  //alert(result);
                                  
                                  $("#result_insert").show(); //DD: il faut le laisser autrement, il n'appraît plus quand on met à jour un second prestataire...
                                  $("#result_insert").html(result);
                                  $("#result_insert").fadeOut(3000);
                                  location.reload(); 
                                  
                                  
                              }
                          
                          }
                      );
              
      });
      //  
      //  
      ////permet de rafraichier la page quand on ferme le modal bootstrap
      //  $('#squarespaceModalinsertpro').on('hidden.bs.modal', function ()
      //  {
      //      location.reload();
      //   });
      //  
      //  //permet de rafraichier la page quand on ferme le modal bootstrap
      //  $('#squarespaceModal').on('hidden.bs.modal', function ()
      //  {
      //      location.reload();
      //   });
      //
      //  

    //                                                    *** AJOUT D'UNE CATEGORIE ***
      
      //quand on clic sur un élemnt dont la classe commence par supprimer_categorie
      //$('body').on('click', '#add_categorie', function ()
      //{
      //      
      //      var ajout = prompt("Veuillez indiquer le nom de la catégorie que vous souhaitez ajouter");
      //      if(ajout.length > 1)
      //      {                               
      //            $.ajax
      //            (
      //                {
      //                    method : 'POST',
      //                    //la route (controleur) et le paramètre (id à supprimer)
      //                    url: url + "/categories/addCategorie",
      //                    dataType: 'html',
      //                    data :{
      //                        'nom_categorie': ajout
      //                    },
      //                    success:function(result)
      //                    {
      //                        $('#tab_categories').html(result);
      //                        //alert(JSON.stringify(result));
      //                        //[{"id":"17","nom_categorie":"a\r\n"},{"id":"18","nom_categorie":"b"},{"id":"19","nom_categorie":"c"}]
      //                        
      //                    }
      //                
      //                }
      //            );      
      //      }
      //      
      //  });
      
      
    
    
});
    
    
    
        

