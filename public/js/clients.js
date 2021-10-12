$(document).ready(function() {
  // Client comme 'actif'
  $('#navCli').addClass('active');
  $('#navPro').removeClass('active');
  $('#navCat').removeClass('active');
  $('#navUser').removeClass('active');
  $('#navExl').removeClass('active');

  var currentClient = {};
  var admin = $.get(url + '/users/isAdmin', '', function(res) {
    admin = res;
  });
  // affichage du Json par jackson
  $.ajax({
    url: url + '/clients/getClientsJson',
    cache: false,
    success: function(result) {
      //pass data to datatable
      console.log(result); // just to see I'm getting the correct data.
    }
  });
  // traitement du multiselectMenu par jackson modif
  $('#multiselectmenu').change(function() {
    var str = '';
    $('#multiselectmenu option:selected').each(function() {
      //str += $( this ).text() + ",";
      str += $(this).val() + ' ';
    });
    $("input[type='search']").val(str);
    /* $('#test_filter input').unbind();
    $("input[type='search']").keyup( function (e) {
        if (e.keyCode == 13) {
            oTable.fnFilter(str);
        }
    } ); */
    $("input[type='search']").trigger('keyup');

    // $("input[type=search].form-control").keypress();
    // $("#input[type=search].form-control").keypress();
    /*  var e = $.Event( "keypress", { keyCode: str });
    $("input[type=search].form-control" ).trigger(e); */
    //alert(str);
  });

  // traitement du multiselectMenu
  /*$( "select" ).on('change',function () {
            //alert(this.id);
        // var agrement_id = this.id;
        var str = "";
        $( "select option:selected" ).each(function() {
          str += $( this ).text() + "#";	  
        });
        // alert($(this).is(':selected')); 
        alert($(this+"option").is("selected"));
       $.ajax({
              url:'/getagrement_users',
              type:'post',
              headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
              data: {
                          agrement_id : this.id,
                        users_agrement_selected : str
                    },
            //   dataType: 'text'
              success:function(data){
                alert(data.agrement_users_name+" ok !!!!");
                 $( "#divv" ).html( data.agrement_users_name);
                 $("#agrement_users_"+agrement_id).html(data.agrement_users_name);
              },
              error:function()
              {
                  alert("pas ok !!!!");
              }
        }); 
    
        $( "#div" ).text( str + this.id );
        // alert(str);
      });
    });  */

  /**
   * Initialisation du DataTable
   */

  $('#dataTable_clients').DataTable({
    // Source ajax
    ajax: url + '/clients/getClientsJson ',
    order: [[2, 'asc']],
    responsive: true,
    columns: [
      {
        // Responsive control column
        data: null,
        defaultContent: '',
        className: 'control',
        orderable: false,
        width: '1%'
      },
      {
        data: null,
        orderable: false,
        className: 'text-center favTxt',
        render: function(data, type, row, meta) {
          return (
            '<span id="' +
            row.id +
            '_spanFav">' +
            row.favori +
            '</span> <i id="' +
            row.id +
            '_star" class="favStar' +
            row.favori +
            ' fa fa-star favCli"></i>'
          );
        }
      },
      { data: 'nom' },
      { data: 'prenom' },
      {
        data: null,
        render: function(data, type, row, meta) {
          // data et row contiennent l'objet client
          return row.adresse + ' ' + row.numero + '/' + row.boite;
        }
      },
      {
        data: 'cp'
      },
      { data: 'ville' },
      {
        data: 'servicesClient',
        render: '[, ].nom'
      },
      { data: 'mail' },
      { data: 'telephone' },
      {
        data: 'commentaire',
        className: 'none'
      },
      {
        data: null,
        orderable: false,
        className: 'none',
        // meta.row = numéro de la ligne, data = objet client
        render: function(data, type, row, meta) {
          // Si admin
          if (admin === '1' && !MOBILE) {
            return (
              '<div class="btn-group">' +
              '<a class="btn btn-default" href="#" data-toggle="modal" data-target="#modal_maj_contacts" data-row="' +
              meta.row +
              '" data-client="' +
              data.id +
              '">' +
              '<i class="fa fa-fw fa-address-book-o"></i> Contacts' +
              '</a>' +
              '<a class="btn btn-default" data-toggle="modal" href="#" data-target="#squarespaceModalUpdateClient" data-row="' +
              meta.row +
              '" data-client="' +
              data.id +
              '">' +
              '<i class="fa fa-fw fa-edit"></i> Editer' +
              '</a>' +
              '<a class="btn btn-default supprimer_client" data-id="' +
              data.id +
              '" href="#">' +
              '<i class="fa fa-fw fa-trash-o text-danger"></i> Supprimer' +
              '</a>' +
              '</div>'
            );
          } else {
            return (
              '<a class="btn btn-default" href="#" data-toggle="modal" data-target="#modal_maj_contacts" data-row="' +
              meta.row +
              '" data-client="' +
              data.id +
              '">' +
              '<i class="fa fa-fw fa-address-book-o"></i> Contacts' +
              '</a>'
            );
          }
        }
      }
    ],
    language: {
      sProcessing: 'Traitement en cours ...',
      sLengthMenu: 'Afficher _MENU_ lignes',
      sZeroRecords: 'Aucun résultat trouvé',
      sEmptyTable: 'Aucune donnée disponible',
      sInfo: 'Lignes _START_ à _END_ sur _TOTAL_',
      sInfoEmpty: 'Aucune ligne affichée',
      sInfoFiltered: '(Filtrer un maximum de_MAX_)',
      sInfoPostFix: '',
      sSearch: 'Chercher:',
      sUrl: '',
      sInfoThousands: ',',
      sLoadingRecords: 'Chargement...',
      oPaginate: {
        sFirst: 'Premier',
        sLast: 'Dernier',
        sNext: 'Suivant',
        sPrevious: 'Précédent'
      },
      oAria: {
        sSortAscending: ': Trier par ordre croissant',
        sSortDescending: ': Trier par ordre décroissant'
      }
    }

    //I find it useful tho' to setup the headers this way.
  });

  var table = $('#dataTable_clients').DataTable();
  // Change le nombre de résultats trouvés lors d'un filtre
  table.on('draw.dt', function() {
    changeNbResult();
  });

  /**
   * MAJ CLIENT : envoi du form
   */
  $('#form_update_client').submit(function(ev) {
    ev.preventDefault(); // to stop the form from submitting

    var id_client = $('#InputIdCacheClient').val();
    //alert($("#form_update_pro").serialize());
    //return false;
    $.ajax({
      method: 'POST',
      //la route (controleur) et le paramètre (id à supprimer)
      url: url + '/clients/updateClient/' + id_client,
      dataType: 'html',
      data: {
        data_form_client: $('#form_update_client').serialize(),
        action: 'maj'
      },
      success: function(result) {
        //alert(result);
        $('#result').show(); //DD: il faut le laisser autrement, il n'appraît plus quand on met à jour un second prestataire...
        $('#result').html(result);
        $('#result').fadeOut(3000);

        reloadTable();
        $('#squarespaceModalUpdateClient').modal('hide');
      }
    });
  });

  /**
   * MAJ CLIENT : modal
   *   quand on affiche le modal de mise à jour
   *   tim: meilleur affichage en utilisant 'show' plutôt que 'shown' comme event --> fired dès le clic
   *   @link https://getbootstrap.com/docs/3.3/javascript/#modals-events
   */

  $('#squarespaceModalUpdateClient').on('show.bs.modal', function(event) {
    var id = $(event.relatedTarget).data('client');

    currentClient = findClient(id);

    //Permet d'ajouter les informations du client dans les inputs text pour mettre à jour un client
    $('#nom_description_client').html(
      currentClient.prenom + ' ' + currentClient.nom
    );
    $('#InputNomClient').val(currentClient.nom);
    $('#InputPrenomClient').val(currentClient.prenom);

    $('#InputAdresseClient').val(currentClient.adresse);
    $('#InputNumeroClient').val(currentClient.numero);
    $('#InputBoiteClient').val(currentClient.boite);
    $('#InputCPClient').val(currentClient.cp);
    $('#InputVilleClient')
      .html('')
      .val(currentClient.ville);
    var villes = getVilles(currentClient.cp).then(function(vil) {
      villes = JSON.parse(vil);
      for (var i = 0; i < villes.length; i++) {
        $('#InputVilleClient').append(
          '<option value="' +
            villes[i].nom +
            '"' +
            (villes[i].nom == currentClient.ville ? ' selected' : '') +
            '>' +
            villes[i].nom +
            '</option>'
        );
      }
    });
    $('#InputEmailClient').val(currentClient.mail);
    $('#InputTelephoneClient').val(currentClient.telephone);

    $('#InputCommentaireClient').val(currentClient.commentaire);
    $('#InputIdCacheClient').val(currentClient.id);

    // Boucle sur les checkboxes des services
    // sélection si fait partie des services actifs du client
    $('[id^="edit_service_"]').each(function(idx) {
      $(this).prop('checked', currentClient.services[idx].actif ? true : false);
    });
  });

  /**
   * AJOUT D'UN NOUVEAU CLIENT
   */
  $('#form_insert_client').submit(function(ev) {
    ev.preventDefault(); // to stop the form from submitting
    var form = $(this);
    // Validation
    if (
      $('#exampleInputNom').val() == '' ||
      $('#exampleInputPrenom').val() == ''
    ) {
      $('#result_insert').text(
        'Veuillez renseigner au moins un nom' + ' et un prénom'
      );
      return false;
    }
    // Envoi en db
    $.ajax({
      method: 'POST',
      //la route (controleur) et le paramètre (id à supprimer)
      url: url + '/clients/addClient/',
      dataType: 'html',
      async: false,
      data: {
        data_form_insert_client: $('#form_insert_client').serialize(),
        action: 'add'
      },
      success: function(result) {
        $('#result_insert').show(); //DD: il faut le laisser autrement, il n'appraît plus quand on met à jour un second prestataire...
        $('#result_insert')
          .html(result)
          .fadeOut(3000);
        form.trigger('reset');
        $('#exampleInputVille').html('');
        reloadTable();
      }
    });
  });

  // Remise à zéro du formulaire d'insertion du client + remise à 0 de la ville
  $('#squarespaceModalinsertclient').on('hide.bs.modal', function() {
    $('#form_insert_client').trigger('reset');
    $('#exampleInputVille').html('');
  });

  /**
   * Fermeture du formulaire d'ajout de personnes de contact quand on ferme le modal des personnes de contact
   */
  $('#modal_maj_contacts').on('hide.bs.modal', function() {
    $('#add_contact_form').addClass('hide');
    var iconeAjout = $(this)
      .find('button')
      .find('i');
    if (iconeAjout.hasClass('fa-minus')) {
      iconeAjout.toggleClass('fa-minus fa-plus');
    }
  });

  /**
   * Villes
   */

  function getVilles(cp) {
    return $.ajax({
      url: url + '/professionnels/getNomVille',
      type: 'post',
      data: { cp: cp },
      success: function(e) {
        if (e != 0) {
          var villes = JSON.parse(e);
          return villes;
        }
        return 0;
      },
      error: function(e) {
        console.log('Error ! ' + e);
        return 0;
      }
    });
  }

  $('#InputCPClient').change(function(e) {
    cp = $(this).val();
    $('#InputVilleClient').html('');
    var villes = getVilles(cp).then(function(cities) {
      if (cities != 0) {
        villes = JSON.parse(cities);
        for (var i = 0; i < villes.length; i++) {
          $('#InputVilleClient').append(
            '<option value="' +
              villes[i].nom +
              '"' +
              (villes[i].nom == currentClient.ville ? ' selected' : '') +
              '>' +
              villes[i].nom +
              '</option>'
          );
        }
      } else {
        alert("Ce code postal n'est pas connu");
      }
    });
  });
  $('#exampleInputCP').change(function(e) {
    $cp = $(this).val();

    $.ajax({
      url: url + '/professionnels/getNomVille',
      type: 'post',
      data: { cp: $cp },
      success: function(e) {
        if (e != 0) {
          $villes = JSON.parse(e);
          $selectV = $('#exampleInputVille');
          if ($villes.length == 1) {
            $nom = $villes[0].nom;
            $selectV.html('');
            $selectV.html(
              '<option value="' + $nom + '" selected>' + $nom + '</option>'
            );
          } else {
            $selectV.html('');
            $villes.forEach(function(v) {
              $selectV.append(
                '<option value="' + v.nom + '">' + v.nom + '</option>'
              );
            });
          }
        }
      },
      error: function(e) {
        console.log('Error ! ' + e);
      }
    });
  });
  /**
   * PERSONNES DE CONTACT
   */
  // Insertion d'une personne de contact (formulaire insert client)
  $('#add_contact').click(function() {
    $('#form_add_contact').toggleClass('hide');
  });
  // Clic sur le bouton de sauvegarde
  $('#contact_save_btn').click(function() {
    var nom = $('#contact_nom').val(),
      prenom = $('#contact_prenom').val(),
      tel = $('#contact_tel').val(),
      mail = $('#contact_mail').val(),
      com = $('#contact_com').val();
    if (nom == '' || prenom == '') {
      return false;
    }
    // Ajout des contacts dans la liste
    $('#contacts_list')
      .find('table')
      .append(
        '<tr><td>' +
          nom +
          '</td><td>' +
          prenom +
          '</td><td>' +
          tel +
          '</td></tr>'
      );
    $('#contacts_list').removeClass('hide');

    // ajax -> post dans la db
    $.ajax({
      url: url + '/contacts/addContact',
      type: 'POST',
      data:
        'nom=' +
        nom +
        '&prenom=' +
        prenom +
        '&tel=' +
        tel +
        '&mail=' +
        mail +
        '&com=' +
        com,
      success: function(response) {
        //console.log('success addContact ajax', response);
        // response = id du contact inséré;
        var values = $('#contactIds').val();
        $('#contactIds').attr(
          'value',
          values.split(',') + (values == '' ? '' : ',') + response
        );
      },
      error: function(error) {
        console.log('error addContact ajax', error);
      }
    });
    // Remise à zéro
    $('[id^="contact_"]').val('');
    // Masquage du formulaire (rappuyer sur 'Ajouter' pour insérer un contact supplémentaire')
    $('#form_add_contact').toggleClass('hide');
  });

  /**
   * Visualisation et MAJ des contacts
   */
  $('#modal_maj_contacts').on('show.bs.modal', function(e) {
    //$('.maj_contacts').on('click', function (e) {

    var rowId = $(e.relatedTarget).data('client');

    currentClient = findClient(rowId);

    $('#nom-client-header').text(
      currentClient.prenom + ' ' + currentClient.nom
    );

    var contacts = currentClient.contacts;
    var nbContacts = Object.keys(contacts).length;
    var tableBody = $('#table_contacts').find('tbody');

    $('#contac_cid').val(currentClient.id);
    // Remise à blanc du <table>
    tableBody.html('');

    if (nbContacts > 0) {
      // Affichage des contacts
      var k = 0;
      for (var c in contacts) {
        var contact = contacts[c];
        $toAppend =
          '<tr data-row="' +
          k +
          '"><td>' +
          contact.nom +
          '</td><td>' +
          contact.prenom +
          '</td>' +
          '<td>' +
          contact.telephone +
          '</td><td>' +
          contact.mail +
          '</td><td>' +
          contact.commentaire +
          '</td>';
        if (admin === '1' && !MOBILE) {
          // Si admin, possible de delete & update
          $toAppend =
            $toAppend +
            '<td>' +
            '<div class="btn-group">' +
            '<button class="btn btn-xs btn-default" data-action="edit" data-row="' +
            k +
            '" data-contact="' +
            contact.id +
            '">' +
            '   <i class="fa fa-edit"></i>' +
            '</button>' +
            '<button class="btn btn-xs btn-danger" data-action="delete" data-row="' +
            k +
            '" data-contact="' +
            contact.id +
            '">' +
            '   <i class="fa fa-trash"></i>' +
            '</button>' +
            '</div></td>';
        }
        $toAppend = $toAppend + '</tr>';
        tableBody.append($toAppend);
        k++;
      }
    } else {
      tableBody.append('<p>Pas encore de personnes de contact.</p>');
    }
  });

  /**
   * MISE A JOUR ET SUPPRESSION DES CONTACTS DEPUIS LE MODAL.
   */

  // Création de variables pour stocker l'id du contact courant et le tr sur lequel il se trouve (pour les remplacer après)
  var currentContact = null;
  var currentTr = null;

  $('#table_contacts').on('click', 'button', function(e) {
    // Récupération du client
    currentClient = findClient(currentClient.id);
    // L'id du contact est récupéré via l'attribut 'data-contact' du bouton cliqué
    var contactId = $(this).data('contact');
    // Assignation de la tr courante
    var tr = $(this).closest('tr');

    // Le n° de la row se trouve sur l'attribut 'data-row' --> correspond au n° du contact par rapport au client
    var row = $(this).attr('data-row');

    currentContact = $(this).attr('data-contact');
    currentTr = tr;

    var contact = currentClient.contacts[row];

    // currentContact = contact.id;
    // Les boutons possèdent un attribut 'data-action' , soit 'edit' soit 'delete'
    switch ($(this).data('action')) {
      // Màj
      case 'edit':
        // Peuplement du formulaire avec les données du contact
        var nom = $('#edit_contac_nom'),
          prenom = $('#edit_contac_prenom'),
          mail = $('#edit_contac_mail'),
          telephone = $('#edit_contac_tel'),
          commentaire = $('#edit_contac_com');
        $('#add_contact_btn').removeClass('hide');
        $('#add_contact_form').addClass('hide');
        nom.val(contact.nom);
        prenom.val(contact.prenom);
        mail.val(contact.mail);
        telephone.val(contact.telephone);
        commentaire.val(contact.commentaire);

        // Affichage du form
        $('#edit_contact_form').toggleClass('hide');

        break;
      // Suppression
      case 'delete':
        // Alerte
        if (
          confirm(
            'Etes-vous sûr de vouloir supprimer cette personne de contact ?'
          )
        ) {
          // Suppression dans la db
          $.ajax({
            type: 'POST',
            url: url + '/contacts/deleteContact',
            data: 'client=' + currentClient.id + '&contact=' + contactId,
            success: function(response) {
              // Suppression de la ligne dans le tableau
              tr.remove();
              reloadTable();

              $('#table_contacts')
                .find('button')
                .each(function() {
                  if ($(this).attr('data-row') >= row) {
                    $(this).attr('data-row', $(this).attr('data-row') - 1);
                  }
                });
            },
            error: function(error) {
              console.log('Erreur: ', error);
            }
          });
        }

        break;
    }
  });

  /**
   * MAJ D'UN CONTACT : CLIC SUR LE BOUTON DE SAUVEGARDE
   */
  $('#contact_update_btn').on('click', function() {
    var nom = $('#edit_contac_nom').val(),
      prenom = $('#edit_contac_prenom').val(),
      mail = $('#edit_contac_mail').val(),
      telephone = $('#edit_contac_tel').val(),
      commentaire = $('#edit_contac_com').val();
    // Validation
    if (nom == '' || prenom == '') {
      $('#edit_contac_nom')
        .closest('div.form-group')
        .addClass('has-error');
      $('#help-contac-nom')
        .show()
        .fadeOut(3000);
      $('#edit_contac_prenom')
        .closest('div.form-group')
        .addClass('has-error');
      $('#help-contac-prenom')
        .show()
        .fadeOut(3000);
      return false;
    }
    // Remplacement de la ligne dans le tableau
    currentTr.html(
      '<td>' +
        nom +
        '</td>' +
        '<td>' +
        prenom +
        '</td>' +
        '<td>' +
        telephone +
        '</td>' +
        '<td>' +
        mail +
        '</td>' +
        '<td>' +
        commentaire +
        '</td>' +
        '<td>' +
        '<div class="btn-group">' +
        '<button class="btn btn-xs btn-default" data-action="edit" data-row="' +
        currentTr.data('row') +
        '" data-contact="' +
        currentContact +
        '">' +
        '   <i class="fa fa-edit"></i>' +
        '</button>' +
        '<button class="btn btn-xs btn-danger" data-action="delete" data-row="' +
        currentTr.data('row') +
        '" data-contact="' +
        currentContact +
        '">' +
        '   <i class="fa fa-trash"></i>' +
        '</button>' +
        '</div></td>'
    );
    // Envoi dans la db
    $.ajax({
      url: url + '/contacts/updateContact',
      data:
        'id=' +
        currentContact +
        '&nom=' +
        nom +
        '&prenom=' +
        prenom +
        '&mail=' +
        mail +
        '&telephone=' +
        telephone +
        '&commentaire=' +
        commentaire,
      type: 'POST',
      success: function(response) {
        //console.log('succes update contact', response);
        $('#edit_contact_form').addClass('hide');
        // Rechargement du tableau
        reloadTable();
      },
      error: function(error) {
        console.log('erreur update contact', error);
      }
    });
  });

  // Fermeture du modal des personnes : masquage des formulaires s'ils sont là.

  $('#modal_maj_contacts').on('hide.bs.modal', function(e) {
    $('#edit_contact_form').addClass('hide');
  });

  // Ajout d'une personne de contact via le modal des contacts
  $('#add_contact_btn').click(function() {
    $('#add_contact_form').toggleClass('hide');
    $('#edit_contact_form').addClass('hide');
    $(this)
      .find('i')
      .toggleClass('fa-plus fa-minus');
  });
  // Clic sur le bouton de sauvegarde
  $('#contact_save').click(function() {
    var nom = $('#contac_nom').val(),
      prenom = $('#contac_prenom').val(),
      tel = $('#contac_tel').val(),
      mail = $('#contac_mail').val(),
      com = $('#contac_com').val(),
      clientId = $('#contac_cid').val();
    // Validation
    if (nom == '' || prenom == '') {
      if (nom == '') {
        $('#group-nom').addClass('has-error');
        $('#help-nom')
          .removeClass('hide')
          .fadeOut(3000);
      }

      if (prenom == '') {
        $('#group-prenom').addClass('has-error');
        $('#help-prenom')
          .removeClass('hide')
          .fadeOut(3000);
      }

      return false;
    }

    // Envoi du contact dans la db
    $.ajax({
      url: url + '/contacts/addClientContact',
      type: 'POST',
      data:
        'nom=' +
        nom +
        '&prenom=' +
        prenom +
        '&tel=' +
        tel +
        '&mail=' +
        mail +
        '&com=' +
        com +
        '&client_id=' +
        clientId,
      success: function(response) {
        //console.log('success addContact ajax', response);
        // response = id du contact inséré;
        reloadTable();
      },
      error: function(error) {
        console.log('error addContact ajax', error);
      }
    });

    var tab = $('#table_contacts');
    var form = $('#add_contact_form');
    // Ajout des contacts dans la liste
    tab.find('p').remove(); // enlever le paragraphe 'pas encore de personnes de contact'
    tab
      .find('tbody')
      .append(
        '<tr>' +
          '<td>' +
          nom +
          '</td>' +
          '<td>' +
          prenom +
          '</td>' +
          '<td>' +
          tel +
          '</td>' +
          '<td>' +
          mail +
          '</td>' +
          '<td>' +
          com +
          '</td>' +
          '<td>' +
          '<i class="fa fa-check text-success"></i>' +
          '</td>' +
          '</tr>'
      );
    form.trigger('reset').toggleClass('hide');
    $('#add_contact_btn')
      .find('i')
      .toggleClass('fa-plus fa-minus');
  });

  /**
   *  SUPPRESSION CLIENT
   */
  $('#dataTable_clients tbody').on('click', '.supprimer_client', function() {
    var ok = confirm(
      'Voulez-vous vraiment supprimer ce client ? \n ' +
        'Attention:  Ceci supprimera également ses personnes de contact !!!'
    );
    if (ok) {
      var id_to_delete = $(this).data('id');
      $.ajax({
        method: 'POST',
        //la route (controleur) et le paramètre (id à supprimer)
        url: url + '/clients/deleteClients/' + id_to_delete,
        dataType: 'json',

        success: function(e) {
          changeNbResult();
          reloadTable();
        },
        error: function(erreur) {
          alert('Erreur dans le fichier clients.js');
        }
      });
    }
  });

  /**
   * FAVORIS-
   */

  // Tri en fonction des favoris
  $('#showFavori').click(function() {
    var table = $('#dataTable_clients').DataTable();
    if ($(this).hasClass('favStar0')) {
      // N'affiche que les favoris
      $(this)
        .removeClass('favStar0')
        .addClass('favStar1');
      table
        .column(1)
        .search(1)
        .draw();
    } else {
      // Affiche tout
      $(this)
        .removeClass('favStar1')
        .addClass('favStar0');
      $reg = '^0|1';
      table
        .column(1)
        .search($reg, true, false)
        .draw();
    }
  });

  // Change favori
  $('#dataTable_clients tbody').on('click', '.favCli', function() {
    $elem = $(this);
    // ID du pro
    $id = $elem.attr('id').split('_')[0];
    if ($elem.hasClass('favStar1')) {
      // Delete favori
      $.ajax({
        url: url + '/clients/deleteFavori',
        type: 'post',
        data: { cli: $id },
        success: function(e) {
          $elem.removeClass('favStar1').addClass('favStar0');
          $('#' + $id + '_spanFav').text('0');
          reloadTable();
        },
        error: function(e) {
          console.log('Error ! ' + e);
        }
      });
    } else {
      // Add favori
      $.ajax({
        url: url + '/clients/addFavori',
        type: 'post',
        data: { cli: $id },
        success: function(e) {
          $elem.removeClass('favStar0').addClass('favStar1');
          $('#' + $id + '_spanFav').text('1');
          reloadTable();
        },
        error: function(e) {
          console.log('Error ! ' + e);
        }
      });
    }
  });

  /**
   * HELPERS
   */

  /**
   * Recharger la table
   */
  function reloadTable() {
    table.ajax.reload();
  }

  /**
   * Récupérer un client
   * @param id l'id du client
   * @returns {*} Un objet représentant le client
   */
  function findClient(id) {
    var search = $.grep(table.rows().data(), function(client) {
      return client.id == id;
    });

    return search[0];
  }

  /**
   * Change le nombre de résultats trouvé
   * $nb : le nombre de résultat(s)
   */
  function changeNbResult() {
    $nb = $('#dataTable_clients')
      .DataTable()
      .page.info()['recordsDisplay'];
    if (
      $nb == 1 &&
      $('#datatable_clients tr td').hasClass('dataTables_empty')
    ) {
      $nb = 0;
    }
    $txt = $('#nbProPhrase');
    switch ($nb) {
      case 0:
        $txt.text($nb + ' resultat');
        $txt.addClass('text-danger').removeClass('text-success');
        break;
      case 1:
        $txt.text($nb + ' resultat');
        $txt.addClass('text-success').removeClass('text-danger');
        break;
      default:
        $txt.text($nb + ' resultats');
        $txt.addClass('text-success').removeClass('text-danger');
    }
  }

  /**
   * STYLE
   */
  $('select').addClass('form-control');
  $('input[type="search"]').addClass('form-control');
});
