<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?
require "conexao.php";
$sql = mysqli_query($conexao_bd, "SELECT * FROM aulas_previstas WHERE turma = '1300792145'");
 while($res = mysqli_fetch_array($sql)){
	 mysqli_query($conexao_bd, "INSERT INTO aulas_previstas (mes, componente, dadas, turma) VALUES ('".$res['mes']."', '".$res['componente']."', '".$res['dadas']."', '79816108')");
}
?>
</body>
</html>