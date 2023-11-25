<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {

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

        $this->load->model('core_model');

    }

	public function index()
	{

        $data = array(
            'titulo' => 'FAQ',
            'styles' => array(
                'assets/bundles/datatables/datatables.min.css', 
                'assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'),
            'scripts' => array(
                'assets/bundles/datatables/datatables.min.js',
                'assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
                'assets/bundles/jquery-ui/jquery-ui.min.js',
                'assets/js/page/datatables.js'
            ),
            'perguntas' => $this->core_model->get_all('faq'),
        );

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/faq/index');
		$this->load->view('restrita/layout/footer');

    }

    public function core($faq_id = null){

        $faq_id = (int) $faq_id;

        if(!$faq_id){
            // CADASTRAR NOVA faq

            $this->form_validation->set_rules('pergunta', 'Pergunta', 'trim|required|max_length[255]');
            $this->form_validation->set_rules('resposta', 'Resposta', 'trim|required');

            if($this->form_validation->run()){
                // FORMULARIO VALIDADO PRONTO PRA CADASTRAR

                $data = elements(
                    array(
                        'resposta',
                        'pergunta',
                    ),
                    
                    $this->input->post()
                );

                $data = html_escape($data);

                $this->core_model->insert('faq', $data);

                redirect('restrita/'.$this->router->fetch_class());

            }else{

                $data = array(
                    'titulo' => 'Cadastrar faq',
                    'styles' => array(
                        'assets/bundles/select2/dist/css/select2.min.css'),
                    'scripts' => array(
                        'assets/bundles/select2/dist/js/select2.full.min.js',
                    ),
                );
        
                $this->load->view('restrita/layout/header', $data);
                $this->load->view('restrita/faq/core');
                $this->load->view('restrita/layout/footer');

            }

        }else{

            if(!$faq = $this->core_model->get_by_id('faq', array('faq_id' => $faq_id))){

                $this->session->set_flashdata('erro', 'Faq não cadastrada no sistema!');
                redirect('restrita/'.$this->router->fetch_class());

            }else{
                // faq ENCONTRADA EDIÇÃO 

                $this->form_validation->set_rules('pergunta', 'Nome', 'trim|required|max_length[150]');
                $this->form_validation->set_rules('resposta', 'Resposta', 'trim|required');

                if($this->form_validation->run()){

                    $data = elements(
                        array(
                            'resposta',
                            'pergunta',
                        ),
                        
                        $this->input->post()
                    );

                    $data = html_escape($data);

                    $this->core_model->update('faq', $data, array('faq_id' => $faq->faq_id));

                    redirect('restrita/'.$this->router->fetch_class());

                }else{

                    $data = array(
                        'titulo' => 'Editando faq',
                        'styles' => array(
                            'assets/bundles/select2/dist/css/select2.min.css'),
                        'scripts' => array(
                            'assets/bundles/select2/dist/js/select2.full.min.js',
                        ),
                        'faq' => $faq,
                    );
            
                    $this->load->view('restrita/layout/header', $data);
                    $this->load->view('restrita/faq/core');
                    $this->load->view('restrita/layout/footer');

                }
            
            }

        }

    }

 
    public function delete($faq_id = null){

        $faq_id = (int) $faq_id;

        if(!$faq_id || !$faq = $this->core_model->get_by_id('faq', array('faq_id' => $faq_id))){
            $this->session->set_flashdata('erro', 'faq não encontrada!');
            redirect('restrita/'.$this->router->fetch_class());
        }

        $this->core_model->delete('faq', array('faq_id' => $faq->faq_id));
        redirect('restrita/'.$this->router->fetch_class());
    }
}
