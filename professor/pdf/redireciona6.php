<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?
	$componente = $_POST['componente'];
	$bimestre = $_POST['bimestre'];
	$turma = $_GET['turma'];
	
	
	$operador = 0;
	require "../../conexao.php";
	
	$sql_disciplinas = mysqli_query($conexao_bd, "SELECT * FROM disciplinas_turmas WHERE turma = '".$_GET['turma']."' AND disciplina = '$componente'");
	while($res = mysqli_fetch_array($sql_disciplinas)){
		$operador = $res['professor'];
	}	
	
	echo "<script language='javascript'>window.location='notas_por_bimestre.php?turma=$turma&componente=$componente&operador=$operador&bimestre=$bimestre';</script>";
?>
</body>
</html>