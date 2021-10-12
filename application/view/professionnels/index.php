<script src="<?= URL ?>js/professionnels.js"></script>

<div class="container">
    <div class="row">
        <h1 class="displayInline">Gestion des professionnels</h1>

        <?php switch ($count) {
            case 0:
                ?>
                <h3 id="nbResult">(<?= $title ?> : <span id="nbProPhrase" class="text-danger"><span id="nbProCount"><?= $count ?></span> resultat</span>)</h3>
                <?php
                break;
            case 1:
                ?>
                <h3 id="nbResult">(<?= $title ?> : <span id="nbProPhrase" class="text-success"><span id="nbProCount"><?= $count ?></span> resultat</span>)</h3>
                <?php
                break;
            default:
                ?>
                <h3 id="nbResult">(<?= $title ?> : <span id="nbProPhrase" class="text-success"><span id="nbProCount"><?= $count ?></span> resultats</span>)</h3>
                <?php
        }


        if ($_SESSION['type_user'] == 'admin' && !MOBILE) { ?>
            <div class="pull-right" style="margin-top:10px">
                <span class="center-block text-center pull-right">
                    <button data-toggle="modal" data-target="#squarespaceModalinsertpro" class="update_pro btn btn-primary"><i class="fa fa-plus"></i> Ajouter un prestataire</button>
                </span>
            </div>
        <?php } ?>
    </div>
</div>
<hr>

<?php

$categories = array();
foreach ($allCategories as $categorie)
{
    array_push($categories,$categorie);
}
?>

<table id="example" class="display table table-condensed responsive no-wrap" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th></th>
        <th><i id="showFavori" class="fa fa-star favStar0"></i></th>
        <th>Profession</th>
        <th>Société</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Adresse</th>
        <th>Mail</th>
        <th>Téléphone</th>
        <th>INAMI</th>
        <th>TVA</th>
        <th>Disponibilité&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th>Commentaire&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <?php if ($_SESSION['type_user'] == 'admin' && !MOBILE) { ?>
            <th>Options</th>
        <?php } else { ?>
            <th class="hidden"></th>
        <?php } ?>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th></th>
        <th></th>
        <th>Profession</th>
        <th>Société</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Adresse</th>
        <th>Mail</th>
        <th>Téléphone</th>
        <th>INAMI</th>
        <th>TVA</th>
        <th>Disponibilité&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th>Commentaire&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <?php if ($_SESSION['type_user'] == 'admin' && !MOBILE) { ?>
            <th>Options</th>
        <?php } else { ?>
            <th class="hidden"></th>
        <?php } ?>
    </tr>
    </tfoot>
    <tbody>

    </tbody>
</table>


<?php
if ($_SESSION['type_user'] == 'admin') {
    //le modal qui permet de mettre à jour le partenaire
    include('includes/modal_maj_pro.php');
    include('includes/modal_insert_pro.php');
}

?>

