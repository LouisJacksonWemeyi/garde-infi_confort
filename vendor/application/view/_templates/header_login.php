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

    <!-- JS -->
    <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
    <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->

    <!-- CSS -->
    <link href="<?php echo URL; ?>css/bootstrap/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
    
    <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
    <link href="<?php echo URL; ?>css/form_authentification/style.css" rel="stylesheet">


</head>
<body>
    <!-- logo, check the CSS file for more info how the logo "image" is shown -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-2" id="logo">
                    <img src="img/logo-1.png" alt="">
                </div>
                <div class="col-md-10">
                    <div id="title">
                        <h1>GARDE-INFI CONFORT</h1>
                        <div id="azurex">
                            <h2>Soins et services à domicile </h2>
                     </div>
                  </div>
                </div>
            </div>
        </div>
    </header>
    <div class="nav navbar navbar-default">

    </div>

    
