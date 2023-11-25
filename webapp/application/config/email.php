<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// quando se cria um arquivo dentro de config, ele já é inicializado na aplicação
// colocar no autoload.php a librarie email
// VERIFICAR O ARQUIVO PHP.INI DO XAMP PARA SABER SE EXTENSÃO PHP_OPENSSL.DDL ESTA COMENTADA

// HABILITAR NA CONTA DO GMAIL O ACESSO DE APLICATIVOS NÃO SEGUROS
// emal temporario
// https://temp-mail.org/pt/

// ativar/desativar acesso de apps menos seguros no gmail
// https://support.google.com/accounts/answer/6010255?hl=pt-BR#zippy=%2Cse-a-op%C3%A7%C3%A3o-acesso-a-app-menos-seguro-estiver-ativada-para-sua-conta
// https://myaccount.google.com/lesssecureapps?pli=1&rapt=AEjHL4N3q7Hytl0DCLbS-HQXmr1Z8nJTtI_r_82CNJTuVwcaHK-mTthRw0OgPxeqP2kj7Qq0Yf16sEMzrAhdExS40D-1MYHbMw

$config = array();

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.hostinger.com';
$config['smtp_port'] = '465';
$config['smtp_user'] = 'rogerio_furquim@hotmail.com';
$config['smtp_pass'] = 'Rogerio1990';
$config['mailtype'] = 'text';
$config['newline'] = '\r\n'; // sem essa linha, não funciona
