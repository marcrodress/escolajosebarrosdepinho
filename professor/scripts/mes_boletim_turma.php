<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body{
	text-align:center;
}
body,td,th {
	color: #FFF;
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
	
	
	echo "<script language='javascript'>window.location='?p=1&aluno=$aluno&turma=$turma&componente=$componente&operador=$operador';</script>";

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
	
$sql_colaborador = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_professor['cpf']."'");
while($res_colaborador = mysqli_fetch_array($sql_colaborador)){

?>
  <option value="<? echo $res['disciplina']; ?>"><? echo $res_disciplina['componente']; ?> - <? echo strtoupper($res_colaborador['nome']); ?></option>
<? }}}} ?>
</select>
<input style="font:12px Arial, Helvetica, sans-serif; padding:5px;" type="submit" name="enviar" value="Emitir" />
</form>
<? } ?>

<? if(@$_GET['p'] == '1'){ ?>
<form action="../pdf/redireciona.php?componente=<? echo $_GET['componente']; ?>&turma=<? echo $_GET['turma']; ?>&operador=<? echo $_GET['operador']; ?>&mes=" method="post" enctype="multipart/form-data" name="" target="_blank">
<em><strong style="font:12px Arial, Helvetica, sans-serif;"><strong>Selecione o mês</strong></strong></em><br>
<select style="font:12px Arial, Helvetica, sans-serif; padding:5px;" name="mes" size="1">
  <option value="01">JANEIRO</option>
  <option value="02">FEVEREIRO</option>
  <option value="03">MAR&Ccedil;O</option>
  <option value="04">ABRIL</option>
  <option value="05">MAIO</option>
  <option value="06">JUNHO</option>
  <option value="07">JULHO</option>
  <option value="08">AGOSTO</option>
  <option value="09">SETEMBRO</option>
  <option value="10">OUTUBRO</option>
  <option value="11">NOVEMBRO</option>
  <option value="12">DEZEMBRO</option>
</select>
<input style="font:12px Arial, Helvetica, sans-serif; padding:5px;" type="submit" name="" value="Emitir" />
</form>
<? } ?>
</body>
</html>