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
                                            <label>Pergunta</label>
                                            <textarea class="form-control" name="pergunta" ><?php echo (isset($faq) ? $faq->pergunta : '' ) ?></textarea>
                                            <?php echo form_error('pergunta', '<div class="text-danger">', '</div>') ?>
                                        </div>
                                    </div>

                                    <div class="form row">
                                        <div class="form-group col-md-12">
                                            <label>Resposta</label>
                                            <textarea class="form-control" name="resposta" ><?php echo (isset($faq) ? $faq->resposta : '' ) ?></textarea>
                                            <?php echo form_error('resposta', '<div class="text-danger">', '</div>') ?>
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