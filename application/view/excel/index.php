<?php
/**
 * File : bd_gic / index.php
 * User : Matthieu SCHMIT
 * Date : 13/09/17
 * Time : 17:12
 */
?>
<script src="<?= URL ?>js/excel.js"></script>

<div class="container">
    <h1>Extraction Excel des prestataires et des clients</h1>

    <br>

    <form id="formExcel" action="" class="form-inline">
        <select class="form-control" name="selectExcel" id="selectExcel">
            <option selected disabled>Veuillez choisir une catégorie</option>
            <option value="cli_cli">Tous les clients</option>
            <option value="all_all">Tous les prestataires</option>
            <option value="all_2">Tous les prestataires - BW</option>
            <option value="all_1">Tous les prestataires - BX</option>
            <?php
            foreach ($allCategories as $cat) { ?>
                <option value="<?= $cat->id ?>_2"><?= $cat->nom_categorie ?> - BW</option>
                <option value="<?= $cat->id ?>_1"><?= $cat->nom_categorie ?> - BX</option>
            <?php } ?>
        </select>
        <button id="btnFormExcelGen" class="btn btn-default disabled"><i class="fa fa-cogs"></i> Générer</button>
        <button id="btnFormExcelDown" class="btn btn-default hidden"><i class="fa fa-download"></i> Télécharger</button>
    </form>
    <br>
    <h3 id="retourExcel"></h3>



</div>




