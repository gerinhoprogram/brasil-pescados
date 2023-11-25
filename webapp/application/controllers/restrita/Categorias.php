<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

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

        $this->load->model('categorias_model');

    }

	public function index()
	{

        $data = array(
            'titulo' => 'Categorias cadastradas',
            'styles' => array(
                'assets/bundles/datatables/datatables.min.css', 
                'assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'),
            'scripts' => array(
                'assets/bundles/datatables/datatables.min.js',
                'assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
                'assets/bundles/jquery-ui/jquery-ui.min.js',
                'assets/js/page/datatables.js'
            ),
            'categorias' => $this->categorias_model->get_all_categorias(),
        );

        // echo"<pre>";
        // print_r($data['categoriass']);
        // exit();


		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/categorias/index');
		$this->load->view('restrita/layout/footer');

    }

    public function core($categoria_id = null){

        $categoria_id = (int) $categoria_id;

        if(!$categoria_id){
            // CADASTRAR NOVA CATEGORIA

            $this->form_validation->set_rules('categoria_nome', 'Nome', 'trim|required|max_length[150]|callback_valida_nome_categoria');
            $this->form_validation->set_rules('categoria_pai_id', 'Categoria pai', 'trim|required');

            if($this->form_validation->run()){
                // FORMULARIO VALIDADO PRONTO PRA CADASTRAR

                $data = elements(
                    array(
                        'categoria_nome',
                        'categoria_ativa',
                        'categoria_pai_id'
                    ),
                    
                    $this->input->post()
                );

                // meta link da categoria
                $data['categoria_meta_link'] = url_amigavel($data['categoria_nome']) ;

                $data = html_escape($data);

                $this->core_model->insert('categorias', $data);

                redirect('restrita/'.$this->router->fetch_class());

            }else{

                $data = array(
                    'titulo' => 'Cadastrar categoria',
                    'styles' => array(
                        'assets/bundles/select2/dist/css/select2.min.css'),
                    'scripts' => array(
                        'assets/bundles/select2/dist/js/select2.full.min.js',
                    ),
                    'masters' => $this->core_model->get_all('categorias_pai', array('categoria_pai_ativa' => 1)),
                );
        
                $this->load->view('restrita/layout/header', $data);
                $this->load->view('restrita/categorias/core');
                $this->load->view('restrita/layout/footer');

            }

        }else{

            if(!$categoria = $this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))){
                // CATEGORIA NÃO ENCONTRADA

                echo"<pre>";
                print_r('tetse');
                exit();

                $this->session->set_flashdata('erro', 'Categoria não cadastrada no sistema!');
                redirect('restrita/'.$this->router->fetch_class());

            }else{
                // CATEGORIA ENCONTRADA EDIÇÃO 

                $this->form_validation->set_rules('categoria_nome', 'Nome', 'trim|required|max_length[150]|callback_valida_nome_categoria');
                $this->form_validation->set_rules('categoria_pai_id', 'Categoria pai', 'trim|required');

                if($this->form_validation->run()){
                    // FORMULARIO VALIDADO PRONTO PRA CADASTRAR

                    // echo"<pre>";
                    // print_r($this->input->post());
                    // exit();

                    $data = elements(
                        array(
                            'categoria_nome',
                            'categoria_pai_id',
                            'categoria_ativa'
                        ),
                        
                        $this->input->post()
                    );

                    // meta link da categoria
                    $data['categoria_meta_link'] = url_amigavel($data['categoria_nome']) ;

                    $data = html_escape($data);

                    $this->core_model->update('categorias', $data, array('categoria_id' => $categoria->categoria_id));

                    redirect('restrita/'.$this->router->fetch_class());

                }else{

                    $data = array(
                        'titulo' => 'Editando categoria',
                        'styles' => array(
                            'assets/bundles/select2/dist/css/select2.min.css'),
                        'scripts' => array(
                            'assets/bundles/select2/dist/js/select2.full.min.js',
                        ),
                        'categorias' => $categoria,
                        'masters' => $this->core_model->get_all('categorias_pai', array('categoria_pai_ativa' => 1)),
                    );
            
                    $this->load->view('restrita/layout/header', $data);
                    $this->load->view('restrita/categorias/core');
                    $this->load->view('restrita/layout/footer');


                }
            
            }

        }

        

    }

    public function valida_nome_categoria($categoria_nome){

        $categoria_id = $this->input->post('categoria_id');

        if(!$categoria_id){
            // CADASTRANDO.....

            if($this->core_model->get_by_id('categorias', array('categoria_nome' => $categoria_nome))){

                $this->form_validation->set_message('valida_nome_categoria', 'Essa categoria já existe!');
                return false;

            }else{

                return true;

            }

        }else{
            // EDITANDO......

            if($this->core_model->get_by_id('categorias', array('categoria_nome' => $categoria_nome, 'categoria_id !=' => $categoria_id))){

                $this->form_validation->set_message('valida_nome_categoria', 'Essa categoria já existe!');
                return false;

            }else{

                return true;

            }

        }

    }

    public function delete($categoria_id = null){

        $categoria_id = (int) $categoria_id;

        if(!$categoria_id || !$categoria = $this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))){
            $this->session->set_flashdata('erro', 'Categoria não encontrada!');
            redirect('restrita/'.$this->router->fetch_class());
        }

        if($categoria->categoria_ativa == 1){
            $this->session->set_flashdata('erro', 'Não é posssível deletar uma categoria ativa!');
            redirect('restrita/'.$this->router->fetch_class());
        }

        $this->core_model->delete('categorias', array('categoria_id' => $categoria->categoria_id));
        redirect('restrita/'.$this->router->fetch_class());


    }
}
