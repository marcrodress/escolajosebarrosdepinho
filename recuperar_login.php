<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width-device-width, initial-scale=1.0" />
<link href="css.css" rel="stylesheet" type="text/css" />
<? require "variaveis.php"; require "conexao.php"; ?>
<style type="text/css">
div{
	 font:15px Arial, Helvetica, sans-serif;
	 text-align:justify;
	 }
</style>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-sm">
     <div class="text-center">   
      <img src="img/logo.fw.png" width="100" height="100" class="rounded" alt="...">
<hr />
 	  
      <p style="text-align:left;" class="h6"><strong class="text-primary">ALUNO:</strong> 
      <?
		$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$_GET['aluno']."'");
		 while($res_alunos = mysqli_fetch_array($sql_verifica)){
			 
			echo ucwords($res_alunos['nome_aluno']);
			 
		}
			 
		$sql_contato = mysqli_query($conexao_bd, "SELECT * FROM contato_alunos WHERE aluno = '".$_GET['aluno']."' AND contato != '' AND tipo = 'Telefone'");
		 while($res_contato = mysqli_fetch_array($sql_contato)){
			 $telefone = $res_contato['contato'];

	   }
	  ?>      
      </p>
      <p style="text-align:left;" class="h6"><strong class="text-primary">TURMA:</strong> <? 
	  $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$_GET['turma']."'");
	    while($res_turma = mysqli_fetch_array($sql_turma)){
			echo $res_turma['code_serie']; echo "° ANO "; echo $res_turma['tipo_turma']; echo "
			 - TURNO: "; echo $res_turma['turno'];
	    }
	  ?></p>
      <hr />
      <p style="text-align:center;" class="h3 text-warning"><strong >Seu telefone:<br /></strong><? 
	  	
		for($i=0; $i<11; $i++){
			echo $telefone[$i];
		}
	  
	   ?>XXXX</p>
       <hr />
       
       
       


       <? if(isset($_POST['verificar'])){
       
	    $telefone1 = $_POST['telefone1'];
	    $telefone2 = $_POST['telefone2'];
		
		$tele1 = $telefone1[11];
		$tele2 = $telefone1[12];
		$tele3 = $telefone1[13];
		$tele4 = $telefone1[14];
		
		$telefone1 = "$tele1$tele2$tele3$tele4";
		
		if($telefone2 == ''){
		   echo "<div style='text-align:center;' class='alert alert-danger' role='alert'>Digite os 4 últimos números do seu telefone.</div><hr>";			
		}elseif($telefone1 != $telefone2){
		   echo "<div style='text-align:center;' class='alert alert-danger' role='alert'>O número digitado está incorreto, tente novamente!. Se o erro persistir, fale com o coordenador da escola.</div><hr>";			
		}else{
			$login = 0; $aluno = $_GET['aluno'];
		  $sql_busca_login = mysqli_query($conexao_bd, "SELECT * FROM login_alunos WHERE aluno = '".$_GET['aluno']."'");
		    while($res_login = mysqli_fetch_array($sql_busca_login)){
				$login = $res_login['login'];
		   }
		   
		   
		   $turma = $_GET['turma'];
		  
			echo "
			 
			 <div class='alert alert-success' role='alert'><strong>PARABÉNS!!! <img src='img/icone_feliz.png'></strong>
			 <hr>
			 
			 Seu login é: <strong>$login</strong>
			 <br><br><br>
			 
			 Dica: Anote o login acima para entrar tranquilamente na plataforma.
			 </div>
			 <hr>
			 
			 <a href='app/inicio.php?aluno=$aluno&turma=$turma' class='btn btn-primary'>Entrar na plataforma</a>
			 
			";
			die;
			
		}
	   }?>    

      <p class="h6 text-success"><strong>Digite os 4 últimos números do seu telefone para eu te mostrar teu login:</strong></p>
   
      <form method="post" action="" enctype="multipart/form-data">
      <input type="hidden" name="telefone1" value="<? echo $telefone; ?>" />
      <div class="input-group mb-3">
      <div class="input-group-prepend">
      </div>
      <input name="telefone2" type="text" class="form-control" style="text-align:center; font:18px Arial, Helvetica, sans-serif;" maxlength="4" aria-label="Default" autofocus aria-describedby="inputGroup-sizing-default">
    </div>
      <input type="submit" name="verificar" class="btn btn-primary" value="Verificar" />
     </form>
    </div>      
    </div><!-- col-sm -->
  </div><!-- row -->

</div><!-- container -->
</body>
</html>
