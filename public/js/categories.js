$(document).ready(function () {


    var table = null;

    // Cat comme 'actif'
    $('#navCat').addClass('active');
    $('#navCli').removeClass('active');
    $('#navPro').removeClass('active');
    $('#navUser').removeClass('active');
    $('#navExl').removeClass('active');

    $('#categories').DataTable({
            "ajax": url + '/categories/getCategoriesJSON',
            "columns": [
                {
                    data: null,
                    render: function (data, type, row, meta) { // data et row contiennent l'objet client
                        $toReturn =  '<div class="row" ><div class="col-md-10 text-center"><span id="nom_cat_' + row.id + '">' + row.nom_categorie + '</span>' ;
                        if (row.inami == '1') {
                            $toReturn = $toReturn + '<small> (avec n° inami)</small>';
                        }
                        $toReturn = $toReturn +
                            '</div><div class="col-md-2">' +
                            '<button id="btnEdit_' + row.id + '" data-toggle="modal" data-inami="' + row.inami + '" data-id="' + row.id + '"' +
                            'data-target="#squarespaceModalupdatecategorie" ' +
                            'class="update_pro btn btn-default pull-right"><i class="fa fa-pencil"></i></button>' +
                            '</div>' +
                            '</div>';
                        return $toReturn;
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
        }
    );

    table = $('#categories').DataTable();

    function reloadTable() {
        table.ajax.reload();
    }

    $('select').addClass('form-control');
    $('input[type="search"]').addClass('form-control');

    //                                                    *** SUPPRESSION D'UNE CATEGORIE ***
    var table = $('#categories').DataTable();

    $('body').on('click', '[class^="supprimer_categorie"]', function () {
        var ok = confirm("Voulez-vous vraiment supprimer cette catégoire ?");
        if (ok) {
            //je supprime la row du dataTable avant de passer à ajax et donc de supprimer en bd
            table
                .row($(this).parents('tr'))
                .remove()
                .draw();
            var nomdelaclasse = this.className;
            var elements = nomdelaclasse.split('#');
            var id_to_delete = elements[1];
            $.ajax({
                method: 'POST',
                //la route (controleur) et le paramètre (id à supprimer)
                url: url + "/categories/deleteCategorie/" + id_to_delete,
                dataType: 'html',
                success: function (result) {
                    $('#tab_categories').html(result);
                }
            });
        }
    });


    //*** MAJ D'UNE CATEGORIE ***

    // Affiche le modal avec la bonne categorie
    $('table').on('click', '[id^="btnEdit_"]', function() {
        
        var id = $(this).data('id');
        // Recup des valeurs
        var categorie = $('#nom_cat_' + id).text().trim();
        var inami = $(this).data('inami');

        $('#exampleInputNomCategorie').val(categorie);
        $('#exampleInputIdCacheCat').val(id);
        $('#updateInputInami').val(inami);
        $('#result_update_cat').text('');
    });

    // Update la categorie
    $('#btn_form_update').click(function (e) {
        e.preventDefault();
        var id = $('#exampleInputIdCacheCat').val();
        var nom = $('#exampleInputNomCategorie').val();
        var inami = $('#updateInputInami').val();

        $.ajax({
            url: url + "/categories/updateCategorie",
            type: 'post',
            data: {
                data_form_cat: $("#form_update_categorie").serialize(),
                action: 'maj'
            },
            success: function (e) {
                $('#td_' + id).text(nom);
                $('#result_update_cat').text('Mise à jour réussie');
                reloadTable();
            },
            error: function (html) {
                console.log('Error ! ' + html);
            }
        })

    });


    /*** AJOUT D'UNE CATEGORIE ***/

    $('#form_insert_cat').submit(function (ev) {
        ev.preventDefault();
        $.ajax({
                method: 'POST',
                //la route (controleur) et le paramètre (id à supprimer)
                url: url + "/categories/addCategorie",
                dataType: 'html',
                data: {
                    data_form_insert_cat: $("#form_insert_cat").serialize(),
                    action: 'add'
                },
                success: function (result) {
                    $("#result_add_cat").show();
                    $("#result_add_cat").html(result);
                    $("#result_add_cat").fadeOut(3000);
                    $('#result_add_cat').html(result);
                    $('form_insert_cat').trigger('reset');
                    reloadTable();
                }
            }
        );
    });

    //permet de rafraichier la page quand on ferme le modal bootstrap
    $('#squarespaceModalinsertcategorie').on('hidden.bs.modal', function () {
        location.reload();
    });


    //quand on clic sur un élemnt dont la classe commence par add_categorie
    $('body').on('click', '#add_categorie', function () {
        var ajout = prompt("Veuillez indiquer le nom de la catégorie que vous souhaitez ajouter");
        if (ajout.length > 1) {
            $.ajax({
                method: 'POST',
                //la route (controleur) et le paramètre (id à supprimer)
                url: url + "/categories/addCategorie",
                dataType: 'html',
                data: {
                    'nom_categorie': ajout
                },
                success: function (result) {
                    $('#tab_categories').html(result);
                }
            });
        }
    });

});
    
    
    
        

