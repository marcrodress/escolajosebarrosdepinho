<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body table{
	text-align:center;
	font:12px Arial, Helvetica, sans-serifr;
}
body,td,th {
	color: #333;
	border-radius:2px;
	border:1px solid #CCC;
}
body input{
	color: #333;
	border:1px solid #000;
	padding:5px;
	border-radius:2px;
}
body select{
	color: #333;
	border:1px solid #000;
	padding:5px;
	border-radius:2px;
}
</style>
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "../../conexao.php"; $aluno = $_GET['aluno'];?>


<? if(isset($_POST['enviar'])){
	
$vacina = $_POST['vacina'];
$dose = $_POST['dose'];
$data_aplicacao = $_POST['data'];
$lote = $_POST['lote'];
$cod = $_POST['cod'];
$nome_aplicador = $_POST['nome_aplicador'];
$local_aplicacao = $_POST['local_aplicacao'];
$reg = $_POST['reg'];
$aluno = $_GET['aluno'];
$nome_vacina = $_POST['nome_vacina'];
$fabricante = $_POST['fabricante'];

$comprovante = $_FILES['comprovante']['name'];
$code_enviar_docs = rand()+rand()+45+date("d")+date("m")+date("Y");		
		
$arquivo = $comprovante;
$arquivo = strrchr($arquivo, '.');

$comprovante = str_replace($comprovante, "$code_enviar_docs$arquivo", $comprovante);


if(file_exists("../comprovante_vacinacao/$comprovante")){ $a = 1;while(file_exists("../comprovante_vacinacao/[$a]$comprovante")){$a++;}$comprovante = "[".$a."]".$comprovante;}
		
(move_uploaded_file($_FILES['comprovante']['tmp_name'], "../comprovante_vacinacao/".$comprovante));

mysqli_query($conexao_bd, "INSERT INTO vacinacao_alunos (aluno, tipo_vacina, data_aplicacao, lote, cod, nome_aplicador, local_aplicacao, regional_prof, n_dose, comprovante, nome_vacina, fabricante) VALUES ('$aluno', '$vacina', '$data_aplicacao', '$lote', '$cod', '$nome_aplicador', '$local_aplicacao', '$reg', '$dose', '$comprovante', '$nome_vacina', '$fabricante')");

echo "<script language='javascript'>window.location='';</script>";

}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="800" border="0">
  <tr>
    <td bgcolor="#CCCCCC"><strong>Vacina</strong></td>
    <td bgcolor="#CCCCCC"><strong>NOME</strong></td>
    <td bgcolor="#CCCCCC"><strong>FABRICANTE</strong></td>
    <td bgcolor="#CCCCCC"><strong>N&deg; Dose</strong></td>
    <td bgcolor="#CCCCCC"><strong>Data de aplica&ccedil;&atilde;o</strong></td>
    <td bgcolor="#CCCCCC"><strong>Lote</strong></td>
    <td bgcolor="#CCCCCC"><strong>Cod.</strong></td>
    <td bgcolor="#CCCCCC"><strong>Nome do aplicador</strong></td>
    <td bgcolor="#CCCCCC"><strong>Local de aplica&ccedil;&atilde;o</strong></td>
    <td bgcolor="#CCCCCC"><strong>Reg. Prof:</strong></td>
    </tr>
  <tr>
    <td><label for="vacina"></label>
      <select name="vacina" size="1" id="vacina">
        <option value="COVID-19">COVID-19</option>
        <option value="OUTROS">OUTROS</option>
      </select></td>
    <td><input name="nome_vacina" type="text" size="10" /></td>
    <td><input name="fabricante" type="text" id="fabricante" size="10" /></td>
    <td>
      <select name="dose" size="1" id="dose">
        <option value="&Uacute;NICA">&Uacute;NICA</option>
        <option value="1&deg; DOSE">1&deg; DOSE</option>
        <option value="2&deg; DOSE">2&deg; DOSE</option>
        <option value="3&deg; DOSE">3&deg; DOSE</option>
        <option value="4&deg; DOSE">4&deg; DOSE</option>
        <option value="5&deg; DOSE">5&deg; DOSE</option>
        </select>
    </td>
    <td><span id="sprytextfield1">
    <input name="data" type="text" id="data" size="7" />
    <span class="textfieldRequiredMsg"></span></span></td>
    <td><input name="lote" type="text" id="lote" size="5" /></td>
    <td><input name="cod" type="text" id="cod" size="5" /></td>
    <td><input name="nome_aplicador" type="text" id="nome_aplicador" size="8" /></td>
    <td><input name="local_aplicacao" type="text" id="local_aplicacao" size="8" /></td>
    <td><input name="reg" type="text" id="reg" size="5" /></td>
    </tr>
  <tr>
    <td height="38" colspan="6" align="right" bgcolor="#CCCCCC"><strong>Anexar comprovante de vacina&ccedil;&atilde;o</strong>      <label for="anexo"></label></td>
    <td colspan="3"><input type="file" name="comprovante" id="anexo" /></td>
    <td><input type="submit" name="enviar" id="button" value="Enviar" /></td>
    </tr>
</table>
</form>


<hr />
<?
$sql = mysqli_query($conexao_bd, "SELECT * FROM vacinacao_alunos WHERE aluno = '".$_GET['aluno']."'");
if(mysqli_num_rows($sql) == ''){
	echo "<em>Ainda não foi registrado vacinas desse colaborador.</em>";
}else{
?>
<table width="800" border="1">
  <tr>
    <td bgcolor="#00CCCC"><strong>Vacina</strong></td>
    <td bgcolor="#00CCCC"><strong>FABRICANTE</strong></td>
    <td bgcolor="#00CCCC"><strong>N&deg; Dose</strong></td>
    <td bgcolor="#00CCCC"><strong>Data de aplica&ccedil;&atilde;o</strong></td>
    <td bgcolor="#00CCCC"><strong>Lote</strong></td>
    <td bgcolor="#00CCCC"><strong>Cod.</strong></td>
    <td bgcolor="#00CCCC"><strong>Nome do aplicador</strong></td>
    <td bgcolor="#00CCCC"><strong>Local de aplica&ccedil;&atilde;o</strong></td>
    <td bgcolor="#00CCCC"><strong>Reg. Prof:</strong></td>
    <td bgcolor="#00CCCC">&nbsp;</td>
  </tr>
  <? while($res = mysqli_fetch_array($sql)){ ?>
  <tr>
    <td><? echo $res['tipo_vacina']; ?></td>
    <td><? echo $res['fabricante']; ?></td>
    <td><? echo $res['n_dose']; ?></td>
    <td><? echo $res['data_aplicacao']; ?></td>
    <td><? echo $res['lote']; ?></td>
    <td><? echo $res['cod']; ?></td>
    <td><? echo $res['nome_aplicador']; ?></td>
    <td><? echo $res['local_aplicacao']; ?></td>
    <td><? echo $res['regional_prof']; ?></td>
    <td>
    	<? if($res['comprovante'] != '[1]' && $res['comprovante'] != ''){ ?>
        <a target="_blank" href="../comprovante_vacinacao/<? echo $res['comprovante']; ?>"><img src="../../img/baixar.png" width="20" height="20" border="0" title="Abrir comprovante" /></a>
        <? } ?>
        
    	<a href="?aluno=<? echo $_GET['aluno']; ?>&img=<? echo $res['comprovante']; ?>&p=ALUNO&id=<? echo $res['id']; ?>"><img src="../../img/deleta.png" width="20" height="20" border="0" title="Excluir registro de vacina" /></a>
    </td>
  </tr>
  <? } ?>
</table>
<? } ?>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {useCharacterMasking:true, format:"dd/mm/yyyy"});
</script>
</body>
</html>
<? if(@$_GET['p'] == 'excluir'){

$id = $_GET['id'];
$aluno = $_GET['aluno'];
$img = $_GET['img'];
$img = "../comprovante_vacinacao/$img";

mysqli_query($conexao_bd, "DELETE FROM vacinacao_alunos WHERE id = '$id'");
$resultado = @unlink($img);
echo "<script language='javascript'>window.location='?aluno=$aluno';</script>";

}?>