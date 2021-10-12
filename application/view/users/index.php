<script src="<?= URL ?>js/users.js"></script>


<div class="container">
    <div class="row">
    <h1 class="displayInline">Gestion des utilisateurs</h1>
    <div class="pull-right">
        <div class="checkbox">
            <label><input type="checkbox" id="checkActif"> Afficher les non actifs</label>
        </div>
        <button data-toggle="modal" data-target="#squarespaceModalinsertuser" class="delete_user btn btn-primary center-block"><i class="fa fa-plus"></i> Ajouter un utilisateur</button>
    </div>
    </div>
</div>
<hr>
<div class="container">
    <!-- add song form -->
    <div class="box">
        <table id="users" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Login</th>
                <th>Actif ?</th>
                <th>Droits d'accès</th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Login</th>
                <th>Actif ?</th>
                <th>Droits</th>
                <th></th>
            </tr>
        </tfoot>
        <tbody>
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
