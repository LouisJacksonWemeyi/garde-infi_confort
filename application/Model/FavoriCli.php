<?php
/**
 * Created by PhpStorm.
 * User: Matthieu
 * Date: 20/09/17
 * Time: 17:24
 */


namespace Mini\Model;

use Mini\Core\Model;

class FavoriCli extends Model {

    public function getAllFavoris($id) {
        $sql = "SELECT id_cli"
            . " FROM favoris_cli "
            . " WHERE id_user = :id";
        $param = [':id' => $id];
        $query = $this->db->prepare($sql);
        $query->execute($param);
        return $query->fetchAll();
    }

    public function count($id) {
        $sql = "SELECT count(*) as nb"
            . " FROM favoris_cli "
            . " WHERE f.id_user = :id";
        $param = [':id' => $id];
        $query = $this->db->prepare($sql);
        $query->execute($param);
        return $query->fetch();
    }

    public function addFavori($id, $cli) {
        $sql = "INSERT INTO favoris_cli"
            . " (id_cli, id_user)"
            . " VALUE (:cli, :id)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id, ':cli' => $cli));
    }

    public function deleteFavori($id, $cli) {
        $sql = "DELETE FROM favoris_cli"
            . " WHERE id_cli = :cli"
            . " AND id_user = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id, ':cli' => $cli));
    }

    public function deleteFavoriCli($cli) {
        $sql = "DELETE FROM favoris_cli"
            . " WHERE id_cli = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $cli));
    }

    public function deleteFavoriUser($user) {
        $sql = "DELETE FROM favoris_cli"
            . " WHERE id_user = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $user));
    }
}
