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
      <hr />
 	  <h1 class="h1" style="font:18px Arial, Helvetica, sans-serif; color:#00F;"><strong>SORTEAR GANHADOR</strong></h1>
      <?
	   $sql = mysqli_query($conexao_bd, "SELECT * FROM sorteio_leorne_belem WHERE sorteado = 'SIM'");
	   if(mysqli_num_rows($sql) >= 5){
		 while($res_sortear = mysqli_fetch_array($sql)){
			 echo "<br><br><strong>NOME:</strong> ";
			 echo $res_sortear['nome'];
			 echo "<br><strong>TELEFONE:</strong>";
			 echo $res_sortear['telefone'];			 
		 }
	   }else{
	  ?>
      
      
	  <form name="" method="post" action="" enctype="multipart/form-data">
       <input type="submit" name="sorteio" value="Sortear" />
      </form>
      <hr />
      <? if(isset($_POST['sorteio'])){ 
		  
		$sql_sortear = mysqli_query($conexao_bd, "SELECT * FROM sorteio_leorne_belem WHERE sorteado != 'SIM' ORDER BY rand() LIMIT 1");
		 while($res_sortear = mysqli_fetch_array($sql_sortear)){ $i++;
			 echo "<br><br><strong>$i°: NOME:</strong> ";
			 echo $res_sortear['nome'];
			 echo "<br><br><strong>TELEFONE:</strong> ";
			 echo $res_sortear['telefone'];
			 echo "<hr>";
			 
			 $id_sorteio = $res_sortear['id'];
			 
			 mysqli_query($conexao_bd, "UPDATE sorteio_leorne_belem SET sorteado = 'SIM' WHERE id = '$id_sorteio'");
			 
		}
		
      
	  
	  }?>
      
      
      <? } ?>
      
      
    </div><!-- text-center -->
  </div><!-- col-sm -->
</div><!-- row -->
</div><!-- container -->
</body>
</html>
