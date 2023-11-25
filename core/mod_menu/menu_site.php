
<input type="checkbox" class="hanburguer" id="bt_menu" />
<label for="bt_menu" class="hanburguer"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></label>
<nav class="menu">
    <ul>
        <li class="seta-fechar"><label for="bt_menu"><i class="fas fa-angle-left fa-2x"></i></label></li>
        <li class="menu-principal"><a href="home" target="_parent" title="Home">Home</a></li>
        <li class="menu-principal"><a href="quem-somos" target="_parent" title="Quem somos">Quem somos</a></li>

        <li class="menu-principal menu-desk">
            <a href="javascript:;" target="_parent" title="Produtos">Produtos</a>
            <ul class="segundo-ul">

                <?php 
                        $sqlmenu = "SELECT * FROM categorias_pai 
                        where categoria_pai_ativa = 1";
                        $stmtmenu = $PDO->prepare($sqlmenu);
                        $stmtmenu->execute();
                        $rowsmenu = $stmtmenu->rowCount();
                        if ($rowsmenu > 0) {
                            while ($resultmenu = $stmtmenu->fetch()) {
                                $categoria_id = $resultmenu['categoria_pai_id'];
                                echo'
                                    <li class="submenu" style="position: relative">
                                        <a href="categorias/'.$resultmenu['categoria_pai_meta_link'].'" target="_parent" title="'.$resultmenu['categoria_pai_nome'].'"><i class="fa fa-caret-right" aria-hidden="true"></i>&nbsp;'.$resultmenu['categoria_pai_nome'].'</a>
                                        <ul class="terceiro-ul">';
                                                $sql_menu2 = "SELECT * FROM produtos 
                                                where produto_status = 1 and produto_categoria_pai_id = :produto_categoria_pai_id
                                                order by RAND()
                                                limit 5";
                                                $stmt_menu2 = $PDO->prepare($sql_menu2);
                                                $stmt_menu2->bindValue(':produto_categoria_pai_id', $categoria_id);
                                                $stmt_menu2->execute();
                                                $rows_menu2 = $stmt_menu2->rowCount();
                                                if ($rows_menu2 > 0) {
                                                    while ($result_menu2 = $stmt_menu2->fetch()) {
                                                        echo'
                                                            <li class="submenu2"><a href="produtos/'.$result_menu2['produto_url'].'" target="_parent" title="'.$result_menu2['produto_titulo'].'">'.$result_menu2['produto_titulo'].'</a></li>
                                                        ';
                                                    }
                                                }
                                                echo'<li class="ver-todos submenu2"><a href="categorias/'.$resultmenu['categoria_pai_meta_link'].'" target="_parent" title="Ver tudo"><i class="fa fa-plus" aria-hidden="true"></i> Ver tudo de '.$resultmenu['categoria_pai_nome'].'</a></li>
                                            </ul>
                                    </li>
                                ';
                            }
                        }
                ?>
            </ul>

        </li>

        <li class="menu-principal mob">
            <a class="menu-principal" href="javascript:;" onclick="abreCategorias()">Produtos <i class="fa fa-caret-right" aria-hidden="true"></i></a>
            <span onclick="fechaCategorias()" class="fecha-categorias"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
            <div class='content-menu'>

                <?php 
                $sqlmenu = "SELECT * FROM categorias_pai 
                where categoria_pai_ativa = 1";
                $stmtmenu = $PDO->prepare($sqlmenu);
                $stmtmenu->execute();
                $rowsmenu = $stmtmenu->rowCount();
                $cont_menu=1;
                    if ($rowsmenu > 0) {
                        
                        while ($resultmenu = $stmtmenu->fetch()) {
                            $categoria_id = $resultmenu['categoria_pai_id'];
                            echo'
                            <p onclick="abreProdutos'.$cont_menu.'()">'.$resultmenu['categoria_pai_nome'].'</p>
                            
                            <div class="content-submenu content-submenu'.$cont_menu.'">
                            <p onclick="fechaProdutos'.$cont_menu.'()" style="text-align: right; padding-right: 10px"><i class="fa fa-times-circle" aria-hidden="true"></i></p>
                            ';
                                $sql_menu2 = "SELECT * FROM produtos 
                                where produto_status = 1 and produto_categoria_pai_id = :produto_categoria_pai_id
                                order by RAND()
                                limit 4";
                                $stmt_menu2 = $PDO->prepare($sql_menu2);
                                $stmt_menu2->bindValue(':produto_categoria_pai_id', $categoria_id);
                                $stmt_menu2->execute();
                                $rows_menu2 = $stmt_menu2->rowCount();
                                if ($rows_menu2 > 0) {
                                    while ($result_menu2 = $stmt_menu2->fetch()) {
                                        echo'
                                            <a href="produtos/'.$result_menu2['produto_url'].'" class="submenu-mob">'.$result_menu2['produto_titulo'].'</a>
                                        ';
                                    }
                                }
                                echo'<a href="categorias/'.$resultmenu['categoria_pai_meta_link'].'" class="ver-todos-mob"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Ver tudo de '.$resultmenu['categoria_pai_nome'].'</a>';
                            echo'</div>';
                            $cont_menu++;  
                        }
                    }
                ?>
            </div>
        </li>

        <li class="menu-principal"><a href="seja-nosso-parceiro" target="_parent" title="Seja nosso parceiro">Seja nosso parceiro</a></li>
        <!-- <li class="menu-principal"><a href="faq" target="_parent" title="FAQ">FAQ</a></li> -->
        <li class="menu-principal"><a href="contato" target="_parent" title="Contato">Contato</a></li>
        <li class="li-contatos">
            <a href="mailto:<?php echo $sistema['sistema_email'] ?>" target="_blank" rel="noopener noreferrer" title="<?php echo $sistema['sistema_email'] ?>">
                <p>comercial@brasilpescados.com</p>
            </a>
            <a href="tel:+55<?php echo $sistema['sistema_telefone_fixo'] ?>" title="<?php echo $sistema['sistema_telefone_fixo'] ?>" target="_blank" rel="noopener noreferrer">
                <p>(11) 4290-1804</p>
            </a>
            <a href="<?php echo $sistema['sistema_linkedin'] ?>" target="_blank" rel="noopener noreferrer" title="Linkedin">
                <p>Linkedin</p>
            </a>
        </li>
    </ul>

</nav>