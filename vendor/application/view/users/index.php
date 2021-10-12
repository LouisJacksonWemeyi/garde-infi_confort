<div class="container">
    <h1>Gestion des utilisateurs</h1>
    <!--<h2>Cette page vous permet d'ajouter, supprimer et d'éditer les utilisateurs de votre base de données et de leur donner des droits différents...</h2>-->
    
    <?php
        //je transforme les pros en array pour le dataTable
        $items = array();
    
        $i = 0;
        foreach ($users as $user)
        {
            array_push($items,$user);
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
    
    <!-- add song form -->
    <div class="box">
    
        
    <span>
         <button data-toggle="modal" data-target="#squarespaceModalinsertuser" class="delete_user btn btn-primary center-block">Ajouter un utilisateur</button>
    </span>
        
        
        
        <table id="users" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Login</th>
                <th>Actif ?</th>
                <th>Droits d'accès</th>
                <th>Editer les utilisateurs</th>
                <th>Supprimer les utilisateurs</th>
                
                
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Login</th>
                <th>Actif ?</th>
                <th>Droits</th>
                <th>Editer</th>
                <th>Supprimer</th>
                
                
            </tr>
        </tfoot>
        <tbody>
        <?php
        //permet de mettre l'indice de l'array afin de povuoir le retrouver pour avoir les informations à mettre dans le form bootstrap.
        $i= 0; ?>
        <?php foreach ($users as $user) { ?>
                <tr>
                    
                    <td><?php if (isset($user->nom)) echo htmlspecialchars($user->nom, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($user->prenom)) echo htmlspecialchars($user->prenom, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($user->login)) echo htmlspecialchars($user->login, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($user->actif)) echo htmlspecialchars($user->actif, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($user->type_user)) echo htmlspecialchars($user->type_user, ENT_QUOTES, 'UTF-8'); ?></td>
                    
                        </td>
               
                        <td>
                            
                                <button id="<?php echo $i; ?>" data-toggle="modal" data-target="#squarespaceModalupdateuser" class="update_user btn btn-primary center-block">Editer</button>
                                
                            
                        </td>
                    <td>
                        <button id="<?php echo $user->id; ?>" data-toggle="modal" class="delete_user btn btn-primary center-block">Supprimer</button>
                    </td>
                    
                </tr>
            <?php $i++; } ?>
        
            
        </tbody>
    </table>
        
        <?php
            //le modal qui permet de mettre à jour le partenaire
            include('includes/modal_maj_user.php');
            include('includes/modal_insert_user.php');
        ?>
        
    </div>
    
    </div>
</div>
