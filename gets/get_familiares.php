<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header('Location: cadastro?erro=1');
}

$email = $_SESSION['email'];

require_once('db_class.php');

$objDb = new db();
$link = $objDb->conecta_mysql();

$id_usuario = $_SESSION['id_usuario'];
$sql  =  "SELECT * FROM familiares where id_usuario  =  '$id_usuario' ";

//Preenche os campos para não dar merda na insercao
foreach ($_POST["nome"] as $key => $nome) {
    if ($_POST['renda'][$key] == '') {
        $_POST['renda'][$key] = 0;
    }
    if ($_POST['outrasrenda'][$key] == '') {
        $_POST['outrasrenda'][$key] = 0;
    }
}

$resultado_id  =  mysqli_query($link, $sql);
$dados_usuario  =  mysqli_fetch_array($resultado_id);

//ACHOU O ID!!!!
if (isset($dados_usuario['id_usuario'])) {
    //APAGA TOTO MUNDO PARA DEPOIS INSERIR TUDO NOVAMENTE
    $sql = "DELETE FROM `familiares` WHERE id_usuario = '$id_usuario'";
    mysqli_query($link, $sql);
    $inseridos = 0;
    foreach ($_POST["nome"] as $key => $nome) {

        $id_familiares  =  strip_tags(trim(addslashes($_POST['id_familiares'][$key])));
        $cpf            =  strip_tags(trim(addslashes($_POST['cpf'][$key])));
        $rg             =  strip_tags(trim(addslashes($_POST['rg'][$key])));
        $ocupacao       =  strip_tags(trim(addslashes($_POST['ocupacao'][$key])));
        $renda          =  strip_tags(trim(addslashes($_POST['renda'][$key])));
        $outrasrenda    =  strip_tags(trim(addslashes($_POST['outrasrenda'][$key])));
        $qual           =  strip_tags(trim(addslashes($_POST['qual'][$key])));

        $sql = "INSERT INTO `familiares`( `id_usuario`, `nome`, `rg`, `cpf`, `ocupacao`, `renda`,`outrasrenda`,`qual`)
                VALUES ('$id_usuario','$nome','$rg',' $cpf',' $ocupacao ',' $renda','$outrasrenda','$qual')";
        
        if (mysqli_query($link, $sql)) {
            $inseridos ++;
        }
    }
    if ($inseridos > 0) {
        header('Location: ../fumec-form-4');
    } else {
        echo "Erro ao fazer UPDATE!";
    }
}

//se não localizou o usuário deve ser então um nova inserção
else {
    $inseridos = 0;
    foreach ($_POST["nome"] as $key => $nome) {
        $cpf            =  strip_tags(trim(addslashes($_POST['cpf'][$key])));
        $rg             =  strip_tags(trim(addslashes($_POST['rg'][$key])));
        $ocupacao       =  strip_tags(trim(addslashes($_POST['ocupacao'][$key])));
        $renda          =  strip_tags(trim(addslashes($_POST['renda'][$key])));
        $outrasrenda    =  strip_tags(trim(addslashes($_POST['outrasrenda'][$key])));
        $qual           =  strip_tags(trim(addslashes($_POST['qual'][$key])));

        $sql = "INSERT INTO `familiares`( `id_usuario`, `nome`, `rg`, `cpf`, `ocupacao`, `renda`,`outrasrenda`,`qual`) 
                VALUES ('$id_usuario','$nome','$rg',' $cpf',' $ocupacao ',' $renda','$outrasrenda','$qual')";
        echo $sql;
        //faz a contagem de inserções para enviar o e-mail
        if (mysqli_query($link, $sql)) {
            $inseridos ++;
        }
    }
    //fim do forech

    //inseriu então pode enviar e-mail de boas vindas
    if($inseridos > 0){
        $mensagem = '<h1 align="center">Voc&ecirc; concluiu o cadastro com sucesso!!!</h1>
        
                    <p>Sua solicita&ccedil;&atilde;o foi realizada com sucesso!</p>
                    <p>Estamos muito felizes com o seu interesse e, principalmente, em podermos fazer parte do seu futuro e caminho profissional. A FUMEC &eacute; uma das melhores Universidades Privadas de Minas Gerais e segue seu compromisso com a educação, conhecimento e inovação.</p>
                    <p>Entraremos em contato em breve com mais informa&ccedil;&otilde;es.</p>
                    <br>
                    <p>
                        Universidade FUMEC<br>
                        31 3228-3167<br>
                        31 3228-3166<br>
                    </p>
                    <p>bolsasefinanciamentos@fumec.br</p><br>
                    <p><a href="http://bolsaoportunidade.fumec.br/dados" target="_blank">Formulário preenchido</a></p>
        
        
        
        
        ';

        require '../PHPMailer/PHPMailerAutoload.php';

        //configurações básicas de endereço e protoloco 

        $mail = new PHPMailer;                                            //faz a instância do objeto PHPMailer
        //$mail->SMTPDebug = 2;                                    		//habilita o debug se parâmetro for true
        $mail->isSMTP();                                                  //seta o tipo de protocolo
        $mail->CharSet = 'UTF-8';
        $mail->From = 'naoresponder@fumec.br';                                  //Sets the From email address for the message
        $mail->FromName = ('Bolsa Oportunidade FUMEC');                      //Sets the From name of the message
        $mail->AddAddress($email);                               //Adds a "To" address
        $mail->AddBCC(' ');                           //Adds a "Cc" address
        $mail->WordWrap = 50;                                           //Sets word wrapping on the body of the message to a given number of characters
        $mail->IsHTML(true);                                            //Sets message type to HTML    
        $mail->Subject = ('Bolsa Oportunidade FUMEC!');                       //Sets the Subject of the message
        $mail->Body = $mensagem;                                        //An HTML or plain text message body	
        // Attachments
        $mail->addAttachment('../pdf/Edital Bolsa Oportunidade - Processo Seletivo 1 sem 2019.pdf');                   // Add attachments
        $mail->addAttachment('../pdf/Lista de documentos Bolsa Oportunidade.pdf'); 
        $mail->addAttachment('../zip/Declaracoes.7z');  

        //echo $email;

        if ($mail->Send()){
            header('Location: ../fumec-form-4');

        } else {
            echo 'Há um Erro, favor entrar em contato com o admin do site!<br>';
            echo 'Erro:' . $mail->ErrorInfo;
        }
    }
    else {
        echo "Erro ao registrar o usuário!";
    }
}