<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body{
	text-align:center;
}
body,td,th {
	font:12px Arial, Helvetica, sans-serif;
}
</style>
<? require "../../conexao.php"; ?>
</head>

<body>
<? if(@$_GET['p'] == ''){ ?>
<? if(isset($_POST['enviar'])){
	
	 $componente = $_POST['componente'];
	
	 $turma = $_GET['turma'];
	$operador = 0;
	
	$sql_disciplinas = mysqli_query($conexao_bd, "SELECT * FROM disciplinas_turmas WHERE turma = '".$_GET['turma']."' AND disciplina = '$componente'");
	while($res = mysqli_fetch_array($sql_disciplinas)){
		$operador = $res['professor'];
	}
	
	$id_aluno = 0;
	
	$sql_aluno = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE turma = '".$_GET['turma']."' LIMIT 1");
	  while($res_aluno = mysqli_fetch_array($sql_aluno)){
		  $id_aluno = $res_aluno['id'];
	 }
	
	$bimestre = $_GET['bimestre'];
	
	echo "<script language='javascript'>window.location='?p=1&bimestre=$bimestre&aluno=$id_aluno&turma=$turma&componente=$componente&operador=$operador';</script>";

}?>
<form action="" method="post" enctype="multipart/form-data" name="">
<em><strong style="font:12px Arial, Helvetica, sans-serif;"><strong>Selecione o componente</strong></strong></em><br>
<select style="font:12px Arial, Helvetica, sans-serif; padding:5px;" name="componente" size="1">
<?
$sql_disciplinas = mysqli_query($conexao_bd, "SELECT * FROM disciplinas_turmas WHERE turma = '".$_GET['turma']."'");
while($res = mysqli_fetch_array($sql_disciplinas)){

$sql_disciplina = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$res['disciplina']."'");
while($res_disciplina = mysqli_fetch_array($sql_disciplina)){

	
$sql_professor = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res['professor']."'");
while($res_professor = mysqli_fetch_array($sql_professor)){

?>
  <option value="<? echo $res['disciplina']; ?>"><? echo $res_disciplina['componente']; ?> - <? echo strtoupper($res_professor['nome_escola']); ?></option>
<? }}} ?>
</select>
<input style="font:12px Arial, Helvetica, sans-serif; padding:5px;" type="submit" name="enviar" value="Emitir" />
</form>
<? } ?>

<? if(@$_GET['p'] == '1'){ $id_aluno = $_GET['aluno']; $bimestre = $_GET['bimestre']; $turma = $_GET['turma']; $componente = $_GET['componente']; $operador = $_GET['operador'];?>

<?
$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE id = '$id_aluno' AND turma = '$turma'");
if($id_aluno-10 > mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM alunos"))){
	echo "<script language='javascript'>window.location='?p=5';</script>";
}elseif(mysqli_num_rows($sql_verifica) == ''){ $id_aluno++;
	echo "<script language='javascript'>window.location='?p=1&aluno=$id_aluno&turma=$turma&bimestre=$bimestre&componente=$componente&operador=$operador';</script>";	
}else{
?>	
	
   <?
    $nome_aluno = 0;
	$code_aluno = 0;
	$sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE id = '$id_aluno'");
	 while($res_alunos = mysqli_fetch_array($sql_alunos)){
		 $nome_aluno = $res_alunos['nome_aluno'];
		 $code_aluno = $res_alunos['code_aluno'];
	}
	
	$disciplinas = 0;
	$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '$componente'");
	 while($res_componente = mysqli_fetch_array($sql_componente)){
		 $disciplinas = $res_componente['componente'];
	}	
   
   ?> 
   
  <strong> Componente:</strong> <? echo $disciplinas; ?>
   <br />
   <strong>Nome do aluno:</strong> <? echo $nome_aluno; ?>
   <br />
   
   
   <? if(isset($_POST['avancar'])){
	 
	 $nota = $_POST['nota'];
	 
	 
	 $sql_notas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '$code_aluno' AND componente = '$componente' AND bimestre = '$bimestre'");
	 if(mysqli_num_rows($sql_notas) == ''){
		 mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (turma, aluno, componente, bimestre, at, ap, ab, re) VALUES ('$turma', '$code_aluno', '$componente', '$bimestre', '$nota', '$nota', '$nota', '')");
	 }else{
		 mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET at = '$nota', ap = '$nota', ab = '$nota' WHERE aluno = '$code_aluno' AND componente = '$componente' AND bimestre = '$bimestre'");
	 }
	   
	$id_aluno++;
	echo "<script language='javascript'>window.location='?p=1&bimestre=$bimestre&aluno=$id_aluno&turma=$turma&componente=$componente&operador=$operador';</script>";
   
   }?>
   
   
   
   <form name="" method="post" action="" enctype="multipart/form-data">
   
   <?
    
	
	$code_aluno = 0;
	$sql_alunos = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE id = '$id_aluno'");
	 while($res_alunos = mysqli_fetch_array($sql_alunos)){
		 $nome_aluno = $res_alunos['nome_aluno'];
		 $code_aluno = $res_alunos['code_aluno'];
	}	
	
	
	$nota_bimestre = 0;
	$sql_notas_lancadas = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '$code_aluno' AND componente = '$componente' AND bimestre = '$bimestre' LIMIT 1");
	while($res_notas = mysqli_fetch_array($sql_notas_lancadas)){
		$nota_bimestre = $res_notas['at'];
	}
   ?>
   
    <input name="nota" type="text" value="<? echo $nota_bimestre; ?>" id="nota" style="border:1px solid #CCC; padding:10px; text-align:center; margin:10px; border-radius:5px;" size="10" width="100" />
   <br />
    <input type="submit" style="border:1px solid #CCC; padding:10px; margin:0; border-radius:5px;" name="avancar" value="Avançar" />
   </form>
	
<? } ?>




<hr />

<a style="background:#090; text-decoration:none; padding:5px; color:#FFF; font:12px Arial, Helvetica, sans-serif;" href="bimestre.php?turma=<? echo $_GET['turma']; ?>&operador=<? echo $_GET['operador']; ?>">Voltar</a>
<? } ?>




<? if(@$_GET['p'] == '5'){ 

echo "
<strong>Processo concluído com sucesso!!!</strong>
<br><br>
<p>Pressione F5</p>

";

}?>
</body>
</html>