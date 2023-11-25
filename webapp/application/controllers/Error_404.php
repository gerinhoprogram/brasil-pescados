<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error_404 extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data = array(
			'titulo' => 'Página não encontrada',
		);

        if($this->ion_auth->is_admin()){
            $this->load->view('restrita/layout/header', $data);
            $this->load->view('restrita/error_404');
            $this->load->view('restrita/layout/footer');
        }else{
            $this->load->view('web/layout/header', $data);
            $this->load->view('web/error_404');
            $this->load->view('web/layout/footer');
        }

		
		
	}
}
