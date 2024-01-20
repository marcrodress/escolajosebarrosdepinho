<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style>
body table{
	font:13px Arial, Helvetica, sans-serif;
	}
#container_tuod{
	background:#FFF;
}
</style>

</head>

<body>
<div class="container_tuod">
    <div class="container">
      <div class="row">
 	   <h5><strong>Cadastrar rota</strong></h5>
       <? if($_GET['k'] == ''){ ?>       
       <a href="?p=cadastrar_rota&k=cad" class="btn btn-success" style="width:200px; margin:10px;"><strong>Cadastrar nova rota</strong></a>
       <? } ?>
               
     
       
       <? if($_GET['k'] == 'cad'){ ?>
	   <form name="" method="post" action="" enctype="multipart/form-data">
        <input type="text" name="nome" placeholder="Digite o nome da rota" /> <input type="submit" name="cad" value="Cadastrar" />
       </form>
        
        <? if(isset($_POST['cad'])){
        
		 $nome = strtoupper($_POST['nome']);
		 if($nome == ''){
		 	echo "<script language='javascript'>window.alert('Digite o nome da rota!');</script>";
		 }else{
			 
			 $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM rota_escolar WHERE rota = '$nome'");
			 if(mysqli_num_rows($sql_verifica)>=1){
				echo "<script language='javascript'>window.alert('Rota já cadastrada!');</script>";
			 }else{
				 $code_rota = rand();
				 mysqli_query($conexao_bd, "INSERT INTO rota_escolar (code, rota) VALUES ('$code_rota', '$nome')");
					echo "<script language='javascript'>window.alert('Rota cadastrada com sucesso!');window.location='';</script>";
			 }
		 }
	   }?>
       
       <? } ?>


	
    	<br /><br />
        <table class="table table-striped" width="800" border="1">
          <tr>
            <td align="center" width="69"><strong>COD.</strong></td>
            <td width="141" align="center"><strong>ROTA</strong></td>
            <td width="169" align="center"><strong>COMUNIDADES</strong></td>
            <td width="125" align="center"><strong>QUANT. ALUNOS</strong></td>
            <td width="98" align="center"><strong>MANH&Atilde;</strong></td>
            <td width="87" align="center"><strong>TARDE</strong></td>
            <td width="65" align="center"><img src="img/impressora2.png" width="25" height="25" /></td>
          </tr>
          <? $total = 0; $total_manha = 0; $total_tarde = 0;
           $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM rota_escolar");
		   while($res = mysqli_fetch_array($sql_verifica)){
		  ?>
          <tr>
            <td align="center"><? echo $res['code']; ?></td>
            <td align="center"><? echo $res['rota']; ?></td>
            <td align="center"><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM rota_escolar_comunidades WHERE rota = '".$res['code']."'")); ?></td>
            <td align="center"><? $soma_alunos = 0; 
			  $seleciona_comunidade = mysqli_query($conexao_bd, "SELECT * FROM rota_escolar_comunidades WHERE rota = '".$res['code']."'");
				 while($res_comunidade = mysqli_fetch_array($seleciona_comunidade)){
					$soma_alunos = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE localidade = '".$res_comunidade['comunidade']."' AND transporte_escolar = 'SIM'"))+$soma_alunos;
					
				}
					$total = $total+$soma_alunos;
				
				echo $soma_alunos;
			?></td>
            <td align="center"><? $soma_alunos = 0; $manha = 0;
			  $seleciona_comunidade = mysqli_query($conexao_bd, "SELECT * FROM rota_escolar_comunidades WHERE rota = '".$res['code']."'");
				 while($res_comunidade = mysqli_fetch_array($seleciona_comunidade)){
					$alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE localidade = '".$res_comunidade['comunidade']."' AND transporte_escolar = 'SIM'");
					
					 while($res_aluno = mysqli_fetch_array($alunos)){
						 
						$sql_turmas_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE aluno = '".$res_aluno['code_aluno']."'");
						  while($res_turmas = mysqli_fetch_array($sql_turmas_alunos)){
							  
							  $sql_turma_horario = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res_turmas['turma']."' AND turno = 'MANHÃ'");
							  if(mysqli_num_rows($sql_turma_horario) >= 1){ $manha++;
							  }
							  
							  
						}
					}				
				}
				$total_manha = $total_manha+$manha;
				echo $manha;
			?></td>
            <td align="center"><? $soma_alunos = 0; $manha = 0; $tarde = 0;
			  $seleciona_comunidade = mysqli_query($conexao_bd, "SELECT * FROM rota_escolar_comunidades WHERE rota = '".$res['code']."'");
				 while($res_comunidade = mysqli_fetch_array($seleciona_comunidade)){
					$alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE localidade = '".$res_comunidade['comunidade']."' AND transporte_escolar = 'SIM'");
					
					 while($res_aluno = mysqli_fetch_array($alunos)){
						 
						$sql_turmas_alunos = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE aluno = '".$res_aluno['code_aluno']."'");
						  while($res_turmas = mysqli_fetch_array($sql_turmas_alunos)){
							  
							  $sql_turma_horario = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res_turmas['turma']."' AND turno = 'TARDE'");
							  if(mysqli_num_rows($sql_turma_horario) >= 1){ $tarde++;
							  }
							  
							  
						}
					}				
				}
				
				$total_tarde = $total_tarde+$tarde;
				
				echo $tarde;
			?></td>
            
            
            <td align="center">
            
            	<a rel="superbox[iframe][320x400]" href="scripts/adicionar_comunidade.php?rota=<? echo $res['code']; ?>"><img src="img/adicionar_aluno.png" width="20" height="20" border="0" title="Adicionar comunidade" /></a>
                
                
            <img src="img/impressora.jfif" width="20" height="20" /></td>
          </tr>
          <? } ?>
          <tr>
            <td colspan="3" align="right"><strong>TOTAL DE ALUNOS ATENDIDOS</strong></td>
            <td align="center"><? echo $total; ?></td>
            <td align="center"><? echo $total_manha; ?></td>
            <td align="center"><? echo $total_tarde; ?></td>
            <td align="center">&nbsp;</td>
          </tr>
        </table>



      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>