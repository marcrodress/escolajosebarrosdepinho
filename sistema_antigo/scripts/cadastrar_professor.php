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
	
$nome = $_POST['nome'];
$email = $_POST['email'];
$login = $_POST['login'];
$senha = $_POST['senha'];
$repita_senha = $_POST['repita_senha'];

if($nome == ''){
	echo "<script language='javascript'>window.alert('Digite seu nome completo!');</script>";
}elseif($email == ''){
	echo "<script language='javascript'>window.alert('Digite seu e-mail!');</script>";
}elseif($login == ''){
	echo "<script language='javascript'>window.alert('Crie um login para acessar o sistema!');</script>";
}elseif($senha == ''){
	echo "<script language='javascript'>window.alert('Crie uma senha para acesso ao sistema!');</script>";
}elseif($senha != $repita_senha){
	echo "<script language='javascript'>window.alert('Senhas não correspondem!');</script>";
	unset($senha,$repita_senha);
}else{
	
	$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM professor WHERE usuario = '$login'");
	if(mysqli_num_rows($sql_verifica) >= 1){
	echo "<script language='javascript'>window.alert('Já existe um cadastro com esse login em sistema!');</script>";
	}else{
	$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM professor WHERE email = '$email'");
		if(mysqli_num_rows($sql_verifica) >= 1){
		 echo "<script language='javascript'>window.alert('Já existe um cadastro com esse e-mail em sistema!');</script>";
		}else{
			
			$code = rand();
			mysqli_query($conexao_bd, "INSERT INTO professor (operador, usuario, senha, nome, img, email) VALUES ('$code', '$login', '$senha', '$nome', '', '$email')");
			
			echo "
			<strong>Cadastro efetuado com sucesso!</strong>
			<br>
			<em>Pressione F5.</em>
			
			";
			die;
			
		}
	}
	
}
}?>
<form name="" method="post" action="" enctype="multipart/form-data">
  <table width="300" border="0">
    <tr>
      <td style="border:1px solid #000; padding:5px; font-weight: bold;" align="center" bgcolor="#00CCFF">PREENCHA TODOS OS DADOS ABAIXO</td>
    </tr>
    <tr>
      <td>Nome do professor:</td>
    </tr>
    <tr>
      <td><label for="nome"></label>
      <input type="text" name="nome" id="nome" value="<? echo @$nome; ?>" /></td>
    </tr>
    <tr>
      <td>E-mail:</td>
    </tr>
    <tr>
      <td><label for="email"></label>
      <input type="text" name="email" id="email" value="<? echo @$email; ?>" /></td>
    </tr>
    <tr>
      <td>Login:</td>
    </tr>
    <tr>
      <td><label for="login"></label>
      <input type="text" name="login" id="login" value="<? echo @$login; ?>" /></td>
    </tr>
    <tr>
      <td>Senha:</td>
    </tr>
    <tr>
      <td><label for="senha"></label>
      <input type="password" name="senha" id="senha" /></td>
    </tr>
    <tr>
      <td>Repita a senha:</td>
    </tr>
    <tr>
      <td><label for="repita_senha"></label>
      <input type="password" name="repita_senha" id="repita_senha" /></td>
    </tr>
    <tr>
      <td><input type="submit" style="width:315px;" name="button" id="button" value="Cadastrar" /></td>
    </tr>
  </table>
</form>
</body>
</html>