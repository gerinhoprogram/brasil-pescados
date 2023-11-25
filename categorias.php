<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" data-theme="light">

<head>
    <?php 
        include('header.php');
        $pg_url = $_GET['p1'];

        if($pg_url != ''){
            $sql= "SELECT * FROM produtos 
                LEFT JOIN produto_fotos ON produto_fotos.foto_produto_id = produtos.produto_id
                LEFT JOIN categorias_pai ON categorias_pai.categoria_pai_id = produtos.produto_categoria_pai_id
                WHERE categoria_pai_meta_link = :categoria_pai_meta_link and produto_status = :produto_status";
                $stmt = $PDO->prepare($sql);
                $stmt->bindParam(':categoria_pai_meta_link', $pg_url);
                $stmt->bindValue(':produto_status', 1);
                $stmt->execute();
                $rows = $stmt->rowCount();
                
                $categorias = $stmt->fetch();
                $titulo = $categorias['categoria_pai_nome'];
        }

    ?>
    <title>
        <?php echo $ttl ?>
    </title>
</head>

<body>
    <header>
        <?php 
            include ('core/mod_topo/topo.php');
        ?>
    </header>

    <main>
        <div class="linha mb-70 mt-70">
                     <div class="colunas lg-12 pq-12 md-12">
                    <h2><?php echo $titulo ?></h2>
                    </div>
                    <div class="produtos">
                    
                    <?php 
                         
                        if($rows > 0){
                            $cont=1;
                            while ($result = $stmt->fetch()) {
										echo"
                                            <div class='colunas lg-3 md-3 pq-6'>
                                                <div class='foto'>
                                                    <figure>
                                                        <img src='webapp/uploads/produtos/".$result['foto_nome']."' alt='".$result['produto_titulo']."' title='".$result['produto_titulo']."'>
                                                    </figure>
                                                </div>
                                            </div>
                                            <a href='produtos/".$result['produto_url']."' title='".$result['produto_titulo']."' target='_parent'>
                                            <div class='colunas lg-3 md-3 pq-6 elemento-pai'>
                                                <div class='elemento-principal' style='padding-top: 0px'>
                                                    <p class='elemento-centralizado btn-saiba'>".$result['produto_titulo']."<br><span><i>".$result['categoria_pai_nome']."</i></span></p>
                                                </div>
                                            </div>
                                            </a>";
                                            $cont++;
                            }
                        }
                    ?>
                    </div>
        </div>

        <?php include('formulario.php') ?>

    </main>

    <?php include('core/mod_rodape/rodape.php');?>

</body>

</html>
