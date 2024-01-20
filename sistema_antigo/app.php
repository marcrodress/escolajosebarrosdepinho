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
 	  
      <? if(@$_GET['p'] == 'criar_acesso'){ ?>
      <p style="text-align:left;" class="h6"><strong class="text-primary">ALUNO:</strong> 
      <?
		$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$_GET['aluno']."'");
		 while($res_alunos = mysqli_fetch_array($sql_verifica)){
			echo ucwords($res_alunos['nome_aluno']);
		}
	  ?>      
      </p>
      <p style="text-align:left;" class="h6"><strong class="text-primary">TURMA:</strong> <? $turma = $_GET['turma'];
	  $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$_GET['turma']."'");
	    while($res_turma = mysqli_fetch_array($sql_turma)){
			echo $res_turma['code_serie']; echo "° ANO "; echo $res_turma['tipo_turma']; echo "
			 - TURNO: "; echo $res_turma['turno'];
	    }
	  ?></p>
      <hr />
      
      
		
      <? $aluno = $_GET['aluno'];
	   $sql_login = mysqli_query($conexao_bd, "SELECT * FROM login_alunos WHERE aluno = '".$_GET['aluno']."'");
	    if(mysqli_num_rows($sql_login) >= 1){
			echo "<div class='alert alert-danger' role='alert'><strong>ATENÇÃO!</strong>
			<img src='img/icone_atencao.png' width='40' height='30'>
			<br>
			<br>
			Esse aluno já criou um login, caso tenha esquecido, clique no botão abaixo para recuperar o login.
			<br>
			<br>
			</div>
			
						
			 <a href='recuperar_login.php?aluno=$aluno&turma=$turma' class='btn btn-warning'><strong>Recuperar login</strong></a>

			";
			
			
	  ?> 
      
      <? }else{ // ANALIZA SE JÁ EXISTE UM LOGIN CRIADO?>
      
      
      
      
      
      
       <? if(isset($_POST['verificar'])){
      	
		$login = $_POST['login'];
		$aluno = $_GET['aluno'];
		
		$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM login_alunos WHERE aluno = '".$_GET['aluno']."'");
		if(mysqli_num_rows($sql_verifica) >= 1){
			
		}else{
			
			mysqli_query($conexao_bd, "INSERT INTO login_alunos (ip, dia, mes, ano, data, data_completa, aluno, login) VALUES ('$ip', '$dia', '$mes', '$ano', '$data', '$data_completa', '".$_GET['aluno']."', '$login')");
			
			echo "
			 
			 <div class='alert alert-success' role='alert'><strong>PARABÉNS!!! <img src='img/icone_feliz.png'></strong>
			 <hr>
			 
			 Seu login foi criado, na próxima vez que entrar no App, basta digitar seu login.
			 <br><br><br>
			 Seu login: <strong>$login</strong>
			 
			 </div>
			 <hr>
			 
			 <a href='app/inicio.php?aluno=$aluno' class='btn btn-primary'>Entrar na plataforma</a>
			 
			";
			die;
		}
	  }?>
      
      
      
      <p style="text-align:left;" class="h6"><strong class="text-primary">Vamos facilitar seu acesso ao App?</strong> </p>
      <p style="text-align:left;" class="h6"><strong class="text-warning">Crie um login, na próxima não irá mais precisar digitar seu nome apenas esse login:</strong> </p>
      <hr />

      <form method="post" action="" enctype="multipart/form-data">
      <p class="h5"><strong>Crie um login</strong></p>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
      </div>
      <input type="text" name="login" class="form-control" aria-label="Default" autofocus aria-describedby="inputGroup-sizing-default">
    </div>
      <input type="submit" name="verificar" class="btn btn-primary" value="Criar" />
     </form>
    </div>
      
	  <? }} // p=criar_acesso ?>      
      
      
      
      
      
      
      
      
      
      <? if(@$_GET['p'] == ''){ ?>
      
      
      
      <? if(isset($_POST['verificar'])){
      	
		$nome_aluno = $_POST['nome_aluno'];
		if($nome_aluno == ''){
			echo "<div class='alert alert-danger' role='alert'>Digite seu nome!</div>";
		}else{
			
			$sql_login = mysqli_query($conexao_bd, "SELECT * FROM login_alunos WHERE login = '$nome_aluno'");
			if(mysqli_num_rows($sql_login) >= 1){
				while($res_login = mysqli_fetch_array($sql_login)){
					$aluno = $res_login['aluno'];
					echo "<script language='javascript'>window.location='app/inicio.php?aluno=$aluno';</script>";
				}
			}else{
			
			
			$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE nome_aluno LIKE '%$nome_aluno%'");
			if(mysqli_num_rows($sql_verifica) == ''){
				echo "<div class='alert alert-danger' role='alert'>Não foi encontrado nenhum aluno em nossa escola com esse nome, verifique se você digitou o nome correto ou entre em contato com a coordenação.</div><hr>";
			}else{
		?>
         <p class="h6" style="color:#F90;"><strong>Selecione você abaixo para validar</strong></p>
          <? while($res_alunos = mysqli_fetch_array($sql_verifica)){ ?>
          <div class="alert alert-primary text-justify" role="alert"><a href="?p=criar_acesso&aluno=<? echo $res_alunos['code_aluno']; ?>&turma=<? echo $res_alunos['turma']; ?>">
           <?
			  $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res_alunos['turma']."'");
			   
			   while($res_turma = mysqli_fetch_array($sql_turma)){
				   echo $res_turma['code_serie'];
				   echo "° ano - ";
				   echo $res_turma['tipo_turma'];
				   
			   }
			  
		   ?>: <? echo $res_alunos['nome_aluno']; ?></a></div>
          <? } ?>
          
          <hr />
          
        <?
			  }
			 }
		die;}
	  }?>
	
      <form method="post" action="" enctype="multipart/form-data">
      <p class="h5"><strong>DIGITE SEU NOME OU LOGIN</strong></p>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
      </div>
      <input type="text" name="nome_aluno" class="form-control" aria-label="Default" autofocus aria-describedby="inputGroup-sizing-default">
    </div>
      <input type="submit" name="verificar" class="btn btn-primary" value="Avançar" />
     </form>
    </div>
    </div><!-- col-sm -->
  </div><!-- row -->
  <? } //p sem nada ?>
  
  

</div><!-- container -->
</body>
</html>
