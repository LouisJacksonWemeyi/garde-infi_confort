<?php

namespace Mini\Controller;

use Mini\Model\Categorie;
use Mini\Model\Client;
use Mini\Model\Contact;
use Mini\Model\Service;
use Mini\Model\FavoriCli;


class ClientsController {

    public function index() {

        // Si $_SESSION n'existe pas (si non connecté), redirection sur la page de login
        session_start();
        if (!isset($_SESSION['connected'])) {
            header('Location: ' . URL);
        }

        // Besoin pour le menu deroulant des prestataires
        $categories = new Categorie();
        $allCategories = $categories->getAllCategories();

        $client = new Client();
        $service = new Service();

        // Récupération des services pour l'affichage dans les modals
        $services = $service->getAllServices();

        // Récuparation des clients
        $clients = $client->getAllClients();
        $count = $client->count()->nbre;

        // Recup favoris
        $favs = new FavoriCli();
        $favoris = $favs->getAllFavoris($_SESSION['id']);


        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require APP . 'view/_templates/header.php';
        require APP . 'view/clients/index.php';
        //si je ne mets pas cette ligne, ma déclarartion du fichier js ne se fera pas, ajax ne fonctionnera donc pas
        require APP . 'view/_templates/footer.php';

    }

    public function deleteProfessionnels($client_id) {
        // if we have an id of a song that should be deleted
        if (isset($client_id)) {
            // Instance new Model (Song)
            $client = new Client();
            // do deleteSong() in model/model.php
            $client->deleteClient($client_id);
            //echo "id=> ".$professionnel_id;

        }

        // where to go after song has been deleted

        $clients = $client->getAllClients();
        //print_r(json_encode($professionnels));
        echo json_encode($clients, JSON_FORCE_OBJECT);

    }

    public function addFavori() {
        session_start();
        $favs = new FavoriCli();
        $favoris = $favs->addFavori($_SESSION['id'], $_POST['cli']);
    }

    public function deleteFavori() {
        session_start();
        $favs = new FavoriCli();
        $favoris = $favs->deleteFavori($_SESSION['id'], $_POST['cli']);
    }

    public function updateClient($idclient) {
        //print_r($_POST);

        if (isset($idclient)) {
            // Instance new Model (professionnel)
            //soit on met à jour un pro
            $client = new Client();
            $service = new Service();
            if (isset($_POST['action']) && ($_POST['action'] == 'maj')) {
                $client = $client->updateClient($idclient, $_POST['data_form_client']);

                // Mise à jour des services
                parse_str($_POST['data_form_client'], $p);
                // Récupération des ids services sélectionnés
                $selectedServices = isset($p['services_gic']) ? $p['services_gic'] : null;

                // Récupération des ids des services du client (en db)
                $clientServices = $service->getIdsByClient($idclient);
                // Si le service sélectionné se trouve dans les services du client, on l'enlève des deux tableaux
                if (!is_null($selectedServices)) {
                    foreach ($selectedServices as $idx => $select) {
                        if (in_array($select, $clientServices)) {
                            unset($selectedServices[$idx]);
                            unset($clientServices[array_search($select, $clientServices)]);
                        }
                    }
                    // Les services restant dans $selectedServices à ajouter

                    foreach ($selectedServices as $selectedService) {
                        $service->addService($idclient, $selectedService);
                    }

                }
                // Les services restant dans $clientServices sont ceux à supprimer
                foreach ($clientServices as $clientService) {
                    $service->deleteService($idclient, $clientService);
                }

                echo "Mise à jour réussie...";
                return false;

            } //ou on affiche le formulaire du pro avec ses proproes informations
            else {
                // do getSong() in model/model.php
                $client = $client->getClient($idclient);
            }

            // in a real application we would also check if this db entry exists and therefore show the result or
            // redirect the user to an error page or similar

            // load views. within the views we can echo out $song easily
            require APP . 'view/_templates/header.php';
            require APP . 'view/professionnels/edit.php';
            require APP . 'view/_templates/footer.php';
        }
    }

    public function addClient() {
        $params = array();
        //permet de transformer en array ce qu'on a reçu de js (seraialize)
        parse_str($_POST['data_form_insert_client'], $params);

        $client = new Client();
        if (isset($_POST['action']) && ($_POST['action'] == 'add')) {
            $clientId = $client->addClient($params);
            $service = new Service();
            $contact = new Contact();

            // Insertion des services
            // Insertion des services dans la table clients_has_services_gic
            if (isset($params['services_gic']) && !empty($params['services_gic'])) {

                foreach ($params['services_gic'] as $serviceId) {
                    // Insertion du/des service(s)
                    $service->addService($clientId, $serviceId);
                }
            }
            $contactIds = explode(',', $params['contactIds'][0]);

            // Insertion des personnes de contact
            if (!empty($contactIds) && $contactIds[0] != '') {
                foreach ($contactIds as $contactId) {
                    $contact->addClientContact($clientId, $contactId);
                }
            }

            echo "Insertion réussie...";
            return false;

        }
    }

    public function deleteClients($client_id) {
        // if we have an id of a song that should be deleted
        if (isset($client_id)) {
            // Instance new Model (Song)
            $client = new Client();
            $service = new Service();
            $contact = new Contact();
            $favori = new FavoriCli();

            $service->deleteClientServices($client_id);
            $contact->deleteClientContacts($client_id);
            $favori->deleteFavoriCli($client_id);

            $client->deleteClient($client_id);
            //echo "id=> ".$professionnel_id;


        }

        // where to go after song has been deleted

        $clients = $client->getAllClients();
        //print_r(json_encode($professionnels));
        echo json_encode($clients, JSON_FORCE_OBJECT);

    }

    public function getClientsJson() {
        session_start();
        $client = new Client();
        $tabJson = [];
        $clients = $client->getAllClients();
        
        // Recup favoris
        $favs = new FavoriCli();
        $favoris = $favs->getAllFavoris($_SESSION['id']);

        // error_log("favoris : " . print_r($favoris, true));

        $favs = array();
        foreach ($favoris as $fav) {
            array_push($favs, $fav->id_cli);
        }

        // error_log("favs : " . print_r($favs, true));

        foreach ($clients as $c) {
            $c->favori = (in_array($c->id, $favs)) ? 1 : 0;
        }

        $json_data = array(
            "draw" => intval($_REQUEST['_']),
            "recordsTotal" => intval(count($clients)),
            "recordsFiltered" => intval(count($clients)),
            "data" => $clients
        );
        //console.log($json_data);
        echo json_encode($json_data);
    }
}

?>