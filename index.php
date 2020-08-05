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
		<div class="caixa-formulario">
			<form>
				<label for="email">Para</label>
				<input type="text" name="email" placeholder="joao@dominio.com.br" id="email" class="entrada">

				<label for="assunto">Assunto</label>
				<input type="text" name="assunto" placeholder="Assunto do e-mail" id="assunto" class="entrada">

				<label for="mensagem">Mensagem</label>
				<textarea name="mensagem" id="mensagem" placeholder="Digite sua mensagem aqui..." class="entrada"></textarea>

				<button class="btn-enviar">Enviar Mensagem</button>
			</form>
		</div>
	</body>
</html>