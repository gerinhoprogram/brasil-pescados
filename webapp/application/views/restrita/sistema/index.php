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

                            <form action="" method="POST" name="form-index" accept_charset="utf-8">
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

                                    <fieldset class="mb-4 border p-2">
                                    <legend class="font-md">Dados básicos</legend>
                                        <div class="form row">
                                            <div class="form-group col-md-8">
                                                <label>*Razão social</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                        <i class="fas fa-industry"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" name="sistema_razao_social" value="<?php echo (isset($sistema) ? $sistema->sistema_razao_social : set_value('sistema_razao_social')) ?>">
                                                </div>
                                                <?php echo form_error('sistema_razao_social', '<div class="text-danger">', '</div>') ?>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>CNPJ</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-money-check"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control cnpj" name="sistema_cnpj" value="<?php echo (isset($sistema) ? $sistema->sistema_cnpj : set_value('sistema_cnpj')) ?>">
                                                </div>
                                                <?php echo form_error('sistema_cnpj', '<div class="text-danger">', '</div>') ?>
                                            </div>
                                        </div>
                                        <div class="form row">
                                        <div class="form-group col-md-12">
                                            <label>*Título do site</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                    <i class="fas fa-laptop"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="sistema_site_titulo" value="<?php echo (isset($sistema) ? $sistema->sistema_site_titulo : set_value('sistema_site_titulo')) ?>">
                                            </div>
                                            <?php echo form_error('sistema_site_titulo', '<div class="text-danger">', '</div>') ?>
                                            <div id="sistema_site_titulo"></div>
                                        </div>
                                    </div>
                                    </fieldset>

                                    <fieldset class="mb-4 border p-2">
                                    <legend class="font-md">Contato</legend>

                                    <div class="form row">
                                        <div class="form-group col-md-4">
                                            <label>Telefone</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-phone"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control phone_with_ddd" name="sistema_telefone_fixo" value="<?php echo (isset($sistema) ? $sistema->sistema_telefone_fixo : set_value('sistema_telefone_fixo')) ?>">
                                            </div>
                                            <?php echo form_error('sistema_telefone_fixo', '<div class="text-danger">', '</div>') ?>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Celular</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                    <i class="fab fa-whatsapp"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control sp_celphones" name="sistema_telefone_movel" value="<?php echo (isset($sistema) ? $sistema->sistema_telefone_movel : set_value('sistema_telefone_movel')) ?>">
                                            </div>
                                            <?php echo form_error('sistema_telefone_movel', '<div class="text-danger">', '</div>') ?>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>*E-mail</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-at"></i>
                                                    </div>
                                                </div>
                                                <input type="email" class="form-control" name="sistema_email" value="<?php echo (isset($sistema) ? $sistema->sistema_email : set_value('sistema_email')) ?>">
                                            </div>
                                            <?php echo form_error('sistema_email', '<div class="text-danger">', '</div>') ?>
                                            <div id="sistema_email"></div>
                                        </div>
                                    </div>
                                    </fieldset>

                                    <fieldset class="mb-4 border p-2">
                                    <legend class="font-md">Localização</legend>
                                    <div class="form row">
                                        <div class="form-group col-md-4">
                                            <label>CEP</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="sistema_cep" value="<?php echo (isset($sistema) ? $sistema->sistema_cep : set_value('sistema_cep')) ?>">
                                            </div>
                                            <?php echo form_error('sistema_cep', '<div class="text-danger">', '</div>') ?>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Endereço</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="sistema_endereco" value="<?php echo (isset($sistema) ? $sistema->sistema_endereco : set_value('sistema_endereco')) ?>">
                                            </div>
                                            <?php echo form_error('sistema_endereco', '<div class="text-danger">', '</div>') ?>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Bairro</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="sistema_bairro" value="<?php echo (isset($sistema) ? $sistema->sistema_bairro : set_value('sistema_bairro')) ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form row">
                                        <div class="form-group col-md-3">
                                            <label>Estado</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    </div>
                                                </div>
                                                <select class="custom-select" name="sistema_estado">
                                                    <option value="AC" <?php echo ($sistema->sistema_estado == 'AC' ? 'selected' : ''); ?>>Acre</option>
                                                    <option value="AL" <?php echo ($sistema->sistema_estado == 'AL' ? 'selected' : ''); ?>>Alagoas</option>
                                                    <option value="AP" <?php echo ($sistema->sistema_estado == 'AP' ? 'selected' : ''); ?>>Amapá</option>
                                                    <option value="AM" <?php echo ($sistema->sistema_estado == 'AM' ? 'selected' : ''); ?>>Amazonas</option>
                                                    <option value="BA" <?php echo ($sistema->sistema_estado == 'BA' ? 'selected' : ''); ?>>Bahia</option>
                                                    <option value="CE" <?php echo ($sistema->sistema_estado == 'CE' ? 'selected' : ''); ?>>Ceará</option>
                                                    <option value="DF" <?php echo ($sistema->sistema_estado == 'DF' ? 'selected' : ''); ?>>Distrito Federal</option>
                                                    <option value="ES" <?php echo ($sistema->sistema_estado == 'ES' ? 'selected' : ''); ?>>Espírito Santo</option>
                                                    <option value="GO" <?php echo ($sistema->sistema_estado == 'GO' ? 'selected' : ''); ?>>Goiás</option>
                                                    <option value="MA" <?php echo ($sistema->sistema_estado == 'MA' ? 'selected' : ''); ?>>Maranhão</option>
                                                    <option value="MT" <?php echo ($sistema->sistema_estado == 'MT' ? 'selected' : ''); ?>>Mato Grosso</option>
                                                    <option value="MS" <?php echo ($sistema->sistema_estado == 'MS' ? 'selected' : ''); ?>>Mato Grosso do Sul</option>
                                                    <option value="MG" <?php echo ($sistema->sistema_estado == 'MG' ? 'selected' : ''); ?>>Minas Gerais</option>
                                                    <option value="PA" <?php echo ($sistema->sistema_estado == 'PA' ? 'selected' : ''); ?>>Pará</option>
                                                    <option value="PB" <?php echo ($sistema->sistema_estado == 'PB' ? 'selected' : ''); ?>>Paraíba</option>
                                                    <option value="PR" <?php echo ($sistema->sistema_estado == 'PR' ? 'selected' : ''); ?>>Paraná</option>
                                                    <option value="PE" <?php echo ($sistema->sistema_estado == 'PE' ? 'selected' : ''); ?>>Pernambuco</option>
                                                    <option value="PI" <?php echo ($sistema->sistema_estado == 'PI' ? 'selected' : ''); ?>>Piauí</option>
                                                    <option value="RJ" <?php echo ($sistema->sistema_estado == 'RJ' ? 'selected' : ''); ?>>Rio de Janeiro</option>
                                                    <option value="RN" <?php echo ($sistema->sistema_estado == 'RN' ? 'selected' : ''); ?>>Rio Grande do Norte</option>
                                                    <option value="RS" <?php echo ($sistema->sistema_estado == 'RS' ? 'selected' : ''); ?>>Rio Grande do Sul</option>
                                                    <option value="RO" <?php echo ($sistema->sistema_estado == 'RO' ? 'selected' : ''); ?>>Rondônia</option>
                                                    <option value="RR" <?php echo ($sistema->sistema_estado == 'RR' ? 'selected' : ''); ?>>Roraima</option>
                                                    <option value="SC" <?php echo ($sistema->sistema_estado == 'SC' ? 'selected' : ''); ?>>Santa Catarina</option>
                                                    <option value="SP" <?php echo ($sistema->sistema_estado == 'SP' ? 'selected' : ''); ?>>São Paulo</option>
                                                    <option value="SE" <?php echo ($sistema->sistema_estado == 'SE' ? 'selected' : ''); ?>>Sergipe</option>
                                                    <option value="TO" <?php echo ($sistema->sistema_estado == 'TO' ? 'selected' : ''); ?>>Tocantins</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Cidade</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="sistema_cidade" value="<?php echo (isset($sistema) ? $sistema->sistema_cidade : set_value('sistema_cidade')) ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Número</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="sistema_numero" value="<?php echo (isset($sistema) ? $sistema->sistema_numero : set_value('sistema_numero')) ?>">
                                            </div>
                                        </div>
                                    </div>
                                    </fieldset> 

                                    <fieldset class="mb-4 border p-2">
                                    <legend class="font-md">Redes sociais</legend>

                                    <div class="form-group row">
                                        <div class="form-group col-md-4">
                                            <label>Instagram</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                    <i class="fab fa-instagram"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="sistema_instagram" value="<?php echo (isset($sistema) ? $sistema->sistema_instagram : set_value('sistema_instagram')) ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Facebook</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                    <i class="fab fa-facebook"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="sistema_facebook" value="<?php echo (isset($sistema) ? $sistema->sistema_facebook : set_value('sistema_facebook')) ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Linkedin</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                    <i class="fab fa-linkedin"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="sistema_linkedin" value="<?php echo (isset($sistema) ? $sistema->sistema_linkedin : set_value('sistema_linkedin')) ?>">
                                            </div>
                                        </div>
                                    </div>

                                    </fieldset>

                                    <fieldset class="mb-4 border p-2">
                                    <legend class="font-md">Horários</legend>

                                    <div class="form-group row">
                                        <div class="form-group col-md-6">
                                            <label>Dias da semana</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="sistema_dia_semana" value="<?php echo (isset($sistema) ? $sistema->sistema_dia_semana : set_value('sistema_dia_semana')) ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Horário</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                    <i class="far fa-clock"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="sistema_horario" value="<?php echo (isset($sistema) ? $sistema->sistema_horario : set_value('sistema_horario')) ?>">
                                            </div>
                                        </div>
                                    </div>

                                    </fieldset>

                                    <fieldset class="mb-4 border p-2">
                                    <legend class="font-md">Logo</legend>

                                    <div class="form-group row">
                                        <div class="form-group col-md-7">
                                            <label>(PNG ou JPG | Tam. max.: 1500 MB | Alt. max.: 1000px | Larg. Max. 1000px)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-image"></i>
                                                    </div>
                                                </div>
                                                <input type="file" class="form-control" name="sistema_logo">
                                                <div id="carregando"></div>
                                                <div id="logo_foto_troca"></div>
                                                <?php echo form_error('sistema_logo','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-5">
                                            <div id="box-foto-logo">
                                                <input type="hidden" name="logo_foto_troca" value="<?php echo $sistema->sistema_logo ?>">
                                                <img src="<?php echo base_url('uploads/sistema/'.$sistema->sistema_logo) ?>" alt="" width="200">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </fieldset>
                                <fieldset class="mb-4 border p-2">
                                    <legend class="font-md">*Ícone</legend>

                                    <div class="form-group row">
                                        <div class="form-group col-md-7">
                                            <label>(PNG ou JPG | Tam. max.: 100 KB | Alt. max.: 150px | Larg. Max. 150px)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-image"></i>
                                                    </div>
                                                </div>
                                                <input type="file" class="form-control" name="sistema_icon">
                                                <div id="carregando_icon"></div>
                                                <div id="icon_foto_troca"></div>
                                                <?php echo form_error('sistema_icon','<small id="emailHelp" class="form-text text-danger">','</small>'); ?>

                                            </div>
                                        </div>

                                        <div class="form-group col-md-5">
                                            <div id="box-foto-icon">
                                                <input type="hidden" name="icon_foto_troca" value="<?php echo $sistema->sistema_icon ?>">
                                                <img src="<?php echo base_url('uploads/sistema/'.$sistema->sistema_icon) ?>" alt="">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </fieldset>
                                    
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">
                                    Salvar
                                  </button>
                                </div>
                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </section>
        <?php $this->load->view('restrita/layout/sidebar_config') ?>
    </div>