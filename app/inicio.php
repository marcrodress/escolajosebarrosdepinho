<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width-device-width, initial-scale=1.0" />
<link href="../css.css" rel="stylesheet" type="text/css" />
<link href="../bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../bootstrap-4.3.1-dist/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>


<? require "../conexao.php";

if($_GET['aluno'] != ''){
session_start();
$_SESSION['aluno'] = $_GET['aluno'];
$_SESSION['turma'] = $_GET['turma'];
}

session_start();
$aluno = $_SESSION['aluno'];
$turma = $_SESSION['turma'];

?>
<style type="text/css">
div{
	 font:15px Arial, Helvetica, sans-serif;
	 text-align:center;
	 }
</style>
</head>

<body>
<? require "topo.php"; ?>

<? require "paginas.php"; ?>

<? require "rodape.php"; ?>
</body>
</html>
