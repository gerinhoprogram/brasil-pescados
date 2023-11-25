<div class="linha topo d4">
    <div class="colunas pq-12 logo">
        <figure>
            <a href="home" target="_parent">
                <img src="webapp/uploads/sistema/<?php echo $sistema[ 'sistema_logo'] ?>" alt="Brasil Pescados" title="Brasil Pescados">
    </a>
        </figure>
    </div>
</div>

<div class="linha topo">

    <div class="topo-2">

        <div class="colunas lg-1 md-2 pq-3 logo d1">
            <figure>
                <a href="home" target="_parent">
            <img src="webapp/uploads/sistema/<?php echo $sistema['sistema_logo'] ?>" alt="Brasil Pescados" title="Brasil Pescados">
            </a>
            </figure>
        </div>

        <div class="colunas lg-8 md-7 pq-2 div-menu d2">
            <?php include('core/mod_menu/menu_site.php') ?>
        </div>

        <div class="colunas lg-2 md-3 pq-7 pesquisa-topo d3">
            <form action="produtos" method="POST">
                <div class="div-lupa">
                    <button type="submit" title="Clique para pesquisar"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
                <div class="label-float">
                    <input type="text" name="pesquisa" list="pesquisa" required maxlength="150" placeholder=" " title="Digite sua pesquisa">
                    <label for="pesquisa">Pesquisa</label>
                    <datalist id="pesquisa">
                    <?php 
                        $sql_pesq = "SELECT * FROM produtos
                            where produto_status = 1 order by produto_titulo";
                            $stmt_pesq = $PDO->prepare($sql_pesq);
                            $stmt_pesq->execute();
                            $rows_pesq = $stmt_pesq->rowCount();
                            if ($rows_pesq > 0) {
                                while ($result_pesq = $stmt_pesq->fetch()) {
                                    echo'<option value="'.$result_pesq['produto_titulo'].'" />';
                                }
                            }
                    ?>
                </datalist>
                </div>
            </form>
        </div>
    </div>

</div>