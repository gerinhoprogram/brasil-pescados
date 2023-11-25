
 
    <div class="main-wrapper main-wrapper-1">
      
      <?php $this->load->view('restrita/layout/navbar') ?>

      <?php $this->load->view('restrita/layout/sidebar') ?>

      <link href="<?php echo base_url('public/web/') ?>assets/css/lineicons-free.css" rel="stylesheet">

      <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/web/') ?>assets/fonts/line-icons.css">
      
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
          
            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header d-block">
                      <h4><?php echo $titulo ?></h4>
                    </div>
                    <div class="card-body">

                    <?php if($mensagem = $this->session->flashdata('sucesso')) : ?>
                    <div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>&times;</span>
                        </button>
                        <?php echo $mensagem ?>
                      </div>
                    </div>
                    <?php endif ?>

                    <?php if($mensagem = $this->session->flashdata('erro')) : ?>
                    <div class="alert alert-danger alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>&times;</span>
                        </button>
                        <?php echo $mensagem ?>
                      </div>
                    </div>
                    <?php endif ?>

                      <div class="table-responsive">
                        <table class="table table-striped data-table">
                          <thead>
                            <tr>
                              <th>Arquivo</th>
                              <th>Nome</th>
                              <th class="nosort text-center">Ações</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php foreach($catalogos as $cat) : ?>

                            <tr>
                             
                              <td>
                                <a target='_blanck' href="<?php echo base_url('uploads/catalogos/'.$cat->catalogo_arquivo) ?>" title="Baixar PDF de produtos">
                                <?php echo $cat->catalogo_arquivo ?>
                                </a>
                              </td>
                              <td><?php echo $cat->catalogo_nome ?></td>
                              <td class="text-center">
                                <!-- $this->router->fetch_class() - pega a função atual -->
                                <a href="<?php echo base_url('restrita/'.$this->router->fetch_class().'/core/'.$cat->catalogo_id) ?>" data-toggle="tooltip" data-placement="top" title="Alterar" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                              </td>
                            </tr>

                            <?php endforeach ?>

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


          </div>
        </section>
        <?php $this->load->view('restrita/layout/sidebar_config') ?>
      </div>
  