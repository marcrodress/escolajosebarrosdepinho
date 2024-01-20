<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "conexao.php"; ?>
</head>

<body>
<img src="https://c.tenor.com/I6kN-6X7nhAAAAAj/loading-buffering.gif" width="30" height="30" />
<?
$total_atividades = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM atividades"));

$total_atividades = $total_atividades+200;

$id_atividade = $_GET['id_atividade']++;

if($id_atividade >$total_atividades){
	echo "<script language='javascript'>location='professor';</script>";
}else{

$sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE id = '$id_atividade'");
if(mysqli_num_rows($sql_atividades) == ''){ 
	$id_atividade++;
	echo "<script language='javascript'>location='?id_atividade=$id_atividade';</script>";

}else{

  while($res_atividades = mysqli_fetch_array($sql_atividades)){
	  $code_atividade = $res_atividades['code_atividade'];
	  $turma = $res_atividades['turma'];
	  $professor = $res_atividades['usuario'];
	  $componente = $res_atividades['componente'];
	  
	  
	  $sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '$turma' AND especial != 'SIM' OR impresso != 'SIM' OR transferido != 'SIM'"); 
	   while($res_alunos = mysqli_fetch_array($sql_alunos)){ 	

		   
		   $sql_verifica_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '".$res_alunos['code_aluno']."' AND code_atividade = '$code_atividade'");
		   if(mysqli_num_rows($sql_verifica_atividade) == ''){
			 $sql_verifica_pendencia = mysqli_query($conexao_bd, "SELECT * FROM pendencia_professores WHERE code_aluno = '' AND code_atividade = ''");
			  if(mysqli_num_rows($sql_verifica_pendencia) == ''){
			   mysqli_query($conexao_bd, "INSERT INTO pendencia_professores (data, code_aluno, code_atividade, vizualicacao, ip, status, turma, componente, professor) VALUES ('$data', '".$res_alunos['code_aluno']."', '$code_atividade', '', '', 'AGUARDA', '$turma', '$componente', '$professor')");
			   
			   $code_aluno = $res_alunos['code_aluno'];
			   $descricao_pendencia = "BUSCA ATIVA DA ATIVIDADE $code_atividade ALUNO $code_aluno";
			   mysqli_query($conexao_bd, "INSERT INTO score (professor, tipo, pontuacao, descricao, data) VALUES ('$professor', 'DEBITO', '2', '$descricao_pendencia', '$data')");
			  } // if mysqli_num_rows($sql_verifica_pendencia)
			   
		   }else{
			   
			   while($res_verifica_atividade = mysqli_fetch_array($sql_verifica_atividade)){
				   $data_atividade = $res_verifica_atividade['data'];
				   
				   if($data_atividade == ''){
					 $sql_verifica_pendencia = mysqli_query($conexao_bd, "SELECT * FROM pendencia_professores WHERE code_aluno = '' AND code_atividade = ''");
					  if(mysqli_num_rows($sql_verifica_pendencia) == ''){
					   mysqli_query($conexao_bd, "INSERT INTO pendencia_professores (data, code_aluno, code_atividade, vizualicacao, ip, status, turma, componente, professor) VALUES ('$data', '".$res_alunos['code_aluno']."', '$code_atividade', '', '', 'AGUARDA', '$turma', '$componente', '$professor')");
								   $code_aluno = $res_alunos['code_aluno'];
								   $descricao_pendencia = "BUSCA ATIVA DA ATIVIDADE $code_atividade ALUNO $code_aluno";
			   					   mysqli_query($conexao_bd, "INSERT INTO score (professor, tipo, pontuacao, descricao, data) VALUES ('$professor', 'DEBITO', '2', '$descricao_pendencia', '$data')");
					  } // if mysqli_num_rows($sql_verifica_pendencia)					   
					   
					   
				   } // if($data_atividade
				   
			  } // while($res_verifica_atividade
			   
		   } // if(mysqli_num_rows($sql_verifica_atividade)
		   
		   

			$id_atividade++;
			echo "<script language='javascript'>location='?id_atividade=$id_atividade';</script>";   
		   
	  } // sql_alunos
   
   } // sql_atividades
 
  }//if(mysqli_num_rows($sql_atividades) == ''){ 
 } // if($id_atividade >$total_atividades){
 
?>
</body>
</html>