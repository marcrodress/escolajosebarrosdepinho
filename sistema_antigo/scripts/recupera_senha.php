<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body {
	font:12px Arial, Helvetica, sans-serif;
}
body input{
	font:12px Arial, Helvetica, sans-serif;
	padding:5px;
	width:300px;
}
</style>
<? require "../../conexao.php"; ?>
</head>

<body>
<? if(isset($_POST['button'])){
	
$email = $_POST['email'];

if($email == ''){
	echo "<script language='javascript'>window.alert('Digite seu e-mail!');</script>";
}else{
	$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE email = '$email'");
		if(mysqli_num_rows($sql_verifica) <= 0){
		 echo "<script language='javascript'>window.alert('Não existe um cadastro com esse e-mail em sistema!');</script>";
		}else{
		  while($res_email = mysqli_fetch_array($sql_verifica)){
			
			$nome = $res_email['nome_escola'];
			$senha = $res_email['senha'];
			$login = $res_email['login'];
		
include("../phpmailer/class.phpmailer.php");


		$mail = new PHPMailer();
		$mail->IsMAIL(); 
		$mail->Host = "mail.ikuly.com"; 
		$mail->SMTPAuth = true; 
		$mail->Username = "suporte@ikuly.com"; 
		$mail->Password = "Rcbv896xw*"; // senha
		$mail->From = "suporte@ikuly.com";
		$mail->FromName = "STO";
		$mail->AddAddress("$email","RECUPERAÇÃO DE SENHA - SISTEMA ATIVIDADE ONLINE");
		$mail->WordWrap = 500; 
		$mail->AddAttachment("anexo/arquivo.zip"); 
		$mail->AddAttachment("imagem/foto.jpg");
		$mail->IsHTML(true); //enviar em HTML
		
		
			$mail->AddReplyTo("$email","RECUPERAÇÃO DE SENHA - SISTEMA ATIVIDADE ONLINE");
			$msg  = "";
			$msg .= "
			
			Olá<br>
			<br><br>
			
			<strong>Seu login de acesso ao STO é:</strong> $senha <br>
			<strong>Sua senha de acesso ao STO é:</strong> $login
			
			
			<br><br>
			
			<strong>Att.</strong><br>
			<em>STO</<br>
			
			\n";
		 
		$mail->Subject = "RECUPERAÇÃO DE SENHA - SISTEMA DE ATIVIDADES ONLINE";
		//adicionando o html no corpo do email
		$mail->Body = $msg;
		//enviando e retornando o status de envio
		if(!$mail->Send())
		{
		$inicio++;
		echo "Ocorreru um erro, tente novamente!".$mail->ErrorInfo;
		//$mail->ErrorInfo informa onde ocorreu o erro 
		
		exit;
		}					
			
			echo "
			<strong>Senha enviada com sucesso!</strong>
			<br>
			<em>Pressione F5.</em>
			
			";
			die;
		  }
	}
	
}
}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<h1 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;"><em><strong>Digite seu e-mail para recuperar a senha:</strong></em></h1>
<input style="width:200px;" width="50" type="text" name="email" /> <input style="width:100px;" type="submit" name="button" value="Recuperar" />
</form>
</body>
</html>