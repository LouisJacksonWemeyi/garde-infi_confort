<?php

namespace Mini\Model;
use Mini\Core\Model;

class Login extends Model
{
    public function checkLogin($login, $motdepasse) {
        
        $sql = "SELECT id, login, password, nom, prenom, type_user, actif "
            . "FROM users "
            . "WHERE login = :login";
        $query = $this->db->prepare($sql);
        $parameters = array(':login' => $login);
        $query->execute($parameters);
        $result = $query->fetch();


        /*
         * Test si l'identifiant est ok, puis si le mdp entré et correspond avec les hash dans la DB
         * 0 => MDP || login pas correct
         * 1 => connecté
         * 2 => compte non actif
         */
        //print_r($result);
        
        if($result && password_verify($motdepasse, $result->password)) {
            if ($result->actif == 1) {
                session_start();
                $_SESSION['connected'] = 1;
                $_SESSION['nom'] = $result->prenom.' '.$result->nom;
                $_SESSION['type_user'] = $result->type_user;
                $_SESSION['id'] = $result->id;
                return 1;
            } else {
                return 2;
            }
        } else {
            return 0;
        }
    }



}