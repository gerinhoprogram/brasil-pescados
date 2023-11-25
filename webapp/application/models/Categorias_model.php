<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Ion Auth Model
 * @property Ion_auth $ion_auth The Ion_auth library
 */
class Categorias_model extends CI_Model
{

    public function get_all_categorias(){

        $this->db->select([
            'categorias.*',
            'categorias_pai.categoria_pai_nome'
        ]);

        $this->db->join('categorias_pai', 'categorias_pai.categoria_pai_id = categorias.categoria_pai_id');

        $this->db->order_by('categorias.categoria_id');

        return $this->db->get('categorias')->result();

    }

    
}