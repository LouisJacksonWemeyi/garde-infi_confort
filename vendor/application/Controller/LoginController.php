<?php

    namespace Mini\Controller;
    
    use Mini\Model\Login;
    
    class LoginController
    {
        public function index()
        {
            $login = new Login();
            $ok = $login->checkLogin($_POST['login'], $_POST['pass']);
            echo $ok;
        }
        
    }

?>