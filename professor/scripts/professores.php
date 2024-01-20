<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../../conexao.php"; $code_professor = @$_GET['code_professor']; $operador = @$_GET['operador']; ?>
<style type="text/css">
body{
	font:12px Arial, Helvetica, sans-serif;
	}
body input{
	padding:5px;
	width:300px;
	font:12px Arial, Helvetica, sans-serif;
	}
body table{
	padding:5px;
	font:12px Arial, Helvetica, sans-serif;
	}	
</style>
</head>

<body>
<? if(@$_GET['p'] == ''){
$code_professor = rand()+date("s")*date("d");
$senha = 123456;
mysqli_query($conexao_bd, "INSERT INTO acesso_sistema (code, nome_escola, login, senha, img, email, telefone, tipo) VALUES ('$code_professor', '', '', '$senha', '', '', '', 'PROFESSOR')");
echo "<script language='javascript'>window.location='?p=1&code_professor=$code_professor&operador=$operador&senha=$senha';</script>";
}?>


<? if(@$_GET['p'] == '1'){ ?>
<? if(isset($_POST['enviar'])){
	
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$login = $_POST['login'];
$nome = $_POST['nome'];
$ed = $_GET['ed'];
$tipo_professor = $_POST['tipo_professor'];

$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE login = '$login'");
if(mysqli_num_rows($sql_verifica) >= 1 && $ed != 'ed'){
echo "<script language='javascript'>window.alert('Já existe um cadastro com esse login!');</script>";
}else{
	$sql_verifica2 = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE email = '$email'");
	if(mysqli_num_rows($sql_verifica2) >= 1 && $ed != 'ed'){
	echo "<script language='javascript'>window.alert('Já existe um cadastro com esse e-mail!');</script>";
	}else{
		
		mysqli_query($conexao_bd, "UPDATE acesso_sistema SET nome_escola = '$nome', login = '$login', email = '$email', telefone = '$telefone' WHERE code = '$code_professor'");
		
		if($ed == ''){
		 mysqli_query($conexao_bd, "INSERT INTO professor (professor, escola, tipo) VALUES ('$code_professor', '$operador', '$tipo_professor')");
		}
		
     		$sql_professor = mysqli_query($conexao_bd, "SELECT * FROM professor WHERE professor = '$code_professor'");
			if(mysqli_num_rows($sql_professor) >= 1){
				mysqli_query($conexao_bd, "UPDATE professor SET tipo = '$tipo_professor' WHERE professor = '$code_professor'");
			}
			

		
		$senha = $_GET['senha'];
		
		echo "
		<strong>Cadastrado realizado com sucesso!</strong>
		<br><br>
		Senha inicial: $senha
		<br>
		<em>(Solicitar ao professor que alterese a senha após o primeiro acesso).</em>
		<br><br>
		Pressione F5.
		
		
		";
		die;
	}
}
}?>



<?

$sql_1 = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$code_professor'");
while($res_1 = mysqli_fetch_array($sql_1)){
?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="300" border="0">
  <tr>
    <td bgcolor="#00CCCC" align="center"><strong>INFORME OS DADOS PROFESSOR</strong></td>
  </tr>
  <tr>
    <td>Nome</td>
  </tr>
  <tr>
    <td>
    <input type="text" name="nome" value="<? echo $res_1['nome_escola']; ?>"></td>
  </tr>
  <tr>
    <td>Telefone</td>
  </tr>
  <tr>
    <td><input type="text" name="telefone" value="<? echo $res_1['telefone']; ?>"></td>
  </tr>
  <tr>
    <td>E-mail</td>
  </tr>
  <tr>
    <td><input type="text" name="email" value="<? echo $res_1['email']; ?>"></td>
  </tr>
  <tr>
    <td>Login</td>
  </tr>
  <tr>
    <td><input type="text" name="login" value="<? echo $res_1['login']; ?>"></td>
  </tr>
  <tr>
    <td><hr />Tipo de professor</td>
  </tr>
  <tr>
    <td>
    <select style="width:315px; padding:8px;" name="tipo_professor" size="1">
     <?
      
	  $sql_tipo_professor = mysqli_query($conexao_bd, "SELECT * FROM professor WHERE code = '$code_professor'");
	   while($res_tipo_professor = mysqli_fetch_array($sql_tipo_professor)){
	 ?>  
      <option value="<? echo $res_tipo_professor['tipo']; ?>"><? echo $res_tipo_professor['tipo']; ?></option>
      <? } ?>
      
      <option value="NORMAL">NORMAL</option>
      <option value="AEE">AEE</option>
      <option value="ESPECIAL">ESPECIAL</option>
    
    </select>
    
    <hr /></td>
  </tr>
  <tr>
    <td align="center"><input style="width:100px; padding:10px;" type="submit" name="enviar" id="button" value="Cadastrar"></td>
  </tr>
</table>
</form>
<? } ?>



<? } ?>
</body>
</html>