<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body{
	text-align:center;
}
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
</head>

<body>
<? require "../../conexao.php"; $cpf = $_GET['cpf']; ?>

<? if(isset($_POST['button'])){
	
$tipo = $_POST['tipo'];
$comprobatorio = $_POST['comprobatorio'];
$comprovante = $_FILES['comprovante']['name'];

$code_enviar_docs = rand()+rand()+45+date("d")+date("m")+date("Y");		
$arquivo = $comprovante;
$arquivo = strrchr($arquivo, '.');
$comprovante = str_replace($comprovante, "$code_enviar_docs$arquivo", $comprovante);
if(file_exists("../documentos_colaboradores/$comprovante")){ $a = 1;while(file_exists("../documentos_colaboradores/[$a]$comprovante")){$a++;}$comprovante = "[".$a."]".$comprovante;}
(move_uploaded_file($_FILES['comprovante']['tmp_name'], "../documentos_colaboradores/".$comprovante));

$sql = mysqli_query($conexao_bd, "INSERT INTO colaboradores_assinatura (cpf, tipo, comprovante, comprobatorio, data) VALUES ('$cpf', '$tipo', '$comprovante', '$comprobatorio', '$data_completa')");

echo "<script language='javascript'>window.location='';</script>";


}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="400" border="0">
  <tr>
    <td colspan="4" bgcolor="#0066FF"><em><strong>Cadastrar nova assinatura</strong></em></td>
  </tr>
  <tr>
    <td width="54" bgcolor="#CCCCCC"><em><strong>Tipo</strong></em></td>
    <td width="117" bgcolor="#CCCCCC"><em><strong>Upload da assinatura</strong></em></td>
    <td colspan="2" bgcolor="#CCCCCC"><em><strong>Doc. Comprobat&oacute;rio</strong></em></td>
  </tr>
  <tr>
    <td>
      <select name="tipo" size="1" id="select">
        <option value="RUBRICA">RUBRICA</option>
        <option value="ASSINATURA">ASSINATURA</option>
    </select></td>
    <td>
    <input type="file" name="comprovante" /></td>
    <td width="165">
      <select name="comprobatorio" size="1">
        <option value="RG">RG</option>
        <option value="CNH">CNH</option>
        <option value="PASSAPORTE">PASSAPORTE</option>
        <option value="CARTEIRA DE TRABALHO">CARTEIRA DE TRABALHO</option>
    </select></td>
    <td width="36"><input type="submit" name="button" id="button" value="Enviar" /></td>
  </tr>
</table>
</form>

<hr />
<?
$sql = mysqli_query($conexao_bd, "SELECT * FROM colaboradores_assinatura WHERE cpf = '$cpf'");
if(mysqli_num_rows($sql) == ''){
	echo "<em>Ainda não foi enviado assinatura digital desse colaborador.</em>";
}else{
?>
<table width="628" border="0">
  <tr>
    <td width="116" bgcolor="#CCCCCC"><strong>Atualiza&ccedil;&atilde;o</strong></td>
    <td width="120" bgcolor="#CCCCCC"><em><strong>Tipo</strong></em></td>
    <td width="168" bgcolor="#CCCCCC"><em><strong>Upload da assinatura</strong></em></td>
    <td width="152" bgcolor="#CCCCCC"><em><strong>Doc. Comprobat&oacute;rio</strong></em></td>
    <td width="50" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <? while($res_sql = mysqli_fetch_array($sql)){ ?>
  <tr>
    <td><? echo $res_sql['data']; ?></td>
    <td><? echo $res_sql['tipo']; ?></td>
    <td><img src="../documentos_colaboradores/<? echo $res_sql['comprovante']; ?>" width="70" height="70" /></td>
    <td><? echo $res_sql['comprobatorio']; ?></td>
    <td><a href="?cpf=<? echo $_GET['cpf']; ?>&img=<? echo $res_sql['comprovante']; ?>&p=excluir&id=<? echo $res_sql['id']; ?>"><img src="../../img/deleta.png" width="20" height="20" /></a></td>
  </tr>
  <? } ?>
</table>
<? } ?>
</body>
</html>
<? if(@$_GET['p'] == 'excluir'){

$id = $_GET['id'];
$cpf = $_GET['cpf'];
$img = $_GET['img'];
$img = "../documentos_colaboradores/$img";

mysqli_query($conexao_bd, "DELETE FROM colaboradores_assinatura WHERE id = '$id'");
$resultado = @unlink($img);
echo "<script language='javascript'>window.location='?cpf=$cpf';</script>";

}?>