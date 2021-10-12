/**
 * Created by Matthieu on 11/09/17.
 */



$(function () {
    // Modifie le header ...
        function modifTitre() {
        var taille = $('header').width();
        if (taille < 990) {
            $('.resize-big').addClass('hidden');
            $('.resize-medium').removeClass('hidden');
            $('.navbar').css('paddingLeft', 0);
        } else {
            $('.resize-big').removeClass('hidden');
            $('.resize-medium').addClass('hidden');
            $('.navbar').css('paddingLeft', 270);
        }
    }
    // ... au demarrage
    modifTitre();
    // ... lors d'un resize
    $(window).resize(function () {
        modifTitre();
    });
})
