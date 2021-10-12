<!-- Modal -->
<div id="modal_maj_contacts" class="modal modal- fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Personnes de contact de <span id="nom-client-header"></span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php if($_SESSION['type_user'] == 'admin' && !MOBILE) : ?>
                        <button id="add_contact_btn" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i> Ajouter
                        </button>
                        <?php endif; ?>
                        <div class="table-responsive">
                            <table class="table " id="table_contacts">
                                <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Téléphone</th>
                                    <th>Mail</th>
                                    <th>Commentaire</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <?php if ($_SESSION['type_user'] == 'admin' && !MOBILE) : ?>

                            <form id="add_contact_form" class="hide">
                                <div class="form-group col-md-6" id="group-nom">
                                    <label for="contac_nom" class="control-label">Nom</label>
                                    <input type="text" id="contac_nom" name="contact_nom" class="form-control" required>
                                    <span class="help-block hide" id="help-nom">Veuillez spécifier un nom</span>
                                </div>
                                <div class="form-group col-md-6" id="group-prenom">
                                    <label for="contac_prenom" class="control-label">Prénom</label>
                                    <input type="text" id="contac_prenom" name="contact_prenom" class="form-control" required>
                                    <span class="help-block hide" id="help-prenom">Veuillez spécifier un prénom</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="contac_tel">Téléphone</label>
                                    <input type="text" id="contac_tel" name="contact_tel" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="contac_mail">E-mail</label>
                                    <input type="text" id="contac_mail" name="contact_mail" class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="contac_com">Commentaire</label>
                                    <textarea id="contac_com" name="contact_com" class="form-control"></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <button type="button" id="contact_save"
                                            class="btn btn-success col-md-12"><i
                                                class="fa fa-save"></i> Enregistrer le nouveau contact</button>
                                </div>
                                <input type="hidden" id="contac_cid">
                            </form>
                            <form id="edit_contact_form" class="hide">
                                <div class="form-group col-md-6">
                                    <label for="edit_contac_nom" class="control-label">Nom</label>
                                    <input type="text" id="edit_contac_nom" name="contact_nom" class="form-control">
                                    <span class="help-block" id="help-contac-nom" style="display:none">Veuillez spécifier un nom</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="edit_contac_prenom" class="control-label">Prénom</label>
                                    <input type="text" id="edit_contac_prenom" name="contact_prenom"
                                           class="form-control">
                                    <span class="help-block" id="help-contac-prenom" style="display:none">Veuillez spécifier un prénom</span>

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="edit_contac_tel">Téléphone</label>
                                    <input type="text" id="edit_contac_tel" name="contact_tel" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="edit_contac_mail">E-mail</label>
                                    <input type="text" id="edit_contac_mail" name="contact_mail" class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="edit_contac_com">Commentaire</label>
                                    <textarea id="edit_contac_com" name="contact_com" class="form-control"></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <button type="button" id="contact_update_btn"
                                            class="btn btn-success col-md-12"><i
                                                class="fa fa-save"></i> Enregistrer les modifications</button>
                                </div>
                            </form>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-default" id="btnCloseContact" data-dismiss="modal">Fermer</button>

        </div>

    </div>
</div>