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
    <div class="col-sm">
     <div class="text-center">   
      <img src="../img/logo.fw.png" width="100" height="100" class="rounded" alt="...">
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
			 $turma = $res_alunos['turma'];
		}
	  ?>     - <a href="">SAIR</a>
      </p>
      <p style="text-align:left; font:12px Arial, Helvetica, sans-serif;" class="h6"><strong class="text-primary"><strong>TURMA:</strong></strong> <? 
	  $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
	    while($res_turma = mysqli_fetch_array($sql_turma)){
			echo $res_turma['code_serie']; echo "� ANO "; echo $res_turma['tipo_turma']; echo "
			 - TURNO: "; echo $res_turma['turno'];
	    }
	  ?></p>

      
      </div><!-- col-sm -->
      
     </div><!-- text-center -->
    </div><!-- col-sm -->
  </div><!-- row -->
</div><!-- container -->
</body>
</html>
