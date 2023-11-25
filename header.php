<?php
    require_once("core/mod_includes/php/connect.php");

    $sql="SELECT * FROM  sistema";
    $stmt=$PDO->prepare($sql);
    $stmt->execute();
    $sistema = $stmt->fetch();
    $ttl=$sistema['sistema_razao_social'];

    $sql="SELECT * FROM  catalogo where catalogo_id = 1";
    $stmt=$PDO->prepare($sql);
    $stmt->execute();
    $catalogo = $stmt->fetch();

?>
    <base href="http://<?php echo $_SERVER['HTTP_HOST'];?>/site_painel/brasil-pescados/" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5.0">
    <meta charset="utf-8">
    <meta property="" content="" />
    <meta property="og:locale" content="pt_BR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $ttl ?>" />
    <meta property="og:description" content="Nossa marca nasce com a necessidade de facilitar o acesso das pessoas à alimentação saudável, por meio de peixes frescos e selecionados. Agora, com ainda mais facilidade, você encontra peixe conselado, nas mais diversas prateleiras, com preço acessível." />
    <meta property="og:url" content="" />
    <meta property="og:image" content="">
    <meta name="copyright" content="MogiComp Soluções Web">
    <meta name="robots" content="">
    <meta name="revisit-after" content="1 day">
    <meta name="description" content="Nossa marca nasce com a necessidade de facilitar o acesso das pessoas à alimentação saudável, por meio de peixes frescos e selecionados. Agora, com ainda mais facilidade, você encontra peixe conselado, nas mais diversas prateleiras, com preço acessível.">
    <meta name="keywords" content="peixes congelados, alimentação, peixes, pescados, ">

    <link rel="shortcut icon" href="webapp/uploads/sistema/<?php echo $sistema['sistema_icon']; ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="core/css/estrutura.css">
    <link rel="stylesheet" type="text/css" href="core/css/estilo.css">
    <link rel="stylesheet" type="text/css" href="core/css/menu.css">

    <script src="core/mod_includes/js/funcoes.js"></script>
    <script src="core/mod_includes/js/movimento-seta.js"></script>

    <div class="config">
        <input type="checkbox" name="theme" id="theme" style="display: none;">
        <label for="theme" title="Alterar cor de texto e fundo">
            <i class="fa fa-moon" aria-hidden="true"></i>
            <i class="fa fa-sun" aria-hidden="true"></i>
        </label>
    </div>

    