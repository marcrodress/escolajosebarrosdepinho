<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8559-1" />

<? require "../../conexao.php"; ?>
</head>

<body>
<? if(isset($_POST['enviar'])){

$componente = $_POST['componente'];

if($componente == ''){
 echo "<script language='javascript'>window.alert('Digite o nome do componente');</script>";
}else{
	$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE componente = '$componente'");
	if(mysqli_num_rows($sql_verifica) >=1){
	 echo "<script language='javascript'>window.alert('Componente j� criado');</script>";
	}else{
		mysqli_query($conexao_bd, "INSERT INTO disciplinas (code, escola, componente) VALUES ('".rand()."', '', '$componente')");
		
		echo "
		
			<strong><img src='https://cdn-icons-png.flaticon.com/512/148/148767.png' width='22' height='25'/> Opera��o realizada com sucesso!</strong>
			
			<br>
			<br>
			<em>Atualize a p�gina para observar as mudan�as</em>
		
		";
		
		die;
	
	
	}
}
}?>

<form name="" method="post" action="" enctype="multipart/form-data">
<strong style="font:12px Arial, Helvetica, sans-serif;"><strong>Componente</strong></strong>
<br />
<input style="font:12px Arial, Helvetica, sans-serif; padding:5px; border:1px solid #000;" type="text" name="componente" value="" /> 
<input style="font:12px Arial, Helvetica, sans-serif; padding:5px; border:1px solid #000;" type="submit" name="enviar" value="Enviar" />
</form>
</body>
</html>