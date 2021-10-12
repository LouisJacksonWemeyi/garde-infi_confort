<!-- line modal -->
<div class="modal fade" id="squarespaceModalupdatecategorie" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">Mettre à jour la catégorie <span id="nom_description"></span></h3>
            </div>
            <form id="form_update_categorie">
                <div class="form-group col-md-12">
                    <label class="control-label" for="nom">Nom :</label>
                    <input type="text" name="nom" class="form-control" id="exampleInputNomCategorie" placeholder="Nom de la catégorie">
                </div>
                <div class="form-group col-md-12">
                    <label class="control-label" for="inami">Besoin d'un n° INAMI ?</label>
                    <select class="form-control" id="updateInputInami" name="inami">
                        <option value="1">Oui</option>
                        <option value="0" selected>Non</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" id="exampleInputIdCacheCat" name="id">
                </div>
                <button class="btn btn-default" id="btn_form_update">Mettre à jour les informations de cette catégorie</button>
                <span id="result_update_cat"></span>
            </form>
        </div>
    </div>
</div>
</div>



</div>
</div>