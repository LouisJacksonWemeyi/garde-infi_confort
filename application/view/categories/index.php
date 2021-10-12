<script src="<?= URL ?>js/categories.js"></script>

<div class="container">
    <h1 class="displayInline">Gestion des catégories</h1>
    <span class="pull-right">
         <button data-toggle="modal" data-target="#squarespaceModalinsertcategorie" class="update_pro btn btn-primary center-block"><i class="fa fa-plus"></i> Ajouter une catégorie</button>
    </span>
    </div>
    <hr>
<div class="container">
    <!-- add song form -->
    <div class="box">



        <?php
        //je transforme les pros en array pour le dataTable
        $items = array();
        $i = 0;
        foreach ($allCategories as $categorie)
        {
            array_push($items,$categorie);
        }
        ?>

        <script type="text/javascript">
            // pass PHP variable declared above to JavaScript variable
            var ar = <?php echo json_encode($items, JSON_FORCE_OBJECT) ?>;
        </script>

        <table id="categories" class="display" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th class="text-center">
                    <div class="row">
                        <div class="col-md-10">
                            Catégorie
                        </div>
                    </div>
                </th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th class="text-center">
                    <div class="row">
                        <div class="col-md-10">
                            Catégorie
                        </div>
                    </div>
                </th>
            </tr>
            </tfoot>
            <tbody>
            <?php /*
            //permet de mettre l'indice de l'array afin de povuoir le retrouver pour avoir les informations à mettre dans le form bootstrap.
            $i= 0; ?>
            <tbody id="tbody_categories">

            <?php foreach ($allCategories as $categorie) { ?>
                <!-- Ajout ID pour chaque ligne -->
                <tr id="tr_<?= $categorie->id ?>">
                    <td class="text-center">
                        <div class="row">
                            <div class="col-md-10" id="td_<?= $categorie->id ?>">
                                <?php if (isset($categorie->nom_categorie)) echo htmlspecialchars($categorie->nom_categorie, ENT_QUOTES, 'UTF-8'); ?>
                            </div>
                            <div class="col-md-2">
                                <button id="btnEdit_<?= $categorie->id ?>" data-toggle="modal" data-target="#squarespaceModalupdatecategorie" class="update_pro btn btn-default"><i class="fa fa-pencil"></i></button>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php $i++; } ?>

                */ ?>
            </tbody>
        </table>

        <?php
        //le modal qui permet de mettre à jour le partenaire
        include('includes/modal_maj_categorie.php');
        include('includes/modal_insert_categorie.php');
        ?>

    </div>

</div>

