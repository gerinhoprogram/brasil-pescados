<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Ion Auth Model
 * @property Ion_auth $ion_auth The Ion_auth library
 */
class Core_model extends CI_Model
{
    function __construct()
    {
		parent::__construct();
		$this->_table = 'formularios';
    }

    public function get_all($tabela = null, $condicoes = null, $limite = null){

        if($tabela && $this->db->table_exists($tabela)){

            if(is_array($condicoes)){
                $this->db->where($condicoes);
            }

            if($limite){
                $this->db->limit($limite);
            }

            // $this->db->order_by(1, 'desc');

            return $this->db->get($tabela)->result();

        }else{
            return false;
        }

    }

    public function get_arrays($tabela = null, $condicoes = null){

    }

    public function get_by_id($tabela = null, $condicoes = null){

        if($tabela && $this->db->table_exists($tabela) && is_array($condicoes)){
           
            $this->db->where($condicoes);
            $this->db->limit(1);

            return $this->db->get($tabela)->row();

        }else{
            return false;
        }

    }

    public function insert($tabela = null, $data = null, $get_last_id = null){

        if($tabela && $this->db->table_exists($tabela) && is_array($data)){
           
            $this->db->insert($tabela, $data);

            if($get_last_id){
                $this->session->set_userdata('last_id', $this->db->insert_id());
            }

            if($this->db->affected_rows() > 0 ){
                $this->session->set_flashdata('sucesso', 'Dados salvos com sucesso.');
            }else{
                $this->session->set_flashdata('erro', 'Não foi possível salvar os dados.');
            }

        }else{
            return false;
        }

    }

    public function update($tabela = null, $data = null, $condicoes = null){

        if($tabela && $this->db->table_exists($tabela) && is_array($data) && is_array($condicoes)){

            if($this->db->update($tabela, $data, $condicoes)){
                $this->session->set_flashdata('sucesso', 'Dados salvos com sucesso.');
            }else{
                $this->session->set_flashdata('erro', 'Não foi possível salvar os dados.');
            }

        }else{
            return false;
        }
    }

    public function delete($tabela = null, $condicoes = null){

        if($tabela && $this->db->table_exists($tabela) && is_array($condicoes)){

            if($this->db->delete($tabela, $condicoes)){
                $this->session->set_flashdata('sucesso', 'Registro excluído com sucesso.');
            }else{
                $this->session->set_flashdata('erro', 'Não foi possível excluir o registro.');
            }

        }else{
            return false;
        }
    }

    public function generate_unique_code($tabela = null, $tipo_codigo = null, $tamanho_codigo = null, $campo_procura = null){

        do{
            $codigo = random_string($tipo_codigo, $tamanho_codigo);
            $this->db->where($campo_procura, $codigo);
            $this->db->from($tabela);

        }while($this->db->count_all_results() >= 1);

        return $codigo;

    }

    public function count_all_results($tabela = null, $condicoes = null){

        if($tabela && $this->db->table_exists($tabela)){

            if(is_array($condicoes)){
                $this->db->where($condicoes);
            }

            return $this->db->count_all_results($tabela);
        }else{
            return false;
        }
    }

    public function get_dados(){

            $this->db->select([
                'categoria_pai_id',
                'categoria_pai_nome',
                'count(anuncios.anuncio_id) as quantidade'
            ]);


            $this->db->join('anuncios', 'anuncios.anuncio_categoria_pai_id = categorias_pai.categoria_pai_id');
            $this->db->group_by('categorias_pai.categoria_pai_id');
            $this->db->group_by('categorias_pai.categoria_pai_nome');

            return $this->db->get('categorias_pai')->result();

    }

    public function get_data(){
        
        $this->db->select([
            'SUM(CASE WHEN (MONTH(anuncio_data_criacao) = 1) THEN 1 ELSE 0 END) cont_1',
            'SUM(CASE WHEN (MONTH(anuncio_data_criacao) = 2) THEN 1 ELSE 0 END) cont_2',
            'SUM(CASE WHEN (MONTH(anuncio_data_criacao) = 3) THEN 1 ELSE 0 END) cont_3',
            'SUM(CASE WHEN (MONTH(anuncio_data_criacao) = 4) THEN 1 ELSE 0 END) cont_4',
            'SUM(CASE WHEN (MONTH(anuncio_data_criacao) = 5) THEN 1 ELSE 0 END) cont_5',
            'SUM(CASE WHEN (MONTH(anuncio_data_criacao) = 6) THEN 1 ELSE 0 END) cont_6',
            'SUM(CASE WHEN (MONTH(anuncio_data_criacao) = 7) THEN 1 ELSE 0 END) cont_7',
            'SUM(CASE WHEN (MONTH(anuncio_data_criacao) = 8) THEN 1 ELSE 0 END) cont_8',
            'SUM(CASE WHEN (MONTH(anuncio_data_criacao) = 9) THEN 1 ELSE 0 END) cont_9',
            'SUM(CASE WHEN (MONTH(anuncio_data_criacao) = 11) THEN 1 ELSE 0 END) cont_10',
            'SUM(CASE WHEN (MONTH(anuncio_data_criacao) = 11) THEN 1 ELSE 0 END) cont_11',
            'SUM(CASE WHEN (MONTH(anuncio_data_criacao) = 12) THEN 1 ELSE 0 END) cont_12',
            
        ]);

        return $this->db->get('anuncios')->result();

}
    
}