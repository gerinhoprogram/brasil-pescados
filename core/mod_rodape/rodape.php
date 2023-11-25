<footer class="pt-70 pb-70">
    <div class="linha">
        <div class="colunas lg-12 md-12 pq-12 menu-rodape">
            <ul>
                <li><a href="home" target="_parent" title="Home">Home</a></li>
                <li><a href="quem-somos" target="_parent" title="Quem somos">Quem somos</a></li>
                <li><a href="produtos" target="_parent" title="Produtos">Produtos</a></li>
                <li><a href="seja-nosso-parceiro" target="_parent" title="Seja nosso parceiro">Seja nosso parceiro</a></li>
                <li><a href="contato" target="_parent" title="Contato">Contato</a></li>
            </ul>
        </div>
        <div class="colunas lg-12 md-12 pq-12 menu-redes">
            <div class="linha">
                <div class="colunas lg-5 md-4 pq-12 f-telefone">
                    <i class="fa fa-phone"></i>
                    <a href="tel:+55<?php echo $sistema['sistema_telefone_fixo'] ?>" title="<?php echo $sistema['sistema_telefone_fixo'] ?>" target="_blank" rel="noopener noreferrer">
                    &nbsp;<?php echo $sistema['sistema_telefone_fixo'] ?>
                    </a>
                </div>
                <div class="colunas lg-4 md-6 pq-12 f-email" >
                    <a href="mailto:<?php echo $sistema['sistema_email'] ?>" target="_blank" rel="noopener noreferrer" title="<?php echo $sistema['sistema_email'] ?>">
                        <i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;
                        <?php echo $sistema['sistema_email'] ?>
                    </a>
                </div>

                <div class="colunas lg-3 md-2 pq-12 f-redes">
                    <?php if($sistema['sistema_facebook']) : ?>
                        <a href="<?php echo $sistema['sistema_facebook'] ?>" target="_blank" rel="noopener noreferrer" title="Facebook">
                            <i class="fab fa-facebook-f" aria-hidden="true"></i>
                        </a>
                        &nbsp;
                    <?php endif ?>
                    <?php if($sistema['sistema_instagram']) : ?>
                        <a href="<?php echo $sistema['sistema_instagram'] ?>" target="_blank" rel="noopener noreferrer" title="Instagram">
                            <i class="fab fa-instagram" aria-hidden="true"></i>
                        </a>
                        &nbsp;
                    <?php endif ?>
                    <?php if($sistema['sistema_linkedin']) : ?>
                        <a href="<?php echo $sistema['sistema_linkedin'] ?>" target="_blank" rel="noopener noreferrer" title="Linkedin">
                            <i class="fab fa-linkedin" aria-hidden="true"></i>
                        </a>
                        &nbsp;
                    <?php endif ?>
                </div>
            </div>
        </div>
        <div class="colunas lg-12 md-12 pq-12 menu-contatos">
            <div class="linha">
                <!-- <div class="colunas lg-5 md-5 pq-12 f-faq">
                    <a href="faq" title="FAQ" target="_parent">
                        <i class="fa fa-question"></i>
                    &nbsp;FAQ</a>
                </div> -->
                <div class="colunas lg-12 md-7 pq-12 f-horarios" style="text-align: center">
                    <i class="fa fa-clock"></i>
                    &nbsp;<?php echo $sistema['sistema_dia_semana'] ?> <?php echo $sistema['sistema_horario'] ?>
                </div>
            </div>
           
        </div>
    </div>
</footer>

<script>
    let checkbox = document.querySelector('input[name=theme]');
    checkbox.addEventListener('change', function(){
        if(this.checked){
            document.documentElement.setAttribute('data-theme', 'dark');
        }else{
            document.documentElement.setAttribute('data-theme', 'light');
        }
    });

    function abreCategorias() {
        $('.content-menu').css('left', '0');
        $('.content-menu').css('z-index', '99999');
        $('.menu-principal .fa-caret-right').css('opacity', '0');
        $('.fecha-categorias').css('opacity', '9');
    }
    function fechaCategorias() {
        $('.content-menu').css('left', '-900px');
        $('.menu-principal .fa-caret-right').css('opacity', '9');
        $('.fecha-categorias').css('opacity', '0');
    }

    // abre produtos
    function abreProdutos1() {
        $('.content-submenu1').css('left', '0');
    }
    function abreProdutos2() {
        $('.content-submenu2').css('left', '0');
    }
    function abreProdutos3() {
        $('.content-submenu3').css('left', '0');
    }
    function abreProdutos4() {
        $('.content-submenu4').css('left', '0');
    }
    function abreProdutos5() {
        $('.content-submenu5').css('left', '0');
    }
    function abreProdutos6() {
        $('.content-submenu6').css('left', '0');
    }
    function abreProdutos7() {
        $('.content-submenu7').css('left', '0');
    }

    // fecha produtos
    function fechaProdutos1() {
        $('.content-submenu1').css('left', '-900px');
    }
    function fechaProdutos2() {
        $('.content-submenu2').css('left', '-900px');
    }
    function fechaProdutos3() {
        $('.content-submenu3').css('left', '-900px');
    }
    function fechaProdutos4() {
        $('.content-submenu4').css('left', '-900px');
    }
    function fechaProdutos5() {
        $('.content-submenu5').css('left', '-900px');
    }
    function fechaProdutos6() {
        $('.content-submenu6').css('left', '-900px');
    }
    function fechaProdutos7() {
        $('.content-submenu7').css('left', '-900px');
    }
  
</script>

<?php if($pagina == 'Contato' || $pagina == 'Catálogo' || $pagina == 'Seja nosso parceiro' || $pagina == 'Home' || $pagina == 'FAQ' || $pagina == 'Quem somos')  : ?>
<!-- carousel banner -->
<script src="core/mod_includes/js/js-carousel-boot.js"></script>
<?php endif ?>

<?php if($pagina == 'Home' || $produto != '') : ?>
<!-- owlCarousel -->
<link rel="stylesheet" href="core/css/owlcarousel/owl.carousel.css">
<script src="core/mod_includes/js/owl.carousel.js"></script>

<script type="text/javascript">
    jQuery('.owl-carousel ').owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 6000,
        margin: 5,
        responsiveClass: true,
        dotClass: true,
        nav: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },

            850: {
                items: 3,
                nav: true
            },
            1450: {
                items: 4,
                nav: true,
                dotClass: false,
            }
        }
    })
</script>
<!-- Fim ----- owlCarousel -->
<?php endif ?>
