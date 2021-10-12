<?php
/**
 * Created by PhpStorm.
 * User: Matthieu
 * Date: 18/09/17
 * Time: 14:44
 */


namespace Mini\Model;

use Mini\Core\Model;

class FavoriPro extends Model{

    public function getAllFavoris($cat, $reg, $id) {
        $param = [':id' => $id];
        $sql = "SELECT id_pro"
            . " FROM professionnels "
            . " LEFT JOIN categories ON professionnels.categories_id = categories.id"
            . " LEFT JOIN favoris_pro f ON f.id_user = :id"
            . " WHERE true";
        // Si une categorie speciale est demandee
        if ($cat != '') {
            $sql = $sql . " AND professionnels.categories_id = :cat";
            $param[':cat'] = $cat;
        }
        // Si une region speciale est demandee
        if ($reg != '') {
            $sql = $sql . " AND regions_id = :reg";
            $param[':reg'] = $reg;
        }
        $sql = $sql . " ORDER BY nom";

        $query = $this->db->prepare($sql);
        $query->execute($param);
        return $query->fetchAll();
    }

    public function count($cat, $reg, $id) {
        $param = [':id' => $id];
        $sql = "SELECT count(*) as nb"
            . " FROM professionnels "
            . " LEFT JOIN categories ON professionnels.categories_id = categories.id"
            . " LEFT JOIN favoris_pro f ON f.id_user = :id"
            . " WHERE true";
        // Si une categorie speciale est demandee
        if ($cat != '') {
            $sql = $sql . " AND professionnels.categories_id = :cat";
            $param[':cat'] = $cat;
        }
        // Si une region speciale est demandee
        if ($reg != '') {
            $sql = $sql . " AND regions_id = :reg";
            $param[':reg'] = $reg;
        }
        $sql = $sql . " ORDER BY nom";

        $query = $this->db->prepare($sql);
        $query->execute($param);
        return $query->fetch();
    }

    public function addFavori($id, $pro) {
        $sql = "INSERT INTO favoris_pro"
            . " (id_pro, id_user)"
            . " VALUE (:pro, :id)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id, ':pro' => $pro));
    }

    public function deleteFavori($id, $pro) {
        $sql = "DELETE FROM favoris_pro"
            . " WHERE id_pro = :pro"
            . " AND id_user = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id, ':pro' => $pro));
    }

    public function deleteFavoriPro($pro) {
        $sql = "DELETE FROM favoris_pro"
            . " WHERE id_pro = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $pro));
    }

    public function deleteFavoriuser($user) {
        $sql = "DELETE FROM favoris_pro"
            . " WHERE id_user = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $user));
    }
}