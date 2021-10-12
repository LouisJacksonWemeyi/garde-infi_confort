<!-- line modal -->
<div class="modal fade" id="squarespaceModalUpdateClient" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                            class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">Mettre à jour les informations de <span
                            id="nom_description_client"></span></h3>
            </div>
            <span>
			
            <!-- content goes here -->
			<form id="form_update_client">
                
                <div class="form-group col-md-6">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="InputNomClient" name="nom" placeholder="Nom">

                </div>
                <div class="form-group col-md-6">
                    <label for="prenom">Prénom</label>
                    <input type="text" class="form-control" id="InputPrenomClient" name="prenom" placeholder="Prénom">
                </div>
                <div class="form-group col-md-4">
                    <label for="adresse">Adresse</label>
                    <input type="text" class="form-control" id="InputAdresseClient" name="adresse"
                           placeholder="Adresse">
                </div>
                <div class="form-group col-md-4">
                    <label for="numero">Numéro</label>
                    <input type="text" class="form-control" id="InputNumeroClient" name="numero" placeholder="Numéro">
                </div>
                <div class="form-group col-md-4">
                    <label for="boite">Boîte</label>
                    <input type="text" class="form-control" id="InputBoiteClient" name="boite" placeholder="Boite">
                </div>
                <div class="form-group form-group col-md-4">
                    <label for="cp">Code postal</label>
                    <input type="text" class="form-control" id="InputCPClient" name="cp" placeholder="Code postal">
                </div>
                <div class="form-group form-group col-md-4">
                    <label for="exampleInputVille">Ville</label>
                    <select name="ville" id="InputVilleClient" class="form-control"></select>
                </div>
                
                <div class="form-group form-group col-md-6">
                    <label for="mail">Email address</label>
                    <input type="text" class="form-control" id="InputEmailClient" name="mail" placeholder="Email">
                </div>
                <div class="form-group form-group col-md-6">
                    <label for="telephone">Téléphone</label>
                    <input type="text" class="form-control" id="InputTelephoneClient" name="telephone"
                           placeholder="Téléphone">
                </div>
                
                
                
                <div class="form-group col-md-12">
                    <label for="commentaire">Commentaire</label>
                    <textarea class="form-control" id="InputCommentaireClient" name="commentaire"
                              style="min-width: 100%"></textarea>
                </div>
                <?php foreach ($services as $service) : ?>
                    <div class="col-md-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"
                                       name="services_gic[]" id="edit_service_<?=$service->id?>"
                                       value="<?= $service->id ?>">
                                <?= $service->nom ?>
                                </label>
                        </div>

                    </div>
                <?php endforeach; ?>
                <!--				<div class="form-group col-md-3">-->
                <!--                    <label for="commentaire">Infirmière</label>-->
                <!--                    <input type="checkbox" name="services_gic" value="2">-->
                <!--                </div>-->
                <!--				<div class="form-group col-md-3">-->
                <!--                    <label for="commentaire">Pédicure</label>-->
                <!--                    <input type="checkbox" name="services_gic" value="3">-->
                <!--                </div>-->
                <!--				<div class="form-group col-md-3">-->
                <!--                    <label for="commentaire">Garde-malade</label>-->
                <!--                    <input type="checkbox" name="services_gic" value="4">-->
                <!--                </div>-->

                <div class="form-group">
                    <input type="hidden" class="form-control" id="InputIdCacheClient" name="id">
                </div>

                <button class="btn btn-default"
                        id="btn_form_update_client">Mettre à jour les informations du client</button>
                <span id="result"></span>
            </form>


        </div>
        <!--<div class="modal-footer">
            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                </div>
                <div class="btn-group btn-delete hidden" role="group">
                    <button type="button" id="delImage" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Delete</button>
                </div>

            </div>
        </div>-->
    </div>
</div>
</div>


</div>
</div>