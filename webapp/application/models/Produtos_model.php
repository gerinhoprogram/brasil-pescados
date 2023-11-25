<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Ion Auth Model
 * @property Ion_auth $ion_auth The Ion_auth library
 */
class produtos_model extends CI_Model
{

    public function get_all(){

        $this->db->select([
            'produtos.*',
            'categorias_pai.categoria_pai_nome',
            'produto_fotos.foto_nome'
        ]);
        
        $this->db->join('categorias_pai', 'categorias_pai.categoria_pai_id = produtos.produto_categoria_pai_id', 'left');
        $this->db->join('produto_fotos', 'produto_fotos.foto_produto_id = produtos.produto_id', 'left');
  
        $this->db->group_by('produtos.produto_id');

        return $this->db->get('produtos')->result();
    }


    // FUNÇÃO UTILIZADA PARA EDITAR/AUDITAR UM REGISTRO NA AREA RESTRITA
    public function get_by_id($condicoes = null){

        $this->db->select([
            'produtos.*',
            'categorias_pai.categoria_pai_nome',
        ]);

        // verifica se é um array
        if(is_array($condicoes)){

            $this->db->where($condicoes);

        }
        
        $this->db->join('categorias_pai', 'categorias_pai.categoria_pai_id = produtos.produto_categoria_pai_id');

        return $this->db->get('produtos')->row();
    }

    // recupera produtos do input busca
    public function get_all_categorias_pai(){
        $this->db->select([
            'categorias_pai.*'
        ]);

        $this->db->where('categorias_pai.categoria_pai_ativa', 1);

        return $this->db->get('categorias_pai')->result();
    }

    // EXIBE TODOS OS produtos DE FORMA RANDOMICA
    public function get_all_produtos_random($condicoes = null){

        $this->db->select([
            'produtos.*',
            'categorias_pai.categoria_pai_nome',
            'categorias.categoria_nome',
            'produtos_fotos.foto_nome',
            'categorias_pai.categoria_pai_meta_link',
            'categorias.categoria_meta_link',
            'users.first_name',
        ]);

        $this->db->where($condicoes);

        $this->db->join('categorias', 'categorias.categoria_id = produtos.produto_categoria_id', 'left');
        $this->db->join('categorias_pai', 'categorias_pai.categoria_pai_id = categorias.categoria_pai_id', 'left');
        $this->db->join('produtos_fotos', 'produtos_fotos.foto_produto_id = produtos.produto_id', 'left');
        $this->db->join('users', 'users.id = produtos.produto_user_id', 'left');

        $this->db->order_by('produtos.produto_id', 'RANDOM');
        $this->db->group_by('produtos.produto_id');

        return $this->db->get('produtos')->result();
    }

    public function get_categorias_pai(){
        $this->db->select([
        'categorias_pai.*',
        'COUNT(categoria_pai_id) as quantidade_produto'
        ]);

        $this->db->where('categoria_pai_ativa', 1);
        $this->db->where('produtos.produto_publicado', 1);

        $this->db->join('produtos', 'produtos.produto_categoria_pai_id = categorias_pai.categoria_pai_id');

        $this->db->order_by('categoria_pai_nome');
        $this->db->group_by('categoria_pai_id');

        return $this->db->get('categorias_pai')->result();
    }

    // retorna produto por cidade, estado ou categoria
    public function get_all_by($condicoes = null){
       
        if(is_array($condicoes)){
            $this->db->select([
                'produtos.*',
                'categorias_pai.categoria_pai_nome',
                'categorias.categoria_nome',
                'categorias.categoria_id',
                'produtos_fotos.foto_nome',
                'categorias_pai.categoria_pai_meta_link',
                'categorias.categoria_meta_link',
                'users.phone',
                'users.created_on as anunciante_desde',
                'users.user_foto',
                'users.first_name',
            ]);

            $this->db->where('categoria_pai_ativa', 1);
            $this->db->where($condicoes);
            $this->db->group_by('produtos.produto_id');

            $this->db->join('categorias', 'categorias.categoria_id = produtos.produto_categoria_id', 'left');
            $this->db->join('categorias_pai', 'categorias_pai.categoria_pai_id = categorias.categoria_pai_id', 'left');
            $this->db->join('produtos_fotos', 'produtos_fotos.foto_produto_id = produtos.produto_id', 'left');
            $this->db->join('users', 'users.id = produtos.produto_user_id', 'left');

            return $this->db->get('produtos')->result();
        }

    }

    public function get_all_by_busca($busca = null){

        $this->db->select([
            'produtos.*',
            'categorias_pai.categoria_pai_nome',
            'categorias.categoria_nome',
            'users.id',
            'users.first_name',
            'produtos_fotos.foto_nome',
            'categorias_pai.categoria_pai_meta_link',
                'categorias.categoria_meta_link',
        ]);

        $this->db->like('produto_titulo', $busca, 'both');
        $this->db->where('produtos.produto_publicado', 1);

        $this->db->join('categorias', 'categorias.categoria_id = produtos.produto_categoria_id', 'left');
        $this->db->join('categorias_pai', 'categorias_pai.categoria_pai_id = categorias.categoria_pai_id', 'left');
        $this->db->join('produtos_fotos', 'produtos_fotos.foto_produto_id = produtos.produto_id', 'left');
        $this->db->join('users', 'users.id = produtos.produto_user_id', 'left');

        $this->db->group_by('produtos.produto_id');

        return $this->db->get('produtos')->result();
    }

    // pega os dados de quem esta perguntando
    public function get_perguntas($condicoes = null){

        if(is_array($condicoes)){
            $this->db->select([
                'produtos_perguntas_historico.*',
                'produtos.produto_titulo',
                'produtos_fotos.foto_nome',
                'users.id as anunciante_id',
                'users.first_name',
                'users.user_foto'
            ]);

            $this->db->where($condicoes);

            $this->db->join('produtos', 'produtos.produto_id = produtos_perguntas_historico.produto_id');
            $this->db->join('produtos_fotos', 'produtos_fotos.foto_produto_id = produtos.produto_id');
            $this->db->join('users', 'users.id = produtos_perguntas_historico.anunciante_pergunta_id');

            $this->db->order_by('produtos_perguntas_historico.data_pergunta', 'desc');
            $this->db->group_by('produtos_perguntas_historico.pergunta');

            return $this->db->get('produtos_perguntas_historico')->result();

        }else{

            return false;

        }

    }

    public function get_categorias(){
        $this->db->select([
        'categorias.*',
        ]);

        $this->db->where('categoria_ativa', 1);
        $this->db->where('produtos.produto_publicado', 1);

        $this->db->limit(6);        
        $this->db->join('produtos', 'produtos.produto_categoria_id = categorias.categoria_id');

        $this->db->order_by('categoria_nome', 'RANDOM');

        return $this->db->get('categorias')->result();
    }

}