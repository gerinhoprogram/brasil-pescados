<?php

defined('BASEPATH') or exit('Ação não permitida');


function url_amigavel($string = NULL) {
    $string = remove_acentos($string);
    return url_title($string, '-', TRUE);
}

function remove_acentos($string = NULL) {
    $procurar = array('À', 'Á', 'Ã', 'Â', 'É', 'Ê', 'Í', 'Ó', 'Õ', 'Ô', 'Ú', 'Ü', 'Ç', 'à', 'á', 'ã', 'â', 'é', 'ê', 'í', 'ó', 'õ', 'ô', 'ú', 'ü', 'ç');
    $substituir = array('a', 'a', 'a', 'a', 'e', 'r', 'i', 'o', 'o', 'o', 'u', 'u', 'c', 'a', 'a', 'a', 'a', 'e', 'e', 'i', 'o', 'o', 'o', 'u', 'u', 'c');
    return str_replace($procurar, $substituir, $string);
}

function formata_data_banco_com_hora($string) {

    $dia_sem = date('w', strtotime($string));

    if ($dia_sem == 0) {
        $semana = "Domingo";
    } elseif ($dia_sem == 1) {
        $semana = "Segunda-feira";
    } elseif ($dia_sem == 2) {
        $semana = "Terça-feira";
    } elseif ($dia_sem == 3) {
        $semana = "Quarta-feira";
    } elseif ($dia_sem == 4) {
        $semana = "Quinta-feira";
    } elseif ($dia_sem == 5) {
        $semana = "Sexta-feira";
    } else {
        $semana = "Sábado";
    }

    $dia = date('d', strtotime($string));

    $mes_num = date('m', strtotime($string));

    $ano = date('Y', strtotime($string));
    $hora = date('H:i', strtotime($string));

    return $dia . '/' . $mes_num . '/' . $ano . ' ' . $hora;
}

function formata_data_banco_sem_hora($string) {

    $dia_sem = date('w', strtotime($string));

    if ($dia_sem == 0) {
        $semana = "Domingo";
    } elseif ($dia_sem == 1) {
        $semana = "Segunda-feira";
    } elseif ($dia_sem == 2) {
        $semana = "Terça-feira";
    } elseif ($dia_sem == 3) {
        $semana = "Quarta-feira";
    } elseif ($dia_sem == 4) {
        $semana = "Quinta-feira";
    } elseif ($dia_sem == 5) {
        $semana = "Sexta-feira";
    } else {
        $semana = "Sábado";
    }

    $dia = date('d', strtotime($string));

    $mes_num = date('m', strtotime($string));

    $ano = date('Y', strtotime($string));
    $hora = date('H:i', strtotime($string));

    return $dia . '/' . $mes_num . '/' . $ano;
}

// recupera as informações do web site
// uma função no helper pode ser usada em todo o projeto, e ser chamada quando necessário
function info_header_footer(){

    // pega a instancia do codeigniter
    $CI = & get_instance();

    $sistema = $CI->core_model->get_by_id('sistema', array('sistema_id' => 1));

    return $sistema;    

}

// recupera o anunciante
function get_info_anunciante(){

    // pega a instancia do codeigniter
    $CI = & get_instance();

    $anunciante = $CI->ion_auth->user()->row();

    return $anunciante;    

}


// recupera as categorias pai para serem exibidas na index do site
function categorias_pai(){

    // pega a instancia do codeigniter
    $CI = & get_instance();

    $categorias_pai = $CI->anuncios_model->get_categorias_pai();

    return $categorias_pai;    

}


// perguntas sem respostas que aparecem na sidebar do anunciante que estive logado
function get_pergunas_sem_respostas(){

    // pega a instancia do codeigniter
    $CI = & get_instance();

    // pega o id do usuário logado da sessão
    $user_id = $CI->session->userdata('user_id');

    $pergunras_sem_respostas = $CI->core_model->count_all_results('anuncios_perguntas', array('pergunta_respondida' => 0, 'anuncio_user_id' => $user_id));

    return $pergunras_sem_respostas;    

}

// recupera as categorias filhas na navbar home
function categorias(){

    // pega a instancia do codeigniter
    $CI = & get_instance();

    $categorias = $CI->anuncios_model->get_categorias();

    return $categorias;    

}

function get_anuncios_nao_auditados(){

    // pega a instancia do codeigniter
    $CI = & get_instance();

    $anuncios = $CI->core_model->count_all_results('anuncios', array('anuncio_publicado' => 0));

    return $anuncios;    

}

function get_contas_bloqueadas(){

    // pega a instancia do codeigniter
    $CI = & get_instance();

    $anunciantes_block = $CI->core_model->count_all_results('users', array('active' => 0));

    return $anunciantes_block;    

}