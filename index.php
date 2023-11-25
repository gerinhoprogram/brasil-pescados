<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" data-theme="light">

<head>
    <?php 
        include('header.php');
        $pagina = 'Home';
    ?>
    <title>
        <?php echo $ttl ?>
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

        <div class="linha brasil-pescados">
            <div class="colunas lg-6 md-6 pq-12">
                <h2>Conheça a <br>Brasil Pescados</h2>
                <p>
                    Nossa marca nasce com a necessidade de facilitar o acesso das pessoas à alimentação saudável, por meio de peixes frescos e selecionados. Agora, com ainda mais facilidade, você encontra peixe conselado, nas mais diversas prateleiras, com preço acessível.
                </p>

                <a href="quem-somos" title="Saiba mais" target="_parent" title="Conheça a Brasil Pescados">
                    <div class="btn-saiba">Saiba mais</div>
                </a>

            </div>
            <div class="colunas lg-6 md-6 pq-12 img-home"></div>
        </div>

        <div class="linha-azul mt-70"></div>
        <div class="fundo-cza pt-70 pb-70">
            <div class="linha mb-70">
                <div class="colunas lg-12">
                    <h2>Produtos</h2>
                    <p>Peixes selecionados e congelados, para facilitar a sua venda<br>e a compra do seu consumidor.</p>
                    <a href="catalogo" target="_parent" title="Baixar PDF de produtos">
                        <div class="btn-saiba">Catálogo</div>
                    </a>
                    <div id='galeria'>
                        <div class='owl-carousel'>

                            <?php 
                                $sql_box = "SELECT * FROM produtos 
                                    LEFT JOIN categorias_pai ON categorias_pai.categoria_pai_id = produtos.produto_categoria_pai_id
                                    LEFT JOIN produto_fotos ON produto_fotos.foto_produto_id = produtos.produto_id
                                    where produto_status = 1
                                    order by RAND()";
                                    $stmt_box = $PDO->prepare($sql_box);
                                    $stmt_box->execute();
                                    $rows_box = $stmt_box->rowCount();
                                    if ($rows_box > 0) {
                                        while ($result_box = $stmt_box->fetch()) {
                                            echo'
                                            <a href="produtos/'.$result_box['produto_url'].'">
                                                <div class="carousel-fotos">
                                                    <figure>
                                                        <img src="webapp/uploads/produtos/'.$result_box['foto_nome'].'" title="'.$result_box['produto_titulo'].'" alt="'.$result_box['produto_titulo'].'">
                                                    </figure>
                                                    <span>'.$result_box['categoria_pai_nome'].'</span><br>
                                                    <p>'.$result_box['produto_titulo'].'</p>
                                                </div>
                                            </a>
                                            ';
                                        }
                                    }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include('formulario.php') ?>

    </main>

    <?php include('core/mod_rodape/rodape.php');?>

</body>

</html>