<?php

namespace Mini\Model;
use Mini\Core\Model;

class Categorie extends Model
{
    public function getAllCategories()
    {
        $sql = "SELECT id, nom_categorie FROM categories ORDER BY nom_categorie";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
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
        
        $sql = "UPDATE categories SET nom_categorie = :nom_categorie WHERE id = :categorie_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':categorie_id' => $params['id'], ':nom_categorie' => $params['nom']);

        // useful for debugging: you can see the SQL behind above construction by using:
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
    }
    
    public function addCategorie($nom_categorie)
    {
        $sql = "INSERT INTO categories (nom_categorie) VALUES (:nom_categorie)";
        $query = $this->db->prepare($sql);
        $parameters = array(':nom_categorie' => $nom_categorie);

        // useful for debugging: you can see the SQL behind above construction by using:
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
    }
    
}