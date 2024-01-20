<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?
			$sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND componente = '$componente' AND periodo = '$bimestre' AND tipo_atividade = 'Atividade'");
			$conta_atividade = mysqli_num_rows($sql_atividades);
			$soma_atividade_realizadas = 0;
			
			 while($res_atividades = mysqli_fetch_array($sql_atividades)){
				 if($res_atividades['tipo_envio'] == 'arquivo'){
				  $sql_verifica_fez = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND code_aluno = '$aluno' AND data != ''");
					if(mysqli_num_rows($sql_verifica_fez) >= 1){
						$soma_atividade_realizadas++;
					}

				 }elseif($res_atividades['tipo_envio'] == 'multipla'){
					$sql_verifica_fez = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividades['code_atividade']."' AND aluno = '$aluno' LIMIT 1");
					if(mysqli_num_rows($sql_verifica_fez) >= 1){
						$soma_atividade_realizadas++;
					}

				 }elseif($res_atividades['tipo_envio'] == 'varios'){
					 
				 }
				 
				 					
					$media = number_format($soma_atividade_realizadas*10/$conta_atividade);
					

					  $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '$aluno' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma'");
					  if(mysqli_num_rows($sql_notas_bimestrais) == ''){
					  	mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (turma, aluno, componente, bimestre, at, ap, ab, re) VALUES ('$turma', '$aluno', '$componente', '$bimestre', '$media', '0', '0', '')");
					  }else{
						mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET at = '$media' WHERE aluno = '$aluno' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma'");
					  }
				 
				 
			}
			
			
			
			
			
			
			
			$sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND componente = '$componente' AND periodo = '$bimestre' AND tipo_atividade = 'Avaliação Parcial'");
			
			 while($res_atividades = mysqli_fetch_array($sql_atividades)){
				 if($res_atividades['tipo_envio'] == 'arquivo'){
				 
				  $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND code_aluno = '$aluno' LIMIT 1");
				  
				 	 while($res_atividades_enviadas = mysqli_fetch_array($sql_atividades_enviadas)){
					  
					  $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '$aluno' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma'");
					  if(mysqli_num_rows($sql_notas_bimestrais) == ''){
					  	mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (turma, aluno, componente, bimestre, at, ap, ab, re) VALUES ('$turma', '$aluno', '$componente', '$bimestre', '0', '".$res_atividades_enviadas['nota']."', '0', '')");
					  }else{
						mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET ap = '".$res_atividades_enviadas['nota']."' WHERE aluno = '$aluno' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma'");
					  }
					  
					  
					  
				  }
				  
					 
					 
				 }elseif($res_atividades['tipo_envio'] == 'multipla'){
					$media = 0;
					$conta_questao = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividades['code_atividade']."'"));
					$conta_questao_certa = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividades['code_atividade']."' AND aluno = '$aluno' AND correto = 'SIM'"));
					
					$media = number_format($conta_questao_certa*10/$conta_questao);

					  $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '$aluno' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma'");
					  if(mysqli_num_rows($sql_notas_bimestrais) == ''){
					  	mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (turma, aluno, componente, bimestre, at, ap, ab, re) VALUES ('$turma', '$aluno', '$componente', '$bimestre', '0', '$media', '0', '')");
					  }else{
						mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET ap = '$media' WHERE aluno = '$aluno' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma'");
					  }




				 }elseif($res_atividades['tipo_envio'] == 'varios'){
					 
				 }
			}
			?>
			
			



			
			
			<?

			

			
			$sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND componente = '$componente' AND periodo = '$bimestre' AND tipo_atividade = 'Avaliação bimestral'");
			
			 while($res_atividades = mysqli_fetch_array($sql_atividades)){		 	
				
				if($res_atividades['tipo_envio'] == 'multipla'){
				
					$media = 0;
					 $conta_questaos = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades WHERE atividade = '".$res_atividades['code_atividade']."'"));
					$conta_questao_certa = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividades['code_atividade']."' AND aluno = '$aluno' AND correto = 'SIM'"));
					
					 $media = number_format($conta_questao_certa*10/$conta_questaos);

					  $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '$aluno' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma'");
					  if(mysqli_num_rows($sql_notas_bimestrais) == ''){
					  	mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (turma, aluno, componente, bimestre, at, ap, ab, re) VALUES ('$turma', '$aluno', '$componente', '$bimestre', '0', '0', '$media', '')");
					  }else{
						mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET ab = '$media' WHERE aluno = '$aluno' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma'");
					  }			 
			 
				}
			 
			 }

?>
</body>
</html>