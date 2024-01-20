<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body{
	font:12px Arial, Helvetica, sans-serif;
	text-align:center;
	color: #000;
}
</style>
<? require "../../conexao.php"; ?>

</head>

<body>
<table width="800" border="0">
  <tr>
    <td colspan="9" align="left"><strong>Turma:</strong>
          <? 
		  $sql = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$_GET['turma']."'");
		   while($res = mysqli_fetch_array($sql)){ 
		   	 echo strtoupper($res['code_serie']);echo "º ANO - ";
			 echo $res['tipo_turma']; echo " - ";
			 echo $res['turno'];
		   }
		  ?>
    
    <hr /></td>
  </tr>
  <tr>
    <td width="91"><strong>Matem&aacute;tica</strong></td>
    <td width="77"><strong>Portugu&ecirc;s</strong></td>
    <td width="99"><strong>Ci&ecirc;ncias</strong></td>
    <td width="70"><strong>Artes</strong></td>
    <td width="103"><strong>Ens. Religioso</strong></td>
    <td width="87"><strong>Geografia</strong></td>
    <td width="70"><strong>Hist&oacute;ria</strong></td>
    <td width="88"><strong>Ed. F&iacute;sica</strong></td>
    <td width="57"><strong>Ingl&ecirc;s</strong></td>
  </tr>
  <tr>
    <td><? $total_envios = 0;
			   
			   $conta_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$_GET['turma']."' AND transferido != 'SIM' AND impresso != 'SIM'");
			   
			   $total_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$_GET['turma']."' AND componente = '96461' AND code_dia_atividade < '$code_hoje'");
			    
				 while($res_atividades = mysqli_fetch_array($total_atividades)){ 
					$sql_todas_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND data != ''"); 
					  while($res_todas_atividades = mysqli_fetch_array($sql_todas_atividades)){  
						  $total_envios++;	
				     }
				
				}
			   
			   
			    $total_alunos = mysqli_num_rows($conta_alunos)*mysqli_num_rows($total_atividades);
			   

		  
			   
			    echo $percentual_frequencia = number_format(($total_envios*100)/$total_alunos,1);
			  ?>%</td>
    <td><? $total_envios = 0;
			   
			   $conta_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$_GET['turma']."' AND transferido != 'SIM' AND impresso != 'SIM'");
			   
			   $total_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$_GET['turma']."' AND componente = '96514' AND code_dia_atividade < '$code_hoje'");
			    
				 while($res_atividades = mysqli_fetch_array($total_atividades)){ 
					$sql_todas_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND data != ''"); 
					  while($res_todas_atividades = mysqli_fetch_array($sql_todas_atividades)){  
						  $total_envios++;	
				     }
				
				}
			   
			   
			    $total_alunos = mysqli_num_rows($conta_alunos)*mysqli_num_rows($total_atividades);
			   

		  
			   
			    echo $percentual_frequencia = number_format(($total_envios*100)/$total_alunos,1);
			  ?>
    %</td>
    <td><? $total_envios = 0;
			   
			   $conta_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$_GET['turma']."' AND transferido != 'SIM' AND impresso != 'SIM'");
			   
			   $total_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$_GET['turma']."' AND componente = '95616' AND code_dia_atividade < '$code_hoje'");
			    
				 while($res_atividades = mysqli_fetch_array($total_atividades)){ 
					$sql_todas_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND data != ''"); 
					  while($res_todas_atividades = mysqli_fetch_array($sql_todas_atividades)){  
						  $total_envios++;	
				     }
				
				}
			   
			   
			    $total_alunos = mysqli_num_rows($conta_alunos)*mysqli_num_rows($total_atividades);
			   

		  
			   
			    echo $percentual_frequencia = number_format(($total_envios*100)/$total_alunos,1);
			  ?>
    %</td>
    <td><? $total_envios = 0;
			   
			   $conta_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$_GET['turma']."' AND transferido != 'SIM' AND impresso != 'SIM'");
			   
			   $total_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$_GET['turma']."' AND componente = '36244' AND code_dia_atividade < '$code_hoje'");
			    
				 while($res_atividades = mysqli_fetch_array($total_atividades)){ 
					$sql_todas_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND data != ''"); 
					  while($res_todas_atividades = mysqli_fetch_array($sql_todas_atividades)){  
						  $total_envios++;	
				     }
				
				}
			   
			   
			    $total_alunos = mysqli_num_rows($conta_alunos)*mysqli_num_rows($total_atividades);
			   

		  
			   
			    echo $percentual_frequencia = number_format(($total_envios*100)/$total_alunos,1);
			  ?>
    %</td>
    <td><? $total_envios = 0;
			   
			   $conta_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$_GET['turma']."' AND transferido != 'SIM' AND impresso != 'SIM'");
			   
			   $total_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$_GET['turma']."' AND componente = '74235' AND code_dia_atividade < '$code_hoje'");
			    
				 while($res_atividades = mysqli_fetch_array($total_atividades)){ 
					$sql_todas_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND data != ''"); 
					  while($res_todas_atividades = mysqli_fetch_array($sql_todas_atividades)){  
						  $total_envios++;	
				     }
				
				}
			   
			   
			    $total_alunos = mysqli_num_rows($conta_alunos)*mysqli_num_rows($total_atividades);
			   

		  
			   
			    echo $percentual_frequencia = number_format(($total_envios*100)/$total_alunos,1);
			  ?>
    %</td>
    <td><? $total_envios = 0;
			   
			   $conta_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$_GET['turma']."' AND transferido != 'SIM' AND impresso != 'SIM'");
			   
			   $total_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$_GET['turma']."' AND componente = '390341' AND code_dia_atividade < '$code_hoje'");
			    
				 while($res_atividades = mysqli_fetch_array($total_atividades)){ 
					$sql_todas_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND data != ''"); 
					  while($res_todas_atividades = mysqli_fetch_array($sql_todas_atividades)){  
						  $total_envios++;	
				     }
				
				}
			   
			   
			    $total_alunos = mysqli_num_rows($conta_alunos)*mysqli_num_rows($total_atividades);
			   

		  
			   
			    echo $percentual_frequencia = number_format(($total_envios*100)/$total_alunos,1);
			  ?>
    %</td>
    <td><? $total_envios = 0;
			   
			   $conta_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$_GET['turma']."' AND transferido != 'SIM' AND impresso != 'SIM'");
			   
			   $total_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$_GET['turma']."' AND componente = '99981' AND code_dia_atividade < '$code_hoje'");
			    
				 while($res_atividades = mysqli_fetch_array($total_atividades)){ 
					$sql_todas_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND data != ''"); 
					  while($res_todas_atividades = mysqli_fetch_array($sql_todas_atividades)){  
						  $total_envios++;	
				     }
				
				}
			   
			   
			    $total_alunos = mysqli_num_rows($conta_alunos)*mysqli_num_rows($total_atividades);
			   

		  
			   
			    echo $percentual_frequencia = number_format(($total_envios*100)/$total_alunos,1);
			  ?>
    %</td>
    <td><? $total_envios = 0;
			   
			   $conta_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$_GET['turma']."' AND transferido != 'SIM' AND impresso != 'SIM'");
			   
			   $total_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$_GET['turma']."' AND componente = '9621345' AND code_dia_atividade < '$code_hoje'");
			    
				 while($res_atividades = mysqli_fetch_array($total_atividades)){ 
					$sql_todas_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND data != ''"); 
					  while($res_todas_atividades = mysqli_fetch_array($sql_todas_atividades)){  
						  $total_envios++;	
				     }
				
				}
			   
			   
			    $total_alunos = mysqli_num_rows($conta_alunos)*mysqli_num_rows($total_atividades);
			   

		  
			   
			    echo $percentual_frequencia = number_format(($total_envios*100)/$total_alunos,1);
			  ?>
    %</td>
    <td><? $total_envios = 0;
			   
			   $conta_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '".$_GET['turma']."' AND transferido != 'SIM' AND impresso != 'SIM'");
			   
			   $total_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$_GET['turma']."' AND componente = '639811' AND code_dia_atividade < '$code_hoje'");
			    
				 while($res_atividades = mysqli_fetch_array($total_atividades)){ 
					$sql_todas_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_atividades['code_atividade']."' AND data != ''"); 
					  while($res_todas_atividades = mysqli_fetch_array($sql_todas_atividades)){  
						  $total_envios++;	
				     }
				
				}
			   
			   
			    $total_alunos = mysqli_num_rows($conta_alunos)*mysqli_num_rows($total_atividades);
			   

		  
			   
			    echo $percentual_frequencia = number_format(($total_envios*100)/$total_alunos,1);
			  ?>
    %</td>
  </tr>
</table>
</body>
</html>