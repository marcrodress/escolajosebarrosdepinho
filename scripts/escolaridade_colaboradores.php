<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body table{
	color: #000;
	text-align:center;
	font:12px Arial, Helvetica, sans-serif;
	border:1px solid #CCC;
	border-radius:5px;
	padding:5px;
}
body{
	text-align:center;
	padding:0;
	margin:auto;
	}
body td{
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
</head>

<body>
<? require "../../conexao.php"; $cpf = $_GET['cpf']; ?>



<? if(isset($_POST['button'])){
	
	$grau = $_POST['grau'];
	$situacao = $_POST['situacao'];
	$nome_curso = $_POST['nome_curso'];
	$inicio = $_POST['inicio'];
	$fim = $_POST['fim'];
	$carga_horaria = $_POST['carga_horaria'];
	$tipo_instituicao = $_POST['tipo_instituicao'];
	$nome_instituicao = $_POST['nome_instituicao'];

	$comprovante = $_FILES['comprovante']['name'];
	
	$code_enviar_docs = rand()+rand()+45+date("d")+date("m")+date("Y");		
	$arquivo = $comprovante;
	$arquivo = strrchr($arquivo, '.');
	$comprovante = str_replace($comprovante, "$code_enviar_docs$arquivo", $comprovante);
	if(file_exists("../documentos_colaboradores/$comprovante")){ $a = 1;while(file_exists("../documentos_colaboradores/[$a]$comprovante")){$a++;}$comprovante = "[".$a."]".$comprovante;}
	(move_uploaded_file($_FILES['comprovante']['tmp_name'], "../documentos_colaboradores/".$comprovante));
	
	
	$sql = mysqli_query($conexao_bd, "INSERT INTO colaboradores_escolaridade (cpf, status, grau, situacao, nome_curso, inicio, fim, carga_horaria	, tipo_instituicao, nome_instituicao, comprovante) VALUES ('$cpf', 'Ativo', '$grau', '$situacao', '$nome_curso', '$inicio', '$fim', '$carga_horaria', '$tipo_instituicao', '$nome_instituicao', '$comprovante')");

	echo "<script language='javascript'>window.location='';</script>";

}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="800" border="1">
  <tr>
    <td colspan="10" bgcolor="#99CC00"><h2 style="padding:0; margin:0;"><strong>Informarma&ccedil;&otilde;es da nova escolaridade</strong></h2></td>
  </tr>
  <tr>
    <td width="52"><strong>Grau</strong></td>
    <td width="53"><strong>Situaca&ccedil;&atilde;o</strong></td>
    <td width="197"><strong>Nome do curso</strong></td>
    <td width="90"><strong>Incio</strong></td>
    <td width="83"><strong>Fim</strong></td>
    <td width="143"><strong>C/H</strong></td>
    <td width="71"><strong>Tip. Institui&ccedil;&atilde;o</strong></td>
    <td><strong>Nome Institui&ccedil;&atilde;o</strong></td>
    <td><strong>Comprovante</strong></td>
    <td width="289">&nbsp;</td>
  </tr>
  <tr>
    <td>
      <select style="width:100px;" name="grau" size="1" id="grau">
        <option value="ENSINO FUNDAMENTAL">ENSINO FUNDAMENTAL</option>
        <option value="ENSINO M&Eacute;DIO">ENSINO M&Eacute;DIO</option>
        <option value="T&Eacute;CNICO">T&Eacute;CNICO</option>
        <option value="SUPERIOR">SUPERIOR</option>
        <option value="ESPECIALIZA&Ccedil;&Atilde;O">ESPECIALIZA&Ccedil;&Atilde;O</option>
        <option value="MESTRADO">MESTRADO</option>
        <option value="DOUTORADO">DOUTORADO</option>
        <option value="P&Oacute;S DOUTORADO">P&Oacute;S DOUTORADO</option>
        <option value="APERFEI&Ccedil;OAMENTO">APERFEI&Ccedil;OAMENTO</option>
        <option value="CAPACITA&Ccedil;&Atilde;O">CAPACITA&Ccedil;&Atilde;O</option>
        <option value="PROFISSIONALIZANTE">PROFISSIONALIZANTE</option>
        <option value="OUTROS">OUTROS</option>
      </select></td>
    <td><select style="width:100px;" name="situacao" size="1" id="situacao">
      <option value="CONCLU&Iacute;DO">CONCLU&Iacute;DO</option>
      <option value="CURSANDO">CURSANDO</option>
      <option value="TRANCADO">TRANCADO</option>
    </select></td>
    <td>
    <input type="text" name="nome_curso" id="nome_curso" /></td>
    <td><span id="sprytextfield1">
      <input name="inicio" type="text" id="inicio" size="7" />
      <span class="textfieldInvalidFormatMsg"></span></span></td>
    <td><span id="sprytextfield2">
    <input name="fim" type="text" id="fim" size="7" />
<span class="textfieldInvalidFormatMsg"></span></span></td>
    <td>
    <input name="carga_horaria" type="text" id="carga_horaria" size="3" /></td>
    <td><label for="nome_instituicao"></label>
      <select style="width:100px;" name="tipo_instituicao" size="1" id="tipo_instituicao">
        <option value="PRIVADA">PRIVADA</option>
        <option value="P&Uacute;BLICA">P&Uacute;BLICA</option>
      </select></td>
    <td><input type="text" name="nome_instituicao" id="nome_instituicao" /></td>
    <td><label for="comprovante"></label>
    <input name="comprovante" style="width:100px;" type="file" id="comprovante" /></td>
    <td><input type="submit" name="button" id="button" value="Enviar" /></td>
  </tr>
</table>
</form>


<hr />
<?
$sql = mysqli_query($conexao_bd, "SELECT * FROM colaboradores_escolaridade WHERE cpf = '$cpf'");
if(mysqli_num_rows($sql) == ''){
	echo "<br><br><em>Ainda não foi registrado escolaridade desse colaborador.</em><br><br>";
}else{
?>
<table width="1210" border="1">
  <tr>
    <td width="162" bgcolor="#999999">Grau</td>
    <td width="115" bgcolor="#999999">Situa&ccedil;&atilde;o</td>
    <td width="194" bgcolor="#999999">Curso</td>
    <td width="100" bgcolor="#999999">Inicio</td>
    <td width="91" bgcolor="#999999">Fim</td>
    <td width="48" bgcolor="#999999">C/H</td>
    <td width="172" bgcolor="#999999">Tipo Institui&ccedil;&atilde;o</td>
    <td width="166" bgcolor="#999999">Insitui&ccedil;&atilde;o</td>
    <td width="94" bgcolor="#999999">&nbsp;</td>
  </tr>
    <? while($res_sql = mysqli_fetch_array($sql)){ ?>
  <tr>
    <td><? echo $res_sql['grau']; ?></td>
    <td><? echo $res_sql['situacao']; ?></td>
    <td><? echo strtoupper($res_sql['nome_curso']); ?></td>
    <td><? echo $res_sql['inicio']; ?></td>
    <td><? echo $res_sql['fim']; ?></td>
    <td><? echo $res_sql['carga_horaria']; ?></td>
    <td><? echo $res_sql['tipo_instituicao']; ?></td>
    <td><? echo strtoupper($res_sql['nome_instituicao']); ?></td>
    <td>
    	<a href="?cpf=<? echo $_GET['cpf']; ?>&img=<? echo $res_sql['comprovante']; ?>&p=excluir&id=<? echo $res_sql['id']; ?>"><img src="../../img/deleta.png" width="20" height="20" /></a>
	
		<? if($res_sql['comprovante'] != '[1]' && $res_sql['comprovante'] != ''){ ?>
     	 <a target="_blank" href="../documentos_colaboradores/<? echo $res_sql['comprovante']; ?>"><img src="../../img/baixar.png" width="20" height="20" border="0" title="Abrir comprovante" /></a>
        <? } ?>    
    </td>
  </tr>
  <? } ?>
</table>
<? } ?>


<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {isRequired:false, useCharacterMasking:true, format:"dd/mm/yyyy"});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "date", {format:"dd/mm/yyyy", useCharacterMasking:true, isRequired:false});
</script>
</body>
</html>
<? if(@$_GET['p'] == 'excluir'){

$id = $_GET['id'];
$cpf = $_GET['cpf'];
$img = $_GET['img'];
$img = "../documentos_colaboradores/$img";

mysqli_query($conexao_bd, "DELETE FROM colaboradores_escolaridade WHERE id = '$id'");
$resultado = @unlink($img);
echo "<script language='javascript'>window.location='?cpf=$cpf';</script>";

}?>
