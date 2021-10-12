<!-- line modal -->
<div class="modal fade" id="squarespaceModalinsertpro" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h3 class="modal-title" id="lineModalLabel">Insertion d'un nouveau prestataire</h3>
		</div>
		<span>
			
            <!-- content goes here -->
			<form id="form_insert_pro">
              <div class="form-group col-md-6">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="exampleInputNom" name="nom" placeholder="Nom">
                
              </div>
              <div class="form-group col-md-6">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" id="exampleInputPrenom" name="prenom" placeholder="Prénom">
              </div>
              <div class="form-group col-md-4">
                <label for="adresse">Adresse</label>
                <input type="text" class="form-control" id="exampleInputAdresse" name="adresse" placeholder="Adresse">
              </div>
              <div class="form-group col-md-4">
                <label for="numero">Numéro</label>
                <input type="text" class="form-control" id="exampleInputNumero" name="numero" placeholder="Numéro">
              </div>
              <div class="form-group col-md-4">
                <label for="boite">Boîte</label>
                <input type="text" class="form-control" id="exampleInputBoite" name="boite" placeholder="Boite">
              </div>
              <div class="form-group form-group col-md-6">
                <label for="cp">Code postal</label>
                <input type="text" class="form-control" id="exampleInputCP" name="cp" placeholder="Code postal">
              </div>
              <div class="form-group form-group col-md-6">
                <label for="exampleInputVille">Ville</label>
                <input type="text" class="form-control" id="exampleInputVille" name="ville" placeholder="Ville">
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
                <input type="text" class="form-control" id="exampleInputInami" name="inami" placeholder="Numéro INAMI">
              </div>  
              <div class="form-group form-group col-md-6">
                <label for="tva">TVA</label>
                <input type="text" class="form-control" id="exampleInputTVA" name="tva" placeholder="Numéro de TVA">
              </div>
              <div class="form-group">
                <label for="disponibiite">Disponibilité</label>
                <input type="text" class="form-control" id="exampleInputDisponibilite" name="disponibilite" placeholder="Disponibilité">
              </div>
              <div class="form-group">
                <label for="commentaire">Commentaire</label>
                <textarea class="form-control" id="exampleInputCommentaire" name="commentaire" style="min-width: 100%"></textarea>
              </div>  
              <div class="form-group">
                <input type="hidden" class="form-control" id="exampleInputIdCache" name="id">
              </div>
              
              <button class="btn btn-default" id="btn_form_insert">Insrer le nouveau prestataire</button>
              <span id="result_insert"></span>
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