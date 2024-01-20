<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?
	
$sql_aluno = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '$turma' AND transferido != 'SIM'");
while($res_aluno = mysqli_fetch_array($sql_aluno)){
	$aluno = $res_aluno['aluno'];

$sql_atividade_enviada = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '$aluno' AND code_atividade = '$atividade'");
	if(mysqli_num_rows($sql_atividade_enviada) == ''){ echo "ok";
		mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas (data, status, arquivo, code_aluno, code_atividade, nota, presente) VALUES ('$data', 'CORRIGIDO', '', '$aluno', '$atividade', '10', 'SIM')");
	}

}

?>
</body>
</html>