<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" data-theme="light">
<head>
<?php include ('header.php');?>
	<title><?php echo $ttl ?></title>
	<script type="text/javascript" src="core/mod_includes/js/jquery-1.8.3.min.js"></script>
    
</head>
<body>
    <div id='janela' class='janela' style='display:none;'> </div>
    <?php
    include('core/mod_includes/php/funcoes-jquery.php');
	date_default_timezone_set('America/Sao_Paulo');
	$data = date('Y-m-d');
	$hora = date('H:i:s');

    $email = $_POST['novidades'];
    $assunto_email = 'Quero receber novidades!';
	$contato_email_id = '1';

    $sql = "INSERT INTO formularios 
	(contato_email, contato_assunto, contato_email_id) 
    VALUES 
	(:contato_email, :contato_assunto, :contato_email_id)";
	$stmt = $PDO->prepare($sql);
	$stmt->bindValue(':contato_email', $email);
	$stmt->bindValue(':contato_assunto', $assunto_email);
	$stmt->bindValue(':contato_email_id', $contato_email_id);
	$stmt->execute();

	// Inclui o foto_sugestao class.phpmailer.php localizado na pasta phpmailer
	require("core/mod_includes/php/phpmailer/class.phpmailer.php");
	 
	// Inicia a classe PHPMailer
	$mail = new PHPMailer();

	// Define os dados do servidor e tipo de conexão
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsSMTP();
	$mail->Host = "mail.mogicomp.com.br"; // Endereço do servidor SMTP (caso queira utilizar a autenticação, utilize o host smtp.seudomínio.com.br)
	$mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
	$mail->Username = 'autenticacao@mogicomp.com.br'; // Usuário do servidor SMTP
	$mail->Password = 'info2012mogi'; // Senha do servidor SMTP
	
	// Define o remetente
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->From = "$email"; // Seu e-mail
	$mail->Sender = "autenticacao@mogicomp.com.br"; // Seu e-mail
	$mail->FromName = $nome; // Seu nome
	
	// Define os destinatário(s)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->AddCC('rogerio@mogicomp.com.br');
	// $mail->AddBCC('leads@ncwbrasil.com.br');

	// Define os dados técnicos da Mensagem
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
	
	$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
	 
	// Define a mensagem (Texto e Assunto)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$assunto = $assunto_email;
	$mail->Subject  = '=?utf-8?B?'.base64_encode($assunto).'?='; // Assunto da mensagem
	$mail->Body = "
<head>
	<style type='text/css'>
		.margem 		{ padding-top:20px; padding-bottom:20px; padding-left:20px;padding-right:20px;}
		a:link 			{}
		a:visited 		{}
		a:hover 		{ text-decoration: underline; color:#2C4E67; }
		a:active 		{ text-decoration: none; }
		.texto			{ font-family:'Calibri'; color:#666; font-size:14px; text-align:justify; font-weight:normal;}
		hr				{ border:none; border-top:1px solid #2C4E67;}
		.rodape			{ font-family:Calibri; color:#727272; font-size:12px; text-align:justify; font-weight:normal; }
				
	</style>
</head>
<body>
	<table style='font-family:Calibri;' align='center' border='0' width='100%' cellspacing='0' cellpadding='0'>
	<tr>
		<td align='left'>
			<table class='texto'>
				<tr>
					<td align='right'>
						<b>Email:</b>
					</td>
					<td align='left'>
						$email
					</td>
                </tr>
			</table>
			<hr>
			<span class='rodape'>
				<font size='1' color='#2C4E67'><b>Mensagem enviada:</b></font> ".$data." | ".$hora."<br>
				Este é um email gerado automaticamente pelo sistema.<br><br>
				As informações contidas nesta mensagem e nos foto_sugestaos anexados são para uso restrito, sendo seu sigilo protegido por lei, não havendo ainda garantia legal quanto à integridade de seu conteúdo. Caso não seja o destinatário, por favor desconsidere essa mensagem. O uso indevido dessas informações será tratado conforme as normas da empresa e a legislação em vigor.
			</font>
		</td>
	</tr>
	</table>
</body>";
 
// Envia o e-mail
$enviado = $mail->Send();
 
// Limpa os destinatários e os anexos
$mail->ClearAllRecipients();

// Exibe uma mensagem de resultado
	if ($enviado)
	{
		// ENVIA LEAD NCW
		// leadsAdd(SECRET_KEY, 2, $nome, $email, $telefone, preg_replace("/\r|\n/", "",$mensagem), "FORMULÁRIO CONTATO");

		echo "<SCRIPT language='JavaScript'>
		abreMask(
		'Sua mensagem foi enviada com sucesso! E em breve retornaremos.<br><br>'+
		'<input value=\' Voltar para home \' type=\'button\' class=\'btn-saiba\' onclick=javascript:window.location.href=\'home\';>' );
	    </SCRIPT>";
	}
	else
	{
		echo "<SCRIPT language='JavaScript'>
		abreMask(
		'Erro ao enviar mensagem. <br>$mail->ErrorInfo.<br><br>'+
		'<center><input value=\' Voltar para home \' type=\'text\' class=\'btn-saiba\' onclick=javascript:window.location.href=\'home\';></center>' );
	    </SCRIPT>";
	}

?>
</body>
</html>


