<?php
/**
 * Created by PhpStorm.
 * User: Matthieu
 * Date: 19/09/17
 * Time: 15:59
 */


namespace Mini\Model;

use Mini\Core\Model;

class CP extends Model {

    public function getVille($cp) {
        $sql = "SELECT nom"
            . " FROM CP "
            . " WHERE cp = :cp";
        $query = $this->db->prepare($sql);
        $query->execute([':cp' => $cp]);
        return $query->fetchAll();
    }

    public function count($cp) {
        $sql = "SELECT count(*) as nb"
            . " FROM CP "
            . " WHERE cp = :cp";
        $query = $this->db->prepare($sql);
        $query->execute([':cp' => $cp]);
        return $query->fetch();
    }

}