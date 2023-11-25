
 
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
                      <a href="<?php echo base_url('restrita/'.$this->router->fetch_class().'/core/') ?>" data-toggle="tooltip" data-placement="top" title="Novo" class="btn btn-primary float-right"><i class="fas fa-plus"></i>&nbsp;Novo</a>
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
                              <th>Nome da categoria</th>
                              <th>Status</th>
                              <th class="nosort text-center">Ações</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php foreach($masters as $master) : ?>

                            <tr>
                             
                              <td><?php echo $master->categoria_pai_nome ?></td>
                              <td class="text-center"><?php echo ($master->categoria_pai_ativa == 1 ? '<span class="badge badge-success">Ativo</span>' : '<span class="badge badge-danger">Inativo</span>') ?></td>
                              <td class="text-center">
                                <!-- $this->router->fetch_class() - pega a função atual -->
                                <a href="<?php echo base_url('restrita/'.$this->router->fetch_class().'/core/'.$master->categoria_pai_id) ?>" data-toggle="tooltip" data-placement="top" title="Alterar" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                <a href="<?php echo base_url('restrita/'.$this->router->fetch_class().'/delete/'.$master->categoria_pai_id) ?>" data-toggle="tooltip" data-placement="top" title="Deletar" class="btn btn-danger delete" data-confirm="Tem certeza da exclusão do registro?"><i class="fas fa-trash alt"></i></a>
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
  