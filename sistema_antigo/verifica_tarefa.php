<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?
require "conexao.php";

$total_atividades = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM atividades"))+200;
$id = $_GET['id'];
if($id == ''){
$id = 1;
}else{
$id = $id;
}


if($id > $total_atividades){
		echo "<script language='javascript'>window.location='verifica_tarefa2.php?id=$id';</script>";
}else{
	
	$sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE id = '$id' AND code_entrega = '$code_hoje'");
	if(mysqli_num_rows($sql_atividade) == ''){ $id++;
		echo "<script language='javascript'>window.location='?id=$id';</script>";
	}else{
		$code_atividade = 0;
		$turma_atividade = 0;
		$professor = 0;
		$dia_atividade = 0;
		$mes_atividade = 0;
		$ano_atividade = 0;
		while($res_atividade = mysqli_fetch_array($sql_atividade)){
			$code_atividade = $res_atividade['code_atividade'];
			$turma_atividade = $res_atividade['turma'];
			$professor = $res_atividade['usuario'];
			$dia_atividade = $res_atividade['dia'];
			$mes_atividade = $res_atividade['mes'];
			$ano_atividade = $res_atividade['ano'];
		} // while que pega os dados da atividade
		
	 $data_atividade = "$dia_atividade/$mes_atividade/$ano_atividade";
	
	  $componente = 0;
	  $sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas_turmas WHERE turma = '$turma_atividade'");
	   while($res_componente = mysqli_fetch_array($sql_componente)){
		   
		   $sql_disciplina = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_componente['disciplina']."'");
		    while($res_disciplina = mysqli_fetch_array($sql_disciplina)){
			  $componente = $res_componente['componente'];
			}
	  }
		
	
	  $sql_professor = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$professor'");
	   while($res_professor = mysqli_fetch_array($sql_professor)){
		  $professor = $res_professor['nome_escola'];
	  }
	 
		$primeiroNome = explode(" ", $professor);
		$nome_professor = current($primeiroNome);
		
	
		$nome_aluno = 0;
		$sql_alunos_turma = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '$turma_atividade' AND telefone != '' AND impresso != 'SIM' AND especial != 'SIM'");
		 while($res_alunos = mysqli_fetch_array($sql_alunos_turma)){
	
	 	 $code_aluno = 0;
			 $telefone = 0;
			 $code_aluno = $res_alunos['code_aluno'];
			 $nome_aluno = $res_alunos['nome_aluno'];
			 $telefone = $res_alunos['telefone'];
			 
			 $telefone = str_replace(" ", "", $telefone); 
			 $telefone = str_replace(".", "", $telefone);
			 $telefone = str_replace("(", "", $telefone); 
			 $telefone = str_replace(")", "", $telefone);
			 
			  		$primeironomealuno = explode(" ", $nome_aluno);
					$nome_aluno = current($primeironomealuno);
			
				$sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '$code_aluno' AND code_atividade = '$code_atividade'");
				$verifica = 1;

				if(mysqli_num_rows($sql_atividades_enviadas) == ''){
					$verifica = 0;
				}else{
					while($res_atividades_enviadas = mysqli_fetch_array($sql_atividades_enviadas)){
						
						$data_envio = $res_atividades_enviadas['data'];
						if($data_envio == ''){
							$verifica = 0;
						}
						
					}
				}
				
				
				
				if($verifica == 0){
					$sql_sms = mysqli_query($conexao_bd, "SELECT * FROM sms_enviados WHERE data = '$data' AND aluno = '$code_aluno' AND atividade = '$code_atividade'");
					if(mysqli_num_rows($sql_sms) == 0 && mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM sms_enviados WHERE aluno = '$code_aluno' AND atividade = '$code_atividade'")) <= 1){

						mysqli_query($conexao_bd, "INSERT INTO sms_enviados (status, data, aluno, atividade, mensagem, telefone) VALUES ('AGUARDA', '$data', '$code_aluno', '$code_atividade', 'Olá $nome_aluno, aqui é o Prof°. $nome_professor, notei que você ainda não enviou a atividade de $componente do dia $data_atividade', '$telefone')");

						
					} // if que verifica se há possíbilidade de enviar um SMS
					
						
				} // if que verifica se o aluno enviou a atividade
	
		 } // while que verifica se existe aluno com número de telefone
		
		
	$id++;
	echo "<script language='javascript'>window.location='?id=$id';</script>";
		
	} // verifica se tem atividade para ser enviada hoje
	
}// if que verifica se o ID é maior que o número de atividades
?>
</body>
</html>