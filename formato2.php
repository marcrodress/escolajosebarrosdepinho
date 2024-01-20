<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "conexao.php"; ?>
</head>

<body>
<?
$sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas");
while($res_atividades = mysqli_fetch_array($sql_atividades)){
	$data_atividade = $res_atividades['data'];
	$status = $res_atividades['status'];
	$nota = $res_atividades['nota'];
	$code_aluno = $res_atividades['code_aluno'];
	$code_atividade = $res_atividades['code_atividade'];
	
if($nota > 0 && $data_atividade == '' && $status == 'CORRIGIDO'){
mysqli_query($conexao_bd, "UPDATE atividades_enviadas SET data = '$data' WHERE id = '".$res_atividades['id']."'");
}


}
?>
</body>
</html>