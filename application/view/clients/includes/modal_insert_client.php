<!-- line modal -->
<div class="modal fade" id="squarespaceModalinsertclient" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                            class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">Insertion d'un nouveau client</h3>
            </div>
            <span>
			
            <!-- content goes here -->
			<form id="form_insert_client">
                
                <div class="form-group col-md-6">
                    <label for="nom">Nom *</label>
                    <input type="text" class="form-control" id="exampleInputNom" name="nom" placeholder="Nom">

                </div>
                <div class="form-group col-md-6">
                    <label for="prenom">Prénom *</label>
                    <input type="text" class="form-control" id="exampleInputPrenom" name="prenom" placeholder="Prénom">
                </div>
                <div class="form-group col-md-4">
                    <label for="adresse">Adresse</label>
                    <input type="text" class="form-control" id="exampleInputAdresse" name="adresse"
                           placeholder="Adresse">
                </div>
                <div class="form-group col-md-4">
                    <label for="numero">Numéro</label>
                    <input type="text" class="form-control" id="exampleInputNumero" name="numero" placeholder="Numéro">
                </div>
                <div class="form-group col-md-4">
                    <label for="boite">Boîte</label>
                    <input type="text" class="form-control" id="exampleInputBoite" name="boite" placeholder="Boite">
                </div>
                <div class="form-group form-group col-md-4">
                    <label for="cp">Code postal</label>
                    <input type="text" class="form-control" id="exampleInputCP" name="cp" placeholder="Code postal">
                </div>
                <div class="form-group form-group col-md-4">
                    <label for="exampleInputVille">Ville</label>
                    <select name="ville" id="exampleInputVille" class="form-control"></select>
                </div>
                
                <div class="form-group form-group col-md-6">
                    <label for="mail">Email address</label>
                    <input type="text" class="form-control" id="exampleInputEmail" name="mail" placeholder="Email">
                </div>
                <div class="form-group form-group col-md-6">
                    <label for="telephone">Téléphone</label>
                    <input type="text" class="form-control" id="exampleInputTelephone" name="telephone"
                           placeholder="Téléphone">
                </div>
                
                <div class="form-group col-md-12">
                    <label for="commentaire">Commentaire</label>
                    <textarea class="form-control" id="exampleInputCommentaire" name="commentaire"
                              style="min-width: 100%"></textarea>
                </div>
                <!--Personnes de contact-->
                <div class="form-group col-md-12">
                    <label>Personnes de contact</label>
                    <button type="button" id="add_contact" class="btn btn-primary btn-xs">
                        <i class="fa fa-plus"></i>
                    </button>
                    <div id="contacts_list" class="hide">
                        <table class="table">
                            <tr>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Tel</th>
                            </tr>
                        </table>
                    </div>
                    <?php include('form_add_contact.php');?>
                </div>
                <div class="clearfix"></div>
                <!--Services-->
                <?php foreach ($services as $service) : ?>
                    <div class="col-md-6">
                        <div class="checkbox">
                        <label>
                            <input type="checkbox" name="services_gic[]" id="service_<?= $service->id ?>"
                                   value="<?= $service->id ?>">
                            <?= $service->nom ?>
                        </label>
                    </div>
                    </div>

                <?php endforeach; ?>
                <div class="clearfix"></div>
                <div class="form-group">
                    <input type="hidden" class="form-control" id="exampleInputIdCache" name="id">
                </div>
                <input type="hidden" id="contactIds" name="contactIds[]">

                <button class="btn btn-default" id="btn_form_insert_client">Insérer le nouveau client</button>
                <span id="result_insert"></span>
            </form>


        </div>
    </div>
</div>