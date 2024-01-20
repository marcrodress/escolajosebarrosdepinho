<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>

<style type="text/css">
body table{
	text-align:center;
	font:12px Arial, Helvetica, sans-serif;
}
body,td,th {
	color: #000;
	font:12px Arial, Helvetica, sans-serif;
}
</style>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>

<? require "../../conexao.php"; ?>

 <? if($_GET['tipo'] == ''){ ?>
 <? if(isset($_POST['enviar'])){

  $tipo = $_POST['tipo'];
  $cpf = $_GET['cpf'];

	echo "<script language='javascript'>window.location='?cpf=$cpf&tipo=$tipo';</script>";
 
 }?>
<form action="" method="post" enctype="multipart/form-data" name="form">
  <select name="tipo" style="border:1px solid #000; width:300px; padding:5px;">
    <option value="">Selecione o tipo de contato</option>
    <option value="email">E-mail</option>
    <option value="telefone">Telefone</option>
  </select>
  <input name="enviar" type="submit" id="enviar" style="border:1px solid #000; padding:5px; border-radius:3px; width:70px;" value="Cadastrar"/>  
</form>
<? } ?>








<? if($_GET['tipo'] == 'email'){ ?>
<? if(isset($_POST['enviar'])){

$email = $_POST['email'];
$cpf = $_GET['cpf'];

$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM contato_colaboradores WHERE email = '$email' AND cpf = '$cpf'");
if(mysqli_num_rows($sql_verifica) == ''){
	mysqli_query($conexao_bd, "INSERT INTO contato_colaboradores (cpf, email, tipo, telefone, principal) VALUES ('$cpf', '$email', 'E-mail', '', '')");
	echo "<script language='javascript'>window.location='?cpf=$cpf';</script>";
}else{
	echo "<script language='javascript'>window.alert('Este e-mail já está cadastrado em sistema!');</script>";	
}
}?>

<form action="" method="post" enctype="multipart/form-data" name="" target="_self">
  <input name="email" type="email" style="border:1px solid #000; padding:5px; border-radius:3px; width:260px;"/>
  <input name="enviar" type="submit" id="enviar" style="border:1px solid #000; padding:5px; border-radius:3px; width:70px;" value="Cadastrar"/>
</form>

<? } ?>


<? if($_GET['tipo'] == 'telefone'){ ?>

<? if(isset($_POST['enviar'])){

$telefone = $_POST['telefone'];
$cpf = $_GET['cpf'];

$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM contato_colaboradores WHERE telefone = '$telefone' AND cpf = '$cpf'");
if(mysqli_num_rows($sql_verifica) == ''){
	mysqli_query($conexao_bd, "INSERT INTO contato_colaboradores (cpf, email, tipo, telefone, principal) VALUES ('$cpf', '', 'Telefone', '$telefone', '')");
	echo "<script language='javascript'>window.location='?cpf=$cpf';</script>";
}else{
	echo "<script language='javascript'>window.alert('Este telefone já está cadastrado em sistema!');</script>";	
}
}?>
<form action="" method="post" enctype="multipart/form-data" name="" target="_self">
  <span id="sprytextfield1">
  <input name="telefone" type="text" style="border:1px solid #000; padding:5px; border-radius:3px; width:263px;"/>
  </span>
  <input name="enviar" type="submit" id="enviar" style="border:1px solid #000; padding:5px; border-radius:3px; width:70px;" value="Cadastrar"/>
</form>
<? } ?>



<hr />







<?
  $cpf = $_GET['cpf'];
  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM contato_colaboradores WHERE cpf = '$cpf'");
  if(mysqli_num_rows($sql_verifica) == ''){
	  echo "<em>Não foi encontrado nenhum dado de contato para este colaborador!</em>";
  }else{
?>
<table width="350" border="1">
  <tr>
    <td width="75" bgcolor="#0099CC">Tipo</td>
    <td width="330" bgcolor="#0099CC">Contato</td>
    <td width="80" bgcolor="#0099CC">&nbsp;</td>
  </tr>
  <? 
   while($res = mysqli_fetch_array($sql_verifica)){
  ?>
  <tr>
    <td><? echo $res['tipo']; ?></td>
    <td><? echo $res['email']; ?><? echo $res['telefone']; ?></td>
    <td>
    	<a href="?cpf=<? echo $_GET['cpf']; ?>&telefone=<? echo $res['telefone']; ?>&email=<? echo $res['email']; ?>&p=de"><img src="../../img/deleta.png" width="15" height="15" /></a>
        
        <? if($res['telefone'] != ''){ ?>
    	<a href="https://wa.me/55<? 
				 $telefone = $res['telefone'];
				 $telefone = str_replace(" ", "", $telefone); 
				 $telefone = str_replace(".", "", $telefone);
				 $telefone = str_replace("(", "", $telefone); 
				 $telefone = str_replace(")", "", $telefone);
		echo $telefone; ?>" title="Contato via WhatsApp" target="_blank"><img src="../img/whatsapp.png" width="15" height="15" /></a>
       <? } ?>
        
        
    </td>
  </tr>
  <? } ?>  
</table>
<? } ?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "custom", {pattern:"(00) 00000.0000", useCharacterMasking:true});
</script>
</body>
</html>
<? if($_GET['p'] == 'de'){

 $cpf = $_GET['cpf'];
 $telefone = $_GET['telefone'];
 $email = $_GET['email'];
 
 
 mysqli_query($conexao_bd, "DELETE FROM contato_colaboradores WHERE cpf = '$cpf' AND telefone = '$telefone' AND email = '$email'");
 echo "<script language='javascript'>window.location='?cpf=$cpf';</script>";


}?>