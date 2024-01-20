<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body,td,th {
	color: #000;
	text-align:center;
	font:12px Arial, Helvetica, sans-serif;
	border:1px solid #CCC;
	border-radius:5px;
	padding:5px;
}
body input{
	border:1px solid #CCC;
	border-radius:5px;
	padding:5px;
	}
body select{
	border:1px solid #CCC;
	border-radius:5px;
	padding:5px;
	}
</style>
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "../../conexao.php"; $cpf = $_GET['cpf']; ?>


<? if($_GET['p'] == ''){ ?>
<a style="border:2px solid #000; padding:10px; text-decoration:none; color:#FFF; background:#0C0; font:12px Arial, Helvetica, sans-serif;" href="?cpf=<? echo $_GET['cpf']; ?>&p=novo">Novo contrato</a>
<? } ?>

<? if($_GET['p'] == 'novo'){ ?>
<? if(isset($_POST['enviar'])){

$matricula = $_GET['matricula'];
if($matricula == ''){
$matricula = $_POST['matricula'];
}


$vinculo = $_POST['vinculo'];
$carga_horaria = $_POST['carga_horaria'];
$cargo = $_POST['cargo'];
$funcao = $_POST['funcao'];
$inicio = $_POST['inicio'];
$fim = $_POST['fim'];

$comprovante_antes = $_POST['comprovante_antes'];
$comprovante = $_FILES['comprovante']['name'];

if($comprovante != '' || $comprovante_antes == ''){
$code_enviar_docs = rand()+rand()+45+date("d")+date("m")+date("Y");		
$arquivo = $comprovante;
$arquivo = strrchr($arquivo, '.');
$comprovante = str_replace($comprovante, "$code_enviar_docs$arquivo", $comprovante);
if(file_exists("../contratos_trabalho/$comprovante")){ $a = 1;while(file_exists("../contratos_trabalho/[$a]$comprovante")){$a++;}$comprovante = "[".$a."]".$comprovante;}
(move_uploaded_file($_FILES['comprovante']['tmp_name'], "../contratos_trabalho/".$comprovante));
}

if($comprovante == ''){
	$comprovante = $comprovante_antes;
}


$sql_contratos = mysqli_query($conexao_bd, "SELECT * FROM colaboradores_contratos WHERE matricula = '$matricula' AND cpf = '$cpf'");
if(mysqli_num_rows($sql_contratos) == ''){
	mysqli_query($conexao_bd, "INSERT INTO colaboradores_contratos (cpf, status, matricula, vinculo, carga_horaria, cargo, funcao, inicio, fim, comprovante) VALUES ('$cpf', 'Ativo', '$matricula', '$vinculo', '$carga_horaria', '$cargo', '$funcao', '$inicio', '$fim', '$comprovante')");
echo "<script language='javascript'>window.location='?cpf=$cpf';</script>";
}else{
  
  $status = $_POST['status'];
  if($fim != ''){
	  $status = "Encerrado";
  }
  
  mysqli_query($conexao_bd, "UPDATE colaboradores_contratos SET status = '$status', vinculo = '$vinculo', carga_horaria = '$carga_horaria', cargo = '$cargo', funcao = '$funcao', inicio = '$inicio', fim = '$fim', comprovante = '$comprovante' WHERE matricula = '$matricula' AND cpf = '$cpf'");
echo "<script language='javascript'>window.location='?cpf=$cpf';</script>";
  
}
}?>




<?

$sql_contratos = mysqli_query($conexao_bd, "SELECT * FROM colaboradores_contratos WHERE matricula = '".$_GET['matricula']."' AND cpf = '$cpf'");
while($res_contratos = mysqli_fetch_array($sql_contratos)){
	
	$vinculo = $res_contratos['vinculo'];
	$carga_horaria = $res_contratos['carga_horaria'];
	$cargo = $res_contratos['cargo'];
	$funcao = $res_contratos['funcao'];
	$inicio = $res_contratos['inicio'];
	$fim = $res_contratos['fim'];
	$comprovante = $res_contratos['comprovante'];
	$status = $res_contratos['status'];
	
}


?>
<form name="" method="post" action="" enctype="multipart/form-data">
<input type="hidden" name="status" value="<? echo $status; ?>" />
<table width="800" border="0">
  <tr>
    <td colspan="7" bgcolor="#0099FF"><strong>INFORMA&Ccedil;&Otilde;ES SOBRE O NOVO CONTRATO</strong></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>Matricula</strong></td>
    <td bgcolor="#CCCCCC"><strong>V&iacute;nculo</strong></td>
    <td bgcolor="#CCCCCC"><strong>C/H</strong></td>
    <td bgcolor="#CCCCCC"><strong>Cargo</strong></td>
    <td bgcolor="#CCCCCC"><strong>Fun&ccedil;&atilde;o</strong></td>
    <td bgcolor="#CCCCCC"><strong>Inicio de contrato</strong></td>
    <td bgcolor="#CCCCCC"><strong>Fim do contrato</strong></td>
  </tr>
  <tr>
    <td><input name="matricula" type="text" <? if($_GET['matricula'] != ''){ ?>disabled="disabled"<? } ?> value="<? echo @$_GET['matricula']; ?>" size="5" /></td>
    <td>
      <select style="width:160px;" name="vinculo" size="1" id="select">
        <option value="<? echo $vinculo; ?>"><? echo $vinculo; ?></option>
        <option value="EFETIVO">EFETIVO</option>
        <option value="CONTRATADO">CONTRATADO</option>
        <option value="COMISSIONADO">COMISSIONADO</option>
        <option value="COMISSIONADO/EFETIVO">COMISSIONADO/EFETIVO</option>
        <option value="COMISSIONADO/TEMPOR&Aacute;RIO">COMISSIONADO/TEMPOR&Aacute;RIO</option>
        <option value="COMISSIONADO/CONTRATADO">COMISSIONADO/CONTRATADO</option>
      </select></td>
    <td><input name="carga_horaria" type="text" value="<? echo $carga_horaria; ?>" size="4" /></td>
    <td><input name="cargo" type="text" value="<? echo $cargo; ?>" size="10" /></td>
    <td>
      <select name="funcao" size="1">
        <option value="<? echo $funcao; ?>"><? echo $funcao; ?></option>
        <option value="ANOS INICIAIS">ANOS INICIAIS</option>
        <option value="ANOS FINAIS">ANOS FINAIS</option>
        <option value="GEST&Atilde;O">GEST&Atilde;O</option>
        <option value="uxiliar de serviços gerais">Auxiliar de serviços gerais</option>
      </select>
    </td>
    <td><span id="sprytextfield1">
    <label for="inicio"></label>
    <input name="inicio" type="text" value="<? echo $inicio; ?>" size="10" />
    <span class="textfieldRequiredMsg"></span></span></td>
    <td><span id="sprytextfield2">
    <input name="fim" type="text" value="<? echo $fim; ?>" size="10" />
    <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span></span></td>
  </tr>
  <tr>
    <td colspan="7" bgcolor="#CCCCCC"><strong>Upload do contrato de trabalho</strong></td>
  </tr>
  <tr> <input type="hidden" name="comprovante_antes" value="<? echo $comprovante; ?>" />
    <td colspan="7"><input type="file" name="comprovante" /></td>
  </tr>
  <tr>
    <td colspan="7"><input style="border:2px solid #000; padding:10px; text-decoration:none; color:#FFF; background:#0C0; font:12px Arial, Helvetica, sans-serif;" type="submit" name="enviar" id="button" value="Cadastrar" /></td>
  </tr>
</table>
</form>

<? } ?>




<? if($_GET['p'] == ''){ ?>
<hr />
<?
$sql = mysqli_query($conexao_bd, "SELECT * FROM colaboradores_contratos WHERE cpf = '$cpf'");
if(mysqli_num_rows($sql) == ''){
	echo "<em>Ainda não foi registrado contrato de trabalho desse colaborador.</em>";
}else{
?>
<table width="850" border="0">
  <tr>
    <td bgcolor="#CCCCCC"><strong>Matricula</strong></td>
    <td bgcolor="#CCCCCC"><strong>V&iacute;nculo</strong></td>
    <td bgcolor="#CCCCCC"><strong>C/H</strong></td>
    <td bgcolor="#CCCCCC"><strong>Cargo</strong></td>
    <td bgcolor="#CCCCCC"><strong>Fun&ccedil;&atilde;o</strong></td>
    <td bgcolor="#CCCCCC"><strong>In&iacute;cio</strong></td>
    <td bgcolor="#CCCCCC"><strong>Fim</strong></td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <? while($res_sql = mysqli_fetch_array($sql)){ ?>
  <tr>
    <td><? echo $res_sql['matricula']; ?></td>
    <td><? echo $res_sql['vinculo']; ?></td>
    <td><? echo $res_sql['carga_horaria']; ?></td>
    <td><? echo $res_sql['cargo']; ?></td>
    <td><? echo $res_sql['funcao']; ?></td>
    <td><? echo $res_sql['inicio']; ?></td>
    <td><? echo $res_sql['fim']; ?></td>
    <td>
    	<a href="?cpf=<? echo $_GET['cpf']; ?>&img=<? echo $res_sql['comprovante']; ?>&p=excluir&id=<? echo $res_sql['id']; ?>"><img src="../../img/deleta.png" width="20" height="20" border="0" /></a>
        
        
      <a href="?cpf=<? echo $_GET['cpf']; ?>&p=novo&matricula=<? echo $res_sql['matricula']; ?>"><img src="../img/edita.png" width="20" height="20" border="0" /></a> 
        
        
    	<? if($res_sql['comprovante'] != '[1]' && $res_sql['comprovante'] != ''){ ?>
      <a target="_blank" href="../contratos_trabalho/<? echo $res_sql['comprovante']; ?>"><img src="../../img/baixar.png" width="20" height="20" border="0" title="Abrir comprovante" /></a>
        <? } ?>
   </td>
  </tr>
  <? } ?>
</table>
<? } ?>


<? } ?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {format:"dd/mm/yyyy", useCharacterMasking:true, isRequired:false});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "date", {useCharacterMasking:true, format:"dd/mm/yyyy", isRequired:false});
</script>
</body>
</html>
<? if(@$_GET['p'] == 'excluir'){

$id = $_GET['id'];
$cpf = $_GET['cpf'];
$img = $_GET['img'];
$img = "../contratos_trabalho/$img";

mysqli_query($conexao_bd, "DELETE FROM colaboradores_contratos WHERE id = '$id'");
$resultado = @unlink($img);
echo "<script language='javascript'>window.location='?cpf=$cpf';</script>";

}?>