
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body {
	font:12px Arial, Helvetica, sans-serif;
}
</style>
<? require "../../conexao.php"; ?>
<link href="../../bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
</head>

<body>
<em><strong>Imagens</strong></em>
<hr />
<form name="" method="post" action="" enctype="multipart/form-data">
<input name="enviar_docs" type="file" /> <input name="enviar_arvivos" type="submit" value="Enviar" />
</form>
<hr />
<? if(isset($_POST['enviar_arvivos'])){

$enviar_docs = $_FILES['enviar_docs']['name'];
$usuario = $_GET['usuario'];

if($enviar_docs == ''){
echo "<script language='javascript'>window.alert('Por favor, informe o arquivo que será enviado!');</script>";
}else{

$code_enviar_docs = rand()+rand()+45+date("d")+date("m")+date("Y");
$arquivo = $enviar_docs;
$arquivo = strrchr($arquivo, '.');

$enviar_docs = str_replace($enviar_docs, "$code_enviar_docs$arquivo", $enviar_docs);


if(file_exists("../arquivos/$enviar_docs")){ $a = 1;while(file_exists("../arquivos/[$a]$enviar_docs")){$a++;}$enviar_docs = "[".$a."]".$enviar_docs;}
(move_uploaded_file($_FILES['enviar_docs']['tmp_name'], "../arquivos/".$enviar_docs));

$sql = mysqli_query($conexao_bd, "INSERT INTO fotos (data, foto, usuario) VALUES ('$data_completa', '$enviar_docs', '$usuario')");

echo "<script language='javascript'>window.location='';</script>";
}
}?>



<?
$sql_fotos = mysqli_query($conexao_bd, "SELECT * FROM fotos WHERE usuario = '".$_GET['usuario']."' ORDER BY id DESC LIMIT 15");
while($res_fotos = mysqli_fetch_array($sql_fotos)){
?>
<img src="../arquivos/<? echo $res_fotos['foto']; ?>" class="img-fluid" alt="Imagem responsiva">
<br />
<input type="text" id="texto" style="font:12px Arial, Helvetica, sans-serif; padding:5px; width:200px;" value="http://escoleleornebelem.com/professor/arquivos/<? echo $res_fotos['foto']; ?>" readonly="readonly" />
<button style="font:12px Arial, Helvetica, sans-serif; padding:5px; width:100px;" id="botao">Copiar imagem</button>

<script language="javascript">
document.getElementById("botao").addEventListener("click", function(){

document.getElementById("texto").select();

document.execCommand('copy');

});
</script>
<br />
<? } ?>
</body>
</html>