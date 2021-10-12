<!-- line modal -->
<div class="modal fade" id="squarespaceModalinsertcategorie" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">Insertion d'une nouvelle catégorie</h3>
            </div>
            <form id="form_insert_cat">
                <div class="form-group col-md-12">
                    <label class="control-label" for="nom">Nom :</label>
                    <input type="text" name="nom" class="form-control" id="exampleInputNom" placeholder="Nom de la nouvelle catégorie">
                </div>
                <div class="form-group col-md-12">
                    <label class="control-label" for="inami">Besoin d'un n° INAMI ?</label>
                    <select class="form-control" id="addInputInami" name="inami">
                        <option value="1">Oui</option>
                        <option value="0" selected>Non</option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="hidden" class="form-control" id="exampleInputIdCache" name="id">
                </div>

                <button class="btn btn-default" id="btn_form_insert_cat">Insérer la nouvelle catégorie</button>
                <span id="result_add_cat"></span>
                <div></div>
            </form>
        </div>
    </div>
</div>
</div>
