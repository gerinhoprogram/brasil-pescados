<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema extends CI_Controller {

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

        $this->form_validation->set_rules('sistema_razao_social', 'Razão social', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('sistema_cnpj', 'CNPJ', 'trim|exact_length[18]');
        $this->form_validation->set_rules('sistema_telefone_fixo', 'Telefone', 'trim|exact_length[14]');
        $this->form_validation->set_rules('sistema_telefone_movel', 'Whatsap', 'trim|min_length[14]|max_length[15]');
        $this->form_validation->set_rules('sistema_email', 'E-mail', 'trim|required|valid_email|max_length[100]');
        $this->form_validation->set_rules('sistema_site_titulo', 'Título web site', 'trim|required|min_length[5]|max_length[100]');
        $this->form_validation->set_rules('sistema_cep', 'CEP', 'trim|exact_length[9]');
        $this->form_validation->set_rules('sistema_endereco', 'Endereço', 'trim|max_length[150]');
        $this->form_validation->set_rules('sistema_numero', 'Número', 'trim|max_length[25]');
        $this->form_validation->set_rules('sistema_bairro', 'Bairro', 'trim|max_length[100]');
        $this->form_validation->set_rules('sistema_cidade', 'Cidade', 'trim|max_length[150]');
        $this->form_validation->set_rules('sistema_instagram', 'Instagram', 'trim|max_length[255]');
        $this->form_validation->set_rules('sistema_facebook', 'Facebook', 'trim|max_length[255]');
        $this->form_validation->set_rules('sistema_linkedin', 'Linkedin', 'trim|max_length[255]');
        $this->form_validation->set_rules('sistema_estado', 'Estado', 'trim|exact_length[2]');
        $this->form_validation->set_rules('logo_foto_troca', 'Logo', 'trim|required');
        $this->form_validation->set_rules('icon_foto_troca', 'Ícone', 'trim|required');
        $this->form_validation->set_rules('sistema_dia_semana', 'Dias da semana', 'trim|max_length[255]');
        $this->form_validation->set_rules('sistema_horario', 'Horários', 'trim|max_length[255]');

        if($this->form_validation->run()){

                    $data = elements(
                        array(
                            'sistema_razao_social',
                            'sistema_cnpj',
                            'sistema_telefone_fixo',
                            'sistema_telefone_movel',
                            'sistema_email',
                            'sistema_cep',
                            'sistema_site_titulo',
                            'sistema_endereco',
                            'sistema_numero',
                            'sistema_bairro',
                            'sistema_estado',
                            'sistema_cidade',
                            'sistema_instagram',
                            'sistema_linkedin',
                            'sistema_facebook',
                            'sistema_dia_semana',
                            'sistema_horario'
                        ), $this->input->post()
                    ); 

                    $data = html_escape($data);

                    $data['sistema_logo'] = $this->input->post('logo_foto_troca');
                    $data['sistema_icon'] = $this->input->post('icon_foto_troca');

                    $this->core_model->update('sistema', $data, array('sistema_id' => 1));

                    redirect('restrita/'.$this->router->fetch_class());

        }else{

            $data = array(
                'titulo' => 'Sistema',
                'scripts' => array( 
                    'assets/mask/jquery.mask.min.js', 
                    'assets/mask/custom.js',
                    'assets/js/sistema.js'
                ),
                'sistema' => $this->core_model->get_by_id('sistema', array('sistema_id' => 1)),
            );
    
            $this->load->view('restrita/layout/header');
            $this->load->view('restrita/sistema/index', $data);
            $this->load->view('restrita/layout/footer');

        }
		
	}

    public function upload_logo(){

        $config['upload_path']          = './uploads/sistema/';
        $config['allowed_types']        = 'jpg|png';
        $config['encrypt_name']             = true;
        $config['max_size']             = 1500;
        $config['max_width']            = 1000;
        $config['max_height']           = 1000;

        $this->load->library('upload', $config);

        if($this->upload->do_upload('sistema_logo')){
            $data = array(
                'erro' => 0,
                'foto_envia' => $this->upload->data(),
                'logo_foto_troca' => $this->upload->data('file_name'),
                'mensagem' => 'Foto envia com sucesso'
            );
        }else{

            $data = array(
                'erro' => 3,
                'mensagem' => $this->upload->display_errors('<span class="text-danger">', '</span>')
            );

        }

        echo json_encode($data);

    }
    public function upload_icon(){

        $config['upload_path']          = './uploads/sistema/';
        $config['allowed_types']        = 'jpg|png';
        $config['encrypt_name']             = true;
        $config['max_size']             = 100;
        $config['max_width']            = 150;
        $config['max_height']           = 150;

        $this->load->library('upload', $config);

        if($this->upload->do_upload('sistema_icon')){
            $data = array(
                'erro' => 0,
                'foto_envia' => $this->upload->data(),
                'icon_foto_troca' => $this->upload->data('file_name'),
                'mensagem' => 'Foto envia com sucesso'
            );
        }else{

            $data = array(
                'erro' => 3,
                'mensagem' => $this->upload->display_errors('<span class="text-danger">', '</span>')
            );

        }

        echo json_encode($data);

    }
}