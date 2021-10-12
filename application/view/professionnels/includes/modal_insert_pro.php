<!-- line modal -->
<div class="modal fade" id="squarespaceModalinsertpro" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">Insertion d'un nouveau prestataire</h3>
            </div>
            <!-- content goes here -->
            <form id="form_insert_pro">
                <div class="form-group col-md-12">
                    <label for="nom">Profession<span class="rouge"> * </span></label>

                    <select name="metier" id="sel_metier_insert_pro">
                        <option value="-1">Veuillez choisir une profession (obligatoire)</option>
                        <?php foreach ($categories as $key => $value)
                        { ?>

                            <option value="<?php echo $value->id; ?>"><?php echo $value->nom_categorie; ?></option>
                        <?php } ?>

                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label for="societe">Nom de la société</label>
                    <input type="text" class="form-control" id="AddNomSociete" name="nomSociete" placeholder="Nom de la société">
                </div>
                <div class="form-group col-md-6">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="addInputNom" name="nom" placeholder="Nom">

                </div>
                <div class="form-group col-md-6">
                    <label for="prenom">Prénom</label>
                    <input type="text" class="form-control" id="addInputPrenom" name="prenom" placeholder="Prénom">
                </div>
                <div class="form-group col-md-4">
                    <label for="adresse">Adresse</label>
                    <input type="text" class="form-control" id="addInputAdresse" name="adresse" placeholder="Adresse">
                </div>
                <div class="form-group col-md-4">
                    <label for="numero">Numéro</label>
                    <input type="text" class="form-control" id="addInputNumero" name="numero" placeholder="Numéro">
                </div>
                <div class="form-group col-md-4">
                    <label for="boite">Boîte</label>
                    <input type="text" class="form-control" id="addInputBoite" name="boite" placeholder="Boite">
                </div>
                <div class="form-group form-group col-md-4">
                    <label for="cp">Code postal</label>
                    <input type="text" class="form-control" id="addInputCP" name="cp" placeholder="Code postal">
                </div>
                <div class="form-group form-group col-md-4">
                    <label for="exampleInputVille">Ville</label>
                    <select name="ville" id="addSelectVille" class="form-control"></select>
                </div>
                <div class="form-group form-group col-md-4">
                    <label for="exampleInputRegion">Région* (BW ou BXL)</label>
                    <select name="region" id="sel_region">
                        <option value="-1">Choisissez une région</option>
                        <option value="1">Bruxelles</option>
                        <option value="2">Brabant Wallon</option>
                    </select>
                </div>
                <div class="form-group form-group col-md-6">
                    <label for="mail">Email address</label>
                    <input type="text" class="form-control" id="exampleInputEmail" name="mail" placeholder="Email">
                </div>
                <div class="form-group form-group col-md-6">
                    <label for="telephone">Téléphone</label>
                    <input type="text" class="form-control" id="exampleInputTelephone" name="telephone" placeholder="Téléphone">
                </div>
                <div class="form-group form-group col-md-6">
                    <label for="inami">INAMI</label>
                    <input type="text" class="form-control" id="exampleInputInamiAdd" name="inami" placeholder="Numéro INAMI">
                </div>
                <div class="form-group form-group col-md-6">
                    <label for="tva">TVA</label>
                    <input type="text" class="form-control" id="exampleInputTVA" name="tva" placeholder="Numéro de TVA">
                </div>
                <div class="form-group col-md-12">
                    <label for="disponibiite">Disponibilité</label>
                    <input type="text" class="form-control" id="exampleInputDisponibilite" name="disponibilite" placeholder="Disponibilité">
                </div>
                <div class="form-group col-md-12">
                    <label for="commentaire">Commentaire</label>
                    <textarea class="form-control" id="exampleInputCommentaire" name="commentaire" style="min-width: 100%"></textarea>
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" id="exampleInputIdCache" name="id">
                </div>

                <button class="btn btn-default" id="btn_form_insert">Insérer le nouveau prestataire</button>
                <span id="result_insert"></span>
            </form>


        </div>
    </div>
</div>
</div>


</div>
</div>