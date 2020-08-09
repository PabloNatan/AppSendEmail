<?php

	

	require "./bibliotecas/PHPMailer/Exception.php";
	require "./bibliotecas/PHPMailer/OAuth.php";
	require "./bibliotecas/PHPMailer/PHPMailer.php";
	require "./bibliotecas/PHPMailer/POP3.php";
	require "./bibliotecas/PHPMailer/SMTP.php";
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	class Mensagem {
		private $para = null;
		private $assunto = null;
		private $mensagem = null;
		public $status = array('codigo_status' => null, 'descricao_status' => "");

		function __construct($para, $assunto, $mensagem) {
			$this->para = $para;
			$this->assunto = $assunto;
			$this->mensagem = $mensagem;

		}

		public function __get($atributo){
			return $this->$atributo;
		}

		public function __set($atributo, $valor) {
			$this->$atributo = $valor;
		}

		public function mensagemValida() {
			if(empty($this->para) || empty($this->assunto) || empty($this->mensagem)){
				return false;		
			} else if(strpos($this->para, '@') == false) {
				return false;
			}else {
				return true;
			}

		}
	}


	$mensagem = new Mensagem($_POST['email'], $_POST['assunto'], $_POST['mensagem']);

	if (!$mensagem->mensagemValida()){
		header('Location: index.php');
		die();
	}

	$mail = new PHPMailer(true);
	try {
	    //Server settings
	    $mail->SMTPDebug = false;                                 // Enable verbose debug output
	    $mail->isSMTP();                                      // Set mailer to use SMTP
	    $mail->Host = 'smtp.gmail.com';  						// Specify main and backup SMTP servers
	    $mail->SMTPAuth = true;                               // Enable SMTP authentication
	    $mail->Username = '';                 // SMTP username
	    $mail->Password = '';                           // SMTP password
	    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	    $mail->Port = 587;                                    // TCP port to connect to

	    //Recipients
	    $mail->setFrom('pablosnatans@gmail.com', 'Pablo Natan');
	    $mail->addAddress($mensagem->__get('para'));     // Add a recipient
	    //$mail->addReplyTo('info@example.com', 'Information');
	    //$mail->addCC('cc@example.com');
	    //$mail->addBCC('bcc@example.com');

	    //Attachments
	    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

	    //Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject =  $mensagem->__get('assunto');
	    $mail->Body    = $mensagem->__get('mensagem');
	    $mail->AltBody = 'É necessário ter um client que suporte HTML para ter acesso total ao conteúdo dessa mensagem.';

	    $mail->send();

	    $mensagem->status['codigo_status'] = 1;
	    $mensagem->status['descricao_status'] = 'E-mail enviado com sucesso.';

	} catch (Exception $e) {
	    $mensagem->status['codigo_status'] = 2;
	    $mensagem->status['descricao_status'] = 'Não foi possível enviar este e-mail! Por favor tente novamente mais tarde. Detalhes do erro: ' . $mail->ErrorInfo;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>App Send Email</title>
		<link rel="icon" href="logo.png">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<header>
		<div class="caixa-logo">
			<img src="logo.png" alt="Logo aplitivo" class="logo">
			<h1>Send Mail</h1>
			<p class="desc">Seu app de envio de e-mails particular!</p>

		</div>
	</header>
	<body>
		<?php if($mensagem->status['codigo_status'] == 1) { ?>

			<div class="modal">

				<div class="caixa">

						<?= $mensagem->status['descricao_status']; ?>
						<a href="index.php">Voltar</a>
				</div>

			</div>

		<?php } ?>
	</body>
</html>


