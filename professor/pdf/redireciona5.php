<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?
	$componente = $_GET['componente'];
	$mes = $_POST['mes'];
	$turma = $_GET['turma'];
	$operador = $_GET['operador'];
	
	echo "<script language='javascript'>window.location='descricao_frequencia_mes.php?turma=$turma&componente=$componente&mes=$mes&operador=$operador';</script>";
?>
</body>
</html>