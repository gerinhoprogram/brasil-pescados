<div class="main-wrapper main-wrapper-1">

    <?php $this->load->view('restrita/layout/navbar') ?>

    <?php $this->load->view('restrita/layout/sidebar') ?>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    <?php echo $titulo ?>
                                </h4>
                            </div>

                            <form action="" method="POST" name="form-core" accept_charset="utf-8">
                                <div class="card-body">

                                    <div class="form row">
                                        <div class="form-group col-md-12">
                                            <label>*Nome da categoria</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="catalogo_nome" value="<?php echo (isset($catalogo) ? $catalogo->catalogo_nome : set_value('catalogo_nome')) ?>">
                                            </div>
                                            <?php echo form_error('catalogo_nome', '<div class="text-danger">', '</div>') ?>
                                        </div>
                                    </div>
                                    <div class="form row">
                                            <div class="form-group col-md-6">
                                                <label>Foto</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-image"></i>
                                                        </div>
                                                    </div>
                                                    <input type="file" class="form-control" name="user_foto_file">
                                                </div>
                                                <?php echo form_error('user_foto_file', '<div class="text-danger">', '</div>') ?>

                                                <div id="user_foto"></div>
                                                <div id="carregando"></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                            
                                                <div id="box-foto-usuario">
                                                </div>

                                            </div>
                                    </div>
                                    
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">
                                    Salvar
                                  </button>
                                    <a href="<?php echo base_url('restrita/'.$this->router->fetch_class()) ?>" class="btn btn-dark">Voltar</a>
                                </div>
                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </section>
        <?php $this->load->view('restrita/layout/sidebar_config') ?>
    </div>