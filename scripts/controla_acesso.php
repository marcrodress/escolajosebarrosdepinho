<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body,td,th {
	color: #333;
	font:12px Arial, Helvetica, sans-serif;
	padding:0;
	margin:0;
}
body table{
	text-align:center;
	}
</style>
</head>

<body>

<? require "../../conexao.php"; ?>





<? if(isset($_POST['criar'])){

$login = $_POST['login'];
$tipo = $_POST['tipo'];

$novo_cod = rand();
$cpf = $_GET['cpf'];

$sql_cpf = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE cpf = '$cpf' AND tipo = '$tipo' AND status != 'Excluido'");
if(mysqli_num_rows($sql_cpf) >= 1){
 echo "<script language='javascript'>window.alert('Já existe um acesso deste professsor em sistema!');</script>";
}else{
	
	mysqli_query($conexao_bd, "INSERT INTO acesso_sistema (status, cpf, code, login, senha, tipo) VALUES ('Ativo', '$cpf', '$novo_cod', '$login', '12345', '$tipo')");
	echo "<script language='javascript'>window.alert('Login criado com sucesso!');window.location='';</script>";
	
}




}?>

<form name="" method="post" enctype="multipart/form-data" action="">
 <strong>Login:</strong> <input type="text" name="login" width="30" style="border:1px solid #000; width:80px; padding:5px;" />
 <strong>Tipo de acesso:</strong> <select name="tipo" size="1" style="border:1px solid #000; padding:5px; width:80px;" />
   <option value="PROFESSOR">PROFESSOR</option>
   <option value="AEE">AEE</option>
   <option value="COORDENADOR">COORDENADOR</option>
   <option value="SECRETARIO">SECRETARIO</option>
   <option value="DIRETOR">DIRETOR</option>
   <option value="SUPERVISOR">SUPERVISOR</option>
   <option value="VISITANTE">VISITANTE</option>
 </select>
 <input type="submit" name="criar" value="Criar" style="border:1px solid #000; width:50px; padding:5px;" />
</form>
<hr />

<?
$cpf = $_GET['cpf'];
$sql_cpf = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE cpf = '$cpf' AND status != 'Excluido'");
if(mysqli_num_rows($sql_cpf) <= 0){
 echo "<em>Este colaborador não possui acesso ao sistema!</em>";
}else{
?>
<table width="365" border="1">
  <tr>
    <td bgcolor="#0099CC"><strong>COD.</strong></td>
    <td bgcolor="#0099CC"><strong>STATUS</strong></td>
    <td bgcolor="#0099CC"><strong>LOGIN</strong></td>
    <td bgcolor="#0099CC"><strong>ACESSO</strong></td>
    <td bgcolor="#0099CC">&nbsp;</td>
  </tr>
  <? while($res_cpf = mysqli_fetch_array($sql_cpf)){ ?>
  <tr>
    <td><? echo $res_cpf['code']; ?></td>
    <td><? echo $res_cpf['status']; ?></td>
    <td><? echo $res_cpf['login']; ?></td>
    <td><? echo $res_cpf['tipo']; ?></td>
    <td>
    	<a href="?cpf=<? echo $_GET['cpf']; ?>&login=<? echo $res_cpf['code']; ?>&p=1&acao=Excluido"><img src="../../img/deleta.png" width="20" height="20" title="Deletar acesso" /></a>
        
        <? if($res_cpf['status'] == 'Ativo'){ ?>
        <a href="?cpf=<? echo $_GET['cpf']; ?>&login=<? echo $res_cpf['code']; ?>&p=1&acao=Inativo"><img src="../../img/pausa.png" width="20" height="20" title="Bloquear acesso" /></a>
        <? } ?>
        
        <? if($res_cpf['status'] == 'Inativo'){ ?>
        <a href="?cpf=<? echo $_GET['cpf']; ?>&login=<? echo $res_cpf['code']; ?>&p=1&acao=Ativo"><img src="../../img/ativar.png" width="20" height="20" title="Ativar acesso" /></a>
        <? } ?>

        <a href="?cpf=<? echo $_GET['cpf']; ?>&login=<? echo $res_cpf['code']; ?>&p=2&acao=Ativo"><img src="../../img/atualizar.png" width="20" height="20" title="Reiniciar senha" /></a>
   </td>
  </tr>
  <? } ?>
</table>
<? } ?>
</body>
</html>

<? if(@$_GET['p'] == '1'){
	
	$acao = $_GET['acao'];
	$cpf = $_GET['cpf'];
	$login = $_GET['login'];
	
	 mysqli_query($conexao_bd, "UPDATE acesso_sistema SET status = '$acao' WHERE code = '$login'");
	 echo "<script language='javascript'>window.location='controla_acesso.php?cpf=$cpf';</script>";


}?>

<? if(@$_GET['p'] == '2'){
	
	$acao = $_GET['acao'];
	$cpf = $_GET['cpf'];
	$login = $_GET['login'];
	
	 mysqli_query($conexao_bd, "UPDATE acesso_sistema SET senha = '12345' WHERE code = '$login'");
	 echo "<script language='javascript'>window.alert('Acesso reiniciado!');window.location='controla_acesso.php?cpf=$cpf';</script>";


}?>