<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?
	$componente = $_GET['componente'];
	$bimestre = $_POST['bimestre'];
	$turma = $_GET['turma'];
	$operador = $_GET['operador'];
	
	echo "<script language='javascript'>window.location='descricao_notas_mensais.php?turma=$turma&componente=$componente&operador=$operador&bimestre=$bimestre';</script>";
?>
</body>
</html>