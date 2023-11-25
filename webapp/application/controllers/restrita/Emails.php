<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emails extends CI_Controller {

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
            'titulo' => 'E-mails',
            'styles' => array(
                'assets/bundles/datatables/datatables.min.css', 
                'assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'),
            'scripts' => array(
                'assets/bundles/datatables/datatables.min.js',
                'assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
                'assets/bundles/jquery-ui/jquery-ui.min.js',
                'assets/js/page/datatables.js'
            ),
            'emails' => $this->core_model->get_all('formularios'),
        );

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/emails/index');
		$this->load->view('restrita/layout/footer');

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

    public function get_all(){
        $result = array('status' => true);

        $ids = $this->input->post('selecionados');
        
        if ($ids) {

            $cont=0;
            foreach($ids as $foto){
                $cont++;
            }

            for($i = 0; $i < $cont; $i++){

                $data = array(
                    'id' => $ids[$i]
                );
                echo $ids[$i];

                $this->core_model->delete('formularios', $data);

            }

            $res = 1;
            $result['data'] = $res;
        }else{
            $result['status'] = false;
            $result['message'] = 'Nenhum Lançamento Selecionado!!';
        }

        echo json_encode($result);
    }

    public function deletar(){
        echo "<pre>";
        print_r($this->input->post());
        exit();
    }
}
