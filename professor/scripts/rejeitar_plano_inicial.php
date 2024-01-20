<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script src="../../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? if(isset($_POST['enviar'])){

require "../../conexao.php";

$motivo = $_POST['motivo'];

$sql_motivo = mysqli_query($conexao_bd, "UPDATE plano_de_aula_iniciais SET status_coordenacao = 'CORRECAO', observacao_coodenacao = '$motivo' WHERE id = '".$_GET['id']."'");

echo "

<strong>Operação realizada com sucesso!!!</strong>
<br><br>

<em>Pressione F5 para finalizar.</em>


";
die;

}?>
<form action="" method="post" enctype="multipart/form-data">
  <span id="sprytextarea1">
  <label for="textarea1"></label>
  <h5 style="font:12px Arial, Helvetica, sans-serif;"><strong>Descreva o motivo da recusa</strong></h5>
  <textarea style="border:1px solid #666; padding:10px; border-radius:5px;" name="motivo" cols="45" rows="5"></textarea>
  <span class="textareaRequiredMsg"></span></span><br /><p></p>
  <input style="border:1px solid #036; border-radius:3px; padding:10px;" name="enviar" type="submit" value="Enviar" />
</form>
<script type="text/javascript">
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
</script>
</body>
</html>