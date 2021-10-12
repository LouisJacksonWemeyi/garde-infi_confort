<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 18/09/17
 * Time: 14:12
 */

namespace Mini\Model;


use Mini\Core\Model;

class Service extends Model
{
    public function getAllServices()
    {

        $sql = "SELECT id, nom FROM services_gic";

        $req = $this->db->query($sql);

        return $req->fetchAll();

    }

    /**
     * @param $id id du client
     * @return mixed Tableau des services. Si actif pour l'utilisateur, possède un attribut 'actif' à true
     */
    public function getByClientId($id)
    {

        $sql = "SELECT services_gic.id, services_gic.nom FROM services_gic
                LEFT JOIN clients_has_services_gic ON clients_has_services_gic.services_gic_id = services_gic.id
                WHERE clients_has_services_gic.clients_id = :id";

        $query = $this->db->prepare($sql);

        $query->execute([':id' => $id]);

        $clientServices = $query->fetchAll();

        $allServices = $this->getAllServices();
        // Parcours des services : ajout d'un attribut 'actif' à true
        // si le service fait partie de ceux du client
        foreach ($allServices as $aS) {
            foreach ($clientServices as $cS) {
                if ($aS == $cS) {
                    $aS->actif = true;
                }
            }
        }

        return $allServices;
    }

    // fonction créer par jackson pour avoir les services des clients 
    /**
     * @param $id id du client
     * @return mixed Tableau des services du client. Ajouter par Jackson afin de trier les clients par les services qu'ils reçoivent    
     */
    public function getByClientIdServices($id)
    {

        $sql = "SELECT services_gic.id, services_gic.nom FROM services_gic
                LEFT JOIN clients_has_services_gic ON clients_has_services_gic.services_gic_id = services_gic.id
                WHERE clients_has_services_gic.clients_id = :id";

        $query = $this->db->prepare($sql);

        $query->execute([':id' => $id]);

        $clientServices = $query->fetchAll();

       /* $allServices = $this->getAllServices();
        // Parcours des services : ajout d'un attribut 'actif' à true
        // si le service fait partie de ceux du client
        foreach ($allServices as $aS) {
            foreach ($clientServices as $cS) {
                if ($aS == $cS) {
                    $aS->actif = true;
                }
            }
        }*/

        //return $allServices;
        return $clientServices;
    }

    public function getIdsByClient($id) {
        $sql = "SELECT services_gic.id, services_gic.nom FROM services_gic
                LEFT JOIN clients_has_services_gic ON clients_has_services_gic.services_gic_id = services_gic.id
                WHERE clients_has_services_gic.clients_id = :id";

        $query = $this->db->prepare($sql);

        $query->execute([':id' => $id]);

        $clientServices = $query->fetchAll();
        $ids = [];

        // Parcours des services : ajout d'un attribut 'actif' à true
        // si le service fait partie de ceux du client
        foreach ($clientServices as $cS) {
            array_push($ids, $cS->id);
        }

        return $ids;
    }

    public function addService($client_id, $service_id) {
        $sql = "INSERT INTO clients_has_services_gic VALUES (:client_id, :service_id)";
        $query = $this->db->prepare($sql);
        return $query->execute([':client_id' => $client_id, ':service_id' => $service_id]);
    }

    public function deleteService($client_id, $service_id) {
        $sql = "DELETE FROM clients_has_services_gic WHERE clients_id = :client_id AND services_gic_id = :service_id";
        $query = $this->db->prepare($sql);
        return $query->execute([':client_id' => $client_id, ':service_id' => $service_id]);
    }

    public function deleteClientServices($client_id) {
        $sql = "DELETE FROM clients_has_services_gic WHERE clients_id = :client_id";
        $query = $this->db->prepare($sql);
        return $query->execute([':client_id' => $client_id]);
    }


}