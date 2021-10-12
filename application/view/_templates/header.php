<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Garde-infi confort DATABASE</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link href="<?= URL ?>font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= URL ?>css/update_pro.css" rel="stylesheet">
    <link href="<?= URL ?>css/bootstrap/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
    <link href="<?= URL ?>css/form_authentification/style.css" rel="stylesheet">
    <link href="<?= URL ?>css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="<?= URL ?>css/default.css" rel="stylesheet">
    <link href="<?= URL ?>css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.0/css/responsive.bootstrap4.min.css">
    <!-- JS -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json"></script>
    <script type="text/javascript" src="<?= URL ?>js/bootstrap/bootstrap.js"></script>
    <script type="text/javascript" src="<?= URL ?>js/datatable/dataTables.bootstrap4.min.js"></script>
<!--    <script type="text/javascript" src="--><?//= URL ?><!--js/datatable/jquery.dataTables.min.js"></script>-->
    <script type="text/javascript" src="//cdn.datatables.net/responsive/2.2.0/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.0/js/responsive.bootstrap4.min.js"></script>
    <script>var url = "<?= URL ?>";</script>
    <script>var MOBILE = "<?= MOBILE ?>";</script>

<!--script pour le multiselect par Jackson Debut-->
    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
<!--<link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/css/bootstrap.min.css"
    rel="stylesheet" type="text/css" />-->
<!--<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>-->
<link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
<!--<script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js" 
type="text/javascript"></script>-->
<script type="text/javascript" src="<?= URL ?>js/multiselect/bootstrap-multiselect.js"></script>
<!--<script rel="stylesheet" type="text/css" src="<?= URL ?>js/multiselect/bootstrap-multiselect.css"></script>-->
<script type="text/javascript">
   $(function () {
        $('#multiselectmenu').multiselect({
            includeSelectAllOption: true
        });
    }); 
</script>
<!--script pour le multiselect par Jackson Fin -->
</head>
<body>
<header>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-large" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= URL ?>professionnels">
                    <img class="img-responsive" src="img/logo-1.png" alt="" >
                    <span style="color:#fff" class="icon-white">GARDE-INFI CONFORT</span></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="nav-large">
                <ul class="nav navbar-nav ">
                    <li><a id="navCli" href="<?= URL ?>clients"><span>Clients</span></a></li>
                    <li class="dropdown">
                        <a id="navPro" class="dropdown-toggle" data-toggle="dropdown" href="#"> Prestataires
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= URL ?>professionnels">Tous</a></li>
                            <li><a href="<?= URL ?>professionnels?reg=2">Tous - BW</a></li>
                            <li><a href="<?= URL ?>professionnels?reg=1">Tous - BXL</a></li>
                            <li class="divider"></li>
                            <?php
                            foreach ($allCategories as $cat) { ?>
                                <li><a class="text-capitalize" href="<?= URL ?>professionnels?cat=<?= $cat->id ?>&reg=2"><?= $cat->nom_categorie ?> - BW</a></li>
                                <li><a class="text-capitalize" href="<?= URL ?>professionnels?cat=<?= $cat->id ?>&reg=1"><?= $cat->nom_categorie ?> - BXL</a></li>
                            <?php } ?>
                        </ul>
                    </li>

                    <?php
                    if (!MOBILE) {
                        if ($_SESSION['type_user'] == 'admin') { ?>
                            <li><a id="navCat" href="<?= URL ?>categories"><span>Catégories</span></a></li>
                            <li><a id="navUser" href="<?= URL ?>users"><span>Utilisateurs</span></a></li>
                        <?php } ?>
                        <li><a id="navExl" href="<?= URL ?>excel"><span>Extraction Excel</span></a></li>
                    <?php } ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class=""><a data-toggle="tooltip" title="Se déconnecter" href="<?= URL ?>logout"><?= $_SESSION['nom'] ?> - <small><?= $_SESSION['type_user'] ?></small>&nbsp;&nbsp;<i class="fa fa-sign-out"></i></a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>





    