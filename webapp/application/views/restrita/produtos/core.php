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
                                            <label>*Nome do produto</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-fish"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="produto_titulo" value="<?php echo (isset($produto) ? $produto->produto_titulo : set_value('produto_titulo')) ?>">
                                            </div>
                                            <?php echo form_error('produto_titulo', '<div class="text-danger">', '</div>') ?>
                                        </div>
                                    </div>
                                        
                                    <div class="form row">
                                        <div class="form-group col-md-6">
                                            <label class="mr-3">Categoria</label>
                                            <div class="input-group">
                                                    <select class="custom-select select2" name="produto_categoria_pai_id" id="master">
                                                    <?php if(isset($produto)) : ?>
                                                        <?php foreach($categorias_pai as $cat_id) : ?>
                                                            <option value="<?php echo $cat_id->categoria_pai_id ?>" <?php echo ($produto->produto_categoria_pai_id == $cat_id->categoria_pai_id ? 'Selected' : '') ?>><?php echo $cat_id->categoria_pai_nome ?></option>
                                                        <?php endforeach ?>
                                                    <?php else :?>
                                                        <?php foreach($categorias_pai as $cat_id) : ?>
                                                            <option value="<?php echo $cat_id->categoria_pai_id ?>"><?php echo $cat_id->categoria_pai_nome ?></option>
                                                        <?php endforeach ?>
                                                    <?php endif ?>
                                                        
                                                    </select>
                                            </div>
                                            <?php echo form_error('produto_categoria_pai_id', '<div class="text-danger">', '</div>') ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label >Status</label>
                                            <div class="input-group">
                                                    <select class="custom-select" name="produto_status">
                                                    <?php if(isset($produto)) : ?>
                                                        <option value="0" <?php echo ($produto->produto_status == 0 ? 'Selected' : '') ?>>Inativo</option>
                                                        <option value="1" <?php echo ($produto->produto_status == 1 ? 'Selected' : '') ?>>Ativo</option>
                                                    <?php else :?>
                                                        <option value="1">Ativo</option>
                                                        <option value="0">Inativo</option>
                                                    <?php endif ?>
                                                    </select>
                                            </div>
                                            <?php echo form_error('produto_status', '<div class="text-danger">', '</div>') ?>
                                        </div>
                                    </div>

                                    <div class="form row">
                                        <div class="form-group col-md-12">
                                            <label>Descrição</label>
                                            <textarea class="form-control" name="produto_descricao" ><?php echo (isset($produto) ? $produto->produto_descricao : '' ) ?></textarea>
                                            <?php echo form_error('produto_descricao', '<div class="text-danger">', '</div>') ?>
                                        </div>
                                    </div>

                                    <div class="form row">
                                        <div class="form-group col-md-8">
                                            <label>*Fotos</label>

                                            <div id="fileuploader"></div>
                                            <div id="errouploaded" class="text-danger"></div>
                                            <?php echo form_error('foto_produtos', '<div class="text-danger">', '</div>') ?>
                                            
                                        </div>
                                    </div>

                                    <div class="form row">
                                        <div class="form-group col-md-12">

                                            <div id="uploaded_image">
                                                            
                                                <?php if(isset($fotos_produto)) :?>
                                                    <?php foreach($fotos_produto as $foto) : ?>

                                                        <ul style="list-style: none; display: inline-block">

                                                            <li>
                                                                <img src="<?php echo base_url('uploads/produtos/'.$foto->foto_nome) ?>" alt="" width="80" class="img-thumbnail mr-1 mb2">
                                                                <input type="hidden" name="fotos_produtos[]" value="<?php echo $foto->foto_nome ?>">
                                                                <div class="btn bg-danger btn-block btn-icon text-white mx-auto mb-30 btn-remove" style="width: 100%; margin-top: 5px"><i class="fas fa-trash-alt"></i></div>
                                                            </li>
                                            
                                                        </ul>

                                                    <?php endforeach ?>
                                                <?php else :?>
                                                    <div id="box-foto-produto"></div>
                                                <?php endif ?>
                                            </div>
                                            
                                        </div>
                                    </div>

                                   <div class="form row">
                                        <?php if(isset($produto)) : ?>
                                            <input type="hidden" value="<?php echo $produto->produto_id ?>" name="produto_id">
                                        <?php endif ?>
                                   </div>
                                    
                                </div>
                                <div class="card-footer">
                                    <button id="btn-save-produto" type="submit" class="btn btn-primary">
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