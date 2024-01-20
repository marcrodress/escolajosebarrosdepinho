<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>

<? include "config.php"; ?>
<? include "topo.php"; ?>

<div class="container_tuod"> <? $turma = $_GET['turma']; $componente = $_GET['componente']; ?>
  <div class="container">
    <div class="row">
      <div class="col-sm">
<? if($_GET['consulta'] != ''){ $consulta = $_GET['consulta'];

$sql_menu = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '$consulta' OR nome_aluno LIKE '%$consulta%'");
if(mysqli_num_rows($sql_menu) == ''){
	echo "<script language='javascript'>window.alert('Nenhum aluno encontrado com as informações digitadas!');</script>";
}elseif(mysqli_num_rows($sql_menu) > 1){

	echo "<br><h5>Alunos encontrados</h5>";
	while($res_aluno = mysqli_fetch_array($sql_menu)){
		$aluno = $res_aluno['code_aluno'];
		$nome_aluno = $res_aluno['nome_aluno'];
		echo "*<a href='?p=visao_geral_de_alunos&aluno=$aluno'>$nome_aluno</a>";
		echo "<br><br>";
		
		
	}
	
}else{
	$aluno = 0;
	while($res_aluno = mysqli_fetch_array($sql_menu)){
		$aluno = $res_aluno['code_aluno'];
	}
	echo "<script language='javascript'>window.location='?p=visao_geral_de_alunos&aluno=$aluno';</script>";	
}
}?>
</div><!-- row -->
</div><!-- col-sm -->
</div><!-- container -->
</div><!--container_tuod -->

<? include "paginas.php"; ?>
<? include "rodape.php"; ?>
</body>
</html>