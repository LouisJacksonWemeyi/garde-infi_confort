<?php
	session_start();

    // Si $_SESSION existe et == 1 (si connecté), redirection sur la page 'professionnels'
    if(!empty($_SESSION['connected'])) {
        if($_SESSION['connected'] == 1) {
            header('Location: ' . URL . 'professionnels');
        }
        else
        {
            header('Location: ' . URL . 'login');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Garde-infi confort DATABASE</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link href="<?= URL ?>css/bootstrap/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
    <link href="<?= URL ?>css/style.css" rel="stylesheet">
    <link href="<?= URL ?>css/form_authentification/style.css" rel="stylesheet">


    <!-- JS -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?= URL ?>js/bootstrap/bootstrap.js"></script>
    <script>var url = "<?= URL ?>";</script>
    <script src="<?= URL ?>js/header.js"></script>
    <script src="<?= URL ?>js/login.js"></script>

</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-2 resize-big" id="logo">
                    <img src="img/logo-1.png" alt="">
                </div>
                <div class="col-md-5 resize-big">
                    <div id="title">
                        <h1>GARDE-INFI CONFORT</h1>
                        <div id="azurex">
                            <h2>Soins et services à domicile </h2>
                     </div>
                  </div>
                </div>
                <div class="col-md-5 text-right resize-big">
                    <h2>Base de données</h2>
                </div>
            </div>
        </div>
    </header>
    <div class="nav navbar navbar-default">
        <div class="resize-medium hidden">
            <h3>GARDE-INFI CONFORT - Base de données</h3>
        </div>
    </div>
    <br>

    
