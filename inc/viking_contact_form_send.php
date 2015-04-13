<?php

include 'phpmailer/class.phpmailer.php';

if ( isset( $_POST['enviar'] ) ) {
	$mail = new PHPMailer();
	$mail->setLanguage( 'br' );
	
	$mail->isSMTP();
	$mail->CharSet = 'UTF-8';
	$mail->Host = 'smtp.live.com';
	$mail->SMTPAuth = TRUE;
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$fone = $_POST['fone']; if ( $fone == '' ) : $fone = 'Não informado'; endif;
	$celfone = $_POST['celfone']; if ( $celfone == '' ) : $celfone = 'Não informado'; endif;
	$assunto = $_POST['assunto'];
	$msg = $_POST['msg'];
	$para = 'contato@estudioviking.com';
	
	
	
	$mail->Username = $para;
	$mail->Password = '@is2014';

	$mail->isHTML( TRUE );
	$mail->addEmbeddedImage( $home_link.'img/logo_ignus_slogan_160.png', 'logo_ignus' );
	
	$corpo_msg  = '<table border="0" cellspacing="0" cellpadding="0" style="width: 500px; margin: 0 auto;"><tbody>';
	$corpo_msg .= '<tr><td colspan="2" style="font-size: 22px;"><b>Mensagem do Formulário de Contato</b><br /></td></tr>';
	$corpo_msg .= '<tr><td style="width: 120px;"><b>Enviado por:</b></td><td>'.$nome.'</td></tr>';
	$corpo_msg .= '<tr><td><b>Email:</b></td><td>'.$email.'</td></tr>';
	$corpo_msg .= '<tr><td><b>Telefone Fixo:</b></td><td>'.$fone.'</td></tr>';
	$corpo_msg .= '<tr><td><b>Telefone Celular:</b></td><td>'.$celfone.'</td></tr>';
	$corpo_msg .= '<tr><td><b>Assunto:</b></td><td>'.$assunto.'</td></tr>';
	$corpo_msg .= '<tr><td><b>Mensagem:</b></td><td>'.$msg.'</td></tr>';
	$corpo_msg .= '<tr><td colspan="2"><br /><img src="cid:logo_ignus" /></td></tr>';
	$corpo_msg .= '</tbody></table>';
	
	$mail->Body = $corpo_msg;

	$mail->From = $email;
	$mail->FromName = $nome;
	$mail->Subject = $assunto;
	$mail->addAddress( $para );
	
	if ( ! $mail->send() ) {
		echo '<p class="falha">Erro ao enviar messagem. Por favor, tente mais tarde.</p><p>Informações do erro: '.$mail->ErrorInfo.'</p>';
		
	} else {
		echo '<p class="sucesso">Mensagem enviada com sucesso!</p>';
		
		$mail = new PHPMailer();
		$mail->setLanguage( 'br' );
		
		$mail->isSMTP();
		$mail->CharSet = 'UTF-8';
		$mail->Host = 'smtp.live.com';
		$mail->SMTPAuth = TRUE;
		$mail->Port = 587;
		$mail->SMTPSecure = 'tls';
		
		$mail->Username = $para;
		$mail->Password = '@is2014';
		
		$mail->isHTML( TRUE );
		$mail->addEmbeddedImage( $home_link.'img/logo_ignus_slogan_160.png', 'logo_ignus' );
		
		$msg_confirma  = '<p style="font-size: 22px;"><b>Mensagem do Formulário de Contato - Ignus Studios</b></p>';
		$msg_confirma .= '<p><b>'.$nome.'</b>,<br />Recebemos a sua mensagem.<br />Vamos analizar a sua solicitação e logo entraremos em contato.<br />Obrigado.</p>';
		$msg_confirma .= '<p><br /><img src="cid:logo_ignus" /></p>';
		
		$mail->Body = $msg_confirma;
		
		$mail->From = $para;
		$mail->FromName = 'Ignus Studios';
		$mail->Subject = 'Mensagem de contato recebida';
		$mail->addAddress( $email );
		
		$mail->send();
	}
}

?>