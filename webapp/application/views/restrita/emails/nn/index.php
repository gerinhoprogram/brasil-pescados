
 
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
              

              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="boxs mail_listing">
                    <div class="inbox-center table-responsive">
                      <table class="table table-hover">
                            <thead>
                              <tr>
                                <th colspan="4">
                                  <div class="inbox-header">
                                    <div class="mail-option">
                                      <div class="email-btn-group m-l-15">
                                        <a href="javascript:;" onclick='sel_baixa()' class="col-dark-gray waves-effect m-r-20" title="Deletar em lote" data-toggle="tooltip">
                                          <i class="material-icons">delete</i>
                                        </a> 
                                        <div class="p-r-20">|</div>
                                        <i class="material-icons col-red p-r-20" title="Baixou catálogo de produtos" data-toggle="tooltip">local_offer</i>
                                        <i class="material-icons col-cyan p-r-20" title="Contato de formulário" data-toggle="tooltip">local_offer</i></a>
                                        <i class="material-icons col-green p-r-20" title="Quero ser parceiro" data-toggle="tooltip">local_offer</i></a>
                                        <i class="material-icons col-blue p-r-20" title="Quero receber novidades por e-mail" data-toggle="tooltip">local_offer</i></a>
                                        
                                      </div>
                                    </div>
                                  </div>
                                </th>
                              </tr>
                            </thead>
                            <tbody>

                              <?php foreach ($emails as $email) : ?>
                                <tr class="unread">
                                  <td class="tbl-checkbox">
                                    <label class="form-check-label">
                                    <input type="checkbox" name="sel[]" id="sel_<?php echo $email->id ?>" value="<?php echo $email->id ?>">
                                      <span class="form-check-sign"></span>
                                    </label>
                                  </td>
                                  <td class="hidden-xs"><?php echo $email->contato_email ?></td>
                                  <td class="max-texts">
                                    <a href="mailto:<?php echo $email->contato_email ?>" data-toggle="tooltip" data-placement="top" title="Ver mensagem" class="msg" data-confirm="<?php echo '<p>'.$email->contato_nome .'</p><p>'.$email->contato_mensagem.'</p><p>'.formata_data_banco_com_hora($email->contato_data).'</p>' ?>">
                                      <span class="badge badge-<?php echo ($email->contato_email_id == 1 ? 'primary' : ($email->contato_email_id == 3 ? 'danger' : ($email->contato_email_id == 2 ? 'success' : 'info'))) ?>">
                                        <?php echo ($email->contato_email_id == 1 ? 'Quero novidades' : ($email->contato_email_id == 3 ? 'Baixei seu catálogo' : ($email->contato_email_id == 2 ? 'Quero ser parceiro' : $email->contato_assunto))) ?></span>
                                      <?php echo character_limiter($email->contato_mensagem, 50) ?>
                                    </a>
                                   
                                  </td>
                                
                                  <td class="text-right"><?php echo formata_data_banco_sem_hora($email->contato_data) ?> </td>
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
        <?php $this->load->view('restrita/emails/modal_sel_baixa'); ?>
      </div>

      <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Excluir mensagens</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Nenhuma mensagem foi selecionada.
              </div>
              <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
              </div>
            </div>
          </div>
        </div>

<script>
        function sel_baixa() {
          // carrega dados no modal

          event.preventDefault();
          if ($("input[name^=\"sel\"]:checked").not("[disabled]").length == 0) {
              $("#basicModal").modal("show");
              return;
          }

          var searchIDs = $("input[name^=\"sel\"]:checked").map(function() {
              return $(this).val();
          }).get();

          var data = { selecionados: searchIDs };
          $("#sel_baixa_ids").val(JSON.stringify(searchIDs));
          $.post(BASE_URL + "restrita/emails/get_all", data, function(res) {

                  $("#modal-sel-baixa").modal("show");
              
          }, false);
             
      }
          
  </script>

  