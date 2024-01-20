<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body,td,th {
	color: #000;
	font:12px Arial, Helvetica, sans-serif;
}
body input{
	font:12px Arial, Helvetica, sans-serif;
	border:1px solid #999;
	padding:5px;
}
</style>
</head>

<body>
<? if(isset($_POST['enviar'])){

require "../../conexao.php";

$data_c = $_POST['data'];
$hora_c = $_POST['hora'];
$forma_contato = $_POST['forma_contato'];
$atividade = $_GET['atividade'];
$aluno = $_GET['aluno'];
$operador = $_GET['operador'];
$feedback = $_POST['feedback'];

$enviar_docs = $_FILES['enviar_docs']['name'];
$code_enviar_docs = rand()+rand()+45+date("d")+date("m")+date("Y");

$arquivo = $enviar_docs;
$arquivo = strrchr($enviar_docs, '.');
$enviar_docs = str_replace($enviar_docs, "$code_enviar_docs$arquivo", $enviar_docs);

$enviar_docs = str_replace(" ", "-", $enviar_docs); $enviar_docs = str_replace(",", "-", $enviar_docs); $enviar_docs = str_replace("ã", "a", $enviar_docs);
if(file_exists("../arquivos/$enviar_docs")){ $a = 1;while(file_exists("../arquivos/[$a]$enviar_docs")){$a++;}$enviar_docs = "[".$a."]".$enviar_docs;}



mysqli_query($conexao_bd, "INSERT INTO busca_ativa_coodenacao (ip, data, tipo, atividade, aluno, professor, data_hora, forma_contato, anexos, feedback) VALUES ('$ip', '$data_completa', 'ATIVIDADE', '$atividade', '$aluno', '$operador', '$data_c $hora_c', '$forma_contato', '$enviar_docs', '$feedback')");

(move_uploaded_file($_FILES['enviar_docs']['tmp_name'], "../arquivos/".$enviar_docs));

echo "<script language='javascript'>window.alert('Busca ativa registrada com sucesso!');</script>";

}?>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="200" border="0">
    <tr>
      <td width="151"><strong>Data</strong></td>
      <td width="130"><strong>Hora</strong></td>
    </tr>
    <tr>
      <td><label for="textfield2"></label>
        <span id="sprytextfield1">
        <input type="text" name="data" id="textfield2" value="<? echo date("d/m/Y"); ?>" />
      <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span></span></td>
      <td><label for="hora"></label>
        <span id="sprytextfield2">
        <input style="width:160px;" type="text" name="hora" id="hora" value="<? echo date("H:i"); ?>" />
      <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span></span></td>
    </tr>
    <tr>
      <td colspan="2"><strong>Forma de conta</strong></td>
    </tr>
    <tr>
      <td colspan="2"><label for="hora"></label>
        <label for="forma_contato"></label>
        <select style="font:12px Arial, Helvetica, sans-serif; padding:5px; width:335px;" name="forma_contato" size="1" id="forma_contato">
          <option value="WhatsApp - Mensagem de texto">WhatsApp - Mensagem de texto</option>
          <option value="WhatsApp - Liga&ccedil;&atilde;o">WhatsApp - Liga&ccedil;&atilde;o</option>
          <option value="Liga&ccedil;&atilde;o">Liga&ccedil;&atilde;o</option>
          <option value="Mensagem de texto">Mensagem de texto</option>
          <option value="Visita em casa">Visita em casa</option>
          <option value="Outros">Outros</option>
      </select></td>
    </tr>
    <tr>
      <td colspan="2"><strong>Anexos</strong></td>
    </tr>
    <tr>
      <td colspan="2"><label for="anexo"></label>
      <input style="width:325px;" type="file" name="enviar_docs"/></td>
    </tr>
    <tr>
      <td colspan="2"><strong>Feedback</strong></td>
    </tr>
    <tr>
      <td colspan="2"><label for="feedback"></label>
      <textarea style="font:12px Arial, Helvetica, sans-serif; padding:24px;" name="feedback" id="feedback" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" name="enviar" id="button" value="Enviar" /></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {format:"dd/mm/yyyy", useCharacterMasking:true});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "time", {useCharacterMasking:true});
</script>
</body>
</html>
