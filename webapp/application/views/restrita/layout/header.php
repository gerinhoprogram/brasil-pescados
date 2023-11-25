<!DOCTYPE html>
<html lang="en">


<!-- blank.html  21 Nov 2019 03:54:41 GMT -->
<head>
  <?php $sistema = info_header_footer() ?>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url('public/restrita/assets/css/app.min.css') ?>">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url('public/restrita/assets/css/style.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('public/restrita/assets/css/components.css') ?>">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="<?php echo base_url('public/restrita/assets/css/custom.css') ?>">
  <link rel='shortcut icon' type='image/x-icon' href='<?php echo base_url('uploads/sistema/'.$sistema->sistema_icon)?>' />

  <title><?php echo $sistema->sistema_site_titulo ?></title>

  <?php if(isset($styles)) : ?>

    <?php foreach($styles as $estilo) : ?>

      <link rel="stylesheet" href="<?php echo base_url('public/restrita/').$estilo ?>">

    <?php endforeach ?>

  <?php endif ?>

</head>

<body class="dark dark-sidebar theme-black">
  <style>
    .loader{position:fixed;left:0px;top:0px;width:100%;height:100%;z-index:9999;background:url("<?php echo base_url('uploads/sistema/'.$sistema->sistema_logo)  ?>") 50% 50% no-repeat #f9f9f9;opacity:1;}
  </style>
  <div class="loader text-center dark">
          <img src="<?php echo base_url('public/restrita/assets/img/typing.svg')  ?>" alt="" style="margin-top: 100px">
  </div>
  <div id="app">