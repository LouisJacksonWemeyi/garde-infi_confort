<!-- line modal -->
<div class="modal fade" id="squarespaceModalinsertuser" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h3 class="modal-title" id="lineModalLabel">Ajout d'un nouvel utilisateur</h3>
		</div>
		<span>
			
            <!-- content goes here -->
			<form id="form_insert_user">
              <div class="form-group col-md-6">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="exampleInputNom" name="nom" placeholder="Nom">
                
              </div>
              <div class="form-group col-md-6">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" id="exampleInputPrenom" name="prenom" placeholder="Prénom">
              </div>
              <div class="form-group col-md-6">
                <label for="adresse">Login</label>
                <input type="text" class="form-control" id="exampleInputLogin" name="login" placeholder="Choississez un login, l'email est conseillé">
              </div>
              <div class="form-group col-md-6">
                <label for="adresse">Mot de passe</label>
                <input type="password" class="form-control" id="exampleInputPassword" name="password" placeholder="Choisissez un mot de passe">
              </div>
              <div class="form-group col-md-6" id="exampleInputActif">
                <label for="numero">Actif</label>
                
                <select name="actif">
                    <option value="1">Compte activé</option>
                    <option value="0">Compte déasactivé</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="boite">Admin ou utilisateur ?</label>
                <select name="type_user" id="exampleInputType_user">
                    <option value="admin">Admin</option>
                    <option value="user">Utilisateur</option>
                </select>
              </div>
              
              <button class="btn btn-default" id="btn_form_insert">Insrer le nouvel utilisateur</button>
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