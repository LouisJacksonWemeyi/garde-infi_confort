<?php
/**
 * File : bd_gic / logout.php
 * User : Matthieu SCHMIT
 * Date : 12/09/17
 * Time : 13:38
 */

namespace Mini\Controller;

class LogoutController {

    public function index() {
        session_start();
        session_destroy();
        header('Location: ' . URL);
        exit;
    }
}

