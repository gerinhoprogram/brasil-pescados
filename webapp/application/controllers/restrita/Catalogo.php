<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogo extends CI_Controller {

    public function __construct(){
        parent:: __construct();

        //DEFINE SE HÁ SESSÃO VÁLIDA
        if (!$this->ion_auth->logged_in())
        {
          redirect('restrita/login');
        }

        //SE NÃO FOR ADMIN SERÁ REDIRECIONADO PARA A PARTE PÚBLICA
        if (!$this->ion_auth->is_admin())
        {
          redirect('/');
        }

    }

	public function index()
	{

        $data = array(
            'titulo' => 'Catálogo',
            'styles' => array(
                'assets/bundles/datatables/datatables.min.css', 
                'assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'),
            'scripts' => array(
                'assets/bundles/datatables/datatables.min.js',
                'assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
                'assets/bundles/jquery-ui/jquery-ui.min.js',
                'assets/js/page/datatables.js'
            ),
        );

        $data['catalogos'] = $this->core_model->get_all('catalogo');

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/catalogo/index');
		$this->load->view('restrita/layout/footer');

    }

    public function core($catalogo_id = null){

        $catalogo_id = (int) $catalogo_id;

            $this->form_validation->set_rules('user_foto_file', 'Título do Produto', 'trim|required');
            $this->form_validation->set_rules('catalogo_nome', 'Situação do Produto', 'trim|required');

            if($this->form_validation->run()){

                $data = elements(
                    array(
                        'catalogo_arquivo',
                        'catalogo_nome',
                    ), $this->input->post()
                );

                $data['catalogo_arquivo'] = $this->input->post('user_foto_file');

                // atualiza o produto
                $this->core_model->update('catalogo', $data, array('catalogo_id' => $catalogo_id));

                redirect('restrita/'.$this->router->fetch_class());

            }else{

                $data = array(
                    'titulo' => 'Adicionar Catálogo',
                    'styles' => array(
                        'assets/jquery-upload-file/css/uploadfile.css',
                        'assets/bundles/select2/dist/css/select2.min.css', 
                    ),
                    'scripts' => array(
                        'assets/js/catalogo.js', 
                    ),

                    'catalogo' => $this->core_model->get_by_id('catalogo', array('catalogo_id' => $catalogo_id )),
                );

                $this->load->view('restrita/layout/header', $data);
                $this->load->view('restrita/catalogo/core');
                $this->load->view('restrita/layout/footer');

            }

    }

    public function upload(){

        $config['upload_path']          = './uploads/catalogos/';
        $config['allowed_types']        = 'pdf|PDF';
        $config['max_size']             = 9000; // max 1mg

        $this->load->library('upload', $config);

        if($this->upload->do_upload('user_foto_file')){

            $data = array(
                'erro' => 0,
                'uploaded_data' => $this->upload->data(''),    
                'foto_nome' => $this->upload->data('file_name'),
                'mensagem' => 'Foto enviada',        
            );
            
        }else{
            // erros no upload da imagem
            $data = array(
                'erro' => 4,
                'mensagem' => $this->upload->display_errors('<span class="text-danger">', '</span>'),
            );
        }

        echo json_encode($data);

    }

   
}
