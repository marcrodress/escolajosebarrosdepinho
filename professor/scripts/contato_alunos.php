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
body{
	text-align:center;
	}
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
  $titular = $_POST['titular'];
  $aluno = $_GET['aluno'];

	echo "<script language='javascript'>window.location='?aluno=$aluno&tipo=$tipo&titular=$titular';</script>";
 
 }?>
<form action="" method="post" enctype="multipart/form-data" name="form">
  <select name="tipo" style="border:1px solid #000; width:100px; padding:5px;">
    <option value="">Selecione o tipo de contato</option>
    <option value="email">E-mail</option>
    <option value="telefone">Telefone</option>
  </select>
  <select name="titular" style="border:1px solid #000; width:100px; padding:5px;">
    <option value="">De quem é esse contato?</option>
    <option value="Pai">Pai</option>
    <option value="Mãe">Mãe</option>
    <option value="Aluno">Aluno</option>
    <option value="Outros">Outros</option>
  </select>
  <input name="enviar" type="submit" id="enviar" style="border:1px solid #000; padding:5px; border-radius:3px; width:70px;" value="Cadastrar"/>  
</form>
<? } ?>








<? if($_GET['tipo'] == 'email'){ ?>
<? if(isset($_POST['enviar'])){

$email = $_POST['email'];
$obs = $_POST['obs'];
$titular = $_GET['titular'];
$aluno = $_GET['aluno'];
  
  
$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM contato_alunos WHERE contato = '$email' AND aluno = '$aluno'");
if(mysqli_num_rows($sql_verifica) == ''){
	mysqli_query($conexao_bd, "INSERT INTO contato_alunos (aluno, tipo, autor, obs, contato) VALUES ('$aluno', 'Email', '$titular', '$obs', '$email')");
	echo "<script language='javascript'>window.location='?aluno=$aluno';</script>";
}else{
	echo "<script language='javascript'>window.alert('Este e-mail já está cadastrado em sistema!');</script>";	
}
}?>

<form action="" method="post" enctype="multipart/form-data" name="" target="_self">
  <input name="email" type="email" style="border:1px solid #000; padding:5px; border-radius:3px; width:260px;" placeholder="Digite o e-mail"/>
  <br />
  <br />
  <textarea name="obs" style="border:1px solid #000; padding:5px; border-radius:3px; width:260px;" placeholder="Se tiver alguma observação, dihgite aqui."></textarea><br /><br />
  <input name="enviar" type="submit" id="enviar" style="border:1px solid #000; padding:5px; border-radius:3px; width:70px;" value="Cadastrar"/>
</form>

<? } ?>


<? if($_GET['tipo'] == 'telefone'){ ?>

<? if(isset($_POST['enviar'])){

$telefone = $_POST['telefone'];
$obs = $_POST['obs'];
$titular = $_GET['titular'];
$aluno = $_GET['aluno'];

$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM contato_alunos WHERE contato = '$telefone' AND aluno = '$aluno'");
if(mysqli_num_rows($sql_verifica) == ''){
	mysqli_query($conexao_bd, "INSERT INTO contato_alunos (aluno, tipo, autor, obs, contato) VALUES ('$aluno', 'Telefone', '$titular', '$obs', '$telefone')");
	echo "<script language='javascript'>window.location='?aluno=$aluno';</script>";
}else{
	echo "<script language='javascript'>window.alert('Este telefone já está cadastrado em sistema!');</script>";	
}
}?>
<form action="" method="post" enctype="multipart/form-data" name="" target="_self">
  <span id="sprytextfield1">
  <input name="telefone" type="text" placeholder="Digite o número de telefone" style="border:1px solid #000; padding:5px; border-radius:3px; width:263px;"/>
  </span>
  <br />
  <br />
  <textarea name="obs" style="border:1px solid #000; padding:5px; border-radius:3px; width:260px;" placeholder="Se tiver alguma observação, digite aqui."></textarea><br /><br />  
  <input name="enviar" type="submit" id="enviar" style="border:1px solid #000; padding:5px; border-radius:3px; width:70px;" value="Cadastrar"/>
</form>
<? } ?>



<hr />







<?
  $aluno = $_GET['aluno'];
  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM contato_alunos WHERE aluno = '$aluno'");
  if(mysqli_num_rows($sql_verifica) == ''){
	  echo "<em>Não foi encontrado nenhum dado de contato para este colaborador!</em>";
  }else{
?>
<table width="350" border="1">
  <tr>
    <td width="75" bgcolor="#0099CC">Titular</td>
    <td width="330" bgcolor="#0099CC">Contato</td>
    <td width="80" bgcolor="#0099CC">OBS</td>
    <td width="120" bgcolor="#0099CC">&nbsp;</td>
  </tr>
  <? 
   while($res = mysqli_fetch_array($sql_verifica)){
  ?>
  <tr>
    <td><? echo $res['autor']; ?></td>
    <td><? echo $res['contato']; ?></td>
    <td><? echo $res['obs']; ?></td>
    <td>
    	<a href="javascript:func()" onclick="confirmaExclucao('<? echo $_GET['aluno']; ?>', '<? echo $res['id']; ?>', '<? echo $res['email']; ?>')"><img src="../../img/deleta.png" title="Excluir contato" width="15" height="15" /></a>
        
        <? if($res['tipo'] == 'Telefone'){ ?>
    	<a href="https://wa.me/55<? 
				 $telefone = $res['contato'];
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
<script>
	
	 function confirmaExclucao(aluno, id, email){
		 var confirmacao = confirm('Deseja realmente abrir');
		 if(confirmacao == true){
		 	location.href = "?aluno="+aluno+"&email="+email+"&p=de&&id="+id;
		 }
	
	}


</script>


<? if($_GET['p'] == 'de'){

 $aluno = $_GET['aluno'];
 $id = $_GET['id'];
 
 
 mysqli_query($conexao_bd, "DELETE FROM contato_alunos WHERE id = '$id'");
 echo "<script language='javascript'>window.location='?aluno=$aluno';</script>";


}?>