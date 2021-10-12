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
    
    <!-- Font awesome -->
    <link href="<?php echo URL; ?>font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS -->
    <link href="<?php echo URL; ?>css/update_pro.css" rel="stylesheet">
    <link href="<?php echo URL; ?>css/bootstrap/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
    <link href="<?php echo URL; ?>css/form_authentification/style.css" rel="stylesheet">
    <!--    <link href="<?php echo URL; ?>css/component.css" rel="stylesheet"> -->
    <link href="<?php echo URL; ?>css/default.css" rel="stylesheet">

    <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">


    <!-- css table -->
    <link href="<?php echo URL; ?>css/dataTables.bootstrap4.min.css" rel="stylesheet">
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
            <div class="col-md-5 text-right">
                <h2>Base de données</h2>
            </div>
        </div>
    </div>
    <div class="nav navbar">
        <div class="container-fluid">
            <ul class="nav navbar-nav ">
                <li><a href="<?php echo URL; ?>clients"><span>Clients</span></a></li>   
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Prestataires
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo URL; ?>professionnels">Tous</a></li>
                        <li><a href="<?php echo URL; ?>professionnels?reg=2">Tous - BW</a></li>
                        <li><a href="<?php echo URL; ?>professionnels?reg=1">Tous - BXL</a></li>
                        <li class="divider"></li>
                        <?php
                        foreach ($allCategories as $cat) { ?>
                            <li><a class="text-capitalize" href="<?= URL ?>professionnels?cat=<?= $cat->id ?>&reg=2"><?= $cat->nom_categorie ?> - BW</a></li>
                            <li><a class="text-capitalize" href="<?= URL ?>professionnels?cat=<?= $cat->id ?>&reg=1"><?= $cat->nom_categorie ?> - BXL</a></li>
                        <?php } ?>
                    </ul>
                </li>
                
                <?php if ($_SESSION['type_user'] == 'admin') { ?>
                    <li><a href="<?php echo URL; ?>categories"><span>Catégories</span></a></li>
                    <li><a href="<?php echo URL; ?>users"><span>Utilisateurs</span></a></li>
                <?php } ?>
                <li><a href="<?php echo URL; ?>excel"><span>Extraction Excel</span></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class=""><a data-toggle="tooltip" title="Se déconnecter" href="<?= URL ?>logout"><?= $_SESSION['nom'] ?> - <small><?= $_SESSION['type_user'] ?></small>&nbsp;&nbsp;<i class="fa fa-sign-out"></i></a></li>
            </ul>


            <a class="resize-small" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> Menu</a>
            <ul class="dropdown-menu" id="drop-menu">
                <li><a href="<?php echo URL; ?>professionnels"><span>Prestataires</span></a></li>
                <li><a href="<?php echo URL; ?>categories"><span>Catégories</span></a></li>
                <li><a href="<?php echo URL; ?>users"><span>Utilisateurs</span></a></li>
                <li><a href="<?= URL ?>logout"><span>Se déconnecter</span></a></li>
            </ul>

        </div>
    </div>
</header>





    