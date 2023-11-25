<div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand pt-3 mb-5">
            <a href="<?php echo base_url('restrita/home')  ?>"> 
            <?php $sistema = info_header_footer() ?>
              <span class="logo-name"><img src="<?php echo base_url('uploads/sistema/'.$sistema->sistema_logo)  ?>" alt="" width="100"></span>
            </a>
          </div>
          <ul class="sidebar-menu mt-3">
            <li class="dropdown <?php echo ($this->router->fetch_class() == 'home' ? 'active' : '') ?>" >
              <a href="<?php echo base_url('restrita') ?>" class="nav-link"><i class="fas fa-tv"></i><span>Dashboard</span></a>
            </li>
            <li>
              <hr>
            </li>
            <li class="dropdown <?php echo ($this->router->fetch_class() == 'produtos' ? 'active' : '') ?>" >
              <a href="<?php echo base_url('restrita/produtos') ?>" class="nav-link"><i class="fas fa-fish"></i><span>Produtos</span></a>
            </li>
            
            <li class="dropdown <?php echo ($this->router->fetch_class() == 'master' ? 'active' : '') ?>">
              <a class="nav-link" href="<?php echo base_url('restrita/master') ?>"><i class="fas fa-layer-group"></i><span>Categorias</span></a>
            </li>

            <li class="dropdown <?php echo ($this->router->fetch_class() == 'faq' ? 'active' : '') ?>">
              <a class="nav-link" href="<?php echo base_url('restrita/faq') ?>"><i class="fas fa-question-circle"></i><span>FAQ</span></a>
            </li>

            <li class="dropdown <?php echo ($this->router->fetch_class() == 'emails' ? 'active' : '') ?>">
              <a class="nav-link" href="<?php echo base_url('restrita/emails') ?>"><i class="far fa-envelope"></i><span>E-mails</span></a>
            </li>
            <li>
              <hr>
            </li>
            <li class="dropdown <?php echo ($this->router->fetch_class() == 'usuarios' ? 'active' : '') ?>" >
              <a href="<?php echo base_url('restrita/usuarios') ?>" class="nav-link"><i class="fas fa-users"></i><span>Usuários</span></a>
            </li>
           
             <li class="dropdown <?php echo ($this->router->fetch_class() == 'sistema' ? 'active' : '') ?>" >
              <a href="<?php echo base_url('restrita/sistema') ?>" class="nav-link"><i class="fas fa-building"></i><span>Sistema</span></a>
            </li>
        
          </ul>
        </aside>
      </div>