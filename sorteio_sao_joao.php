<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width-device-width, initial-scale=1.0" />
<link href="css.css" rel="stylesheet" type="text/css" />
<? require "variaveis.php"; require "conexao.php"; ?>
<style type="text/css">
body{
	background:url(img/maxresdefault%20(1).jpg);
	}
div{
	 font:15px Arial, Helvetica, sans-serif;
	 text-align:justify;
	 }
</style>
</head>

<body>
<div class="container" style="background:url(img/maxresdefault%20(1).jpg);">
  <div class="row">
    <div class="col-sm">
     <div class="text-center">   
      <img src="img/logo.png" width="150" height="110" class="rounded" alt="...">
 	  <h1 class="h1" style="font:18px Arial, Helvetica, sans-serif; color:#00F;"><strong>"ARRAIÁ DO CUMPADI LEORNE"</strong></h1>
 	  <h1 class="h3" style="font:18px Arial, Helvetica, sans-serif; color:#F00;"><strong>Cadastra-se e participe!</strong></h1>
	  <hr />
      
     <? if(isset($_POST['verificar'])){
		 
		$nome = strtoupper($_POST['nome']);
		$telefone = $_POST['telefone'];
		
		$sql_sorteio = mysqli_query($conexao_bd, "SELECT * FROM sorteio_leorne_belem WHERE nome = '$nome'");
		if(mysqli_num_rows($sql_sorteio) >= 1){
			echo "<script language='javascript'>window.alert('Cadastrado já foi realizado! Boa sorte!');</script>";
		}else{
			mysqli_query($conexao_bd, "INSERT INTO sorteio_leorne_belem (data, nome, telefone, sorteado) VALUES ('$data_completa', '$nome', '$telefone', '')");			
			echo "<script language='javascript'>window.alert('Cadastrado realizado com sucesso! Boa sorte!');</script>";
		}
		
		
	 
	 }?> 
      
     
     <form method="post" action="" enctype="multipart/form-data">
      <p class="h5"><strong>Digite seu nome completo</strong></p>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
      </div>
      <input type="text" name="nome" class="form-control" style="text-align:center;" aria-label="Default" autofocus aria-describedby="inputGroup-sizing-default">
    </div>
      <p class="h5"><strong>Digite seu telefone</strong></p>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
      </div>
      <input type="text" name="telefone" class="form-control" style="text-align:center;" aria-label="Default" autofocus aria-describedby="inputGroup-sizing-default">
    </div>
      <input type="submit" name="verificar" class="btn btn-primary" value="Participar" />
     </form>
    </div>
      
    </div><!-- text-center -->
  </div><!-- col-sm -->
</div><!-- row -->
</div><!-- container -->
</body>
</html>
