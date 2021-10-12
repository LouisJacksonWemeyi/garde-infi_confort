<?php

namespace Mini\Model;
use Mini\Core\Model;

class Login extends Model
{
    public function checkLogin($login, $motdepasse)
    {

        $sql = "SELECT login, password, nom, prenom, type_user "
            . "FROM users "
            . "WHERE login = :login";

        $query = $this->db->prepare($sql);
        $parameters = array(':login' => $login);
        $query->execute($parameters);
        $result = $query->fetch();

        
        /*
         * Test si l'identifiant est ok, puis si le mdp entré et correspond avec les hash dans la DB
         */
        if($result && password_verify($motdepasse, $result->password)) {
            session_start();
            $_SESSION['connected'] = 1;
            $_SESSION['nom'] = $result->prenom.' '.$result->nom;
            $_SESSION['type_user'] = $result->type_user;
            return "OK";

        } else {

            return "NOK";
        }
    }



}