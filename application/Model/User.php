<?php

namespace Mini\Model;
use Mini\Core\Model;

class User extends Model
{
    public function getAllUsers()
    {
        $sql = "SELECT * FROM users ORDER BY nom";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function deleteUser($user_id)
    {
        $sql = "DELETE FROM users WHERE id = :user_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
    }

    public function addUser($params)
    {
        $sql = "INSERT INTO users (nom, prenom, login, password, actif, type_user)
                VALUES (:nom, :prenom, :login, :password, :actif, :type_user)";
        $query = $this->db->prepare($sql);
        $parameters = array(':nom' => $params['nom'], ':prenom'=>$params['prenom'],':login' => $params['login'],
            ':password'=>password_hash($params['password'], PASSWORD_DEFAULT),':actif' => $params['actif'], ':type_user'=>$params['type_user'] );

        // useful for debugging: you can see the SQL behind above construction by using:
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
    }

    public function updateUser($user_id, $form_data)
    {
        //le formulaire a été sérialisé en js, je le parse afin de le mettre dans un array (utiliser $array_data['champ'])
        parse_str($form_data, $array_data);

        $param = [];
        $sql = "UPDATE users SET"
            . " nom = :nom,"
            . " prenom = :prenom,"
            . " login = :login,"
            . " actif = :actif,"
            . " type_user = :type_user";
        // Test si mise à jour du mot passe
        if ($array_data['password'] != '') {
            $sql = $sql . ", password = :password";
            $param[':password'] = password_hash($array_data['password'], PASSWORD_DEFAULT);
        }
        $sql = $sql . ' WHERE id = :user_id';

        // Param
        $param[':nom'] = $array_data['nom'];
        $param[':prenom'] = $array_data['prenom'];
        $param[':login']= $array_data['login'];
        $param[':actif'] = $array_data['actif'];
        $param[':type_user'] = $array_data['type_user'];
        $param[':user_id'] = $array_data['id'];


        $query = $this->db->prepare($sql);
        // useful for debugging: you can see the SQL behind above construction by using:
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($param);
    }

}