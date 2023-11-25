<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" data-theme="light">

<head>
    <?php 
        include('header.php');
        $pagina = 'Contato'
    ?>
    <title>
        <?php echo $pagina .' | '. $ttl ?>
    </title>

</head>

<body>
    <header>
        <?php 
            include ('core/mod_topo/topo.php');
            include ('banner.php');
        ?>
    </header>

    <main>

        <?php include('formulario.php') ?>

    </main>

    <?php include('core/mod_rodape/rodape.php');?>

</body>

</html>

<!-- carousel banner -->
<script src="core/mod_includes/js/js-carousel-boot.js"></script>