<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<style type="text/css">
body,td,th {
	color: #000;
	font:12px Arial, Helvetica, sans-serif;
}
body input{
	color: #000;
	font:12px Arial, Helvetica, sans-serif;
	text-align:center;
	padding:10px;
}
body table select{
	color: #000;
	font:12px Arial, Helvetica, sans-serif;
	text-align:center;
	padding:10px;
}
</style>
</head>

<body>
<? require "../../conexao.php"; ?>
<form name="form" id="form">
<strong>Selecione o bimestre</strong><br />
  <select style="width:300px; padding:5px; border:1px solid #333; border-radius:5px;" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('self',this,0)">
    <option value="">Selecione o bimestre</option>
    <option value="?aluno=<? echo $_GET['aluno']; ?>&turma=<? echo $_GET['turma']; ?>&bimestre=3">3° bimestre</option>
    <option value="?aluno=<? echo $_GET['aluno']; ?>&turma=<? echo $_GET['turma']; ?>&bimestre=4">4° bimestre</option>
  </select>
</form>
<hr />


<? if(isset($_POST['atualizar'])){
	
$nota = $_POST['nota'];
$frequencia = $_POST['frequencia'];
$aluno = $_GET['aluno'];
$turma = $_GET['turma'];
$bimestre = $_GET['bimestre'];

$sql_atividades = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '$turma' AND periodo = '$bimestre'");
while($res_atividades = mysqli_fetch_array($sql_atividades)){
	
	$code_atividade = 0;
	$code_atividade = $res_atividades['code_atividade'];
	
	$sql_verifica_envio = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '$aluno' AND code_atividade = '$code_atividade'");
	 if(mysqli_num_rows($sql_verifica_envio) == ''){
	 	
		mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas (data, status, arquivo, code_aluno, code_atividade, nota) VALUES ('$data', 'CORRIGIDO', '', '$aluno', '$code_atividade', '$nota')");	
	 }
}


$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas");
while($res_componente = mysqli_fetch_array($sql_componente)){

$componente = $res_componente['code'];

$sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '$aluno' AND bimestre = '$bimestre' AND componente = '$componente'");
if(mysqli_num_rows($sql_notas_bimestrais) == ''){
	mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (turma, aluno, componente, bimestre, at, ap, ab, re) VALUES ('$turma', '$aluno', '$componente', '$bimestre', '$nota', '$nota', '$nota', '')");
}else{
	mysqli_query($conexao_bd, "UPDATE notas_bimestrais SET at = '$nota', ap = '$nota', ab = '$nota' WHERE aluno = '$aluno' AND bimestre = '$bimestre' AND componente = '$componente'");
}
}

echo "
<strong>Notas e frequencia lançadas com sucesso!</strong><br><br>

<em>Pressione F5 para mesclar a operação.</em>

";
die;
}?>

<form name="" method="post" enctype="multipart/form-data" action="">
<table width="299" border="0" style="border:1px solid #000;">
  <tr>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><h2 style="font:15px Arial, Helvetica, sans-serif;"><strong>ATIVIDADES IMPRESSAS<br /> <? echo $_GET['bimestre']; ?>° BIMESTRE</strong></h2>
      <hr /></td>
  </tr>
  <tr>
    <td width="115"><strong>
      <label for="matematica">Nota</label>
    </strong></td>
    
    <?
    	
		$aluno = $_GET['aluno'];
		$nota = 0;
		$bimestre = $_GET['bimestre'];
		
		$sql_notas_bimestrais = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '$aluno' AND bimestre = '$bimestre' LIMIT 1");
		 while($res_notas = mysqli_fetch_array($sql_notas_bimestrais)){
			 $nota = $res_notas['ab'];
		}
	
	?>
    
    <td width="346"><input name="nota" type="text" id="matematica" size="3" maxlength="2" value="<? echo $nota; ?>" /></td>
    </tr>
  <tr>
    <td bgcolor="#009999"><strong>
      <label for="freq_matematica">Frequ&ecirc;ncia</label>
    </strong></td>
    <td bgcolor="#009999"><select name="frequencia" size="1" id="freq_portugues">
      <option value="100">100%</option>
      <option value="95">95%</option>
      <option value="90">90%</option>
      <option value="85">85%</option>
      <option value="80">80%</option>
      <option value="75">75%</option>
    </select></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><hr /><input type="submit" name="atualizar" id="button" value="Atualizar"></td>
  </tr>
</table>
</form>
</body>
</html>