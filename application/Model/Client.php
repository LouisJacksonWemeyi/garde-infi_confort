<?php

namespace Mini\Model;

use Mini\Core\Model;

class Client extends Model
{
    //il faut modifier cette requête pour l'adaptation du menu demandée ce matin...
    public function getAllClients()
    {
        $sql = "SELECT clients.id, nom, prenom, adresse, numero, boite, cp, ville, mail, telephone, commentaire"
            . " FROM clients "
            . "ORDER BY nom";

        $query = $this->db->prepare($sql);
        $query->execute();

        $clients = $query->fetchAll();

        $service = new Service();
        $contact = new Contact();

        foreach($clients as $cli) {
            $cli->services = $service->getByClientId($cli->id);
            $cli->contacts = $contact->getAllContacts($cli->id);
            $cli->servicesClient = $service->getByClientIdServices($cli->id); // ajout des services des clients par Jackson
        }

        return $clients;
    }

    /**
     * Compte le nbre de pro en fonction d'une categorie et/ou region precisee(s)
     * @param $cat la categorie OU ''
     * @param $reg la region OU ''
     */
    public function count()
    {
        $param = [];
        $sql = "SELECT count(*) as nbre"
            . " FROM clients ";


        $query = $this->db->prepare($sql);
        $query->execute($param);
        return $query->fetch();
    }


    public function getClient($idclient)
    {
        $sql = "SELECT id, nom, prenom, adresse, numero, boite, cp, ville, mail, telephone, inami, tva, disponibilite, commentaire, favoris
        FROM clients WHERE id = :idclient ";
        $query = $this->db->prepare($sql);
        $parameters = array(':idclient' => $idclient);
        $query->execute($parameters);
        return $query->fetch();
    }

    public function deleteClient($client_id)
    {
        $sql = "DELETE FROM clients WHERE id = :client_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':client_id' => $client_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
    }

    public function filtrePro($filtre)
    {
        parse_str($filtre, $array_filtre);
        print_r($array_filtre);
        $sql = "SELECT id, nom, prenom, adresse, numero, boite, cp, ville, mail, telephone, inami, tva, disponibilite, commentaire, favoris
        FROM professionnels
        WHERE nom LIKE :nom
        AND prenom LIKE :prenom
        AND adresse LIKE :adresse
        AND ville LIKE :ville
        AND cp LIKE :cp
        
        ORDER BY nom";

        $query = $this->db->prepare($sql);
        $parameters = array(':nom' => '%' . $array_filtre['filtre_nom'] . '%', ':prenom' => '%' . $array_filtre['filtre_prenom'] . '%', ':adresse' => '%' . $array_filtre['filtre_adresse'] . '%', ':ville' => '%' . $array_filtre['filtre_ville'] . '%', ':cp' => '%' . $array_filtre['filtre_cp'] . '%');
        //print_r($parameters);
        $query->execute($parameters);

        return $query->fetchAll();


    }

    public function updateProFav($id, $fav)
    {
        $sql = "UPDATE professionnels SET"
            . " favoris = :fav"
            . " WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':fav' => $fav, ':id' => $id));
    }

    public function updateClient($client_id, $form_data)
    {
        //le formulaire a été sérialisé en js, je le parse afin de le mettre dans un array (utiliser $array_data['champ'])
        parse_str($form_data, $array_data);

        //print_r($array_data);
        $sql = "UPDATE clients SET nom = :nom,
                                          prenom = :prenom,
                                          adresse = :adresse,
                                          numero = :numero,
                                          boite = :boite,
                                          cp = :cp,
                                          ville = :ville,
                                          mail = :mail,
                                          telephone = :telephone,
                                          
                                          commentaire = :commentaire
                                          
                                          
                                          WHERE id = :client_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':client_id' => $client_id,
            ':nom' => $array_data['nom'],
            ':prenom' => $array_data['prenom'],
            ':adresse' => $array_data['adresse'] ?? '',
            ':numero' => $array_data['numero'] ?? '',
            ':boite' => $array_data['boite'] ?? '',
            ':cp' => $array_data['cp'] ?? '',
            ':ville' => $array_data['ville'] ?? '',
            ':mail' => $array_data['mail'] ?? '',
            ':telephone' => $array_data['telephone'] ?? '',

            ':commentaire' => $array_data['commentaire'] ?? '',

        );

        // useful for debugging: you can see the SQL behind above construction by using:
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        //echo str_replace(array_keys($parameters), array_values($parameters), $query->queryString);

        $query->execute($parameters);

    }

    /**
     * @param $params L'input de l'utilisateur
     * @return integer Id du client inséré
     */
    public function addClient($params)
    {

        $sql = "INSERT INTO clients (nom, prenom, adresse, numero, boite, cp, ville, mail, telephone, commentaire)
                VALUES (:nom, :prenom, :adresse, :numero, :boite, :cp, :ville, :mail, :telephone, :commentaire)";
        $query = $this->db->prepare($sql);


        $parameters = array(
            ':nom' => $params['nom'],
            ':prenom' => $params['prenom'],
            ':adresse' => $params['adresse'] ?? '',
            ':numero' => $params['numero'] ?? '',
            ':boite' => $params['boite'] ?? '',
            ':cp' => $params['cp'] ?? '',
            ':ville' => $params['ville'] ?? '',
            ':mail' => $params['mail'] ?? '',
            ':telephone' => $params['telephone'] ?? '',
            ':commentaire' => $params['commentaire']) ?? '';

        // useful for debugging: you can see the SQL behind above construction by using:
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);

        // Retourne de l'id du client inséré
        return $this->db->lastInsertId();

    }


}