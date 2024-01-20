<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../../conexao.php"; ?>
<style>
body{
	font:12px Arial, Helvetica, sans-serif;
	width:300px;
	}
body select{
	font:12px Arial, Helvetica, sans-serif;
	width:300px;
	padding:5px;
	}
body .input{
	font:12px Arial, Helvetica, sans-serif;
	width:287px;
	padding:5px;
	}
body input{
	font:12px Arial, Helvetica, sans-serif;
	width:300px;
	padding:5px;
	}
</style>
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>
<body> <? $aluno = $_GET['aluno']; $operador = $_GET['operador']; ?>


<? if($aluno == ''){
 $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE usuario = '$operador'");
 if(mysqli_num_rows($sql_turma) == ''){
	 echo "<em>Você ainda não cadastrou nenhuma turma.</em>";
 }else{
 $code_aluno = rand()*date("d")+rand()*date("d");	
 mysqli_query($conexao_bd, "INSERT INTO alunos (usuario, turma, code_aluno, n_chamada, nome_aluno, telefone, telefone2, especial, impresso) VALUES ('$operador', '', '$code_aluno', '', '', '', '', '', '')");
 echo "<script language='javascript'>window.location='?aluno=$code_aluno&operador=$operador';</script>";
 }
}?>

<? if($aluno >= 1){ 
$sql = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '$aluno'");
 while($res = mysqli_fetch_array($sql)){
?>

<? if(isset($_POST['enviar'])){

$turma = strtoupper($_POST['turma']);
$n_chamada = strtoupper($_POST['n_chamada']);
$nome_aluno = strtoupper($_POST['nome_aluno']);
$telefone = $_POST['telefone'];
$telefone2 = $_POST['telefone2'];
$laudo = $_POST['laudo'];
$suprido = $_POST['suprido'];
$impresso = $_POST['impresso'];
$localidade = $_POST['localidade'];
$transferido = $_POST['transferido'];

$sql_verifica_id = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE n_chamada = '$n_chamada' AND nome_aluno = '$nome_aluno'");

mysqli_query($conexao_bd, "UPDATE alunos SET transferido = '$transferido', suprido = '$suprido', turma = '$turma', localidade = '$localidade', n_chamada = '$n_chamada', nome_aluno = '$nome_aluno', telefone = '$telefone', telefone2 = '$telefone2', especial = '$laudo', impresso = '$impresso' WHERE code_aluno = '$aluno'");

echo "<strong>Operação realizada com sucesso!</strong><br><em>Pressione F5.</em>";
die;
}?>




<?

$sql_aluno = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$_GET['aluno']."'");
while($res_aluno = mysqli_fetch_array($sql_aluno)){
?>
<form action="" method="post">
  <strong>Selecione a turma</strong><br />
  <select name="turma" size="1">
   <?
    $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res_aluno['turma']."'");
	  while($res_turma = mysqli_fetch_array($sql_turma)){
   ?>
    <option value="<? echo $res_turma['code_turma']; ?>">
	<? echo $res_turma['code_serie']; ?>° ANO
	<? echo $res_turma['tipo_turma']; ?>  
     - 
	<? echo $res_turma['turno']; ?>    
    </option>
   <? } ?>
    
    
       
   
   <?
    $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_escola = '$operador' AND code_turma != '".$res_aluno['turma']."'");
	  while($res_turma = mysqli_fetch_array($sql_turma)){
   ?>
    <option value="<? echo $res_turma['code_turma']; ?>">
	<? echo $res_turma['code_serie']; ?>° ANO
	<? echo $res_turma['tipo_turma']; ?>  
     - 
	<? echo $res_turma['turno']; ?>    
    </option>
    <? } ?>
  </select><br />
  <strong>Localidade</strong><br />
    <select style="font:12px Arial, Helvetica, sans-serif; padding:5px; width:300px;" name="localidade" size="1">
      <option value="<? echo $res_aluno['localidade']; ?>"><? echo $res_aluno['localidade']; ?></option>
      <option value="BOLSO">BOLSO</option>
      <option value="ANIL">ANIL</option>
      <option value="SAQUINHO">SAQUINHO</option>
      <option value="ACENDE CANDEIA DE CIMA">ACENDE CANDEIA DE CIMA</option>
      <option value="ACENDE CANDEIA DE BAIXO">ACENDE CANDEIA DE BAIXO</option>
      <option value="FLORES">FLORES</option>
      <option value="AREA VERDADE">AREA VERDADE</option>
      <option value="CATUANA">CATUANA</option>
      <option value="JACARE">JACARE</option>
      <option value="SÃO GONÇALO">SÃO GONÇALO</option>
    </select>  <br />
  <strong>N° da chamada</strong><br />
  <select name="n_chamada" size="1">
    <option value="<? echo $res_aluno['n_chamada']; ?>"><? echo $res_aluno['n_chamada']; ?></option>
    <option value=""></option>
   <? for($i=1; $i<=50; $i++){ ?>
    <option value="<? echo $i; ?>"><? echo $i; ?></option>
   <? } ?>
  </select><br />
  <strong>Nome do aluno</strong><br />
  <input class="input" type='text' name="nome_aluno" value="<? echo $res_aluno['nome_aluno']; ?>" /><br />
  <strong>Telefone</strong><br />
  <span id="sprytextfield1">
  <input class="input" type='text' name="telefone" value="<? echo $res_aluno['telefone']; ?>" />
  <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span></span>
  <br />
    <strong>Telefone 2</strong><br />
<span id="sprytextfield2">
<input style="width:287px;" name="telefone2" type="text"  value="<? echo $res_aluno['telefone2']; ?>" />
<span class="textfieldInvalidFormatMsg"></span></span><br />

<input name="transferido" type="checkbox" style="width:20px;" value="SIM" <? if($res_aluno['transferido'] == 'SIM'){ ?>checked="checked" <? } ?>/> Transferido
<input name="laudo" type="checkbox" style="width:20px;" value="SIM" <? if($res_aluno['especial'] == 'SIM'){ ?>checked="checked" <? } ?>/> Laudado<br />
<input name="suprido" type="checkbox" style="width:20px;" value="SIM" <? if($res_aluno['suprido'] == 'SIM'){ ?>checked="checked" <? } ?>/> Suprido
<input name="impresso" type="checkbox" style="width:20px;" value="SIM" <? if($res_aluno['impresso'] == 'SIM'){ ?>checked="checked"<? } ?> /> Impresso
<hr />

  <input name="enviar" type="submit" value="Enviar" />
  </p>
</form>
<? } ?>



<? }}?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "custom", {useCharacterMasking:true, pattern:"(00) 00000.0000", isRequired:false});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "custom", {pattern:"(00) 00000.0000", useCharacterMasking:true, isRequired:false});
</script>
</body>
</html>