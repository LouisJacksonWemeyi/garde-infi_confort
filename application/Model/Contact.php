<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 19/09/17
 * Time: 14:00
 */

namespace Mini\Model;


use Mini\Core\Model;

class Contact extends Model
{
    public function getAllContacts($client_id)
    {

        $sql = "SELECT id, nom, prenom, telephone, mail, commentaire FROM personnes_contact INNER JOIN clients_has_personnes_contact 
                ON clients_has_personnes_contact.personnes_contact_id = personnes_contact.id
                WHERE clients_has_personnes_contact.clients_id = :client_id";

        $query = $this->db->prepare($sql);

        $query->execute([':client_id' => $client_id]);

        return $query->fetchAll();

    }

    /**
     * @param $params Input utilisateur
     * @return integer Id du contact inséré
     */
    public function addContact($params)
    {
        $sql = "INSERT INTO personnes_contact (nom, prenom, telephone, mail, commentaire)
                VALUES (:nom, :prenom, :telephone, :mail, :commentaire)";

        $query = $this->db->prepare($sql);

        $query->execute([
            ':nom' => $params['nom'],
            ':prenom' => $params['prenom'],
            ':telephone' => $params['tel'],
            ':mail' => $params['mail'],
            ':commentaire' => $params['com'],
        ]);

        return $this->db->lastInsertId();
    }

    /**
     * Mise à jour d'un contact
     */
    public function updateContact($p) {
        $sql = "UPDATE personnes_contact SET nom = :nom, prenom = :prenom, telephone = :telephone, mail = :mail, commentaire = :commentaire
                WHERE personnes_contact.id = :id";

        $query = $this->db->prepare($sql);

        echo $query->execute([
            ':id' => $p['id'],
            ':nom' => $p['nom'],
            ':prenom' => $p['prenom'],
            ':telephone' => $p['telephone'],
            ':mail' => $p['mail'],
            ':commentaire' => $p['commentaire'],
        ]);
    }

    /**
     * Suppression simple d'un contact (table personnes_contact)
     */
    public function deleteContact($id)
    {
        $sql = "DELETE FROM personnes_contact WHERE id = :id";

        $query = $this->db->prepare($sql);

        return $query->execute([':id' => $id]);
    }

    /**
     * Suppression d'un contact d'un client (table clients_has_personnes_contact)
     * @param $client_id Id du client concerné
     * @param $contact_id Id du contact concerné
     * @return boolean True si suppression réussie
     */
    public function deleteClientContact($client_id, $contact_id)
    {
        $sql = "DELETE FROM clients_has_personnes_contact WHERE clients_id = :client_id AND personnes_contact_id = :contact_id";

        $query = $this->db->prepare($sql);

        return $query->execute([':client_id' => $client_id, ':contact_id' => $contact_id]);
    }
    public function deleteClientContacts($client_id)
    {
        $sql = "DELETE FROM clients_has_personnes_contact WHERE clients_id = :client_id";

        $query = $this->db->prepare($sql);

        return $query->execute([':client_id' => $client_id]);
    }

    /**
     * Ajouter un contact à un client
     * @param $client_id Id du client
     * @param $contact_id Id du contact
     * @return mixed
     */
    public function addClientContact($client_id, $contact_id)
    {
        $sql = "INSERT INTO clients_has_personnes_contact (clients_id, personnes_contact_id) VALUES (:client_id, :contact_id)";

        $query = $this->db->prepare($sql);

        return $query->execute([':client_id' => $client_id, ':contact_id' => $contact_id]);

    }
}