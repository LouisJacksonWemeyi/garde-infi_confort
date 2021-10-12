<div class="container">
    <h1>Gestion des catégories</h1>
    
    
    <!-- add song form -->
    <div class="box">
    
        
    <span>
         <button data-toggle="modal" data-target="#squarespaceModalinsertcategorie" class="update_pro btn btn-primary center-block">Ajouter une catégorie</button>
    </span>
        
     <?php
        //je transforme les pros en array pour le dataTable
        $items = array();
    
        $i = 0;
        foreach ($categories as $categorie)
        {
            array_push($items,$categorie);
        }
        
        
        /*
         *------------------       IMPORTANT dataTAble.js        ------------------
         *DD le 27/08/2017 : On est obligé d'avoir le nombre identique de td dans tbody, tfooter et tbody, autrmeent, ça plaante !!!!  
        */
     ?>
     
     <script type="text/javascript">
        // pass PHP variable declared above to JavaScript variable
        var ar = <?php echo json_encode($items, JSON_FORCE_OBJECT) ?>;
     </script>   
        
        <table id="categories" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Suppression</th>
                <th>Mise à jour</th>
                
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nom</th>
                <th>Suppression</th>
                <th>Mise à jour</th>
                
                
            </tr>
        </tfoot>
        <?php
        //permet de mettre l'indice de l'array afin de povuoir le retrouver pour avoir les informations à mettre dans le form bootstrap.
        $i= 0; ?>
        <tbody id="tbody_categories">
        
        <?php foreach ($categories as $categorie) { ?>
                <tr>
                    
                    <td><?php if (isset($categorie->nom_categorie)) echo htmlspecialchars($categorie->nom_categorie, ENT_QUOTES, 'UTF-8'); ?></td>
                    
                    <td>
                    
                         
                            
                            <button id="<?php echo $categorie->id; ?>" data-toggle="modal" class="supprimer_categorie#<?php echo $categorie->id; ?> btn btn-primary center-block">Supprimer</button>
                        </td>
               
                        <td>
                            
                                <button id="<?php echo $i; ?>" data-toggle="modal" data-target="#squarespaceModalupdatecategorie" class="update_pro btn btn-primary center-block">Editer</button>
                            
                        </td>
                    
                    
                </tr>
            <?php $i++; } ?>
        
            
        </tbody>
    </table>
        
        <?php
            //le modal qui permet de mettre à jour le partenaire
            include('includes/modal_maj_categorie.php');
            include('includes/modal_insert_categorie.php');
        ?>
        
    </div>
    
    </div>
</div>
