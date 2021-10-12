<!-- line modal -->
<div class="modal fade" id="squarespaceModalupdatecategorie" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h3 class="modal-title" id="lineModalLabel">Mettre à jour la catégorie <span id="nom_description"></span></h3>
		</div>
		<span>
			
            <!-- content goes here -->
			<form id="form_update_categorie">
              <div class="form-group col-md-6">
                <label for="nom">Nom de la catégorie</label>
                <input type="text" class="form-control" id="exampleInputNomCategorie" name="nom" placeholder="Nom de la catégorie">
              </div>
							<div class="form-group">
                <input type="hidden" class="form-control" id="exampleInputIdCacheCat" name="id">
              </div>
              
              
              <button class="btn btn-default" id="btn_form_update">Mettre à jour les informations de cette catégorie</button>
              <span id="result_update_cat"></span>
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