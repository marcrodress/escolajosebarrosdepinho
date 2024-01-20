<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body{
	text-align:center;
	background:0;
	margin:0;
}
body,td,th {
	color: #000;
	font:12px Arial, Helvetica, sans-serif;
}
</style>
</head>

<body>
<? require "../../conexao.php"; ?>

<table width="459" border="1">
  <tr>
    <td colspan="3" bgcolor="#0099FF"><h2><strong>COMPONENTES CURRICULARES</strong></h2></td>
  </tr>
  <tr>
    <td width="171"><strong>COMPONENTE</strong></td>
    <td width="228"><strong>PROFESSOR(A)</strong></td>
    <td width="38">&nbsp;</td>
  </tr>
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
  <tr>
    <td><? echo strtoupper($res_disciplina['componente']); ?></td>
    <td><? echo strtoupper($res_colaborador['nome']); ?></td>
    <td><a target="_blank" href="../pdf/descricao_atividades_anuais.php?turma=<? echo $_GET['turma']; ?>&professor=<? echo $res['professor']; ?>&componente=<? echo $res['disciplina']; ?>"><img src="../../img/impressora.png" width="20" height="20" /></a></td>
  </tr>
  <? }}}} ?>
</table>
</body>
</html>