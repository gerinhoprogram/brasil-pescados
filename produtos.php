<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" data-theme="light">

<head>
    <?php 
        include('header.php');
        $pg_url = $_GET['p1'];
        $pesquisa = $_POST['pesquisa'];

        if($pg_url != ''){
            $sql= "SELECT * FROM produtos 
            LEFT JOIN produto_fotos ON produto_fotos.foto_produto_id = produtos.produto_id
            LEFT JOIN categorias_pai ON categorias_pai.categoria_pai_id = produtos.produto_categoria_pai_id
            WHERE produto_url = :produto_url and produto_status = :produto_status";
            $stmt = $PDO->prepare($sql);
            $stmt->bindParam(':produto_url', $pg_url);
            $stmt->bindValue(':produto_status', 1);
            $stmt->execute();
            $rows = $stmt->rowCount();   
            
            if($rows > 0)
            {	
                $produto = $stmt->fetch();
                $cat_id = $produto['produto_categoria_pai_id'];
            }
            
        }
    ?>
     <script src="core/mod_includes/js/movimento-seta.js"></script>
    <title>
        <?php echo ($produto ? $produto['produto_titulo'] : $ttl) ?>
    </title>
    <!-- DESLIZA HTML AO CLICAR EM #BTN-ORCA -->
    <script>
            jQuery(document).ready(function() {
                $('#btn-socio').click(function() {
                    var num = $('#form-id').offset();
                    var top = num.top;
                    $('html, body')
                        .animate({
                            scrollTop: top
                        }, 1500)
                });
            });
    </script>
    <!-- FIM EFEITO -->
</head>

<body>
    <header>
        <?php 
            include ('core/mod_topo/topo.php');
        ?>
    </header>

    <main>
        <div class="linha mb-70 mt-70">

            <!-- PRODUTO PELA URL  -->
            <?php if($produto) :?>
                    <div class='produto-solo'>
                        <div class="colunas lg-6 md-6 pq-12">
                            <figure>
                                <img src="webapp/uploads/produtos/<?php echo $produto['foto_nome'] ?>" alt="<?php echo $produto['produto_titulo'] ?>" title="<?php echo $produto['produto_titulo'] ?>" width="250">
                            </figure>
                        </div>
                        <div class="colunas lg-6 md-6 pq-12 brasil-pescados" style="display: table;">
                            <div style="display: table-cell; vertical-align: middle; text-align: left;">
                                <h3><?php echo $produto['categoria_pai_nome'] ?></h3>
                                <h1><?php echo $produto['produto_titulo'] ?></h1>
                                <a href="javascript:;" target="_parent" id="btn-socio" title="Seja nosso parceiro">
                                    <div class="btn-saiba" style="width: 100%">Seja nosso parceiro</div>
                                </a>
                            </div>
                        </div>
                    </div> 
                    
                    <div class="colunas lg-12 mt-70 mb-70">
                    <h2>Mais produtos de <?php echo $produto['categoria_pai_nome'] ?> </h2>
                    <div id='galeria'>
                        <div class='owl-carousel'>

                            <?php 
                                $sql_box = "SELECT * FROM produtos 
                                    LEFT JOIN categorias_pai ON categorias_pai.categoria_pai_id = produtos.produto_categoria_pai_id
                                    LEFT JOIN produto_fotos ON produto_fotos.foto_produto_id = produtos.produto_id
                                    where produto_status = 1 and produto_categoria_pai_id = $cat_id
                                    order by produto_titulo";
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
                
            <!-- TODOS OS PRODUTOS -->
            <?php else : ?>
                <div class="colunas lg-12 md-12 pq-12"><h2><?php echo ($pesquisa ? 'Sua pesquisa > '.$pesquisa : 'Produtos') ?></h2></div>
                    <div class="colunas lg-12 md-12 pq-12 produtos">
                    <?php 

                        // COM PESQUISA
                        if($pesquisa){
                            $sql= "SELECT * FROM produtos 
                            LEFT JOIN produto_fotos ON produto_fotos.foto_produto_id = produtos.produto_id
                            LEFT JOIN categorias_pai ON categorias_pai.categoria_pai_id = produtos.produto_categoria_pai_id
                            WHERE produto_status = :produto_status and 
                                  produto_titulo like '%$pesquisa%' OR
                                  categoria_pai_nome like '%$pesquisa%' OR
                                  produto_descricao like '%$pesquisa%'";
                        }else{

                            // SEM PESQUISA
                            $sql= "SELECT * FROM produtos 
                            LEFT JOIN produto_fotos ON produto_fotos.foto_produto_id = produtos.produto_id
                            LEFT JOIN categorias_pai ON categorias_pai.categoria_pai_id = produtos.produto_categoria_pai_id
                            WHERE produto_status = :produto_status";
                        }
                        
                        $stmt = $PDO->prepare($sql);
                        $stmt->bindValue(':produto_status', 1);
                        $stmt->execute();
                        $rows = $stmt->rowCount(); 
                        
                        if($rows > 0){
                            $cont=1;
                            while ($result = $stmt->fetch()) {
										echo"
                                            <div class='colunas lg-3 md-3 pq-5'>
                                                <div class='foto'>
                                                    <figure>
                                                        <img src='webapp/uploads/produtos/".$result['foto_nome']."' alt='".$result['produto_titulo']."' title='".$result['produto_titulo']."'>
                                                    </figure>
                                                </div>
                                            </div>
                                            <a href='produtos/".$result['produto_url']."' title='".$result['produto_titulo']."' target='_parent'>
                                            <div class='colunas lg-3 md-3 pq-6 elemento-pai'>
                                                <div class='elemento-principal'>
                                                    <p class='elemento-centralizado btn-saiba'>".$result['produto_titulo']."<br><span><i>".$result['categoria_pai_nome']."</i></span></p>
                                                </div>
                                            </div>
                                            </a>";
                                            $cont++;
                            }
                        }else{
                            echo"<div class='colunas lg-12 md-12 pq-12'>
                                <p>Não encontramos resultados pela pesquisa, $pesquisa</p>
                                <a href='produtos' target='_parent' title='Veja todos os produtos'>
                                    <div class='btn-saiba'>Veja todos os produtos</div>
                                </a>
                            </div>";
                        }
                    ?>
                    
                    </div>

            <?php endif ?>
        </div>

        <?php include('formulario.php') ?>

    </main>

    <?php include('core/mod_rodape/rodape.php');?>

</body>

</html>

