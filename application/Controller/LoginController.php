<?php

    namespace Mini\Controller;
    
    use Mini\Model\Login;
    
    class LoginController
    {
        public function index()
        {
            $login = new Login();
            $result = $login->checkLogin($_POST['login'], $_POST['pass']);

            switch ($result) {
                case 0:
                    echo "Login ou mot de passe incorrect !";
                    break;
                case 1:
                    echo "OK";
                    break;
                case 2:
                    echo "Compte non actif. Contactez un administrateur";
                    break;
            }
        }
        
    }

?>