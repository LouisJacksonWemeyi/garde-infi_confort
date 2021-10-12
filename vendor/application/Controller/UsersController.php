<?php

    namespace Mini\Controller;
    
    use Mini\Model\User;
    
    class UsersController
    {
        public function index()
        {
            // Si $_SESSION n'existe pas (si non connecté), redirection sur la page de login
            session_start();
            if(!isset($_SESSION['connected'])) {
                header('Location: ' . URL );
            }

            $user = new User();
            $users = $user->getAllUsers();
            
            
            
            // load views. within the views we can echo out $songs and $amount_of_songs easily
            require APP . 'view/_templates/header.php';
            require APP . 'view/users/index.php';
            //si je ne mets pas cette ligne, ma déclarartion du fichier js ne se fera pas, ajax ne fonctionnera donc pas
            require APP . 'view/_templates/footer.php';
            
        }
        
        public function deleteUsers($id_todelete)
        {
            $user = new User();
            echo $ok = $user->deleteUser($id_todelete);
            
            
        }
        
        public function updateUser($idUser)
        {
            //print_r($_POST);
            
            if (isset($idUser))
            {
                // Instance new Model (professionnel)
                //soit on met à jour un pro
                $user = new User();
                if (isset($_POST['action']) && ($_POST['action'] == 'maj'))
                {
                    $user = $user->updateUser($idUser, $_POST['data_form_user']);
                    echo "Mise à jour réussie...";
                    return false;
                    
                }
            }
        }
        
        public function addUser()
        {
            $params = array();
            //permet de transformer en array ce qu'on a reçu de js (seraialize)
            parse_str($_POST['data_form_insert_user'], $params);
            print_r($params);
            //return false;
            $user = new User();
            $user->addUser($params);
            echo "Insertion réussie...";
            return false;
        }
        
            
        
        
    }