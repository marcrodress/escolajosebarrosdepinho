<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
input{
	width:50px;
	padding:10px;
	border:1px solid #03C;
	border-radius:10px;
	text-align:center;
	color:#FC0;
	font:15px Arial, Helvetica, sans-serif;
}
select{
	width:620px;
	padding:5px;
	border:1px solid #03C;
	border-radius:2px;
	text-align:left;
	color:#000;
	margin:5px;
	font:15px Arial, Helvetica, sans-serif;
}
.input{
	width:80px;
	padding:10px;
	border:1px solid #03C;
	border-radius:5px;
	background:#099;
	text-align:center;
	color:#FFF;
	font:12px Arial, Helvetica, sans-serif;
}

table{
	border:10px solid #03C;
	border-radius:10px;
	text-align:center;
	font:12px Arial, Helvetica, sans-serif;
	}
table td{
	border:1px solid #03C;
	border-radius:10px;
	text-align:center;
	font:12px Arial, Helvetica, sans-serif;
	padding:5px;
	}
</style>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
</head>

<body>
<?
require "../../conexao.php";
$sqlVerifica = mysqli_query($conexao_bd, "SELECT * FROM aulas_previstas WHERE componente = '".$_GET['componente']."' AND turma = '".$_GET['turma']."'");

if(mysqli_num_rows($sqlVerifica) == 0){
	mysqli_query($conexao_bd, "INSERT INTO aulas_previstas (componente, turma, janeiro, fevereiro, marco, abril, maio, junho, julho, agosto, setembro, outubro, novembro, dezembro) VALUES ('".$_GET['componente']."','".$_GET['turma']."', '', '', '', '', '', '', '', '', '', '', '', '')");
}

?>







<? if(isset($_POST['button'])){

mysqli_query($conexao_bd, "UPDATE aulas_previstas SET janeiro = '".$_POST['janeiro']."', fevereiro = '".$_POST['fevereiro']."', marco = '".$_POST['marco']."', abril = '".$_POST['abril']."', maio = '".$_POST['maio']."', junho = '".$_POST['junho']."', julho = '".$_POST['julho']."', agosto = '".$_POST['agosto']."', setembro = '".$_POST['setembro']."', outubro = '".$_POST['outubro']."', novembro = '".$_POST['novembro']."', dezembro = '".$_POST['dezembro']."' WHERE componente = '".$_GET['componente']."' AND turma = '".$_GET['turma']."'");

echo "<script>alert('Informação atualizada com sucesso!');</script>";

}?>


<form name="form" id="form">
  <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
    <option value="">SELECIONE</option>
    
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
	  <option value="cargaHoraria.php?turma=<? echo $_GET['turma']; ?>&componente=<? echo $res['disciplina']; ?>"><? echo $res_disciplina['componente']; ?> - <? echo strtoupper($res_colaborador['nome']); ?></option>
	<? }}}} ?>
    
  </select>
</form>
<form id="form1" name="form1" method="post" action="">
  <?

$sqlPesquisa = mysqli_query($conexao_bd, "SELECT * FROM aulas_previstas WHERE componente = '".$_GET['componente']."' AND turma = '".$_GET['turma']."'");
 while($resPesquisa = mysqli_fetch_array($sqlPesquisa)){
?>
  <table width="634" border="1">
    <tr>
      <td width="152" bgcolor="#00CC99"><strong>JANEIRO</strong></td>
      <td width="154" bgcolor="#00CC99"><strong>FEVEREIRO</strong></td>
      <td width="150" bgcolor="#00CC99"><strong>MAR&Ccedil;O</strong></td>
      <td width="150" bgcolor="#00CC99"><strong>ABRIL</strong></td>
    </tr>
    <tr>
      <td><input type="text" name="janeiro" value="<? echo $resPesquisa['janeiro']; ?>" /></td>
      <td><input type="text" name="fevereiro" value="<? echo $resPesquisa['fevereiro']; ?>" /></td>
      <td><input type="text" name="marco" value="<? echo $resPesquisa['marco']; ?>" /></td>
      <td><input type="text" name="abril" value="<? echo $resPesquisa['abril']; ?>" /></td>
    </tr>
    <tr>
      <td bgcolor="#00CC99"><strong>MAIO</strong></td>
      <td bgcolor="#00CC99"><strong>JUNHO</strong></td>
      <td bgcolor="#00CC99"><strong>JULHO</strong></td>
      <td bgcolor="#00CC99"><strong>AGOSTO</strong></td>
    </tr>
    <tr>
      <td><input type="text" name="maio" value="<? echo $resPesquisa['maio']; ?>" /></td>
      <td><input type="text" name="junho" value="<? echo $resPesquisa['junho']; ?>" /></td>
      <td><input type="text" name="julho" value="<? echo $resPesquisa['julho']; ?>" /></td>
      <td><input type="text" name="agosto" value="<? echo $resPesquisa['agosto']; ?>" /></td>
    </tr>
    <tr>
      <td bgcolor="#00CC99"><strong>SETEMBRO</strong></td>
      <td bgcolor="#00CC99"><strong>OUTUBRO</strong></td>
      <td bgcolor="#00CC99"><strong>NOVEMBRO</strong></td>
      <td bgcolor="#00CC99"><strong>DEZEMBRO</strong></td>
    </tr>
    <tr>
      <td><input type="text" name="setembro" value="<? echo $resPesquisa['setembro']; ?>" /></td>
      <td><input type="text" name="outubro" value="<? echo $resPesquisa['outubro']; ?>" /></td>
      <td><input type="text" name="novembro" value="<? echo $resPesquisa['novembro']; ?>" /></td>
      <td><input type="text" name="dezembro" value="<? echo $resPesquisa['dezembro']; ?>" /></td>
    </tr>
    <tr>
      <td colspan="4"><input class="input" type="submit" name="button" id="button" value="Salvar" /></td>
    </tr>
  </table>
<? } ?>
</form>

<a style="border:2px solid #000; padding:10px; text-decoration:none; color:#FFF; background:#0C0; font:12px Arial, Helvetica, sans-serif;" href="../index.php?p=anos">Voltar</a>

</body>
</html>