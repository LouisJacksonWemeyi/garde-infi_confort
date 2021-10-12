<?php

namespace Mini\Controller;

use Mini\Model\Professionnel;
//use Mini\Controller\Categories
//DD: j'inclus le model Categorie pour pouvoir créer un objet de type Categorie
use Mini\Model\Categorie;
use Mini\Model\FavoriPro;
use Mini\Model\CP;

class ProfessionnelsController {
    
    public function index() {
        // Si $_SESSION n'existe pas (si non connecté), redirection sur la page de login
        session_start();
        if(!isset($_SESSION['connected']))
        {
            header('Location: ' . URL );
        }

        $professionnel = new Professionnel();

        //je récupère les catégories pour les utilises dans les formulaires pro (insertion et update)
        $categories = new Categorie();
        $allCategories = $categories->getAllCategories();


        // Recupere la categorie et la region, si existantes
        $cat = (isset($_GET['cat'])) ? $_GET['cat'] : '';
        $reg = (isset($_GET['reg'])) ? $_GET['reg'] : '';

        // Recup favoris
        $favs = new FavoriPro();
        $favoris = $favs->getAllFavoris($cat, $reg, $_SESSION['id']);

        // Construit le titre a afficher
        if ($cat != '') {
            switch ($reg) {
                case '1':
                    $title = $categories->getCategorie($_GET['cat'])->nom_categorie . " - BXL";
                    break;
                case '2':
                    $title = $categories->getCategorie($_GET['cat'])->nom_categorie . " - BW";
                    break;
                default :
                    $title = $categories->getCategorie($_GET['cat'])->nom_categorie;
                    break;
            }
        } else {
            switch ($reg) {
                case '1':
                    $title = "Tous les prestataires de BXL";
                    break;
                case '2':
                    $title = "Tous les prestataires du BW";
                    break;
                default :
                    $title = 'Tous les prestataires';
                    break;
            }
        }

        $professionnels = $professionnel->getAllProfessionnels($cat, $reg);
        $count = $professionnel->count($cat, $reg)->nbre;


        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require APP . 'view/_templates/header.php';
        require APP . 'view/professionnels/index.php';
        //si je ne mets pas cette ligne, ma déclarartion du fichier js ne se fera pas, ajax ne fonctionnera donc pas
        require APP . 'view/_templates/footer.php';

    }
    
    public function deleteProfessionnels($professionnel_id) {
        // if we have an id of a song that should be deleted
        if (isset($professionnel_id)) {

            // Delete si favori
            $fav = new FavoriPro();
            $fav->deleteFavoriPro($professionnel_id);

            $professionnel = new Professionnel();
            $professionnel->deleteProfessionnel($professionnel_id);
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
    }

    public function addFavori() {
        session_start();
        $favs = new FavoriPro();
        $favoris = $favs->addFavori($_SESSION['id'], $_POST['pro']);
    }

    public function deleteFavori() {
        session_start();
        $favs = new FavoriPro();
        $favoris = $favs->deleteFavori($_SESSION['id'], $_POST['pro']);
    }

    public function getNomVille() {
        $cp = new CP();
        $code = $_POST['cp'];
        if ($cp->count($code)->nb == 0) {
            echo 0;
        } else {
            echo json_encode($cp->getVille($code));
        }
    }

    public function getProJson($cat, $reg) {
        session_start();
        // Recup pro
        $pro = new Professionnel();
        $pros = $pro->getAllProfessionnels(trim($cat), trim($reg));
        // Recup favoris
        $favs = new FavoriPro();
        $favoris = $favs->getAllFavoris(trim($cat), trim($reg), $_SESSION['id']);
        $favs = array();
        foreach ($favoris as $fav) {
            array_push($favs, $fav->id_pro);
        }

        $tabJson = [];

        foreach ($pros as $p) {
            $p->favori = (in_array($p->id, $favs)) ? 1 : 0;
        }

        $json_data = array(
            "draw" => intval($_REQUEST['_']),
            "recordsTotal" => intval(count($pros)),
            "recordsFiltered" => intval(count($pros)),
            "data" => $pros
        );
        echo json_encode($json_data);
    }
}

?>