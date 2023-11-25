<div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li>
              <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"> 
                <i data-feather="align-justify" data-toggle="tooltip" data-placement="top" title="Encolher menu"></i>
              </a>
            </li>
            <li>
              <a href="#" class="nav-link nav-link-lg fullscreen-btn" data-toggle="tooltip" data-placement="top" title="Tela cheia">
                <i data-feather="maximize"></i>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url('restrita/catalogo') ?>" class="nav-link nav-link-lg" data-toggle="tooltip" data-placement="top" title="Adicionar catálogo">
                <i data-feather="file"></i>
              </a>
            </li>
          
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link nav-link-lg message-toggle"><i data-feather="mail"></i>
              <span class="badge headerBadge1">
                6 </span> </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Messages
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-message">
                <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar
											text-white"> <img alt="image" src="assets/img/users/user-1.png" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">John
                      Deo</span>
                    <span class="time messege-text">Please check your mail !!</span>
                    <span class="time">2 Min Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="assets/img/users/user-2.png" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Sarah
                      Smith</span> <span class="time messege-text">Request for leave
                      application</span>
                    <span class="time">5 Min Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="assets/img/users/user-5.png" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Jacob
                      Ryan</span> <span class="time messege-text">Your payment invoice is
                      generated.</span> <span class="time">12 Min Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="assets/img/users/user-4.png" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Lina
                      Smith</span> <span class="time messege-text">hii John, I have upload
                      doc
                      related to task.</span> <span class="time">30
                      Min Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="assets/img/users/user-3.png" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Jalpa
                      Joshi</span> <span class="time messege-text">Please do as specify.
                      Let me
                      know if you have any query.</span> <span class="time">1
                      Days Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="assets/img/users/user-2.png" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Sarah
                      Smith</span> <span class="time messege-text">Client Requirements</span>
                    <span class="time">2 Days Ago</span>
                  </span>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown dropdown-list-toggle">
            <?php 
            $anuncios = get_anuncios_nao_auditados();
            $anunciantes_block = get_contas_bloqueadas()?>

            <?php if($anuncios > 0 || $anunciantes_block > 0) :?>
              <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg"><i data-feather="bell" class="bell"></i></a>
            <?php endif ?>

            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Notificações
              </div>

              <div class="dropdown-list-content dropdown-list-icons">

                <?php if($anuncios > 0 ) :?>
                  <a href="<?php echo base_url('restrita/anuncios') ?>" class="dropdown-item dropdown-item-unread"> 
                    <span class="dropdown-item-icon bg-primary text-white"> 
                      <i class="fas fa-tags"></i> 
                    </span> 
                    <span class="dropdown-item-desc"> Existem <?php echo $anuncios ?> anúncios não auditados!
                      <span class="time">Verificar</span>
                    </span>
                  </a> 
                <?php endif ?>

                <?php if($anunciantes_block > 0 ) :?>
                  <a href="<?php echo base_url('restrita/usuarios') ?>" class="dropdown-item dropdown-item-unread"> 
                    <span class="dropdown-item-icon bg-danger text-white"> 
                      <i class="fas fa-users"></i> 
                    </span> 
                    <span class="dropdown-item-desc"> 
                      Existe (m) <?php echo $anunciantes_block ?> anunciante (s) bloquado (s)!
                    </span>
                  </a> 
                <?php endif ?>

              </div>
              <div class="dropdown-footer text-center">
                <a href="#">Ver tudo <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">

              <?php $user = $this->ion_auth->user()->row(); ?>
              <img alt="image" src="<?php echo base_url('uploads/usuarios/'.$user->user_foto) ?>"class="user-img-radious-style"> 
              <span class="d-sm-none d-lg-inline-block"></span>

            </a>

            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title"><?php echo $user->first_name ?></div>
              <a href="<?php echo base_url('restrita/usuarios/core/'.$user->id) ?>" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Perfil
              </a> 
             
              <div class="dropdown-divider"></div>
              <a href="<?php echo base_url('restrita/login/logout/') ?>" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Sair
              </a>
            </div>
          </li>
        </ul>
      </nav>