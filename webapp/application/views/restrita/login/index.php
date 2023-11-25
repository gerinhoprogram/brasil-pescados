
    <section class="section dark">
      <div class="container mt-5">
        <div class="row">
         
          <div class="col-6 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
          <figure class="text-center">
          <?php $sistema = info_header_footer() ?>
          <img width="120" src="<?php echo base_url('uploads/sistema/'.$sistema->sistema_logo)  ?>" alt="" class="mx-auto">
          </figure>
            <div class="card card-primary">
              <div class="card-header">
                <h4>Área restrita</h4>
              </div>
              <div class="card-body">
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

                <form method="POST" action="<?php echo base_url('restrita/'.$this->router->fetch_class().'/auth') ?>" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <i class="fas fa-user-tie"></i>
                            </div>
                        </div>
                        <input id="email" type="email" placeholder="Login" class="form-control" name="email" tabindex="1" required autofocus>
                    </div>
                    <div class="invalid-feedback">
                      Por favor, preencha esse campo corretamente.
                    </div>
                  </div>
                  <div class="form-group">
                   
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <i class="fas fa-unlock-alt"></i>
                            </div>
                        </div>
                        <input id="password" placeholder="Senha" type="password" class="form-control" name="password" tabindex="2" required>
                    </div>
                    <div class="invalid-feedback">
                    Por favor, preencha esse campo corretamente.
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Lembre-me</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Acessar
                    </button>
                  </div>
                </form>
    
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    