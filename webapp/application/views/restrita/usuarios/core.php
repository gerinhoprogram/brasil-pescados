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

                            <form action="" method="POST" name="form-core" accept_charset="utf-8" enctype="multipart/form-data">
                                <div class="card-body">

                                    <div class="form row">
                                        <div class="form-group col-md-6">
                                            <label>*Nome</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="first_name" value="<?php echo (isset($usuario) ? $usuario->first_name : set_value('first_name')) ?>">
                                            </div>
                                            <?php echo form_error('first_name', '<div class="text-danger">', '</div>') ?>
                                        </div>
                                       
                                        <div class="form-group col-md-6">
                                            <label>*E-mail</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-at"></i>
                                                    </div>
                                                </div>
                                                <input type="email" class="form-control" name="email" value="<?php echo (isset($usuario) ? $usuario->email : set_value('email')) ?>">
                                            </div>
                                            <?php echo form_error('email', '<div class="text-danger">', '</div>') ?>
                                        </div>
                                    </div>

                                    <div class="form row">
                                        <div class="form-group col-md-2">
                                            <label>Ativo</label>
                                            
                                            <select class="custom-select" name="active">

                                            <?php if(isset($usuario)) : ?>

                                                <option value="0" <?php echo ($usuario->active == 0 ? 'Selected' : '') ?>>Não</option>
                                                <option value="1" <?php echo ($usuario->active == 1 ? 'Selected' : '') ?>>Sim</option>

                                            <?php else : ?>

                                                <option value="0">Não</option>
                                                <option value="1">Sim</option>

                                            <?php endif ?>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>Perfil</label>
                                            
                                            <select class="custom-select" name="perfil">

                                            <?php foreach($grupos as $grupo) : ?>

                                            <?php if(isset($usuario)) : ?>

                                                <option value="<?php echo $grupo->id ?>" <?php echo ($perfil->id == $grupo->id ? 'selected' : '' ) ?>><?php echo $grupo->description ?></option>

                                            <?php else : ?>

                                                <option value="<?php echo $grupo->id ?>"><?php echo $grupo->description ?></option>

                                            <?php endif ?>

                                            <?php endforeach ?>
                                            </select>
                                        </div>
                                   
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
                                            <div id="user_foto"></div>
                                            <div id="carregando"></div>
                                        </div>
                                        <div class="form-group col-md-2">
                                           <?php if(isset($usuario)) : ?>

                                            <div id="box-foto-usuario">
                                                <input type="hidden" name="user_foto" value="<?php echo $usuario->user_foto ?>">
                                                <img src="<?php echo base_url('uploads/usuarios/'.$usuario->user_foto) ?>" class="rounded-circle" width="100" alt="">
                                            </div>

                                           <?php else : ?>

                                            
                                            <div id="box-foto-usuario">
                                            
                                            </div>

                                           <?php endif ?>

                                           <?php if(isset($usuario)) : ?>

                                           <input type="hidden" value="<?php echo $usuario->id ?>" name="usuario_id">

                                           <?php endif ?>
                                        </div>
                                    </div>

                                    <div class="form row">
                                        <div class="form-group col-md-6">
                                            <label>Senha</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-lock"></i>
                                                    </div>
                                                </div>
                                                <input type="password" class="form-control pwstrength" name="password" data-indicator="pwindicator">
                                            </div>
                                            <?php echo form_error('password', '<div class="text-danger">', '</div>') ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Confirma senha</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-lock"></i>
                                                    </div>
                                                </div>
                                                <input type="password" class="form-control pwstrength" name="confirma_senha" data-indicator="pwindicator">
                                            </div>
                                            <?php echo form_error('confirma_senha', '<div class="text-danger">', '</div>') ?>
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