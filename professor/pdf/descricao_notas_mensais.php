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
$componente = $_GET['componente'];
$operador = $_GET['operador'];
$bimestre = $_GET['bimestre'];
require "../../conexao.php";


$sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
while($res_turma = mysqli_fetch_array($sql_turmas)){
?>
<table width="676" border="0">
  <tr>
    <td width="124" rowspan="2" align="center"><img src="../../img/logo.png" width="90" height="90" /></td>
    <td colspan="2" align="center"><h1 style="font:22px Arial, Helvetica, sans-serif;"><strong>E.E.F. DEPUTADO LEORNE BEL&Eacute;M</strong></h1></td>
    <td width="129" rowspan="2" align="center"><img src="../../img/logo_sao_goncao.png" width="90" height="90" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
    <h3 style="font:17px Arial, Helvetica, sans-serif; padding:0; margin:0;"><strong>RELATÓRIO DE NOTAS BIMESTRAL</strong></h3>
    <h2 style="font:15px Arial, Helvetica, sans-serif;"><strong>BIMESTRE:</strong> <? echo $bimestre = $_GET['bimestre']; ?>&deg; BIMESTRE</h2> 
    <strong>PROFESSOR:</strong> <?
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$operador'");
	   while($res_verifica = mysqli_fetch_array($sql_verifica)){
		   
		   $sql_colaboradores = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_verifica['cpf']."'");
		    while($res_colaboradores = mysqli_fetch_array($sql_colaboradores)){
				   echo strtoupper($res_colaboradores['nome']);		  
				
			}
		   
	 }
	?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC"><strong>TURMA:</strong> <? echo $res_turma['code_serie']; ?>° ANO - <? echo $res_turma['tipo_turma']; ?></td>
    <td width="269" align="center" bgcolor="#CCCCCC"><strong>TURNO:</strong> <? echo $res_turma['turno']; ?></td>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>COMPONENTE:</strong> <?
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '$componente'");
	   while($res_verifica = mysqli_fetch_array($sql_verifica)){
		   echo $res_verifica['componente'];		  
	 }
	?></td>
  </tr>
  <tr>
    <td colspan="4"><table width="700" border="1">
      <tr>
        <td width="24" align="center"><strong>N&deg;</strong></td>
        <td width="348"><strong>NOME DO ALUNO</strong></td>
        <td width="41" align="center"><strong>AT</strong></td>
        <td width="45" align="center"><strong>AP</strong></td>
        <td width="47" align="center"><strong>AB</strong></td>
        <td width="38" align="center"><strong>MP</strong></td>
        <td width="40" align="center"><strong>RE</strong></td>
        <td width="63" align="center"><strong>MB</strong></td>
      </tr>
          <? $i = 0; $conta = 0;
		  $sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$_GET['turma']."' AND transferido != 'SIM'");
		  while($res_alunos = mysqli_fetch_array($sql_alunos)){ $i++;
		  
		  $sql_nome_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res_alunos['aluno']."'");
		  while($res_nome_alunos = mysqli_fetch_array($sql_nome_alunos)){ $i++;
		  $aluno = 0;
		  ?>
      <tr>
        <td height="20" align="center"><? $conta++; echo $conta; ?></td>
      <td><? echo strtoupper($res_nome_alunos['nome_aluno']); ?></td>
        
          	<?
			$sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND componente = '$componente' AND periodo = '$bimestre' AND tipo_atividade = 'Atividade'");
			$conta_atividade = mysqli_num_rows($sql_atividades);
			$soma_atividade_realizadas = 0;
			
			 while($res_atividades = mysqli_fetch_array($sql_atividades)){
				 if($res_atividades['tipo_envio'] == 'arquivo'){
				  $sql_verifica_fez = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND code_aluno = '".$res_alunos['aluno']."' AND nota != ''");
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
				 
				 					
					$media = number_format($soma_atividade_realizadas*10/$conta_atividade)+0;
					

					  $sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma'");
					  if(mysqli_num_rows($sql_notas_bimestrais) == ''){
						  $media = $media+0;
					  	mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (tipo, turma, aluno, componente, bimestre, at, ap, ab, re, media) VALUES ('PROFESSOR', '$turma', '".$res_alunos['aluno']."', '$componente', '$bimestre', '$media', '0', '0', '', '')");
					  }else{
						  $media = $media+0;
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
					  	mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (tipo, turma, aluno, componente, bimestre, at, ap, ab, re, media) VALUES ('PROFESSOR', '$turma', '".$res_alunos['aluno']."', '$componente', '$bimestre', '0', '".($res_atividades_enviadas['nota']+0)."', '0', '', '')");
					  }else{
						mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET tipo = 'PROFESSOR', ap = '".($res_atividades_enviadas['nota']+0)."' WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma' AND tipo != 'COORDENACAO'");
					  }
					  
				  }
				  
					 
					 
				 }elseif($res_atividades['tipo_envio'] == 'multipla'){ 
					$media = 0;
					$conta_questao = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades WHERE atividade = '".$res_atividades['code_atividade']."'"));
					 $conta_questao_certa = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividades['code_atividade']."' AND aluno = '".$res_alunos['aluno']."' AND correto = 'SIM'"));
					
					 $media = number_format($conta_questao_certa*10/$conta_questao)+0;

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
					  	mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (tipo, turma, aluno, componente, bimestre, at, ap, ab, re, media) VALUES ('PROFESSOR', '$turma', '".$res_alunos['aluno']."', '$componente', '$bimestre', '0', '0', '".($res_atividades_enviadas['nota']+0)."', '', '')");
					  }else{
						mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET tipo = 'PROFESSOR', ab = '".($res_atividades_enviadas['nota']+0)."' WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma' AND tipo != 'COORDENACAO'");
					  }		
					 }
			 
			 
			 
			  	
				
			 }elseif($res_atividades['tipo_envio'] == 'multipla'){
				
					$media = 0;
					 $conta_questaos = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades WHERE atividade = '".$res_atividades['code_atividade']."'"));
					$conta_questao_certa = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividades['code_atividade']."' AND aluno = '".$res_alunos['aluno']."' AND correto = 'SIM'"));
					
					 $media = number_format($conta_questao_certa*10/$conta_questaos)+0;

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
					  	mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (tipo, turma, aluno, componente, bimestre, at, ap, ab, re, media) VALUES ('PROFESSOR', '$turma', '".$res_alunos['aluno']."', '$componente', '$bimestre', '0', '0', '0', '".($res_atividades_enviadas['nota']+0)."', '')");
					  }else{
						mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET tipo = 'PROFESSOR', re = '".($res_atividades_enviadas['nota']+0)."' WHERE aluno = '".$res_alunos['aluno']."' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma' AND tipo != 'COORDENACAO'");
					  }		
					 }
			 
			 
			 
			  	
				
			 }elseif($res_atividades['tipo_envio'] == 'multipla'){
				
					$media = 0;
					 $conta_questaos = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades WHERE atividade = '".$res_atividades['code_atividade']."'"));
					$conta_questao_certa = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE atividade = '".$res_atividades['code_atividade']."' AND aluno = '".$res_alunos['aluno']."' AND correto = 'SIM'"));
					
					 $media = number_format($conta_questao_certa*10/$conta_questaos)+0;

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
        <td align="center"><? echo $res_notas_bimestrais['at']; ?>,0</td>
        <td align="center"><? if($res_notas_bimestrais['ap'] == ''){ echo "0"; }else{ echo $res_notas_bimestrais['ap']+0; } ?>,0</td>
        <td align="center"><? if($res_notas_bimestrais['ab'] == ''){ echo "0"; }else{ echo $res_notas_bimestrais['ab']+0; } ?>,0</td>
        <td align="center"><? echo $media = number_format(($res_notas_bimestrais['at']+$res_notas_bimestrais['ap']+$res_notas_bimestrais['ab'])/3); ?>,0</td>
        <td align="center"><? if($res_notas_bimestrais['re'] == '' || $media >= 6){ echo "0"; }else{ echo $res_notas_bimestrais['re']+0; }?>,0</td>
        <td align="center">             <?
               if($media >= 6){
				   echo "$media"+0;
			   }else{
				   
				   if($res_notas_bimestrais['re'] <= 0){
					echo "$media"+0;
				   }else{
				   echo $media = number_format(($media+$res_notas_bimestrais['re']+0)/2);
				   }
			   }
			   
			   			   
			   
			   mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET media = '$media' WHERE turma = '".$_GET['turma']."' AND aluno = '".$res_alunos['aluno']."' AND componente = '".$_GET['componente']."' AND bimestre = '".$_GET['bimestre']."'");
			   
			 ?>,0</td>
        <? } ?>
        
        
        
      </tr>
     <? }} ?> 
      
    </table>
      <table width="700" border="0">
        <tr>
          <td colspan="2" align="center"><br /></td>
        </tr>
        <tr>
          <td align="center"><p>&nbsp;</p>
            <p>__________________________________________<br />
              PROF&ordf;:
  <?
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$operador'");
	   while($res_verifica = mysqli_fetch_array($sql_verifica)){
		   echo strtoupper($res_verifica['nome_escola']);		  
	 }
	?>
          </p></td>
          <td align="center"><p>&nbsp;</p>
            <p>__________________________________________<br />
          COORDENADOR</p></td>
        </tr>
    </table></td>
  </tr>
</table>
<? } ?>
</body>
</html>