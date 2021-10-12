<?php

namespace Mini\Model;
use Mini\Core\Model;

class Categorie extends Model
{
    public function getAllCategories()
    {
        $sql = "SELECT id, nom_categorie, inami FROM categories ORDER BY nom_categorie";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    /**
     * Recupere une seule categorie en fonction de l'id
     * @param $id l'id de la catégorie
     */
    public function getCategorie($id) {
        $sql = "SELECT id, nom_categorie, inami"
            . " FROM categories"
            . " WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = [':id' => $id];
        $query->execute($parameters);
        return $query->fetch();
    }
    
    public function deleteCategorie($categorie_id)
    {
        $sql = "DELETE FROM categories WHERE id = :categorie_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':categorie_id' => $categorie_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
    }
    
    public function updateCategorie($params)
    {
        
        $sql = "UPDATE categories SET nom_categorie = :nom_categorie, inami = :inami WHERE id = :categorie_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':categorie_id' => $params['id'] ?? '',
            ':nom_categorie' => $params['nom'] ?? '',
            ':inami' => $params['inami'] ?? '');

     //   error_log(print_r($params, true));

        // useful for debugging: you can see the SQL behind above construction by using:
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
    }
    
    public function addCategorie($nom_categorie, $inami)
    {
        $sql = "INSERT INTO categories (nom_categorie, inami) VALUES (:nom_categorie, :inami)";
        $query = $this->db->prepare($sql);
        $parameters = array(':nom_categorie' => $nom_categorie, 'inami' => $inami);

        // useful for debugging: you can see the SQL behind above construction by using:
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
    }
    
}