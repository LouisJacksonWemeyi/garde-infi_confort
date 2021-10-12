<?php print_r($_SESSION); ?>


<div class="container">
    <h1>Gestion des professionnels</h1>
    <span>
         <button id="<?php echo $i; ?>" data-toggle="modal" data-target="#squarespaceModalinsertpro" class="update_pro btn btn-primary center-block">Ajouter un prestataire</button>
    </span>
    <?php
        //je transforme les pros en array pour le dataTable
        $items = array();
    
        $i = 0;
        foreach ($professionnels as $professionnel)
        {
            array_push($items,$professionnel);
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
     
     <script>
        //alert( ar[0].nom );
     </script>
    
    
    <table id="example" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Profession</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Adresse</th>
                <th>Mail</th>
                <th>Téléphone</th>
                <th>Disponibilité</th>
                <th>commentaire</th>
                <th>Supprimer le pro</th>
                <th>Mettre à jour le pro</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Profession</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Adresse</th>
                <th>Mail</th>
                <th>Téléphone</th>
                <th>Disponibilité</th>
                <th>commentaire</th>
                <th>Supprimer le pro</th>
                <th>Mettre à jour le pro</th>
                
            </tr>
        </tfoot>
        <tbody>
        <?php
        //permet de mettre l'indice de l'array afin de povuoir le retrouver pour avoir les informations à mettre dans le form bootstrap.
        $i= 0; ?>
        <?php foreach ($items as $key => $value)
        { ?>
            
            <tr>
                <td><?php if (isset($value->nom_categorie)) echo htmlspecialchars($value->nom_categorie, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php if (isset($value->nom)) echo htmlspecialchars($value->nom, ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo $value->prenom; ?></td>
                <td><?php echo $value->adresse . ' ' .$value->numero. ' /'.$value->boite. ' '.$value->cp.' '.$value->ville; ?></td>
                <td><?php echo $value->mail; ?></td>
                <td><?php echo $value->telephone; ?></td>
                <td><?php echo $value->disponibilite; ?></td>
                <td><?php echo $value->commentaire; ?></td>
                
                <td>
                    <div
                         class="center"> <button class="<?php echo 'supprimer_pro#'.$value->id; ?> btn btn-primary center-block ">Supprimer</button>
                    </div>
                </td>
       
                <td>
                    <div
                         class="center"> <button id="<?php echo $i; ?>" data-toggle="modal" data-target="#squarespaceModal" class="update_pro btn btn-primary center-block">Editer</button>
                    </div>
                </td>
                
                
                
            </tr>
        <?php $i++; } ?>
        
            
        </tbody>
    </table>
    
    <?php
        //le modal qui permet de mettre à jour le partenaire
        include('includes/modal_maj_pro.php');
        include('includes/modal_insert_pro.php');
    ?>
    


</div>

