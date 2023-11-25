<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Graficos extends CI_Controller {

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
              'assets/bundles/apexcharts/apexcharts.min.js',
              'assets/js/page/chart-apexcharts.js'
            ),
            'dados' => $this->anuncios_model->get_all(),
            'categorias' => $this->core_model->get_all('categorias_pai', array('categoria_pai_ativa' => 1)),
            'dados_2' => $this->core_model->get_dados(),
            'datas' => $this->core_model->get_data(),

          );

        //   echo"<pre>";
        //   print_r($data['data']);
        //   exit();


		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/graficos/index');
		$this->load->view('restrita/layout/footer');
	}
}