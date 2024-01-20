<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body table{
	border:2px solid #000;
	padding:0;
	margin:0;
	}
body .table{
	border:2px solid #000;
	padding:0;
	font:12px Arial, Helvetica, sans-serif;
	margin:0;
	text-align:center;
	}
	
	
body,td,th {
	color: #000;
	padding:0;
	margin:0;
	font:12px Arial, Helvetica, sans-serif;
}

</style>
</head>

<body>
<?

$turma = $_GET['turma'];
require "../../conexao.php";

$sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
while($res_turma = mysqli_fetch_array($sql_turmas)){
?>
<table width="676" border="0">
  <tr>
    <td width="174" rowspan="2" align="center"><img src="../../img/logo.png" width="90" height="90" /></td>
    <td width="379" align="center"><h1 style="font:22px Arial, Helvetica, sans-serif;"><strong>E.E.F. DEPUTADO LEORNE BEL&Eacute;M</strong></h1></td>
    <td width="137" rowspan="2" align="center"><img src="../../img/logo_sao_goncao.png" width="90" height="90" /></td>
  </tr>
  <tr>
    <td align="center">
    <h3 style="font:17px Arial, Helvetica, sans-serif; padding:0; margin:0;"><strong>LISTA DE ALUNOS MATRICULADOS</strong></h3></td>
  </tr>
  <tr>
    <td colspan="3" align="center" bgcolor="#CCCCCC"><h3 style="margin:0; padding:5px;"><strong>TURMA:</strong> <? echo $res_turma['code_serie']; ?>° ANO - <? echo $res_turma['tipo_turma']; ?><strong> - TURNO:</strong> <? echo $res_turma['turno']; ?> - SALA: <? echo $res_turma['sala']; ?></h3></td>
  </tr>
  <tr>
    <td colspan="3"><table width="696" border="1">
      <tr>
        <td width="22" align="center"><strong>N&deg;</strong></td>
        <td width="656"><strong>NOME DO ALUNO</strong></td>
        </tr>
          <? $i = 0;
		  $sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$_GET['turma']."' AND transferido != 'SIM'");
		  while($res_alunos = mysqli_fetch_array($sql_alunos)){ $i++;
		  
		  $sql_nome_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res_alunos['aluno']."'");
		  while($res_nome_alunos = mysqli_fetch_array($sql_nome_alunos)){ $i++;
		  $aluno = 0;
		  ?>
      <tr>
        <td height="20" align="center"><? echo $res_alunos['n_chamada']; ?></td>
      <td><? echo strtoupper($res_nome_alunos['nome_aluno']); ?></td>
        
          	<?
			$sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND componente = '$componente' AND periodo = '$bimestre' AND tipo_atividade = 'Atividade'");
			$conta_atividade = mysqli_num_rows($sql_atividades);
			$soma_atividade_realizadas = 0;
			
			 while($res_atividades = mysqli_fetch_array($sql_atividades)){
				 if($res_atividades['tipo_envio'] == 'arquivo'){
				  $sql_verifica_fez = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND code_aluno = '".$res_alunos['aluno']."' AND data != ''");
					if(mysqli_num_rows($sql_verifica_fez) >= 1){
						$soma_atividade_realizadas++;
					}

				 }elseif($res_atividades['tipo_envio'] == 'multipla'){
					$sql_verifica_fez = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividades['code_atividade']."' AND aluno = '".$res_alunos['aluno']."' LIMIT 1");
					if(mysqli_num_rows($sql_verifica_fez) >= 1){
						$soma_atividade_realizadas++;
					}

				 }elseif($res_atividades['tipo_envio'] == 'varios'){
					 
				 }
				 
				 					
					$media = number_format($soma_atividade_realizadas*10/$conta_atividade);
					

					  $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma'");
					  if(mysqli_num_rows($sql_notas_bimestrais) == ''){
					  	mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (tipo, turma, aluno, componente, bimestre, at, ap, ab, re, media) VALUES ('PROFESSOR', '$turma', '".$res_alunos['aluno']."', '$componente', '$bimestre', '$media', '0', '0', '', '')");
					  }else{
						mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET tipo = 'PROFESSOR', at = '$media' WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma' AND tipo != 'COORDENACAO'");
					  }
				 
				 
			}
			
			
			
			
			
			
			
			$sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND componente = '$componente' AND periodo = '$bimestre' AND tipo_atividade = 'Avaliação parcial'");
			
			 while($res_atividades = mysqli_fetch_array($sql_atividades)){
				 if($res_atividades['tipo_envio'] == 'arquivo'){
				 
				  $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND code_aluno = '".$res_alunos['aluno']."' LIMIT 1");
				  
				 	 while($res_atividades_enviadas = mysqli_fetch_array($sql_atividades_enviadas)){
					  
					  $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma'");
					  if(mysqli_num_rows($sql_notas_bimestrais) == ''){
					  	mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (tipo, turma, aluno, componente, bimestre, at, ap, ab, re, media) VALUES ('PROFESSOR', '$turma', '".$res_alunos['aluno']."', '$componente', '$bimestre', '0', '".$res_atividades_enviadas['nota']."', '0', '', '')");
					  }else{
						mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET tipo = 'PROFESSOR', ap = '".$res_atividades_enviadas['nota']."' WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma' AND tipo != 'COORDENACAO'");
					  }
					  
				  }
				  
					 
					 
				 }elseif($res_atividades['tipo_envio'] == 'multipla'){ 
					$media = 0;
					$conta_questao = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades WHERE atividade = '".$res_atividades['code_atividade']."'"));
					 $conta_questao_certa = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividades['code_atividade']."' AND aluno = '".$res_alunos['aluno']."' AND correto = 'SIM'"));
					
					 $media = number_format($conta_questao_certa*10/$conta_questao);

					  $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma'");
					  if(mysqli_num_rows($sql_notas_bimestrais) == ''){
					  	mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (tipo, turma, aluno, componente, bimestre, at, ap, ab, re, media) VALUES ('PROFESSOR', '$turma', '".$res_alunos['aluno']."', '$componente', '$bimestre', '0', '$media', '0', '', '')");
					  }else{
						mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET tipo = 'PROFESSOR', ap = '$media' WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma' AND tipo != 'COORDENACAO'");
					  }




				 }elseif($res_atividades['tipo_envio'] == 'varios'){
					 
				 }
			}
			?>
			
			



			
			
			<?

			

			
			$sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND componente = '$componente' AND periodo = '$bimestre' AND tipo_atividade = 'Avaliação bimestral'");
			
			 while($res_atividades = mysqli_fetch_array($sql_atividades)){		
				 if($res_atividades['tipo_envio'] == 'arquivo'){
				 
				  $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND code_aluno = '".$res_alunos['aluno']."' LIMIT 1");
				  
				 	 while($res_atividades_enviadas = mysqli_fetch_array($sql_atividades_enviadas)){
					  
					  $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma'");
					  if(mysqli_num_rows($sql_notas_bimestrais) == ''){
					  	mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (tipo, turma, aluno, componente, bimestre, at, ap, ab, re, media) VALUES ('PROFESSOR', '$turma', '".$res_alunos['aluno']."', '$componente', '$bimestre', '0', '0', '".$res_atividades_enviadas['nota']."', '', '')");
					  }else{
						mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET tipo = 'PROFESSOR', ab = '".$res_atividades_enviadas['nota']."' WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma' AND tipo != 'COORDENACAO'");
					  }		
					 }
			 
			 
			 
			  	
				
			 }elseif($res_atividades['tipo_envio'] == 'multipla'){
				
					$media = 0;
					 $conta_questaos = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades WHERE atividade = '".$res_atividades['code_atividade']."'"));
					$conta_questao_certa = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividades['code_atividade']."' AND aluno = '".$res_alunos['aluno']."' AND correto = 'SIM'"));
					
					 $media = number_format($conta_questao_certa*10/$conta_questaos);

					  $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma'");
					  if(mysqli_num_rows($sql_notas_bimestrais) == ''){
					  	mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (tipo, turma, aluno, componente, bimestre, at, ap, ab, re, media) VALUES ('PROFESSOR', '$turma', '".$res_alunos['aluno']."', '$componente', '$bimestre', '0', '0', '$media', '', '')");
					  }else{
						mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET tipo = 'PROFESSOR', ab = '$media' WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma' AND tipo != 'COORDENACAO'");
					  }			 
			 
				}
			 
			 }
			 
			 
			 
			 
			 
			 
			 

			

			
			$sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND componente = '$componente' AND periodo = '$bimestre' AND tipo_atividade = 'Recuperação paralela'");
			
			 while($res_atividades = mysqli_fetch_array($sql_atividades)){		
				 if($res_atividades['tipo_envio'] == 'arquivo'){
				 
				  $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND code_aluno = '".$res_alunos['aluno']."' LIMIT 1");
				  
				 	 while($res_atividades_enviadas = mysqli_fetch_array($sql_atividades_enviadas)){
					  
					  $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma'");
					  if(mysqli_num_rows($sql_notas_bimestrais) == ''){
					  	mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (tipo, turma, aluno, componente, bimestre, at, ap, ab, re, media) VALUES ('PROFESSOR', '$turma', '".$res_alunos['aluno']."', '$componente', '$bimestre', '0', '0', '0', '".$res_atividades_enviadas['nota']."', '')");
					  }else{
						mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET tipo = 'PROFESSOR', re = '".$res_atividades_enviadas['nota']."' WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma' AND tipo != 'COORDENACAO'");
					  }		
					 }
			 
			 
			 
			  	
				
			 }elseif($res_atividades['tipo_envio'] == 'multipla'){
				
					$media = 0;
					 $conta_questaos = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades WHERE atividade = '".$res_atividades['code_atividade']."'"));
					$conta_questao_certa = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividades['code_atividade']."' AND aluno = '".$res_alunos['aluno']."' AND correto = 'SIM'"));
					
					 $media = number_format($conta_questao_certa*10/$conta_questaos);

					  $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma'");
					  if(mysqli_num_rows($sql_notas_bimestrais) == ''){
					  	mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (tipo, turma, aluno, componente, bimestre, at, ap, ab, re, media) VALUES ('PROFESSOR', '$turma', '".$res_alunos['aluno']."', '$componente', '$bimestre', '0', '0', '0', '$media', '')");
					  }else{
						mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET tipo = 'PROFESSOR', re = '$media' WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma' AND tipo != 'COORDENACAO'");
					  }			 
			 
				}
			 
			 }			 
			 
			 
			 
			 
			 
			 
			
			 $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE turma = '".$_GET['turma']."' AND aluno = '".$res_alunos['aluno']."' AND componente = '".$_GET['componente']."' AND bimestre = '".$_GET['bimestre']."'");
			 
			  while($res_notas_bimestrais = mysqli_fetch_array($sql_notas_bimestrais)){
				  
			?>
        
        <? } ?>
        
        
        
      </tr>
     <? }} ?> 
      
    </table>
    <hr />
<table class="table" width="696" border="1">
  <tr>
    <td colspan="6"><h2>CALEND&Aacute;RIO SEMANAL DE AULAS</h2></td>
    </tr>
  <tr>
    <td width="58" bgcolor="#999999"><strong>HOR&Aacute;RIO</strong></td>
    <td width="118" bgcolor="#999999"><strong>SEGUNDA</strong></td>
    <td width="99" bgcolor="#999999"><strong>TER&Ccedil;A</strong></td>
    <td width="126" bgcolor="#999999"><strong>QUARTA</strong></td>
    <td width="126" bgcolor="#999999"><strong>QUINTA</strong></td>
    <td width="127" bgcolor="#999999"><strong>SEXTA</strong></td>
    </tr>
  <tr>
    <td bgcolor="#D2FFFF">1&deg; AULA</td>
    <td bgcolor="#D2FFFF"><?
	  $sql_calendario = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '".$_GET['turma']."' AND dia = 'SEGUNDA' AND horario = '1'");
	 	 while($res_calendario = mysqli_fetch_array($sql_calendario)){
			
			$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res_componente = mysqli_fetch_array($sql_componente)){
				 echo $res_componente['componente'];
			}
			
		}
	?></td>
    <td bgcolor="#D2FFFF"><?
	  $sql_calendario = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '".$_GET['turma']."' AND dia = 'TERÇA' AND horario = '1'");
	 	 while($res_calendario = mysqli_fetch_array($sql_calendario)){
			
			$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res_componente = mysqli_fetch_array($sql_componente)){
				 echo $res_componente['componente'];
			}
			
		}
	?></td>
    <td bgcolor="#D2FFFF"><?
	  $sql_calendario = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '".$_GET['turma']."' AND dia = 'QUARTA' AND horario = '1'");
	 	 while($res_calendario = mysqli_fetch_array($sql_calendario)){
			
			$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res_componente = mysqli_fetch_array($sql_componente)){
				 echo $res_componente['componente'];
			}
			
		}
	?></td>
    <td bgcolor="#D2FFFF"><?
	  $sql_calendario = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '".$_GET['turma']."' AND dia = 'QUINTA' AND horario = '1'");
	 	 while($res_calendario = mysqli_fetch_array($sql_calendario)){
			
			$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res_componente = mysqli_fetch_array($sql_componente)){
				 echo $res_componente['componente'];
			}
			
		}
	?></td>
    <td bgcolor="#D2FFFF"><?
	  $sql_calendario = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '".$_GET['turma']."' AND dia = 'SEXTA' AND horario = '1'");
	 	 while($res_calendario = mysqli_fetch_array($sql_calendario)){
			
			$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res_componente = mysqli_fetch_array($sql_componente)){
				 echo $res_componente['componente'];
			}
			
		}
	?></td>
    </tr>
  <tr>
    <td bgcolor="#FFE8F3">2&deg; AULA</td>
    <td bgcolor="#FFE8F3"><?
	  $sql_calendario = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '".$_GET['turma']."' AND dia = 'SEGUNDA' AND horario = '2'");
	 	 while($res_calendario = mysqli_fetch_array($sql_calendario)){
			
			$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res_componente = mysqli_fetch_array($sql_componente)){
				 echo $res_componente['componente'];
			}
			
		}
	?></td>
    <td bgcolor="#FFE8F3"><?
	  $sql_calendario = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '".$_GET['turma']."' AND dia = 'TERÇA' AND horario = '2'");
	 	 while($res_calendario = mysqli_fetch_array($sql_calendario)){
			
			$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res_componente = mysqli_fetch_array($sql_componente)){
				 echo $res_componente['componente'];
			}
			
		}
	?></td>
    <td bgcolor="#FFE8F3"><?
	  $sql_calendario = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '".$_GET['turma']."' AND dia = 'QUARTA' AND horario = '2'");
	 	 while($res_calendario = mysqli_fetch_array($sql_calendario)){
			
			$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res_componente = mysqli_fetch_array($sql_componente)){
				 echo $res_componente['componente'];
			}
			
		}
	?></td>
    <td bgcolor="#FFE8F3"><?
	  $sql_calendario = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '".$_GET['turma']."' AND dia = 'QUINTA' AND horario = '2'");
	 	 while($res_calendario = mysqli_fetch_array($sql_calendario)){
			
			$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res_componente = mysqli_fetch_array($sql_componente)){
				 echo $res_componente['componente'];
			}
			
		}
	?></td>
    <td bgcolor="#FFE8F3"><?
	  $sql_calendario = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '".$_GET['turma']."' AND dia = 'SEXTA' AND horario = '2'");
	 	 while($res_calendario = mysqli_fetch_array($sql_calendario)){
			
			$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res_componente = mysqli_fetch_array($sql_componente)){
				 echo $res_componente['componente'];
			}
			
		}
	?></td>
    </tr>
  <tr>
    <td bgcolor="#D2FFFF">3&deg; AULA</td>
    <td bgcolor="#D2FFFF"><?
	  $sql_calendario = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '".$_GET['turma']."' AND dia = 'SEGUNDA' AND horario = '3'");
	 	 while($res_calendario = mysqli_fetch_array($sql_calendario)){
			
			$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res_componente = mysqli_fetch_array($sql_componente)){
				 echo $res_componente['componente'];
			}
			
		}
	?></td>
    <td bgcolor="#D2FFFF"><?
	  $sql_calendario = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '".$_GET['turma']."' AND dia = 'TERÇA' AND horario = '3'");
	 	 while($res_calendario = mysqli_fetch_array($sql_calendario)){
			
			$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res_componente = mysqli_fetch_array($sql_componente)){
				 echo $res_componente['componente'];
			}
			
		}
	?></td>
    <td bgcolor="#D2FFFF"><?
	  $sql_calendario = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '".$_GET['turma']."' AND dia = 'QUARTA' AND horario = '3'");
	 	 while($res_calendario = mysqli_fetch_array($sql_calendario)){
			
			$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res_componente = mysqli_fetch_array($sql_componente)){
				 echo $res_componente['componente'];
			}
			
		}
	?></td>
    <td bgcolor="#D2FFFF"><?
	  $sql_calendario = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '".$_GET['turma']."' AND dia = 'QUINTA' AND horario = '3'");
	 	 while($res_calendario = mysqli_fetch_array($sql_calendario)){
			
			$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res_componente = mysqli_fetch_array($sql_componente)){
				 echo $res_componente['componente'];
			}
			
		}
	?></td>
    <td bgcolor="#D2FFFF"><?
	  $sql_calendario = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '".$_GET['turma']."' AND dia = 'SEXTA' AND horario = '3'");
	 	 while($res_calendario = mysqli_fetch_array($sql_calendario)){
			
			$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res_componente = mysqli_fetch_array($sql_componente)){
				 echo $res_componente['componente'];
			}
			
		}
	?></td>
    </tr>
  <tr>
    <td bgcolor="#FFE8F3">4&deg; AULA</td>
    <td bgcolor="#FFE8F3"><?
	  $sql_calendario = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '".$_GET['turma']."' AND dia = 'SEGUNDA' AND horario = '4'");
	 	 while($res_calendario = mysqli_fetch_array($sql_calendario)){
			
			$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res_componente = mysqli_fetch_array($sql_componente)){
				 echo $res_componente['componente'];
			}
			
		}
	?></td>
    <td bgcolor="#FFE8F3"><?
	  $sql_calendario = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '".$_GET['turma']."' AND dia = 'TERÇA' AND horario = '4'");
	 	 while($res_calendario = mysqli_fetch_array($sql_calendario)){
			
			$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res_componente = mysqli_fetch_array($sql_componente)){
				 echo $res_componente['componente'];
			}
			
		}
	?></td>
    <td bgcolor="#FFE8F3"><?
	  $sql_calendario = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '".$_GET['turma']."' AND dia = 'QUARTA' AND horario = '4'");
	 	 while($res_calendario = mysqli_fetch_array($sql_calendario)){
			
			$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res_componente = mysqli_fetch_array($sql_componente)){
				 echo $res_componente['componente'];
			}
			
		}
	?></td>
    <td bgcolor="#FFE8F3"><?
	  $sql_calendario = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '".$_GET['turma']."' AND dia = 'QUINTA' AND horario = '4'");
	 	 while($res_calendario = mysqli_fetch_array($sql_calendario)){
			
			$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res_componente = mysqli_fetch_array($sql_componente)){
				 echo $res_componente['componente'];
			}
			
		}
	?></td>
    <td bgcolor="#FFE8F3"><?
	  $sql_calendario = mysqli_query($conexao_bd, "SELECT * FROM calendario_semanal WHERE turma = '".$_GET['turma']."' AND dia = 'SEXTA' AND horario = '4'");
	 	 while($res_calendario = mysqli_fetch_array($sql_calendario)){
			
			$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_calendario['componente']."'");
			 while($res_componente = mysqli_fetch_array($sql_componente)){
				 echo $res_componente['componente'];
			}
			
		}
	?></td>
    </tr>
</table>

    </td>
  </tr>
</table>
<? } ?>
</body>
</html>