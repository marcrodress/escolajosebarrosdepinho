<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "conexao.php"; ?>
</head>

<body>
<?
$sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades");
while($res_atividades = mysqli_fetch_array($sql_atividades)){
	$dia_d = $res_atividades['dia'];
	$mes_d = $res_atividades['mes'];
	$ano_d = $res_atividades['ano'];
	
	$dia_atividade = "$dia_d/$mes_d/$ano_d";
	
$sql_code_atividade = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$dia_atividade'");
while($res_code_atividade = mysqli_fetch_array($sql_code_atividade)){
	$code_dia_atividade = $res_code_atividade['codigo'];
}

mysqli_query($conexao_bd, "UPDATE atividades SET code_dia_atividade = '$code_dia_atividade' WHERE id = '".$res_atividades['id']."'");
	
}


?>
</body>
</html>