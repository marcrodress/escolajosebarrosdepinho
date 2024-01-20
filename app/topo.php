<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width-device-width, initial-scale=1.0" />
<link href="../css.css" rel="stylesheet" type="text/css" />
<style type="text/css">
div{
	 font:12px Arial, Helvetica, sans-serif;
	 text-align:center;
	 }
</style>
</head>

<body>
<div class="container">

  <div class="row">
  	<div class="col">
     
    </div><!-- col-sm-->
    
    <div class="col">
        <img src="../img/logo.fw.png" width="100" height="100" class="rounded" alt="...">     
    </div><!-- col-sm-->
    
    <div class="col">
    
     <p class="text-primary m-3"><strong>Saldo:</strong> <br />T$
      
     <?
      
	  $sqlSaldoTots = mysqli_query($conexao_bd, "SELECT * FROM controlePontos WHERE aluno = '$aluno'");
	   while($resSaldo = mysqli_fetch_array($sqlSaldoTots)){
	  	echo number_format($resSaldo['saldo'], 0,',','.');
	  }
	  
	 ?>
     </p>
     <a style="padding:5px; background:#990; text-decoration:none; color:#FFF;" href="">Comprar</a>
    
    </div><!-- col-sm-->
  </div><!-- row -->

  <div class="row">
    <div class="col-sm">
     <div class="text-center">   
	  <hr />
 	  
      <div margin:0 0 0 -10px;" class="col-sm">
      <p style="text-align:left; font:12px Arial, Helvetica, sans-serif;" class="h6"><strong class="text-primary"><strong>ALUNO:</strong></strong> 
      <? $conta_zero = 0;
		$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '$aluno'");
		 while($res_alunos = mysqli_fetch_array($sql_verifica)){
			$nome_aluno = ucwords($res_alunos['nome_aluno']);
				
				for($i=0; $i<=strlen($nome_aluno); $i++){
					if($conta_zero <=1){
						echo strtoupper($nome_aluno[$i]);
						if(strtoupper($nome_aluno[$i]) == ' '){
							$conta_zero++;
						}
					}
				}
			
			 $telefone = $res_alunos['telefone'];
			 
		}
			$turma = 0;
			  $sql_turma_v = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE aluno = '$aluno' AND status = 'Ativo' ORDER BY id ASC LIMIT 1");
		  	 while($res_turma_v = mysqli_fetch_array($sql_turma_v)){
				 $code_turma = $res_turma_v['turma'];
			}
			
			$turma = $code_turma;
		
		
	  ?>     - <a href="../app.php">SAIR</a>
      </p>
      <p style="text-align:left; font:12px Arial, Helvetica, sans-serif;" class="h6"><strong class="text-primary"><strong>TURMA:</strong></strong> <? 	$fase = 0;
	  $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$code_turma'");
	    while($res_turma = mysqli_fetch_array($sql_turma)){
			
			$fase = $res_turma['fase'];
			
			echo $res_turma['code_serie']; echo "° ANO "; echo $res_turma['tipo_turma']; echo "
			 - TURNO: "; echo $res_turma['turno'];
			echo " - <strong>Sala: </strong>"; echo $res_turma['sala'];
			 
	    }
	  ?></p>

      
      </div><!-- col-sm -->
      
     </div><!-- text-center -->
    </div><!-- col-sm -->
  </div><!-- row -->
</div><!-- container -->
</body>
</html>
