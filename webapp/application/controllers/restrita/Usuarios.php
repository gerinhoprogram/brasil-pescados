<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

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
            'titulo' => 'Usuários cadastrados',
            'styles' => array(
                'assets/bundles/datatables/datatables.min.css', 
                'assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'),
            'scripts' => array(
                'assets/bundles/datatables/datatables.min.js',
                'assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
                'assets/bundles/jquery-ui/jquery-ui.min.js',
                'assets/js/page/datatables.js'
            ),
            'usuarios' => $this->ion_auth->users()->result()
        );


		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/usuarios/index');
		$this->load->view('restrita/layout/footer');
	}

    public function core($usuario_id = null){

        // metodo serve tanto para cadastrar quanto para editar 

        //tornando $usuario_id em inteiro
        $usuario_id = (int) $usuario_id;

        if(!$usuario_id){
        //cadastrar novo usuario

                $this->form_validation->set_rules('first_name', 'Nome', 'trim|required|min_length[1]|max_length[150]');
                $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|max_length[150]|callback_valida_email');
                $this->form_validation->set_rules('password', 'Senha', 'trim|required|min_length[4]|max_length[100]');
                $this->form_validation->set_rules('confirma_senha', 'Confirma senha', 'trim|required|min_length[4]|max_length[100]|matches[password]');

                if($this->form_validation->run()){

                    // add um novo usuário plugin ion_auth
                    $username = $this->input->post('first_name');
                    $password = $this->input->post('password');
                    $email = $this->input->post('email');
                   
                    // para chamar o elements colocar array no helpers no arquivo autoload.php
                    $additional_data = elements(
                        array(
                            'first_name',
                            'active',
                            'user_foto'
                        ), $this->input->post()
                    );

                    $group = array($this->input->post('perfil')); // Sets user to admin.

                    // metodo que cadastra usuario
                    if($this->ion_auth->register($username, $password, $email, $additional_data, $group)){
                        $this->session->set_flashdata('sucesso', 'Usuário atualizado com sucesso!');
                    }else{
                        $this->session->set_flashdata('erro', $this->ion_auth->errors());
                    }

                    redirect('restrita/'. $this->router->fetch_class());
                    // $this->index();

                }else{
                    $data = array(
                        'titulo' => 'Adicionar usuário',
                        'scripts' => array('assets/mask/custom.js', 'assets/mask/jquery.mask.min.js', 'assets/js/usuarios.js'),
                        'grupos' => $this->ion_auth->groups()->result()
                    );

                        $this->load->view('restrita/layout/header', $data);
                        $this->load->view('restrita/usuarios/core');
                        $this->load->view('restrita/layout/footer');
                }


        }else{

            if(!$usuario = $this->ion_auth->user($usuario_id)->row()){
                //usuario não encontrado

                $this->session->set_flashdata('erro', 'Usuário não cadastro no sistema!');
                redirect('restrita/'.$this->router->fetch_class());

            }else{
            //editar usuario

            $this->form_validation->set_rules('first_name', 'Nome', 'trim|required|min_length[1]|max_length[150]');
            $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|max_length[150]|callback_valida_email');
            $this->form_validation->set_rules('password', 'Senha', 'trim|min_length[4]|max_length[100]');
            $this->form_validation->set_rules('confirma_senha', 'Confirma senha', 'trim|min_length[4]|max_length[100]|matches[password]');

            if($this->form_validation->run()){

                // para chamar o elements colocar array no helpers no arquivo autoload.php
                $data = elements(
                    array(
                        'first_name',
                        'password',
                        'email',
                        'active',
                        'user_foto'
                    ), $this->input->post()
                );

                // remove do data quando estiver vazio
                if(!$data['password']){
                    unset($data['password']);
                }

                $id = $usuario->id;
                
                if($this->ion_auth->update($id, $data)){


                    // atualizando o grupo de acesso de usuário
                    $perfil = (int) $this->input->post('perfil');
                    $this->ion_auth->remove_from_group(null, $id);
                    $this->ion_auth->add_to_group($perfil, $id);

                    $this->session->set_flashdata('sucesso', 'Usuário atualizado com sucesso!');

                }else{
                    $this->session->set_flashdata('erro', $this->ion_auth->errors());

                }

                redirect('restrita/'. $this->router->fetch_class());
                // $this->index();

            }else{
                $data = array(
                    'titulo' => 'Editando usuário',
                    'scripts' => array('assets/mask/custom.js', 'assets/mask/jquery.mask.min.js', 'assets/js/usuarios.js'),
                    'usuario' => $usuario,
                    'perfil' => $this->ion_auth->get_users_groups($usuario->id)->row(),
                    'grupos' => $this->ion_auth->groups()->result()
                );

                    $this->load->view('restrita/layout/header', $data);
                    $this->load->view('restrita/usuarios/core');
                    $this->load->view('restrita/layout/footer');
            }


            }

        }

    }

    public function upload_file(){

        $config['upload_path']          = './uploads/usuarios/';
        $config['allowed_types']        = 'jpg|png|JPG|PNG|JPEG|jpeg';
        $config['max_size']             = 2500; // max 1mg
        $config['max_width']            = 1200;
        $config['max_height']           = 1200;
        $config['encrypt_name']         = true;

        $this->load->library('upload', $config);

        if($this->upload->do_upload('user_foto_file')){

            $data = array(
                'erro' => 0,
                'foto_enviada' => $this->upload->data(''),    
                'user_foto' => $this->upload->data('file_name'),
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

    public function valida_telefone($phone){

        $usuario_id = $this->input->post('usuario_id');

        if(!$usuario_id){
            // cadastrando usuario

            if($this->core_model->get_by_id('users', array('phone' => $phone))){

                $this->form_validation->set_message('valida_telefone', 'Este telefone já existe');
                return false;

            }else{

                return true;
            }

        }else{
            // editando usuario

            if($this->core_model->get_by_id('users', array('phone' => $phone, 'id !=' => $usuario_id ))){

                $this->form_validation->set_message('valida_telefone', 'Este telefone já existe');
                return false;

            }else{

                return true;
            }

        }

    }

    public function valida_email($email){

        $usuario_id = $this->input->post('usuario_id');

        if(!$usuario_id){
            // cadastrando usuario

            if($this->core_model->get_by_id('users', array('email' => $email))){

                $this->form_validation->set_message('valida_email', 'Este e-mail já existe!');
                return false;

            }else{

                return true;
            }

        }else{
            // editando usuario

            if($this->core_model->get_by_id('users', array('email' => $email, 'id !=' => $usuario_id ))){

                $this->form_validation->set_message('valida_email', 'Este e-mail já existe');
                return false;

            }else{

                return true;
            }


        }

    }

    public function delete($usuario_id = null){

        $usuario_id = (int) $usuario_id;

        // VERIFICA SE USUÁRIO EXISTE
        if(!$usuario_id || !$usuario =  $this->ion_auth->user($usuario_id)->row()){

            $this->session->set_flashdata('erro', 'Usuário não encontrado');
            redirect('restrita/'.$this->router->fetch_class());

        }

        // NÃO PERMITE EXCLUIR USUÁRIO ADMIN
        if($this->ion_auth->is_admin($usuario->id)){

            $this->session->set_flashdata('erro', 'Não é permitido excluir administrador!');
            redirect('restrita/'.$this->router->fetch_class());

        }

        // EXCLUINDO USUARIO
        if($this->ion_auth->delete_user($usuario->id)){

            $user_foto = $usuario->user_foto;

            // EXCLUI IMAGENS DO USUÁRIO
            $imagem_grande = FCPATH . 'uploads/usuarios/'. $user_foto;
            $imagem_small = FCPATH . 'uploads/usuarios/small/'. $user_foto;

            if(file_exists($imagem_grande)){
                unlink($imagem_grande);
            }

            if(file_exists($imagem_small)){
                unlink($imagem_small);
            }

            $this->session->set_flashdata('sucesso', 'Usuário excluido com sucesso!');

        }else{
            // não foi possivel excluir
            $this->session->set_flashdata('erro', $this->ion_auth->errors());
        }

        redirect('restrita/'.$this->router->fetch_class());

    }

}