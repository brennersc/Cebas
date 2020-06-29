<?php
include('../PHPMailer/PHPMailerAutoload.php');
include('../gets/db_class.php');

$objDb  =  new db();
$link   =  $objDb->conecta_mysql();

$chave = filter_input(INPUT_GET, 'c', FILTER_SANITIZE_STRING);

$q = "SELECT * FROM usuario_esqueci_senha WHERE chave = '".$chave."' AND status = 0 AND data_registro >= '".date('Y-m-d H:i:s', strtotime('-360 minute'))."'";
$r = mysqli_query($link, $q);
$d = mysqli_fetch_array($r);

if(!empty($d['usuario_id'])){
     
     //Gera nova senha
     $caracteres = '23456789bcdfghjkmnpqrstvwxyz';
     $senha = '';
     for($x=0; $x < 6; $x++){
        $senha .= substr($caracteres, mt_rand(0, strlen($caracteres)-1), 1);
     }

     //atualiza senha
     mysqli_query($link, "UPDATE usuario SET senha = md5('".$senha."') WHERE id = '".$d['usuario_id']."'");

     //atualiza solicitacao
     mysqli_query($link, "UPDATE usuario_esqueci_senha SET status ='1' WHERE id = '".$d['id']."' AND status = 0");
     
     //busca nome e informacoes do usuario
     $rUsu = mysqli_query($link, "SELECT * FROM usuario WHERE id = '".$d['usuario_id']."'");
     $dadosUsu = mysqli_fetch_array($rUsu);

     $mail = new PHPMailer(true);
     try {
        $mail->CharSet = 'UTF-8';
        $mail->IsSMTP();
        $mail->isHTML(true); 
        $mail->setFrom('naoresponder@fumec.br', 'Universidade FUMEC');
        $mail->addAddress($dadosUsu["email"]);
        $mail->Subject = 'Confirmação de senha';
        $mail->Body    = '<p>Prezado(a),</p>
         <p>Sua nova senha de acesso ao sistema Bolsa Oportunidade FUMEC é: <strong>'.$senha.'</strong></p>
           <p>Não divulgue sua senha a terceiros, ela é pessoal e intransferível. Memorize-a e não anote em locais de fácil acesso.</p>
           <p>Qualquer dúvida, entre em contato com o suporte.</p>';
        $mail->send();
        header("location: index?msg=".base64_encode(4));
        exit();
        // <p>Por segurança, após o login no sistema, altere a senha na opção "Alterar Senha" localizada no menu a esquerda.</p>
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

header("location: index?msg=".base64_encode(5));

?>