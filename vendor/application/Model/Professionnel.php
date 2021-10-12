<?php

namespace Mini\Model;
use Mini\Core\Model;

class Professionnel extends Model
{
    public function getAllProfessionnels()
    {
        $sql = "SELECT professionnels.id, nom, prenom, adresse, numero, boite, cp, ville, mail, telephone, inami, tva, disponibilite, commentaire, nom_categorie
        FROM professionnels
        LEFT JOIN categories
        ON professionnels.categories_id = categories.id
        ORDER BY nom";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    
    public function getPro($idpro)
    {
        $sql = "SELECT id, nom, prenom, adresse, numero, boite, cp, ville, mail, telephone, inami, tva, disponibilite, commentaire
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
        
        
        $sql = "UPDATE professionnels SET nom = :nom,
                                          prenom = :prenom,
                                          adresse = :adresse,
                                          numero = :numero,
                                          boite = :boite,
                                          cp = :cp,
                                          ville = :ville,
                                          mail = :mail,
                                          telephone = :telephone,
                                          inami = :inami,
                                          tva = :tva,
                                          disponibilite = :disponibilite,
                                          commentaire = :commentaire
                                          WHERE id = :pro_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':pro_id' => $pro_id,
                            ':nom' => $array_data['nom'],
                            ':prenom' =>$array_data['prenom'],
                            ':adresse'=>$array_data['adresse'],
                            ':numero'=>$array_data['numero'],
                            ':boite'=>$array_data['boite'],
                            ':cp'=>$array_data['cp'],
                            ':ville'=>$array_data['ville'],
                            ':mail'=>$array_data['mail'],
                            ':telephone'=>$array_data['telephone'],
                            ':inami'=>$array_data['inami'],
                            ':tva'=>$array_data['tva'],
                            ':disponibilite'=>$array_data['disponibilite'],
                            ':commentaire'=>$array_data['commentaire']
                            );

        // useful for debugging: you can see the SQL behind above construction by using:
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
    }
    
    public function addPro($params)
    {
        $sql = "INSERT INTO professionnels (nom, prenom, adresse, numero, boite, cp, ville, mail, telephone, inami, tva, disponibilite, commentaire, regions_id)
                VALUES (:nom, :prenom, :adresse, :numero, :boite, :cp, :ville, :mail, :telephone, :inami, :tva, :disponibilite, :commentaire, :regions_id)";
        $query = $this->db->prepare($sql);
        $parameters = array(':nom' => $params['nom'], ':prenom'=>$params['prenom'],':adresse' => $params['adresse'], ':numero'=>$params['numero'],':boite' => $params['boite'], ':cp'=>$params['boite'],
                            ':ville' => $params['ville'], ':mail'=>$params['mail'],':telephone' => $params['telephone'], ':inami'=>$params['inami'],
                            ':tva' => $params['tva'], ':disponibilite'=>$params['disponibilite'],':commentaire' => $params['commentaire'], ':regions_id'=> 1 );

        // useful for debugging: you can see the SQL behind above construction by using:
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
    }
    
}