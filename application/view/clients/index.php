<script src="<?= URL ?>js/clients.js"></script>


<div class="container">
    <div class="row">
        <h1 class="displayInline">Gestion des clients</h1>
        <?php switch ($count) {
            case 0:
                ?>
                <h3 id="nbResult">(<span id="nbProPhrase" class="text-danger"><span id="nbProCount"><?= $count ?></span> resultat</span>)
                </h3>
                <?php
                break;
            case 1:
                ?>
                <h3 id="nbResult">(<span id="nbProPhrase" class="text-success"><span
                                id="nbProCount"><?= $count ?></span> resultat</span>)</h3>
                <?php
                break;
            default:
                ?>
                <h3 id="nbResult">(<span id="nbProPhrase" class="text-success"><span
                                id="nbProCount"><?= $count ?></span> resultats</span>)</h3>
                <?php
        } ?>

        <div class="pull-right" style="margin-top:10px">
                    <select id ="multiselectmenu" multiple="multiple" class="multiselect">
                                            <?php foreach($services as $service){?>
											<option>  
                                                <?php echo($service->nom);?>
                                            </option>
                                            <?php } ?>
                    </select>
        </div>
        
        
        <?php if ($_SESSION['type_user'] == 'admin' && !MOBILE) { ?>
            <div class="pull-right" style="margin-top:10px">
                <span class=" text-center">
        <button data-toggle="modal" data-target="#squarespaceModalinsertclient" class="update_pro btn btn-primary"><i
                    class="fa fa-plus"></i> Ajouter un client</button>
                </span>
            </div>


        <?php } ?>
    </div>
</div>
<hr>


<?php
//je transforme les pros en array pour le dataTable
$items = array();
$i = 0;
foreach ($clients as $client) {
    array_push($items, $client);
}

?>

<table id="dataTable_clients" class="display responsive no-wrap table table-condensed" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th></th>
        <th><i id="showFavori" class="fa fa-star favStar0"></i></th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Adresse</th>
        <th class="desktop">CP</th>
        <th class="desktop">Ville</th>
        <th>Services</th>
        <th>Mail</th>
        <th>Téléphone</th>
        <th>Commentaire</th>
        <th>Options</th>

    </tr>
    </thead>
    <tfoot>
    <tr>
        <th></th>
        <th></th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Adresse</th>
        <th>CP</th>
        <th>Ville</th>
        <th>Services</th>
        <th>Mail</th>
        <th>Téléphone</th>
        <th>Commentaire</th>
        <th>Options</th>
    </tr>
    </tfoot>

</table>


<?php
if ($_SESSION['type_user'] == 'admin') {
    //le modal qui permet de mettre à jour le partenaire
    include('includes/modal_maj_client.php');
    include('includes/modal_insert_client.php');
}
include('includes/modal_maj_contacts.php');

?>

