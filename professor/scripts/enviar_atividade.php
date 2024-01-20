<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<? require "../../conexao.php"; $atividade = @$_GET['atividade']; $aluno = @$_GET['aluno']; ?>
</head>

<body>
<? if(isset($_POST['enviar'])){

$enviar_docs = $_FILES['enviar_docs']['name'];
$enviar_docs = str_replace(" ", "-", $enviar_docs); $enviar_docs = str_replace(",", "-", $enviar_docs); $enviar_docs = str_replace("ã", "a", $enviar_docs);
if(file_exists("../arquivos/$enviar_docs")){ $a = 1;while(file_exists("../arquivos/[$a]$enviar_docs")){$a++;}$enviar_docs = "[".$a."]".$enviar_docs;}


if($enviar_docs == ''){
echo "<script language='javascript'>window.alert('Por favor, informe o arquivo que será enviado!');</script>";
}else{

$sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '$atividade' AND code_aluno = '$aluno'");
if(mysqli_num_rows($sql_atividade) == ''){
mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas (data, status, arquivo, code_aluno, code_atividade, nota) VALUES ('$data', 'CORRIGIDO', '$enviar_docs', '$aluno', '$atividade', '10')");
}else{
mysqli_query($conexao_bd, "UPDATE atividades_enviadas SET arquivo = '$enviar_docs' WHERE code_atividade = '$atividade' AND code_aluno = '$aluno'");
}


(move_uploaded_file($_FILES['enviar_docs']['tmp_name'], "../arquivos/".$enviar_docs));
echo "<strong>Arquivo enviado com sucesso!</strong><br><br><em>Pressione F5 para finalizar</em>";
die;
}
}?>
<strong style="font:15px Arial, Helvetica, sans-serif;"><strong>Enexar atividade do aluno</strong></strong>
<br />
<form name="" method="post" action="" enctype="multipart/form-data">
<input name="enviar_docs" type="file" />
<br /><br />
<input name="enviar" class="btn btn-primary" type="submit" value="Enviar" />
</form>
</body>
</html>