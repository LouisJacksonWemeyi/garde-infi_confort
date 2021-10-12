<!-- line modal -->
<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">Mettre à jour les informations de <span id="nom_description"></span></h3>
            </div>
		<span>
			
            <!-- content goes here -->
			<form id="form_update_pro">
                <div class="form-group col-md-12">
                    <label for="nom">Profession</label>

                    <select name="metier" id="sel_metier">
                        <?php foreach ($categories as $key => $value)
                        { ?>

                            <option value="<?php echo $value->id; ?>"><?php echo $value->nom_categorie; ?></option>
                        <?php } ?>

                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label for="societe">Nom de la société</label>
                    <input type="text" class="form-control" id="updateNomSociete" name="nomSociete" placeholder="Nom de la société">
                </div>
                <div class="form-group col-md-6">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="updateInputNom" name="nom" placeholder="Nom">
                </div>
                <div class="form-group col-md-6">
                    <label for="prenom">Prénom</label>
                    <input type="text" class="form-control" id="updateInputPrenom" name="prenom" placeholder="Prénom">
                </div>
                <div class="form-group col-md-4">
                    <label for="adresse">Adresse</label>
                    <input type="text" class="form-control" id="updateInputAdresse" name="adresse" placeholder="Adresse">
                </div>
                <div class="form-group col-md-4">
                    <label for="numero">Numéro</label>
                    <input type="text" class="form-control" id="updateInputNumero" name="numero" placeholder="Numéro">
                </div>
                <div class="form-group col-md-4">
                    <label for="boite">Boîte</label>
                    <input type="text" class="form-control" id="updateInputBoite" name="boite" placeholder="Boite">
                </div>
                <div class="form-group form-group col-md-4">
                    <label for="cp">Code postal</label>
                    <input type="text" class="form-control" id="updateInputCP" name="cp" placeholder="Code postal">
                </div>
                <div class="form-group form-group col-md-4">
                    <label for="updateInputVille">Ville</label>
                    <select name="ville" id="updateInputVille" class="form-control"></select>
                </div>
                <div class="form-group form-group col-md-4">
                    <label for="exampleInputRegion">Région* (BW ou BXL)</label>
                    <select id="update_region" name="update_region">
                        <option value="1">Bruxelles</option>
                        <option value="2">Brabant Wallon</option>
                    </select>
                </div>
                <div class="form-group form-group col-md-6">
                    <label for="mail">Email address</label>
                    <input type="text" class="form-control" id="updateInputEmail" name="mail" placeholder="Email">
                </div>
                <div class="form-group form-group col-md-6">
                    <label for="telephone">Téléphone</label>
                    <input type="text" class="form-control" id="updateInputTelephone" name="telephone" placeholder="Téléphone">
                </div>
                <div class="form-group form-group col-md-6">
                    <label for="inami">INAMI</label>
                    <input type="text" class="form-control" id="updateInputInami" name="inami" placeholder="Numéro INAMI">
                </div>
                <div class="form-group form-group col-md-6">
                    <label for="tva">TVA</label>
                    <input type="text" class="form-control" id="updateInputTVA" name="tva" placeholder="Numéro de TVA">
                </div>
                <div class="form-group col-md-12">
                    <label for="disponibiite">Disponibilité</label>
                    <input type="text" class="form-control" id="updateInputDisponibilite" name="disponibilite" placeholder="Disponibilité">
                </div>
                <div class="form-group col-md-12">
                    <label for="commentaire">Commentaire</label>
                    <textarea class="form-control" id="updateInputCommentaire" name="commentaire" style="min-width: 100%"></textarea>
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" id="updateInputIdCache" name="id">
                </div>
                <button class="btn btn-default" id="btn_form_update">Mettre à jour les informations du prestataire</button>
                <span id="result"></span>
            </form>
        </div>
    </div>
</div>
</div>





</div>
</div>