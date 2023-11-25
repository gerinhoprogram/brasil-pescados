
 
    <div class="main-wrapper main-wrapper-1">
      
      <?php $this->load->view('restrita/layout/navbar') ?>

      <?php $this->load->view('restrita/layout/sidebar') ?>
      
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
                      <!-- <h4><?php echo $titulo ?></h4> -->

                      <!-- dados da sessão -->
                      <?php 
                          // echo'<pre>';
                          // print_r($this->session->userdata());
                          // echo'</pre>';
                      ?>

          <div class="row ">

                <div class="col-12">

                <div class="card card-danger">
                  <div class="card-header">
                    <h4>Produtos</h4>
                    <div class="card-header-action">
                      <a href="<?php echo base_url('restrita/produtos') ?>" class="btn btn-danger btn-icon icon-right">Ver todos <i class="fas fa-chevron-right"></i></a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="owl-carousel owl-theme" id="users-carousel">

                      <?php foreach($produtos as $produto) :?>
                      <div>
                        <div class="user-item" style="height: 300px">
                          <img style="height: 150px; width: 100%; object-fit: contain" alt="image" src="<?php echo base_url('uploads/produtos/'.$produto->foto_nome) ?>" class="img-fluid mx-auto">
                          <div class="user-details">
                            <div class="user-name"><?php echo $produto->produto_titulo ?></div>
                            <div class="text-job text-muted"><?php echo ($produto->produto_status == 1 ? 'Ativo' : 'Inativo') ?></div>
                            <div class="user-cta">
                              <a href="<?php echo base_url('restrita/produtos/core/'.$produto->produto_id) ?>">
                              <button class="btn btn-warning">Editar</button>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php endforeach ?>
                      
                    </div>
                  </div>
                </div>
              </div>
              

                </div>
          </div>
                     
          </div>
        </section>
        <?php $this->load->view('restrita/layout/sidebar_config') ?>
      </div>
  

      