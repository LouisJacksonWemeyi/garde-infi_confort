$(document).ready(function() {

    // User comme 'actif'
    $('#navUser').addClass('active');
    $('#navCli').removeClass('active');
    $('#navPro').removeClass('active');
    $('#navCat').removeClass('active');
    $('#navExl').removeClass('active');

    var admin = $.get(url + '/users/isAdmin', '', function(res) {
        admin = res;
    });

    // Init datatable
    $('#users').DataTable({
        "ajax": url + "/users/getUserJson",
        "order": [[ 0, "asc" ]],
        responsive: true,
        "createdRow": function( row, data, dataIndex ) {
            if ( data.actif == '1' ) {
                $(row).addClass('td_user_1');
            } else {
                if (!($('#checkActif').prop('checked'))) {
                    $(row).addClass('hidden');
                }
                $(row).addClass('td_user_0');
            }
            $(row).attr('id', 'tr_' + data.id);
        },
        "columns": [
            {
                data: 'nom',
                className: 'control'
            },
            {data: 'prenom'},
            {data: 'login'},
            {
                data: null,
                render: function (data, type, row, meta) {
                    if (data.actif == '1') {
                        return 'Oui';
                    } else {
                        return 'Non';
                    }
                }
            },
            {data: 'type_user'},
            {
                data: null,
                orderable: false,
                render: function (data, type, row, meta) {
                    if (admin ==='1') {
                        return '<button data-id="' + data.id + '" data-toggle="modal" data-target="#squarespaceModalupdateuser" class="update_user btn btn-default"><i class="fa fa-pencil"></i></button>'
                    }
                }
            }
        ],
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
        }
    });

    var table = $('#users').DataTable();
    $('select').addClass('form-control');
    $('input[type="search"]').addClass('form-control');

    // Affiche desactive
    $('#checkActif').change(function () {
        $('.td_user_0').toggleClass('hidden');
    });

    // **** UPDATE ****
    $('#squarespaceModalupdateuser').on('show.bs.modal', function(event) {

        var id = $(event.relatedTarget).data('id');
        var currentUser = $.grep(table.rows().data(), function (r) {
            return r.id == id;
        });
        currentUser = currentUser[0];
        $('#exampleInputNom').val(currentUser.nom);
        $('#exampleInputLogin').val(currentUser.login);
        $('#exampleInputPrenom').val(currentUser.prenom);
        $('#exampleInputActif').val(currentUser.actif);
        $('#exampleInputType_user').val(currentUser.type_user);
        $('#exampleInputIdCache').val(currentUser.id);
        $("#result_insert_user").html('');
    });
    $('#form_update_user').submit(function(ev)  {
        ev.preventDefault(); // to stop the form from submitting
        var id_user = $('#exampleInputIdCache').val();
        $.ajax ({
            method : 'POST',
            //la route (controleur) et le paramètre (id à supprimer)
            url: url + "/users/updateUser/"+id_user,
            dataType: 'html',
            data:{
                data_form_user : $("#form_update_user").serialize(),
                action : 'maj'
            },
            success:function(result) {
                $("#result_insert_user").show();
                $("#result_insert_user").html(result);
                reloadTable();
            }
        });
    });

    //  **** ADD ****
    $('#form_insert_user').submit(function(ev) {
        ev.preventDefault(); // to stop the form from submitting
        $.ajax ({
            method : 'POST',
            //la route (controleur) et le paramètre (id à supprimer)
            url: url + "/users/addUser/",
            dataType: 'html',
            data:{
                data_form_insert_user : $("#form_insert_user").serialize(),
                action : 'add'
            },
            success:function(result) {
                $('#form_insert_user').trigger('reset');
                $("#result_insert").show(); //DD: il faut le laisser autrement, il n'appraît plus quand on met à jour un second prestataire...
                $("#result_insert").html(result);
                reloadTable();
            }
        });
    });

    // Recharge le dataTable
    function reloadTable() {
        table.ajax.reload();
        table.draw();
    }

});
    
    
    
        

