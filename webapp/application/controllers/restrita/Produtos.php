<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Controller {

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
            'titulo' => 'Produtos cadastrados',
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

        $data['produtos'] = $this->produtos_model->get_all();

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/produtos/index');
		$this->load->view('restrita/layout/footer');

    }

    public function core($produto_id = null){

        $produto_id = (int) $produto_id;

        if(!$produto_id){
            $this->form_validation->set_rules('produto_titulo', 'Título do Produto', 'trim|required|max_length[200]');
            $this->form_validation->set_rules('produto_status', 'Situação do Produto', 'trim|required');
            $this->form_validation->set_rules('produto_categoria_pai_id', 'Categoria principal', 'trim|required');

            $fotos_produtos = $this->input->post('fotos_produtos');
            if(!$fotos_produtos){
                $this->form_validation->set_rules('fotos_produtos', 'Fotos do item', 'trim|required');
            }

            $this->form_validation->set_rules('produto_descricao', 'Descrição do Produto', 'trim|min_length[0]|max_length[5000]');
            

            if($this->form_validation->run()){

                $data = elements(
                    array(
                        'produto_titulo',
                        'produto_categoria_pai_id',
                        'produto_status',
                        'produto_descricao',
                    ), $this->input->post()
                );

                $data['produto_url'] = url_amigavel($data['produto_titulo']);

                // atualiza o produto
                $this->core_model->insert('produtos', $data, true);

                $last_produto_id = $this->session->userdata('last_id');

                // remove as fotos antigas 
                $this->core_model->delete('produto_fotos', array('foto_produto_id' => $produto->produto_id));

                $fotos_produtos = $this->input->post('fotos_produtos');
                $total_fotos = count($fotos_produtos);

                $cont=0;
                foreach($fotos_produtos as $foto){
                    $cont++;
                }

                for($i = 0; $i < $cont; $i++){

                    $data = array(
                        'foto_produto_id' => $last_produto_id,
                        'foto_nome' => $fotos_produtos[$i],
                    );

                    $this->core_model->insert('produto_fotos', $data);

                }

                redirect('restrita/'.$this->router->fetch_class());

            }else{

                $data = array(
                    'titulo' => 'Adicionar Produto',
                    'styles' => array(
                        'assets/jquery-upload-file/css/uploadfile.css',
                        'assets/bundles/select2/dist/css/select2.min.css', 
                    ),
                    'scripts' => array(
                        'assets/sweetalert2/sweetalert2.all.min.js', // para confirmar exclusão
                        'assets/jquery-upload-file/js/jquery.uploadfile.min.js', // para uploads
                        'assets/jquery-upload-file/js/produtos.js', // para uploads
                        'assets/mask/jquery.mask.min.js', 
                        'assets/mask/custom.js',
                        'assets/bundles/select2/dist/js/select2.full.min.js',
                        'assets/js/produtos.js', 
                    ),

                    'categorias_pai' => $this->produtos_model->get_all_categorias_pai()
                );

                $this->load->view('restrita/layout/header', $data);
                $this->load->view('restrita/produtos/core');
                $this->load->view('restrita/layout/footer');

            }
        }else{
            if(!$produto_id || !$produto = $this->produtos_model->get_by_id(array('produto_id' => $produto_id ))){
                $this->session->set_flashdata('erro', 'produto não encontrado!');
                redirect('restrita/'.$this->router->fetch_class());
            }else{
    
                $this->form_validation->set_rules('produto_titulo', 'Título do Produto', 'trim|required|max_length[200]');
                $this->form_validation->set_rules('produto_status', 'Situação do Produto', 'trim|required');
                $this->form_validation->set_rules('produto_categoria_pai_id', 'Categoria principal', 'trim|required');
    
                $fotos_produtos = $this->input->post('fotos_produtos');
                if(!$fotos_produtos){
                    $this->form_validation->set_rules('fotos_produtos', 'Fotos do item', 'trim|required');
                }
    
                $this->form_validation->set_rules('produto_descricao', 'Descrição do Produto', 'trim|min_length[0]|max_length[5000]');
                
    
                if($this->form_validation->run()){
    
                    $data = elements(
                        array(
                            'produto_titulo',
                            'produto_categoria_pai_id',
                            'produto_status',
                            'produto_descricao',
                        ), $this->input->post()
                    );

                    $data['produto_url'] = url_amigavel($data['produto_titulo']);
    
                    // atualiza o produto
                    $this->core_model->update('produtos', $data, array('produto_id' => $produto->produto_id));
    
                    // remove as fotos antigas 
                    $this->core_model->delete('produto_fotos', array('foto_produto_id' => $produto->produto_id));
    
                    $fotos_produtos = $this->input->post('fotos_produtos');
                    $total_fotos = count($fotos_produtos);
    
                    $cont=0;
                    foreach($fotos_produtos as $foto){
                        $cont++;
                    }
    
                    for($i = 0; $i < $cont; $i++){
    
                        $data = array(
                            'foto_produto_id' => $produto->produto_id,
                            'foto_nome' => $fotos_produtos[$i],
                        );
    
                        $this->core_model->insert('produto_fotos', $data);
    
                    }
    
                    redirect('restrita/'.$this->router->fetch_class());
    
                }else{
    
                    $data = array(
                        'titulo' => 'Editar Produto',
                        'styles' => array(
                            'assets/jquery-upload-file/css/uploadfile.css',
                            'assets/bundles/select2/dist/css/select2.min.css', 
                        ),
                        'scripts' => array(
                            'assets/sweetalert2/sweetalert2.all.min.js', // para confirmar exclusão
                            'assets/jquery-upload-file/js/jquery.uploadfile.min.js', // para uploads
                            'assets/jquery-upload-file/js/produtos.js', // para uploads
                            'assets/mask/jquery.mask.min.js', 
                            'assets/mask/custom.js',
                            'assets/bundles/select2/dist/js/select2.full.min.js',
                            'assets/js/produtos.js', 
                        ),
    
                        'produto' => $produto,
                        'fotos_produto' => $this->core_model->get_all('produto_fotos', array('foto_produto_id' => $produto->produto_id)),
                        'categorias_pai' => $this->produtos_model->get_all_categorias_pai()
                    );
            
                    $this->load->view('restrita/layout/header', $data);
                    $this->load->view('restrita/produtos/core');
                    $this->load->view('restrita/layout/footer');
    
                }
    
            }
        }

    }

    public function delete($produto_id = null){

        $produto_id = (int) $produto_id;

        if(!$produto_id || !$produto = $this->core_model->get_by_id('produtos', array('produto_id' => $produto_id))){
            $this->session->set_flashdata('erro', 'Produto não encontrada!');
            redirect('restrita/'.$this->router->fetch_class());
        }

        $this->core_model->delete('produtos', array('produto_id' => $produto->produto_id));
        redirect('restrita/'.$this->router->fetch_class());

    }

    public function upload(){

        $mensagem_upload = 'Imagens com no máximo 1000 x 1000 pixels';
        $this->session->set_userdata('mesagem_upload', $mensagem_upload);

        $config['upload_path']          = './uploads/produtos/';
        $config['allowed_types']        = 'jpg|png|JPG|PNG|JPEG|jpeg|';
        $config['max_size']             = 2000; // max 1mg
        $config['max_width']            = 900;
        $config['max_height']           = 900;
        $config['encrypt_name']         = true;

        $this->load->library('upload', $config);

        if($this->upload->do_upload('foto_produto')){

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
