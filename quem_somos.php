<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" data-theme="light">

<head>
    <?php include('header.php');?>
    <title>
        Quem somos - Brasil Pescados
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

        <div class="linha mb-70">
            <div class="colunas lg-12 md-12 pq-12">
                <h2>Conheça a <br>Brasil Pescados</h2>
            </div>

            <div class="colunas lg-2 md-3 pq-12">
                <figure>
                    <img src="webapp/uploads/sistema/<?php echo $sistema['sistema_logo'] ?>" alt="" width="125">
                </figure>
                <br>
            </div>
            <div class="colunas lg-9 md-9 pq-12">
                Nossa marca nasce com a necessidade de facilitar o acesso das pessoas à alimentação saudável, por meio de peixes frescos e selecionados. Agora, com ainda mais facilidade, você encontra peixe congelado, nas mais diversas prateleiras, com preço acessível.
            </div>
            <div class="colunas lg-12 md-12 pq-12">
                <br> Criada para promover um maior aproveitamento das espécies capturadas pelos nossos barcos, nossa empresa permite que você tenha mais variedades e aproveitamento da carne de peixe. Nossos frigoríficos especializados para este tipo de
                armazenamento, entregam produtos de qualidade para otimizar e atrair uma nova vitrine para o seu negócio.
                <br><br> Se você tem supermercado, peixaria, hortifrúti ou, até mesmo, Cash & Carry, somos a marca que você precisa conhecer. Em vários formatos e apresentações, mantemos a qualidade que você precisa receber quando procurar por peixes
                congelados. A Brasil Pescados é uma marca que une a excelência da proteína saudável com o benefício do custo mais acessível. Uma linha completa de peixes com valores que cabem no bolso, em formatos mais fáceis de preparar!
            </div>
        </div>

        <?php include('formulario.php') ?>

    </main>

    <?php include('core/mod_rodape/rodape.php');?>

</body>

</html>

<!-- carousel banner -->
<script src="core/mod_includes/js/js-carousel-boot.js"></script>