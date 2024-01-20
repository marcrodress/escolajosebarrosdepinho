<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body td{
	padding:5px;
	border:1px solid #000;
	border-radius:5px;
	text-transform:uppercase;
	text-align:center;
	font:12px Arial, Helvetica, sans-serif;
}
body input{
	padding:5px;
	border:1px solid #000;
	border-radius:5px;
	text-align:center;
	font:12px Arial, Helvetica, sans-serif;
}
body select{
	padding:5px;
	border:1px solid #000;
	text-align:center;
	border-radius:5px;
	font:12px Arial, Helvetica, sans-serif;
}
</style>
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<a style="background:#090; color:#FFF; padding:10px; text-decoration:none; font:12px Arial, Helvetica, sans-serif;" href="?acao=cadastra&aluno=<? echo $aluno = $_GET['aluno']; ?>">Justificar</a>
<br /><br />
<? require "../../conexao.php"; $aluno = $_GET['aluno']; ?>




<? if($_GET['acao'] == 'cadastra'){ ?>

<?  if(isset($_POST['button'])){

$tipo = $_POST['tipo'];
$descricao = $_POST['descricao'];
$inicio = $_POST['inicio'];
$fim = $_POST['fim'];
$comprovante = $_FILES['comprovante']['name'];


$code_enviar_docs = rand()+rand()+45+date("d")+date("m")+date("Y");		
$arquivo = $comprovante;
$arquivo = strrchr($arquivo, '.');
$comprovante = str_replace($comprovante, "$code_enviar_docs$arquivo", $comprovante);


if(file_exists("../documentos_colaboradores/$comprovante")){ $a = 1;while(file_exists("../documentos_colaboradores/[$a]$comprovante")){$a++;}$comprovante = "[".$a."]".$comprovante;}


$sql_code_inicio = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$inicio'");
while($res_code_inicio = mysqli_fetch_array($sql_code_inicio)){
	$inicio = $res_code_inicio['codigo'];
}

$sql_code_fim = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$fim'");
while($res_code_fim = mysqli_fetch_array($sql_code_fim)){
	$fim = $res_code_fim['codigo'];
}

$code_atestado = rand();


mysqli_query($conexao_bd, "INSERT INTO atestado_medico (code, operador, status, aluno, tipo, descricao, inicio, fim, anexo) VALUES ('$code_atestado', '".$_GET['operador']."', 'Ativo', '$aluno', '$tipo', '$descricao', '$inicio', '$fim', '$comprovante')");



for($i=$inicio; $i<= $fim; $i++){
	$inicio++;
	mysqli_query($conexao_bd, "INSERT INTO atestado_dias (code_atestado, code_dia, aluno) VALUES ('$code_atestado', '$inicio', '$aluno')");
}



(move_uploaded_file($_FILES['comprovante']['tmp_name'], "../documentos_colaboradores/".$comprovante));

echo "<script language='javascript'>window.location='';</script>";

}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="500" border="0">
  <tr>
    <td width="57" bgcolor="#88D9FF"><strong>Motivo</strong></td>
    <td width="58" bgcolor="#88D9FF"><strong>Descrição</strong></td>
    <td width="215" bgcolor="#88D9FF"><strong>Inicio</strong></td>
    <td width="106" bgcolor="#88D9FF"><strong>Fim</strong></td>
    <td colspan="2" bgcolor="#88D9FF"><strong>Anexo</strong></td>
  </tr>
  <tr>
    <td><label for="select"></label>
      <select name="tipo" size="1" id="select">
        <option value="Afastamento médico">Afastamento médico</option>
        <option value="Felecimento">Felecimento</option>
        <option value="Outros">Outros</option>
    </select></td>
    <td><label for="descricao"></label>
    <input type="text" name="descricao" id="descricao"></td>
    <td><label for="inicio"></label>
      <span id="sprytextfield1">
      <input name="inicio" type="text" id="inicio" size="10" />
    <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    <td><label for="fim"></label>
      <span id="sprytextfield2">
      <input name="fim" type="text" id="fim" size="10" />
      </span></td>
    <td width="16"><label for="fileField"></label>
    <input name="comprovante" style="width:120px;" type="file" id="fileField" size="10"></td>
    <td width="16"><input type="submit" name="button" id="button" value="Enviar"></td>
  </tr>
</table>
</form>
<hr />
<? } ?>

<?

$sql_atestado = mysqli_query($conexao_bd, "SELECT * FROM atestado_medico WHERE aluno = '".$_GET['aluno']."'");
if(mysqli_num_rows($sql_atestado) == ''){
	echo "Aluno não possui falta justificada ativa.";
}else{
?>
<table width="725" border="0">
  <tr>
    <td width="150" bgcolor="#FFFF00"><strong>Motivo</strong></td>
    <td width="250" bgcolor="#FFFF00"><strong>Descrição</strong></td>
    <td width="80" bgcolor="#FFFF00"><strong>Inicio</strong></td>
    <td width="80" bgcolor="#FFFF00"><strong>Fim</strong></td>
    <td colspan="2" bgcolor="#FFFF00"><strong>Anexo</strong></td>
  </tr>
  <? while($res_atestad = mysqli_fetch_array($sql_atestado)){ ?>
  <tr>
    <td><? echo $res_atestad['tipo']; ?></td>
    <td><? echo $res_atestad['descricao']; ?></td>
    <td><? 
	
	$sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '".$res_atestad['inicio']."'");
	 while($res_code_vencimento = mysqli_fetch_array($sql_code_vencimento)){
		echo $res_code_vencimento['vencimento'];
	}
		
	?></td>
    <td><? 
	
	$sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '".$res_atestad['fim']."'");
	 while($res_code_vencimento = mysqli_fetch_array($sql_code_vencimento)){
		echo $res_code_vencimento['vencimento'];
	}	
	?></td>
    <td width="40"><a href="../documentos_colaboradores/<? echo $res_atestad['anexo']; ?>" target="_blank"><img src="../../img/baixar.png" width="29" height="25" border="0" /></a></td>
    <td width="30"><a href="?acao=deleta&code_atestado=<? echo $res_atestad['code']; ?>"><img src="../../img/deleta.png" width="20" height="20" /></a></td>
  </tr>
  <? } ?>
</table>
<? } ?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {format:"dd/mm/yyyy", useCharacterMasking:true});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "date", {format:"dd/mm/yyyy", useCharacterMasking:true});
</script>
</body>
</html>
<? if($_GET['acao'] == 'deleta'){
	
	mysqli_query($conexao_bd, "DELETE FROM atestado_medico WHERE code = '".$_GET['code_atestado']."'");
	mysqli_query($conexao_bd, "DELETE FROM atestado_dias WHERE code_atestado = '".$_GET['code_atestado']."'");

echo "<script language='javascript'>window.location='?acao=&aluno=$aluno';</script>";

}?>