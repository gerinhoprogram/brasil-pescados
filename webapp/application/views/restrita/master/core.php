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
                                        <div class="form-group col-md-4">
                                            <label>*Nome da categoria</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-sitemap"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="categoria_pai_nome" value="<?php echo (isset($categorias) ? $categorias->categoria_pai_nome : set_value('categoria_pai_nome')) ?>">
                                            </div>
                                            <?php echo form_error('categoria_pai_nome', '<div class="text-danger">', '</div>') ?>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Status</label>
                                            
                                            <select class="custom-select" name="categoria_pai_ativa">

                                            <?php if(isset($categorias)) : ?>

                                                <option value="0" <?php echo ($categorias->categoria_pai_ativa == 0 ? 'Selected' : '') ?>>Inativo</option>
                                                <option value="1" <?php echo ($categorias->categoria_pai_ativa == 1 ? 'Selected' : '') ?>>Ativo</option>

                                            <?php else : ?>

                                                <option value="1">Ativo</option>
                                                <option value="0">Inativo</option>

                                            <?php endif ?>
                                            </select>
                                        </div>
                                        
                                    </div>

                                   
                                    <?php if(isset($categorias)) : ?>

                                    <input type="hidden" value="<?php echo $categorias->categoria_pai_id ?>" name="categoria_pai_id">

                                    <?php endif ?>

                                    
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