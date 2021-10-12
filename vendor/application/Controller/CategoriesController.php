<?php

    namespace Mini\Controller;
    
    use Mini\Model\Categorie;
    
    class CategoriesController
    {
        public function index()
        {

            // Si $_SESSION n'existe pas (si non connecté), redirection sur la page de login
            session_start();
            if(!isset($_SESSION['connected'])) {
                header('Location: ' . URL );
            }

            //je crée un objtet via le model
            $categorie = new Categorie();
            $categories = $categorie->getAllCategories();
            
            
            
            // load views. within the views we can echo out $songs and $amount_of_songs easily
            require APP . 'view/_templates/header.php';
            require APP . 'view/categories/index.php';
            //si je ne mets pas cette ligne, ma déclarartion du fichier js ne se fera pas, ajax ne fonctionnera donc pas
            require APP . 'view/_templates/footer.php';
            
        }
        
        public function deleteCategorie($categorie_id)
        {
            
            print_r($categorie_id);
            // if we have an id of a song that should be deleted
            if (isset($categorie_id))
            {
                // Instance new Model (Song)
                $categorie = new Categorie();
                // do deleteSong() in model/model.php
                $categorie->deleteCategorie($categorie_id);
                
            }
    
            // where to go after song has been deleted
            
            //$categories = $categorie->getAllCategories();
            //$retour = '';
            //foreach ($categories as $categorie)
            //{
            //    $retour.= '<tr><td>';
            //    if (isset($categorie->nom_categorie)) $retour.= htmlspecialchars($categorie->nom_categorie, ENT_QUOTES, 'UTF-8');
            //    $retour.= '</td>';
            //    $retour.= '<td><button class="supprimer_categorie#'.$categorie->id.'"'. ' > Supprimer cette catégorie</button></td>';
            //    $retour.= '<td><button class="maj_categorie#'.$categorie->id.'"'. ' > Mettre à jour cette catégorie</button></td></tr>';
            //}
            //
            //echo $retour;
        }
        
        public function updateCategorie()
        {
            $params = array();
            //permet de transformer en array ce qu'on a reçu de js (seraialize)
            parse_str($_POST['data_form_cat'], $params);
            // if we have an id of a song that should be deleted
            //print_r($params);
            //return false;
            if (isset($params['nom']))
            {
                // Instance new Model (Song)
                $categorie = new Categorie();
                // do deleteSong() in model/model.php
                
                $categorie->updateCategorie($params);
                
            }
    
            // where to go after song has been deleted
            
            $categories = $categorie->getAllCategories();
            $retour = '';
            foreach ($categories as $categorie)
            {
                $retour.= '<tr><td>';
                if (isset($categorie->nom_categorie)) $retour.= htmlspecialchars($categorie->nom_categorie, ENT_QUOTES, 'UTF-8');
                $retour.= '</td><td>';
                
                
                $retour.= '<button id="'.$categorie->id. '" data-toggle="modal" class="supprimer_categorie#'.$categorie->id. ' btn btn-primary center-block">Supprimer</button>';
                $retour.= '<td><button id="maj_categorie#'.$categorie->id.'"'. ' data-toggle="modal" data-target="#squarespaceModalupdatecategorie" class="update_pro btn btn-primary center-block" > Editer</button></td></tr>';
            }
            
            echo $retour;
        }
        
        public function addCategorie()
        {
            $params = array();
            //permet de transformer en array ce qu'on a reçu de js (seraialize)
            parse_str($_POST['data_form_insert_cat'], $params);
            //print_r($params);
            // if we have an id of a song that should be deleted
            if (isset($params['nom']))
            {
                // Instance new Model (Song)
                $categorie = new Categorie();
                // do deleteSong() in model/model.php
                
                $categorie->addCategorie($params['nom']);
                
            }
            
            echo "Catégorie correctement ajoutée";
    
            // where to go after song has been deleted
            
            //$categories = $categorie->getAllCategories();
            //$retour = '';
            //foreach ($categories as $categorie)
            //{
            //    $retour.= '<tr><td>';
            //    if (isset($categorie->nom_categorie)) $retour.= htmlspecialchars($categorie->nom_categorie, ENT_QUOTES, 'UTF-8');
            //    $retour.= '</td>';
            //    $retour.= '<td><button class="supprimer_categorie#'.$categorie->id.'"'. ' > Supprimer cette catégorie</button></td>';
            //    $retour.= '<td><button class="maj_categorie#'.$categorie->id.'"'. ' > Mettre à jour cette catégorie</button></td></tr>';
            //}
            
            //echo $retour;
        }
        
    }

?>