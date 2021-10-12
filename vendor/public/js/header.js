/**
 * Created by Matthieu on 11/09/17.
 */



$(function () {
    // Modifie la barre de titre ...
        function modifTitre() {
        var taille = $('.navbar').width();
        if (taille < 840) {
            $('.btn-menu').addClass('hidden');
            $('.btn-dropdown').removeClass('hidden');
        } else {
            $('.btn-menu').removeClass('hidden');
            $('.btn-dropdown').addClass('hidden');
        }
    }
    // ... au demarrage
    modifTitre();
    // ... lors d'un resize
    $(window).resize(function () {
        modifTitre();
    });
})
