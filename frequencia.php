<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<? require "conexao.php"; ?>

<?

$id_atividade = $_GET['id'];
if($id_atividade == ''){
	$id_atividade++;
	echo "<script language='javascript'>window.location='?id=$id_atividade';</script>";
}else{

 $sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE id = '$id_atividade' AND tipo_envio = 'multipla'");
 if(mysqli_num_rows($sql_atividade) == ''){
	 echo "NÃO ENCONTRADO! ";
	 $id_atividade++;
	 echo $id_atividade;
	 echo "<script language='javascript'>window.location='?id=$id_atividade';</script>";
 }else{
	 echo "ENCONTRADO!";
	 while($res_atividade = mysqli_fetch_array($sql_atividade)){
		 $turma = $res_atividade['turma'];
		 $atividade = $res_atividade['code_atividade'];
		 
		 $sql_turma_aluno = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '$turma'");
		  while($res_turma_aluno = mysqli_fetch_array($sql_turma_aluno)){
			  $aluno = $res_turma_aluno['aluno'];
		
			 $sql_questao_aluno = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '$atividade' AND aluno = '$aluno'");
			 if(mysqli_num_rows($sql_questao_aluno) >= 1){
			  $sql_verifica_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '$atividade' AND code_aluno = '$aluno'");
			  if(mysqli_num_rows($sql_verifica_atividade) == ''){
				  mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas (data, status, arquivo, code_aluno, code_atividade, nota, presente) VALUES ('$data', 'CORRIGIDO', '', '$aluno', '$atividade', '', 'SIM')");
			  } // if que envia a atividade
			 
			 } // if que vdrifica se o aluno enviou atividade
		} // while da turma alunos
	} // while res atividade
	 

	$id_atividade++;
	echo "<script language='javascript'>window.location='?id=$id_atividade';</script>";
	 
 }


}
?>



</body>
</html>