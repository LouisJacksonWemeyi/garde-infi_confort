$(document).ready(function() {
    
    // Pro comme 'actif'
    $('#navPro').addClass('active');
    $('#navCli').removeClass('active');
    $('#navCat').removeClass('active');
    $('#navUser').removeClass('active');
    $('#navExl').removeClass('active');

    // Regex email
    var mailformat = /^([0-9a-zA-Z]([-_\\.]*[0-9a-zA-Z]+)*)@([0-9a-zA-Z]([-_\\.]*[0-9a-zA-Z]+)*)[\\.]([a-zA-Z]{2,9})$/;

    var admin = $.get(url + '/users/isAdmin', '', function(res) {
        admin = res;
    });

    // Tab avec ID categorie qui ont un n° inami
    var tabInami = [];
    $.ajax ({
            method : 'POST',
            url: url + "/categories/getIdInami/",
            dataType: 'html',
            success:function(e) {
                tabInami = e;
                console.log(e);
            }
        }
    );

    // Recup valeur $_GET
    function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;
        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : sParameterName[1];
            }
        }
        return ' ';
    };

    $cat = getUrlParameter('cat');
    $reg = getUrlParameter('reg');

    // Init dataTable
    $('#example').DataTable({
        "ajax": url + "/professionnels/getProJson/" + $cat + "/" + $reg,
        "order": [[ 4, "asc" ]],
        responsive: true,
        "columns": [
            {
                // Responsive control column
                data: null,
                defaultContent: '',
                className: 'control',
                orderable: false
            },
            {
                data: null,
                className: 'text-center favTxt',
                orderable: false,
                render: function (data, type, row, meta) {
                    return '<span id="' + row.id + '_spanFav">' + row.favori + '</span> <i id="' + row.id + '_star" class="favStar' + row.favori + ' fa fa-star favPro"></i>';
                }
            },
            {
                data: null,
                className: 'not-mobile',
                render: function (data, type, row, meta) {
                    return row.nom_categorie + ' - ' + ((row.regions_id == 1)? 'BXL' : 'BW');
                }
            },
            {data: 'nom_societe'},
            {data: 'nom'},
            {data: 'prenom'},
            {
                data: null,
                className: 'none',
                render: function (data, type, row, meta) { // data et row contiennent l'objet client
                    return row.adresse + ' ' + row.numero + '/' + row.boite + ' ' + row.cp + ' ' + row.ville
                }
            },
            {data: 'mail'},
            {data: 'telephone'},
            {
                data: 'inami',
                className: 'none'
            },
            {
                data: 'tva',
                className: 'none'
            },
            {
                data: 'disponibilite',
                className: 'none'
            },
            {
                data: 'commentaire',
                className: 'none'
            },
            {
                data: null,
                className: 'text-center none',
                render: function (data, type, row, meta) {
                    if (admin === '1' && !MOBILE) {
                        return '<div class="btn-group">'
                                + '<a class="btn btn-default" data-toggle="modal" href="#" data-target="#squarespaceModal" data-id="' + row.id + '" data-row="' + meta.row + '" data-pro="' + data.id + '">'
                                + '<i class="fa fa-fw fa-edit"></i> Editer'
                                + '</a>'
                                + '<a class="btn btn-default supprimer_pro" data-id="' + row.id + '" href="#">'
                                + '<i class="fa fa-fw fa-trash-o text-danger"></i> Supprimer'
                                + '</a>'
                                + '</div>'
                    }
                    return null
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

    var table = $('#example').DataTable();
    $('select').addClass('form-control');
    $('input[type="search"]').addClass('form-control').css('margin-right', '10px');

    // Modifie le nom de la commune (et region) automatiquement lors de l'insert
    $('#addInputCP').change(function (e) {
        $cp = $(this).val();
        if ($cp > 1210) {
            $('#sel_region').val(2);
        } else {
            $('#sel_region').val(1);
        }
        $.ajax({
            url: url + '/professionnels/getNomVille',
            type: 'post',
            data: {cp: $cp},
            success: function (e) {
                if (e != 0) {
                    $villes = JSON.parse(e);
                    $selectV = $('#addSelectVille');
                    if ($villes.length == 1) {
                        $nom = $villes[0].nom;
                        $selectV.html('');
                        $selectV.html('<option value="' + $nom + '" selected>' + $nom + '</option>');
                    } else {
                        $selectV.html('');
                        $villes.forEach(function (v) {
                            $selectV.append('<option value="' + v.nom + '" selected>' + v.nom + '</option>');
                        });
                    }
                }
            },
            error: function (e) {
                console.log('Error ! ' + e);
            }
        });
    });

    // Modifie le nom de la commune (et region) automatiquement lors de l'update
    $('#updateInputCP').change(function (e) {
        $cp = $(this).val();
        if ($cp > 1210) {
            $('#update_region').val(2);
        } else {
            $('#update_region').val(1);
        }
        $.ajax({
            url: url + '/professionnels/getNomVille',
            type: 'post',
            data: {cp: $cp},
            success: function (e) {
                if (e != 0) {
                    $villes = JSON.parse(e);
                    $selectV = $('#updateInputVille');
                    if ($villes.length == 1) {
                        $nom = $villes[0].nom;
                        $selectV.html('');
                        $selectV.html('<option value="' + $nom + '" selected>' + $nom + '</option>');
                    } else {
                        $selectV.html('');
                        $villes.forEach(function (v) {
                            $selectV.append('<option value="' + v.nom + '" selected>' + v.nom + '</option>');
                        });
                    }
                }
            },
            error: function (e) {
                console.log('Error ! ' + e);
            }
        });
    });

    // Masque le numéro INAMI si inutile (INSERT)
    $('#sel_metier_insert_pro').change(function() {
        $metier = ($("#sel_metier_insert_pro > option:selected").val()).trim();
        if ($.inArray($metier, tabInami) != '-1') {
            $('#exampleInputInamiAdd').removeAttr('disabled');
        } else {
            $('#exampleInputInamiAdd').attr('disabled', true);
        }
    });
    // Masque le numero INAMI si inutile (UPDATE)
    $('#sel_metier').change(function () {
        $metier = $(this).val();
        if ($.inArray($metier, tabInami) != '-1') {
            $('#updateInputInami').removeAttr('disabled');
        } else {
            $('#updateInputInami').attr('disabled', true);
            $('#updateInputInami').val('');
        }
    });

    // Change le nombre de résultats trouvés lors d'un filtre
    table.on( 'draw.dt', function () {
        changeNbResult();
    });

    //Change le nombre de résultats trouvé
    function changeNbResult () {
        $nb = $('#example').DataTable().page.info()['recordsDisplay'];
        if ($nb == 1 && $('#example tr td').hasClass('dataTables_empty')) {
            $nb = 0;
        }
        $txt = $('#nbProPhrase');
        switch ($nb) {
            case 0:
                $txt.text($nb + ' resultat');
                $txt.addClass('text-danger').removeClass('text-success');
                break;
            case 1 :
                $txt.text($nb + ' resultat');
                $txt.addClass('text-success').removeClass('text-danger');
                break;
            default :
                $txt.text($nb + ' resultats');
                $txt.addClass('text-success').removeClass('text-danger');
        }
    }

    // Tri en fonction des favoris
    $('#showFavori').click(function () {
        var table = $('#example').DataTable();
        if ($(this).hasClass('favStar0')) {
            // N'affiche que les favoris
            $(this).removeClass('favStar0').addClass('favStar1');
            table
                .column( 1 )
                .search(1)
                .draw();
        } else {
            // Affiche tout
            $(this).removeClass('favStar1').addClass('favStar0');
            $reg = '^0|1';
            table
                .column( 1 )
                .search($reg, true, false)
                .draw();
        }
    });

    // Change favori
    $('#example tbody').on('click', '.favPro', function () {
        $elem = $(this);
        // ID du pro
        $id = $elem.attr('id').split('_')[0];
        if ($elem.hasClass('favStar1')) {
            // Delete favori
            $.ajax({
                url: url + '/professionnels/deleteFavori',
                type: 'post',
                data: {pro: $id},
                success: function (e) {
                    $elem.removeClass('favStar1').addClass('favStar0');
                    $('#' + $id + '_spanFav').text('0');
                    reloadTable();
                },
                error: function (e) {
                    console.log('Error ! ' + e);
                }
            });
        } else {
            // Add favori
            $.ajax({
                url: url + '/professionnels/addFavori',
                type: 'post',
                data: {pro: $id},
                success: function (e) {
                    $elem.removeClass('favStar0').addClass('favStar1');
                    $('#' + $id + '_spanFav').text('1');
                    reloadTable();
                },
                error: function (e) {
                    console.log('Error ! ' + e);
                }
            });
        }
    });

    //**** DELETE ****
    $('#example tbody').on( 'click', '.supprimer_pro', function () {
        var ok = confirm("Voulez-vous vraiment supprimer ce prestataire ?");
        if(ok) {
            var id_to_delete = $(this).data('id');
            $.ajax ({
                method : 'POST',
                //la route (controleur) et le paramètre (id à supprimer)
                url: url + "/professionnels/deleteProfessionnels/"+id_to_delete,
                dataType: 'json',
                success:function(e) {
                    changeNbResult();
                    reloadTable();
                },
                error:function(erreur) {
                    alert("Erreur dans le fichier professionnels.js");
                }
            });
        }
    } );

    //*** UPDATE *** quand on affiche le modal de mise à jour
    $('#squarespaceModal').on('show.bs.modal', function(event) {

        var id = $(event.relatedTarget).data('id');
        var currentPro = $.grep(table.rows().data(), function (r) {
            return r.id == id;
        });
        currentPro = currentPro[0];

        console.log(currentPro);

        $('#nom_description').html(currentPro.prenom + ' ' + currentPro.nom);
        $('#updateNomSociete').val(currentPro.nom_societe);
        $('#updateInputNom').val(currentPro.nom);
        $('#updateInputPrenom').val(currentPro.prenom);
        $('#updateInputAdresse').val(currentPro.adresse);
        $('#updateInputNumero').val(currentPro.numero);
        $('#updateInputBoite').val(currentPro.boite);
        $('#updateInputCP').val(currentPro.cp);
        $('#updateInputVille').append('<option value="' + currentPro.ville + '" selected>' + currentPro.ville + '</option>');
        $('#updateInputEmail').val(currentPro.mail);
        $('#updateInputTelephone').val(currentPro.telephone);
        // Masque le numero INAMI si inutile
        $metier = currentPro.categorie_id;
        if ($.inArray($metier, tabInami) != '-1') {
            $('#exampleInputInami').removeAttr('disabled');
        } else {
            $('#exampleInputInami').attr('disabled', true).val(currentPro.inami);
        }
        $('#updateInputTVA').val(currentPro.tva);
        $('#updateInputDisponibilite').val(currentPro.disponibilite);
        $('#updateInputCommentaire').val(currentPro.commentaire);
        $('#updateInputIdCache').val(currentPro.id);
        $('#update_region').val(currentPro.regions_id);
        $('#sel_metier').val(currentPro.categorie_id);

        //alert(ar[id].categorie_id);
        //permet de pré-sélectionner le métier du pro
        $('#sel_metier option[value="'+ currentPro.categorie_id+'"]').attr('selected', 'selected');
        //permet de préselectionner la région du pro (BXL ou BW)
        $('#update_region option[value="'+ currentPro.regions_id+'"]').attr('selected', 'selected');

    });

    //*** UPDATE ***
    $('#form_update_pro').submit(function(ev) {
        ev.preventDefault(); // to stop the form from submitting

        var id_pro = $('#updateInputIdCache').val();
        //alert($("#form_update_pro").serialize());
        //return false;

        if($('#sel_metier').val() == -1) {
            alert("Veuillez choisir une catégorie pour le nouveau prestataire");
            //je donne le focus à la select afin de montrer à l'utilisateur qu'il doit obligatoire choisir une catégorie
            $('#sel_metier').focus().select().css('border', '3px solid red');
            return false;
        }
        if($('#update_region').val() == -1) {
            alert("Veuillez choisir une région pour le nouveau prestataire");
            //je donne le focus à la select afin de montrer à l'utilisateur qu'il doit obligatoire choisir une catégorie
            $('#update_region').focus().select().css('border', '3px solid red');
            return false;
        }
        var mail = $('#updateInputEmail').val().trim();
        if (mail != '' && !mail.match(mailformat)) {
            $('#result').html('Veuillez rentrer une adresse e-mail valide').fadeOut(3000);
            return false;
        }
        // Nom société ou Nom & Prenom obligatoire
        if (($('#updateInputNom').val() == '' || $('#updateInputPrenom').val() == '') && $('#updateNomSociete').val() == '') {
            alert('Veuillez choisir un nom de société OU un nom et prenom pour le nouveau prestataire');
            $('#updateNomSociete').focus();
            $('#updateNomSociete').css('border', '3px solid red');
            $('#updateInputNom').css('border', '3px solid red');
            $('#updateInputPrenom').css('border', '3px solid red');
            return false;
        }

        console.log($("#form_update_pro").serialize());

        $.ajax ({
                method : 'POST',
                //la route (controleur) et le paramètre (id à supprimer)
                url: url + "/professionnels/updateProfessionnel/"+id_pro,
                dataType: 'html',
                data:{
                    data_form_pro : $("#form_update_pro").serialize(),
                    action : 'maj'
                },
                success:function(result) {
                    $("#result").show(); //DD: il faut le laisser autrement, il n'appraît plus quand on met à jour un second prestataire...
                    $("#result").html(result);
                    $("#result").fadeOut(3000);
                    reloadTable();
                }
            }
        );
    });

    //******* ADD ***********
    $('#form_insert_pro').submit(function(ev) {
        ev.preventDefault(); // to stop the form from submitting
        if($('#sel_metier_insert_pro').val() == -1) {
            alert("Veuillez choisir une catégorie pour le nouveau prestataire");
            //je donne le focus à la select afin de montrer à l'utilisateur qu'il doit obligatoire choisir une catégorie
            $('#sel_metier_insert_pro').focus().select().css('border', '3px solid red');
            return false;
        }
        if($('#sel_region').val() == -1) {
            alert("Veuillez choisir une région pour le nouveau prestataire");
            //je donne le focus à la select afin de montrer à l'utilisateur qu'il doit obligatoire choisir une catégorie
            $('#sel_region').focus().select().css('border', '3px solid red');
            return false;
        }
        var mail = $('#exampleInputEmail').val().trim();
        if (mail != '' && !mail.match(mailformat)) {
            $('#result_insert').html('Veuillez rentrer une adresse e-mail valide').fadeOut(3000);
            return false;
        }
        // Nom société ou Nom & Prenom obligatoire
        if (($('#addInputNom').val() == '' || $('#addInputPrenom').val() == '') && $('#AddNomSociete').val() == '') {
            alert('Veuillez choisir un nom de société OU un nom et prenom pour le nouveau prestataire');
            $('#AddNomSociete').focus();
            $('#AddNomSociete').css('border', '3px solid red');
            $('#addInputNom').css('border', '3px solid red');
            $('#addInputPrenom').css('border', '3px solid red');
            return false;
        }
        $.ajax ({
                method : 'POST',
                //la route (controleur) et le paramètre (id à supprimer)
                url: url + "/professionnels/addProfessionnel/",
                dataType: 'html',
                data:{
                    data_form_insert_pro : $("#form_insert_pro").serialize(),
                    action : 'add'
                },
                success:function(result) {
                    $('#form_insert_pro').trigger('reset');
                    $("#result_insert").show(); //DD: il faut le laisser autrement, il n'appraît plus quand on met à jour un second prestataire...
                    $("#result_insert").html(result);
                    reloadTable();
                }
            }
        );
    });

    // Vide les infos lors des de l'ouverture du modal ADD
    $('#squarespaceModalinsertpro').click(function() {
        $('#result_insert').html('');
        $('#sel_metier_insert_pro').css('border', 'none');
        $('#sel_region').css('border', 'none');
        $('#AddNomSociete').css('border', 'none');
        $('#addInputNom').css('border', 'none');
        $('#addInputPrenom').css('border', 'none');

    });

    // Recharge le dataTable
    function reloadTable() {
        table.ajax.reload();
        table.draw();
    }

});
    
    
    
        

