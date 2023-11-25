<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" data-theme="light">

<head>
    <?php 
        include('header.php');
        $pagina = 'FAQ'
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

        <div class="linha faq">
            <div class="colunas lg-12">
                <h2>Perguntas frequêntes</h2>
                <p>
                    Selecionamos as principais dúvidas para esclarecer para você
                </p>
            </div>
            <div class="colunas lg-12 mt-70 mb-70">
                <div class="accordions">
                    <?php 
                        $sql_box = "SELECT * FROM faq 
                            order by faq_id";
                            $stmt_box = $PDO->prepare($sql_box);
                            $stmt_box->execute();
                            $rows_box = $stmt_box->rowCount();
                            $cont=1;
                            if ($rows_box > 0) {
                                while ($result_box = $stmt_box->fetch()) {
                                    echo'
                                    <div class="accordion-item">
                                        <input type="checkbox" name="accordion" id="accordion-'.$cont.'" />
                                        <label for="accordion-'.$cont.'" title="Clique e veja a resposta">'.$result_box['pergunta'].' <span class="seta"></span></label>
                                        <div class="accordion-content">'.$result_box['resposta'].'</div>
                                    </div>';
                                    $cont++;
                                }
                            }
                        ?>
                    
                </div>
            </div>
            <div class="colunas lg-12 mb-70">
                <p>
                    Tem outras dúvidas? <br> Entre em contato conosco via <strong><a href="mailto:<?php echo $sistema['sistema_email'] ?>" target="_blank" rel="noopener noreferrer" title="<?php echo $sistema['sistema_email'] ?>">e-mail</a></strong> ou <a href="contato" title="Formulário de contato"
                        target="_parent">clique aqui</a> e preencha o formulário que, em breve, nossa equipe entrará em contato com você.
                </p>
            </div>
        </div>
        <?php include('formulario.php') ?>

    </main>

    <?php include('core/mod_rodape/rodape.php');?>

</body>

</html>