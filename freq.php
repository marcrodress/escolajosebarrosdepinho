<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?
require "conexao.php"; $turma = "807242618";

mysqli_query($conexao_bd, "UPDATE atividades SET carga_horaria = '2'");


/*
$sql = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma'");
while($res_sql = mysqli_fetch_array($sql)){
	
	$code_atividade = $res_sql['code_atividade'];

	$sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '$code_atividade' AND code_aluno = '6998424895'");
	
	
		if(mysqli_num_rows($sql_atividades_enviadas) == ''){
			mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas (data, status, arquivo, code_aluno, code_atividade, nota) VALUES ('$data', 'CORRIGIDO', '', '$code_aluno', '$code_atividade', '10')");
			
		}
}

*/










/*
$sql = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE componente = '96514' AND turma = '$turma' AND mes = '08'");
while($res_sql = mysqli_fetch_array($sql)){
	
	$code_atividade = $res_sql['code_atividade'];
	
	
	$sql_aluno = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '$turma' AND transferido != 'SIM'");
	while($res_aluno = mysqli_fetch_array($sql_aluno)){
		$code_aluno = $res_aluno['code_aluno'];

	$sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '$code_atividade' AND code_aluno = '$code_aluno'");
	
		if(mysqli_num_rows($sql_atividades_enviadas) == ''){
			
			mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas (data, status, arquivo, code_aluno, code_atividade, nota) VALUES ('$data', 'CORRIGIDO', '', '$code_aluno', '$code_atividade', '10')");
			
		}
	
	}
	
	
	
}
*/


?>
</body>
</html>