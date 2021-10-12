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
	<link href="<?php echo URL; ?>css/update_pro.css" rel="stylesheet">
	<link href="<?php echo URL; ?>css/bootstrap/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
	<link href="<?php echo URL; ?>css/form_authentification/style.css" rel="stylesheet">
	<!--    <link href="<?php echo URL; ?>css/component.css" rel="stylesheet"> -->
	<link href="<?php echo URL; ?>css/default.css" rel="stylesheet">

	<link href="<?php echo URL; ?>css/style.css" rel="stylesheet">

	<!-- TEST css table -->
	<link href="<?php echo URL; ?>css/tableStyle.css" rel="stylesheet">

</head>
<body>
<!-- logo, check the CSS file for more info how the logo "image" is shown -->
<!--   <div class="logo"></div>-->

<!-- navigation -->
<!--<div class="navigation">

        <?php if($_SESSION['type_user'] == 'admin') { ?>
            <a href="<?php// echo URL; ?>categories">Gérer les catégories</a>
        <?php } ?>
        <a href="<?php echo URL; ?>professionnels">Gérer les professionnels</a>
        <?php if($_SESSION['type_user'] == 'admin') { ?>
            <a href="<?php echo URL; ?>users">Gérer les utilisateurs</a>
        <?php } ?>

        
    </div>-->
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
<div class="nav navbar">
	<div class="container-fluid">
		<ul class="nav navbar-nav btn-menu">
			<li><a href="<?php echo URL; ?>professionnels"><span>Prestataires</span></a></li>
			<li><a href="<?php echo URL; ?>categories"><span>Catégories</span></a></li>
			<li><a href="<?php echo URL; ?>users"><span>Utilisateurs</span></a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li class="btn-menu"><a href="<?= URL ?>logout"><span>Se déconnecter</span></a></li>
		</ul>

		<a class="btn-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> Menu</a>
		<ul class="dropdown-menu" id="drop-menu">
			<li><a href="<?php echo URL; ?>professionnels"><span>Prestataires</span></a></li>
			<li><a href="<?php echo URL; ?>categories"><span>Catégories</span></a></li>
			<li><a href="<?php echo URL; ?>users"><span>Utilisateurs</span></a></li>
			<li><a href="<?= URL ?>logout"><span>Se déconnecter</span></a></li>
		</ul>
	</div>
</div>





    