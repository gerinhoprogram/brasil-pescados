<?php if($pagina == 'Seja nosso parceiro' || $pagina == 'Contato' || $pagina == 'Catálogo') : ?>
<div class="div-contatos pb-70 parceiros">
    <?php else : ?>
    <div class="div-contatos pt-70 pb-70" id="form-id">
        <?php endif ?>

        <div class="linha">
            <div class="colunas lg-6 md-6 pq-12">

                <h2>
                    <?php echo ($pagina == 'Contato' ? 'Contato' : ($pagina == 'Catálogo' ? 'Catálogo' : 'Seja nosso <br> parceiro' )) ?>
                </h2>

                <?php if($pagina == 'Contato') : ?>
                    <p>Conheça, em detalhes, os benefícios da nossa marca. Preencha com seus dados e solicite um orçamento.</p>
                <?php elseif($pagina == 'Seja nosso parceiro' || $pagina == 'Home') : ?>
                    <p>Diferencie seus negócios<br> e dê um novo atrativo para<br>seus clientes.<br><span>Ofereça nossos produtos.</span></p>
                <?php else : ?>
                    <p>Preencha o formulário, e baixe nosso catálogo de produtos.</p>
                <?php endif ?>

                <?php if($pagina != 'Catálogo') : ?>
                <div class="redes">
                    <a href="mailto:<?php echo $sistema['sistema_email'] ?>" target="_blank" rel="noopener noreferrer" title="<?php echo $sistema['sistema_email'] ?>">
                        <div><i class="fa fa-envelope" aria-hidden="true"></i></div>
                    </a>
                    <a href="tel:+55<?php echo $sistema['sistema_telefone_fixo'] ?>" title="<?php echo $sistema['sistema_telefone_fixo'] ?>" target="_blank" rel="noopener noreferrer">
                        <i class="fa fa-phone"></i>
                    </a>
                    <a href="<?php echo $sistema['sistema_linkedin'] ?>" title="Linkedin" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
                <?php endif ?>

                <?php if($pagina == 'Contato') : ?>
                    <?php echo $sistema['sistema_dia_semana'] ?> <?php echo $sistema['sistema_horario'] ?>
                <?php endif ?>

                <?php if($pagina != 'FAQ') : ?>
                <!-- <p>Conheça o nosso <span><a href="faq" target="_parent" title="FAQ">FAQ!</a></span> </p> -->
                <?php endif ?>

            </div>
            <div class="colunas lg-2 md-1 pq-12">&nbsp;</div>
            <div class="colunas lg-4 md-5 pq-12 formulario">
                <form action="envia_parceria" method="POST">
                    <input type="hidden" name="tipo" value="<?php echo ($pagina == 'Contato' ? '4' : ($pagina == 'Catálogo' ? '3' : '2' )) ?>" />
                    <div class="label-float">
                        <input type="text" placeholder=" " name="nome" required maxlength="50" title="Digite seu nome" />
                        <label for="nome">Nome</label>
                    </div>

                    <div class="label-float">
                        <input type="text" placeholder=" " name="telefone" title="Digite seu telefone" id="telefone" onkeypress='return mascaraTELEFONE(this);' maxlength="15" />
                        <label for="telefone">Telefone</label>
                    </div>
                    <div class="label-float">
                        <input type="email" placeholder=" " name="email" required maxlength="100" title="Digite seu e-mail" />
                        <label for="email">E-mail</label>
                    </div>

                    <?php if($pagina != 'Catálogo') : ?>
                        <div class="label-float">
                            <input type="text" placeholder=" " name="assunto" required maxlength="150" title="Digite um assunto" />
                            <label for="assunto">Assunto</label>
                        </div>
                        <div class="label-float">
                            <textarea name="mensagem" title="Digite sua mensagem" maxlength="500" placeholder=" "></textarea>
                            <label for="mensagem">Mensagem</label>
                        </div>
                    <?php endif ?>
                    <button type="submit" class="btn-submit" title="Seja um parceiro"><?php echo ($pagina == 'Contato' ? 'Enviar' : ($pagina == 'Catálogo' ? 'Baixar' : 'Quero ser parceiro')) ?></button>

                </form>
            </div>
        </div>
    </div>
    <div class="div-email pt-70 pb-70">
            <div class="linha">
                <div class="colunas lg-12">
                    <h2>Receba nossas novidades por E-mail!</h2>
                    <form action="quero_novidades" method="POST">
                        <div class="label-float">
                            <input type="email" name="novidades" maxlength="150" required placeholder=" ">
                            <label for="novidades">E-mail</label>
                            <button class="btn-enviar" type="submit">Enviar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>