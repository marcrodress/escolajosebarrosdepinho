<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width-device-width, initial-scale=1.0" />
<link href="css.css" rel="stylesheet" type="text/css" />
<? require "variaveis.php"; require "conexao.php"; $sala = $_GET['sala']; ?>

<? if($sala >1 && $sala <= 6){ $turma = 0;

$sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE turno = '$turno_frequencia' AND sala = '$sala'");
 while($res_turma = mysqli_fetch_array($sql_turma)){  $turma = $res_turma['code_turma'];
	 
$sql_aulas_dia = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE code_dia_atividade = '$code_hoje' AND turma = '$turma'");
	 
?>
<div class="container-fluid">
  <div class="row d-flex justify-content-center">
	<img src="img/logo.fw.png" style="margin:5px;" width="150" height="150" class="rounded" alt="...">
    <div class="col-sm">
      <p style="text-align:center;" class="p-3 mb-2 bg-primary text-white"><strong>REGISTRO DE FREQUÊNCIA</strong></p>
   </div><!-- col-sm -->
  </div><!-- row -->
  
  <div class="row">
    <div class="col-sm">
      <p class="h6"><strong class="text-primary">COMPONENTES:</strong> <br /><?
	    while($res_componentes = mysqli_fetch_array($sql_aulas_dia)){ 
	     $sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res_componentes['componente']."'");
		 	 while($res_disciplina = mysqli_fetch_array($sql_componente)){
				echo $res_disciplina['componente'];
				echo ": ";
				$sql_professor = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res_componentes['usuario']."'");
				 while($res_professor = mysqli_fetch_array($sql_professor)){
					 $sql_colaborador = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_professor['cpf']."'");
					 	 while($res_colaborador = mysqli_fetch_array($sql_colaborador)){
							 $nome_professor = $res_colaborador['nome'];
							 
							 for($i=0; $i<=strlen($nome_professor); $i++){
								 if($nome_professor[$i] == ' '){ $i=100000;
								 }else{
									 echo strtoupper($nome_professor[$i]);
								 }
							}
							 
						}
				}
				
				
				echo " <br> ";
			}
	   }
	  ?></p>      
      <p class="h6"><strong class="text-primary">TURMA:</strong> <?
			echo $res_turma['code_serie']; echo "° ANO "; echo $res_turma['tipo_turma']; echo " - "; echo "
			 TURNO: "; echo $res_turma['turno'];
	  ?></p>
      <p class="h6"><strong class="text-primary">DATA:</strong> <? echo date("d/m/Y"); ?></p>
      
      
      
      
    <hr />
    <? if(isset($_POST['verificar'])){
		
		$login_aluno = $_POST['login_aluno'];
		
		$sql_verifica_login = mysqli_query($conexao_bd, "SELECT * FROM login_alunos WHERE login = '$login_aluno' AND turma = '".$res_turma['code_turma']."'");
		if(mysqli_num_rows($sql_verifica_login) <=0){
			echo "<script language='javascript'>window.alert('NÃO FOI ENCONTRADO ALUNO COM ESSE LOGIN!');window.location='';</script>";
		}else{
			$aluno = 0;
			 while($res_aluno = mysqli_fetch_array($sql_verifica_login)){
				 $aluno = $res_aluno['aluno'];
			}
$sql_aulas_dia = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE code_dia_atividade = '$code_hoje' AND turma = '$turma'");
	   while($res_componentes = mysqli_fetch_array($sql_aulas_dia)){ 
			echo "<script language='javascript'>window.alert('FREQUÊNCIA REGISTRADA COM SUCESSO!');window.location='';</script>";
			$sql_verifica_frequencia = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '$aluno' AND data = '$data' AND code_atividade = '".$res_componentes['code_atividade']."'");
			if(mysqli_num_rows($sql_verifica_frequencia) == ''){
				mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas (data, status, arquivo, code_aluno, code_atividade, nota, presente) VALUES ('$data', '', '', '$aluno', '".$res_componentes['code_atividade']."', '', 'SIM')");
			}else{
				mysqli_query($conexao_bd, "UPDATE atividades_enviadas SET presente = 'SIM' WHERE data = '$data' AND code_aluno = '$aluno' AND code_atividade = '".$res_componentes['code_atividade']."'");
			}
		} // while de atividades
		
			
			
		}
	}?>
    
<? } // while de turmas ?>      
    
    
      <form method="post" action="" enctype="multipart/form-data">
      <p style="text-align:center;" class="h5"><strong>DIGITE SEU LOGIN</strong></p>
      <div style="text-align:center;" class="input-group mb-3">
      <div style="text-align:center;" class="input-group-prepend">
      </div>
      <input style="text-align:center;" type="text" name="login_aluno" class="form-control form-control-lg" aria-label="Default" autofocus aria-describedby="inputGroup-sizing-default">
    </div>
      <input style="text-align:center; float:left;" type="submit" name="verificar" class="btn btn-primary" value="Confirmar" />
     </form>
    </div>
    </div><!-- col-sm -->
  </div><!-- row -->  
</div><!-- container -->
<? }else{
 
 echo "AMBIENTE MONTIRADO, VOCÊ NÃO TEM ACESSO AUTORIZADO!";	
	
}?>
</body>
</html>
