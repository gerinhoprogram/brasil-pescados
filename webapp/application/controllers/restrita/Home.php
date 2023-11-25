<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct(){
        parent:: __construct();

		// DEFINE SE HÁ SESSÃO VÁLIDA
        if (!$this->ion_auth->logged_in())
        {
          redirect('restrita/login');
        }

        // SE NÃO FOR ADMIN SERÁ REDIRECIONADO PARA A PARTE PÚBLICA
        if (!$this->ion_auth->is_admin())
        {
          redirect('/');
        }

    }

	public function index()
	{

		$data = array(
            'titulo' => 'Home área restrita',
            'styles' => array(
              'assets/bundles/owlcarousel2/dist/assets/owl.carousel.min.css',
              'assets/bundles/owlcarousel2/dist/assets/owl.theme.default.min.css',
            ),
            'scripts' => array(
              'assets/bundles/owlcarousel2/dist/owl.carousel.min.js',
              'assets/js/page/widget-data.js'
            ),
            'produtos' => $this->produtos_model->get_all(),

          );

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/home/index');
		$this->load->view('restrita/layout/footer');
	}
}