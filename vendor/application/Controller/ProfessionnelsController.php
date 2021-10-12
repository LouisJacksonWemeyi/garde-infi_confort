<?php

    namespace Mini\Controller;
    
    use Mini\Model\Professionnel;
    //use Mini\Controller\Categories
    //DD: j'inclus le model Categorie pour pouvoir créer un objet de type Categorie
    use Mini\Model\Categorie;
    
    class ProfessionnelsController
    {
        public function index()
        {

            // Si $_SESSION n'existe pas (si non connecté), redirection sur la page de login
            session_start();
            if(!isset($_SESSION['connected'])) {
                header('Location: ' . URL );
            }


            $professionnel = new Professionnel();
            $cat = new Categorie();
            $les_cat = $cat->getAllCategories();
            
            $professionnels = $professionnel->getAllProfessionnels();
            
            
            
            
            
            // load views. within the views we can echo out $songs and $amount_of_songs easily
            require APP . 'view/_templates/header.php';
            require APP . 'view/professionnels/index.php';
            //si je ne mets pas cette ligne, ma déclarartion du fichier js ne se fera pas, ajax ne fonctionnera donc pas
            require APP . 'view/_templates/footer.php';
            
        }
        
        
        
        public function deleteProfessionnels($professionnel_id)
        {
            // if we have an id of a song that should be deleted
            if (isset($professionnel_id))
            {
                // Instance new Model (Song)
                $professionnel = new Professionnel();
                // do deleteSong() in model/model.php
                $professionnel->deleteProfessionnel($professionnel_id);
                //echo "id=> ".$professionnel_id;
                
            }
    
            // where to go after song has been deleted
            
            $professionnels = $professionnel->getAllProfessionnels();
            //print_r(json_encode($professionnels));
            echo json_encode($professionnels, JSON_FORCE_OBJECT);
            
        }
        
        public function updateProfessionnel($idpro)
        {
            //print_r($_POST);
            
            if (isset($idpro))
            {
                // Instance new Model (professionnel)
                //soit on met à jour un pro
                $pro = new Professionnel();
                if (isset($_POST['action']) && ($_POST['action'] == 'maj'))
                {
                    $pro = $pro->updatePro($idpro, $_POST['data_form_pro']);
                    echo "Mise à jour réussie...";
                    return false;
                    
                }
                //ou on affiche le formulaire du pro avec ses proproes informations
                else
                {
                    // do getSong() in model/model.php
                    $pro = $pro->getPro($idpro);    
                }
                
                
                
    
                // in a real application we would also check if this db entry exists and therefore show the result or
                // redirect the user to an error page or similar
    
                // load views. within the views we can echo out $song easily
                require APP . 'view/_templates/header.php';
                require APP . 'view/professionnels/edit.php';
                require APP . 'view/_templates/footer.php';
            }
        }
        
        public function addProfessionnel()
        {
            $params = array();
            //permet de transformer en array ce qu'on a reçu de js (seraialize)
            parse_str($_POST['data_form_insert_pro'], $params);
            
            $pro = new Professionnel();
            if (isset($_POST['action']) && ($_POST['action'] == 'add'))
            {
                $pro = $pro->addPro($params);
                echo "Insertion réussie...";
                return false;
                
            }
            //// if we have an id of a song that should be deleted
            //if (isset($_POST['nom_categorie']))
            //{
            //    // Instance new Model (Song)
            //    $categorie = new Categorie();
            //    // do deleteSong() in model/model.php
            //    
            //    $categorie->addCategorie($_POST['nom_categorie']);
            //    
            //}
            //
            //// where to go after song has been deleted
            //
            //$categories = $categorie->getAllProfessionnels();
            //$retour = '';
            //foreach ($categories as $categorie)
            //{
            //    $retour.= '<tr><td>';
            //    if (isset($categorie->nom_categorie)) $retour.= htmlspecialchars($categorie->nom_categorie, ENT_QUOTES, 'UTF-8');
            //    $retour.= '</td>';
            //    $retour.= '<td><button class="supprimer_categorie#'.$categorie->id.'"'. ' > Supprimer cette catégorie</button></td>';
            //    $retour.= '<td><button class="maj_categorie#'.$categorie->id.'"'. ' > Mettre à jour cette catégorie</button></td></tr>';
            //}
            
            
        }
        
    }

?>