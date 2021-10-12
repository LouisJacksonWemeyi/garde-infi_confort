$(document).ready(function()
{
      
      $('#categories').DataTable({
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
        },
        
            "aoColumnDefs": [ //permet de ne pas trier par rapport à Editer et supprimer
          {
            'bSortable': false, 'aTargets': [ 1 ]
          }
       ]
      }
    }
    );
      
      //                                                    *** SUPPRESSION D'UNE CATEGORIE ***
      var table = $('#categories').DataTable();
      //quand on clic sur un élemnt dont la classe commence par supprimer_categorie
      $('body').on('click', '[class^="supprimer_categorie"]', function ()
      {
            
            var ok = confirm("Voulez-vous vraiment supprimer cette catégoire ?");
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
                               
                  $.ajax
                  (
                      {
                          method : 'POST',
                          //la route (controleur) et le paramètre (id à supprimer)
                          url: url + "/categories/deleteCategorie/"+id_to_delete,
                          dataType: 'html',
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
      
      //                                                    *** MAJ D'UNE CATEGORIE ***
      
      //quand on clic sur un élemnt dont la classe commence par supprimer_categorie
      $('body').on('click', '[class^="maj_categorie"]', function ()
      {
            
            var modification = prompt("Veuillez indiquer le nom de la catégorie");
            if(modification.length > 1)
            {
                  var nomdelaclasse = this.className;
                  //alert(nomdelaclasse);
                  var elements = nomdelaclasse.split('#');
                  var id_to_update = elements[1];
                               
                  $.ajax
                  (
                      {
                          method : 'POST',
                          //la route (controleur) et le paramètre (id à supprimer)
                          url: url + "/categories/updateCategorie",
                          dataType: 'html',
                          data :{
                              'nom_categorie': modification,
                              'id_categorie' : id_to_update
                          },
                          success:function(result)
                          {
                              //alert(result);
                              $('#tab_categories').html(result);
                              //alert(JSON.stringify(result));
                              //[{"id":"17","nom_categorie":"a\r\n"},{"id":"18","nom_categorie":"b"},{"id":"19","nom_categorie":"c"}]
                              
                          }
                      
                      }
                  );      
            }
            
        });
      
      $('#form_update_categorie').submit(function(ev)
        {
            ev.preventDefault(); // to stop the form from submitting
            
            
            var id_user = $('#exampleInputIdCacheCat').val();
            //alert(id_user);
            //alert($("#form_update_pro").serialize());
            //return false;
            $.ajax
                      (
                          {
                              method : 'POST',
                              //la route (controleur) et le paramètre (id à supprimer)
                              url: url + "/categories/updateCategorie/"+id_user,
                              dataType: 'html',
                              data:{
                                  data_form_cat : $("#form_update_categorie").serialize(),
                                  action : 'maj'
                              },
                              success:function(result)
                              {
                                  //alert(result);
                                  //$("#result_update_cat").show(); //DD: il faut le laisser autrement, il n'appraît plus quand on met à jour un second prestataire...
                                  //$("#result_update_cat").html(result);
                                  //$("#result_update_cat").fadeOut(3000);
                                  
                                  $('#tbody_categories').html(result);
                                  
                                  
                                  
                           //       table
                           //.row( $(this).parents('tr') )
                           //.invalidate()
                           //.draw();
                     
                                  
                                  
                                  
                              }
                          
                          }
                      );
              
      });
      
      //permet de rafraichier la page quand on ferme le modal bootstrap
        $('#squarespaceModalupdatecategorie').on('hidden.bs.modal', function ()
        {
            //location.reload();
         });
      
      //quand on affiche le modal de mise à jour des catégories, je précomplète les champs
      $('#squarespaceModalupdatecategorie').on('shown.bs.modal', function(event)
      {
    
        var id = event.relatedTarget.id;
        //alert(id);
          //Permet d'ajouter les inforamtions de l'array js dans les inputs text pour mettre à jour un prestataire
          
          
          $('#exampleInputNomCategorie').val(ar[id].nom_categorie);
          $('#exampleInputIdCacheCat').val(ar[id].id);
          //$('#exampleInputIdCache').val(ar[id].id);
          
      
   });
        

    //                                                    *** AJOUT D'UNE CATEGORIE ***
    
    
    
        $('#form_insert_cat').submit(function(ev)
        {
            
            ev.preventDefault(); // to stop the form from submitting
            
            
            
            //alert($("#form_insert_pro").serialize());
            //return false;
            $.ajax
                  (
                      {
                          method : 'POST',
                          //la route (controleur) et le paramètre (id à supprimer)
                          url: url + "/categories/addCategorie",
                          dataType: 'html',
                          data :{
                                    data_form_insert_cat : $("#form_insert_cat").serialize(),
                                    action : 'add'
                          },
                          success:function(result)
                          {
                              
                              $("#result_add_cat").show(); //DD: il faut le laisser autrement, il n'appraît plus quand on met à jour un second prestataire...
                              $("#result_add_cat").html(result);
                              $("#result_add_cat").fadeOut(3000);
                              $('#result_add_cat').html(result);
                              //location.reload(); 
                              
                              //alert(JSON.stringify(result));
                              //[{"id":"17","nom_categorie":"a\r\n"},{"id":"18","nom_categorie":"b"},{"id":"19","nom_categorie":"c"}]
                              
                          }
                      
                      }
                  );
              
      });
        
        //permet de rafraichier la page quand on ferme le modal bootstrap
        $('#squarespaceModalinsertcategorie').on('hidden.bs.modal', function ()
        {
            location.reload();
         });
      
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
    
    
    
        

