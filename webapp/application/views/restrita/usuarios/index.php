
 
    <div class="main-wrapper main-wrapper-1">
      
      <?php $this->load->view('restrita/layout/navbar') ?>

      <?php $this->load->view('restrita/layout/sidebar') ?>
      
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
                              <th class="nosort">Imagem</th>
                              <th>Nome</th>
                              <th>Login</th>
                              <th>Perfil de acesso</th>
                              <th class="text-center">Ativo</th>
                              <th class="nosort text-center">Ações</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php foreach($usuarios as $usuario) : ?>

                            <tr>
                              <td>
                                <img alt="image" src="<?php echo base_url('uploads/usuarios/'.$usuario->user_foto) ?>" width="35">
                              </td>
                              <td><?php echo $usuario->first_name ?></td>
                              <td><?php echo $usuario->email ?></td>
                              <td><?php echo ($this->ion_auth->is_admin($usuario->id) ? 'Web master' : 'Administrador') ?></td>
                              <td class="text-center"><?php echo ($usuario->active == 1 ? '<div class="badge badge-success badge-shadow">Sim</div>' : '<div class="badge badge-danger badge-shadow">Não</div>') ?></td>
                              <td class="text-center">
                                <!-- $this->router->fetch_class() - pega a função atual -->
                                <a href="<?php echo base_url('restrita/'.$this->router->fetch_class().'/core/'.$usuario->id) ?>" data-toggle="tooltip" data-placement="top" title="Alterar" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                <a href="<?php echo base_url('restrita/'.$this->router->fetch_class().'/delete/'.$usuario->id) ?>" data-toggle="tooltip" data-placement="top" title="Deletar" class="btn btn-danger delete" data-confirm="Tem certeza da exclusão do registro?"><i class="fas fa-trash alt"></i></a>
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
  