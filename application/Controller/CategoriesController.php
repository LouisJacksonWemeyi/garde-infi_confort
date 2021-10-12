<?php

namespace Mini\Controller;

use Mini\Model\Categorie;

class CategoriesController
{
    public function index()
    {

        // Si $_SESSION n'existe pas (si non connecté), redirection sur la page de login
        session_start();
        if (!isset($_SESSION['connected']) || isset($_SESSION['type_user']) && $_SESSION['type_user'] != 'admin') {
            header('Location: ' . URL);
        }

        //je crée un objtet via le model
        $categorie = new Categorie();
        $allCategories = $categorie->getAllCategories();
        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require APP . 'view/_templates/header.php';
        require APP . 'view/categories/index.php';
        //si je ne mets pas cette ligne, ma déclarartion du fichier js ne se fera pas, ajax ne fonctionnera donc pas
        require APP . 'view/_templates/footer.php';

    }

    public function deleteCategorie($categorie_id)
    {

        //print_r($categorie_id);
        // if we have an id of a song that should be deleted
        if (isset($categorie_id)) {
            // Instance new Model (Song)
            $categorie = new Categorie();
            // do deleteSong() in model/model.php
            $categorie->deleteCategorie($categorie_id);

        }
    }

    public function updateCategorie()
    {
        $params = array();
        //permet de transformer en array ce qu'on a reçu de js (seraialize)
        parse_str($_POST['data_form_cat'], $params);
        // if we have an id of a song that should be deleted
        //print_r($params);
        //return false;
        if (isset($params['nom'])) {
            // Instance new Model (Song)
            $categorie = new Categorie();
            // do deleteSong() in model/model.php
            $categorie->updateCategorie($params);
        }
    }

    public function addCategorie()
    {
        $params = array();
        //permet de transformer en array ce qu'on a reçu de js (seraialize)
        parse_str($_POST['data_form_insert_cat'], $params);
        // if we have an id of a song that should be deleted
        if (isset($params['nom'])) {
            // Instance new Model (Song)
            $categorie = new Categorie();
            // do deleteSong() in model/model.php

            $categorie->addCategorie($params['nom'], $params['inami']);

        }

        echo "Catégorie correctement ajoutée";
    }

    public function getCategoriesJSON()
    {
        $Cat = new Categorie();

        $categories = $Cat->getAllCategories();
        $jsonData = [
            "draw" => intval($_REQUEST['_']),
            "recordsTotal" => intval(count($categories)),
            "recordsFiltered" => intval(count($categories)),
            "data" => $categories
        ];

        echo json_encode($jsonData);
    }

    public function getIdInami() {
        $Cat = new Categorie();
        $categories = $Cat->getAllCategories();

        $catInami = array();
        foreach ($categories as $cat) {
            if ($cat->inami == '1') {
                array_push($catInami, $cat->id);
            }
        }

        echo json_encode($catInami);
    }

}

?>