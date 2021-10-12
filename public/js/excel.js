/**
 * Created by Matthieu on 13/09/17.
 */


$(function () {

    // User comme 'actif'
    $('#navExl').addClass('active');
    $('#navCli').removeClass('active');
    $('#navPro').removeClass('active');
    $('#navCat').removeClass('active');
    $('#navUser').removeClass('active');

    // Affiche le nombre de ligne a generer
    $('#selectExcel').change(function () {
        $val = $("#selectExcel > option:selected").val();
        $titre = $("#selectExcel > option:selected").text();
        $cat = $val.split('_')[0];
        $reg = $val.split('_')[1];
        $.ajax({
            url : url + "excel/getNbRows",
            type: 'post',
            data: {
                cat : $cat,
                reg : $reg
            },
            success: function (e) {
                if (e > 0) {
                    $('#retourExcel').removeClass('text-danger').removeClass('text-success').addClass('text-info');
                    $('#retourExcel').text('Fichier excel de ' + e + ' ligne(s) à générer');
                    $('#btnFormExcelGen').removeClass('disabled');
                    $('#btnFormExcelDown').addClass('hidden');
                } else {
                    $('#retourExcel').removeClass('text-info').removeClass('text-success').addClass('text-danger');
                    $('#retourExcel').text('Aucune donnée dans cette catégorie !');
                    $('#btnFormExcelGen').addClass('disabled');
                    $('#btnFormExcelDown').addClass('hidden');
                }
            },
            error: function (e) {
                console.log('Error ! ' + e);
            }
        });
    });

    // Genere le fichier excel
    $('#btnFormExcelGen').click(function(e) {
        e.preventDefault();
        
        $val = $("#selectExcel > option:selected").val();
        $titre = $("#selectExcel > option:selected").text();
        $cat = $val.split('_')[0];
        $reg = $val.split('_')[1];
        
        $.ajax({
            url : url + "/excel/generer",
            type : 'post',
            data: {
                cat : $cat,
                reg : $reg,
                titre : $titre
            },
            success: function (e) {
                if (e.substring(0,1) == '1') {
                    $('#retourExcel').removeClass('text-info').removeClass('text-danger').addClass('text-success');
                    $('#retourExcel').text('Fichier généré correctement');
                    $('#btnFormExcelDown').removeClass('hidden').attr('href', url + e.substring(2));
                } else {
                    $('#retourExcel').removeClass('text-info').removeClass('text-success').addClass('text-danger');
                    $('#retourExcel').text('Aucune donnée dans cette catégorie !');
                    $('#btnFormExcelDown').addClass('hidden');
                }

            },
            error: function (e) {
                console.log('Error ! ' + e);
            }
        })
    });

    // Premet de telecharger le fichier excel
    $('#btnFormExcelDown').click(function (e) {
        e.preventDefault();
        $href = $(this).attr('href');
        document.location.href = $href;
        $(this).addClass('hidden').attr('href', url);
        $('#retourExcel').text('');
        $('#btnFormExcelGen').addClass('disabled');
    });

});