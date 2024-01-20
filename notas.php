<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?

require "conexao.php";
/*
mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET bimestre = '1' WHERE bimestre = ''");
*/

/*
$notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE componente = '96514'");
while($res_notas = mysqli_fetch_array($notas)){
	
	$id_nota = $res_notas['id'];
	$nota_at = $res_notas['at'];
	$nota_ap = $res_notas['ap'];
	$nota_ab = $res_notas['ab'];
	
	if($nota_at < 6){
		mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET at = '6' WHERE id = '$id_nota'");
	}
	
	if($nota_ap < 6){
		mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET ap = '6' WHERE id = '$id_nota'");
	}
	
	if($nota_ab < 6){
		mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET ab = '6' WHERE id = '$id_nota'");
	}
	
	
	
	
	
}
*/


$sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE transferido != 'SIM'");
 while($res_alunos = mysqli_fetch_array($sql_alunos)){
	 
	 $code_alunos = $res_alunos['code_aluno'];
	 $turma = $res_alunos['turma'];

		$sql_disciplinas = mysqli_query($conexao_bd, "SELECT * FROM disciplinas");
			 while($res_disciplinas = mysqli_fetch_array($sql_disciplinas)){
				 
				 $sql_nota = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '$code_alunos' AND componente = '".$res_disciplinas['code']."' AND bimestre = '1'");
				 if(mysqli_num_rows($sql_nota) == ''){
					 mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (turma, aluno, componente, bimestre, at, ap, ab, re) VALUES ('$turma', '$code_alunos', '".$res_disciplinas['code']."', '1', '8', '8', '8', '')");
				 }
				 
				 
				 
				 $sql_nota = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '$code_alunos' AND componente = '".$res_disciplinas['code']."' AND bimestre = '2'");
				 if(mysqli_num_rows($sql_nota) == ''){
					 mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (turma, aluno, componente, bimestre, at, ap, ab, re) VALUES ('$turma', '$code_alunos', '".$res_disciplinas['code']."', '2', '8', '8', '8', '')");
				 }
				 
				 
				 
			}
		
	 
 }





?>
</body>
</html>