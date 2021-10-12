

    <!-- jQuery, loaded in the recommended protocol-less way -->
    <!-- more http://www.paulirish.com/2010/the-protocol-relative-url/ -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/plug-ins/1.10.16/i18n/French.json"></script>
    

    <!-- define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
    <script>
        var url = "<?php echo URL; ?>";
    </script>
    
    <script type="text/javascript" src="<?php echo URL; ?>js/bootstrap/bootstrap.js"></script>

    <!-- our JavaScript -->
    <script src="<?php echo URL; ?>js/categories.js"></script>
    <script src="<?php echo URL; ?>js/application.js"></script>
    <script src="<?php echo URL; ?>js/professionnels.js"></script>
    <script src="<?php echo URL; ?>js/login.js"></script>
    <script src="<?php echo URL; ?>js/modernizr.custom.js"></script>
    <script src="<?php echo URL; ?>js/users.js"></script>

    <script src="<?= URL ?>js/header.js"></script>
    
</body>
</html>
