<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SISTEMA PROFESSOR</title>
<link href="css/login.css" rel="stylesheet" type="text/css" />
<link href="img/index.png" rel="shortcut icon" type="text/css" />
<link href="../bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../bootstrap-4.3.1-dist/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="jquery.superbox.css" type="text/css" media="all" />
<link href="../img/index.png" rel="shortcut icon" />
<script type="text/javascript" src="
http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript" src="jquery.superbox-min.js"></script>
<script type="text/javascript">

	$(function(){

		$.superbox.settings = {
		closeTxt: "Fechar",
		loadTxt: "Coletando informações. Por favor, aguarde...",
		overlayOpacity: .5, // Background opaqueness
		boxWidth: "800", // Default width of the box
		boxHeight: "600", // Default height of the box

			};

			$.superbox();

		});

</script>
<? require "../conexao.php"; ?>
</head>

<body>
<div id="box">
<? if(isset($_POST['button'])){

$login = $_POST['login'];
$senha = $_POST['senha'];

if($login == ''){
	echo "<h1><strong>Digite o LOGIN de acesso!</strong></h1>";
}elseif($senha == ''){
	echo "<h1><strong>Digite a SENHA de acesso!</strong></h1>";	
}else{
	
$sql = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE login = '$login' AND senha = '$senha'");
if(mysqli_num_rows($sql) == ''){
	echo "<script language='javascript'>window.alert('Login e senha não corresponde!');window.location='login.php';</script>";
}else{
	echo "<img class='img' src='../img/anigif.gif' width='200' height='200' />";


	while($res = mysqli_fetch_array($sql)){
		
	session_start();
	$_SESSION['code'] = $res['code'];	
	$_SESSION['nome'] = $res['nome_escola'];	
	$_SESSION['tipo'] = $res['tipo'];	
	
	
	mysqli_query($conexao_bd, "INSERT INTO conta_acessos (ip, dia, mes, ano, data, data_completa, usuario, tipo) VALUES ('$ip', '$dia', '$mes', '$ano', '$data', '$data_completa', '".$res['code']."', '".$res['tipo']."')");
	
	
	if($res['tipo'] == 'PROFESSOR'){
	echo "<script language='javascript'>window.location='index.php?p=turmas';</script>";
	}else{
	echo "<script language='javascript'>window.location='index.php?p=anos';</script>";
	}
	
}}}}?>
 <img src="../img/logo.png" width="210" height="200" /><br /><br />
 <hr />
<form action="" name="" method="post" enctype="multipart/form-data"> <table width="350" border="0">
  <tr>
    <td><strong>Login:</strong></td>
  </tr>
  <tr>
    <td><label for="textfield"></label>
    <input type="text" name="login" value="<? echo @$_POST['login']; ?>" autofocus></td>
  </tr>
  <tr>
    <td><strong>Senha:</strong></td>
  </tr>
  <tr>
    <td><label for="textfield3"></label>
    <input type="password" name="senha" value="<? echo @$_POST['senha']; ?>"></td>
  </tr>
  <tr>
    <td><input class="input" type="submit" name="button" id="button" value="Entrar"></td>
  </tr>
</table>
</form>
<p><a style="font:12px Arial, Helvetica, sans-serif; float:left; margin:5px 5px 10px 5px;"  rel="superbox[iframe][360x100]" href="scripts/recupera_senha.php"><em>Esqueci a senha</em></a></p>
<br>
<hr />
<a target="_blank" href="https://youtu.be/Ugvvvhwizh8" class="btn btn-info">Tutorial</a>
</div><!-- box -->
</body>
</html>