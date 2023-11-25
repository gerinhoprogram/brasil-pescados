<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{

		$data = array(
            'titulo' => 'Login áre restrita',
        );


		$this->load->view('restrita/layout/header');
		$this->load->view('restrita/login/index', $data);
		$this->load->view('restrita/layout/footer');
	}

	public function auth(){

		// CAMPOS OBRIGATORIOS DO PLUGIN
		$identity = $this->input->post('email');
		$password = $this->input->post('password');
		$remember = ($this->input->post('remember' ? true : false));
		
		if($this->ion_auth->login($identity, $password, $remember)){
			
			if($this->ion_auth->is_admin()){

				// SÓ O ADMINISTRADOR TEM ACESSO NA AREA RESTRITA
				redirect('restrita');

			}else{

				redirect('/');

			}

		}else{

				$this->session->set_flashdata('erro', 'Verifique suas credenciais de acesso!');
				redirect('restrita/'.$this->router->fetch_class());

		}

	}

	public function logout(){

		// ENCERRA A SESSÃO DO USUÁRIO
		$this->ion_auth->logout();
		redirect('restrita/'.$this->router->fetch_class());

	}


}