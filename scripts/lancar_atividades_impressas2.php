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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
<? require "../../conexao.php"; ?>
<form name="form" id="form">
<strong>Selecione o bimestre</strong><br />
  <select style="width:300px; padding:5px; border:1px solid #333; border-radius:5px;" class="select-control" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('self',this,0)">
    <option value="">Selecione o bimestre</option>
    <option value="?aluno=<? echo $_GET['aluno']; ?>&amp;turma=<? echo $_GET['turma']; ?>&amp;bimestre=1">1� bimestre</option>
    <option value="?aluno=<? echo $_GET['aluno']; ?>&amp;turma=<? echo $_GET['turma']; ?>&amp;bimestre=2">2� bimestre</option>
    <option value="?aluno=<? echo $_GET['aluno']; ?>&amp;turma=<? echo $_GET['turma']; ?>&amp;bimestre=3">3� bimestre</option>
    <option value="?aluno=<? echo $_GET['aluno']; ?>&amp;turma=<? echo $_GET['turma']; ?>&amp;bimestre=4">4� bimestre</option>
  </select>
</form>
<hr />

  <table width="355" class="table" border="1">
    <tr>
      <th colspan="3" scope="col">INSERIR NOTAS DO <? echo $bimestre = $_GET['bimestre']; ?>&deg; BIMESTRE</th>
    </tr>
    <tr>
      <td width="194"><strong>COMPONENTE</strong></td>
      <td width="45"><strong>NOTA</strong></td>
      <td width="94">&nbsp;</td>
    </tr>
<?
$sql_componente = mysqli_query($conexao_bd, "SELECT * FROM disciplinas");
 while($resComponente = mysqli_fetch_array($sql_componente)){
	
	$sqlBuscaNota = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '".$_GET['aluno']."' AND componente = '".$resComponente['code']."' AND bimestre = '$bimestre' AND turma = '".$_GET['turma']."'");
		while($resBuscaNota = mysqli_fetch_array($sqlBuscaNota)){

?>
<form name="" method="post" enctype="multipart/form-data" action="">
    <tr> 
    	<input type="hidden" name="componente" value="<? echo $resComponente['code']; ?>" />
      <td><? echo $resComponente['componente']; ?></td>
      <td><input name="nota" type="text" value="<? echo $resBuscaNota['media']; ?>" size="5" /></td>
      <td><input type="submit" name="alterar" id="button" value="Lan&ccedil;ar" /></td>
    </tr>
</form>
<? }} ?>
  </table>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
<? if(isset($_POST['alterar'])){
	
	$componente = $_POST['componente'];
	$bimestre = $_GET['bimestre'];
	$aluno = $_GET['aluno'];
	$nota = $_POST['nota'];
	$turma = $_GET['turma'];
	
	
	$sqlBuscaNota = mysqli_query($conexao_bd, "SELECT * FROM notas_bimestrais WHERE aluno = '$aluno' AND componente = '$componente' AND bimestre = '$bimestre' AND turma = '$turma'");
	
	if(mysqli_num_rows($sqlBuscaNota) == ''){
		
		mysqli_query($conexao_bd, "INSERT INTO notas_bimestrais (tipo, turma, aluno, componente, bimestre, at, ap, ab, re, media) VALUES ('COORDENACAO', '$turma', '$aluno', '$componente', '$bimestre', '$nota', '$nota', '$nota', '', '$nota')");
	
	}else{
		
		
			echo "<script>window.alert('ok!');</script>";
		
	}
	
	echo "<script>window.location='';</script>";

}?>