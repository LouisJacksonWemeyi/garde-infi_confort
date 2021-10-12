<?php

namespace Mini\Model;
use Mini\Core\Model;

class Professionnel extends Model
{
    //il faut modifier cette requête pour l'adaptation du menu demandée ce matin...
    public function getAllProfessionnels($cat='', $reg='')
    {
        $param = [];
        $sql = "SELECT professionnels.id, categories.id as categorie_id, nom_societe, nom, prenom, adresse, numero, boite, cp, ville, mail, telephone, professionnels.inami, tva, disponibilite, commentaire, nom_categorie, regions_id"
            . " FROM professionnels "
            . " LEFT JOIN categories ON professionnels.categories_id = categories.id"
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
    
    /**
     * Compte le nbre de pro en fonction d'une categorie et/ou region precisee(s).
     *
     * @param $cat la categorie OU ''
     * @param $reg la region OU ''
     */
    public function count($cat, $reg) {
        $param = [];
        $sql = "SELECT count(*) as nbre"
            . " FROM professionnels "
            . " LEFT JOIN categories ON professionnels.categories_id = categories.id"
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

        $query = $this->db->prepare($sql);
        $query->execute($param);
        return $query->fetch();
    }

    public function getPro($idpro)
    {
        $sql = "SELECT id, nom_societe, nom, prenom, adresse, numero, boite, cp, ville, mail, telephone, inami, tva, disponibilite, commentaire
        FROM professionnels WHERE id = :idpro ";
        $query = $this->db->prepare($sql);
        $parameters = array(':idpro'=> $idpro);
        $query->execute($parameters);
        return $query->fetch();
    }
    
    public function deleteProfessionnel($pro_id)
    {
        $sql = "DELETE FROM professionnels WHERE id = :pro_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':pro_id' => $pro_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
    }
    
    public function filtrePro($filtre)
    {
        parse_str($filtre, $array_filtre);
        print_r($array_filtre);
        $sql = "SELECT id, nom, prenom, adresse, numero, boite, cp, ville, mail, telephone, inami, tva, disponibilite, commentaire
        FROM professionnels
        WHERE nom LIKE :nom
        AND prenom LIKE :prenom
        AND adresse LIKE :adresse
        AND ville LIKE :ville
        AND cp LIKE :cp
        
        ORDER BY nom";
        
        $query = $this->db->prepare($sql);
        $parameters = array(':nom'=> '%'.$array_filtre['filtre_nom'].'%', ':prenom'=>'%'.$array_filtre['filtre_prenom'].'%', ':adresse'=>'%'.$array_filtre['filtre_adresse'].'%',':ville'=>'%'.$array_filtre['filtre_ville'].'%',':cp'=>'%'.$array_filtre['filtre_cp'].'%');
        //print_r($parameters);
        $query->execute($parameters);
        
        return $query->fetchAll();
        
        
    }

    public function updatePro($pro_id, $form_data)
    {
        //le formulaire a été sérialisé en js, je le parse afin de le mettre dans un array (utiliser $array_data['champ'])
        parse_str($form_data, $array_data);
        
        //print_r($array_data);
        $sql = "UPDATE professionnels SET"
            . " nom_societe = :societe,"
            . " nom = :nom,"
            . " prenom = :prenom,"
            . " adresse = :adresse,"
            . " numero = :numero,"
            . " boite = :boite,"
            . " cp = :cp,"
            . " ville = :ville,"
            . " mail = :mail,"
            . " telephone = :telephone,"
            . " inami = :inami,"
            . " tva = :tva,"
            . " disponibilite = :disponibilite,"
            . " commentaire = :commentaire,"
            . " categories_id = :metier,"
            . " regions_id = :region"
            . " WHERE id = :pro_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':pro_id' => $pro_id,
                            ':societe' => $array_data['nomSociete'] ?? '',
                            ':nom' => $array_data['nom'] ?? '',
                            ':prenom' =>$array_data['prenom'] ?? '',
                            ':adresse'=>$array_data['adresse'] ?? '',
                            ':numero'=>$array_data['numero'] ?? '',
                            ':boite'=>$array_data['boite'] ?? '',
                            ':cp'=>$array_data['cp'] ?? '',
                            ':ville'=>$array_data['ville'] ?? '',
                            ':mail'=>$array_data['mail'] ?? '',
                            ':telephone'=>$array_data['telephone'] ?? '',
                            ':inami'=>$array_data['inami'] ?? '',
                            ':tva'=>$array_data['tva'] ?? '',
                            ':disponibilite'=>$array_data['disponibilite'] ?? '',
                            ':commentaire'=>$array_data['commentaire'] ?? '',
                            ':metier'=>$array_data['metier'] ?? '',
                            ':region'=>$array_data['update_region'] ?? ''
                            );

        // useful for debugging: you can see the SQL behind above construction by using:
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        //echo str_replace(array_keys($parameters), array_values($parameters), $query->queryString);

        $query->execute($parameters);
    }
    
    public function addPro($params)
    {
        $sql = "INSERT INTO professionnels (nom_societe, nom, prenom, adresse, numero, boite, cp, ville, mail, telephone, inami, tva, disponibilite, commentaire, regions_id, categories_id)
                VALUES (:nomSociete, :nom, :prenom, :adresse, :numero, :boite, :cp, :ville, :mail, :telephone, :inami, :tva, :disponibilite, :commentaire, :regions_id, :cat_id)";
        $query = $this->db->prepare($sql);


        $parameters = array(':nomSociete' => $params['nomSociete'] ?? '', ':nom' => $params['nom'] ?? '', ':prenom'=>$params['prenom'] ?? '',':adresse' => $params['adresse'] ?? '', ':numero'=>$params['numero'] ?? '',':boite' => $params['boite'] ?? '', ':cp'=>$params['cp'] ?? '',
                            ':ville' => $params['ville'] ?? '', ':mail'=>$params['mail'] ?? '',':telephone' => $params['telephone'] ?? '', ':inami'=>$params['inami'] ?? '',
                            ':tva' => $params['tva'] ?? '', ':disponibilite'=>$params['disponibilite'] ?? '',':commentaire' => $params['commentaire'] ?? '', ':regions_id'=> $params['region'] ?? '', 'cat_id'=>$params['metier'] ?? '' );

        // useful for debugging: you can see the SQL behind above construction by using:
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
    }
    
}