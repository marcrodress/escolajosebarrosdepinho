<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body{
	padding:0;
	margin:0;
}
body,td,th {
	color: #000;
	text-align:center;
	font:12px Arial, Helvetica, sans-serif;
}
body table{
	border:3px solid #000;
}
body input{
	padding:8px;
	border:1px solid #000;
}
body select{
	padding:7px;
	border:1px solid #000;
}
</style>
</head>

<body>
<? require "../../conexao.php"; ?>


<? if(isset($_POST['button'])){
	
$tipo_documento = $_POST['tipo_documento'];
$nome_documento = $_POST['nome_documento'];
$comprovante = $_FILES['comprovante']['name'];

if($comprovante == ''){
	echo "<script language='javascript'>window.alert('Documento não foi anexado!');window.location='';</script>";
}else{

$code_enviar_docs = rand()+rand()+45+date("d")+date("m")+date("Y");		
		
$arquivo = $comprovante;
$arquivo = strrchr($arquivo, '.');

$comprovante = str_replace($comprovante, "$code_enviar_docs$arquivo", $comprovante);


if(file_exists("../documentos_colaboradores/$comprovante")){ $a = 1;while(file_exists("../documentos_colaboradores/[$a]$comprovante")){$a++;}$comprovante = "[".$a."]".$comprovante;}

$aluno = $_GET['aluno'];

mysqli_query($conexao_bd, "INSERT INTO documentos_alunos (aluno, tipo, documento, comprovante) VALUES ('$aluno', '$tipo_documento', '$nome_documento', '$comprovante')");

		
(move_uploaded_file($_FILES['comprovante']['tmp_name'], "../documentos_colaboradores/".$comprovante));

	echo "<script language='javascript'>window.location='';</script>";

}
}?>
<form action="" method="post" enctype="multipart/form-data">
<table width="600" border="0">
  <tr>
    <td colspan="4" bgcolor="#0099CC" align="center"><h3><strong>ENVIO DE DOCUMENTOS</strong></h3></td>
  </tr>
  <tr>
    <td width="182"><strong>Tipo de documento</strong></td>
    <td width="140"><strong>Nome do documento</strong></td>
    <td width="140"><strong>Upload</strong></td>
    <td width="114">&nbsp;</td>
  </tr>
  <tr>
    <td>
      <select name="tipo_documento" size="1" id="tipo_documento">
        <option value="RG">RG</option>
        <option value="CPF">CPF</option>
        <option value="TITULO">TITULO</option>
        <option value="COMPROVANTE DE VOTA&Ccedil;&Atilde;O">COMPROVANTE DE VOTA&Ccedil;&Atilde;O</option>
        <option value="CARTEIRA DE TRABALHO">CARTEIRA DE TRABALHO</option>
        <option value="CART&Atilde;O DE BANCO">CART&Atilde;O DE BANCO</option>
        <option value="RESERVISTA">RESERVISTA</option>
        <option value="CERTID&Atilde;O DE NASCIMENTO">CERTID&Atilde;O DE NASCIMENTO</option>
        <option value="CERTID&Atilde;O DE CASAMENTO">CERTID&Atilde;O DE CASAMENTO</option>
        <option value="LAUDO M&Eacute;DICO">LAUDO M&Eacute;DICO</option>
      </select></td>
    <td><input name="nome_documento" type="text" size="15" /></td>
    <td><input style="width:160px;" type="file" name="comprovante" id="fileField" /></td>
    <td><input type="submit" name="button" id="button" value="Enviar" /></td>
  </tr>
</table>
</form>
<hr />

<?
$sql_documentacao = mysqli_query($conexao_bd, "SELECT * FROM documentos_alunos WHERE aluno = '".$_GET['aluno']."'");
if(mysqli_num_rows($sql_documentacao) == ''){
	echo "<em>Ainda não foi enviado documentos desse colaborador.</em>";
}else{
?>
<table width="640" border="1">
  <tr>
    <td width="105" bgcolor="#00CC00"><strong>Tipo</strong></td>
    <td colspan="2" bgcolor="#00CC00"><strong>Nome do documento</strong></td>
  </tr>
  <? while($res = mysqli_fetch_array($sql_documentacao)){ ?>
  <tr>
    <td><? echo $res['tipo']; ?></td>
    <td width="379"><? echo strtoupper($res['documento']); ?></td>
    <td width="90">
        	<? if($res['comprovante'] != '[1]' && $res['comprovante'] != ''){ ?>
        <a target="_blank" href="../documentos_colaboradores/<? echo $res['comprovante']; ?>"><img src="../../img/baixar.png" width="20" height="20" border="0" title="Abrir comprovante" /></a>
        <? } ?>
        
    	<a href="?cpf=<? echo $_GET['cpf']; ?>&img=<? echo $res['comprovante']; ?>&p=excluir&id=<? echo $res['id']; ?>"><img src="../../img/deleta.png" width="20" height="20" border="0" title="Excluir registro de vacina" /></a
    
    ></td>
  </tr>
  <? } ?>
</table>
<? } ?>

</body>
</html>
<? if(@$_GET['p'] == 'excluir'){

$id = $_GET['id'];
$aluno = $_GET['aluno'];
$img = $_GET['img'];
$img = "../comprovante_vacinacao/$img";

mysqli_query($conexao_bd, "DELETE FROM documentos_alunos WHERE id = '$id'");
$resultado = @unlink($img);
echo "<script language='javascript'>window.location='?aluno=$aluno';</script>";

}?>