<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	text-align:center;
}
</style>
</head>

<body>
<? if(isset($_POST['button'])){

require "../../conexao.php";
	
$senha = $_POST['senha'];
$nova = $_POST['nova'];
$repita = $_POST['repita'];

$op = base64_decode($_GET['op']);
$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$op' AND senha = '$senha'");
if(mysqli_num_rows($sql_verifica) == ''){
	echo "<script language='javascript'>window.alert('Senha atual não confere!');</script>";
}else{
	if($nova != $repita){
		echo "<script language='javascript'>window.alert('As novas senhas digitadas não confere');</script>";
	}else{
		mysqli_query($conexao_bd, "UPDATE acesso_sistema SET senha = '$nova' WHERE code = '$op'");
		echo "
		</br></br>
		<strong>Senha alterada com sucesso!<br><br></strong>
		
		Pressione F5 para atualizar
		";
		die;
	}
}

}?>
<form action="" method="post" enctype="multipart/form-data">
  <table width="200" border="0">
    <tr>
      <td>Senha atual</td>
    </tr>
    <tr>
      <td><label for="textfield"></label>
      <input type="password" name="senha" id="textfield" autofocus /></td>
    </tr>
    <tr>
      <td>Nova senha</td>
    </tr>
    <tr>
      <td><label for="textfield2"></label>
      <input type="password" name="nova" id="textfield2" /></td>
    </tr>
    <tr>
      <td>Repita nova senha</td>
    </tr>
    <tr>
      <td><label for="textfield3"></label>
      <input type="password" name="repita" id="textfield3" /></td>
    </tr>
    <tr>
      <td><input type="submit" name="button" id="button" value="Alterar" /></td>
    </tr>
  </table>
</form>
</body>
</html>