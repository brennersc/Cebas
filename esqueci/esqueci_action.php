<?php
include('../PHPMailer/PHPMailerAutoload.php');
include('../gets/db_class.php');

$objDb  =  new db();
$link   =  $objDb->conecta_mysql();

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);

$q = "SELECT * FROM usuario WHERE email = '".$email."'";
$r = mysqli_query($link, $q);
$dadosUsuario = mysqli_fetch_array($r);

if(!empty($dadosUsuario['email'])){
			
	//gera chave
	$chave = (rand(99, 999) % $dadosUsuario['id']); 	//resto da divisão de um número pelo id do usuário
	$chave .= date("YmdHis");						//concatenação com a data e hora local
	$chave = sha1($chave);    				//hash sha1
	
	$sql = "INSERT INTO usuario_esqueci_senha (usuario_id, chave, data_registro, status) VALUES ('".$dadosUsuario['id']."','".$chave."','". date("Y-m-d H:i:s") ."','0')";
	mysqli_query($link, $sql);

	//Usuário inserido com sucesso
	if(mysqli_affected_rows($link) > 0){
		
		$mail = new PHPMailer(true);
		try {
			$mail->CharSet = 'UTF-8';
			$mail->IsSMTP();
			$mail->isHTML(true); 
			$mail->setFrom('naoresponder@fumec.br', 'Universidade FUMEC');
			$mail->AddAddress($dadosUsuario["email"]);
			$mail->Subject = 'Solicitação de senha';
			$mail->Body    = '<p>Prezado(a)</p>
			<p>Você solicitou uma nova senha para acessar o Bolsa Oportunidade FUMEC. Para concluir esta operação, basta clicar no link abaixo ou copiar o endereço e colar no seu navegador.</p>
			<p><i>Atenção, o link é válido por apenas 6 horas. Após esse período, você deverá fazer uma nova solicitação.</i></p>					
			<p><a href="http://bolsaoportunidade.fumec.br/esqueci/confirmacao?c='.$chave.'">http://bolsaoportunidade.fumec.br/sce/esqueci/confirmacao?c='.$chave.'</a></p>						
			<p>Caso não tenha solicitado, ignore essa mensagem.</p>
			<br>
			<p>Universidade FUMEC</p>
			';
			$mail->send();
			header("location: index?msg=".base64_encode(1));
		} catch (phpmailerException $e) {
			//echo $e->errorMessage(); //Pretty error messages from PHPMailer
			header("location: index?msg=".base64_encode(2));
			exit;
		} catch (Exception $e) {
			//echo $e->getMessage(); //Boring error messages from anything else!
			header("location: index?msg=".base64_encode(2));
			exit;
		}

	}
}else{
	header("location: index?msg=".base64_encode(3));
}
?>