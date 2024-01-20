<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../jquery.superbox.css" type="text/css" media="all" />
<script type="text/javascript" src="
http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript" src="../jquery.superbox-min.js"></script>
<script type="text/javascript">

	$(function(){

		$.superbox.settings = {
		closeTxt: "Fechar",
		loadTxt: "Coletando informações. Por favor, aguarde...",
		overlayOpacity: .5, // Background opaqueness
		boxWidth: "800", // Default width of the box
		boxHeight: "600", // Default height of the box

			};

			$.superbox();

		});

</script>
</head>

<body>
<strong><? $questao = $_GET['atual']; ?></strong>
<? 

if($questao > $_GET['total']){
	
	echo "
	 
	 <strong>Questões cadastradas com sucesso.</strong><br>
	 <br>
	 <em>Pressione F5.</em>
	<br><br>
	
	
	";
	
	die;
	
}else{

$sql = mysqli_query($conexao_bd, "SELECT * FROM atividades_varios WHERE code_atividade = '".$_GET['code_atividade']."' AND questao = '$questao'");
if(mysqli_num_rows($sql) == ''){
 mysqli_query($conexao_bd, "INSERT INTO atividades_varios (code_atividade, questao, tipo_resposta, texto, opcao1, opcao2, opcao3, opcao4, opcao_correta) VALUES ('".$_GET['code_atividade']."', '$questao', 'Text', '', '', '', '', '', '')");
 }
}
$usuario = 0;
$sql_usuario = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE code_atividade = '".$_GET['code_atividade']."'");
while($res_usuario = mysqli_fetch_array($sql_usuario)){
	$usuario = $res_usuario['usuario'];
}
?>

<strong>Questão <? echo $questao = $_GET['atual']; ?></strong>



<a rel="superbox[iframe][500x600]" style="padding:8px; background:#093; text-decoration:none; border:1px solid #000; color:#FFF;" href="fotos.php?usuario=<? echo $usuario; ?>">Imagens</a>
<hr />
<form name="" method="post" enctype="multipart/form-data">
<textarea name="anunciado" cols="75" rows="12"><? echo $res['questao']; ?></textarea>
<input style="padding:8px; background:#039; text-decoration:none; border:1px solid #000; color:#FFF;" type="submit" name="enviar" value="Avançar" />
</form>


<? if(isset($_POST['enviar'])){

$anunciado = $_POST['anunciado'];

$sql_1 = mysqli_query($conexao_bd, "UPDATE atividades_varios SET texto = '$anunciado' WHERE code_atividade = '".$_GET['code_atividade']."' AND questao = '$questao'");

$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM atividades_varios WHERE code_atividade = '".$_GET['code_atividade']."' AND questao = '$questao'");
$tipo_envios = 0;
while($res_verifica = mysqli_fetch_array($sql_verifica)){
	$tipo_envios = $res_verifica['tipo_resposta'];
}


$p = $_GET['p'];
$turma = $_GET['turma'];
$documento = $_GET['documento'];
$tipo_envio = $_GET['tipo_envio'];
$code_atividade = $_GET['code_atividade'];
$total = $_GET['total'];
$atual = $_GET['atual'];


echo "<script language='javascript'>window.location='?p=6&turma=$turma&documento=$documento&tipo_envio=$tipo_envios&code_atividade=$code_atividade&total=$total&atual=$atual&type=$tipo_envios';</script>";

}?>

<hr />


</body>
</html>